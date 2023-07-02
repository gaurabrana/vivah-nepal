<?php
function getBannerByPageId($conn, $pageId, $child){
      $sql = "SELECT hero_image, id, name from pages where id = $pageId";
      $query = $conn->prepare($sql);
      $query->execute();
      $results = $query->fetchAll(PDO::FETCH_OBJ);
      if ($query->rowCount() > 0) {
        foreach ($results as $row) {          
          $path = $row->hero_image;                 
          echo '<div class="hero-wrap hero-wrap-2" id="scroll-hero" style="background-image: url(images/hero-image/'.$path.');" data-stellar-background-ratio="0.5">
          '.$child.'
        </div>';
        }
      }
    }
?>