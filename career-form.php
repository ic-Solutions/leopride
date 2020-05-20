<?php
// Check if the form was submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

	$name=$_POST["name"];
	$email = $_POST["email"];
	$to = "sharath.dt@gmail.com";

	// $recipients = $to.", ".$email;
	$recipients = $to;
	$headers['From']    = 'consult@leopride.in';
	$headers['To']      = $to;
	$headers['Subject'] = 'Career Form Submission';
	$headers['Cc']     = 'cc@example.com';
	$headers['Reply-To'] = $email;



	// mail($to.", ".$bcc,"My subject",$name);


    // Check if phoro was uploaded without errors
    if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["photo"]["name"];
        $filetype = $_FILES["photo"]["type"];
        $filesize = $_FILES["photo"]["size"];
    
        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
    
        // Verify file size - 5MB maximum
        $maxsize = 5 * 1024 * 1024;
        if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
    
        // Verify MYME type of the file
        if(in_array($filetype, $allowed)){
            // Check whether file exists before uploading it
            if(file_exists("uploadss/" . $filename)){
                echo $filename . " is already exists.";
            } else{
                move_uploaded_file($_FILES["photo"]["tmp_name"], "uploadss/" . $filename);
                echo "Your file was uploaded successfully.";
            } 
        } else{
            echo "Error: There was a problem uploading your file. Please try again."; 
        }
    } 

    	else{
        echo "Error: " . $_FILES["photo"]["error"];
    }





    // Check if resume was uploaded without errors
    if(isset($_FILES["resume"]) && $_FILES["resume"]["error"] == 0){
        $allowed = array("pdf", "doc", "docx");
        // $allowed = array('application/doc', 'application/pdf', 'application/docx');
        $resumename = $_FILES["resume"]["name"];
        $resumetype = $_FILES["resume"]["type"];
        $resumesize = $_FILES["resume"]["size"];
    
        // Verify file extension
        $ext = pathinfo($resumename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
    
        // Verify file size - 5MB maximum
        $maxsize = 5 * 1024 * 1024;
        if($resumesize > $maxsize) die("Error: File size is larger than the allowed limit.");
    
        // Verify MYME type of the file
        if(in_array($resumetype, $allowed)){
            // Check whether file exists before uploading it
            if(file_exists("uploadss/" . $resumename)){
                echo $resumename . " is already exists.";
            } else{
                move_uploaded_file($_FILES["resume"]["tmp_name"], "uploadss/" . $resumename);
                echo "Your file was uploaded successfully.";
            } 
        } else{
            echo "Error: There was a problem uploading your file. Please try again."; 
        }
    } else{
        echo "Error: " . $_FILES["resume"]["error"];
    }




	$bodyUs="A new profile uploaded. <br>
	Name: $name
	DOB: $dob
	Email: $email
	Phone: $phone
	Alternate Phone: $altphone
	Experience: $years years, $months months
	Address: $address
	Gender: $gender
  Photo: https://leopride.in/uploadss/$filename
  Resume: https://leopride.in/uploadss/$resumename"; 
	mail($recipients, "Career Form Submission", $bodyUs);




}
?>

