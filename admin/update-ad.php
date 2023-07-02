<?php
session_start();
if (isset($_SESSION['phpstartup_adminid'])) {
    include "base/header.php";
    include 'base/db.php';
    $username = $_SESSION['phpstartup_adminid'];
    if(isset($_GET['id'])){
        $adId = $_GET['id'];
    }
    else{
        echo "<script> location.href='manage-ad.php'; </script>";    
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
                            <h4>Add Advertisement</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add Advertisement</li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>
            <div class="pd-20 card-box mb-30">

                <div class="clearfix">
                    <h4 class="text-blue h4">Add Advertisement</h4>
                </div>
                <div class="wizard-content">
                    <form id="update-advertisement" class="tab-wizard wizard-circle wizard" enctype="multipart/form-data" method="post">
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Screen Name</label>
                                        <select class="form-control" name="screen-group" id="screen-group-name">
                                            <?php
                                            $adSql = "SELECT * from ads where id = '$adId'";
                                            $adQuery = $conn->query($adSql);
                                            $adQuery->execute();
                                            $adItem = $adQuery->fetch(PDO::FETCH_OBJ);
                                            $sql = "SELECT id, name from pages";
                                            $query = $conn->query($sql);
                                            $query->execute();
                                            $result = $query->fetchAll(PDO::FETCH_OBJ);
                                            if ($query->rowCount() > 0) {
                                                foreach ($result as $row) {
                                                    echo '<option title="selectScreen" ';  
                                                    if($row->id == $adItem->screen_id){
                                                        echo " selected ";
                                                    }
                                                    echo'value="' . $row->id . '">' . $row->name . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                        <!-- <span id="username" class="text-danger font-weight-bold"> </span> -->
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ad Position</label>
                                        <select class="form-control" id="ad-posi" name="ad-position">
                                            <?php
                                            for($i = 1; $i <= 4; $i++){
                                                $name = "";
                                                switch ($i) {
                                                    case 1:
                                                        $name = "First Ad";
                                                        break;
                                                    case 2:
                                                        $name = "Second Ad";
                                                        break;
                                                    case 3:
                                                        $name = "Third Ad";
                                                        break;
                                                    case 4:
                                                        $name = "Fourth Ad";
                                                        break;
                                                }
                                                echo'<option '; 
                                                if($adItem->screen_index == $i){
                                                    echo " selected ";
                                                }
                                                echo'value="'.$i.'">'.$name.'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Ad On Click Redirect To</label>
                                        <input type="text" class="form-control" value="<?php echo $adItem->redirect_url; ?>" id="redirectUrlId" name="redirectUrl" placeholder="rediectTo.com" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-lg-2 col-form-label" for="val-image">Ad Image<span class="text-danger"></span>
                                        </label>
                                        <input type="file" id="image-input" name="fileToUpload" accept="image/*" onchange="previewImage(this)" />
                                        <input type="text" hidden value="<?php echo $adItem->path; ?>"  id="image-input" name="currentPath" />
                                        <input type="text" hidden value="<?php echo $adItem->id; ?>" required id="image-input" name="currentId" />
                                    </div>
                                    <img id="image-preview" src="../images/ads/<?php echo $adItem->path; ?>" alt="Image Preview">
                                </div>
                            </div>
                            <div class="btn-list">
                                <button type="submit" name="submit" class="btn btn-success btn-lg btn-block">Add</button>
                            </div>
                        </section>
                    </form>
                </div>
            </div>



            <script type="text/javascript">
                function previewImage(input) {
                    var preview = document.getElementById("image-preview");
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                        }
                        reader.readAsDataURL(input.files[0]);
                        $("#image-preview").css("display", "block");
                    }
                }
            </script>

        </div>
        <?php
        include("base/footer.php");
        ?>