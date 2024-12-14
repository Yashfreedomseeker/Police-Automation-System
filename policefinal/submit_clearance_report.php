<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';
require 'vendor/autoload.php';

// Database configuration
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "policeautomation";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$applicationType = $_POST['applicationType'];
$name = $_POST['name'];
$nationality = $_POST['nationality'];
$citizenOfSriLanka = $_POST['citizenOfSriLanka'];
$dob = $_POST['dob'];
$leftSriLanka = $_POST['leftSriLanka'];
$age = $_POST['age'];
$nicNo = $_POST['nicNo'];
$passportNo = $_POST['passportNo'];
$country = $_POST['country'];
$highCommission = $_POST['highCommission'];
$address = $_POST['address'];
$email = $_POST['mail'];

if(!empty($email)){
    if(filter_var($email, FILTER_VALIDATE_EMAIL)===false){
        $statusMsg = 'Please enter a valid email.';
    }
}
try {
    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO clearance_reports (application_type, name, nationality, citizen_of_sri_lanka, dob, left_sri_lanka, age, nic_no, passport_no, email, country, high_commission, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        throw new Exception("Prepare statement failed: " . $conn->error);
    }

    $stmt->bind_param("sssssssssssss", $applicationType, $name, $nationality, $citizenOfSriLanka, $dob, $leftSriLanka, $age, $nicNo, $passportNo, $email, $country, $highCommission, $address);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        throw new Exception("Execute statement failed: " . $stmt->error);
    }
    $stmt->close();

    // Fetch the reference number
    $stmt2 = $conn->prepare("SELECT ref FROM clearance_reports WHERE nic_no = ?");
    if (!$stmt2) {
        throw new Exception("Prepare statement for fetching ref failed: " . $conn->error);
    }

    $stmt2->bind_param("s", $nicNo);
    $stmt2->execute();
    $stmt2->bind_result($ref);
    $stmt2->fetch();
    $stmt2->close();

    // Send email with PHPMailer
    $mail = new PHPMailer(true); // Create a new PHPMailer instance and enable exceptions

    // Server settings
    $mail->isSMTP(); // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'trashcan21st@gmail.com'; // SMTP username
    $mail->Password = 'bdzr uiwh puru vqhc'; // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
    $mail->Port = 587; // TCP port to connect to

    // Recipients
    $mail->setFrom('trashcan21st@gmail.com', 'Sri Lanka Police'); // Set sender of the email
    $mail->addAddress($email, $name); // Add a recipient

    // Content
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = 'Clearance report: ' . $applicationType; // Email subject
    $mail->Body = '<h2>Form for clearance report submitted.</h2><p>Your reference number for the clearance report is: ' . $ref . '</p>'; // Email body in HTML
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients'; // Plain text alternative for email clients that do not support HTML

    $mail->send(); // Send the email
    echo "<script>alert('Message has been sent');</script>"; // Success message
} catch (Exception $e) {
    $errorMessage = "Error: " . $e->getMessage() . "\nError Code: " . $e->getCode();
    $alertMessage = "Error: " . $e->getMessage() . " Error Code: " . $e->getCode();
    echo "<script>alert('$alertMessage');</script>";
    $message2 = "Online submission cannot be accepted as required information is not included";
    echo "<script>alert('$message2');</script>";
    error_log($errorMessage); // Logs error to server log for debugging
    echo nl2br($errorMessage); // Display error message for debugging purposes
} finally {
    if (isset($conn) && $conn instanceof mysqli) {
        $conn->close();
    }
}
?>
