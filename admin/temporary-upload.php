<?php
$valid_formats = array("mp4", "mov", "avi", "mkv");
$max_file_size = 100*1024*1024; //100 MB
$gallery_path = "images/gallery/temp/";
$server_response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_FILES['videoFile'])) {

    // Make sure the file is a valid format and size
    $file_name = $_FILES['videoFile']['name'];
    $file_size = $_FILES['videoFile']['size'];
    $file_tmp = $_FILES['videoFile']['tmp_name'];

    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    if (!in_array($file_ext, $valid_formats)) {
        $server_response['code'] = 201;
        $server_response['message'] = "Invalid file format. Only mp4, webm, and ogg formats are allowed.";
        echo json_encode($server_response);
        exit();
    }

    if ($file_size > $max_file_size) {
        $server_response['code'] = 201;
        $server_response['message'] = "File size exceeds maximum limit of 50 MB.";
        echo json_encode($server_response);
        exit();
    }

    // Generate a unique name for the file and move it to the gallery directory
    $new_file_name = uniqid() . '.' . $file_ext;
    $target_path = $gallery_path . $new_file_name;
    if (move_uploaded_file($file_tmp, $target_path)) {
        $server_response['code'] = 200;
        $server_response['message'] = "File uploaded successfully.";
        $server_response['file_path'] = $target_path;
        echo json_encode($server_response);
        exit();
    } else {
        $server_response['code'] = 201;
        $server_response['message'] = "Error uploading file. Please try again.";
        echo json_encode($server_response);
        exit();
    }
} else {
    $server_response['code'] = 201;
    $server_response['message'] = "Invalid request.";
    echo json_encode($server_response);
    exit();
}
