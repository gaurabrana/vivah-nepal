<?php
if(!isset($_SESSION)){
session_start();
}
include '../base/db.php';
include '../upload-adImage.php';
$finalOutput = [];     
if (isset($_POST['submit'])) {  
    $screenId = $_POST['screen-group'];
    $screenIndex = $_POST['ad-position'];    
    $redirectUrl = $_POST['redirectUrl'];    
    
    // Add https:// to the beginning of the URL if it is not already there
    if ($redirectUrl != null) {
        if(!preg_match("~^(?:f|ht)tps?://~i", $redirectUrl)){

            $redirectUrl = "https://" . $redirectUrl;
        }
        // Check if redirectUrl is a valid URL
        if (!filter_var($redirectUrl, FILTER_VALIDATE_URL)) {
            // Return error status code
            $error = "Url is not valid.";     
        }
    }
    
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
else{
    echo "not working";
}
?>