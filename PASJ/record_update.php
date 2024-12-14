<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "policeautomation";

// header('Content-Type: application/json');
$response = [];

try {
    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Check if form is submitted
    if (isset($_POST["submitupdate"])) {
        $case_id = $_POST['case_id'];
        $case_status = $_POST['case_status'];

        // Check if the case_id exists in the database
        $checkSql = "SELECT case_id FROM cases WHERE case_id = ?";
        $checkStmt = $conn->prepare($checkSql);
        if (!$checkStmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        $checkStmt->bind_param("s", $case_id);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows == 0) {
            // case_id does not exist
            echo "<script>alert('Error: Case ID not found.');</script>";
            $checkStmt->close();
            $conn->close();
            exit(); // Stop further execution
        }

        $checkStmt->close();

        // Proceed with file upload and update if case_id exists
        if (isset($_FILES["evidence"]) && $_FILES["evidence"]["error"] === UPLOAD_ERR_OK) {
            $attachment = $case_id . "-" . "NEW_EVIDENCE_" . $_FILES["evidence"]["name"];
            $tname = $_FILES["evidence"]["tmp_name"];
            $uploads_dir = __DIR__ . '/evidence';

            // Create the directory if it does not exist
            if (!is_dir($uploads_dir)) {
                if (!mkdir($uploads_dir, 0777, true)) {
                    throw new Exception('Failed to create directories...');
                }
            }

            $targetFilePath = $uploads_dir . '/' . $attachment;

            // Move the uploaded file
            if (!move_uploaded_file($tname, $targetFilePath)) {
                throw new Exception('File upload failed.');
            }
        } else {
            throw new Exception('No file uploaded or file upload error.');
        }

        // Prepare and execute the SQL statement for updating the case
        $sql = "UPDATE cases SET case_status = ?, followup_evidence = ? WHERE case_id = ?";
        $stmt = $conn->prepare($sql);
        
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("sss", $case_status, $attachment, $case_id);
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        $stmt->close();

        echo "<script>alert('Update successful');</script>";
        $conn->close();
        $response['success'] = true;
        $response['message'] = 'Update successful';
    } else {
        throw new Exception('Form not submitted correctly.');
    }

} catch (Exception $e) {
    error_log($e->getMessage());
    $response['success'] = false;
    $response['message'] = $e->getMessage();
}
?>
