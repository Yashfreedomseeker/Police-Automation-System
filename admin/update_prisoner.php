<?php
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = "1234"; // Replace with your database password
$dbname = "policeautomation"; // Replace with your database name

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the NIC of the Police Officer to update
    $id = $_POST['id'];

    try {
        // Database connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }

        // Prepare an array of fields to update
        $fields_to_update = [];

        if (!empty($_POST['name'])) {
            $name = $conn->real_escape_string($_POST['name']);
            $fields_to_update[] = "name='$name'";
        }

        if (!empty($_POST['dob'])) {
            $dob = $conn->real_escape_string($_POST['dob']);
            $fields_to_update[] = "birthday='$dob'";
        }

        if (!empty($_POST['doi'])) {
            $doi = $conn->real_escape_string($_POST['doi']);
            $fields_to_update[] = "date_imprisoned='$doi'";
        }

        if (!empty($_POST['period'])) {
            $period = $conn->real_escape_string($_POST['period']);
            $fields_to_update[] = "period_of_imprisonment='$period'";
        }

        if (!empty($_POST['nic'])) {
            $branch = $conn->real_escape_string($_POST['nic']);
            $fields_to_update[] = "nic='$branch'";
        }

        if (!empty($_POST['acquittal'])) {
            $acquittal = $conn->real_escape_string($_POST['acquittal']);
            $fields_to_update[] = "acquitted_on='$acquittal'";
        }

        if (!empty($_POST['crime'])) {
            $crime = $conn->real_escape_string($_POST['crime']);
            $fields_to_update[] = "responsible_crime='$crime'";
        }

        if (!empty($_POST['ref'])) {
            $ref = $conn->real_escape_string($_POST['ref']);
            $fields_to_update[] = "case_reference_no='$ref'";
        }

        // Check if any fields are selected to update
        if (count($fields_to_update) > 0) {
            // Build the SQL query for updating
            $sql = "UPDATE prisoners SET " . implode(', ', $fields_to_update) . " WHERE id='$id'";

            if ($conn->query($sql) === TRUE) {
                echo "Prisoner information updated successfully!";
            } else {
                throw new Exception("Error updating record: " . $conn->error);
            }
        } else {
            echo "No fields were selected for update.";
        }

    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
    } finally {
        // Close connection
        if (isset($conn) && $conn) {
            $conn->close();
        }
    }
}
?>
