<?php
include "base/header.php";
include 'admin/base/db.php';
include('getHeroBanner.php');
$breadCrumbName = "Gallery"
?>
<link href="css/gallery.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

<?php
$child = ' <div class="overlay"></div>
<div class="container-fluid">
  <div class="row no-gutters d-flex slider-text align-items-center justify-content-center" data-scrollax-parent="true">
    <div class="col-md-6 ftco-animate text-center" data-scrollax=" properties: { translateY: \'70%\' }">
      <p class="breadcrumbs" data-scrollax="properties: { translateY: \'30%\', opacity: 1.6 }"><span class="mr-2"><a href="index.php">Home</a></span> <span>' . $breadCrumbName . '</span></p>
      <h1 class="mb-3 bread" data-scrollax="properties: { translateY: \'30%\', opacity: 1.6 }">' . $breadCrumbName . '</h1>
    </div>
  </div>
</div>';
getBannerByPageId($conn, 5, $child);
?>
<div class="row justify-content-center">
  <h4>Highlighted Images</h4>
</div>
<div class="gallery-image card-body ">
  <?php
  $sql = "SELECT * from gallery where type  = 'IMAGE'";
  $query = $conn->prepare($sql);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_OBJ);

  if ($query->rowCount() > 0) {
    $index = 0;
    // Initialize the counter to zero
    $counter = 0;
    foreach ($results as $result) {
      $path = $result->path;
      $description = $result->description;
      echo '<a data-fancybox="gallery" data-src="images/gallery-image/' . $path . '" data-caption="' . $description . '">
        <div class="img-box">
        <img src="images/gallery-image/' . $path . '" alt="" />
        <div class="transparent-box">
          <div class="caption">
            <p>Gallery Image</p>
            <p class="opacity-low">' . $description . '</p>
          </div>
        </div> 
      </div></a>';
    }
  }
  ?>
  <!--End aside -->
</div>

<div class="row justify-content-center mb-2">
  <h4>Highlighted Videos</h4>
</div>
<div class="gallery-container">
  <div class="gallery-video gallery">
    <?php
    $sql = "SELECT * FROM gallery WHERE type = 'VIDEO'";
    $query = $conn->prepare($sql);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if ($query->rowCount() > 0) {
      $index = 0;
      // Initialize the counter to zero
      $counter = 0;
      foreach ($results as $result) {
        $path = $result->path;
        $description = $result->description;
        $type = $result->type;
        $fileType = $result->fileType;  
            
        echo '<a href="images/gallery-video/' . $path . '" data-fancybox="video-gallery">        
          <div class="gallery-item">
            <video playsinline controls controlsList="nodownload" poster="" src="images/gallery-video/' . $path . '"></video>        
          </div>
        </a>';      
      }
    }
    ?>
  </div>
</div>

<div class="urLVideos">
<div class="row justify-content-center mb-2">
  <h4>Highlighted Videos</h4>
</div>
  <p>
    <?php
    $sql = "SELECT * FROM gallery WHERE url is not null LIMIT 6";
    $query = $conn->prepare($sql);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if ($query->rowCount() > 0) {
      echo '<div class="video-gallery">';
      foreach ($results as $result) {
        $url = $result->url;
        if ($url != "") {
          echo '<a href="'.$url.'" data-fancybox="video-gallery">';
          echo '<img alt="" src="http://i3.ytimg.com/vi/tHnwV5ay8-8/hqdefault.jpg">';
          echo '</a>';
        }
      }
      echo '</div>'; // Close the video-gallery div
    }
    ?>
  </p>
</div>

<div class="container">
    <div class="row justify-content-center my-5">
      <div class="ad-Container">
        <?php
        $adsSql = "SELECT path,screen_index,redirect_url FROM ads where screen_id = 5";
        $adsQuery = $conn->prepare($adsSql);
        $adsQuery->execute();
        $adsResult = $adsQuery->fetchAll(PDO::FETCH_OBJ);
        $adImages = [];
        if ($adsQuery->rowCount() > 0) {
          foreach ($adsResult as $adData) {            
            // screen_index start from 1
            $index = $adData->screen_index;
            $path = $adData->path;
            $url = $adData->redirect_url;
            $adImages[] = [
            'index' => $index,
            'path' => $path,
            'url' => $url
            ];
          }       
        }
        $targetIndex = 0;     
        if (isset($adImages[$targetIndex])) {
    $targetAd = $adImages[$targetIndex];
    $targetUrl = $targetAd['url'];
    $targetPath = $targetAd['path'];
    $targetImagePath = 'images/ads/' . $targetPath; // Assuming the image path is relative to the current script

    // Do something with the retrieved ad data
    // For example, you can use the variables $targetUrl, $targetImagePath to display or process the data
    echo '<a href="' . $targetUrl . '" target="_blank"><img src="' . $targetImagePath . '" alt=""></a>';
}
?>
      </div>
    </div>
  </div>
<!-- End row -->
</div>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
  Fancybox.bind('[data-fancybox="video-gallery"]', {
    //
    on: {
      init: () => {
        console.log('Fancybox has started initializing');
        // Your code here...
        const header = document.querySelector('nav');
        // Remove the 'position: fixed' attribute from the header
        header.style.position = 'fixed';
      },
      destroy: (fancybox) => {
        console.log('Fancybox was destroyed!');
        const header = document.querySelector('nav');
        // Add the 'position: fixed' attribute back to the header
        header.style.position = 'fixed';
      },
    }
  });
</script>
<!-- End container -->
<?php include 'base/footer.php'; ?>