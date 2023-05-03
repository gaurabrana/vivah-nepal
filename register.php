<?php
include "base/header.php";
include 'admin/base/db.php';
$breadCrumbName = "Register";
if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $mobile = $_POST['mobile'];    
    $address = $_POST['address'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $sql = "insert into users(name,mobile,email,password,address)values(:name,:email,:mobile,:password,:address)";

    $query = $conn->prepare($sql);

    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);    
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->bindParam(':address', $address, PDO::PARAM_STR);


    $query->execute();

    if ($query) {
        echo "<script> location.href='login.php'; </script>";
    }
}
?>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v16.0&appId=1651042871982825&autoLogAppEvents=1" nonce="TTwLJyAv"></script>
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

            <div class="col-lg-6 col-lg-offset-3">
                <div class="box_login">
                    <strong><i class="icon_lock-open_alt"></i>
                        <h3>Create an account</h3>
                    </strong>
                    <form method="post">
                        <div class="form-group">
                            <input type="text" class=" form-control" name="name" placeholder="Name">
                            <span class="input-icon"><i class="icon_pencil-edit"></i></span>
                        </div>
                        <div class="form-group">
                            <input type="text" class=" form-control" name="mobile" placeholder="Mobile">
                            <span class="input-icon"><i class="icon_mobile"></i></span>
                        </div>                                                
                        <div class="form-group">
                            <input type="text" class=" form-control" name="address" placeholder="Address ">
                            <span class="input-icon"><i class="icon_house_alt"></i></span>
                        </div>
                        <div class="form-group">
                            <input type="email" class=" form-control" name="email" placeholder="Email ">
                            <span class="input-icon"><i class="icon_mail_alt"></i></span>
                        </div>
                        <div class="form-group">
                            <input type="password" class=" form-control" name="password" placeholder="Password ">
                            <span class="input-icon"><i class="icon_house_alt"></i></span>
                        </div>
                        <div id="pass-info" class="clearfix"></div>

                        <button type="submit" class="btn btn-primary button_login" name="submit">Create</button>                        
                            <a href="login.php" class="btn btn-secondary button_login" name="submit">Login as existing user</a>
                            
                    </form>
                </div>
                <br>
                <br>
            </div>

        </div>
  </div>
</section>
<?php
include('base/footer.php');
?>