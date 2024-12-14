<?php
// serve_file.php

$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "policeautomation";

try {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Get the case_id from the URL
    if (isset($_GET['case_id'])) {
        $case_id = $_GET['case_id'];

        // Prepare the SQL query
        $stmt = $conn->prepare("SELECT followup_evidence FROM cases WHERE case_id = ?");
        if ($stmt === false) {
            throw new Exception("SQL preparation failed: " . $conn->error);
        }

        // Bind parameters and execute the statement
        $stmt->bind_param("s", $case_id);
        if (!$stmt->execute()) {
            throw new Exception("Execution failed: " . $stmt->error);
        }

        // Store result and bind result
        $stmt->store_result();
        $stmt->bind_result($fileData);

        // Fetch the data
        if ($stmt->fetch()) {
            // Get the MIME type of the data
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->buffer($fileData);

            // Display the file based on its type
            if (strpos($mimeType, 'image/') === 0) {
                // Display image
                $base64 = base64_encode($fileData);
                echo "<img src='data:$mimeType;base64,$base64' alt='Evidence Image' style='max-width: 100%; height: auto;' />";
            } elseif (strpos($mimeType, 'audio/') === 0) {
                // Display audio player
                $base64 = base64_encode($fileData);
                echo "<audio controls>
                        <source src='data:$mimeType;base64,$base64' type='$mimeType'>
                        Your browser does not support the audio tag.
                      </audio>";
            } elseif (strpos($mimeType, 'video/') === 0) {
                // Display video player
                $base64 = base64_encode($fileData);
                echo "<video controls style='max-width: 100%;'>
                        <source src='data:$mimeType;base64,$base64' type='$mimeType'>
                        Your browser does not support the video tag.
                      </video>";
            } else {
                // Download for other file types
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="downloaded_file"');
                echo $fileData;
            }
            exit; // Prevent further output
        } else {
            throw new Exception("No file found for case_id: $case_id");
        }

        $stmt->close();
    } else {
        throw new Exception("No case_id specified.");
    }

} catch (Exception $e) {
    // Output the error message for debugging
    echo "Error: " . $e->getMessage();
} finally {
    // Close the connection if it was established
    if (isset($conn) && $conn instanceof mysqli) {
        $conn->close();
    }
}
?>
