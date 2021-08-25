<?php
//$status=isset($status)?$status:null;
$amount=round(($amount/100),2);
//$email=isset($email)?$email:null;
$orderId=isset($pay_order_id)?$pay_order_id:null;
?>
<!DOCTYPE html>
<html>
<head>
<title>Payment Failure</title>
<link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    
    <link rel="shortcut icon" href="/<?php echo base_url();?>assets/images/favicon.png" />
<!-- plugin css for this page -->
  <link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/select2/select2.min.css">
  <link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
  <link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">

<!-- inject:css -->
     <link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="/<?php echo base_url();?>assets/css/vertical-layout-light/style.css">
    <!-- endinject -->

    <link rel="stylesheet" href="/<?php echo base_url();?>assets/css/custom.css">

</head>
<body>
<div class="container">
<div class="row text-center">
    <div class="col-sm-12 col-md-12">
  <br><br><img src="<?php echo '/'.base_url().'assets/images/failure-icon.png';?>" width="128" height="128" class="rounded img-fluid img-responsive" alt="failure">

<p> <?php echo $title;?></p>
<p>Your Order ID is  <b><?php echo $orderId;?> </b></p>
<p style="color:#e80707"><?php echo $message;?></p>
    </div>
</div>
</div>
</body>
</html>