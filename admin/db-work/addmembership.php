<?php
if(isset($_POST['action'])){    
    include("connect.php");    
    foreach($_POST as $key => $value){
        if($value == ""){
            echo json_encode(array("statusCode" => 203));    
        }
    }
    extract($_POST);
    // add membership
    if($_POST['action'] == "submit"){
        $sql = "Insert into membership_packages values ('','$membershipname','$membershipprice','$membershipdiscount','$membershipdeliverycharge','$membershipCoupons','$membershipgiveaway','$membershiptype','$membershipduration','$featureditem')";
    }
    else{
        $sql = "Update membership_packages set name='$membershipname', price='$membershipprice', discount = '$membershipdiscount', delivery_charge = '$membershipdeliverycharge', coupons = '$membershipCoupons', giveaway = '$membershipgiveaway', type='$membershiptype', duration='$membershipduration', featured_item = '$featureditem' where id = '$packageid'";
    }    
    $result = mysqli_query($conn, $sql);
    if($result){
        echo json_encode(array("statusCode" => 200));
    }
    else{
        echo json_encode(array("statusCode" => 201));
    }
}
else{
    echo json_encode(array("statusCode" => 202)); 
}
?>