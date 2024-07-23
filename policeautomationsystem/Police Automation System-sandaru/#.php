<?php
// Ensure this PHP script is connecting to your MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "policeautomationsystem";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Handle file upload if attachment is provided
$attachment_path = null;
if ($_FILES['attachment']['size'] > 0) {
    $target_dir = "uploads/"; // Specify your upload directory
    $target_file = $target_dir . basename($_FILES["attachment"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // Check file size
    if ($_FILES["attachment"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType != "pdf") {
        echo "Sorry, only PDF files are allowed.";
        $uploadOk = 0;
    }
    
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["attachment"]["tmp_name"], $target_file)) {
            $attachment_path = $target_file;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

// Prepare SQL statement to insert data into complaints table
$stmt = $conn->prepare("INSERT INTO Lodge_complaints (district, police_station, complaint_category, cname, address, nic_number, contact_number, Email, complaint, complaint_subject, notification, attachment) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssssssb", $district, $police_station, $complaint_category, $cname, $address, $nic_number, $contact_number, $email, $complaint, $complaint_subject, $notification, $attachment_path);

// Set parameters and execute
$district = $_POST['district'];
$police_station = $_POST['police_station'];
$complaint_category = $_POST['complaint_category'];
$cname = $_POST['cname'];
$address = $_POST['address'];
$nic_number = $_POST['nic_number'];
$contact_number = $_POST['contact_number'];
$email = $_POST['Email'];
$complaint = $_POST['complaint'];
$complaint_subject = $_POST['complaint_subject'];
$notification = isset($_POST['notification']) ? 1 : 0;

$stmt->execute();

echo "Complaint lodged successfully.";

$stmt->close();
$conn->close();
?>
