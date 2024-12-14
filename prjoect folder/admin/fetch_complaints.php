<?php
// Database connection (replace with your own database details)
$host = 'localhost';
$dbname = 'policeautomation';
$username = 'root';
$password = '1234';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the reference number from the POST request
if (isset($_POST['referenceNo'])) {
    $referenceNo = $conn->real_escape_string($_POST['referenceNo']);

    // Query to search for complaints based on the provided reference number
    $sql = "SELECT Complain_ID, Complainer_Name, Reference_No, Complaint_Details, Date, Category 
            FROM complaints 
            WHERE Reference_No = '$referenceNo'";
    
    $result = $conn->query($sql);

    $complaints = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $complaints[] = $row;
        }
    }

    // Return complaints as JSON
    header('Content-Type: application/json');
    echo json_encode($complaints);
} else {
    // Return an error if no reference number was provided
    echo json_encode(['error' => 'No reference number provided']);
}

$conn->close();
?>
