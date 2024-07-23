<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "case_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$complainant_id = $_POST['complainant_id'];
$case_type = $_POST['case_type'];
$date_time = $_POST['date_time'];
$description = $_POST['description'];

// Handle file upload
$target_dir = "C:\Users\JANITH\Desktop\policeautomationfle";
$target_file = $target_dir . basename($_FILES["evidence"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if file is a real file
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["evidence"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check file size (limit to 5MB)
if ($_FILES["evidence"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if ($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "gif" && $fileType != "pdf") {
    echo "Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["evidence"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars(basename($_FILES["evidence"]["name"])) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

// Insert data into database
$sql = "INSERT INTO cases (complainant_id, case_type, date_time, evidence, description)
        VALUES ('$complainant_id', '$case_type', '$date_time', '$target_file', '$description')";

if ($conn->query($sql) === TRUE) {
    echo "New case created successfully";
    header("Location: policedashboard.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();
?>
