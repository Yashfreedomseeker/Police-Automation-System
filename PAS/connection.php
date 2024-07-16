<!--data insertion part-->
<?php

session_start();

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

            $email = $_POST['email'];

            // if(!empty($email)){
            //     if(filter_var($email, FILTER_VALIDATE_EMAIL)===false){
            //         $statusMsg = 'Please enter a valid email.';
            //     }
            //     else{
            //         $uploadStatus = 1;
            //     }

            if (isset($_FILES["file"])) {
                if ($_FILES["file"]["error"] === UPLOAD_ERR_OK) {
                    $attachment = rand(1000, 10000) . "-" . $_FILES["file"]["name"];
                    $tname = $_FILES["file"]["tmp_name"];
                    $uploads_dir = __DIR__ . '/attachmentfile';
                    
                    if (!is_dir($uploads_dir)) {
                        mkdir($uploads_dir, 0777, true);
                    } 
            
                    if (!move_uploaded_file($tname, $uploads_dir . '/' . $attachment)) {
                        //$uploadStatus = 0;
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
            
            // $toEmail = 'trashcan21st@gmail.com';
            // $from = $email;
            // $fromName = 'New complaint from '. $cname;
            // $subject = 'complaint: '.$complaintsubject;

            // $htmlContent = '<h2>Complaint submitted</h2>
            //                 <p>District: '.$district.'</p>
            //                 <p>Police Station: '.$policestation.'</p>
            //                 <p>Complaint category: '.$complaintcategory.'</p>
            //                 <p>Name: '.$cname.'</p>
            //                 <p>Address: '.$address.'</p>
            //                 <p>NIC: '.$nicnumber.'</p>
            //                 <p>Telephone no: '.$contactnumber.'</p>
            //                 <p>Complaint: '.$complaint.'</p>';
            
            // $headers = "From: $fromName"." <".$from.">";
            // if(!empty($))

            // Prepare the SQL statement
            $stmt = $conn->prepare("INSERT INTO lodgecomplains (district, policestation, complaintcategory, cname, address, nicnumber, contactnumber, Email, complaint, complaintsubject, attachment) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            
            // Bind parameters
            $stmt->bind_param("sssssssssss", $district, $policestation, $complaintcategory, $cname, $address, $nicnumber, $contactnumber, $email, $complaint, $complaintsubject, $attachment);
            
            // Execute the statement
            $stmt->execute();
            
            $stmt->close();
            $message1 = "The online complaint has been accepted and the relevant parties will be informed quickly";
            echo "<script>alert('$message1');</script>";
        }
    }
//}
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
                <option value="Abuse of women or children">Abuse of women or children</option>
                <option value="Appreciation">Appreciation</option>
                <option value="Archeological issue">Archeological issue</option>
                <option value="Assault">Assault</option>
                <option value="Bribery and corruption">Bribery and corruption</option>
                <option value="Complaint against police">Complaint against police</option>
                <option value="Criminal offence">Criminal offence</option>
                <option value="Cybercrime">Cybercrime</option>
                <option value="Demonstration">Demonstration</option>
                <option value="Environment issue">Environment issue</option>
                <option value="Exchange fault">Exchange fault</option>
                <option value="Foreign employment issue">Foreign employment issue</option>
                <option value="Cheating">Cheating</option>
                <option value="House breaking">House breaking</option>
                <option value="Illegal mining">Illegal mining</option>
                <option value="Labour dispute">Labour dispute</option>
                <option value="Information">Information</option>
                <option value="Miscellaneous">Miscellaneous</option>
                <option value="Mischief">Mischief</option>
                <option value="Murder">Murder</option>
                <option value="Drugs">Drugs</option>
                <option value="National security">National security</option>
                <option value="Natural Disaster">Natural Disaster</option>
                <option value="Offence">Offence</option>
                <option value="Organized crime">Organized crime</option>
                <option value="Sexual offence">Sexual offence</option>
                <option value="Suggestion">Suggestion</option>
                <option value="Treasure hunting">Treasure hunting</option>
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

