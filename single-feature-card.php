<?php
function getServiceById($conn, $serviceId){
      $sql = "SELECT s.*, sc.name, si.path from services s, service_category sc, service_images si where serviceCategory = $serviceId and s.serviceCategory = sc.id and si.serviceId = s.id";
      $query = $conn->prepare($sql);
      $query->execute();
      $results = $query->fetchAll(PDO::FETCH_OBJ);
      if ($query->rowCount() > 0) {
        foreach ($results as $row) {
          $id = $row->id;
          $categoryName = $row->name;
          $categoryId = $row->serviceCategory;
          $serviceName = $row->serviceName; 
          $path = $row->path;        
          echo '<div class="col-sm-6 col-md-4 service-item wow fadeIn">
              <div class="single_blog_item">
              <a href="feature-detail.php?q=fd&id='.$id.'&name='.$serviceName.'&cat='.$categoryName.'&catId='.$categoryId.'" class="btn_3">
                  <div class="single_blog_img">
                      <img src="images/services/'.$path.'" alt="">
                  </div>
                  <div class="single_blog_text">
                      <h3>' . $row->serviceName . '</h3>
                      <p>' . $row->serviceDescription . '</p>
                      <p>Rs ' . $row->servicePrice . '</p>
                  </div>
                  </a>
              </div>
          </div>';
        }
      }
    }
?>