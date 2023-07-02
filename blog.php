<?php
include "base/header.php";
include 'admin/base/db.php';
$breadCrumbName = "Blog";
include('getHeroBanner.php');
?>
<?php
$pageId = 6;
$child = '<div class="overlay"></div>
<div class="container-fluid">
  <div class="row no-gutters d-flex slider-text align-items-center justify-content-center" data-scrollax-parent="true">
    <div class="col-md-6 ftco-animate text-center" data-scrollax=" properties: { translateY: \'70%\' }">
      <p class="breadcrumbs" data-scrollax="properties: { translateY: \'30%\', opacity: 1.6 }"><span class="mr-2"><a href="index.php">Home</a></span> <span>'.$breadCrumbName.'</span></p>
      <h1 class="mb-3 bread" data-scrollax="properties: { translateY: \'30%\', opacity: 1.6 }">'.$breadCrumbName.'</h1>
    </div>
  </div>
</div>';
getBannerByPageId($conn, $pageId, $child);
?>
    <section class="ftco-section bg-light">
      <div class="container">
        <div class="row">
          <?php                    

          $sql = "SELECT * from blog";

          $query = $conn->prepare($sql);

          $query->execute();

          $results = $query->fetchAll(PDO::FETCH_OBJ);
          
          if ($query->rowCount() > 0) {
              foreach ($results as $result) {
                $id = $result->id;
                $title = $result->title;
                $description = $result->description;
                $keywords = $result->keywords;
                $imagePath = $result->path;
                $modifiedDate = $result->modified;                
                    $timestamp = strtotime($modifiedDate);
                    $formattedDateTime = date("Y F j, h:i A", $timestamp);
                echo'<div class="col-md-4 ftco-animate">
          <div class="blog-entry">
            <a href="blog-single.php?id='.$id.'" class="block-20" style="background-image: url(\'./images/blog/'.$imagePath.'\');">
            </a>
            <div class="text p-4 d-block">
              <div class="meta mb-3">
                <div><a href="#">'.$formattedDateTime.'</a></div>
                <div><a href="#">'.$keywords.'</a></div>                
              </div>
              <h3 class="heading"><a href="#">'.$title.'</a></h3>
            </div>
          </div>
        </div>';
              }}
          ?>                   
        </div>
        <div class="row mt-5">
          <div class="col text-center">
            <div class="block-27">
              <ul>
                <li><a href="#">&lt;</a></li>
                <li class="active"><span>1</span></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">&gt;</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
    

    <?php
  include('base/footer.php');
    ?>