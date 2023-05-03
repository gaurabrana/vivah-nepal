<?php
include "base/header.php";
include 'admin/base/db.php';
$breadCrumbName = "Gallery"
?>
<link href="css/gallery.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />


<div class="hero-wrap hero-wrap-2" style="background-image: url(images/bg_2.jpg);" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container-fluid">
    <div class="row no-gutters d-flex slider-text align-items-center justify-content-center" data-scrollax-parent="true">
      <div class="col-md-6 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
        <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="index.php">Home</a></span> <span><?php echo $breadCrumbName; ?></span></p>
        <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><?php echo $breadCrumbName; ?></h1>
      </div>
    </div>
  </div>
</div>

<div class="gallery-image">  
    <?php
    $sql = "SELECT ei.path, e.eventName, e.description FROM event_images ei, event e WHERE e.id = ei.eventId AND showcase_image = true";
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
            $eventName = $result->eventName;
            
            echo'<a data-fancybox="gallery" data-src="images/events/' . $path . '" data-caption="' . $description . '">
            <div class="img-box">
            <img src="images/events/'.$path.'" alt="" />
            <div class="transparent-box">
              <div class="caption">
                <p>'.$eventName.'</p>
                <p class="opacity-low">'.$description.'</p>
              </div>
            </div> 
          </div></a>';
        }        
    }
    ?>
    <!--End aside -->
</div>

        <!-- End row -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script>
        Fancybox.bind('[data-fancybox="gallery"]', {
            //
            on: {
                init: () => {
                    console.log('Fancybox has started initializing');
                    // Your code here...
                    const header = document.querySelector('nav');

// Remove the 'position: fixed' attribute from the header
header.style.position = 'static';
                },
                destroy: (fancybox) => {
                    console.log('Fancybox was destroyed!');
                    const header = document.querySelector('header');
// Add the 'position: fixed' attribute back to the header
header.style.position = 'fixed';
                },
            }
        });
    </script>
    <!-- End container -->
    <?php include 'base/footer.php'; ?>