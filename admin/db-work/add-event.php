<?php
if (!isset($_SESSION)) {
    session_start();
}
include '../base/db.php';
$finalOutput = [];
if (isset($_POST['action'])) {
    if ($_POST['action'] == "addNewEvent") {
        extract($_POST);
        $sql = "INSERT INTO event (eventName, description, startDate, endDate, no_of_guest, price, location, homepage_popup)
        VALUES ('$eventName', '$eventDescription', '$eventStartDate', '$eventStartDate', '$eventMaxGuest', $eventPrice, '$eventLocation', 0)";
        $query = $conn->prepare($sql);
        $query->execute();
        if ($query) {
            $lastId = $conn->lastInsertId();
            $finalOutput['code'] = 203;
            // Retrieve uploaded files from form data
            if (isset($_FILES['fileToUpload'])) {
                $allFilesData = $_FILES['fileToUpload'];
                // Handle file uploads
                $uploadPath = "../../images/events/"; // Specify the directory to upload files                
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
                    $type = str_contains($fileType, "image") ?  "IMAGE" : "VIDEO";
                    // Move the uploaded file to the desired location                    
                    if (move_uploaded_file($fileTmpName, $destination)) {
                        // File upload successful
                        $fileSql = "INSERT INTO event_files (path, eventId, showcase_image, type, fileType)
                            values ('$uniqueFileName', '$lastId', $showCase, '$type','$fileExtension')
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

    if ($_POST['action'] == "addNewEventForHomepage") {
        extract($_POST);
        $sql = "INSERT INTO event (eventName, description, startDate, endDate, no_of_guest, price, location, homepage_popup)
        VALUES ('$eventName', '$eventDescription', '$eventStartDate', '$eventStartDate', '$eventMaxGuest', $eventPrice, '$eventLocation', 1)";
        $query = $conn->prepare($sql);
        $query->execute();
        if ($query) {
            $lastId = $conn->lastInsertId();
            $finalOutput['code'] = 203;
            // Retrieve uploaded files from form data
            if (isset($_FILES['fileToUpload'])) {
                $allFilesData = $_FILES['fileToUpload'];
                // Handle file uploads
                $uploadPath = "../../images/events/"; // Specify the directory to upload files                
                // Loop through each uploaded file
                for ($i = 0; $i < count($allFilesData['name']); $i++) {
                    $fileName = $allFilesData['name'][$i];
                    $fileTmpName = $allFilesData['tmp_name'][$i];
                    $fileType = $allFilesData['type'][$i];
                    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

                    // Generate a unique file name to prevent overwriting
                    $uniqueFileName = uniqid() . '_' . $fileName;
                    $destination = $uploadPath . $uniqueFileName;
                    $showCase = $i == 0 ? 1 : 0;
                    $error = 0;
                    $type = str_contains($fileType, "image") ?  "IMAGE" : "VIDEO";
                    // Move the uploaded file to the desired location                    
                    if (move_uploaded_file($fileTmpName, $destination)) {
                        // File upload successful
                        $fileSql = "INSERT INTO event_files (path, eventId, showcase_image, type, fileType)
                            values ('$uniqueFileName', '$lastId', $showCase, '$type','$fileExtension')
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

    if ($_POST['action'] == "updateEventForm") {
        extract($_POST);
        $delError = 0;
        if (isset($_POST["deletedFileIds"]) && $_POST["deletedFileIds"] != "") {
            $deletedIds = $_POST["deletedFileIds"];
            $allId = explode(',', $deletedIds);
            foreach ($allId as $delId) {
                if ($delId != "") {
                    $deleteSql = "Delete from event_files where id = $delId";
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
        $sql = "UPDATE event SET eventName = '$eventName', description = '$eventDescription', startDate = '$eventStartDate', endDate = '$eventStartDate', no_of_guest = $eventMaxGuest,price = $eventPrice,location = '$eventLocation' WHERE id = $eventId";
        $query = $conn->prepare($sql);

        $query->execute();
        if ($query) {
            $finalOutput['code'] = 203;
            $files = 0;
            if (isset($_FILES['fileToUpload'])) {

                $allFilesData = $_FILES['fileToUpload'];
                // Handle file uploads
                $uploadPath = "../../images/events/"; // Specify the directory to upload files                
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
                        $type = str_contains($fileType, "image") ?  "IMAGE" : "VIDEO";
                        // Move the uploaded file to the desired location                    
                        if (move_uploaded_file($fileTmpName, $destination)) {
                            // File upload successful
                            $fileSql = "INSERT INTO event_files (path, eventId, showcase_image, type, fileType)
                            values ('$uniqueFileName', '$eventId', $showCase, '$type','$fileExtension')
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
    if ($_POST['action'] == "deleteAdminEmail") {
        $id = $_POST['id'];
        $sql = "delete from notify_admin_email where id = $id";
        $query = $conn->prepare($sql);

        $query->execute();
        if ($query) {
            $finalOutput['code'] = 200;
        } else {
            $finalOutput['code'] = 201;
        }

        echo json_encode($finalOutput);
    }
}
