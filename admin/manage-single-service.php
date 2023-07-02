<?php
session_start();
if (isset($_SESSION['phpstartup_adminid'])) {
    include "base/header.php";
    include 'base/db.php';
    $username = $_SESSION['phpstartup_adminid'];
    if (isset($_GET['id']) && $_GET['id']  != '') {
        $id = $_GET['id'];
    } else {
        echo "<script> location.href='manage-services.php'; </script>";
    }
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
                            <h4>Manage Service</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Manage Service</li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>
            <div class="pd-20 card-box mb-30">
                <div class="wizard-content">
                    <?php
                    $sql = "SELECT * from services e where e.id = $id";
                    $query = $conn->prepare($sql);
                    $query->execute();
                    $results = $query->fetch(PDO::FETCH_OBJ);
                    $name = $results->serviceName;
                    $description = $results->serviceDescription;
                    $price = $results->servicePrice;
                    $categoryId = $results->serviceCategory;
                    ?>
                    <form class="tab-wizard wizard-circle wizard" id="updateSingleServiceForm" method="post">
                        <section>
                            <div class="row">
                                <div class="col-md-12">
                                <div class="form-group">
                                        <label>Service Name</label>
                                        <input type="text" readonly hidden value="<?php echo $id; ?>" required class="form-control" placeholder="Required" name="serviceId">
                                        <input type="text" value="<?php echo $name; ?>" required class="form-control" placeholder="Required" name="serviceName">
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
                                                    echo '<option title="'.$row->name.'" ';  
                                                    if($categoryId == $row->id){
                                                        echo  "selected ";
                                                    }
                                                    echo' value="' . $row->id . '">' . $row->name . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Service Price</label>
                                        <input type="text" value="<?php echo $price; ?>" required class="form-control" placeholder="Required" name="servicePrice">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Service Description</label>
                                        <textarea class="form-control" rows="2" cols="20" placeholder="Required" name="serviceDescription">
                                        <?php echo $description; ?>
                                        </textarea>
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
                                        <input type="file" hidden name="fileToUpload[]" id="image-input" onchange="previewFiles(this)" multiple accept="image/*">
                                    </div>
                                    <div id="hold-uploaded-files">
                                        <div class="col-md-12 hold-images">
                                            <div class="image-row">
                                            <?php
                                            $imageSql = "SELECT * from service_images s where s.serviceId = $id";
                                            $imageQuery = $conn->prepare($imageSql);
                                            $imageQuery->execute();
                                            $imageResult = $imageQuery->fetchAll(PDO::FETCH_OBJ);
                                            if ($imageQuery->rowCount() > 0) {
                                                foreach ($imageResult as $image) {
                                                    echo '<div class="uploaded-item" id="holdItem' . $image->id . '">
                                                <img id="dataFile' . $image->id . '" src="../images/services/' . $image->path . '" alt="event image"/>                                    
                                                <button id="deleteFile' . $image->id . '" class="delete-button" type="button">Delete</button>
                                                </div>';
                                                }
                                            }
                                            ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="btn-list">
                                <input type="hidden" id="deletedFileIds" name="deletedFileIds" value="" />
                                <input type="hidden" id="deletedFileNames" name="deletedFileNames" value="" />
                                <button type="submit" name="submit" class="btn btn-success btn-lg btn-block">Update</button>
                            </div>
                        </section>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function previewFiles(input) {
                var fileArray = input.files;
                var imageContainer = document.querySelector('.hold-images .image-row');

                if (fileArray.length == 0) {
                    imageContainer.innerHTML = '';
                }

                for (var i = 0; i < fileArray.length; i++) {
                    var file = fileArray[i];
                    var reader = new FileReader();
                    reader.onload = (function(file) {
                        return function(e) {
                            var fileData = e.target.result;
                            var fileType = file.type;

                            var itemContainer = document.createElement('div');
                            itemContainer.classList.add('uploaded-item');

                            var imgElement = document.createElement('img');
                            imgElement.src = fileData;
                            itemContainer.appendChild(imgElement);

                            imageContainer.appendChild(itemContainer);

                        };
                    })(file);
                    reader.readAsDataURL(file);
                }

            }
        </script>
        <?php
        include("base/footer.php");
        ?>