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

if (isset($_POST['submit'])) {


  $editid = $_GET['editid'];
  $status = $_POST['status'];
  $remark = $_POST['remark'];


  $sql = "update booking set status=:status,remark=:remark where id=:editid";

  $query = $conn->prepare($sql);

  $query->bindParam(':editid', $editid, PDO::PARAM_STR);
  $query->bindParam(':status', $status, PDO::PARAM_STR);
  $query->bindParam(':remark', $remark, PDO::PARAM_STR);

  $query->execute();

  echo '<script>alert("Booking has been updated")</script>';
  echo "<script>window.location.href ='all-booking.php'</script>";
}
?>

<div class="main-container">
  <div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
      <div class="page-header">
        <div class="row">
          <div class="col-md-6 col-sm-12">
            <div class="title">
              <h4>Booking Details</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Booking Details</li>
              </ol>
            </nav>
          </div>

        </div>
      </div>

      <!-- Export Datatable start -->
      <div class="card-box mb-30">
        <div class="pd-20">
          <h4 class="text-blue h4">Booking Details</h4>
        </div>
        <div class="pb-20">


          <?php
          $editid = $_GET['editid'];

          $sql = "SELECT users.name,users.mobile,users.age,users.gender,users.email,users.address,booking.bookingId,booking.eventName,booking.numberOfGuest,booking.bookingFrom,booking.bookingTo,booking.place,booking.message,booking.bookingDate,booking.remark,booking.status,booking.postDate,   services.serviceName,services.servicePrice,services.servicDescription from booking join services on booking.eventId=services.id join users on users.id=booking.userId  where booking.id=:editid";

          $query = $conn->prepare($sql);

          $query->bindParam(':editid', $editid, PDO::PARAM_STR);

          $query->execute();

          $results = $query->fetchAll(PDO::FETCH_OBJ);


          if ($query->rowCount() > 0) {
            foreach ($results as $row) {
          ?>
              <table class="table table-bordered table-striped ">
                <tr style="background-image: linear-gradient(#0b92b1,#841caf);">
                  <th colspan="5" style="text-align: center;font-size: 19px;color: #ffffff;">Booking Number: <?php echo $row->bookingId; ?></th>
                </tr>
                <tr>
                  <th> Name</th>
                  <td><?php echo $row->name; ?></td>
                  <th>Mobile</th>
                  <td><?php echo $row->mobile; ?></td>
                </tr>


                <tr>
                  <th>Age</th>
                  <td><?php echo $row->age; ?></td>
                  <th>Gender</th>
                  <td><?php echo $row->gender; ?></td>
                </tr>

                <tr>
                  <th>Email</th>
                  <td><?php echo $row->email; ?></td>
                  <th>Address</th>
                  <td><?php echo $row->address; ?></td>
                </tr>

                <tr>
                  <th>Event Name</th>
                  <td><?php echo $row->eventName; ?></td>
                  <th>No Of Guest</th>
                  <td><?php echo $row->numberOfGuest; ?></td>
                </tr>
                <tr>

                  <th>Booking From</th>
                  <td><?php echo $row->bookingFrom; ?></td>
                  <th>Booking To</th>
                  <td><?php echo $row->bookingTo; ?></td>
                </tr>

                <tr>
                  <th>Place</th>
                  <td><?php echo $row->place; ?></td>
                  <th>Message</th>
                  <td><?php echo $row->message; ?></td>
                </tr>

                <tr>
                  <th>Service Name</th>
                  <td><?php echo $row->serviceName; ?></td>
                  <th>Service Price</th>
                  <td>$<?php echo $row->servicePrice; ?></td>
                </tr>

                <tr>
                  <th>Service Description</th>
                  <td><?php echo $row->servicDescription; ?></td>
                  <th>Booking Date</th>
                  <td><?php echo $row->bookingDate; ?></td>
                </tr>


                <th>Order Final Status</th>

                <td>
                  <?php
                  $status = $row->status;

                  if ($row->status == "Approved") {
                    echo "Approved";
                  }

                  if ($row->status == "Cancelled") {
                    echo "Cancelled";
                  }


                  if ($row->status == "") {
                    echo "Not Responsed";
                  };
                  ?>
                </td>

                <th>Admin Remark</th>
                <?php if ($row->status == "") { ?>

                  <td><?php echo "Not Updated"; ?></td>
                <?php } else { ?>
                  <td><?php echo htmlentities($row->remark); ?></td>
                <?php } ?>
                </tr>




              </table>
          <?php
            }
          }
          ?>



          <?php
          if ($status == "") {
          ?>

            <p align="center" style="padding-top: 20px">
              <button class="btn btn-primary waves-effect waves-light w-lg" data-toggle="modal" data-target="#myModal">Take Action</button>
            </p>

          <?php
          }
          ?>




          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Take Action</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <table class="table table-bordered table-hover data-tables">

                    <form method="post" name="submit">
                      <tr>
                        <th>Remark:</th>
                        <td>
                          <textarea name="remark" placeholder="Remark" rows="12" cols="14" class="form-control wd-450" required="true"></textarea>
                        </td>
                      </tr>
                      <tr>
                        <th>Status:</th>
                        <td>
                          <select name="status" class="form-control wd-450" required="true">
                            <option value="Approved" selected="true">Approved</option>
                            <option value="Cancelled">Cancelled</option>
                          </select>
                        </td>
                      </tr>
                  </table>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" name="submit" class="btn btn-primary">Update</button>
                  </form>
                </div>
              </div>
              <!-- END Bootstrap Register -->
            </div>

          </div>


        </div>
      </div>
      <!-- Export Datatable End -->
    </div>


    <script>
      function display() {
        window.print();
      }
    </script>


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