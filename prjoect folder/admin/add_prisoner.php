<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "policeautomation";

try {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Add prisoner
    if (isset($_POST["submitprisoner"])) {
        $nic = $_POST['nic'];
        $name = $_POST['name'];
        $dob = $_POST['dob'];
        $doi = $_POST['doi'];
        $period = $_POST['period'];
        $acquittal = $_POST['doa'];
        $crime = $_POST['crime'];
        $caseref = $_POST['caseref'];

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imageData = $_FILES['image']['tmp_name'];
            $image = file_get_contents($imageData); 
        } 
        else {
            throw new Exception('No file uploaded.');
        }

        // Prepare an SQL statement
        $stmt = $conn->prepare("INSERT INTO prisoners (nic, name, birthday, date_imprisoned, period_Of_imprisonment, acquitted_on, responsible_crime, case_reference_no, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Bind parameters
        $stmt->bind_param("sssssssss", $nic, $name, $dob, $doi, $period, $acquittal, $crime, $caseref, $image);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<script>alert('New prisoner added successfully');</script>";
        } else {
            throw new Exception("Error executing query: " . $stmt->error);
        }
        // Close the statement
        $stmt->close();
        $conn->close();
    }
    
} catch (Exception $e) {
    // Output error message for debugging
    echo "Error: " . $e->getMessage();
} finally {
    // Ensure the connection is closed
    if (isset($conn) && $conn->ping()) {
        $conn->close();
    }
}
?>
