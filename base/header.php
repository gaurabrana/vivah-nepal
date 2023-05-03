<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Vivah Nepal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta property="og:title" content="VIVAH NEPAL" />
    <meta name="description" content="VIVAH NEPAL">
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="css/toastr.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/ad-container.css">
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar ftco-navbar-light" id="ftco-navbar">
  <div class="container-fluid">
  <a href="index.php">
    <img id="smallDeviceLogo" class="logo-image" src="images/logo/logo.png">
    <img id="scrolledLogo" class="logo-image" src="images/logo/large_black.png">
  </a>  
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="oi oi-menu"></span> Menu
    </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
      <ul class="navbar-nav first-link">        
        <li class="nav-item"><a href="services.php" class="nav-link">Wedding Services</a></li>
        <li class="nav-item"><a class="nav-link" href="rituals.php">Family Rituals</a></li>
        <li class="nav-item"><a href="event.php" class="nav-link">Event Management</a></li>
      </ul>
      <a class="navbar-brand" href="index.php">
      <img id="centerLogo" class="logo-image" src="images/logo/logo.png">
      <img id="scrolledCenterLogo" class="logo-image" src="images/logo/large_black.png">
      </a>
      <ul class="navbar-nav last-link">
        <li class="nav-item"><a href="gallery.php" class="nav-link">Gallery</a></li>
        <li class="nav-item"><a href="blog.php" class="nav-link">Blog</a></li>
        <li class="nav-item"><a href="about.php" class="nav-link">About Us</a></li>
        <?php
        if(!isset($_SESSION)){
          session_start();
        }
        if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != null){          
        echo'<li class="nav-item">
        <div class="btn-group">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
          My Account
        </button>
        <div class="dropdown-menu">
        <a class="dropdown-item cta" href="#">Profile</a>
        <a class="dropdown-item cta" href="booking-history.php">Booking History</a>            
        <div class="dropdown-divider"></div>
        <a class="dropdown-item cta" href="logout.php">Logout</a>
        </div>
      </div></li>';          
        }
        else{
        echo'<li class="nav-item cta"><a href="login.php"><span>Login</span></a></li>';
      }
        ?>
      </ul>
    </div>
  </img>
</nav>