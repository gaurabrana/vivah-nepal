<?php
session_start();
if (isset($_SESSION['phpstartup_adminid'])) {
    include "base/header.php";
    include 'base/db.php';
    if(isset($_GET['id'])){
        $editId = $_GET['id'];
    }
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
            <a href="manage-blog.php" class="btn btn-large btn-secondary mt-2">View List Of All Blogs</a>
            </div>                    
            <div class="pd-20 card-box mb-30">            
                <div class="clearfix">
                    <h4 class="text-blue h4">Update Blog Details</h4>                    
                </div>
                <div class="wizard-content">
                <?php
$sql = "SELECT b.*, bc.name from blog b, blog_category bc where b.category_id = bc.id and b.id = $editId order by b.id asc";

$query = $conn->prepare($sql);
$query->execute();
$results = $query->fetch(PDO::FETCH_OBJ);
if ($query->rowCount() > 0) {
    $categoryId = $results->category_id;
echo '<form id="updateNewBlogDetailForm" class="tab-wizard wizard-circle wizard" method="post">
<section>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Title</label>
                <input hidden readonly class="form-control" type="text" name="blogid" value="'.$results->id.'"/>
                <input class="form-control" type="text" name="title" value="'.$results->title.'" placeholder="Blog Title" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Blog Category</label>
                <select title="blog category" id="blogCategorySelect" name="blogCategorySelection"  class="form-control">';
                $categorySql = "SELECT id, name from blog_category";
$categoryQuery = $conn->prepare($categorySql);
$categoryQuery->execute();
$categoryResults = $categoryQuery->fetchAll(PDO::FETCH_OBJ);
if ($categoryQuery->rowCount() > 0) {
    foreach($categoryResults as $row){
        echo'<option value="'.$row->id.'"';  if($row->id == $categoryId){echo "selected";}                echo'>'.$row->name.'</option>';
    }
}
                echo'</select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" type="text" name="description">'.$results->description.'</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Keywords for blog (Separate each keyword by , )</label>
                <input class="form-control" type="text" name="keywords" value="'.$results->keywords.'" placeholder="Wedding,Birthday,Ceremony,Photo" />
            </div>
        </div>
        <div class="col-md-12">
        <div class="form-group row">
    <label class="col-lg-2 col-form-label" for="val-image">Event Images<span class="text-danger"></span>
    </label>
    <div class="col-lg-3" id="imageHold">                                
        <input type="file" name="blogImageUpload" id="blogImages" style="display:none;" onchange="previewBlogImages(this)" />
        <input type="text" name="existingImageName" hidden  value="'.$results->path.'"/>
        <img class="addBlogImages" src="src/images/addimages.png" alt="#">
    </div>
    <div style="display:block;" id="hold-image-result" class="alert" role="alert">
    <img class="preview-image" src="../images/blog/'.$results->path.'" />

    </div>
</div>                                                
</div>
    </div>
    <div class="btn-list">
        <button class="form-control" type="submit" name="submit" class="btn btn-success btn-lg btn-block">Update</button>
    </div>
</section>
</form>';
}
    ?>
                                        
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