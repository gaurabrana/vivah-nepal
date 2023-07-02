<?php
if(!isset($_SESSION)){
session_start();
}
include '../base/db.php';
include '../upload-adImage.php';
$finalOutput = [];     
if (isset($_POST['updateHeroImage'])) {
    $pageId = $_POST['pageId'];
    $pageName = $_POST['pageName'];
    
    $imagePath[] = [];
    if($_FILES['fileToUpload'] != null ){        
        $imagePath = uploadHeroImage($pageName);        
        // Check if image upload was successful        
    }    
    if ($imagePath['code'] == 200) {
        $target_dir = $imagePath['targetDir'];     
        $sql = "Update pages set hero_image = '$target_dir' where id = '$pageId'";

        $query = $conn->prepare($sql);
        // Bind the parameters and execute the query
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
        $finalOutput['message'] = $imagePath['message'];
    }
    echo json_encode($finalOutput);
}
?>