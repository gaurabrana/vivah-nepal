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
	<div class="pd-ltr-20">


		<div class="row clearfix progress-box pb-5">

			<?php
			$sql = "select id from services";
			$query = $conn->prepare($sql);
			$query->execute();
			$results = $query->fetchAll(PDO::FETCH_OBJ);
			$totalServices = $query->rowCount();
			?>
			<div class="col-lg-6 col-md-6 col-sm-12 mb-30">
				<a href="manage-services.php">
					<div class="card-box pd-30 height-100-p" style="background-image: linear-gradient(#d713ad,#4173b1);">

						<div class="progress-box text-center">
							<h5 class="text-white padding-top-10 h5">All Service</h5>
							<p class="text-white" style="font-size:25px;"><?php echo $totalServices; ?></p>
						</div>

					</div>
				</a>
			</div>


			<?php
			$sql = "select id from event";
			$query = $conn->prepare($sql);
			$query->execute();
			$results = $query->fetchAll(PDO::FETCH_OBJ);
			$totalEvent = $query->rowCount();
			?>
			<div class="col-lg-6 col-md-6 col-sm-12 mb-30">
				<a href="manage-event.php">
					<div class="card-box pd-30 height-100-p" style="background-image: linear-gradient(#0c9b4b,#9bb141);">

						<div class="progress-box text-center">
							<h5 class="text-white padding-top-10 h5">All Event</h5>
							<p class="text-white" style="font-size:25px;"><?php echo $totalEvent; ?></p>
						</div>

					</div>
				</a>
			</div>

		</div>

		<div class="row clearfix progress-box">

			<?php
			$sql = "select id from booking where status is null";
			$query = $conn->prepare($sql);
			$query->execute();
			$results = $query->fetchAll(PDO::FETCH_OBJ);
			$newBooking = $query->rowCount();
			?>

			<div class="col-lg-3 col-md-6 col-sm-12 mb-30">
				<a href="new-booking.php">
					<div class="card-box pd-30 height-100-p" data-bgcolor="#25a8bd">
						<div class="progress-box text-center">
							<h5 class="text-white padding-top-10 h5">New Booking</h5>
							<p class="text-white" style="font-size:25px;"><?php echo $newBooking; ?></p>
						</div>
					</div>
				</a>
			</div>


			<?php
			$sql = "select id from booking where status='Approved'";
			$query = $conn->prepare($sql);
			$query->execute();
			$results = $query->fetchAll(PDO::FETCH_OBJ);
			$approvedBooking = $query->rowCount();
			?>
			<div class="col-lg-3 col-md-6 col-sm-12 mb-30">
				<a href="approved-booking.php">
					<div class="card-box pd-30 height-100-p" data-bgcolor="#19b33a">

						<div class="progress-box text-center">
							<h5 class="text-white padding-top-10 h5">Approved Booking</h5>
							<p class="text-white" style="font-size:25px;"><?php echo $approvedBooking; ?></p>
						</div>

					</div>
				</a>
			</div>


			<?php
			$sql = "select id from booking where status='Cancelled'";
			$query = $conn->prepare($sql);
			$query->execute();
			$results = $query->fetchAll(PDO::FETCH_OBJ);
			$cancelledBooking = $query->rowCount();
			?>
			<div class="col-lg-3 col-md-6 col-sm-12 mb-30">
				<a href="cancelled-booking.php">
					<div class="card-box pd-30 height-100-p" data-bgcolor="#949d0f">

						<div class="progress-box text-center">
							<h5 class="text-white padding-top-10 h5">Cancelled Booking</h5>
							<p class="text-white" style="font-size:25px;"><?php echo $cancelledBooking; ?></p>
						</div>

					</div>
				</a>
			</div>


			<?php
			$sql = "select id from booking";
			$query = $conn->prepare($sql);
			$query->execute();
			$results = $query->fetchAll(PDO::FETCH_OBJ);
			$totalBooking = $query->rowCount();
			?>
			<div class="col-lg-3 col-md-6 col-sm-12 mb-30">
				<a href="all-booking.php">
					<div class="card-box pd-30 height-100-p" data-bgcolor="#9d160f">

						<div class="progress-box text-center">
							<h5 class="text-white padding-top-10 h5">All Booking</h5>
							<p class="text-white" style="font-size:25px;"><?php echo $totalBooking; ?></p>
						</div>

					</div>
				</a>
			</div>


		</div>

		<div class="row clearfix progress-box">

			<?php
			$sql = "select id from contact where isRead is null";
			$query = $conn->prepare($sql);
			$query->execute();
			$results = $query->fetchAll(PDO::FETCH_OBJ);
			$unreadQueries = $query->rowCount();
			?>
			<div class="col-lg-6 col-md-6 col-sm-12 mb-30">
				<a href="unread-queries.php">
					<div class="card-box pd-30 height-100-p" data-bgcolor="#194391">

						<div class="progress-box text-center">
							<h5 class="text-white padding-top-10 h5">Unread Queries</h5>
							<p class="text-white" style="font-size:25px;"><?php echo $unreadQueries; ?></p>
						</div>

					</div>
				</a>
			</div>
			<?php
			//  }
			// }
			?>

			<?php
			$sql = "select id from contact where isRead='1'";
			$query = $conn->prepare($sql);
			$query->execute();
			$results = $query->fetchAll(PDO::FETCH_OBJ);
			$readQueries = $query->rowCount();
			?>
			<div class="col-lg-6 col-md-6 col-sm-12 mb-30">
				<a href="read-queries.php">
					<div class="card-box pd-30 height-100-p" data-bgcolor="#0a443c">

						<div class="progress-box text-center">
							<h5 class="text-white padding-top-10 h5">Read Queries</h5>
							<p class="text-white" style="font-size:25px;"><?php echo $readQueries; ?></p>
						</div>

					</div>
				</a>
			</div>
			<?php
			//  }
			// } 
			?>









		</div>
	</div>
</div>
		<?php
		include("base/footer.php");
		?>