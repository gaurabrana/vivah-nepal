<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '\vendor\phpmailer\phpmailer\src\Exception.php';
require_once __DIR__ . '\vendor\phpmailer\phpmailer\src\PHPMailer.php';
require_once __DIR__ . '\vendor\phpmailer\phpmailer\src\SMTP.php';

// passing true in constructor enables exceptions in PHPMailer
$mail = new PHPMailer(true);
$emailSent = false;

try {
    // Server settings
    $mail->SMTPDebug = 0; // for detailed debug output
    $mail->isSMTP();
    $mail->Host = 'vivahnepal.com';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 465;

    $mail->Username = 'noreply@vivahnepal.com'; // YOUR gmail email
    $mail->Password = 'jcs?0pD6hpx8'; // YOUR gmail password

    $sendingFrom = "noreply@vivahnepal.com";
    // Sender and recipient settings
    $mail->setFrom($sendingFrom, 'Vivah Nepal');
    $mail->addAddress($email, $name);
    //$mail->addReplyTo('example@gmail.com', 'Sender Name'); // to set the reply to    

    // Setting the email content
    $mail->IsHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->AltBody = 'Booking notification from Vivah Nepal.';
    if($mail->send()){
        $emailSent = true;
    }    
} catch (Exception $e) {    
    if(!isset($isUpdateProfile)){
        $code = 203;        
    }
    echo $e;
}
?>