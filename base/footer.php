<footer class="ftco-footer ftco-bg-dark ftco-section">
  <div class="container">
    <div class="row mb-5">
      <div class="col-md-4">
        <div class="ftco-footer-widget mb-4">
          <h2 class="ftco-heading-2"><a href="index.php">
        <img class="logo-image-footer" src="images/logo/logo.png" alt="logo">
      </a></h2>
          <p>Capturing moments. Creating memories. Vivah Nepal - Your one-stop wedding and event services provider.</p>
        </div>
        <ul class="ftco-footer-social list-unstyled float-md-left float-lft ">
          <li class="ftco-animate"><a href="#" onclick="return false;"><span class="icon-twitter"></span></a></li>
          <li class="ftco-animate"><a href="#" onclick="return false;"><span class="icon-facebook"></span></a></li>
          <li class="ftco-animate"><a href="#" onclick="return false;"><span class="icon-instagram"></span></a></li>
        </ul>
      </div>
      <div class="col-md-4">
        <div class="ftco-footer-widget mb-4 ml-md-5">
          <h2 class="ftco-heading-2">Quick Links</h2>
          <ul class="list-unstyled">          
        <li><a href="gallery.php" class="py-2 d-block">Gallery</a></li>        
        <li><a href="blog.php" class="py-2 d-block">Blog</a></li>            
        <li><a href="privacy-policy.php" class="py-2 d-block">Privacy Policy</a></li>
        <li><a href="terms-condition.php" class="py-2 d-block">Terms and Conditions</a></li>
        <li><a href="about.php" class="py-2 d-block">About Us</a></li>
          </ul>
        </div>
      </div>      
      <div class="col-md-4">
        <div class="ftco-footer-widget mb-4">
          <h2 class="ftco-heading-2">Contact Info</h2>
          <div class="block-23 mb-3">
            <ul>
              <li><span class="icon icon-map-marker"></span><span class="text">Kathmandu, Nepal</span></li>
              <li><a href="#" onclick="return false;"><span class="icon icon-phone"></span><span class="text">+977 123-123-123</span></a></li>
              <li><a href="#" onclick="return false;"><span class="icon icon-envelope"></span><span class="text">info@vivahnepal</span></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 text-center">
        <p>
          Copyright &copy;<script>
            document.write(new Date().getFullYear());
          </script> All rights reserved <i class="icon-heart" aria-hidden="true"></i> Vivah Nepal</p>
      </div>
    </div>
  </div>
</footer>



<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
    <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
    <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
  </svg></div>

<!-- Modal -->
<div class="modal fade" id="modalRequest" tabindex="-1" role="dialog" aria-labelledby="modalRequestLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalRequestLabel">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="login" action="#">
          <div class="form-group">
            <!-- <label for="appointment_email" class="text-black">Email</label> -->
            <input type="text" class="form-control" id="login_number" placeholder="Number">
          </div>
          <div class="form-group">
            <!-- <label for="appointment_name" class="text-black">Full Name</label> -->
            <input type="text" class="form-control" id="login_password" placeholder="Password">
          </div>
          <div class="form-group">
            <input type="submit" value="Login" class="btn btn-primary login-button">
            <div class="horizontal-space"></div>
            <input value="Sign Up" class="btn btn-warning to-register-button">
          </div>          
        </form>
        <form id="register" action="#">
          <div class="form-group">
            <!-- <label for="appointment_name" class="text-black">Full Name</label> -->
            <input type="text" class="form-control" id="register_name" placeholder="Full Name">
          </div>
          <div class="form-group">
            <!-- <label for="register_email" class="text-black">Email</label> -->
            <input type="text" class="form-control" id="register_number" placeholder="Phone Number">
          </div>
          <div class="form-group">
            <input type="submit" value="Register" class="btn btn-primary register-button"><div class="horizontal-space"></div>
            <input value="Sign in" class="btn btn-warning to-login-button">
          </div>         
        </form>
      </div>

    </div>
  </div>
</div>


<script src="js/jquery.min.js"></script>
<script src="js/jquery-migrate-3.0.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/jquery.stellar.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/aos.js"></script>
<script src="js/jquery.animateNumber.min.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/scrollax.min.js"></script>
<script src="js/toastr.min.js"></script>
  <script src="js/toastr.init.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="js/google-map.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script src="js/main.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<script type="text/javascript">
    $(function() {
        $('#datetimepicker1').datepicker({
            dateFormat: "yy-mm-dd"
        }).val();
    });

    $(function() {
        $('#datetimepicker2').datepicker({
            dateFormat: "yy-mm-dd"
        }).val();
    });
</script>
<!-- COMMON SCRIPTS -->
<!-- <script src="js/common_scripts_min.js"></script> -->

<!-- Specific scripts -->
</body>
</html>