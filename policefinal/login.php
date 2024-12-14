<?php
session_start();

// Database connection parameters
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = "1234"; // Replace with your database password
$dbname = "policeautomation"; // Replace with your database name

try {
    // Create a new MySQLi connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Ensure form is submitted
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Ensure fields are not empty
        if (empty($username) || empty($password)) {
            throw new Exception("Username or password cannot be empty.");
        }

        // Prepare the query to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM roles WHERE roleId = ?");
        $stmt->bind_param("s", $username);

        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if a match was found
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            $hashedPassword = $user['password'];
            
            if(password_verify($password, $hashedPassword)){
                // Store user information in session
                $_SESSION['user_id'] = $user['roleId'];
                $_SESSION['user_role'] = $user['rolename']; // 'police' or 'admin'
                // Redirect based on role
                if ($user['rolename'] == 'police') {
                    header("Location: http://localhost/police_Automation_System/PASJ/policedashboard.php");
                } elseif ($user['rolename'] == 'admin') {
                    header("Location: http://localhost/police_Automation_System/admin/admin.php");
                } else {
                    throw new Exception("Invalid user role!");
                }
            }
        } else {
            throw new Exception("Invalid username or password!");
        }

        // Close statement and connection
        $stmt->close();
    } else {
        throw new Exception("Form not submitted correctly.");
    }

} catch (Exception $e) {
    // Catch any exceptions and display the error message
    echo "Error: " . $e->getMessage();
} finally {
    // Close the connection if it's still open
    if ($conn) {
        $conn->close();
    }
}
?>
