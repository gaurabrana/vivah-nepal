<?php
if(!isset($_SESSION)){
session_start();
}
include '../base/db.php';
include '../upload-adImage.php';
$finalOutput = [];     

function sanitizeURL($url) {
    $url = (stripos($url, 'http://') === 0 || stripos($url, 'https://') === 0) ? $url : 'https://' . $url;
    return filter_var($url, FILTER_VALIDATE_URL) ? $url : false;
}

if (isset($_POST['submit'])) {
    $screenId = $_POST['screen-group'];
    $screenIndex = $_POST['ad-position'];
    $redirectUrl = $_POST['redirectUrl'];
    $action = $_POST['action'];

    // Sanitize and validate the URL
    if (!empty($redirectUrl)) {
        $redirectUrl = sanitizeURL($redirectUrl);
        if (!$redirectUrl) {
            $error = "URL is not valid.";
        }
    }

    $currentFileName = '';

    if ($action === 'update') {
        $currentFileName = $_POST['currentPath'];
    }

    $imagePath = [];
    if (!empty($_FILES['fileToUpload']['name'])) {
        $imagePath = uploadImage($screenId, $screenIndex);
        if ($imagePath['code'] == 200) {
            $currentFileName = $imagePath['targetDir'];
        }
    }

    if ($action === 'add') {
        $sql = "INSERT INTO ads (path, screen_id, screen_index, redirect_url) VALUES ('$currentFileName', '$screenId', '$screenIndex', '$redirectUrl')";
    } else {
        $currId = $_POST['currentId'];
        $sql = "UPDATE ads SET path = '$currentFileName', screen_id = '$screenId', screen_index = '$screenIndex', redirect_url = '$redirectUrl' WHERE id = $currId";
    }
    $query = $conn->prepare($sql);    
    $query->execute();

    $finalOutput = ['code' => ($query) ? 200 : 201];
    echo json_encode($finalOutput);
}        

    if (isset($_POST['delete'])) {  
        $id = $_POST['id'];
        $sql = "delete from ads where id = $id";
        $query = $conn->prepare($sql);

        $query->execute();
        if ($query) {
            $finalOutput['code'] = 200;
        } else {
            $finalOutput['code'] = 201;
        }

        echo json_encode($finalOutput);
    }
?>