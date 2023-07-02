<?php
session_start();
if (isset($_SESSION['phpstartup_adminid'])) {
    include "base/header.php";
    include 'base/db.php';
    $username = $_SESSION['phpstartup_adminid'];
  } else {
    echo "<script> location.href='index.php'; </script>";
  }

?>


<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Message Developer </h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Message Developer</li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>

            <div class="pd-20 card-box mb-30">               
                <div class="wizard-content">


                    <form id="messageDeveloper" class="tab-wizard wizard-circle wizard" method="post" autocomplete="off">
                        <section>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Message</label>
                                        <textarea type="text" class="form-control" name="messageDev" required></textarea>
                                    </div>
                                </div>                                
                            </div>

                            <div class="btn-list">
                                <button type="sunmit" name="submit" class="btn btn-success btn-lg btn-block">Message</button>
                            </div>
                        </section>

                    </form>


                </div>
            </div>
        </div>            
    </div>
</div>

<?php
		include("base/footer.php");
		?>