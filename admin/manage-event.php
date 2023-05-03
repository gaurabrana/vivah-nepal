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
									<th>S.NO</th>
									<th>Event Name</th>
									<th>Creation Date</th>
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
										<td><span class="badge badge-warning"><?php echo $row['creationDate']; ?></span></td>
										<td>
											<form action="" method="POST">
												<input type="hidden" name="id" value="<?php echo $row["id"] ?>">

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

		<!-- js -->
		<script src="vendors/scripts/script.min.js"></script>
		<script src="vendors/scripts/process.js"></script>
		<script src="vendors/scripts/layout-settings.js"></script>
		<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
		<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
		<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
		<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
		<!-- buttons for Export datatable -->
		<script src="src/plugins/datatables/js/dataTables.buttons.min.js"></script>
		<script src="src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
		<script src="src/plugins/datatables/js/buttons.print.min.js"></script>
		<script src="src/plugins/datatables/js/buttons.html5.min.js"></script>
		<script src="src/plugins/datatables/js/buttons.flash.min.js"></script>
		<script src="src/plugins/datatables/js/pdfmake.min.js"></script>
		<script src="src/plugins/datatables/js/vfs_fonts.js"></script>
		<!-- Datatable Setting js -->
		<script src="vendors/scripts/datatable-setting.js"></script>
		</body>