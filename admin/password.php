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
    $adminId = $_SESSION['phpstartup_adminid'];

    $currentpassword = $_POST['currentpassword'];
    $newpassword = $_POST['newpassword'];

    $sql1 = "SELECT id FROM admin WHERE id=:adminId and password=:currentpassword";

    $query = $conn->prepare($sql1);

    $query->bindParam(':adminId', $adminId, PDO::PARAM_STR);
    $query->bindParam(':currentpassword', $currentpassword, PDO::PARAM_STR);

    $query->execute();

    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if ($query->rowCount() > 0) {

        $sql2 = "update admin set password=:newpassword where id=:adminId";

        $changePassword = $conn->prepare($sql2);

        $changePassword->bindParam(':adminId', $adminId, PDO::PARAM_STR);
        $changePassword->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);

        $changePassword->execute();

        $msg = "Your password successully changed";
    } else {
        $error = "Your current password is wrong";
    }
}
?>


<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Change Password</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Change Password</li>
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
                    <h4 class="text-blue h4">Change Password</h4>
                </div>
                <div class="wizard-content">
                    <form class="tab-wizard wizard-circle wizard" name="changepassword" method="post" onSubmit="return password();">
                        <h5>Personal Info</h5>
                        <section>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Current Password</label>
                                        <input type="text" class="form-control" name="currentpassword" id="currentpassword" placeholder="Required">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>New Password</label>
                                        <input type="text" class="form-control" name="newpassword" id="newpassword" placeholder="Required">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input type="text" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="Required">

                                    </div>
                                </div>

                            </div>

                            <div class="btn-list">
                                <button type="submit" name="submit" class="btn btn-success btn-lg btn-block">Add Ticket</button>
                            </div>
                        </section>
                    </form>
                </div>
            </div>


        </div>
        <script type="text/javascript">
            function password() {
                if (document.changepassword.newpassword.value != document.changepassword.confirmpassword.value) {
                    alert('New Password and Confirm Password Not Match');
                    document.changepassword.confirmpassword.focus();
                    return false;
                }
                return true;
            }
        </script>
        <?php
        include("base/footer.php");
        ?>