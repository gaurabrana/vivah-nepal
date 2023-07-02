<?php
if (!isset($_SESSION)) {
    session_start();
}
include '../base/db.php';
$finalOutput = [];
if (isset($_POST['action'])) {
    if ($_POST['action'] == "addNewService") {
    $serviceName = $_POST['serviceName'];
    $servicePrice = $_POST['servicePrice'];
    $servicDescription = trim($_POST['serviceDescription']);
    $serviceCategory = $_POST['serviceCategory'];


    $sql = "insert into services(serviceName,servicePrice,serviceDescription, serviceCategory)values(:serviceName,:servicePrice,:servicDescription,:serviceCategory)";

    $query = $conn->prepare($sql);

    $query->bindParam(':serviceName', $serviceName, PDO::PARAM_STR);
    $query->bindParam(':servicePrice', $servicePrice, PDO::PARAM_STR);
    $query->bindParam(':servicDescription', $servicDescription, PDO::PARAM_STR);
    $query->bindParam(':serviceCategory', $serviceCategory, PDO::PARAM_STR);

    $query->execute();
        if ($query) {
            $lastId = $conn->lastInsertId();
            $finalOutput['code'] = 203;
            // Retrieve uploaded files from form data
            if (isset($_FILES['fileToUpload'])) {
                $allFilesData = $_FILES['fileToUpload'];
                // Handle file uploads
                $uploadPath = "../../images/services/"; // Specify the directory to upload files                
                // Loop through each uploaded file
                for ($i = 0; $i < count($allFilesData['name']); $i++) {
                    $fileName = $allFilesData['name'][$i];
                    $fileTmpName = $allFilesData['tmp_name'][$i];
                    $fileType = $allFilesData['type'][$i];
                    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

                    // Generate a unique file name to prevent overwriting
                    $uniqueFileName = uniqid() . '_' . $fileName;
                    $destination = $uploadPath . $uniqueFileName;
                    $showCase = $i == 0 ? 0 : 1;
                    $error = 0;                    
                    // Move the uploaded file to the desired location                    
                    if (move_uploaded_file($fileTmpName, $destination)) {
                        // File upload successful
                        $fileSql = "INSERT INTO service_images (path, serviceId, thumbnail_image)
                            values ('$uniqueFileName', '$lastId', $showCase)
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
                }
                if ($error == 0) {
                    $finalOutput['code'] = 200;
                }
            } else {
                $finalOutput['code'] = 200;
            }
        } else {
            $finalOutput['code'] = 201;
        }

        echo json_encode($finalOutput);
    }    

    if ($_POST['action'] == "updateServiceForm") {
        extract($_POST);
        $description = trim($_POST['serviceDescription']);
        $delError = 0;
        if (isset($_POST["deletedFileIds"]) && $_POST["deletedFileIds"] != "") {
            $deletedIds = $_POST["deletedFileIds"];
            $allId = explode(',', $deletedIds);
            foreach ($allId as $delId) {
                if ($delId != "") {
                    $deleteSql = "Delete from service_images where id = $delId";
                    $deleteQuery = $conn->prepare($deleteSql);
                    $deleteQuery->execute();
                    if ($deleteQuery) {
                    } else {
                        $delError++;
                    }
                }
            }
            if ($delError > 0) {
                $finalOutput['code'] = 204;
            }
            else{
                $fileNames = $_POST['deletedFileNames'];
                $allFileNames = explode('{}', $fileNames);
                foreach($allFileNames as $file){
                    if($file != ""){
                        $destination = "../".$file;                    
                        if(file_exists($destination)){
                            unlink($destination);
                          }
                    }
                }
            }
        }        
        $sql = "UPDATE services SET serviceName = '$serviceName', serviceDescription = '$description', servicePrice = '$servicePrice', serviceCategory = '$serviceCategory' WHERE id = $serviceId";
        $query = $conn->prepare($sql);

        $query->execute();
        if ($query) {
            $finalOutput['code'] = 203;
            $files = 0;
            if (isset($_FILES['fileToUpload'])) {

                $allFilesData = $_FILES['fileToUpload'];
                // Handle file uploads
                $uploadPath = "../../images/services/"; // Specify the directory to upload files                
                // Loop through each uploaded file
                for ($i = 0; $i < count($allFilesData['name']); $i++) {
                    $fileName = $allFilesData['name'][$i];
                    if ($fileName != "") {
                        $files++;
                        $fileTmpName = $allFilesData['tmp_name'][$i];
                        $fileType = $allFilesData['type'][$i];
                        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

                        // Generate a unique file name to prevent overwriting
                        $uniqueFileName = uniqid() . '_' . $fileName;
                        $destination = $uploadPath . $uniqueFileName;
                        $showCase = $i == 0 ? 1 : 0;
                        $error = 0;                        
                        // Move the uploaded file to the desired location                    
                        if (move_uploaded_file($fileTmpName, $destination)) {
                            // File upload successful
                            $fileSql = "INSERT INTO service_images (path, serviceId, thumbnail_image)
                            values ('$uniqueFileName', '$serviceId', $showCase)
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
                }
            }
            if ($files == 0) {
                $finalOutput['code'] = 200;
            }
            echo json_encode($finalOutput);
        } else {
            $finalOutput['code'] = 201;
            echo json_encode($finalOutput);
        }
    }
}
