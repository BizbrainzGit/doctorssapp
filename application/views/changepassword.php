
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Hospital Project</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hospital Project</title>
    <link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="shortcut icon" href="/<?php echo base_url();?>assets/images/favicon.png" />
    <link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="/<?php echo base_url();?>assets/css/vertical-layout-light/style.css">
    <link rel="stylesheet" href="/<?php echo base_url();?>assets/css/custom.css">
  
</head>

<body>

<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
               <a href="/<?php echo base_url();?>Home">
                   <img src="/<?php echo base_url();?>assets/images/BizBrainz_logo.PNG" class="img-responsive" style="width:200px;" >
                </a>
              </div>
              <h4> Change Password </h4>
              <form class="pt-3" class="cmxform" id="changepasswordForm" method="post" action="#">
                <div class="form-group">
                  <label>New Password <span class="requried_class">*</span></label>
                  <input type="password" class="form-control form-control-lg" name="new_password" id="new_password" placeholder="New Password" required>
                </div>
                <div class="form-group">
                  <label>Confirm Password <span class="requried_class">*</span> </label>
                  <input type="text" class="form-control form-control-lg" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
                </div>

                 <div class="col-sm-12 col-12 form-group text-center mt-4"  >
                       <div id="changepassword-msg"></div>
                        <button type="button" class="btn btn-primary" id="changepassword-button" >Submit</button>
                        <button type="reset" class="btn btn-secondary" >Cancel</button>

                    <div class="text-center mt-4 font-weight-light">
                      You have an account? <a href="/<?php echo base_url();?>login" class="text-primary">Login</a>
                     </div>

                     </div>
              </form>
            </div>
          </div>
        </div>
        
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->



<script>
var headerArray = { Account:"<?php echo $this->session->encrypt_id; ?>"};     
var base_url={baseurl:"/<?php echo base_url();?>"};
</script>
  <script src="/<?php echo base_url();?>assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="/<?php echo base_url();?>assets/js/off-canvas.js"></script>
  <script src="/<?php echo base_url();?>assets/js/hoverable-collapse.js"></script>
  <script src="/<?php echo base_url();?>assets/js/template.js"></script>
  <script src="/<?php echo base_url();?>assets/js/settings.js"></script>
  <script src="/<?php echo base_url();?>assets/js/todolist.js"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
  <script src="/<?php echo base_url();?>assets/vendors/jquery-validation/jquery.validate.min.js"></script>
  <script src="/<?php echo base_url();?>assets/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <!--<script src="/<?php echo base_url();?>assets/js/form-validation.js"></script>-->
  <script src="/<?php echo base_url();?>assets/js/bt-maxLength.js"></script>
<script src="/<?php echo base_url();?>assets/vendors/select2/select2.min.js" type="text/javascript"></script>
  
  <script src="/<?php echo base_url();?>assets/js/select2.js"></script>
  <script src="/<?php echo base_url();?>assets/js/gobalSettings.js"></script>
  <script src="/<?php echo base_url();?>assets/js/Common/LoginController.js"></script>
 
</body>
</html>

<script type="text/javascript">
function passwordShow() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

</script>
