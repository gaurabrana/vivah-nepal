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
?>

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>About Us Page Details</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">About Us Page Details</li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>
            <div class="pd-20 card-box mb-30">

                <div class="clearfix">
                    <h4 class="text-blue h4">Company Details</h4>
                </div>
                <div class="wizard-content">
                    <form id="company-detail-page" class="tab-wizard wizard-circle wizard" method="post">
                        <section>
                            <div class="row">
                                <?php
                                $sql = "SELECT * from company_details";
                                $query = $conn->query($sql);
                                $query->execute();
                                $result = $query->fetchAll(PDO::FETCH_OBJ);
                                if ($query->rowCount() > 0) {
                                    foreach ($result as $row) {
                                        echo '<div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>' . $row->name . '</label>
                                                        <textarea class="form-control aboutUsDetails" id="detail' . $row->id . '" name="detail' . $row->id . '">
                                                        ' . $row->description . '
                                                        </textarea>
                                                    </div>
                                                </div>';
                                    }
                                }
                                ?>

                            </div>
                            <div class="btn-list">
                                <button type="submit" name="submit" class="btn btn-success btn-lg btn-block">Update</button>
                            </div>
                        </section>
                    </form>
                </div>
            </div>
            <div class="pd-20 card-box mb-30">

                <div class="clearfix">
                    <h4 class="text-blue h4">Update Details</h4>
                </div>
                <div class="wizard-content">
                    <form id="update-about-page" class="tab-wizard wizard-circle wizard" method="post">
                        <section>
                            <div class="row">
                                <?php
                                $sql = "SELECT * from about_us_page";
                                $query = $conn->query($sql);
                                $query->execute();
                                $result = $query->fetchAll(PDO::FETCH_OBJ);
                                if ($query->rowCount() > 0) {
                                    foreach ($result as $row) {
                                        echo '<div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>' . $row->name . '</label>
                                                        <input type="text" class="form-control aboutUsDetails" id="detail' . $row->id . '" name="detail' . $row->id . '" value="'.$row->value.'" />
                                                    </div>
                                                </div>';
                                    }
                                }
                                ?>

                            </div>
                            <div class="btn-list">
                                <button type="submit" name="submit" class="btn btn-success btn-lg btn-block">Update</button>
                            </div>
                        </section>
                    </form>
                </div>
            </div>
        </div>
        <?php
        include("base/footer.php");
        ?>