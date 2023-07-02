
<?php
session_start();
if (isset($_SESSION['phpstartup_adminid'])) {
	include "base/header.php";
	include 'base/db.php';
	$username = $_SESSION['phpstartup_adminid'];
	if(!isset($_GET['package'])){
		header("Location: membership.php");
		}
		else{
			$packageid = $_GET['package'];
		}
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
											<?php
                                            $sql = "SELECT * from packages where id = $packageid";
                                            $query = $conn->query($sql);
                                            $query->execute();
                                            $result = $query->fetch(PDO::FETCH_OBJ);
											?>				
							<div class="col-md-12" id="updatemembershippackage">
								<div class="holdForm">
								<form id="UpdateMembershipForm">
								<div class="form-group row">                    
								<label class="col-lg-2 col-form-label" for="val-membershipname">Name <span class="text-danger">*</span>
								</label>
								<div class="col-lg-6">
                                    <input name="packageid" hidden readonly value='<?php echo $packageid; ?>'>
									<input type="text" class="form-control" value="<?php echo $result->name; ?>" id="val-membershipname" name="membershipname" placeholder="Enter membership name.." required>
								</div>
								</div>
								<div class="form-group row">
								<label class="col-lg-2 col-form-label" for="val-membershipprice">Price <span class="text-danger">*</span>
								</label>
								<div class="col-lg-6">
									<input type="number" min="0" class="form-control" value="<?php echo $result->price; ?>" id="val-membershipprice" name="membershipprice" placeholder="Enter membership price.." required>
								</div>
								</div>
								<div class="form-group row">
								<label class="col-lg-2 col-form-label" for="val-membershipdiscount">Discount<span class="text-danger">*</span>
								</label>
								<div class="col-lg-6">
								<input type="number" min="0" class="form-control" value="<?php echo $result->discount; ?>" id="val-membershipdiscount" name="membershipdiscount" placeholder="Enter membership discount % on products.." required>
								</div>
								</div>
								<div class="form-group row">
								<label class="col-lg-2 col-form-label" for="val-membershipdescription">Description<span class="text-danger">*</span>
								</label>
								<div class="col-lg-6">
								<textarea class="form-control" id="val-membershipdescription" name="membershipdescription" required>
								<?php echo $result->description; ?>
								</textarea>
								</div>
								</div>								
								<div class="form-group row">
									<div class="col-lg-12 d-flex justify-content-center">
										<input class="btn btn-dark mr-2" type="submit" name="submit" value="Update Package">
										<button id="deleteMemebership<?php echo $packageid; ?>" class="btn btn-danger deletePackage" type="button">Delete Package</button>
									</div>
								</div>
								</form>
								</div>							
							</div>
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