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
<style>
    .addBlogImages{
        width: 80px;
        height: 80px;
    }
    .preview-image{
        width: 400px;
        height: 200px;
    }

</style>
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Add New Blog</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Blog Details</li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>

            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#blogCategory" aria-expanded="false" aria-controls="blogCategory">
                            Add New Blog Category
                        </button>
                        <div class="collapse" id="blogCategory">
                            <div class="container mt-4">
                                <form id="addNewBlogCategoryForm">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" id="recentBlogCategory" class="form-control" name="newBlogCategory" placeholder="Category name" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="submit" class="form-control btn btn-secondary" name="submit" />
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="pd-20 card-box mb-30">

                <div class="clearfix">
                    <h4 class="text-blue h4">Add Details</h4>
                </div>
                <div class="wizard-content">
                    <form id="addNewBlogDetailForm" class="tab-wizard wizard-circle wizard" method="post">
                        <section>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input class="form-control" type="text" name="title" placeholder="Blog Title" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Blog Category</label>
                                        <select id="blogCategorySelect" name="blogCategorySelection" class="form-control">                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control" type="text" name="description"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Keywords for blog (Separate each keyword by , )</label>
                                        <input class="form-control" type="text" name="keywords" placeholder="Wedding,Birthday,Ceremony,Photo" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="val-image">Event Images<span class="text-danger"></span>
                            </label>
                            <div class="col-lg-3" id="imageHold">                                
                                <input type="file" name="blogImageUpload" id="blogImages" style="display:none;" onchange="previewBlogImages(this)" />
                                <img class="addBlogImages" src="src/images/addimages.png" alt="#">
                            </div>
                            <div style="display:none;" id="hold-image-result" class="alert" role="alert">
                         
                        </div>
                        </div>                                                
                        </div>
                            </div>
                            <div class="btn-list">
                                <button class="form-control" type="submit" name="submit" class="btn btn-success btn-lg btn-block">Add</button>
                            </div>
                        </section>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript">
  function previewBlogImages(input) {
  var imageResult = document.getElementById('hold-image-result');
  imageResult.innerHTML = ''; // Clear any previous images

  if (input.files && input.files.length > 0) {
    for (var i = 0; i < input.files.length; i++) {
      var reader = new FileReader();
      reader.onload = function(e) {
        var img = document.createElement('img');
        img.className = 'preview-image';
        img.src = e.target.result;
        imageResult.appendChild(img);
      };
      reader.readAsDataURL(input.files[i]);
    }
    imageResult.style.display = 'block';
  } else {
    imageResult.innerHTML = 'No images selected.';
    imageResult.style.display = 'none';
  }
}


</script>
        <?php
        include("base/footer.php");
        ?>