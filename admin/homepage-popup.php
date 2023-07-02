<?php
session_start();
if (isset($_SESSION['phpstartup_adminid'])) {
    include "base/header.php";
    include 'base/db.php';
    $username = $_SESSION['phpstartup_adminid'];    
} else {
    echo "<script> location.href='index.php'; </script>";
}
?>

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Homepage Popup For Events</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Homepage Popup For Events</li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <h4 class="text-blue h4">Manage Event</h4>
                </div>
                <div class="wizard-content">
                    <?php
                    $sql = "SELECT * from event e where homepage_popup = 1 limit 1";                    
                    $query = $conn->prepare($sql);
                    $query->execute();
                    $results = $query->fetch(PDO::FETCH_OBJ);                    
                    echo'<form class="tab-wizard wizard-circle wizard" id="updateEventForm">
                    <section>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" hidden class="form-control" name="eventId" value="'.$results->id.'" />
                                    <input type="text" class="form-control" value="'.$results->eventName.'" name="eventName" placeholder="Event Name" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="text" class="form-control" value="'.$results->price.'" name="eventPrice" placeholder="Event Price" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <input type="date" class="form-control" id="eventStartDate" value="'.$results->startDate.'" name="eventStartDate" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>End Date</label>
                                    <input type="date" class="form-control" id="eventEndDate" value="'.$results->endDate.'" name="eventEndDate" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Max Guests Entry</label>
                                    <input type="number" class="form-control" id="noOfGuest" value="'.$results->no_of_guest.'" name="eventMaxGuest" placeholder="" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Location</label>
                                    <input type="text" id="eventLocation" class="form-control" value="'.$results->location.'" name="eventLocation" placeholder="Location" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea type="text" class="form-control" name="eventDescription">
                                    '.$results->description.'
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="val-image">Event Images</label>
                                    <div>
                                        <label for="UploadButton">
                                            <div class="image-preview">
                                                <img class="addFiles" src="../images/addImagePlaceholder.png" alt="Your Image" />
                                            </div>
                                        </label>
                                        <input hidden type="file" name="fileToUpload[]" id="UploadButton" onchange="previewFiles(this)" multiple>
                                    </div>
                                </div>
                            </div>
                            <div id="hold-uploaded-files">';
                            $id = $results->id;                            
                            $fileSql = "SELECT ef.id, ef.path, ef.type, ef.fileType from event_files ef where ef.eventId = $id";
                            $fileQuery = $conn->prepare($fileSql);
							$fileQuery->execute();
							$fileResults = $fileQuery->fetchAll(PDO::FETCH_OBJ);
                            $images = [];
                            $videos = []; 
                            $imagesHidden = "hidden";
                            $videosHidden = "hidden";                      
							if ($fileQuery->rowCount() > 0) {
								foreach ($fileResults as $row) {
                                    $type = $row->type;
                                    if($type=="IMAGE"){
                                        $imagesHidden = "";
                                        array_push($images, $row);
                                    }
                                    else{
                                        $videosHidden = "";
                                        array_push($videos, $row);
                                    }
                                }}
                                echo '<div class="col-md-12 hold-images">
                                <h4 '.$imagesHidden.'>Selected Images</h4>
                                <div class="image-row">';
                                foreach($images as $data){
                                    echo'<div class="uploaded-item" id="holdItem'.$data->id.'">
                                    <img id="dataFile'.$data->id.'" src="../images/events/'.$data->path.'" alt="event image"/>                                    
                                    <button id="deleteFile'.$data->id.'" class="delete-button" type="button">Delete</button>
                                    </div>';                                    
                                }
                                echo'</div></div>';
                                echo '<div class="col-md-12 hold-videos">
                                <h4 '.$videosHidden.'>Selected Videos</h4>
                                <div class="video-row">';
                                foreach($videos as $data){      
                                    echo'<div class="uploaded-item" id="holdItem'.$data->id.'">
                                    <video class="uploaded-item" controls>
                                    <source id="dataFile'.$data->id.'" src="../images/events/'.$data->path.'" type="video/'.$data->fileType.'">
                                </video>
                                    <button id="deleteFile'.$data->id.'" class="delete-button" type="button">Delete</button>
                                    </div>';                                    
                                }
                                echo'</div></div>';
                                echo'
                                </div>
                            </div>
                        </div>
                        <div class="btn-list">
                            <input type="hidden" id="deletedFileIds" name="deletedFileIds" value="" />
                            <input type="hidden" id="deletedFileNames" name="deletedFileNames" value="" />
                            <button type="submit" name="submit" class="btn btn-success btn-lg btn-block">Update</button>
                        </div>
                    </section>
                </form>';
                    ?>
                    
                </div>
            </div>


        </div>
        <script type="text/javascript">                
            function previewFiles(input) {
                var fileArray = input.files;
                var imageContainer = document.querySelector('.hold-images .image-row');
                var videoContainer = document.querySelector('.hold-videos .video-row');
                var imageHeading = document.querySelector('.hold-images h4');
                var videoHeading = document.querySelector('.hold-videos h4');

                if(fileArray.length == 0){                    
                videoHeading.setAttribute('hidden','');
                imageHeading.setAttribute('hidden','');
                videoContainer.innerHTML = '';
                imageContainer.innerHTML = '';
                }

                for (var i = 0; i < fileArray.length; i++) {
                    var file = fileArray[i];
                    var reader = new FileReader();                    
                    reader.onload = (function(file) {
                        return function(e) {
                            var fileData = e.target.result;
                            var fileType = file.type;

                            var itemContainer = document.createElement('div');
                            itemContainer.classList.add('uploaded-item');

                            if (fileType.includes('image')) {
                                var imgElement = document.createElement('img');
                                imgElement.src = fileData;
                                itemContainer.appendChild(imgElement);
                                imageHeading.removeAttribute('hidden');
                            } else if (fileType.includes('video')) {
                                var videoElement = document.createElement('video');
                                videoElement.src = fileData;
                                videoElement.setAttribute('controls', '');
                                itemContainer.appendChild(videoElement);
                                videoHeading.removeAttribute('hidden');
                            }

                            if (fileType.includes('image')) {
                                imageContainer.appendChild(itemContainer);
                            } else if (fileType.includes('video')) {
                                videoContainer.appendChild(itemContainer);
                            }                            
                        };
                    })(file);
                    reader.readAsDataURL(file);
                }
            
            }

            var startDateInput = document.getElementById('eventStartDate');
            var endDateInput = document.getElementById('eventEndDate');

            startDateInput.addEventListener('change', function() {                
                var startDate = new Date(startDateInput.value);
                var endDate = new Date(endDateInput.value);

                if (startDate > endDate || !endDate) {
                    endDateInput.value = startDateInput.value;
                }

                // Set the minimum selectable date for the end date input
                endDateInput.min = startDateInput.value;
            });
        </script>
        <?php
        include("base/footer.php");
        ?>