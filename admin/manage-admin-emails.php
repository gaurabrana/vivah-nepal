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

    $serviceName = $_POST['serviceName'];
    $servicePrice = $_POST['servicePrice'];
    $servicDescription = $_POST['servicDescription'];


    $sql = "insert into services(serviceName,servicePrice,serviceDescription)values(:serviceName,:servicePrice,:servicDescription)";

    $query = $conn->prepare($sql);

    $query->bindParam(':serviceName', $serviceName, PDO::PARAM_STR);
    $query->bindParam(':servicePrice', $servicePrice, PDO::PARAM_STR);
    $query->bindParam(':servicDescription', $servicDescription, PDO::PARAM_STR);

    $query->execute();
}

$last_Id = $conn->lastInsertId();
if ($last_Id) {
    $msg = "Service Added successfully";
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
                            <h4>Admins Email Address</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Manage Customer Booking Notification</li>
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
                    <h4 class="text-red text-center h4">Admins Will Get Notified About Important Customer Activities</h4>
                </div>
                <div class="wizard-content">                    
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                <form class="tab-wizard wizard-circle wizard" id= "addNewNotifyEmailAddress">
                                    <div class="form-group">                                        
                                        <label>Add new email address</label>
                                        <input type="email" id="emailInput" required class="form-control" placeholder="Required" name="emailAddressForAdminNotification" />
                                        <input type="submit" class="btn btn-secondary btn-large mt-4" />
                                    </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <span class="badge badge-warning badge-pill mb-4">These admins will receive email</span>                                        
                                        <ul class="list-group" id="emailWithNotification">
                                        
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">                                    
                                        <span class="badge badge-secondary badge-pill mb-4">Admins available in system</span>
                                        <ul class="list-group" id="notAddedEmailWithNotification">
                                            <?php
                                            $sql = "SELECT * FROM admin WHERE email NOT IN (SELECT address FROM notify_admin_email) ORDER BY id ASC";
                                            $query = $conn->prepare($sql);                                            
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);

                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $row) {
                                                    echo ' <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    '.$row->email.'
                                                    <span id="holdAdminInfo'.$row->id.'" class="badge badge-success badge-pill addAdmin">Add</span>
                                                    <input type="text" hidden id="adminAvailable'.$row->id.'" value="'.$row->email.'" />
                                                </li>';
                                                }
                                            }
                                            ?>                                                                                      
                                        </ul>                                    
                                </div>

                            </div>
                        </section>
                    
                </div>
            </div>

        </div>
        <?php
        include("base/footer.php");
        ?>