<?php
if(isset($_POST['action'])){
    include('connect.php');
    $membershipid = $_POST['id'];
    if(!isset($_SESSION['id'])){
        echo json_encode(array("statusCode" => 202));
        exit(); 
    }    
    $userid = $_SESSION['id'];
    $date = date("Y-m-d h:i:s A");
    if($_POST['action']=="addMembership"){
        // check membership exist or not    
        $userhaspackagechecksql = "Select package_id from membership where user_id = '$userid' and membership.active = 'Yes'";
        $userhaspackagechecksqlResult = mysqli_query($conn, $userhaspackagechecksql);
        if(mysqli_num_rows($userhaspackagechecksqlResult) == 0){
            // sql for adding membership to the user
            $sql = "Insert into membership values ('', '$membershipid','$userid', '$date', 'No', 'Yes')";
            $result = mysqli_query($conn, $sql);
            if($result){
                echo json_encode(array("statusCode" => 200));
            }
            else{
                echo json_encode(array("statusCode" => 201));
            }
        }    
        else{
            echo json_encode(array("statusCode" => 203));
        }
    }
    else if($_POST['action']=="updateMembership"){

    }
 
}
?>