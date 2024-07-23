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

if (isset($_GET['nic'])) {
    $nic = $_GET['nic'];
    $sql = "SELECT * FROM police_profiles WHERE nic = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nic);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        

        echo json_encode($row);
    } else {
        echo json_encode(array("error" => "No profile found"));
    }

    $stmt->close();
} else {
    echo json_encode(array("error" => "NIC not provided"));
}

$conn->close();
?>
