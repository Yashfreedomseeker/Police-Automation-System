<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "1234";  // Your database password
$dbname = "policeautomation";  // Your database name

try {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Get NIC from the query parameter
    $nic = isset($_GET['nic']) ? $conn->real_escape_string($_GET['nic']) : '';

    // Prepare the SQL query to fetch prisoner details by NIC
    $sql = "SELECT id, nic, name, birthday, date_imprisoned, period_of_imprisonment, acquitted_on, responsible_crime, case_reference_no, image FROM prisoners WHERE nic = '$nic'";
    $result = $conn->query($sql);

    if (!$result) {
        throw new Exception("Query failed: " . $conn->error);
    }

    $prisoners = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Encode the image binary data as base64 and append it to the JSON response
            if (!empty($row['image'])) {
                $row['image'] = 'data:image/jpeg;base64,' . base64_encode($row['image']);  // Adjust MIME type if necessary (jpeg, png, etc.)
            } else {
                $row['image'] = null;  // Handle if no image is present
            }
            $prisoners[] = $row;
        }
    }

    // Return the prisoners data in JSON format
    echo json_encode($prisoners);

} catch (Exception $e) {
    // Handle exception and output error message
    echo json_encode([
        'error' => $e->getMessage()
    ]);
} finally {
    // Close connection
    if (isset($conn) && $conn->ping()) {
        $conn->close();
    }
}
?>
