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
<link href="src/styles/gallery.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

<div class="main-container">
    <section class="card p-3">
        <h4>Add Video</h4><br />
        <form id="gallery-video-form" enctype="multipart/form-data">
            <div class="form-group d-flex align-items-center">
                <div>
                    <label for="image-input">
                        <div class="image-preview">
                            <img src="../images/addImagePlaceholder.png" alt="Your Image" />
                        </div>
                    </label>
                    <input hidden type="file" name="videoFile[]" id="image-input" onchange="previewImage(this)" multiple>
                </div>
                <div class="ml-auto">
                    <button type="submit" class="btn btn-lg btn-secondary">Submit</button>
                </div>
            </div>            
            <div class="video-url-links">
            <div class="row">
                <div class="col-md-6">
                <div class="form-group holdUrls">
                <label>Youtube Video Link</label>
                <input type="text" hidden class="form-control no-of-video-url" name="urlSize" placeholder="https://youtu.be/videoid">
                <input type="text" class="form-control video-url" name="urlData0" placeholder="https://youtu.be/videoid">
                </div>
                </div>
                <div class="col-md-6">
                <div class="video-container">
                    
                </div>       
                </div>
            </div>
            </div>  
            <div id="selected-videos-container">

            </div>          
        </form>        
    </section>
</div>

<script type="text/javascript">

    function previewImage(input) {
    document.querySelector('#selected-videos-container').innerHTML = '';
    if (input.files && input.files[0]) {
        for (var i = 0; i < input.files.length; i++) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var videoSrc = e.target.result;
                var video = document.createElement("video");
                video.src = videoSrc;
                video.currentTime = 25;                
                video.addEventListener("loadeddata", function() {
                    var canvas = document.createElement("canvas");
                    canvas.width = 350;
                    canvas.height = 200;
                    canvas.getContext("2d").drawImage(video, 0, 0, canvas.width, canvas.height);
                    var thumbnailSrc = canvas.toDataURL("image/jpeg");;
                    var fancyboxLink = document.createElement("a");
                    fancyboxLink.href = "javascript:void(0)";
                    // fancyboxLink.setAttribute("data-fancybox", "gallery");
                    var thumbnailImage = document.createElement("img");
                    thumbnailImage.src = thumbnailSrc;
                    fancyboxLink.appendChild(thumbnailImage);
                    document.getElementById("selected-videos-container").appendChild(fancyboxLink);
                });
            }
            reader.readAsDataURL(input.files[i]);
        }
    }
}



</script>
<?php
include("base/footer.php");
?>