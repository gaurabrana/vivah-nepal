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
<div class="main-container">
  <section class="card p-3">
    <h4>Gallery Files</h4><br />
    <div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Images
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body existing-gallery-image-holder">
      
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Videos
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body existing-gallery-video-holder gallery">
      
      </div>
    </div>
  </div>  
</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
  Fancybox.bind('[data-fancybox="gallery-video"]', {
    //
    on: {
      init: () => {
        console.log('Fancybox has started initializing');
        // Your code here...
       
      },
      destroy: (fancybox) => {
        console.log('Fancybox was destroyed!');
       
      },
    }
  });
</script>
<?php
include("base/footer.php");
?>