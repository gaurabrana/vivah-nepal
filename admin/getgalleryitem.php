<?php
include 'base/db.php';
if(isset($_POST['galleryImageData'])){
    $type = $_POST['type'];
    $output["data"]="";
    $sql = "SELECT * from gallery where type='$type' order by id asc";
    $query = $conn->prepare($sql);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if ($query->rowCount() > 0) {
      $index = 0;
      // Initialize the counter to zero
      $counter = 0;
      $data = "";
      foreach ($results as $result) {
        $id = $result->id;
        $path = $result->path;
        $description = $result->description;
        $folderName = $type == "image" ? "gallery-image" : "gallery-video";
        $fileType = $result->fileType;
        if($type=="image"){
            $output["data"] .= '<div class="flip-container existing-container'.$id.'">
            <div class="flipper">
            <div class="front">
                <img alt="" src="../images/'.$folderName.'/' . $path . '">
            </div>
            <div class="back" style="background-image: url(\'../images/'.$folderName.'/' . $path . '\')">
                <input type="text" hidden value="../images/'.$folderName.'/' . $path . '" id="imageForId'.$id.'"/>
                <b>About this image</b>
                <div>
                <form>
                    <div class="form-group">                    
                    <textarea id="imageDescriptionFor' . $id . '" type="text" name="description"  class="form-control">' . $description . '</textarea>
                    </div>
                </form>
                </div>              
                <a id="saveButton' . $id . '" class="btn btn-sm btn-primary galleryImageUpdate" href="javascript:void(0)">Save</a>
                <a id="deleteButton' . $id . '" class="btn btn-sm btn-danger galleryImageDelete" href="javascript:void(0)">Delete Image</a><br>
            </div>
            </div>
        </div>';
        }
        else{            
            $output["data"] .= '<div class="gallery-item" id="videoHolder'.$id.'">
        <video id="videoFile'.$id.'" controls src="../images/'.$folderName.'/'.$path.'" type="'.$fileType.'">        
        </video>
        <buton id="deleteVideoGalleryItem'.$id.'" type="button" class="btn btn-large btn-danger gallery-video-delete-button">Delete</buton>
        </div>';
        }
      }
    }
    echo json_encode($output);
}
