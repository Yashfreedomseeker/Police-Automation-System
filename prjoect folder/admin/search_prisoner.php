<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prisoner Profile Search</title>

    <!-- Link to external CSS file -->
    <link rel="stylesheet" href="admin.css">
</head>
<body class = "bd">
    <center><h2>Prisoner profile</h2></center>
</body>
</html>

<?php
// Database connection details
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = "1234"; // Replace with your database password
$dbname = "policeautomation"; // Replace with your database name

// Enable MySQLi exceptions for error handling
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Retrieve the NIC of the prisoner to search from the POST request
    $id = $_POST['id'];
    
    if (!empty($id)) {
        // Prepare the SQL SELECT query
        $sql = "SELECT * FROM prisoners WHERE id = ?";
        
        // Prepare the statement
        if ($stmt = $conn->prepare($sql)) {
            // Bind the ID to the SQL query
            $stmt->bind_param("s", $id);
            
            // Execute the statement
            $stmt->execute();
            
            // Get the result
            $result = $stmt->get_result();
            
            // Check if a prisoner was found
            if ($result->num_rows > 0) {
                // Fetch the prisoner data
                $row = $result->fetch_assoc();
                
                // Display data in a vertical table format
                echo "<table border='1'>
                        <tr><th>Prisoner ID</th><td>" . $row['id'] . "</td></tr>
                        <tr><th>NIC</th><td>" . $row['nic'] . "</td></tr>
                        <tr><th>Name</th><td>" . $row['name'] . "</td></tr>
                        <tr><th>Date of Birth</th><td>" . $row['birthday'] . "</td></tr>
                        <tr><th>Date of Imprisonment</th><td>" . $row['date_imprisoned'] . "</td></tr>
                        <tr><th>Period of Imprisonment</th><td>" . $row['period_of_imprisonment'] . "</td></tr>
                        <tr><th>Acquittal on</th><td>" . $row['acquitted_on'] . "</td></tr>
                        <tr><th>Responsible Crime</th><td>" . $row['responsible_crime'] . "</td></tr>
                        <tr><th>Case Reference no.</th><td>" . $row['case_reference_no'] . "</td></tr>";

                // Retrieve and display the image stored as a LONG BLOB
                if (!empty($row['image'])) {
                    // Convert the binary image data into a base64-encoded string
                    $imageData = base64_encode($row['image']);
                    
                    // Display the image in an <img> tag with base64 data
                    echo "<tr><th>Image</th><td><img src='data:image/jpeg;base64," . $imageData . "' alt='Prisoner Image' width='300' height='400'></td></tr>";
                } else {
                    echo "<tr><th>Image</th><td>No image available</td></tr>";
                }

                echo "</table>";
            } else {
                echo "No prisoner found with ID " . $id;
            }

            // Close the statement
            $stmt->close();
        } else {
            throw new Exception("Error preparing the query.");
        }
    } else {
        echo "Please provide a valid ID.";
    }
    
    // Close the database connection
    $conn->close();

} catch (Exception $e) {
    // Catch any exceptions and display an error message
    echo "An error occurred: " . $e->getMessage();
}
?>
