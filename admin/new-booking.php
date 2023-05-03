<?php
session_start();
if (isset($_SESSION['phpstartup_adminid'])) {
    include "base/header.php";
    include 'base/db.php';
    $username = $_SESSION['phpstartup_adminid'];
  } else {
    echo "<script> location.href='index.php'; </script>";
  }

?>

<div class="main-container">
	<div class="pd-ltr-20 xs-pd-20-10">
		<div class="min-height-200px">
			<div class="page-header">
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<div class="title">
							<h4>New Booking</h4>
						</div>
						<nav aria-label="breadcrumb" role="navigation">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.html">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">New Booking</li>
							</ol>
						</nav>
					</div>

				</div>
			</div>

			<!-- Export Datatable start -->
			<div class="card-box mb-30">
				<div class="pd-20">
					<h4 class="text-blue h4">New Booking</h4>
				</div>
				<div class="pb-20">


					<table class="table hover multiple-select-row data-table-export nowrap">
						<thead>
							<tr>
								<th>S.NO</th>
								<th>Booking Id</th>
								<th>Name</th>
								<th>Mobile</th>								
								<th>Email</th>
								<th>Booking Date</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php

							$sql = "SELECT users.name,users.mobile,users.email,booking.id as bid,booking.bookingId,booking.bookingDate,booking.status from booking join users on users.id=booking.userId where booking.status is null  order by booking.id desc ";

							$query = $conn->prepare($sql);
							$query->execute();
							$results = $query->fetchAll(PDO::FETCH_OBJ);

							$cnt = 1;
							if ($query->rowCount() > 0) {
								foreach ($results as $row) {
							?>
									<tr>
										<td><?php echo $cnt; ?></td>
										<td><?php echo htmlentities($row->bookingId); ?></td>
										<td><?php echo htmlentities($row->name); ?></td>
										<td><?php echo htmlentities($row->mobile); ?></td>										
										<td><?php echo htmlentities($row->email); ?></td>

										<td><span class="badge badge-warning"><?php echo htmlentities($row->bookingDate); ?></span></td>


										<?php if ($row->status == "") { ?>


											<td><span class="badge badge-danger"><?php echo "New Booking"; ?></span></td>


										<?php } else { ?>

											<td><span class="badge badge-primary"><?php echo htmlentities($row->status); ?></span></td>
										<?php } ?>


										<td><a href="view-booking-details.php?editid=<?php echo htmlentities($row->bid); ?>" class="btn btn-primary"><i class="icon-copy fa fa-eye" aria-hidden="true"></i></a></td>
									</tr>
							<?php $cnt = $cnt + 1;
								}
							} ?>

						</tbody>
					</table>

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