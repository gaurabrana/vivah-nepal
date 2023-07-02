<?php
include "base/header.php";
include 'admin/base/db.php';
$breadCrumbName = "";
if (isset($_GET['q']) && $_GET['q'] != null) {
	$id = $_GET["id"];
	$name = $_GET["name"];
	$category = $_GET["cat"];
	$categoryId = $_GET["catId"];
	$breadCrumbName = $name;
}
?>
<link rel="stylesheet" href="css/single-detail.css">
<!-- Themefisher Icon font -->
<link rel="stylesheet" href="plugins/themefisher-font/style.css">
<!-- bootstrap.min css -->
<link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">

<!-- Animate css -->
<link rel="stylesheet" href="plugins/animate/animate.css">
<!-- Slick Carousel -->
<link rel="stylesheet" href="plugins/slick/slick.css">
<link rel="stylesheet" href="plugins/slick/slick-theme.css">
<div class="hero-wrap hero-wrap-2" data-stellar-background-ratio="1">
	<div class="overlay"></div>
	<div class="container-fluid">
		<div class="row no-gutters d-flex slider-text align-items-center justify-content-center" data-scrollax-parent="true">
			<div class="col-md-6 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
				<p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="index.php">Home</a></span> <span>Detail Page</span></p>
				<h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><?php echo $category; ?></h1>
			</div>
		</div>
	</div>
</div>
<section class="exclusive_item_part blog_item_section">
	<div class="container">
		<div class="row">
			<div class="col-xl-5">
				<div class="section_tittle">
					<p></p>
					<h2><?php echo $breadCrumbName; ?></h2>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="ftco-section single-product">
	<div class="container">
		<div class="row mt-20">
			<div class="col-md-5">
				<div class="single-product-slider">
					<div id='carousel-custom' class='carousel slide' data-ride='carousel'>
						<div class='carousel-outer'>
							<!-- me art lab slider -->
							<div class='carousel-inner '>
								<?php
								$sql = "SELECT path from service_images s where serviceId = $id";
								$query = $conn->prepare($sql);
								$query->execute();
								$results = $query->fetchAll(PDO::FETCH_OBJ);
								if ($query->rowCount() > 0) {
									$index = 0;
									foreach ($results as $row) {
										$index++;
										echo '<div class="item';
										if ($index == 1) {
											echo ' active">';
										} else {
											echo '">';
										}
										echo '<img src="images/services/' . $row->path . '" alt="image for feature" data-zoom-image="images/events/' . $row->path . '" />
		</div>';
									}
								}

								?>
							</div>

							<!-- sag sol -->
							<a class='left carousel-control' href='#carousel-custom' data-slide='prev'>
								<i class="tf-ion-ios-arrow-left"></i>
							</a>
							<a class='right carousel-control' href='#carousel-custom' data-slide='next'>
								<i class="tf-ion-ios-arrow-right"></i>
							</a>
						</div>

						<!-- thumb -->
						<!-- <ol class='carousel-indicators mCustomScrollbar meartlab'>
							<li data-target='#carousel-custom' data-slide-to='0' class='active'>
								<img src='images/shop/single-products/product-1.jpg' alt='' />
							</li>
							<li data-target='#carousel-custom' data-slide-to='1'>
								<img src='images/shop/single-products/product-2.jpg' alt='' />
							</li>
							<li data-target='#carousel-custom' data-slide-to='2'>
								<img src='images/shop/single-products/product-3.jpg' alt='' />
							</li>
							<li data-target='#carousel-custom' data-slide-to='3'>
								<img src='images/shop/single-products/product-4.jpg' alt='' />
							</li>
							<li data-target='#carousel-custom' data-slide-to='4'>
								<img src='images/shop/single-products/product-5.jpg' alt='' />
							</li>
							<li data-target='#carousel-custom' data-slide-to='5'>
								<img src='images/shop/single-products/product-6.jpg' alt='' />
							</li>
							<li data-target='#carousel-custom' data-slide-to='6'>
								<img src='images/shop/single-products/product-7.jpg' alt='' />
							</li>
						</ol> -->
					</div>
				</div>
			</div>
			<div class="col-md-7">
				<div class="single-product-details">
					<?php				
    $sql = "SELECT s.serviceName, s.serviceDescription, s.servicePrice, s.serviceCategory, s.createdDate, c.name FROM services s, service_category c WHERE s.id = $id and s.serviceCategory = c.id";
    $query = $conn->prepare($sql);
    $query->execute();
    $row = $query->fetch();
    if ($query->rowCount() > 0) {
        $serviceName = $row["serviceName"];
        $description = $row["serviceDescription"];
        $price = $row["servicePrice"];
        $category = $row["name"];
        $categoryId = $row["serviceCategory"];
        $createdDate = $row["createdDate"];    
					echo'<h2>'.$serviceName.'</h2>
					<p class="product-price">Rs '.$price.'</p>					
					<p class="product-description mt-20">
					'.$description.'
					</p>										
					<button id="bookService'.$id.'" class="btn btn-warning mt-2 bookingButton">Book Service</button>';
	}
					?>
				</div>
			</div>
		</div>			
				<div class="col-md-12">			
				<div class="tabCommon">
					<ul class="nav nav-tabs d-flex justify-content-center">
						<li class="active"><a data-toggle="tab" href="#details" aria-expanded="true">Details</a></li>
						<li class=""><a data-toggle="tab" href="#reviews" aria-expanded="false">Reviews (3)</a></li>
					</ul>
					<div class="tab-content patternbg">
						<div id="details" class="tab-pane fade active in">
							<h4><?php echo $description;  ?></h4>
							<p></p>
						</div>
						<div id="reviews" class="tab-pane fade">
						<div class="row">
						<div class="col-md-6">
                            <?php
                            $sqlForReview = "SELECT sr.*, u.name FROM service_review sr 
                            JOIN users u ON sr.userId = u.id 
                            WHERE sr.serviceId = $id";
                            $queryForReview = $conn->prepare($sqlForReview);
                            $queryForReview->execute();
                            $result = $queryForReview->fetchAll(PDO::FETCH_OBJ);
                            $reviewCount = $queryForReview->rowCount();
                            echo '<h4 class="mb-4">';
                            if ($reviewCount > 0) {
                                echo $reviewCount;
                            } else {
                                echo "No";
                            }
                            echo ' review for ' . $name . '</h4>';
                            if ($reviewCount > 0) {
                                foreach ($result as $reviewData) {
                                    $reviewId = $reviewData->id;
                                    $serviceId = $reviewData->serviceId;
                                    $userId = $reviewData->userId;
                                    $remark = $reviewData->remark;
                                    $rating = $reviewData->rating;
                                    $createdDate = $reviewData->createdDate;
                                    $userName = $reviewData->name; // Added column from users table
                                    echo '<div class="media mb-3">                                
                                    <div class="media-body">
                                        <h6 style="text-transform: capitalize;">' . $userName . '<small> - <i>' . $createdDate . '</i></small></h6>                                        
                                        <p>' . $remark . '</p>
                                    </div>
                                </div>';
                                }
                            }
                            ?>
                        </div>
                        <div class="col-md-6">
                            <h4 class="mb-4">Leave a review</h4>
                            <small>Your email address will not be published. Required fields are marked *</small>
                            <form>
                                <div class="form-group">
                                    <label for="message">Your Review *</label>
                                    <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="name">Your Name *</label>
                                    <input type="text" class="form-control" id="name">
                                </div>
                                <div class="form-group">
                                    <label for="email">Your Email *</label>
                                    <input type="email" class="form-control" id="email">
                                </div>
                                <div class="form-group mb-0">
                                    <input type="submit" value="Leave Your Review" class="btn btn-primary px-3">
                                </div>
                            </form>
                        </div>
						</div>
						</div>
					</div>
				</div>			
		</div>
	</div>
</section>
<section class="products related-products section">
	<div class="container">
		<div class="row">
			<div class="title text-center">
				<h2>Related Services</h2>
				<br>
			</div>
		</div>		
		<div class="row">		
			<?php
			$sql = "SELECT si.path, c.name, s.* FROM service_images si, services s, service_category c WHERE s.id <> $id and s.serviceCategory = c.id and si.serviceId = s.id and s.serviceCategory <> $categoryId ORDER BY RAND() LIMIT 4";
			$query = $conn->prepare($sql);
			$query->execute();
			$res = $query->fetchAll(PDO::FETCH_OBJ);
			if ($query->rowCount() > 0) {
				foreach ($res as $likable) {
					$serviceName = $likable->serviceName;					
					$imgPath = $likable->path;
					$price = $likable->servicePrice;
					$categoryN = $likable->name;
					$sId = $likable->id;					
          			$catgoryId = $likable->serviceCategory;          	
					echo'<div class="col-md-3">
					<div class="product-item">
						<div class="product-thumb">
							<span class="bage">'.$categoryN.'</span>
							<img class="img-responsive" src="images/services/'.$imgPath.'" alt="product-img" />
							<div class="preview-meta">
								<ul>
									<li>
										<span data-toggle="modal" data-target="#product-modal">
											<i class="tf-ion-ios-search"></i>
										</span>
									</li>
									<li>
										<a href="#"><i class="tf-ion-ios-heart"></i></a>
									</li>									
								</ul>
							</div>
						</div>						
						<div class="product-content">
							<h4><a href="feature-detail.php?q=fd&id='.$sId.'&name='.$serviceName.'&cat='.$categoryN.'&catId='.$catgoryId.'">'.$serviceName.'</a></h4>
							<p class="price">Rs '.$price.'</p>
						</div>
					</div>
				</div>';	
				}
			}
			?>			
		</div>
	</div>
</section>

<!-- Main jQuery -->
<script src="plugins/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.1 -->
<script src="plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- Bootstrap Touchpin -->
<script src="plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
<!-- Instagram Feed Js -->
<script src="plugins/instafeed/instafeed.min.js"></script>
<!-- Video Lightbox Plugin -->
<script src="plugins/ekko-lightbox/dist/ekko-lightbox.min.js"></script>
<!-- Count Down Js -->
<script src="plugins/syo-timer/build/jquery.syotimer.min.js"></script>

<!-- slick Carousel -->
<script src="plugins/slick/slick.min.js"></script>
<script src="plugins/slick/slick-animation.min.js"></script>

<!-- Google Mapl -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCC72vZw-6tGqFyRhhg5CkF2fqfILn2Tsw"></script>
<script type="text/javascript" src="plugins/google-map/gmap.js"></script>

<!-- Main Js File -->
<script src="js/script.js"></script>
<?php
include('base/footer.php');
?>