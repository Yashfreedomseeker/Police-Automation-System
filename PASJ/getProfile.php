<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "policeautomation";

// Create connection with proper error handling
try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Check if user is provided
    if (isset($_GET['user'])) {
        // Fetch the user role first from the 'roles' table
        $user = $_GET['user'];
        $sqlRole = "SELECT rolename FROM roles WHERE roleId = ?";
        $stmtRole = $conn->prepare($sqlRole);
        if (!$stmtRole) {
            throw new Exception("Prepare failed (Role): " . $conn->error);
        }

        $stmtRole->bind_param("s", $user);
        if (!$stmtRole->execute()) {
            throw new Exception("Execute failed (Role): " . $stmtRole->error);
        }

        $resultRole = $stmtRole->get_result();
        if (!$resultRole) {
            throw new Exception("Get result failed (Role): " . $stmtRole->error);
        }

        // If a valid role is found, proceed to fetch profile
        if ($resultRole->num_rows > 0) {
            $rowRole = $resultRole->fetch_assoc();
            $roleName = $rowRole['rolename'];  // 'police' or 'admin'

            if ($roleName === 'police') {
                // Fetch from police_profiles table
                $sqlProfile = "SELECT * FROM police_profiles WHERE police_id = ?";
            } elseif ($roleName === 'admin') {
                // Fetch from admin table
                $sqlProfile = "SELECT * FROM admin WHERE id = ?";
            } else {
                throw new Exception("Invalid role name provided.");
            }

            $stmtProfile = $conn->prepare($sqlProfile);
            if (!$stmtProfile) {
                throw new Exception("Prepare failed (Profile): " . $conn->error);
            }

            $stmtProfile->bind_param("s", $user);
            if (!$stmtProfile->execute()) {
                throw new Exception("Execute failed (Profile): " . $stmtProfile->error);
            }

            $resultProfile = $stmtProfile->get_result();
            if (!$resultProfile) {
                throw new Exception("Get result failed (Profile): " . $stmtProfile->error);
            }

            // Check if a valid profile is found
            if ($resultProfile->num_rows > 0) {
                $rowProfile = $resultProfile->fetch_assoc();
                echo json_encode(array("success" => true, "data" => $rowProfile, "role" => $roleName));
            } else {
                throw new Exception("No profile found for the provided user ID.");
            }

            $stmtProfile->close();

        } else {
            throw new Exception("No role found for the provided user ID.");
        }

        $stmtRole->close();

    } else {
        throw new Exception("Username not provided.");
    }

} catch (Exception $e) {
    // Catch any thrown exceptions and return the error message
    echo json_encode(array(
        "success" => false,
        "message" => $e->getMessage(),
        "error" => mysqli_error($conn) // Provides MySQL-specific error
    ));
}

// Close connection
$conn->close();
?>
