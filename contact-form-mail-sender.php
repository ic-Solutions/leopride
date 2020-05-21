
<?php
/**
 * This example shows how to handle a simple contact form.
 */

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer;

if(isset($_POST['submit'])){

    $name=$_POST['name']; // Get Name value from HTML Form
    $phone=$_POST['phone'];  // Get Mobile No
    $email=$_POST['email'];  // Get Email Value
    $message=$_POST['message']; // Get Message Value
    //Create a new PHPMailer instance


    try {
    //Tell PHPMailer to use SMTP - requires a local mail server

    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'sg2plcpnl0113.prod.sin2.secureserver.net';        // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'submissions@leopride.in';                     // SMTP username
    $mail->Password   = ';a~VtLxho.5!';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    $mail->setFrom('submissions@leopride.in', 'LeoPride Career Solutions');
    //$mail->addAddress('sharath.dt@gmail.com', 'Shartah D T');     // Add a recipient          // Name is optional
    $mail->addReplyTo('sharu725@gmail.com', 'Sharu725');
    $mail->addCC('sharath.dt@gmail.com');
    //$mail->addBCC('sharathdt@gmail.com');


    $mail->isHTML(true);    
    $mail->Subject = "Enquiry from Website submitted by $name"; // This is your subject

   $mail->Body = "$name $phone $email $message";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
}
?>