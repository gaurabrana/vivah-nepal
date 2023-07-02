<?php
if(!isset($_SESSION)){
session_start();
}
$email = "";
$name = "";
if(!isset($_SESSION['login'])){
return;
}
else{
    $email = $_SESSION['login'];
    $name = $_SESSION['name'];
}
include('../admin/base/db.php');
if (isset($_POST['bookingType'])) {

    $isEventBooking = $_POST['bookingType'] == 'Event';

    $bookingId = mt_rand(100000000, 999999999);    
    $event_bookId = $_POST['id'];    
    $user_id = $_SESSION['user_id'];

    $eventName = $_POST['eventName'];
    $numberOfGuest = $_POST['numberOfGuest'];
    $bookingFrom = $_POST['bookingFrom'];
    $bookingTo = $_POST['bookingTo'];
    $place = $_POST['place'];
    $message = $_POST['message'];

    $bookingFrom = str_replace('/','-', $bookingFrom);
    $bookingTo = str_replace('/','-', $bookingTo);    
    

    if($isEventBooking){
        $sql = "insert into booking(bookingId,eventId,userId,eventName,numberOfGuest,bookingFrom,bookingTo,place,message)
                   values(:bookingId,:event_bookId,:user_id,:eventName,:numberOfGuest,'$bookingFrom','$bookingTo',:place,:message)";
    }
    else{
        $sql = "insert into booking(bookingId,serviceId,userId,eventName,numberOfGuest,bookingFrom,bookingTo,place,message)
                   values(:bookingId,:event_bookId,:user_id,:eventName,:numberOfGuest,'$bookingFrom','$bookingTo',:place,:message)";
    }    

    $query = $conn->prepare($sql);

    $query->bindParam(':bookingId', $bookingId, PDO::PARAM_STR);    
    $query->bindParam(':event_bookId', $event_bookId, PDO::PARAM_STR);

    $query->bindParam(':user_id', $user_id, PDO::PARAM_STR);

    $query->bindParam(':eventName', $eventName, PDO::PARAM_STR);
    $query->bindParam(':numberOfGuest', $numberOfGuest, PDO::PARAM_STR);
    // $query->bindParam(':bookingFrom', $bookingFrom, PDO::PARAM_STR);
    // $query->bindParam(':bookingTo', $bookingTo, PDO::PARAM_STR);
    $query->bindParam(':place', $place, PDO::PARAM_STR);
    $query->bindParam(':message', $message, PDO::PARAM_STR);

    // echo $sql;
    $query->execute();

    $LastInsertId = $conn->lastInsertId();

    if ($LastInsertId > 0) {                
        $message = "
                <h2>Your booking for service $eventName has been placed with booking id $bookingId.</h2>
                <p>We will notify you once we have verified your request through another email later.</p>
                <p>Thank you for connecting with us.</p>
                <p style=\"color:grey;\">Note: This is not an confirmation email.</p>
                <p>@VivahNepal 2023</p>
                <p>Kathmandu, Nepal</p>
            ";
                $subject = "Booking Placed Successfully.";
                include('../sendmail.php');
                if($emailSent){                
                    $code = 200;                                               
                }
                else{
                    $code = 202; 
                }                           
        echo json_encode(array("code" => 200,"bookid" => $event_bookId));        
    } else {
        echo json_encode(array("code" => 201,"bookid" => $event_bookId));          
    }
}
