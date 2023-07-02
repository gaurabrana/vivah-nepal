<?php
session_start();
if (isset($_SESSION['phpstartup_adminid'])) {
	include "base/header.php";
	include 'base/db.php';
	$username = $_SESSION['phpstartup_adminid'];
} else {
	echo "<script> location.href='index.php'; </script>";
}
$msg = "";
$error = "";
?>
<link rel="stylesheet" href="src/styles/membership.css">
<div class="main-container">
	<div class="pd-ltr-20 xs-pd-20-10">
		<div class="min-height-200px">
			<div class="page-header">
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<div class="title">
							<h4>Manage Packages</h4>
						</div>
						<nav aria-label="breadcrumb" role="navigation">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.html">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Manage Packages</li>
							</ol>
						</nav>
					</div>

				</div>
			</div>



			<?php
			if (isset($_POST['submit'])) {
				if ($error) {
			?>


					<div class="alert alert-danger" role="alert">
						<?php echo htmlentities($error); ?>
					</div>


				<?php
				} else if ($msg) {
				?>


					<div class="alert alert-primary" role="alert">
						<?php echo htmlentities($msg); ?>
					</div>


			<?php
				}
			}
			?>
			<div class="pd-20 card-box mb-30">				
				<div class="wizard-content">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12">
										<button class="btn btn-danger" data-toggle="collapse" href="#addmembershippackage" role="button" aria-expanded="false" aria-controls="addmembershippackage">Add new package</button>
									</div>
									<div class="col-md-12 collapse mt-2" id="addmembershippackage">
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
												<label class="col-lg-2 col-form-label" for="val-membershipdescription">Description<span class="text-danger">*</span>
												</label>
												<div class="col-lg-6">
												<textarea class="form-control" id="val-membershipdescription" name="membershipdescription" required>												
												</textarea>
												</div>
												</div>
												<div class="form-group row justify-content-center">
													<div class="col-lg-3 ">
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
									$getPackages = "Select * from packages";
									$getPackagesQuery = $conn->query($getPackages);
									$getPackagesQuery->execute();
									$getPackagesResult = $getPackagesQuery->fetchAll(PDO::FETCH_OBJ);
									if ($getPackagesQuery->rowCount() > 0) {
										foreach ($getPackagesResult as $row) {																																	
											echo '<div class="ptable-item">
							<div class="ptable-single">
								<div class="ptable-header">
									<div class="ptable-title">
										<h2>' . $row->name . '</h2>
									</div>
									<div class="ptable-price">
										<h2><small>Rs</small>' . $row->price . '<span></span></h2>
									</div>
								</div>
								<div class="ptable-body">
									<div class="ptable-description">
										<ul>
											<li>Product Discount: ' . $row->discount . '% off</li>											
										</ul>
									</div>
								</div>
								<div class="ptable-footer">
									<div class="ptable-action">
										<a target="_blank" href="updatemembership.php?package=' . $row->id . '"><i class="fa fa-shopping-cart"></i>Update Package</a>
									</div>
								</div>
							</div>
						</div>';
										}
									} else {
									}
									?>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>			
		</div>
		<?php
		include("base/footer.php");
		?>