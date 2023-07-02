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
                    <h4 class="text-blue h4">Add Advertisement</h4>
                </div>
                <div class="wizard-content">
                    <form id="add-advertisement" class="tab-wizard wizard-circle wizard" enctype="multipart/form-data" method="post">
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Screen Name</label>
                                        <select class="form-control" name="screen-group" id="screen-group-name">
                                            <?php
                                            $sql = "SELECT id, name from pages";
                                            $query = $conn->query($sql);
                                            $query->execute();
                                            $result = $query->fetchAll(PDO::FETCH_OBJ);
                                            if ($query->rowCount() > 0) {
                                                foreach ($result as $row) {
                                                    echo '<option title="selectScreen" value="' . $row->id . '">' . $row->name . '</option>';
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
                                            <option value="new">Choose Position</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Ad On Click Redirect To</label>
                                        <input type="text" class="form-control" id="redirectUrlId" name="redirectUrl" placeholder="rediectTo.com" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-lg-2 col-form-label" for="val-image">Ad Image<span class="text-danger"></span>
                                        </label>
                                        <input type="file" required id="image-input" name="fileToUpload" accept="image/*" onchange="previewImage(this)">
                                    </div>
                                    <img id="image-preview" src="" alt="Image Preview">
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