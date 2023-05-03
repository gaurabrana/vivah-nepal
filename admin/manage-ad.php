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
	$sql = "DELETE FROM ads WHERE id = $ids";
	$result = $conn->query($sql);
}
if (isset($_REQUEST['update'])) {
	echo "<script> location.href='manage-ad.php'; </script>";
}
?>

<div class="main-container">
	<div class="pd-ltr-20 xs-pd-20-10">
		<div class="min-height-200px">
			<div class="page-header">
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<div class="title">
							<h4>Manage Advertisement</h4>
						</div>
						<nav aria-label="breadcrumb" role="navigation">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.html">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Manage Existing Ads</li>
							</ol>
						</nav>
					</div>

				</div>
			</div>

			<!-- Export Datatable start -->
			<div class="card-box mb-30">
				<div class="pd-20">
					<h4 class="text-blue h4">Manage All Advertisement</h4>
				</div>
				<div class="pb-20">
					<?php
					$sql = "SELECT 
					ad.id, 
					ad.path,					
					ad.screen_index, 
					ads.name, 
					ad.modified 
				FROM 
					ads ad 
					INNER JOIN pages ads 
					ON ads.id = ad.page_id  
				ORDER BY 
					ad.id DESC;
				";
					$result = $conn->query($sql);
					$cnt = 1;

					if ($result->rowCount() > 0) {
					?>
						<table class="table hover multiple-select-row data-table-export nowrap">
							<thead>
								<tr>
									<th>S.NO</th>
									<th>Screen</th>
									<th>Image</th>
									<th>Ad Position</th>
									<th>Modified Date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
								?>
									<tr>
										<td><?php echo $row["id"]; ?></td>
										<td><?php echo $row['name']; ?></td>
										<td><img src='<?php
														$imagePath = explode('images/', $row['path'])[1];
														echo "../images/" . $imagePath;
														?>'></td>
										<td><?php echo $row['screen_index']; ?></td>
										<td><span class="badge badge-warning"><?php echo $row['modified']; ?></span></td>
										<td>

											<form action="" method="POST">
												<input type="hidden" name="id" value="<?php echo $row["id"] ?>">

												<div class="btn-group">
													<button type="submit" class="btn btn-danger" name="delete"><i class="icon-copy fa fa-trash" aria-hidden="true"></i></button>
												</div>
												<a href="update-ad.php?id=<?php echo $row["id"] ?>" class="btn btn-secondary" name="update"><i class="icon-copy fa fa-edit" aria-hidden="true"></i></a>

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
	</div>
</div>
	<?php
	include("base/footer.php");
	?>