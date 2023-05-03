<?php
if(isset($_POST['filepath'])){
    $filepath = $_POST['filepath'];
    if (!unlink($filepath)) { 
        echo json_encode(array("statusCode" => 201));
    } 
    else { 
        echo json_encode(array("statusCode" => 200));
    } 
}
?>