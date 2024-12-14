<?php
// Database connection details
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = "1234";     // Replace with your database password
$dbname = "policeautomation";    // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the NIC of the prisoner to delete from the POST request
$id = $_POST['id'];

if (!empty($id)) {
    // Prepare the SQL DELETE query
    $sql = "DELETE FROM prisoners WHERE id = ?";

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the NIC to the SQL query
        $stmt->bind_param("s", $id);

        // Execute the statement
        if ($stmt->execute()) {
            // Check if any rows were affected (i.e., if a prisoner was actually deleted)
            if ($stmt->affected_rows > 0) {
                echo "<script>alert('Prisoner with ID " . $id . " has been successfully deleted.')</script>";
            } else {
                echo "<script>alert('No prisoner found with ID " . $id . ".')</script>";
            }
        } else {
            echo "<script>alert('Error deleting prisoner: " .$stmt->error.".')</script>";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing query: " . $conn->error;
    }
} else {
    echo "Please provide a valid NIC.";
}

// Close the database connection
$conn->close();
?>
