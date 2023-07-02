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
                            <h4>Add Event </h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add Event</li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <h4 class="text-blue h4">Add Event</h4>
                </div>
                <div class="wizard-content">
                    <form class="tab-wizard wizard-circle wizard" id="addNewEventForm">
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="eventName" placeholder="Event Name" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="text" class="form-control" name="eventPrice" placeholder="Event Price" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Start Date</label>
                                        <input type="date" class="form-control" id="eventStartDate" name="eventStartDate" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>End Date</label>
                                        <input type="date" class="form-control" id="eventEndDate" name="eventEndDate" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Max Guests Entry</label>
                                        <input type="number" class="form-control" id="noOfGuest" name="eventMaxGuest" placeholder="" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Location</label>
                                        <input type="text" id="eventLocation" class="form-control" name="eventLocation" placeholder="Location" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea type="text" class="form-control" name="eventDescription" required>
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
                                            <input type="file" hidden name="fileToUpload[]" id="UploadButton" onchange="previewFiles(this)" multiple>
                                        </div>
                                    </div>
                                </div>
                                <div id="hold-uploaded-files">
                                    <div class="col-md-12 hold-images">
                                        <h4 hidden>Selected Images</h4>
                                        <div class="image-row"></div>
                                    </div>
                                    <div class="col-md-12 hold-videos">
                                        <h4 hidden>Selected Videos</h4>
                                        <div class="video-row"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-list">
                                <button type="submit" name="submit" class="btn btn-success btn-lg btn-block">Add</button>
                            </div>
                        </section>
                    </form>
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