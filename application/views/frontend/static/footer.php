
  <footer >
    <div class="container margin_60_35">
      <div class="row">
        <div class="col-lg-3 col-md-12">
          <p>
            <a href="/<?php echo base_url();?>" >
              <img src="/<?php echo base_url();?>assets/images/logo.PNG" data-retina="true" alt="" width="163" height="36" class="img-fluid">
            </a>
          </p>
        </div>
        <div class="col-lg-3 col-md-4">
          <h5>About</h5>
          <ul class="links">
            <li><a href="#0">About us</a></li>
            <li><a href="blog.html">Blog</a></li>
            <li><a href="#0">FAQ</a></li>
            <li><a href="login.html">Login</a></li>
            <li><a href="register.html">Register</a></li>
          </ul>
        </div>
        <div class="col-lg-3 col-md-4">
          <h5>Useful links</h5>
          <ul class="links">
            <li><a href="#0">Doctors</a></li>
            <li><a href="#0">Clinics</a></li>
            <li><a href="#0">Specialization</a></li>
            <li><a href="#0">Join as a Doctor</a></li>
            <li><a href="#0">Download App</a></li>
          </ul>
        </div>
        <div class="col-lg-3 col-md-4">
          <h5>Contact with Us</h5>
          <ul class="contacts">
            <li><a href="tel://61280932400"><i class="icon_mobile"></i> + 61 23 8093 3400</a></li>
            <li><a href="mailto:info@findoctor.com"><i class="icon_mail_alt"></i> help@findoctor.com</a></li>
          </ul>
          <div class="follow_us">
            <h5>Follow us</h5>
            <ul>
              <li><a href="#0"><i class="social_facebook"></i></a></li>
              <li><a href="#0"><i class="social_twitter"></i></a></li>
              <li><a href="#0"><i class="social_linkedin"></i></a></li>
              <li><a href="#0"><i class="social_instagram"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
      <!--/row-->
      <hr>
      <div class="row" >
        <div class="col-md-8">
          <ul id="additional_links">
            <li><a href="#0">Terms and conditions</a></li>
            <li><a href="#0">Privacy</a></li>
          </ul>
        </div>
        <div class="col-md-4">
          <div id="copy">© 2021 Doctorss</div>
        </div>
      </div>
    </div>
  </footer>
  <!--/footer-->
  </div>
  <!-- page -->

  <div id="toTop"></div>
  <!-- Back to top button -->
<script>
  var headerArray = { Account:"<?php echo $this->session->encrypt_id; ?>"};
  var base_url={baseurl:"/<?php echo base_url();?>"};
</script>
  <!-- COMMON SCRIPTS -->
  <script src="/<?php echo base_url();?>assets/frontend/js/jquery-3.5.1.min.js"></script>
  <script src="/<?php echo base_url();?>assets/frontend/js/common_scripts.min.js"></script>
  <script src="/<?php echo base_url();?>assets/frontend/js/functions.js"></script>
  
  <script src="/<?php echo base_url();?>assets/js/gobalSettings.js"></script>
  <!-- <script src="/<?php echo base_url();?>assets/js/Common/LoginController.js"></script> -->

</body>

</html>
 

 <script type="text/javascript">
      var base_url={baseurl:"/<?php echo base_url();?>"};
      $(function(){
          // this will get the full URL at the address bar
          var url = window.location.href; 
          // passes on every "a" tag 
          $("#menu >ul li a").each(function() {
                  // checks if its the same on the address bar
              if(url == (this.href)) { 
                  $(this).closest("li").addClass("active");
              }
          });
      });
  </script>