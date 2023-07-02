<?php
include "base/header.php";
include 'admin/base/db.php';
$breadCrumbName = "About Us";
?>
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

<section class="ftco-section ftco-counter img" id="section-counter" style="background-image: url(images/bg_1.jpg);" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-11">
        <div class="row">
          <?php
          $sql = "SELECT name, value from about_us_page order by id desc ";

          $query = $conn->prepare($sql);
          $query->execute();
          $results = $query->fetchAll(PDO::FETCH_OBJ);

          if ($query->rowCount() > 0) {
            foreach ($results as $row) {
              echo '<div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                  <div class="block-18 text-center">
                    <div class="text">
                      <strong class="number" data-number="' . $row->value . '">' . $row->value . '</strong>
                      <span>' . $row->name . '</span>
                    </div>
                  </div>
                </div>';
            }
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</section>

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


<section class="ftco-section">
  <div class="container">
    <div class="row d-md-flex">
      <div class="col-md-6 ftco-animate img about-image" style="background-image: url(images/about.jpg);">
      </div>
      <div class="col-md-6 ftco-animate p-md-5">
        <div class="row">
          <div class="col-md-12 nav-link-wrap mb-5">
            <div class="nav ftco-animate nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              <?php
              $detailSql = "SELECT * from company_details";
              $detailQuery = $conn->prepare($detailSql);
              $detailQuery->execute();
              $res = $detailQuery->fetchAll(PDO::FETCH_OBJ);

              if ($detailQuery->rowCount() > 0) {
                foreach ($res as $row) {
                  $class = "";
                  $area = "false";
                  if ($row->id == 1) {
                    $class = "active";
                    $area = "true";
                  }
                  echo '<a class="nav-link ' . $class . '" id="detail' . $row->id . '-tab" data-toggle="pill" href="#detail' . $row->id . '" role="tab" aria-controls="detail' . $row->id . '" aria-selected="' . $area . '">' . $row->name . '</a>';
                }
              }
              ?>
            </div>
          </div>
          <div class="col-md-12 d-flex align-items-center">
            <div class="tab-content ftco-animate" id="v-pills-tabContent">
              <?php
              if ($detailQuery->rowCount() > 0) {
                foreach ($res as $row) {
                  $class = "";
                  if ($row->id == 1) {
                    $class = "show active";
                  }
                  echo '<div class="tab-pane fade ' . $class . '" id="detail' . $row->id . '" role="tabpanel" aria-labelledby="detail' . $row->id . '-tab">
                      <div>			                
                        <p>' . $row->description . '</p>
                      </div>
                    </div>';
                }
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="container ad-container">
  <?php
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

<section class="ftco-section testimony-section bg-light">
  <div class="container">
    <div class="row justify-content-center mb-5 pb-3">
      <div class="col-md-7 text-center heading-section ftco-animate">
        <h2 class="mb-2">Testimony</h2>
        <span class="subheading">Our Happy Customer Says</span>
      </div>
    </div>
    <div class="row justify-content-center ftco-animate">
      <div class="col-md-8">
        <div class="carousel-testimony owl-carousel ftco-owl">
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
    </div>
  </div>
</section>

<div class="container-fluid my-3">
  <div class="row" style="align-items:center;">
    <div class="col-md-9 ad-Container">
      <?php
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
    <div class="col-md-3 ad-Container">
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
    </div>
  </div>
</div>

<?php
include('base/footer.php');
?>