<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "case_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$case_id = $_POST['case_id'];
$case_status = $_POST['case_status'];
$evidence = $_FILES['evidence'];

$upload_dir = 'C:\Users\JANITH\Desktop\policeautomationfle';
$upload_file = $upload_dir . basename($evidence['name']);
$response = [];

if (move_uploaded_file($evidence['tmp_name'], $upload_file)) {
    $sql = "UPDATE cases SET case_status = '$case_status', evidence2 = '$upload_file' WHERE case_id = '$case_id'";

    if ($conn->query($sql) === TRUE) {
        $response['success'] = true;
    } else {
        $response['success'] = false;
        $response['error'] = $conn->error;
    }
} else {
    $response['success'] = false;
    $response['error'] = 'Failed to upload file.';
}

$conn->close();

echo json_encode($response);
?>
