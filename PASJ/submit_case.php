<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "policeautomation";

try{
    // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

    // Get form data
    if(isset($_POST["submit"])){
        $complainant_id = $_POST['complainant_id'];
        $case_type = $_POST['case_type'];
        $date_time = $_POST['date_time'];
        $description = $_POST['description'];
        //$evidence = $_POST['evidence'];

    // Handle file upload
        if (isset($_FILES["evidence"])) {
            if ($_FILES["evidence"]["error"] === UPLOAD_ERR_OK) {
                $attachment = $complainant_id . "-" . $_FILES["evidence"]["name"];
                $tname = $_FILES["evidence"]["tmp_name"];
                $uploads_dir = __DIR__ . '/evidence';
                $uploadedFile = $tname;
                
                if (!is_dir($uploads_dir)) {
                    mkdir($uploads_dir, 0777, true);
                }
                
                $targetFilePath = $uploads_dir . '/' . $attachment;

                if (!move_uploaded_file($tname, $targetFilePath)) {
                    $uploadStatus = 0;
                    throw new Exception('File upload failed.');
                }
            } 
            else {
                throw new Exception('File upload error. Error Code: ' . $_FILES["evidence"]["error"]);
            }
        } 
        else {
            throw new Exception('No file uploaded.');
        }

        
        // Insert data into database
        $sql = "INSERT INTO cases (case_id, case_type, date_time, evidence, description, case_status)
                VALUES ('$complainant_id', '$case_type', '$date_time', '$attachment', '$description', 'In progress')";

        if ($conn->query($sql) === TRUE) {
            $msgalert = "New case created successfully";
            echo "<script>alert('$msgalert');</script>";
            header("Location: policedashboard.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
}
catch (Exception $e) {
    $errorMessage = "Error: " . $e->getMessage() . "\nError Code: " . $e->getCode();
    $alertMessage = "Error: " . $e->getMessage() . " Error Code: " . $e->getCode();
    echo "<script>alert('$alertMessage');</script>";
    $message2 = "details are not filled properly";
    echo "<script>alert('$message2');</script>";
    error_log($errorMessage); // Logs error to server log for debugging
    echo nl2br($errorMessage); // Display error message for debugging purposes
} 
?>
