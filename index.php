<?php
include "base/header.php";
include 'admin/base/db.php';
include 'ad-container.php';
?>
<style>
  .ftco-navbar-light .navbar-nav > .nav-item > .nav-link{
    color: #fff !important;
  }
  .ftco-navbar-light.scrolled .navbar-nav > .nav-item > .nav-link{
    color: #000 !important;
  }
  .ftco-navbar-light .navbar-nav > .nav-item > .nav-link:hover{
    color: #ff5d00 !important;
  }  
  .ftco-navbar-light .navbar-nav > .nav-item.cta > a {
    color: #fff;
  }
</style>
    <!-- END nav -->
        
      <!-- <div class="overlay"></div> -->
      <div id="hero">        
          <div class="texture"></div>
          <video loop muted autoplay playsinline preload="auto">
              <source src="promo.mp4" type="video/mp4">
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
                echo'<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 ftco-animate">
                  <div class="block-7">
                    <div class="text-center">
                    <h2 class="heading">'.$changedName.'</h2>
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
    	<div class="container-fluid">
    		<div class="row justify-content-center mb-5 pb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
            <h2 class="mb-2">Recent Events</h2>
            <span class="subheading">Memories from our recent events</span>
          </div>
        </div>
        <div class="row">
          <?php
           $sql = "SELECT ei.path, e.description,e.eventName, e.startDate, e.location FROM event_images ei, event e WHERE e.id = ei.eventId AND showcase_image = true LIMIT 9";
           $query = $conn->prepare($sql);
           $query->execute();
           $results = $query->fetchAll(PDO::FETCH_OBJ);
           // function getEventHighlights($ribbon, $name, $description, $location, $startdate, $imagePath, $size)
   
           if ($query->rowCount() > 0) {
            foreach ($results as $rowData) {
              
              $name = $rowData->eventName;
              $description = $rowData->description;
              $startDate = $rowData->startDate;
              $location = $rowData->location;
              $path = $rowData->path;
              echo'<div class="col-md-4 ftco-animate">
              <div class="work-entry">
                <a href="#" class="img" style="background-image: url(images/events/'.$path.');">
                  <div class="text d-flex justify-content-center align-items-center">
                    <div class="p-3">
                    <h3>'.$name.'</h3>
                      <span>'.$description.'</span>
                    </div>
                  </div>
                </a>
              </div>
            </div>';
            }
           }
          ?>        	        	
        </div>
    	</div>
    </section>
    <div class="container">
      <div class="row  justify-content-center">
      <?php
      getAdContainerWide();
      ?>
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

    <?php
    include('base/footer.php');
    ?>