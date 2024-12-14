<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "policeautomation";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try{
    $conn = new mysqli($servername, $username, $password, $dbname);

    $sql = "SELECT * FROM bookings";
    $result = $conn->query($sql);

    $bookings = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $bookings[] = $row;
        }
    }
}
catch (Exception $e) {
    $errorMessage = "Error: " . $e->getMessage() . "\nError Code: " . $e->getCode();
    $alertMessage = "Error: " . $e->getMessage() . " Error Code: " . $e->getCode();
    echo "<script>alert('$alertMessage');</script>";
    $message2 = "table data cannot be shown";
    echo "<script>alert('$message2');</script>";
    error_log($errorMessage); // Logs error to server log for debugging
    echo nl2br($errorMessage); // Display error message for debugging purposes
}
finally{
    if (isset($conn) && $conn instanceof mysqli) {
        $conn->close();
        echo json_encode($bookings);
    }
}
?>