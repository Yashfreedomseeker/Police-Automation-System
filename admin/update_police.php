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

        if (!empty($_POST['doe'])) {
            $doe = $conn->real_escape_string($_POST['doe']);
            $fields_to_update[] = "date_joined='$doe'";
        }

        if (!empty($_POST['position'])) {
            $position = $conn->real_escape_string($_POST['position']);
            $fields_to_update[] = "position='$position'";
        }

        if (!empty($_POST['nic'])) {
            $branch = $conn->real_escape_string($_POST['nic']);
            $fields_to_update[] = "nic='$branch'";
        }

        if (!empty($_POST['contact'])) {
            $contact = $conn->real_escape_string($_POST['contact']);
            $fields_to_update[] = "mobile='$contact'";
        }

        if (!empty($_POST['promotion'])) {
            $promotion = $conn->real_escape_string($_POST['promotion']);
            $fields_to_update[] = "promotions='$promotion'";
        }

        if (!empty($_POST['address'])) {
            $address = $conn->real_escape_string($_POST['address']);
            $fields_to_update[] = "address='$address'";
        }

        // Check if any fields are selected to update
        if (count($fields_to_update) > 0) {
            // Build the SQL query for updating
            $sql = "UPDATE police_profiles SET " . implode(', ', $fields_to_update) . " WHERE police_id='$id'";

            if ($conn->query($sql) === TRUE) {
                echo "Police officer information updated successfully!";
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
