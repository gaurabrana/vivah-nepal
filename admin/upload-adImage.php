<?php
function uploadImage($screenName, $screenIndex)
{
    $target_dir = "../../images/ads/";
    $output['message'] = '';
    $output['statusCode'] = '';
    $output['targetDir'] = '';
    $screenNameWord = "";

    switch ($screenName) {
        case 1:
            $screenNameWord  = "Homepage Screen";
            break;
        case 2:
            $screenNameWord  = "Family Ritual Screen";
            break;
        case 3:
            $screenNameWord  = "Event Management Screen";
            break;
        case 4:
            $screenNameWord  = "Wedding Service Screen";
            break;
        case 5:
            $screenNameWord = "Blog Screen";
            break;
    }
    if (!file_exists($target_dir.$screenNameWord)) {
        // Create folder
        mkdir($target_dir.$screenNameWord, 0777, true);
    }
    $target_dir = $target_dir.$screenNameWord."/".$screenIndex.'/';
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        $output['message'] = '';
    } else {
        $output['message'] = "File is not an image.";
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $output['message'] =  "Sorry, file already exists.";
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 2048000) {
        $output['message'] =  "Sorry, your file is too large.";
    }

    // Allow only certain file formats
    if ($imageFileType != "gif") {
        $output['message'] =  "Sorry GIF files are allowed.";
    }

    // Check if $uploadOk is set to 0 by an error
    if ($output['message'] == '') {        
        // Check if folder exists
        if (!file_exists($target_dir)) {
            // Create folder
            mkdir($target_dir, 0777, true);
        }
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $output['statusCode'] = 200;
            $output['targetDir'] = $target_file;            
        } else {
            $output['message'] = "Sorry, there was an error uploading your file.";
        }
    }
    return $output;
}
