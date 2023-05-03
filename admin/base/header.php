<!DOCTYPE html>
<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Vivah Nepal Admin System</title>
	<meta property="og:title" content="Vivah Nepal Admin System" />	
	<meta property="og:type" content="website" />
	<meta property="og:url" content="https://phpstartup.com/" />
	<meta name="author" content="Vivah Nepal">
	<meta name="twitter:site" content="@VivahNEpal">
	<meta property="og:site_name" content="Vivah Nepal">

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="vendors/images/logo.png">
	<link rel="icon" type="image/png" sizes="32x32" href="vendors/images/logo.png">
	<link rel="icon" type="image/png" sizes="16x16" href="vendors/images/logo.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/style.css">
	<link rel="stylesheet" type="text/css" href="src/styles/toastr.min.css">

</head>

<body>

	<div class="header">
		<div class="header-left">
			<div class="menu-icon dw dw-menu"></div>
			<div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
			<div class="header-search">

			</div>
		</div>
		<div class="header-right">

			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon">
							<img src="vendors/images/photo1.jpg" alt="">
						</span>
						<span class="user-name">Admin</span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						<a class="dropdown-item" href="profile.php"><i class="dw dw-user1"></i> Profile</a>
						<a class="dropdown-item" href="password.php"><i class="dw dw-settings2"></i> Setting</a>
						<a class="dropdown-item" href="logout.php"><i class="dw dw-logout"></i> Log Out</a>
					</div>
				</div>
			</div>

		</div>
	</div>
	<div class="left-side-bar">
		<div class="brand-logo">
			<a href="home.php">
				<img src="vendors/images/logo.png" alt="" class="dark-logo">
				<img src="vendors/images/logo.png" alt="" class="light-logo">
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					<li>
						<a href="home.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-calendar1"></span><span class="mtext">Home</span>
						</a>
					</li>


					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-edit2"></span><span class="mtext">Services</span>
						</a>
						<ul class="submenu">
							<li><a href="add-service.php">Add Service</a></li>
							<li><a href="manage-services.php">Manage Services</a></li>

						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-library"></span><span class="mtext">All Events</span>
						</a>
						<ul class="submenu">
							<li><a href="add-event.php">Add Event</a></li>
							<li><a href="manage-event.php">Manage Event</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-copy"></span><span class="mtext">All Pages</span>
						</a>
						<ul class="submenu">
							<li><a href="manage-pages.php">Manage Pages</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-copy"></span><span class="mtext">Booking</span>
						</a>
						<ul class="submenu">
							<li><a href="new-booking.php">New Booking</a></li>
							<li><a href="approved-booking.php">Approved Booking</a></li>
							<li><a href="cancelled-booking.php">Cancelled Booking</a></li>
							<li><a href="all-booking.php">All Booking</a></li>
						</ul>
					</li>

					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-copy"></span><span class="mtext">Gallery</span>
						</a>
						<ul class="submenu">
							<li><a href="manage-ad.php">Add Images</a></li>
							<li><a href="add-ad.php">Add Videos</a></li>
						</ul>
					</li>

					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-copy"></span><span class="mtext">Manage Ads</span>
						</a>
						<ul class="submenu">
							<li><a href="add-ad.php">Add New Ad</a></li>					
							<li><a href="manage-ad.php">Manage Ads</a></li>
						</ul>
					</li>

					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-copy"></span><span class="mtext">About Us Details</span>
						</a>
						<ul class="submenu">
							<li><a href="manage-ad.php">Update Details</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-paint-brush"></span><span class="mtext">Enquiry</span>
						</a>
						<ul class="submenu">
							<li><a href="unread-queries.php">Unread Queries</a></li>
							<li><a href="read-queries.php">Read Queries</a></li>

						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-paint-brush"></span><span class="mtext">Report</span>
						</a>
						<ul class="submenu">
							<li><a href="report.php">Report</a></li>

						</ul>
					</li>

					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-paint-brush"></span><span class="mtext">Search</span>
						</a>
						<ul class="submenu">
							<li><a href="search.php">Search</a></li>

						</ul>
					</li>
					<li>
						<div class="sidebar-small-cap">Extra</div>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-analytics-21"></span><span class="mtext">Profile</span>
						</a>
						<ul class="submenu">
							<li><a href="profile.php">Profile</a></li>
							<li><a href="password.php">Password</a></li>
							<li><a href="logout.php">Logout</a></li>

						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="mobile-menu-overlay"></div>