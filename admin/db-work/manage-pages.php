<?php
if(!isset($_SESSION)){
session_start();
}
include '../base/db.php';
include '../upload-adImage.php';
$finalOutput = [];     
if (isset($_POST['addNew'])) {
    $screenId = $_POST['screen-group'];
    $screenIndex = $_POST['ad-position'];    
    $redirectUrl = $_POST['redirectUrl'];    

    
    $imagePath[] = [];
    if($_FILES['fileToUpload'] != null ){        
        $imagePath = uploadImage($screenId, $screenIndex);        
        // Check if image upload was successful        
    }    
    if ($imagePath['statusCode'] == 200) {
        $target_dir = $imagePath['targetDir'];     
        $sql = "INSERT INTO ads (path, screen_id, screen_index, redirect_url) VALUES (:pathImage, :screen_id, :screen_index, :redirect_url)";

        $query = $conn->prepare($sql);
        // Bind the parameters and execute the query
        $query->bindParam(':pathImage', $target_dir, PDO::PARAM_STR);
        $query->bindParam(':screen_id', $screenId, PDO::PARAM_STR);    
        $query->bindParam(':screen_index', $screenIndex, PDO::PARAM_STR);
        $query->bindParam(':redirect_url', $redirectUrl, PDO::PARAM_STR);
    
    
        $query->execute();
        if($query){
            $finalOutput['code'] = 200;
        }        
        else{
            $finalOutput['code'] = 201;
        }
    }
    else{
        $finalOutput['code'] = 202;
    }
    echo json_encode($finalOutput);
}
if (isset($_POST['addNewHeroImage'])) {
    $screenId = $_POST['screen-group'];
    $screenIndex = $_POST['ad-position'];    
    $redirectUrl = $_POST['redirectUrl'];    

    
    $imagePath[] = [];
    if($_FILES['fileToUpload'] != null ){        
        $imagePath = uploadImage($screenId, $screenIndex);        
        // Check if image upload was successful        
    }    
    if ($imagePath['statusCode'] == 200) {
        $target_dir = $imagePath['targetDir'];     
        $sql = "INSERT INTO ads (path, screen_id, screen_index, redirect_url) VALUES (:pathImage, :screen_id, :screen_index, :redirect_url)";

        $query = $conn->prepare($sql);
        // Bind the parameters and execute the query
        $query->bindParam(':pathImage', $target_dir, PDO::PARAM_STR);
        $query->bindParam(':screen_id', $screenId, PDO::PARAM_STR);    
        $query->bindParam(':screen_index', $screenIndex, PDO::PARAM_STR);
        $query->bindParam(':redirect_url', $redirectUrl, PDO::PARAM_STR);
    
    
        $query->execute();
        if($query){
            $finalOutput['code'] = 200;
        }        
        else{
            $finalOutput['code'] = 201;
        }
    }
    else{
        $finalOutput['code'] = 202;
    }
    echo json_encode($finalOutput);
}
?>