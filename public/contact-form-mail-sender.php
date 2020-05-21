<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $name=$_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $message = $_POST["message"];
    $to = "sharath.dt@gmail.com";


    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'sg2plcpnl0113.prod.sin2.secureserver.net';        // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'submissions@leopride.in';                     // SMTP username
        $mail->Password   = ';a~VtLxho.5!';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('consult@leopride.in', 'LeoPride Career Solutions');
        //$mail->addAddress('sharath.dt@gmail.com', 'Shartah D T');     // Add a recipient          // Name is optional
        $mail->addReplyTo($email);
        $mail->addCC('sharath.dt@gmail.com');
        //$mail->addBCC('sharathdt@gmail.com');

        // Attachments
        //$mail->addAttachment('/home/leopridevv/public_html/leopride-website/CNAME');         // Add attachments
        //$mail->addAttachment('/php.ini');    // Optional name

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = '$subject';
        $mail->Body    = 'Name: $name<br />Email: $email<br />Phone: $phone<br />message: $message';
        $mail->AltBody = '$message';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

}