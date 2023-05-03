<?php
include "base/header.php";
include 'admin/base/db.php';
$breadCrumbName = "Login";

if (isset($_POST['login'])) {

	$email = $_POST['email'];
	$password = $_POST['password'];

	$sql = "SELECT id,name FROM users WHERE email=:email and password=:password";

	$query = $conn->prepare($sql);

	$query->bindParam(':email', $email, PDO::PARAM_STR);
	$query->bindParam(':password', $password, PDO::PARAM_STR);

	$query->execute();

	$results = $query->fetchAll(PDO::FETCH_OBJ);

	if ($query->rowCount() > 0) {
		foreach ($results as $result) {

			$_SESSION['user_id'] = $result->id;
      $_SESSION['name'] = $result->name;      
		}
		$_SESSION['login'] = $_POST['email'];

		echo "<script type='text/javascript'> document.location ='index.php'; </script>";

	} else {

		echo "<script>alert('Invalid Details');</script>";
	}
}

//Include Google Configuration File
include('google/config.php');

   //Create a URL to obtain user authorization
  $google_login_btn = '<a href="'.$google_client->createAuthUrl().'"><img class="google-signInButton" src="https://th.bing.com/th/id/OIP.pZ6bfFCJw4r8KiSEhPXdsQAAAA?pid=ImgDet&rs=1" /></a>';
?>
<div class="hero-wrap hero-wrap-2" style="background-image: url(images/bg_2.jpg);" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container-fluid">
    <div class="row no-gutters d-flex slider-text align-items-center justify-content-center" data-scrollax-parent="true">
      <div class="col-md-6 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
        <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="index.php">Home</a></span> <span><?php echo $breadCrumbName; ?></span></p>
        <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><?php echo $breadCrumbName; ?></h1>
      </div>
    </div>
  </div>
</div>

<section class="exclusive_item_part blog_item_section">
  <div class="container">
    <div class="row">
      <div class="col-xl-5">
        <div class="section_tittle">
          <p></p>
          <h2><?php echo $breadCrumbName; ?></h2>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
            <div class="col-lg-6 col-lg-offset-3 col-sm-6">
                <div class="box_login">
                    <form method="post">
                        <strong><i class="icon_key_alt"></i>
                            <h3>Please Login</h3>
                        </strong>
                        <div class="form-group">
                            <input type="text" class=" form-control " placeholder="Username" name="email">
                            <span class="input-icon"><i class="icon_pencil-edit"></i></span>
                        </div>
                        <div class="form-group" style="margin-bottom:5px;">
                            <input type="text" class=" form-control" placeholder="Password" style="margin-bottom:5px;" name="password">
                            <span class="input-icon"><i class="icon_lock_alt"></i></span>
                        </div>
                        <p class="small">
                            <a href="#">Forgot Password?</a>                                                        
                        </p>
                        <button type="submit" name="login" class="btn btn-primary button_login">Log in</button>                        
                        <a href="register.php" class="btn btn-secondary button_register">Register as New?</a>
                        <div class="panel panel-default">
                        <?php
                          echo '<div>'.$google_login_btn . '</div>';
                        ?>
                        </div>
                    </form>
                    <br>
                    <br>
                </div>
            </div>

        </div>
  </div>
</section>
<?php
include('base/footer.php');
?>