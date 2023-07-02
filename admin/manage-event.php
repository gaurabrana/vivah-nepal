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
	$sql = "DELETE FROM event WHERE id = $ids";
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
							<h4>Manage Event </h4>
						</div>
						<nav aria-label="breadcrumb" role="navigation">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.html">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Manage Event</li>
							</ol>
						</nav>
					</div>

				</div>
			</div>

			<!-- Export Datatable start -->
			<div class="card-box mb-30">
				<div class="pd-20">
					<h4 class="text-blue h4">Manage Event</h4>
				</div>
				<div class="pb-20">
					<?php

					$sql = "SELECT * FROM `event` ORDER BY id DESC";
					$result = $conn->query($sql);
					$cnt = 1;

					if ($result->rowCount() > 0) {
					?>
						<table class="table hover multiple-select-row data-table-export nowrap">
							<thead>
								<tr>
									<th>No</th>
									<th>Event Name</th>
									<th>Start Date</th>
									<th>End Date</th>
									<th>Price (Rs)</th>
									<th>Location</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
								?>
									<tr>
										<td><?php echo $cnt; ?></td>
										<td><?php echo $row['eventName']; ?></td>
										<td><?php echo $row['startDate']; ?></td>
										<td><?php echo $row['endDate']; ?></td>
										<td><?php echo $row['price']; ?></td>
										<td><?php echo $row['location']; ?></td>
										<td>
											<form action="" method="POST">
												<input type="hidden" name="id" value="<?php echo $row["id"] ?>">
												<div class="btn-group">
													<a href="manage-single-event.php?id=<?php echo $row["id"] ?>" type="button" class="btn btn-secondary" name="update"><i class="icon-copy fa fa-edit" aria-hidden="true"></i></a>
												</div>
												<div class="btn-group">
													<button type="submit" class="btn btn-danger" name="delete"><i class="icon-copy fa fa-trash" aria-hidden="true"></i></button>
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