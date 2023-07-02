<?php
if (!isset($_SESSION)) {
    session_start();
}
include('../admin/base/db.php');
if (isset($_POST['action'])) {
    $msg = $_POST['messageDev'];
    $message = "
                <p>$msg</p>
                <p style=\"color:grey;\">Vivah Nepal Team.</p>
                <p>@VivahNepal 2023</p>
                <p>Kathmandu, Nepal</p>
            ";
    $subject = "Issue Message.";
    include('../message.php');
    if ($emailSent) {
        $code = 200;
    } else {
        $code = 202;
    }
    echo json_encode(array("code" => 200));
} else {
    echo json_encode(array("code" => 201));
}
