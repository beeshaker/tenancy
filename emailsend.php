<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ .'/PHPMailer-master/src/Exception.php';
require __DIR__ .'/PHPMailer-master/src/PHPMailer.php';
require __DIR__ .'/PHPMailer-master/src/SMTP.php';


// Instantiation and passing [ICODE]true[/ICODE] enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 2;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'apricotpropertylimited@gmail.com';                     // SMTP username
    $mail->Password   = '2C872fpxEyxtk42';                               // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, [ICODE]ssl[/ICODE] also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('apricotpropertylimited@gmail.com', 'Mailer');
    $mail->addAddress('abhishek@apricotproperty.com', 'Abhishek');     // Add a recipient
    
    
    $mail->addReplyTo('admin@apricotproperty.com', 'Information');
    

    // Attachments
    //$mail->addAttachment('/home/cpanelusername/attachment.txt');         // Add attachments
    //$mail->addAttachment('/home/cpanelusername/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Test';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}