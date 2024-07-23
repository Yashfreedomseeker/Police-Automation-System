<?php
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

$sql = "SELECT * FROM bookings";
$result = $conn->query($sql);

$bookings = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $bookings[] = $row;
    }
}

$conn->close();
echo json_encode($bookings);
?>
