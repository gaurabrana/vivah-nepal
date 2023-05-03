<?php
session_start();
error_reporting(0);

if (isset($_SESSION['phpstartup_adminid'])) {
    include "base/header.php";
    include 'base/db.php';
    $username = $_SESSION['phpstartup_adminid'];
} else {
    echo "<script> location.href='index.php'; </script>";
}


$viewid = $_GET['viewid'];

$isRead = 1;

$sql = "update contact set isRead=:isRead where id=:viewid";

$query = $conn->prepare($sql);

$query->bindParam(':isRead', $isRead, PDO::PARAM_STR);
$query->bindParam(':viewid', $viewid, PDO::PARAM_STR);

$query->execute();
?>

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Manage Foreigners Ticket</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Manage Foreigners Ticket</li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>

            <!-- Export Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Manage Foreigners Ticket</h4>
                </div>
                <div class="pb-20">


                    <?php

                    $sql = "SELECT * from contact where id=$viewid";

                    $query = $conn->prepare($sql);

                    $query->execute();

                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                    $cnt = 1;

                    if ($query->rowCount() > 0) {
                        foreach ($results as $row) {
                    ?>
                            <table class="table table-bordered table-striped ">
                                <tr style="background-image: linear-gradient(#0b92b1,#841caf);">
                                    <th colspan="5" style="text-align: center;font-size: 19px;color: #ffffff;">Booking Number: dfgd</th>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td><?php echo ($row->fname); ?> <?php echo ($row->lname); ?></td>

                                </tr>


                                <tr>
                                    <th>Email</th>
                                    <td><?php echo ($row->email); ?></td>

                                </tr>

                                <tr>
                                    <th>Phone</th>
                                    <td><?php echo ($row->phone); ?></td>

                                </tr>

                                <tr>
                                    <th>Subject</th>
                                    <td><?php echo ($row->subject); ?></td>

                                </tr>


                                <tr>
                                    <th>Message </th>
                                    <td><?php echo ($row->message); ?></td>

                                </tr>



                            </table>
                    <?php
                            $cnt = $cnt + 1;
                        }
                    }
                    ?>



                </div>
            </div>
            <!-- Export Datatable End -->
        </div>
        <?php
        include("base/footer.php");
        ?>

        <!-- js -->
        <script src="vendors/scripts/script.min.js"></script>
        <script src="vendors/scripts/process.js"></script>
        <script src="vendors/scripts/layout-settings.js"></script>
        <script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
        <script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
        <script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
        <script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
        <!-- buttons for Export datatable -->
        <script src="src/plugins/datatables/js/dataTables.buttons.min.js"></script>
        <script src="src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
        <script src="src/plugins/datatables/js/buttons.print.min.js"></script>
        <script src="src/plugins/datatables/js/buttons.html5.min.js"></script>
        <script src="src/plugins/datatables/js/buttons.flash.min.js"></script>
        <script src="src/plugins/datatables/js/pdfmake.min.js"></script>
        <script src="src/plugins/datatables/js/vfs_fonts.js"></script>
        <!-- Datatable Setting js -->
        <script src="vendors/scripts/datatable-setting.js"></script>
        </body>