
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

    $mail->setFrom('consult@leopride.in', 'LeoPride Career Solutions');
    //$mail->addAddress('sharath.dt@gmail.com', 'Shartah D T');     // Add a recipient          // Name is optional
    $mail->addReplyTo($email, $name);
    //$mail->addCC('consult@leopride.in');
    $mail->addBCC('sharu725@gmail.com');


    $mail->isHTML(true);    
    $mail->Subject = "Contact form submitted by $name"; // This is your subject

    $mail->Body = "Hi $name, <br/> We have received the following details.<br /><br />Name: $name<br />Phone: $phone<br />Email: $email<br />Message: $message<br /><br />We will get back to you as soon as possible. In case you think we missed it, please call us at 9911203280<br /><br />Thanks<br />LeoPride Career Solutions<br />https://leopride.in";
    $mail->send();
    header("Location: https://leopride.in/success.php");
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo} <br/> Please contact consult@leopride.in";

        }
}
?>