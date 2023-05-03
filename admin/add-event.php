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

    $event = $_POST['event'];

    $sql = "insert into event(eventName)values(:event)";

    $query = $conn->prepare($sql);

    $query->bindParam(':event', $event, PDO::PARAM_STR);

    $query->execute();
}

$last_Id = $conn->lastInsertId();
if ($last_Id) {
    $msg = "Ticket Book successfully";
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
                            <h4>Add Event </h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add Event</li>
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
                    <h4 class="text-blue h4">Add Event</h4>
                </div>
                <div class="wizard-content">
                    <form class="tab-wizard wizard-circle wizard" method="post" onsubmit="return validation()">
                        <section>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="event" placeholder="Required" id="user">
                                        <span id="username" class="text-danger font-weight-bold"> </span>

                                    </div>
                                </div>
                                <div class="col-md-12">                                                    
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="val-image">Event Images<span class="text-danger"></span>
                            </label>
                            <div class="col-lg-3" id="imageHold">                                
                                <input type="file" name="subimages[]" id="imageSub" multiple style="display:none;" />
                                <img class="addSubImages" src="src/images/addimages.png" alt="#">
                            </div>
                        </div>
                        <div class="row mb-3" id="upstat">
                        
                        </div>
                        <div style="display:none;" id="hold-image-result" class="alert" role="alert">
                         
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
            function validation() {

                var user = document.getElementById('user').value;
                var numberofadult = document.getElementById('numof').value;
                var numberofchild = document.getElementById('numberofch').value;



                if (user == "") {
                    document.getElementById('username').innerHTML = " ** Please fill the username field";
                    return false;
                }
                if ((user.length <= 2) || (user.length > 30)) {
                    document.getElementById('username').innerHTML = " ** Username lenght must be between 2 and 20";
                    return false;
                }
                if (!isNaN(user)) {
                    document.getElementById('username').innerHTML = " ** only characters are allowed";
                    return false;
                }



                if (numberofadult == "") {
                    document.getElementById('numofadult').innerHTML = " ** Please fill number of adult";
                    return false;
                }
                if (isNaN(numberofadult)) {
                    document.getElementById('numofadult').innerHTML = " ** user must write digits only not characters";
                    return false;
                }



                if (numberofchild == "") {
                    document.getElementById('numofchild').innerHTML = " ** Please fill number of child";
                    return false;
                }
                if (isNaN(numberofchild)) {
                    document.getElementById('numofchild').innerHTML = " ** user must write digits only not characters";
                    return false;
                }

            }
        </script>        
        <?php
        include("base/footer.php");
        ?>