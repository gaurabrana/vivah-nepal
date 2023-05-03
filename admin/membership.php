<?php
include('database/connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Membership Packages</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
	<link rel="stylesheet" href="css/membership.css">
	<link href="plugins/toastr/css/toastr.min.css" rel="stylesheet">
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <?php

        include("layouts.php");
        ?>

            <!--**********************************
            Content body start
        ***********************************-->
            <div class="content-body">

                <div class="row page-titles mx-0">
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Membershp Packages</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->

                <div class="container-fluid">
                    <div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12">
								<button class="btn btn-danger" data-toggle="collapse" href="#addmembershippackage" role="button" aria-expanded="false" aria-controls="addmembershippackage">Add new package</button>
							</div>
							<div class="col-md-12 collapse" id="addmembershippackage">
								<div class="holdForm">
								<form id="NewMembershipForm">
								<div class="form-group row">
								<label class="col-lg-2 col-form-label" for="val-membershipname">Name <span class="text-danger">*</span>
								</label>
								<div class="col-lg-6">
									<input type="text" class="form-control" id="val-membershipname" name="membershipname" placeholder="Enter membership name.." required>
								</div>
								</div>
								<div class="form-group row">
								<label class="col-lg-2 col-form-label" for="val-membershipprice">Price <span class="text-danger">*</span>
								</label>
								<div class="col-lg-6">
									<input type="number" min="0" class="form-control" id="val-membershipprice" name="membershipprice" placeholder="Enter membership price.." required>
								</div>
								</div>
								<div class="form-group row">
								<label class="col-lg-2 col-form-label" for="val-membershipdiscount">Discount<span class="text-danger">*</span>
								</label>
								<div class="col-lg-6">
								<input type="number" min="0" class="form-control" id="val-membershipdiscount" name="membershipdiscount" placeholder="Enter membership discount % on products.." required>
								</div>
								</div>
								<div class="form-group row">
								<label class="col-lg-2 col-form-label" for="val-membershipdeliverycharge">Delivery Charge<span class="text-danger">*</span>
								</label>
								<div class="col-lg-6">
								<input type="number" class="form-control" id="val-membershipdeliverycharge" name="membershipdeliverycharge" placeholder="Enter charge off %.." required>
								</div>
								</div>
								<div class="form-group row">
								<label class="col-lg-2 col-form-label" for="val-membershipCoupons">Discount Coupons<span class="text-danger">*</span>
								</label>
								<div class="col-lg-6">
								<select class="form-control" id="membershipCoupons" name="membershipCoupons" required>										
										<option value="Yes" selected>Yes</option>
										<option value="No">No</option>										
								</select>
								</div>
								</div>
								<div class="form-group row">
								<label class="col-lg-2 col-form-label" for="val-membershipgiveaway">Giveaway Participation<span class="text-danger">*</span>
								</label>
								<div class="col-lg-6">
								<select class="form-control" id="membershipgiveaway" name="membershipgiveaway" required>										
								<option value="Yes" selected>Yes</option>
								<option value="No">No</option>	
								</select>
								</div>
								</div>
								<div class="form-group row">
								<label class="col-lg-2 col-form-label" for="val-membershiptype">Type<span class="text-danger">*</span>
								</label>
								<div class="col-lg-6">
								<select class="form-control" id="membershiptype" name="membershiptype" required>
										<option value="" selected diasbled>Choose Type</option>
										<option value="Silver">Silver</option>
										<option value="Gold">Gold</option>
										<option value="Platinum">Platinum</option>
								</select>
								</div>
								</div>								
								<div class="form-group row">
								<label class="col-lg-2 col-form-label" for="val-membershipduration">Duration<span class="text-danger">*</span>
								</label>
								<div class="col-lg-6">
									<select class="form-control" id="membershipduration" name="membershipduration" required>
										<option value="" selected diasbled>Choose Duration</option>
										<option value="Weekly">Weekly</option>
										<option value="Monthly">Monthly</option>
										<option value="Yearly">Yearly</option>
									</select>									
								</div>
								</div>
								<div class="form-group row">
								<label class="col-lg-2 col-form-label" for="val-featureditem">Highlight this package?<span class="text-danger">*</span>
								</label>
								<div class="col-lg-6">
									<select class="form-control" id="featureditem" name="featureditem" required>
									<option value="Yes">Yes</option>
									<option value="No" selected >No</option>
									</select>									
								</div>
								</div>
								<div class="form-group row">
									<div class="col-lg-12">
										<input class="btn btn-light" type="submit" name="submit" value="Add Package">
									</div>
								</div>
								</form>
								</div>							
							</div>
						</div>
					</div>
                    </div>
                <div class="row mt-2">
                <div class="col-md-12">                							
				<div class="pricing-table holdPackages">
					<?php					
					$getPackages = "Select * from membership_packages";
					$getPackagesResult = mysqli_query($conn, $getPackages);
					if(mysqli_num_rows($getPackagesResult) > 0){
						while($row = mysqli_fetch_assoc($getPackagesResult)){							
							$coupons = $row['coupons'] == "Yes" ? "Available" : "Not available";
							$giveaway = $row['giveaway'] == "Yes" ? "Available" : "Not available";
							if($row['duration']=="Weekly"){
								$durationTag = "W";
							}
							else if($row['duration']=="Monthly"){
								$durationTag = "M";	
							}
							else if($row['duration']=="Yearly"){
								$durationTag = "Y";
							}
							$featured = $row['featured_item'] == "Yes" ? "featured-item" : "";
							echo'<div class="ptable-item '.$featured.'">
							<div class="ptable-single">
								<div class="ptable-header">
									<div class="ptable-title">
										<h2>'.$row['type'].'</h2>
									</div>
									<div class="ptable-price">
										<h2><small>Rs</small>'.$row['price'].'<span>/ '.$durationTag.'</span></h2>
									</div>
								</div>
								<div class="ptable-body">
									<div class="ptable-description">
										<ul>
											<li>Product Discount: '.$row['discount'].'% off</li>
											<li>Delivery Charge: '.$row['delivery_charge'].'% off</li>
											<li>Discount Coupons: '.$coupons.'</li>
											<li>Giftaway Participation: '.$giveaway.'</li>
										</ul>
									</div>
								</div>
								<div class="ptable-footer">
									<div class="ptable-action">
										<a target="_blank" href="updatemembership.php?package='.$row['id'].'"><i class="fa fa-shopping-cart"></i>Update Package</a>
									</div>
								</div>
							</div>
						</div>';
						}
					}
					else{

					}
					?>					
				</div>				

                    </div>
                </div>
                </div>
                <!-- #/ container -->
            </div>
            <!--**********************************
            Content body end
        ***********************************-->


            <!--**********************************
            Footer start
        ***********************************-->
            <div class="footer">
                <div class="copyright">
                    <p>Copyright &copy; Designed & Developed by <a href="#">Gaurab Rana</a> 2021</p>
                </div>
            </div>
            <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
	<script src="js/membership.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>
	<script src="plugins/toastr/js/toastr.min.js"></script>
  <script src="plugins/toastr/js/toastr.init.js"></script>
</body>

</html>