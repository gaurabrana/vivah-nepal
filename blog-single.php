<?php
include "base/header.php";
include 'admin/base/db.php';
$breadCrumbName = "Blog-single";
if(isset($_GET['id'])){
$id = $_GET['id'];
$adsSql = "SELECT path,screen_index,redirect_url FROM ads where screen_id = 6";
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
}
else{
  header('Location: blog.php');
}
?>
    <div class="hero-wrap hero-wrap-2" style="background-image: url(images/bg_2.jpg);" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container-fluid">
        <div class="row no-gutters d-flex slider-text align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-6 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
          	<p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="index.html">Home</a></span> <span class="mr-2"><a href="blog.php">Blog Detail</a></span></p>
            <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Blog Details</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section ftco-degree-bg">
      <div class="container">
        <div class="row">
          <div class="col-md-8 ftco-animate">
            <?php
            $sql = "SELECT * from blog where id = $id";

            $query = $conn->prepare($sql);
  
            $query->execute();
  
            $row = $query->fetch(PDO::FETCH_OBJ);
            
            if ($query->rowCount() > 0) {
             $path = $row->path;
             $title = $row->title;
             $description = $row->description;
             $keywords = $row->keywords;
             $modified = $row->modified;
            }
            ?>
            <h2 class="mb-3"><?php echo $title; ?></h2>
            <p>
              <img src="images/blog/<?php echo $path ?>" alt="" class="img-fluid">
            </p>
            <p><?php echo $description; ?></p>
            <div class="tag-widget post-tag-container mb-5 mt-5">
              <div class="tagcloud">
                <?php
                if (strpos($keywords, ',') !== false) {
                  $array = explode(',', $keywords);
                  foreach ($array as $keyword) {
                    echo'<a href="#" class="tag-cloud-link">'.$keyword.'</a>';  
                  }                  
                }
                else{
                echo'<a href="#" class="tag-cloud-link">'.$keywords.'</a>';  
                }
                ?>              
              </div>
            </div>
            
            <div class="about-author d-flex p-5 bg-light">
              <div class="bio align-self-md-center mr-5">
                <img src="images/logo/logo_horizontal.png" alt="Image placeholder" class="img-fluid mb-4">
              </div>
              <div class="desc align-self-md-center">
                <h3>Vivah Nepal</h3>
                <p>Blog section shows our activities we have involved and future updates.</p>
              </div>
            </div>           
              

          </div> <!-- .col-md-8 -->
          <div class="col-md-4 sidebar ftco-animate">            
            <div class="sidebar-box ftco-animate">
              <div class="categories">
                <h3>Categories</h3>
                <?php 
                $sql = "SELECT bc.name, bc.id, COUNT(b.id) AS blog_count
                FROM blog_category bc
                LEFT JOIN blog b ON b.category_id = bc.id
                GROUP BY bc.id;
                ";

                $query = $conn->prepare($sql);
      
                $query->execute();
      
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                
                if($query-> rowCount() > 0){
                  foreach($results as $res){
                    echo '<li><a href="#">'.$res->name.' <span>('.$res->blog_count.')</span></a></li>';
                  }
                }
                ?>                
              </div>
            </div>

            <div class="sidebar-box ftco-animate">
              <h3>Other Blogs</h3>
              <?php 
                $sidesql = "SELECT b.*, bc.name from blog b, blog_category bc where b.id <> $id and b.category_id = bc.id limit 3";

                $sidequery = $conn->prepare($sidesql);
      
                $sidequery->execute();
      
                $results = $sidequery->fetchAll(PDO::FETCH_OBJ);
                
                if($sidequery-> rowCount() > 0){
                  foreach($results as $blogres){
                    $formattedDate = $blogres->modified;
                    $timestamp = strtotime($formattedDate);
                    $formattedDateTime = date("Y F j, h:i A", $timestamp);
                    echo '<div class="block-21 mb-4 d-flex">
                    <a class="blog-img mr-4" style="background-image: url(images/image_1.jpg);"></a>
                    <div class="text">
                      <h3 class="heading"><a href="#">'.$blogres->title.'</a></h3>
                      <div class="meta">
                        <div><a href="#"><span class="icon-calendar"></span> '.$formattedDateTime.'</a></div>
                        <div><a href="#"><span class="icon-person"></span> '.$blogres->name.'</a></div>                        
                      </div>
                    </div>
                  </div>';
                  }
                }
                ?>                                  
            </div>
            <div class="sidebar-box ftco-animate">              
              <?php       
                  $ind = 0;          
                  foreach($adImages as $adSingle){
                    if($ind == 0){
                      $ind++;
                      continue;
                    }
                    if (isset($adImages[$ind])) {
                      $targetAd = $adImages[$ind];
                      $targetUrl = $targetAd['url'];
                      $targetPath = $targetAd['path'];
                      $targetImagePath = 'images/ads/' . $targetPath; // Assuming the image path is relative to the current script
                      
                      // Do something with the retrieved ad data
                      // For example, you can use the variables $targetUrl, $targetImagePath to display or process the data
                      echo '<div class="ad-Container mb-2"><a href="' . $targetUrl . '" target="_blank"><img src="' . $targetImagePath . '" alt=""></a></div>';                      
                      $ind++;
              }                  
                  }
                
                ?>                                  
            </div>
        </div>
      </div>
    </section> <!-- .section -->
    <div class="container">
    <div class="row justify-content-center mb-4">
      <div class="ad-Container">
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
    </div>
  </div>
    <?php
  include('base/footer.php');
    ?>