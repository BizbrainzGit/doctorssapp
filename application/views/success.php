<?php
  
$amount=round(($amount/100),2);
$orderId=isset($pay_order_id)?$pay_order_id:null;
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Payment Success</title>
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
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body>
<div class="container">
<div class="row text-center">
    <div class="col-sm-12 col-md-12">
     <br><br><h2> <?php echo $title;?></h2>
  <img src="<?php echo '/'.base_url().'assets/images/successful-icon.jpg';?>" width="128" height="128" class="rounded img-fluid img-responsive" alt="success">
<!--<p>Thank You. Your order status is <?php echo $status;?></p>-->
<p>Your Order ID is  <?php echo $orderId;?></p>
<p>We have received a payment of Rs.   <?php echo $amount;?></p>
<p style="color:#096b0c"><?php echo $message;?></p>
<br><br>
</div>
</div>
</div>
</body>
</html>