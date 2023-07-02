<?php
if(!isset($_SESSION)){
session_start();
}
include '../base/db.php';
$finalOutput = [];
if (isset($_POST['submit']) && isset($_POST['type'])) {
    $error = 0;
    if($_POST['type'] == "number-detail"){
        for($i=1;$i<=4;$i++){
            $name = 'detail'.$i;
            $value = $_POST[$name];
            $sql = "Update about_us_page set value=:value where id = $i";
            $query = $conn->prepare($sql);
            $query->bindParam(':value', $value, PDO::PARAM_STR);
            $query->execute(); 
            if(!$query){
            $error++;            
            }
        }
    }
    if($_POST['type'] == "company-detail"){
        for($i=1;$i<=3;$i++){
            $name = 'detail'.$i;
            $value = $_POST[$name];
            $sql = "Update company_details set description=:value where id = $i";
            $query = $conn->prepare($sql);
            $query->bindParam(':value', $value, PDO::PARAM_STR);
            $query->execute(); 
            if(!$query){
            $error++;            
            }
        }
    }

    if($error > 0){
        $finalOutput['code'] = 201;
    }
    else{
        $finalOutput['code'] = 200;
    }
    echo json_encode($finalOutput);
}
?>