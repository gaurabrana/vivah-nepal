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
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->Username = 'networkedappetite@gmail.com'; // YOUR gmail email
    $mail->Password = 'vqbzezyfaiarozck'; // YOUR gmail password

    $sendingFrom = "networkedappetite@gmail.com";
    // Sender and recipient settings
    $mail->setFrom($sendingFrom, 'Vivah Nepal');
    // Add the recipients
    $mail->Body = $message;
    $mail->addAddress("gaurabrana00@gmail.com", "Gaurab Rana");
    //$mail->addReplyTo('example@gmail.com', 'Sender Name'); // to set the reply to    

    // Setting the email content
    $mail->IsHTML(true);
    $mail->Subject = $subject;
    
    $mail->AltBody = 'Issue Message.';
    if($mail->send()){
        $emailSent = true;
    }    
} catch (Exception $e) {    
    if(!isset($isUpdateProfile)){
        $code = 203;        
    }
    echo $e;
}
