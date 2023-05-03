<?php
include('database/connect.php');
if(!isset($_GET['package'])){
header("Location: membership.php");
}
else{
    $packageid = $_GET['package'];
}
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
        $getPackage = "Select * from membership_packages where id = '$packageid'";
        $getPackageResult = mysqli_query($conn, $getPackage);
        $row = mysqli_fetch_assoc($getPackageResult);        
        ?>

            <!--**********************************
            Content body start
        ***********************************-->
            <div class="content-body">

                <div class="row page-titles mx-0">
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Membership Packages</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)"><?php echo $row['name']; ?></a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->

                <div class="container-fluid">
                    <div class="row">
					<div class="col-md-12">
						<div class="row">							
							<div class="col-md-12" id="updatemembershippackage">
								<div class="holdForm">
								<form id="UpdateMembershipForm">
								<div class="form-group row">                    
								<label class="col-lg-2 col-form-label" for="val-membershipname">Name <span class="text-danger">*</span>
								</label>
								<div class="col-lg-6">
                                    <input name="packageid" hidden readonly value='<?php echo $packageid; ?>'>
									<input type="text" class="form-control" value="<?php echo $row['name'] ?>" id="val-membershipname" name="membershipname" placeholder="Enter membership name.." required>
								</div>
								</div>
								<div class="form-group row">
								<label class="col-lg-2 col-form-label" for="val-membershipprice">Price <span class="text-danger">*</span>
								</label>
								<div class="col-lg-6">
									<input type="number" min="0" class="form-control" value="<?php echo $row['price'] ?>" id="val-membershipprice" name="membershipprice" placeholder="Enter membership price.." required>
								</div>
								</div>
								<div class="form-group row">
								<label class="col-lg-2 col-form-label" for="val-membershipdiscount">Discount<span class="text-danger">*</span>
								</label>
								<div class="col-lg-6">
								<input type="number" min="0" class="form-control" value="<?php echo $row['discount'] ?>" id="val-membershipdiscount" name="membershipdiscount" placeholder="Enter membership discount % on products.." required>
								</div>
								</div>
								<div class="form-group row">
								<label class="col-lg-2 col-form-label" for="val-membershipdeliverycharge">Delivery Charge<span class="text-danger">*</span>
								</label>
								<div class="col-lg-6">
								<input type="number" class="form-control" value="<?php echo $row['delivery_charge'] ?>" id="val-membershipdeliverycharge" name="membershipdeliverycharge" placeholder="Enter charge off %.." required>
								</div>
								</div>
								<div class="form-group row">
								<label class="col-lg-2 col-form-label" for="val-membershipCoupons">Discount Coupons<span class="text-danger">*</span>
								</label>
								<div class="col-lg-6">
								<select class="form-control" id="membershipCoupons" name="membershipCoupons" required>										
										<option value="Yes" <?php if($row['coupons']=="Yes") echo ' selected'; ?>>Yes</option>
										<option value="No" <?php if($row['coupons']=="No") echo ' selected'; ?>>No</option>										
								</select>
								</div>
								</div>
								<div class="form-group row">
								<label class="col-lg-2 col-form-label" for="val-membershipgiveaway">Giveaway Participation<span class="text-danger">*</span>
								</label>
								<div class="col-lg-6">
								<select class="form-control" id="membershipgiveaway" name="membershipgiveaway" required>										
								<option value="Yes" <?php if($row['giveaway']=="Yes") echo ' selected'; ?>>Yes</option>
								<option value="No" <?php if($row['giveaway']=="No") echo ' selected'; ?>>No</option>	
								</select>
								</div>
								</div>
								<div class="form-group row">
								<label class="col-lg-2 col-form-label" for="val-membershiptype">Type<span class="text-danger">*</span>
								</label>
								<div class="col-lg-6">
								<select class="form-control" id="membershiptype" name="membershiptype" required>									
										<option value="Silver" <?php if($row['type']=="Silver") echo ' selected'; ?>>Silver</option>
										<option value="Gold" <?php if($row['type']=="Gold") echo ' selected'; ?>>Gold</option>
										<option value="Platinum" <?php if($row['type']=="Platinum") echo ' selected'; ?>>Platinum</option>
								</select>
								</div>
								</div>								
								<div class="form-group row">
								<label class="col-lg-2 col-form-label" for="val-membershipduration">Duration<span class="text-danger">*</span>
								</label>
								<div class="col-lg-6">
									<select class="form-control" id="membershipduration" name="membershipduration" required>										
										<option value="Weekly" <?php if($row['duration']=="Weekly") echo ' selected'; ?>>Weekly</option>
										<option value="Monthly" <?php if($row['duration']=="Monthly") echo ' selected'; ?>>Monthly</option>
										<option value="Yearly" <?php if($row['duration']=="Yearly") echo ' selected'; ?>>Yearly</option>
									</select>									
								</div>
								</div>
								<div class="form-group row">
								<label class="col-lg-2 col-form-label" for="val-featureditem">Highlight this package?<span class="text-danger">*</span>
								</label>
								<div class="col-lg-6">
									<select class="form-control" id="featureditem" name="featureditem" required>
									<option value="Yes" <?php if($row['featured_item']=="Yes") echo ' selected'; ?>>Yes</option>
									<option value="No" <?php if($row['featured_item']=="No") echo ' selected'; ?> >No</option>
									</select>									
								</div>
								</div>
								<div class="form-group row">
									<div class="col-lg-12 d-flex justify-content-center">
										<input class="btn btn-dark" type="submit" name="submit" value="Add Package">
									</div>
								</div>
								</form>
								</div>							
							</div>
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