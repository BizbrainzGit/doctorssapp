
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
      <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
          <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="auth-form-transparent text-left p-3">
              <div class="brand-logo">
               <img src="/<?php echo base_url();?>assets/images/logo.png" style="height:45px;" alt="logo"/></a>
              </div>
              <h4>New here?</h4>
              <h6 class="font-weight-light">Join us today! It takes only few steps</h6>
              <form class="pt-3" id="account_selected_form" name="account_selected_form" method="post">
                <div class="form-group">
                  <label>Select Account </label>
                   <select class="form-control form-control-lg" id="account_selected_accountid" name="account_selected_accountid" >
                     <option value="">Select Account</option>
                   </select>

                   <!--  <select class="form-control form-control-lg" id="account_selected_accountid" name="account_selected_accountid" >
                       
                        <?php
                        // print_r($accounts);
                    for($i=0;$i<count($accounts);$i++)
                    {
                        echo "<option value=".$accounts[$i]['encrypted_id'].">".$accounts[$i]['name']."</option>";
                    
                    } ?>
                    </select> -->

                </div>
              <!--   <div class="mt-3">
                  <button type="button" class="btn btn-block btn-primary" id="selectedaccount_btn" name="selectedaccount_btn">Submit</button>
                </div> -->
              </form>
                  <a class="dropdown-item" href="/<?php echo base_url();?>Common/logout"><i class="mdi mdi-logout text-primary"></i>Logout</a>
            </div>
          </div>
          <div class="col-lg-6 register-half-bg d-flex flex-row">
            <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; 2019 BizBrainz Technologies Private Limited All rights reserved.</p>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
<script>
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
  <script src="/<?php echo base_url();?>assets/js/Common/common.js"></script>
  <script src="/<?php echo base_url();?>assets/js/Common/LoginController.js"></script>

</body>
</html>
