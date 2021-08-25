  

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
          <div class="col-lg-8 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo text-center">
               <a href="/<?php echo base_url();?>Home">
                   <img src="/<?php echo base_url();?>assets/images/BizBrainz_logo.PNG" class="img-responsive" style="width:200px;" >
                </a>
              </div>
              <h4>New Registation </h4>
                 <form class="contact-form row" id="customerregister_form">
                   <div class="row clearfixed">
                    <div class="col-sm-6 col-12 form-group">
                      <label>First Name <span class="requried_class">*</span></label>
                      <input type="text" class="form-control" placeholder="First Name" id="customerregister_firstname" name="customerregister_firstname">
                    </div>
                    <div class="col-sm-6 col-12 form-group">
                      <label>Last Name <span class="requried_class">*</span></label>
                      <input type="text" class="form-control" placeholder="Last Name" id="customerregister_lastname" name="customerregister_lastname">
                    </div>
                    <div class="col-sm-6 col-12 form-group">
                      <label>Mobile Number <span class="requried_class">*</span></label>
                      <input type="text" class="form-control" placeholder="Mobile Number" id="customerregister_mobilenumber" name="customerregister_mobilenumber">
                    </div>
                    <div class="col-sm-6 col-12 form-group">
                      <label>Email <span class="requried_class">*</span> </label>
                      <input type="text" class="form-control" placeholder="Email" id="customerregister_email" name="customerregister_email">
                    </div>
                    <div class="col-sm-6 col-12 form-group">
                      <label>Password <span class="requried_class">*</span></label>
                      <input type="password" class="form-control" placeholder="Password" id="customerregister_password" name="customerregister_password">
                    </div>
                    <div class="col-sm-6 col-12 form-group">
                      <label>Confirm Password <span class="requried_class">*</span></label>
                      <input type="password" class="form-control" placeholder="Confirm Password" id="customerregister_confirmpassword" name="customerregister_confirmpassword">
                    </div>
                    <div class="col-sm-12 col-12 form-group text-center mt-4"  >
                       <div id="customerdetails-addmsg"></div>
                        <button type="button" class="btn btn-primary" id="customerregister_save" >Submit</button>
                        <button type="reset" class="btn btn-secondary" >Cancel</button>
                    <div class="text-center mt-4 font-weight-light">
                      You have an account? <a href="/<?php echo base_url();?>login" class="text-primary">Login</a>
                     </div>

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
var base_url={ baseurl:"/<?php echo base_url();?>" };
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





