<?php
if(!isset($_SESSION)){
session_start();
}
include '../base/db.php';
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

function uploadBlogImages()
{
    $uniqueKey = generateRandomString();    
    $target_dir = "../../images/blog/$uniqueKey/";
    $output['message'] = '';
    $output['code'] = '';
    $output['targetDir'] = '';
    if (!file_exists($target_dir)) {
        // Create folder
        mkdir($target_dir, 0777, true);
    }
    $imageName = basename($_FILES["blogImageUpload"]["name"]);
    $imageFileType = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
    $finalFileName = "blogImage.". $imageFileType;    
    $target_file = $target_dir . $finalFileName;
    $nameToSave = $uniqueKey."/".$finalFileName;
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["blogImageUpload"]["tmp_name"]);
    if ($check !== false) {
        $output['message'] = '';
    } else {
        $output['message'] = "File is not an image.";
    }

    // Check if file already exists    
    if (file_exists($target_file)) {
        unlink($target_file);       
    }

    // Check file size
    if ($_FILES["blogImageUpload"]["size"] > 8048000) {
        $output['message'] =  "Sorry, your file is too large.";
    }

    // Allow only certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {    
        $output['message'] =  "Sorry only image files are allowed.";
    }

    // Check if $uploadOk is set to 0 by an error
    if ($output['message'] == '') {        
        // Check if folder exists
        if (!file_exists($target_dir)) {
            // Create folder
            mkdir($target_dir, 0777, true);
        }
        if (move_uploaded_file($_FILES["blogImageUpload"]["tmp_name"], $target_file)) {
            $output['code'] = 200;
            $output['targetDir'] = $nameToSave;            
        } else {
            $output['message'] = "Sorry, there was an error uploading your file.";
        }
    }
    return $output;
}

$finalOutput = [];
if (isset($_POST['action'])) { 
    $error = 0; 
    if($_POST['action'] == "addNewCategory"){
        $categoryName = $_POST["newBlogCategory"];
        $sql = "Insert into blog_category (name) values ('$categoryName')";
        $query = $conn->prepare($sql);        
        $query->execute(); 
        if(!$query){
        $error++;
        }
    }
    if($_POST['action'] == "addNewBlog"){
        $name = $_POST['title'];
        $description = $_POST['description'];
        $categoryId = $_POST['blogCategorySelection'];
        $keywords = $_POST['keywords'];        
        // add image before uploading to 
        $imagePath = "";
        $data['code'] = 202;
        if(isset($_FILES['blogImageUpload']) && ($_FILES['blogImageUpload']['name'] != '')){
            $data = uploadBlogImages();            
        }
        if($data['code'] == 200){
            $imagePath = $data['targetDir'];            
        }
        $addBlogSql = "Insert into blog(title, description, keywords, path, category_id) values ('$name', '$description','$keywords', '$imagePath', '$categoryId')";
            $query = $conn->prepare($addBlogSql);        
            $query->execute(); 
            if(!$query){
            $error++;            
            }
    }
    if($_POST['action'] == "updateBlog"){
        $id = $_POST['blogid'];
        $name = $_POST['title'];
        $description = $_POST['description'];
        $categoryId = $_POST['blogCategorySelection'];
        $keywords = $_POST['keywords'];    
        $existingImageName = $_POST['existingImageName'];
        // add image before uploading to         
        $data['code'] = 202;
        if(isset($_FILES['blogImageUpload']) && ($_FILES['blogImageUpload']['name'] != '')){
            $data = uploadBlogImages();            
        }
        if($data['code'] == 200){
            $existingImageName = $data['targetDir'];                        
        }
        $addBlogSql = "Update blog set title = '$name', description = '$description', keywords = '$keywords', path='$existingImageName', category_id = '$categoryId' where id = '$id'";
            $query = $conn->prepare($addBlogSql);        
            $query->execute(); 
            if(!$query){
            $error++;            
            }
    }
    if($_POST['action'] == "deleteBlog"){

    }
    if($error > 0){
        $finalOutput['code'] = 201;
    }
    else{
        $finalOutput['code'] = 200;
    }
    echo json_encode($finalOutput);
}
