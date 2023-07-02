<?php
if (!isset($_SESSION)) {
    session_start();
}
include '../base/db.php';
$finalOutput = [];
if (isset($_POST['action'])) {
    if ($_POST['action'] == "addAdminEmailForEmail") {
        $email = $_POST['emailAddressForAdminNotification'];
        $sqlCheck = "Select id from notify_admin_email where address = '$email'";
        $checkQuery = $conn->prepare($sqlCheck);        
        $checkQuery->execute();
        $results = $checkQuery->fetchAll(PDO::FETCH_OBJ);
        if ($checkQuery->rowCount() == 0) {
            $sql = "INSERT INTO notify_admin_email (address, status) VALUES ('$email','ACTIVE')";
            $query = $conn->prepare($sql);        
            $query->execute();
            if ($query) {            
                $finalOutput['code'] = 200;
            } else {
                $finalOutput['code'] = 201;
            }
        }
        else{
            $finalOutput['code'] = 202;
        }                

        echo json_encode($finalOutput);
    }
    if ($_POST['action'] == "setInactiveAdminEmail") {
        $id = $_POST['id'];
        $sql = "update notify_admin_email set status='INACTIVE' where id = $id ";
        $query = $conn->prepare($sql);

        $query->execute();
        if ($query) {
            $finalOutput['code'] = 200;
        } else {
            $finalOutput['code'] = 201;
        }

        echo json_encode($finalOutput);
    }
    if ($_POST['action'] == "deleteAdminEmail") {
        $id = $_POST['id'];
        $sql = "delete from notify_admin_email where id = $id";
        $query = $conn->prepare($sql);

        $query->execute();
        if ($query) {
            $finalOutput['code'] = 200;
        } else {
            $finalOutput['code'] = 201;
        }

        echo json_encode($finalOutput);
    }
    if ($_POST['action'] == "addNewAdminInSystem") {
        extract($_POST);
        $email = $_POST['adminEmail'];
        $sqlCheck = "Select id from admin where email = '$email'";
        $checkQuery = $conn->prepare($sqlCheck);        
        $checkQuery->execute();
        $results = $checkQuery->fetchAll(PDO::FETCH_OBJ);
        if ($checkQuery->rowCount() == 0) {
            $sql = "INSERT INTO admin (name, userName,password,mobile,email, role) 
            VALUES ('$adminName','$adminUsername','$adminPassword','$adminMobile','$adminEmail','$adminRole')";
            $query = $conn->prepare($sql);        
            $query->execute();
            if ($query) {            
                $finalOutput['code'] = 200;
            } else {
                $finalOutput['code'] = 201;
            }
        }
        else{
            $finalOutput['code'] = 202;
        }                

        echo json_encode($finalOutput);
    }
    if ($_POST['action'] == "updateAdminInSystem") {
        extract($_POST);
        $email = $_POST['adminEmail'];
        $adminId = $_POST['adminId'];
        $sqlCheck = "Select id from admin where (email = '$email' and id != '$adminId')";
        $checkQuery = $conn->prepare($sqlCheck);        
        $checkQuery->execute();
        $results = $checkQuery->fetch(PDO::FETCH_OBJ);        
        if ($checkQuery->rowCount() == 0) {        
        $sql = "update admin set name='$adminName', email='$email', userName='$adminUsername', password = '$adminPassword', mobile='$adminMobile', role='$adminRole', status='$adminStatus' where id = $adminId ";
        $query = $conn->prepare($sql);

        $query->execute();
        if ($query) {
            $finalOutput['code'] = 200;
        } else {
            $finalOutput['code'] = 201;
        }
        }
        else{
            $finalOutput['code'] = 202;
        }                

        echo json_encode($finalOutput);
    }
    if ($_POST['action'] == "deleteAdminFromSystem") {
        $id = $_POST['id'];
        $sql = "delete from admin where id = $id";
        $query = $conn->prepare($sql);

        $query->execute();
        if ($query) {
            $finalOutput['code'] = 200;
        } else {
            $finalOutput['code'] = 201;
        }

        echo json_encode($finalOutput);
    }
}
