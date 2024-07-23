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

$sql = "SELECT case_id, complainant_id, case_type, date_time, evidence, description FROM cases";
$result = $conn->query($sql);

$summaryReport = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $summaryReport[] = $row;
    }
} else {
    echo json_encode([]);
    $conn->close();
    exit();
}

echo json_encode($summaryReport);

$conn->close();
?>
