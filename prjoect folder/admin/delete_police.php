<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "policeautomation"; // Change this to your actual database name

try {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Get NIC from form submission
    if (!isset($_POST['nic'])) {
        throw new Exception("NIC not provided.");
    }

    $nic = $_POST['nic'];

    // Prepare and execute the SQL statement
    $sql = "DELETE FROM police_profiles WHERE nic = ?";
    $stmt = $conn->prepare($sql);

    // Check if prepare() succeeded
    if ($stmt === false) {
        throw new Exception("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $nic);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Police officer deleted successfully.";
    } else {
        throw new Exception("Error deleting police officer: " . $stmt->error);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();

} catch (Exception $e) {
    // Catch any exceptions and display the error message
    echo "Error: " . $e->getMessage();
}
?>
