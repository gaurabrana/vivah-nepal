<?php
session_start();
error_reporting(0);
if (isset($_SESSION['user_id'])) {
    include "base/header.php";
    include "admin/base/db.php";
} else {
    echo "<script> location.href = 'index.php';</script>";
}

$isEventBooking = false;
$breadCrumbBottom = "";
$breadCrumbName = "";
$id = "";
// check book type and show accordingly form
if (isset($_GET['type']) && $_GET['type'] != null && isset($_GET['id']) && $_GET['id'] != null) {
    if ($_GET['type'] == "event") {
        $isEventBooking = true;
        $breadCrumbName = "Event";
    } else {
        $isEventBooking = false;
        $breadCrumbName = "Service";
    }
    $id = $_GET["id"];
    if ($isEventBooking) {
        $sql2 = "SELECT * from event where id = $id";
    } else {
        $sql2 = "SELECT * from services where id = $id";
    }
    $query2 = $conn->prepare($sql2);
    $query2->execute();
    $result2 = $query2->fetchAll(PDO::FETCH_OBJ);
}
?>

<div class="hero-wrap hero-wrap-2" data-stellar-background-ratio="1">
    <div class="overlay"></div>
    <div class="container-fluid">
        <div class="row no-gutters d-flex slider-text align-items-center justify-content-center" data-scrollax-parent="true">
            <div class="col-md-6 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
                <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="index.php">Home</a></span> <span>Booking <?php echo $breadCrumbName; ?></span></p>
                <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><?php echo $breadCrumbBottom; ?></h1>
            </div>
        </div>
    </div>
</div>

<!-- SubHeader =============================================== -->
<div class="container margin_60_30">
    <div class="row">
        <div class="col-md-12">
            <div class="box_style_general">
                <div class="indent_title_in">                 
                    <h3>Booking Details</h3>                    
                    <p></p>
                </div>
                <div class="wrapper_indent">
                    <div id="message-contact"></div>
                    <?php echo'<form class="bookingForm" id="'.$breadCrumbName.$id.'" method="post">'; ?>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <label>Event Name</label>
                                <div class="form-group">
                                    <select class="form-control" name="eventName" required>                                     
                                        <?php
                                        foreach ($result2 as $row) {
                                            if($isEventBooking){
                                                echo '<option selected value="'.htmlentities($row->eventName).'">'.htmlentities($row->eventName).'</option>';
                                            }
                                            else{
                                                echo '<option selected value="'.htmlentities($row->serviceName).'">'.htmlentities($row->serviceName).'</option>';
                                            }                                        
                                        } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label>Number of Guest</label>
                                    <input type="text" class="form-control styled" id="name_contact" name="numberOfGuest">
                                </div>
                            </div>



                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label>Booking From</label>
                                    <input type="text" class="form-control styled" id="datetimepicker1" placeholder="dd-mm-yy" name="bookingFrom">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label>Booking To</label>
                                    <input type="text" class="form-control styled" id="datetimepicker2" placeholder="dd-mm-yy" name="bookingTo">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Place</label>
                                    <input type="text" class="form-control styled" name="place">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Additional Information</label>
                                    <textarea rows="5" id="message_contact" name="message" class="form-control styled" style="height:100px;" placeholder="Your message"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button class="button add_bottom_30 btn-lg btn-block" id="submit-booking">Submit</button>
                                <br>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- End wrapper_indent -->
            </div>
            <!-- End box style 1-->
        </div>
        <!-- End col lg 9 -->

        <!--End aside -->
    </div>
    <!-- End row -->
</div>
<script>
    
</script>
<?php
include('base/footer.php');
?>