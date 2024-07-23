<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";  // Default username for WAMP
$password = "";      // Default password for WAMP
$dbname = "case_management";  // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM prisoners";
$result = $conn->query($sql);

$prisoners = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $prisoners[] = $row;
    }
}

echo json_encode($prisoners);

$conn->close();
?>
