<?php
session_start();
if (isset($_SESSION['phpstartup_adminid'])) {
    include "base/header.php";
    include 'base/db.php';
    $username = $_SESSION['phpstartup_adminid'];
  } else {
    echo "<script> location.href='index.php'; </script>";
  }

if (isset($_REQUEST['delete'])) {
	$ids = $_REQUEST['id'];
	$sql = "DELETE FROM services WHERE id = $ids";
	$result = $conn->query($sql);
}
?>

<div class="main-container">
	<div class="pd-ltr-20 xs-pd-20-10">
		<div class="min-height-200px">
			<div class="page-header">
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<div class="title">
							<h4>Manage Services</h4>
						</div>
						<nav aria-label="breadcrumb" role="navigation">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.php">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Manage Services</li>
							</ol>
						</nav>
					</div>

				</div>
			</div>

			<!-- Export Datatable start -->
			<div class="card-box mb-30">
				<div class="pd-20">
					<h4 class="text-blue h4">Manage All Services</h4>
				</div>
				<div class="pb-20">
					<?php
					$sql = "SELECT 
					s.id, 
					s.serviceName, 
					s.servicePrice, 					
					sc.name, 
					s.createdDate 
				FROM 
					services s 
					INNER JOIN service_category sc 
					ON sc.id = s.serviceCategory  
				ORDER BY 
					s.id DESC;
				";
					$result = $conn->query($sql);
					$cnt = 1;

					if ($result->rowCount() > 0) {
					?>
						<table class="table hover multiple-select-row data-table-export nowrap">
							<thead>
								<tr>
									<th>S.NO</th>
									<th>Service Name</th>
									<th>Service Price</th>									
									<th>Service Category</th>
									<th>Created Date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
								?>
									<tr>
										<td><?php echo $row["id"]; ?></td>
										<td><?php echo $row['serviceName']; ?></td>
										<td>$ <?php echo $row['servicePrice']; ?></td>										
										<td><?php echo $row['name']; ?></td>
										<td><span class="badge badge-warning"><?php echo $row['createdDate']; ?></span></td>
										<td>

											<form action="" method="POST">
												<input type="hidden" name="id" value="<?php echo $row["id"] ?>">

												<div class="btn-group">
													<a href="manage-single-service.php?id=<?php echo $row["id"] ?>" class="btn btn-secondary mr-2"><i class="icon-copy fa fa-edit" aria-hidden="true"></i></a>
													<button type="submit" id="deleteService<?php echo $row["id"] ?>" class="btn btn-danger deleteServiceButton<?php echo $row["id"] ?>" name="delete"><i class="icon-copy fa fa-trash" aria-hidden="true"></i></button>
												</div>

											</form>
										</td>
									</tr>
								<?php
									$cnt = $cnt + 1;
								}
								?>

							</tbody>
						</table>
					<?php
					}
					?>
				</div>
			</div>
			<!-- Export Datatable End -->
		</div>

		<?php
		include("base/footer.php");
		?>