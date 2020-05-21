
<?php
/**
 * This example shows how to handle a simple contact form.
 */

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';


if(isset($_POST['submit'])){

    $name=$_POST['name']; // Get Name value from HTML Form
    $phone=$_POST['phone'];  // Get Mobile No
    $email=$_POST['email'];  // Get Email Value
    $message=$_POST['message']; // Get Message Value
    //Create a new PHPMailer instance
    $mail = new PHPMailer;

    try {
    //Tell PHPMailer to use SMTP - requires a local mail server
    //Faster and safer than using mail()
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'sg2plcpnl0113.prod.sin2.secureserver.net';        // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'submissions@leopride.in';                     // SMTP username
    $mail->Password   = ';a~VtLxho.5!';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Use a fixed address in your own domain as the from address
    //**DO NOT** use the submitter's address here as it will be forgery
    //and will cause your messages to fail SPF checks
    $mail->setFrom('consult@leopride.in', 'LeoPride Career Solutions');
    //Send the message to yourself, or whoever should receive contact for submissions
    $mail->addReplyTo($email);
    $mail->addCC('sharu725@gmail.com');
    //Put the submitter's address in a reply-to header
    //This will fail if the address provided is invalid,
    //in which case we should ignore the whole request

    $mail->Subject = "Enquiry from Website submitted by $name"; // This is your subject

   $mail->Body = "
    <html>
        <body>
            <table style='width:600px;'>
                <tbody>
                    <tr>
                        <td style='width:150px'><strong>Name: </strong></td>
                        <td style='width:400px'>$name</td>
                    </tr>
                    <tr>
                        <td style='width:150px'><strong>Email ID: </strong></td>
                        <td style='width:400px'>$email</td>
                    </tr>
                    <tr>
                        <td style='width:150px'><strong>Mobile No: </strong></td>
                        <td style='width:400px'>$phone</td>
                    </tr>
                    <tr>
                        <td style='width:150px'><strong>Message: </strong></td>
                        <td style='width:400px'>$message</td>
                    </tr>
                </tbody>
            </table>
        </body>
    </html>
    ";
    $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
}
?>