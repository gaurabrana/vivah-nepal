<?php
// (A) FILE CHECK
$result['imagePath'] = "";
$hasError = false;
if (!isset($_FILES['imageSub']['tmp_name'])) {
  $result['error'] = "No file uploaded.";
  $result['code'] = 201;
  $hasError = true;
}

// (B) IS THIS A VALID IMAGE?
if (!$hasError) {
  $allowed = ["bmp", "gif", "jpg", "jpeg", "png", "webp"];
  $ext = strtolower(pathinfo($_FILES["imageSub"]["name"], PATHINFO_EXTENSION));
  if (!in_array($ext, $allowed)) {
    $result["error"] = "$ext file type not allowed - " . $_FILES["imageSub"]["name"];
    $hasError = true;
    $result['code'] = 201;
  }
}

// (C) MOVE UPLOADED FILE OUT OF TEMP FOLDER
if (!$hasError) { 
  $directorypath = "../img/event";
  $path = createDir($directorypath);  
  $source = $_FILES["imageSub"]["tmp_name"];
  if(isset($_POST['type'])){
    $name = "mainimage.".$ext;
  }
  else{
    $name = md5($source.time()).".".$ext;
  }
  $result['imagename'] = $name;
  $result['name'] =  md5(time().$source);

  $destination = $directorypath."/".$name;  
  if(file_exists($destination)){
    unlink($destination);
  }
  if(move_uploaded_file($source, $destination)){
    $result['imagePath'] .= $destination; 
    $result['code'] = 200;
  }
  else{
    $result["error"] = "Failed to upload file ".$source.". Please try again";
    $result['code'] = 201;
  }
}
 
// (D) SERVER RESPONSE
echo json_encode($result);
function createDir($path){
  if (!file_exists($path)) {
  $old_mask = umask(0);
  mkdir($path, 0777, TRUE);
  umask($old_mask);
  return true;
  }
  else{
    return false;
  }
  
  }
?>