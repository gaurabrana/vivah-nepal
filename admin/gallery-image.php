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
<link href="src/styles/gallery.css" rel="stylesheet" type="text/css">
<div class="main-container">
  <section class="card p-3">
    <h4>Add Images</h4><br />
  
<form id="gallery-Form" enctype="multipart/form-data">
<div class="form-group d-flex align-items-center">
    <div>
    <label for="image-input">
      <div class="image-preview">
        <img src="../images/addImagePlaceholder.png" alt="Your Image" />
      </div>
    </label>
    <input type="file" hidden name="fileToUpload[]" id="image-input" onchange="previewHeroImage(this)" multiple>
    </div>
    <div class="ml-auto">
    <button type="submit" class="btn btn-lg btn-secondary">Submit</button>
    </div>
  </div>
  </form>
    <section class="flipgallery newGallery">
      <div class="wrapper flip-gallery">
        <div class="active gallery-image-holder">

        </div>
      </div>
    </section>
  </section>  
</div>
<script type="text/javascript">
  function previewHeroImage(input) {

    document.querySelector('.newGallery .gallery-image-holder').innerHTML = '';
    if (input.files && input.files.length > 0) {
      var index = 0;
      for (var i = 0; i < input.files.length; i++) {        
        var reader = new FileReader();
        reader.onload = function(e) {
          index++;          
          var flipContainer = document.createElement('div');
          flipContainer.className = 'flip-container';

          var flipper = document.createElement('div');
          flipper.className = 'flipper';

          var front = document.createElement('div');
          front.className = 'front';

          var img = document.createElement('img');
          img.alt = '';
          img.src = e.target.result;
          front.appendChild(img);

          var back = document.createElement('div');
          back.className = 'back';          
          back.setAttribute('style', 'background-image: url('+ e.target.result +')');

          var b = document.createElement('b');
          b.className = 'mb-2'
          b.textContent = 'Add Information';
          back.appendChild(b);

          var br = document.createElement('br');
          back.appendChild(br);
          var id = 'descriptionId' + index;

          var form = document.createElement('form');
          form.setAttribute('style', 'margin-top:20px');
          form.id = "formDescription" + index;
          
          var formGroup = document.createElement('div');
          formGroup.className = 'form-group';
        
          // Create a new description element with the unique ID
          var description = document.createElement('textarea');
          description.type = 'text';          
          description.className = 'form-control';
          description.id = id;      
          formGroup.appendChild(description);
          console.log(id);

          form.appendChild(formGroup);
          back.appendChild(form);

          flipper.appendChild(front);
          flipper.appendChild(back);

          flipContainer.appendChild(flipper);

          document.querySelector('.newGallery .gallery-image-holder').appendChild(flipContainer);
        }
        reader.readAsDataURL(input.files[i]);        
      }
    }
  }
</script>
<?php
include("base/footer.php");
?>