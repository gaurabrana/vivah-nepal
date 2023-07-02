<?php
function uploadImage($screenName, $screenIndex)
{
    $target_dir = "../../images/ads/";
    $output['message'] = '';
    $output['code'] = '';
    $output['targetDir'] = '';
    $screenNameWord = "";

    switch ($screenName) {
        case 1:
            $screenNameWord  = "HomepageScreen";
            break;
        case 3:
            $screenNameWord  = "FamilyRitualScreen";
            break;
        case 4:
            $screenNameWord  = "EventManagementScreen";
            break;
        case 2:
            $screenNameWord  = "WeddingServiceScreen";
            break;
        case 5:
            $screenNameWord = "Gallery";
            break;
        case 6:
            $screenNameWord = "BlogScreen";
            break;
    }
    if (!file_exists($target_dir . $screenNameWord)) {
        // Create folder
        mkdir($target_dir . $screenNameWord, 0777, true);
    }
    $target_dir = $target_dir . $screenNameWord . "/" . $screenIndex . '/';
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $finalNameToSave = $screenNameWord . "/" . $screenIndex . '/' . basename($_FILES["fileToUpload"]["name"]);;
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
            $output['code'] = 200;
            $output['targetDir'] = $finalNameToSave;
        } else {
            $output['message'] = "Sorry, there was an error uploading your file.";
        }
    }
    return $output;
}

function uploadHeroImage($screenName)
{
    $screenNameSQl = str_replace(' ', '%20', $screenName);
    $target_dir = "../../images/hero-image/" . $screenName . "/";
    $output['message'] = '';
    $output['code'] = '';
    $output['targetDir'] = '';
    if (!file_exists($target_dir)) {
        // Create folder
        mkdir($target_dir, 0777, true);
    }
    $imageName = basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
    $finalFileName = "banner_image." . $imageFileType;
    $target_file = $target_dir . $finalFileName;
    $nameToSave = $screenNameSQl . "/" . $finalFileName;
    // Check if image file is a actual image or fake image    

    // Check if file already exists    
    if (file_exists($target_file)) {
        unlink($target_file);
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 1048576000) {
        $output['message'] =  "Sorry, your file is too large.";
    }

    // Allow only certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "mp4" && $imageFileType != "avi" && $imageFileType != "mkv" && $imageFileType != "mov") {
        $output['message'] =  "Sorry only image files are allowed.";
    }

    // Check if $uploadOk is set to 0 by an error
    if ($output['message'] == '') {
        // Check if folder exists
        if (!file_exists($target_dir)) {
            // Create folder
            mkdir($target_dir, 0777, true);
        }
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $output['code'] = 200;
            $output['targetDir'] = $nameToSave;
        } else {
            $output['message'] = "Sorry, there was an error uploading your file.";
        }
    }
    return $output;
}
