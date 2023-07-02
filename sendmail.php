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
    $emailSql  ="Select address from notify_admin_email where status = 'ACTIVE'";
    $fetchEmailQuery = $conn->prepare($emailSql);
    $fetchEmailQuery->execute();
    $fetchEmailResult = $query->fetchAll(PDO::FETCH_OBJ);
    $recipients = array();

      if ($fetchEmailQuery->rowCount() > 0) {
        foreach ($fetchEmailResult as $data) {
            $address = $data->address;
            $recipients[] = array('email' => $address, 'name' => 'Vivah Nepal Admin');
        }}

foreach ($recipients as $recipient) {
    $emailAdd = $recipient['email'];
    $name = $recipient['name'];
    $mail->addAddress($emailAdd, $name);
    if($email == $emailAdd){
    $mail->Body = $message;
    }
    else{
        $mess = "
        <h2>Customer $name has booked service $eventName. The booking id is $bookingId.</h2>
        <p>They have been notified as well.</p>        
        <p>@VivahNepal 2023</p>
        <p>Kathmandu, Nepal</p>
    ";
    $mail->Body = $mess;
    }
}

    // $mail->addAddress($email, $name);
    //$mail->addReplyTo('example@gmail.com', 'Sender Name'); // to set the reply to    

    // Setting the email content
    $mail->IsHTML(true);
    $mail->Subject = $subject;
    
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
