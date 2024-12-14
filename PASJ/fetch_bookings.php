<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';
require 'vendor/autoload.php';

$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "policeautomation";

// Enable mysqli exceptions for error handling
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check if form is submitted
    $postData = $uploadedFile = $statusMsg = '';
    $msgClass = 'errordiv';
    if (isset($_POST["submit"])) {
        $nic = $_POST['nic'];
        $name = $_POST['name'];
        $datetime = $_POST['datetime'];
        $mobileno = $_POST['mobileno'];
        $email = $_POST['email'];

        // Email validation
        if (!empty($email)) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                $statusMsg = 'Please enter a valid email.';
                echo "<script>alert('$statusMsg');</script>";
            }

            // Check if the date and time are already booked
            $stmt = $conn->prepare("SELECT COUNT(*) FROM bookings WHERE date_time = ?");
            $stmt->bind_param("s", $datetime);
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fetch();
            $stmt->close();

            if ($count > 0) {
                // If the same date and time is found, show an alert and exit
                $statusMsg = 'The selected date and time are not available. Please choose another.';
                echo "<script>alert('$statusMsg');</script>";
                exit;
            }

            // Proceed with the insertion if date and time are available
            try {
                // Prepare the SQL statement to insert the new booking
                $stmt = $conn->prepare("INSERT INTO bookings (nic, name, date_time, mobileno, email) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sssss", $nic, $name, $datetime, $mobileno, $email);
                $stmt->execute();
                $stmt->close();

                // Retrieve the reference ID for the new booking
                $stmt2 = $conn->prepare("SELECT id FROM bookings WHERE nic = ?");
                $stmt2->bind_param("s", $nic);
                $stmt2->execute();
                $stmt2->bind_result($ref);
                $stmt2->fetch();
                $stmt2->close();

                // Set up and send the confirmation email
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'trashcan21st@gmail.com';
                $mail->Password = 'bdzr uiwh puru vqhc';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('trashcan21st@gmail.com', 'Sri Lanka Police');
                $mail->addAddress($email, $name);

                $mail->isHTML(true);
                $mail->Subject = 'Appointment details';
                $mail->Body = '<h2>Your appointment details.</h2>
                               <p>Your reference number for the appointment is: '.$ref.'</p>
                               <p>NIC: '.$nic.'</p>
                               <p>Name: '.$name.'</p>
                               <p>Date & time of appointment: '.$datetime.'</p>
                               <p>Mobile No: '.$mobileno.'</p>
                               <p>Email: '.$email.'</p>';
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                echo "<script>alert('Message has been sent');</script>";
            } catch (Exception $e) {
                echo "<script>alert('Message could not be sent. Mailer Error: {$e->getMessage()}');</script>";
            }
            $message1 = "The online complaint has been accepted and the relevant parties will be informed quickly";
        }
    }
} catch (Exception $e) {
    $errorMessage = "Error: " . $e->getMessage() . "\nError Code: " . $e->getCode();
    $alertMessage = "Error: " . $e->getMessage() . " Error Code: " . $e->getCode();
    echo "<script>alert('$alertMessage');</script>";
    $message2 = "Online appointment cannot be submitted as required information is not included";
    echo "<script>alert('$message2');</script>";
    error_log($errorMessage);
    echo nl2br($errorMessage); // Display error message for debugging purposes
} finally {
    if (isset($conn) && $conn instanceof mysqli) {
        $conn->close();
    }
}
?>
