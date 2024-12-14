<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cases Table</title>
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

    $sql = "SELECT * FROM cases";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<br>";
        echo "<table>";
        echo "<thead>";
        echo "<tr>
                <th>Case ID</th>
                <th>Case Type</th>
                <th>Date & Time</th>
                <th>Evidences</th>
                <th>Description</th>
                <th>Status</th>
                <th>Follow-up Evidence</th>
            </tr>";
        echo "</thead>";
        echo "<tbody>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['case_id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['case_type']) . "</td>";
            echo "<td>" . htmlspecialchars($row['date_time']) . "</td>";
            echo "<td>" . htmlspecialchars($row['evidence']) . "</td>";
            echo "<td>" . htmlspecialchars($row['description']) . "</td>";
            echo "<td>" . htmlspecialchars($row['case_status']) . "</td>";

            if (!empty($row['followup_evidence'])) {
                echo "<td><a href='serve_file.php?case_id=" . htmlspecialchars($row['case_id']) . ">View Follow-up Evidence</a></td>";
            } else {
                echo "<td>No Follow-up Evidence</td>";
            }

            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>No cases found.</p>";
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
