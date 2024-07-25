<!--data insertion part-->
<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';
require 'vendor/autoload.php';

// Database configuration
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "policeautomation";

// Enable mysqli exceptions for error handling
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check if form is submitted
        $postData = $uploadedFile = $statusMsg = '';
        $msgClass = 'errordiv';
        if (isset($_POST["submit"])) {
            $district = $_POST['district'];
            $policestation = $_POST['policestation'];
            $complaintcategory = $_POST['complaintcategory'];
            $cname = $_POST['cname'];
            $address = $_POST['address'];
            $nicnumber = $_POST['nicnumber'];
            $contactnumber = $_POST['contactnumber'];
            $complaint = $_POST['complaint'];
            $complaintsubject = $_POST['complaintsubject'];
            $notification = isset($_POST['notification']) ? 1 : 0;
            $file = $_FILES["file"] ;
            $email = $_POST['email'];
            

            if(!empty($email)){
                if(filter_var($email, FILTER_VALIDATE_EMAIL)===false){
                    $statusMsg = 'Please enter a valid email.';
                }

            if (isset($_FILES["file"])) {
                if ($_FILES["file"]["error"] === UPLOAD_ERR_OK) {
                    $attachment = rand(1000, 10000) . "-" . $_FILES["file"]["name"];
                    $tname = $_FILES["file"]["tmp_name"];
                    $uploads_dir = __DIR__ . '/attachmentfile';
                    $uploadedFile = $tname;
                    
                    if (!is_dir($uploads_dir)) {
                        mkdir($uploads_dir, 0777, true);
                    }
                    
                    $targetFilePath = $uploads_dir . '/' . $attachment;

                    if (!move_uploaded_file($tname, $uploads_dir . '/' . $attachment)) {
                        $uploadStatus = 0;
                        throw new Exception('File upload failed.');
                    }
                } 
                else {
                    throw new Exception('File upload error. Error Code: ' . $_FILES["file"]["error"]);
                }
            } 
            else {
                throw new Exception('No file uploaded.');
            }

            try {
                    // Prepare the SQL statement
                $stmt = $conn->prepare("INSERT INTO lodgecomplains (nicnumber, cname, address, Email, contactnumber, district, policestation, complaintcategory, complaintsubject, complaint, attachment) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                
                // Bind parameters
                $stmt->bind_param("sssssssssss",$nicnumber, $cname, $address, $email, $contactnumber, $district, $policestation, $complaintcategory, $complaintsubject, $complaint, $attachment);
                
                // Execute the statement
                $stmt->execute();
                
                $stmt->close();

                $stmt2 = $conn->prepare("SELECT refno FROM lodgecomplains WHERE nicnumber = ?");
                $stmt2->bind_param("s", $nicnumber);
                $stmt2->execute();
                $stmt2->bind_result($ref);
                $stmt2->fetch();
                $stmt2->close();

                $mail = new PHPMailer(true); // Create a new PHPMailer instance and enable exceptions
            
                // Server settings
                $mail->isSMTP(); // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
                $mail->SMTPAuth = true; // Enable SMTP authentication
                $mail->Username = 'trashcan21st@gmail.com'; // SMTP username
                $mail->Password = 'jshv tdlb epqh tkgm'; // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption, `PHPMailer::ENCRYPTION_SMTPS` also accepted
                $mail->Port = 587; // TCP port to connect to
            
                // Recipients
                $mail->setFrom('trashcan21st@gmail.com','Sri Lanka Police'); // Set sender of the email
                $mail->addAddress($email, $cname); // Add a recipient
            
                // Content
                $mail->isHTML(true); // Set email format to HTML
                $mail->Subject = 'complaint: '.$complaintsubject; // Email subject
                $mail->Body    ='<h2>Complaint submitted.</h2>
                                <p>Your reference number for the complaint will be: '.$ref.'</p>
                                 <p>District: '.$district.'</p>
                                 <p>Police Station: '.$policestation.'</p>
                                 <p>Complaint category: '.$complaintcategory.'</p>
                                 <p>Name: '.$cname.'</p>
                                 <p>Address: '.$address.'</p>
                                 <p>NIC: '.$nicnumber.'</p>
                                 <p>Telephone no: '.$contactnumber.'</p>
                                 <p>Complaint: '.$complaint.'</p>'; // Email body in HTML
                
                if (isset($targetFilePath) && file_exists($targetFilePath)) {
                    $mail->addAttachment($targetFilePath, 'evidence-' . htmlspecialchars($cname, ENT_QUOTES, 'UTF-8'));
                } else {
                    throw new Exception('Invalid or missing attachment file.');
                }

                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients'; // Plain text alternative for email clients that do not support HTML
            
                $mail->send(); // Send the email
                echo "<script>alert('Message has been sent');</script>"; // Success message
            } 
            catch (Exception $e) {
                echo "<script>alert('Message could not be sent. Mailer Error: {$e->getMessage()}');</script>"; // Error message
            }
            
            $message1 = "The online complaint has been accepted and the relevant parties will be informed quickly";
        }
    }
}
catch (Exception $e) {
    $errorMessage = "Error: " . $e->getMessage() . "\nError Code: " . $e->getCode();
    $alertMessage = "Error: " . $e->getMessage() . " Error Code: " . $e->getCode();
    echo "<script>alert('$alertMessage');</script>";
    $message2 = "Online complaint cannot be accepted as required information is not included";
    echo "<script>alert('$message2');</script>";
    error_log($errorMessage); // Logs error to server log for debugging
    echo nl2br($errorMessage); // Display error message for debugging purposes
} 

finally {
    if (isset($conn) && $conn instanceof mysqli) {
        $conn->close();
    }
}

?>


<!--form-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Status Form</title>
    
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script>

    function enableSubmitbtn()
            {
                document.getElementById("submitbutton").disabled=false;
            }


    </script>

</head>
<body>
    <div class="form-container">
    <h1 class="heading">Lodge Complains</h1>
        <h2>Complaints Status</h2>
        <form action="#" method="post" enctype="multipart/form-data">
            <label for="district">Your District</label>
            <select id="district" name="district">
                <option value="">Select District</option>
                <option value="Ampara">Ampara</option>
                <option value="Anuradhapura">Anuradhapura</option>
                <option value="Badulla">Badulla</option>
                <option value="Batticaloa">Batticaloa</option>
                <option value="Colombo">Colombo</option>
                <option value="Galle">Galle</option>
                <option value="Gampaha">Gampaha</option>
                <option value="Hambantota">Hambantota</option>
                <option value="Jaffna">Jaffna</option>
                <option value="Kalutara">Kalutara</option>
                <option value="Kandy">Kandy</option>
                <option value="Kegalle">Kegalle</option>
                <option value="Kilinochchi">Kilinochchi</option>
                <option value="Kurunagala">Kurunagala</option>
                <option value="Mannar">Mannar</option>
                <option value="Matale">Matale</option>
                <option value="Matara">Matara</option>
                <option value="Monaragala">Monaragala</option>
                <option value="Mulaitivu">Mulaitivu</option>
                <option value="Nuwara Eliya">Nuwara Eliya</option>
                <option value="Polonnaruwa">Polonnaruwa</option>
                <option value="Puttalam">Puttalam</option>
                <option value="Rathnapura">Rathnapura</option>
                <option value="Trincomalee">Trincomalee</option>
                <option value="Vavuniya">Vavuniya</option>
            </select>

            <label for="policestation">Nearest Police Station</label>
            <select id="policestation" name="policestation">
                <option value="">Select Police Station</option>
                <option value="Ampara">Ampara</option>
                <option value="Anuradhapura">Anuradhapura</option>
                <option value="Badulla">Badulla</option>
                <option value="Batticaloa">Batticaloa</option>
                <option value="Colombo">Colombo</option>
                <option value="Galle">Galle</option>
                <option value="Gampaha">Gampaha</option>
                <option value="Hambantota">Hambantota</option>
                <option value="Jaffna">Jaffna</option>
                <option value="Kalutara">Kalutara</option>
                <option value="Kandy">Kandy</option>
                <option value="Kegalle">Kegalle</option>
                <option value="Kilinochchi">Kilinochchi</option>
                <option value="Kurunagala">Kurunagala</option>
                <option value="Mannar">Mannar</option>
                <option value="Matale">Matale</option>
                <option value="Matara">Matara</option>
                <option value="Monaragala">Monaragala</option>
                <option value="Mulaitivu">Mulaitivu</option>
                <option value="Nuwara Eliya">Nuwara Eliya</option>
                <option value="Polonnaruwa">Polonnaruwa</option>
                <option value="Puttalam">Puttalam</option>
                <option value="Rathnapura">Rathnapura</option>
                <option value="Trincomalee">Trincomalee</option>
                <option value="Vavuniya">Vavuniya</option>
            </select>

            <label for="complaintcategory">Complaint Category</label>
            <select id="complaintcategory" name="complaintcategory">
                <option value="">Select Complaint Category</option>
                <option value="AWC">Abuse of women or children</option>
                <option value="APP">Appreciation</option>
                <option value="ARC">Archeological issue</option>
                <option value="ASS">Assault</option>
                <option value="B&C">Bribery and corruption</option>
                <option value="CAP">Complaint against police</option>
                <option value="CRO">Criminal offence</option>
                <option value="CYB">Cybercrime</option>
                <option value="DEM">Demonstration</option>
                <option value="ENV">Environment issue</option>
                <option value="EXF">Exchange fault</option>
                <option value="FEI">Foreign employment issue</option>
                <option value="CHE">Cheating</option>
                <option value="HBR">House breaking</option>
                <option value="ILM">Illegal mining</option>
                <option value="LAD">Labour dispute</option>
                <option value="INF">Information</option>
                <option value="MIS">Miscellaneous</option>
                <option value="MIF">Mischief</option>
                <option value="MUR">Murder</option>
                <option value="DRG">Drugs</option>
                <option value="NSE">National security</option>
                <option value="NAD">Natural Disaster</option>
                <option value="OFF">Offence</option>
                <option value="ORC">Organized crime</option>
                <option value="SXO">Sexual offence</option>
                <option value="SUG">Suggestion</option>
                <option value="TRH">Treasure hunting</option>
            </select>

            <label for="cname">Your Name</label>
            <input type="text" id="cname" name="cname">

            <label for="address">Address</label>
            <textarea id="address" name="address"></textarea>

            <label for="nicnumber">NIC Number</label>
            <input type="text" id="nicnumber" name="nicnumber">

            <label for="contactnumber">Contact Number</label>
            <input type="text" id="contactnumber" name="contactnumber">

            <label for="email">Email Address</label>
            <input type="email" id="email" name="email">

            <label for="complaint">Complaint</label>
            <textarea id="complaint" name="complaint"></textarea>

            <label for="complaintsubject">Complaint Subject</label>
            <input type="text" id="complaintsubject" name="complaintsubject">

            <label>
                <input type="checkbox" name="notification">
                I need notification about the status of the complaint
            </label>

            <label for="attachment">Attachment (Max size 5MB)</label>
            <input type="file" id="attachment" name="file">

            <br>
            <div class="g-recaptcha" data-sitekey="6Le-KQ8qAAAAAHpHMLdhGDXcpsFjPhFlTgS4Mail" data-callback="enableSubmitbtn"></div>
            
            
            <button type="submit" id="submitbutton" disabled="disabled" name="submit">Submit</button>

            <!--disabled="disabled"-->
            
        </form>
    </div>
</body>
</html>

