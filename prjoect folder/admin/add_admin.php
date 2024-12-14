<?php
// Connection settings
$servername = "localhost";
$username = "root";  // Default WAMP server username
$password = "1234";  // Default WAMP server password (adjust as needed)
$dbname = "policeautomation";  // Your database name

try {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Collect input data from the form
        $nic = $_POST['nic'];
        $name = $_POST['name'];
        $pass = $_POST['password'];
        $confirm = $_POST['confirm'];

        // Check if password and confirm password match
        if ($pass === $confirm) {
            // Hash the password using bcrypt
            $hashedPassword = password_hash($pass, PASSWORD_BCRYPT);

            // Prepare SQL statement to insert data into Admin table
            $sql = "INSERT INTO Admin (nic, name, password) VALUES (?, ?, ?)";

            // Prepare and bind statement
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("sss", $nic, $name, $hashedPassword); // "sss" for string types

                // Execute the statement
                if ($stmt->execute()) {
                    header("Location: http://localhost/police_Automation_System/admin/admin.php");
                    echo "<script>alert('New admin added successfully!')</script>";
                } else {
                    throw new Exception("Error executing statement: " . $stmt->error);
                }

                // Close the statement
                $stmt->close();
            } else {
                throw new Exception("Error preparing statement: " . $conn->error);
            }
        } else {
            // Password and confirm password do not match
            throw new Exception("Passwords do not match. Please try again.");
        }
    }
} catch (Exception $e) {
    // Handle any errors
    echo "An error occurred: " . $e->getMessage();
} finally {
    // Close the connection if it's still open
    if (isset($conn) && $conn->ping()) {
        $conn->close();
    }
}
?>
