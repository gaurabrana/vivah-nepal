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
$hiddenAttr = "";
// check book type and show accordingly form
if (isset($_GET['type']) && $_GET['type'] != null && isset($_GET['id']) && $_GET['id'] != null) {
    if ($_GET['type'] == "event") {
        $isEventBooking = true;
        $breadCrumbName = "Event";
        $hiddenAttr = " readonly ";
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
    $row = $query2->fetch(PDO::FETCH_OBJ);
}
?>

<style>
    #overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 9999;
  display: none;
}

.loader {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  border: 16px solid #f3f3f3;
  border-top: 16px solid #3498db;
  border-radius: 50%;
  width: 120px;
  height: 120px;
  animation: spin 2s linear infinite;
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

</style>

<div class="hero-wrap hero-wrap-2" data-stellar-background-ratio="1">

    <div class="container-fluid">
        <div class="row no-gutters d-flex slider-text align-items-center justify-content-center" data-scrollax-parent="true">
            <div class="col-md-6 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
                <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="index.php">Home</a></span> <span>Booking <?php echo $breadCrumbName; ?></span></p>
                <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><?php echo $breadCrumbBottom; ?></h1>
            </div>
        </div>
    </div>
</div>

<div id="overlay">
  <div class="loader"></div>
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
                                <label><?php echo $breadCrumbName; ?> Name</label>
                                <div class="form-group">
                                    <select class="form-control" name="eventName" required>                                     
                                        <?php                                        
                                            if($isEventBooking){
                                                echo '<option selected value="'.htmlentities($row->eventName).'">'.htmlentities($row->eventName).'</option>';
                                            }
                                            else{
                                                echo '<option selected value="'.htmlentities($row->serviceName).'">'.htmlentities($row->serviceName).'</option>';
                                            }                                        
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label>Number of Guest</label>
                                    <div class="product-size"> 
                                    <input type="text" class="form-control styled" name="numberOfGuest">                                                                      
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label>Booking From</label>                                    
                                    <input type="date" value="<?php if($isEventBooking) echo $row->startDate; ?>"  class="form-control styled" id= <?php if(!$isEventBooking) echo "datetimepicker1"; ?> placeholder="dd-mm-yy" name="bookingFrom">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label>Booking To</label>
                                    <input type="date" value="<?php if($isEventBooking) echo $row->endDate; ?>" class="form-control styled" id= <?php if(!$isEventBooking) echo "datetimepicker2"; ?> placeholder="dd-mm-yy" name="bookingTo">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                                    <label>Place</label>
                                    <input <?php echo $hiddenAttr; ?> type="text" value="<?php if($isEventBooking) echo $row->location; ?>" class="form-control styled" name="place">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label>Booking Price (Rs)</label>
                                    <input readonly type="text" value="<?php if($isEventBooking) { echo $row->price; } else{ echo $row->servicePrice; } ?>" class="form-control styled" />
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
                                <button class="button add_bottom_30 btn-lg btn-block btn-secondary" id="submit-booking">Submit</button>
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

    var datePicker1 = document.getElementById('datetimepicker1');
    var datePicker2 = document.getElementById('datetimepicker2');

      var today = new Date().toISOString().split('T')[0];
      datePicker1.setAttribute('min', today);

      datePicker1.addEventListener('change', function() {                
                var startDate = new Date(datePicker1.value);
                var endDate = new Date(datePicker2.value);

                if (startDate > endDate || !endDate) {
                    datePicker2.value = datePicker1.value;
                }

                // Set the minimum selectable date for the end date input
                datePicker2.min = datePicker1.value;
            });
</script>
<?php
include('base/footer.php');
?>