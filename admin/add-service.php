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
                            <h4>Add Service</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add Service</li>
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
                    <h4 class="text-blue h4">Add Service</h4>
                </div>
                <div class="wizard-content">
                    <form class="tab-wizard wizard-circle wizard" id="addNewServiceForm">
                        <section>
                            <div class="row">
                                <div class="col-md-12">
                                <div class="form-group">
                                        <label>Service Name</label>
                                        <input type="text" required class="form-control" placeholder="Required" name="serviceName">
                                        <!-- <span id="username" class="text-danger font-weight-bold"> </span> -->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                <div class="form-group">
                                        <label>Service Category</label>
                                        <select class="form-control" name="serviceCategory" id="screen-group-name">
                                            <?php
                                            $sql = "SELECT * from service_category";
                                            $query = $conn->query($sql);
                                            $query->execute();
                                            $result = $query->fetchAll(PDO::FETCH_OBJ);
                                            if ($query->rowCount() > 0) {
                                                foreach ($result as $row) {
                                                    echo '<option title="'.$row->name.'" value="' . $row->id . '">' . $row->name . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Service Price</label>
                                        <input type="text" required class="form-control" placeholder="Required" name="servicePrice">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Service Description</label>
                                        <textarea class="form-control" rows="2" cols="20" placeholder="Required" name="servicDescription"></textarea>
                                        <!-- <span id="numofadult" class="text-danger font-weight-bold"> </span> -->
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label>Service Images</label>
                                    <div>
                                        <label for="image-input">
                                        <div class="image-preview">
                                            <img src="../images/addImagePlaceholder.png" alt="Your Image" />
                                        </div>
                                        </label>
                                        <input type="file" hidden name="fileToUpload[]" id="image-input" onchange="previewHeroImage(this)" multiple accept="image/*">
                                    </div>                                    
                                    <div id="holdPreviewImagesFromSelection" class="row">

                                    </div>
                                </div>
                            </div>

                            <div class="btn-list">
                                <button type="submit" name="submit" class="btn btn-success btn-lg btn-block">Add</button>
                            </div>
                        </section>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript">
  function previewHeroImage(input) {

    document.getElementById('holdPreviewImagesFromSelection').innerHTML = '';
    if (input.files && input.files.length > 0) {
// Get the file input element and the container div
  var containerDiv = document.getElementById('holdPreviewImagesFromSelection');
      for (var i = 0; i < input.files.length; i++) {        
        var reader = new FileReader();
        reader.onload = function(e) {
        var img = document.createElement('img');
        img.src = e.target.result;
        // Append the image element to the container div
        var imageContainer = document.createElement('div');
        imageContainer.className = 'col-md-3';
        imageContainer.appendChild(img);  
        containerDiv.appendChild(imageContainer);      
        };
        reader.readAsDataURL(input.files[i]);
    }
    }
  }
</script>
        <?php
        include("base/footer.php");
        ?>