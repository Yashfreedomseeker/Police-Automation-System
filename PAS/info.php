<?php
$postData = $uploadedFile = $statusMsg = '';
$msgClass = 'errordiv';
if(isset($_POST['submit'])){

    $email = $_POST['email'];


    if(!empty($email)){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)===false){
            $statusMsg = 'Please enter a valid email.';
        }
        else{
            $uploadStatus = 1;

            // if(!empty($_FILES["file"]["name"])){

            //     $uploads_dir =  __DIR__ . '/attachmentfile';
            //     $tname = $_FILES["file"]["tmp_name"];
            //     $targetFilePath = $uploads_dir . $tname;
            //     $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            //     if(move_uploaded_file($_FILES["file"].$targetFilePath)){
            //         $uploadedFile = $targetFilePath;
            //     }
            //     else{
            //         $uploadStatus = 0;
            //         $statusMsg = "Sorry there was an error uploading your file";
            //     }

            // }
            if($uploadStatus == 1){
                $toEmail = 'trashcan21st@gmail.com';
                $from = $email;
                $fromName = 'New complaint from '. $cname;
                $subject = 'complaint: '.$complaintsubject;
        
                $htmlContent = '<h2>Complaint submitted</h2>
                                <p>District: '.$district.'</p>
                                <p>Police Station: '.$policestation.'</p>
                                <p>Complaint category: '.$complaintcategory.'</p>
                                <p>Name: '.$cname.'</p>
                                <p>Address: '.$address.'</p>
                                <p>NIC: '.$nicnumber.'</p>
                                <p>Telephone no: '.$contactnumber.'</p>
                                <p>Complaint: '.$complaint.'</p>';
                    
                $headers = "From: $fromName"." <".$from.">";

                if(!empty($uploadedFile) && file_exists($uploadedFile)){ // $uploadedFile = $tname
                    $semi_rand = md5(time());
                    $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

                    //headers for attachment
                    $headers .= "\nMIME-version: 1.0\n"."Content-Type: multiple/mixed;\n"." boundary=\"{$mime_boundary}\"";
                    $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" . "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";  
            
                    // Preparing attachment 
                    if(is_file($uploadedFile)){ 
                        $message .= "--{$mime_boundary}\n"; 
                        $fp =    @fopen($uploadedFile,"rb"); 
                        $data =  @fread($fp,filesize($uploadedFile)); 
                        @fclose($fp); 
                        $data = chunk_split(base64_encode($data)); 
                        $message .= "Content-Type: application/octet-stream; name=\"".basename($uploadedFile)."\"\n" .  
                        "Content-Description: ".basename($uploadedFile)."\n" . 
                        "Content-Disposition: attachment;\n" . " filename=\"".basename($uploadedFile)."\"; size=".filesize($uploadedFile).";\n" .  
                        "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n"; 
                    } 
            
                    $message .= "--{$mime_boundary}--"; 
                    $returnpath = "-f" . $email; 
                    
                    // Send email 
                    $mail = mail($toEmail, $emailSubject, $message, $headers, $returnpath); 
                    
                    // Delete attachment file from the server 
                    @unlink($uploadedFile); 
                }
                else{ 
                    // Set content-type header for sending HTML email 
                    $headers .= "\r\n". "MIME-Version: 1.0"; 
                    $headers .= "\r\n". "Content-type:text/html;charset=UTF-8"; 
                    
                    // Send email 
                    $mail = mail($toEmail, $emailSubject, $htmlContent, $headers);  
                } 
     
                // If mail sent 
                if($mail){ 
                    $statusMsg = 'Thanks! Your contact request has been submitted successfully.'; 
                    $msgClass = 'succdiv'; 
                    
                    $postData = ''; 
                }
                else{ 
                    $statusMsg = 'Failed! Something went wrong, please try again.'; 
                } 
        
            }
            else{ 
                $valErr = !empty($valErr)?'<br/>'.trim($valErr, '<br/>'):''; 
                $statusMsg = 'Please fill all the mandatory fields.'.$valErr; 
            }
        
        }
    }
}
else{ 
    $valErr = !empty($valErr)?'<br/>'.trim($valErr, '<br/>'):''; 
    $statusMsg = 'Please fill all the mandatory fields.'.$valErr; 
}



?>
