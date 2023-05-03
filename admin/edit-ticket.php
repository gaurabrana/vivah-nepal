<?php
session_start();
if (isset($_SESSION['phpstartup_adminid'])) {
    include "base/header.php";
    include 'base/db.php';
    $username = $_SESSION['phpstartup_adminid'];
  } else {
    echo "<script> location.href='index.php'; </script>";
  }

$pid = $_GET['pid'];

if (isset($_POST['submit'])) {
    $ticketType = $_POST['ticketType'];
    $price = $_POST['price'];


    $sql = "update tickettype set ticketType=:ticketType,price=:price where id=:pid";

    $query = $conn->prepare($sql);

    $query->bindParam(':ticketType', $ticketType);
    $query->bindParam(':price', $price);
    $query->bindParam(':pid', $pid);

    $last_Id = $query->execute();
}
?>

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Form Wizards</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Form Wizards</li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>

            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <h4 class="text-blue h4">Step wizard</h4>
                </div>
                <div class="wizard-content">

                    <?php

                    $sql = "SELECT * FROM tickettype where id=:pid";
                    $query = $conn->prepare($sql);
                    $query->bindParam(':pid', $pid);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    if ($query->rowCount() > 0) {
                        foreach ($results as $result) {
                    ?>

                            <form class="tab-wizard wizard-circle wizard" method="post">
                                <h5>Personal Info</h5>
                                <section>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control" value="<?php echo $result->ticketType; ?>" name="ticketType" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Mobile Number</label>
                                                <input type="text" class="form-control" value="<?php echo $result->price; ?>" name="price">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="btn-list">
                                        <button type="submit" name="submit" class="btn btn-success btn-lg btn-block">Update Ticket</button>
                                    </div>
                                </section>

                            </form>
                    <?php
                        }
                    } ?>

                </div>
            </div>

        </div>
        <?php
        include("base/footer.php");
        ?>