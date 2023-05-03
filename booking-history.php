<?php
session_start();
error_reporting(0);
if (isset($_SESSION['user_id'])) {
    include "base/header.php";
    include "admin/base/db.php";
} else {
    echo "<script> location.href = 'index.php';</script>";
}

if (isset($_REQUEST['delete'])) {
    $ids = $_REQUEST['id'];
    $sql = "DELETE FROM booking WHERE id = $ids";
    $result = $conn->query($sql);
}
?>

<div class="hero-wrap hero-wrap-2" data-stellar-background-ratio="1">
    <div class="overlay"></div>
    <div class="container-fluid">
        <div class="row no-gutters d-flex slider-text align-items-center justify-content-center" data-scrollax-parent="true">
            <div class="col-md-6 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
                <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="index.php">Home</a></span> <span>Booking History</span></p>
                <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Booking History</h1>
            </div>
        </div>
    </div>
</div>


<!--  End section-->

<div class="container margin_60_30">
    <form>
        <div class="col-md-12 ">
            <div class="box_style_general">
                <div class="form_title">
                    <br>
                    <h3>Recent Bookings</h3>
                    <br>
                </div>
                <div class="step">
                    <div class="row  table-responsive">


                        <table class="table table-striped"  style="border: 1px solid #5cb85c;">
                            <thead class="thead-dark">

                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Booking No</th>
                                    <th scope="col">Event Name</th>
                                    <th scope="col">Guest Size</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Booking Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>


                            </thead>
                            <tbody>
                                <?php
                                $user_Id = $_SESSION['user_id'];

                                $sql = "SELECT eventName, numberOfGuest, place  ,booking.bookingId,booking.bookingDate,booking.status,booking.id from booking join users on users.id=booking.userId where booking.userId='$user_Id'";

                                $query = $conn->prepare($sql);

                                $query->execute();

                                $results = $query->fetchAll(PDO::FETCH_OBJ);

                                $cnt = 1;
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) {
                                ?>
                                        <tr>
                                            <td><?php echo htmlentities($cnt); ?></td>
                                            <td><?php echo htmlentities($result->bookingId); ?></td>
                                            <td><?php echo htmlentities($result->eventName); ?></td>
                                            <td><?php echo htmlentities($result->numberOfGuest); ?></td>
                                            <td><?php echo htmlentities($result->place); ?></td>
                                            <td><?php echo htmlentities($result->bookingDate); ?></td>



                                            <?php if ($result->status == "") { ?>

                                                <td><span class="badge badge-danger"><?php echo "Pending"; ?></span></td>

                                            <?php } else { ?>

                                                <td>
                                                    <span class="badge badge-primary"><?php echo htmlentities($result->status); ?></span>
                                                </td>

                                            <?php } ?>


                                            <!-- <td>
                                                <a class="btn btn-success  btn-md" href="view-booking-details.php?editid=<?php echo htmlentities($result->id); ?>&&bookingid=<?php echo htmlentities($result->bookingId); ?>"><i class="icon-eye text-white"></i></a>

                                            </td> -->

                                            <td>
                                                <form action="" method="POST">
                                                    <input type="hidden" name="id" value="<?php echo htmlentities($result->id); ?>">

                                                    <div class="btn-group">
                                                        <button type="submit" class="btn btn-danger btn-md" name="delete"><i class="icon-trash" aria-hidden="true"></i></button>
                                                    </div>

                                                </form>
                                            </td>

                                        </tr>
                                <?php
                                        $cnt = $cnt + 1;
                                    }
                                }
                                ?>

                            </tbody>
                        </table>



                    </div>


                </div>
                <!--End step -->


            </div>

        </div>
    </form>
</div>
<!-- End row -->
</div>
<!-- End container -->

<?php

include("base/footer.php");
?>