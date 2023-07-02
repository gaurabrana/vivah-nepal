<?php
if (!isset($_SESSION)) {
    session_start();
}
include '../base/db.php';
$finalOutput = [];

function uploadGalleryMedia()
{
    $target_dir = "../../images/gallery-image/";
    $output['message'] = '';
    $output['code'] = '';
    $output['targetDir'] = '';

    if (!file_exists($target_dir)) {
        // Create folder
        mkdir($target_dir, 0777, true);
    }

    $allowedExtensions = array("jpg", "jpeg", "png", "gif");
    $fileNames = array(); // initialize array to hold uploaded file names
    foreach ($_FILES["fileToUpload"]["name"] as $key => $val) {

        $imageName = basename($_FILES["fileToUpload"]["name"][$key]);

        $imageFileType = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        $target_file = $target_dir . $imageName;

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"][$key]);
        if ($check !== false) {
            $output['message'] = '';
        } else {
            $output['message'] = "File is not an image.";
            break;
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"][$key] > 1048576000) {
            $output['message'] =  "Sorry, your file is too large.";
            break;
        }

        // Allow only certain file formats
        if (!in_array($imageFileType, $allowedExtensions)) {
            $output['message'] =  "Sorry only image files are allowed.";
            break;
        }

        // Check if file already exists    
        if (file_exists($target_file)) {
            unlink($target_file);
        }

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$key], $target_file)) {
            $fileNames[] = $_FILES["fileToUpload"]["name"][$key];
        } else {
            $output['message'] = "Sorry, there was an error uploading your file.";
            break;
        }
    }
    if (!empty($fileNames)) {
        $output['fileName'] = $fileNames;
        $output['code'] = 200;
    }
    return $output;
}

function uploadGalleryVideoMedia()
{
    $target_dir = "../../images/gallery-video/";
    $output['message'] = '';
    $output['code'] = '';
    $output['fileName'] = '';

    if (!file_exists($target_dir)) {
        // Create folder
        mkdir($target_dir, 0777, true);
    }

    $allowedExtensions = array("mp4", "mov", "avi", "wmv");
    $fileNames = array(); // initialize array to hold uploaded file names
    foreach ($_FILES["fileToUpload"]["name"] as $key => $val) {

        $videoName = basename($_FILES["fileToUpload"]["name"][$key]);

        $videoFileType = strtolower(pathinfo($videoName, PATHINFO_EXTENSION));
        $target_file = $target_dir . $videoName;

        // Check if video file is a actual video or fake video
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"][$key]);
        if (!$check) {
            $output['message'] = "File is not a video.";
            break;
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"][$key] > 1048576000) {
            $output['message'] =  "Sorry, your file is too large.";
            break;
        }

        // Allow only certain file formats
        if (!in_array($videoFileType, $allowedExtensions)) {
            $output['message'] =  "Sorry only video files are allowed.";
            break;
        }

        // Check if file already exists    
        if (file_exists($target_file)) {
            unlink($target_file);
        }

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$key], $target_file)) {
            $fileNames[] = $_FILES["fileToUpload"]["name"][$key];
        } else {
            $output['message'] = "Sorry, there was an error uploading your file.";
            break;
        }
    }
    if (!empty($fileNames)) {
        $output['fileName'] = $fileNames;
        $output['code'] = 200;
    }
    return $output;
}


if (isset($_POST['newGalleryImages'])) {
    $imagePath[] = [];
    if ($_FILES['fileToUpload'] != null) {
        $imagePath = uploadGalleryMedia();
        // Check if image upload was successful        
    }
    if ($imagePath['code'] == 200) {
        $fileNames = $imagePath['fileName'];
        // loop through each file name and insert into database
        $error = 0;  
        $index = 0;      
        foreach ($fileNames as $fileName) {
            $index++;
            $valName = "descriptionValue".$index;
            $description = $_POST[$valName];
            $sql = "INSERT INTO gallery (path, type, description) VALUES ('$fileName', 'image', '$description')";
            $query = $conn->prepare($sql);
            // Bind the parameters and execute the query
            $query->execute();
            if ($query) {
            } else {
                $error++;
            }
            if ($error == 0) {
                $finalOutput['code'] = 200;
            } else {
                $finalOutput['code'] = 201;
            }
        }
    } else {
        $finalOutput['code'] = 202;
        $finalOutput['message'] = $imagePath['message'];
    }
    echo json_encode($finalOutput);
}

if (isset($_POST['newGalleryVideo'])) {
$uploadedFiles = array(); // Array to store the names of uploaded files

// Check if files were uploaded
$files = 0;

            if (isset($_FILES['videoFile'])) {

                $allFilesData = $_FILES['videoFile'];
                // Handle file uploads
                $uploadPath = "../../images/gallery-video/"; // Specify the directory to upload files                        
                // Loop through each uploaded file
                for ($i = 0; $i < count($allFilesData['name']); $i++) {
                    $fileName = $allFilesData['name'][$i];
                    if ($fileName != "") {
                        $files++;
                        $fileTmpName = $allFilesData['tmp_name'][$i];
                        $fileType = $allFilesData['type'][$i];
                        $fileSize = $allFilesData['size'][$i];
                        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

                        // Generate a unique file name to prevent overwriting
                        $uniqueFileName = uniqid() . '_' . $fileName;
                        $destination = $uploadPath . $uniqueFileName;
                        $showCase = $i == 0 ? 0 : 1;
                        $error = 0;
                        $type = str_contains($fileType, "image") ?  "IMAGE" : "VIDEO";
                        try{
                            if ($fileSize < 1048576000) {                                                                         
                                // Move the uploaded file to the desired location                    
                                if (move_uploaded_file($fileTmpName, $destination)) {
                                    
                                    $fileSql = "INSERT INTO gallery (path, type, fileType)
                                    values ('$uniqueFileName', 'video', '$fileExtension')
                                    ";
                                    $fileQuery = $conn->prepare($fileSql);
                                    $fileQuery->execute();
                                    if (!$fileQuery) {
                                        $error++;
                                    }
                                } else {
                                    // File upload failed                            
                                    $error++;
                                }
                                if ($error == 0) {
                                    $finalOutput['code'] = 200;
                                }
                            }
                            else{
                                $finalOutput['code'] = 204;
                            }
                        }
                        catch(Error){
                            $finalOutput['code'] = 204;
                            echo json_encode($finalOutput);
                            exit();
                        }                        

                    }
                }
                if ($files == 0) {
                    $finalOutput['code'] = 200;
                }
            }
            if(isset($_POST['urlSize'])){
                $size = $_POST['urlSize'];
                $urlError = 0;
                for($a = 0; $a < $size; $a++ ){
                    $val = "urlData".$a;
                    $value = $_POST[$val];
                    $fileSql = "INSERT INTO gallery (url) values ('$value')";
                    $fileQuery = $conn->prepare($fileSql);
                    $fileQuery->execute();
                    if (!$fileQuery) {
                        $urlError++;
                    }
                }
                if($urlError == 0){
                    $finalOutput['code'] = 200;
                }else{
                    $finalOutput['code'] = 205;
                }
            }
            echo json_encode($finalOutput);
        
}


    // $videoPath[] = [];
    // if ($_FILES['fileToUpload'] != null) {
    //     $videoPath = uploadGalleryVideoMedia();
    //     // Check if image upload was successful        
    
    // if ($videoPath['code'] == 200) {
    //     $fileNames = $videoPath['fileName'];
    //     // loop through each file name and insert into database
    //     $error = 0;
    //     foreach ($fileNames as $fileName) {
    //         $sql = "INSERT INTO gallery (path, type) VALUES ('$fileName', 'video')";
    //         $query = $conn->prepare($sql);
    //         // Bind the parameters and execute the query
    //         $query->execute();
    //         if ($query) {
    //         } else {
    //             $error++;
    //         }
    //         if ($error == 0) {
    //             $finalOutput['code'] = 200;
    //         } else {
    //             $finalOutput['code'] = 201;
    //         }
    //     }
    // } else {
    //     $finalOutput['code'] = 202;
    //     $finalOutput['message'] = $imagePath['message'];
    // }
    // }
    // echo json_encode($finalOutput);


if (isset($_POST['action'])) {
    $result = [];
    if ($_POST['action'] == 'updateImage') {
        // updateImage
        $description = $_POST['description'];
        $elementId = $_POST['elementId'];
        $sql = "UPDATE gallery set description = '$description' where id = '$elementId'";
        $query = $conn->prepare($sql);
        // Bind the parameters and execute the query
        $query->execute();
        if ($query) {
            $result['code'] = 200;
        } else {
            $result['code'] = 201;
        }
    }
    else if ($_POST['action'] == 'deleteImage') {
        $elementId = $_POST['elementId'];
        $path = "../".$_POST['imagePath'];
        $sql = "DELETE from gallery where id = '$elementId'";
        $query = $conn->prepare($sql);
        // Bind the parameters and execute the query
        $query->execute();
        if ($query) {
            // Check if file already exists    
        if (file_exists($path)) {
            unlink($path);
        }

            $result['code'] = 200;
        } else {
            $result['code'] = 201;
        }        
    }
    else if($_POST['action'] == "deleteVideo"){
        $elementId = $_POST['id'];
        $path = $_POST['path'];
        $sql = "DELETE from gallery where id = '$elementId'";
        $query = $conn->prepare($sql);
        // Bind the parameters and execute the query
        $query->execute();
        if ($query) {
            // Check if file already exists    
        if (file_exists($path)) {
            unlink($path);
        }

            $result['code'] = 200;
        } else {
            $result['code'] = 201;
        }        
    }
    echo json_encode($result);
}
