<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaints Table</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="bd">
<?php
// Database connection details
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = "1234"; // Replace with your database password
$dbname = "policeautomation"; // Replace with your database name

try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM lodgecomplains";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table class='complaints-table'>";
        echo "<thead>";
        echo "<tr>
                <th>Complaint ID</th>
                <th>Complainant NIC</th>
                <th>Complainant Name</th>
                <th>Complainant Address</th>
                <th>Complainant Email</th>
                <th>Contact No.</th>
                <th>Category</th>
                <th>Subject</th>
                <th>Complaint</th>
                <th>Date & Time</th>
                <th>Evidences</th>
            </tr>";
        echo "</thead>";
        echo "<tbody>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['refno']) . "</td>";
            echo "<td>" . htmlspecialchars($row['nicnumber']) . "</td>";
            echo "<td>" . htmlspecialchars($row['cname']) . "</td>";
            echo "<td>" . htmlspecialchars($row['address']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['contactnumber']) . "</td>";
            echo "<td>" . htmlspecialchars($row['complaintcategory']) . "</td>";
            echo "<td>" . htmlspecialchars($row['complaintsubject']) . "</td>";
            echo "<td>" . htmlspecialchars($row['complaint']) . "</td>";
            echo "<td>" . htmlspecialchars($row['date_time']) . "</td>";

            // Check if attachment exists
            if (!empty($row['attachment'])) {
                echo "<td><a href='serve_file.php?refno=" . htmlspecialchars($row['refno']) . "'>View Attachment</a></td>";
            } else {
                echo "<td>No Attachment</td>";
            }

            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>No complaints found.</p>";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    if (isset($conn) && $conn instanceof mysqli) {
        $conn->close();
    }
}
?>

</body>
</html>
