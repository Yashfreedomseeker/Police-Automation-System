<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Police Profile Search</title>

    <!-- Link to external CSS file -->
    <link rel="stylesheet" href="admin.css">
</head>
<body class = "bd">
    <center><h2>Police profile</h2></center>
</body>
</html>

<?php
// Database connection details
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = "1234"; // Replace with your database password
$dbname = "policeautomation"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the NIC of the police officer to search from the POST request
$nic = $_POST['nic'];

if (!empty($nic)) {
    // Prepare the SQL SELECT query
    $sql = "SELECT * FROM police_profiles WHERE nic = ?";

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the NIC to the SQL query
        $stmt->bind_param("s", $nic);

        // Execute the statement
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Check if a police officer was found
        if ($result->num_rows > 0) {
            // Fetch the police officer data
            $row = $result->fetch_assoc();

            // Display the data in a vertical table format
            echo "<table border='1' class='results-table'>
                    <tbody>
                        <tr><th>ID</th><td>" . htmlspecialchars($row['police_id']) . "</td></tr>
                        <tr><th>NIC</th><td>" . htmlspecialchars($row['nic']) . "</td></tr>
                        <tr><th>Name</th><td>" . htmlspecialchars($row['name']) . "</td></tr>
                        <tr><th>Contact no.</th><td>" . htmlspecialchars($row['mobile']) . "</td></tr>
                        <tr><th>Birthday</th><td>" . htmlspecialchars($row['birthday']) . "</td></tr>
                        <tr><th>Address</th><td>" . htmlspecialchars($row['address']) . "</td></tr>
                        <tr><th>Date Joined</th><td>" . htmlspecialchars($row['date_joined']) . "</td></tr>
                        <tr><th>Position</th><td>" . htmlspecialchars($row['position']) . "</td></tr>
                        <tr><th>Promotions</th><td>" . htmlspecialchars($row['promotions']) . "</td></tr>
                    </tbody>
                </table>";
        } else {
            echo "No police officer found with NIC " . htmlspecialchars($nic);
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
