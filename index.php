<?php
include "base/header.php";
include 'admin/base/db.php';
include 'ad-container.php';
$bannerSql = "SELECT hero_image FROM pages where id = 1";
$bannerQuery = $conn->prepare($bannerSql);
$bannerQuery->execute();
$bannerResult = $bannerQuery->fetch(PDO::FETCH_OBJ);
if ($bannerResult) {
$name = $bannerResult->hero_image;
$path = "images/hero-image/$name";
}
else{
$path = "promo.mp4";    
}
?>
<link href="css/home.css" rel="stylesheet" type="text/css">
<!-- END nav -->

<!-- <div class="overlay"></div> -->
<div id="hero">
  <div class="texture"></div>
  <video loop muted autoplay playsinline preload="auto">    
    <source src="<?php echo $path; ?>" type="video/mp4">
    Your browser does not support the video tag.
  </video>
  <div class="caption">

    <div class="one-forth ftco-animate slider-text align-self-md-center" data-scrollax=" properties: { translateY: '70%' }">
      <h1 class="mb-4">
        <strong class="typewrite" data-period="4000" data-type='[ "Wedding Photo & Video", "Wedding Services", "Family Rituals", "Event Management" ]'>
          <span class="wrap"></span>
        </strong>
      </h1>
      <p class="mb-md-5 mb-sm-3" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Capturing moments. Creating memories. Vivah Nepal - Your one-stop wedding and event services provider.</p>
    </div>
  </div>
</div>
<section>
  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="ad-Container">
        <?php
        $adsSql = "SELECT path,screen_index,redirect_url FROM ads where screen_id = 1";
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
</section>
<section class="ftco-section bg-light">
  <div class="container">
    <div class="row justify-content-center mb-5 pb-5">
      <div class="col-md-7 text-center heading-section ftco-animate">
        <h2 class="mb-3">Our Best Pricing</h2>
        <span class="subheading">Pricing Plans</span>
      </div>
    </div>
    <div class="row">
      <?php
      $sql = "SELECT * FROM packages";
      $query = $conn->prepare($sql);
      $query->execute();
      $results = $query->fetchAll(PDO::FETCH_OBJ);

      if ($query->rowCount() > 0) {
        foreach ($results as $result) {
          $id = $result->id;
          $name = $result->name;
          if (count(explode(' ', $name)) > 2) {
            $changedName = explode(' ', $name)[0] . " " . explode(' ', $name)[1];
          } else {
            $changedName = explode(' ', $name)[0];
          }
          $description = $result->description;
          $price = $result->price;
          $discount = $result->discount;
          echo '<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 ftco-animate">
                  <div class="block-7">
                    <div class="text-center">
                    <h2 class="heading">' . $changedName . '</h2>
                    <span class="price"><sup>Rs</sup> <span class="number">' . $price . '</span></span>
                    <span class="excerpt d-block">100% free. Forever</span>
                    <a href="#" class="btn btn-primary btn-outline-primary d-block px-2 py-3 mb-4">View</a>
                    
                    <h3 class="heading-2 mb-4">Enjoy All The Features</h3>
                    
                    <ul class="pricing-text">
                      <li><strong>Feature</strong> Category</li>
                      <li><strong>Feature</strong> Category</li>
                      <li><strong>Feature</strong> Category</li>
                      <li>All features</li>
                    </ul>
                    </div>
                  </div>
                </div>';
        }
      }
      ?>
    </div>
  </div>
</section>
<section class="ftco-section ftco-work">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-7 text-center heading-section ftco-animate">
        <h2 class="mb-2">Recent Events</h2>
        <span class="subheading">Memories from our recent events</span>
      </div>
    </div>
    <div class="row">
      <div class="gallery">
        <?php
        $sql = "SELECT ei.path, e.description,e.eventName, e.startDate, e.location FROM event_files ei, event e WHERE e.id = ei.eventId AND e.homepage_popup = 0 AND showcase_image = true LIMIT 9";
        $query = $conn->prepare($sql);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);        

        if ($query->rowCount() > 0) {
          foreach ($results as $rowData) {

            $name = $rowData->eventName;
            $description = $rowData->description;
            $startDate = $rowData->startDate;
            $location = $rowData->location;
            $path = $rowData->path;
            echo '<div class="gallery-item">
              <img class="gallery-image" src="images/events/' . $path . '" alt="">
              <div class="contest-image-overlay">
            <span class="contest-image-overlay-text animate-text">' . $name . '</span>
          </div>
            </div>';
          }
        }
        ?>
      </div>
    </div>
  </div>
</section>
<div class="container">
  <div class="row justify-content-center">
    <div class="ad-Container">
      <?php
      $targetIndex = 1;     
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
      <!-- <a href="https://www.facebook.com/welcometomitsubishi" target="_blank"><img src="https://www.onlinekhabar.com/wp-content/uploads/2023/04/X-D.jpg" alt=""></a> -->
    </div>
  </div>
</div>

<section class="ftco-section testimony-section bg-light">
  <div class="container">
    <div class="row justify-content-center mb-5 pb-3">
      <div class="col-md-7 text-center heading-section ftco-animate">
        <h2 class="mb-2">Testimony</h2>
        <span class="subheading">Our Happy Customer Says</span>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div data-aos="fade-down-right" class="row  ftco-animate">
      <div class="col-md-8 col-sm-6">
        <div class="carousel-testimony owl-carousel ftco-owl ml-2">
          <div class="item">
            <div class="testimony-wrap p-4 pb-5">
              <div class="user-img mb-5" style="background-image: url(images/person_1.jpg)">
                <span class="quote d-flex align-items-center justify-content-center">
                  <i class="icon-quote-left"></i>
                </span>
              </div>
              <div class="text text-center">
                <p class="mb-5">Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>
                <p class="name">Dennis Green</p>
                <span class="position">Marketing Manager</span>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="testimony-wrap p-4 pb-5">
              <div class="user-img mb-5" style="background-image: url(images/person_2.jpg)">
                <span class="quote d-flex align-items-center justify-content-center">
                  <i class="icon-quote-left"></i>
                </span>
              </div>
              <div class="text text-center">
                <p class="mb-5">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                <p class="name">Dennis Green</p>
                <span class="position">Interface Designer</span>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="testimony-wrap p-4 pb-5">
              <div class="user-img mb-5" style="background-image: url(images/person_3.jpg)">
                <span class="quote d-flex align-items-center justify-content-center">
                  <i class="icon-quote-left"></i>
                </span>
              </div>
              <div class="text text-center">
                <p class="mb-5">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                <p class="name">Dennis Green</p>
                <span class="position">UI Designer</span>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="testimony-wrap p-4 pb-5">
              <div class="user-img mb-5" style="background-image: url(images/person_1.jpg)">
                <span class="quote d-flex align-items-center justify-content-center">
                  <i class="icon-quote-left"></i>
                </span>
              </div>
              <div class="text text-center">
                <p class="mb-5">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                <p class="name">Dennis Green</p>
                <span class="position">Web Developer</span>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="testimony-wrap p-4 pb-5">
              <div class="user-img mb-5" style="background-image: url(images/person_1.jpg)">
                <span class="quote d-flex align-items-center justify-content-center">
                  <i class="icon-quote-left"></i>
                </span>
              </div>
              <div class="text text-center">
                <p class="mb-5">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                <p class="name">Dennis Green</p>
                <span class="position">System Analytics</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 adDetails col-sm-6">
        <?php
        $targetIndex = 2;        
      if (isset($adImages[$targetIndex])) {
    $targetAd = $adImages[$targetIndex];
    $targetUrl = $targetAd['url'];
    $targetPath = $targetAd['path'];
    $targetImagePath = 'images/ads/' . $targetPath; // Assuming the image path is relative to the current script

    // Do something with the retrieved ad data
    // For example, you can use the variables $targetUrl, $targetImagePath to display or process the data
    echo '<div class="ad-Container mb-2"><a href="' . $targetUrl . '" target="_blank"><img src="' . $targetImagePath . '" alt=""></a></div>';
}
    $targetIndex = 3;        
      if (isset($adImages[$targetIndex])) {
    $targetAd = $adImages[$targetIndex];
    $targetUrl = $targetAd['url'];
    $targetPath = $targetAd['path'];
    $targetImagePath = 'images/ads/' . $targetPath; // Assuming the image path is relative to the current script

    // Do something with the retrieved ad data
    // For example, you can use the variables $targetUrl, $targetImagePath to display or process the data
    echo '<div class="ad-Container mb-2"><a href="' . $targetUrl . '" target="_blank"><img src="' . $targetImagePath . '" alt=""></a></div>';
}
?>        
      </div>
    </div>
  </div>
</section>
<!-- Button trigger modal -->
<button id="demoButton" hidden type="button" class="btn btn-primary" data-toggle="modal" data-target="#highlightedEventPopup">
  event model
</button>

<!-- Modal -->
<div class="modal fade" id="highlightedEventPopup" tabindex="-1" role="dialog" aria-labelledby="highlightedEventPopupTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <?php
          $sql = "SELECT ei.path, e.id, ei.type FROM event_files ei, event e WHERE e.id = ei.eventId AND e.homepage_popup = true";
          $query = $conn->prepare($sql);
          $query->execute();
          $results = $query->fetchAll(PDO::FETCH_OBJ);
          // function getEventHighlights($ribbon, $name, $description, $location, $startdate, $imagePath, $size)

          if ($query->rowCount() > 0) {
            $index = 0;
            foreach ($results as $rowData) {
              $index++;
              $path = $rowData->path;
              $extension = explode('.', $path)[1];
              $type = $rowData->type;
              if ($index == 1) {
                $class = "active";
              } else {
                $class = "";
              }
              if ($type == "IMAGE") {
                echo '<div class="carousel-item ' . $class . '">
            <a href="booking-services.php?type=event&id=' . $rowData->id . '">
            <img class="d-block w-100" src="images/events/' . $path . '" alt="First slide">
            </a>
          </div>';
              }
            }
          }
          ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </div>
</div>
<?php
include('base/footer.php');
?>