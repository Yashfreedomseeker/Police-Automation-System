<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "policeautomation";

// Enable mysqli exceptions for error handling
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Create a new database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Get the current date and time
    $currentDateTime = date('Y-m-d H:i:s');

    // Delete any past bookings first
    $deleteStmt = $conn->prepare("DELETE FROM bookings WHERE date_time < ?");
    $deleteStmt->bind_param("s", $currentDateTime);
    $deleteStmt->execute();
    $deleteStmt->close(); // Close the delete statement

    // Prepare and execute the query to fetch the nearest upcoming booking (only one row)
    $stmt = $conn->prepare("SELECT id, name, date_time FROM bookings WHERE date_time > ? ORDER BY date_time ASC LIMIT 1");
    $stmt->bind_param("s", $currentDateTime);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if there is an upcoming booking
    if ($result->num_rows > 0) {
        echo "<div class='graphbox2'>";
        echo "<div class='box3'>"; // The nearest booking will be inside this box

        // Display a title or heading if needed
        echo "<h3>Next Booking</h3>";
        // Fetch and display the nearest booking
        $row = $result->fetch_assoc();
        echo "<p>" . $row['id'] . "<br>";
        echo  $row['name'] . "<br>";
        echo  $row['date_time'] . "</p>"; // Optional: Display date and time
        echo "</div>"; // Close the box div
        echo "</div>"; // Close the graphbox div
    } else {
        echo "<div class='graphbox'><div class='box'><p>No upcoming bookings.</p></div></div>";
    }

    // Close the statement
    $stmt->close();

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    if (isset($conn) && $conn instanceof mysqli) {
        $conn->close();
    }
}
?>
