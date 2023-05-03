<?php
session_start();
if (isset($_SESSION['phpstartup_adminid'])) {
    include "base/header.php";
    include 'base/db.php';
    $username = $_SESSION['phpstartup_adminid'];
  } else {
    echo "<script> location.href='index.php'; </script>";
  } 
  
$msg = "";
$error = "";

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];

    $sql = "update admin set name=:name,mobile=:mobile,email=:email";

    $query = $conn->prepare($sql);

    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);


    $result = $query->execute();
}


if ($result) {
    $msg = "Profile Update successfully";
} else {
    $error = "Something went wrong. Please try again";
}
?>


<div class="main-container">

    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Admin Profile</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Admin Profile</li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>


            <?php
            if (isset($_POST['submit'])) {
                if ($error) {
            ?>


                    <div class="alert alert-danger" role="alert">
                        <?php echo htmlentities($error); ?>
                    </div>


                <?php
                } else if ($msg) {
                ?>


                    <div class="alert alert-primary" role="alert">
                        <?php echo htmlentities($msg); ?>
                    </div>


            <?php
                }
            }
            ?>
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <h4 class="text-blue h4">Admin Profile</h4>
                </div>
                <div class="wizard-content">

                    <?php
                    $sql = "SELECT * from admin";

                    $query = $conn->prepare($sql);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    if ($query->rowCount() > 0) {
                        foreach ($results as $result) {
                    ?>
                            <form class="tab-wizard wizard-circle wizard" method="post" onsubmit="return validation()">
                                <h5>Personal Info</h5>
                                <section>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control" name="name" id="user" value="<?php echo $result->name; ?>">
                                                <span id="username" class="text-danger font-weight-bold"> </span>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>User Name</label>
                                                <input type="text" class="form-control" name="userName" value="<?php echo $result->userName; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                       
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Mobile</label>
                                                <input type="text" class="form-control" name="mobile" id="mobileNumber" value="<?php echo $result->mobile; ?>">
                                                <span id="mobileno" class="text-danger font-weight-bold"> </span>

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" class="form-control" name="email" id="emails" value="<?php echo $result->email; ?>">
                                                <span id="emailids" class="text-danger font-weight-bold"> </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="btn-list">
                                        <button type="submit" name="submit" class="btn btn-success btn-lg btn-block">Update</button>
                                    </div>
                                </section>

                            </form>
                    <?php }
                    } ?>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            function validation() {

                var user = document.getElementById('user').value;
                var mobileNumber = document.getElementById('mobileNumber').value;
                var emails = document.getElementById('emails').value;





                if (user == "") {
                    document.getElementById('username').innerHTML = " ** Please fill the username field";
                    return false;
                }
                if ((user.length <= 2) || (user.length > 30)) {
                    document.getElementById('username').innerHTML = " ** Username lenght must be between 2 and 20";
                    return false;
                }
                if (!isNaN(user)) {
                    document.getElementById('username').innerHTML = " ** only characters are allowed";
                    return false;
                }





                if (mobileNumber == "") {
                    document.getElementById('mobileno').innerHTML = " ** Please fill the mobile NUmber field";
                    return false;
                }
                if (isNaN(mobileNumber)) {
                    document.getElementById('mobileno').innerHTML = " ** user must write digits only not characters";
                    return false;
                }
                if (mobileNumber.length != 10) {
                    document.getElementById('mobileno').innerHTML = " ** Mobile Number must be 10 digits only";
                    return false;
                }



                if (emails == "") {
                    document.getElementById('emailids').innerHTML = " ** Please fill the email idx` field";
                    return false;
                }
                if (emails.indexOf('@') <= 0) {
                    document.getElementById('emailids').innerHTML = " ** @ Invalid Position";
                    return false;
                }

                if ((emails.charAt(emails.length - 4) != '.') && (emails.charAt(emails.length - 3) != '.')) {
                    document.getElementById('emailids').innerHTML = " ** . Invalid Position";
                    return false;
                }






             









            }
        </script>
        <?php
        include("base/footer.php");
        ?>