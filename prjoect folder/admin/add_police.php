<?php
// Database connection details
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = "1234"; // Replace with your database password
$dbname = "policeautomation"; // Replace with your database name

try {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    if (isset($_POST["submit"])){
        // Retrieve form data
        $nic = $_POST['nic'];
        $name = $_POST['name'];
        $mobile = $_POST['mobile'];
        $dob = $_POST['dob'];
        $date_of_enrolled = $_POST['date_of_enrolled'];
        $position = $_POST['position'];
        $promotion = $_POST['promotion_details'];
        $address = $_POST['address'];
        $pass = $_POST['password'];
        $confirm = $_POST['confirm'];

        if ($pass === $confirm) {
            // Hash the password using bcrypt
            $hashedPassword = password_hash($pass, PASSWORD_BCRYPT);
        }
        else {
            throw new Exception("Passwords do not match. Please try again.");
        }
        // Prepare the SQL INSERT query
        $sql = "INSERT INTO police_profiles(nic, name, mobile, birthday, address, date_joined, position, promotions, password) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Prepare and bind the statement
        $stmt = $conn->prepare($sql);
        
        if (!$stmt) {
            throw new Exception("Prepare statement failed: " . $conn->error);
        }

        $stmt->bind_param("sssssssss", $nic, $name, $mobile, $dob, $address, $date_of_enrolled, $position, $promotion, $hashedPassword);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Police officer added successfully.";
        } else {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }

} catch (Exception $e) {
    // Handle the error by displaying the error message
    echo "Error: " . $e->getMessage();
}
?>
