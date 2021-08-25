<?php defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- partial:partials/_footer.html -->
  <div class="footer-wrapper">
    <footer class="footer">
      <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <span class="text-center text-sm-left d-block d-sm-inline-block">Copyright &copy; 2020 BizBrainz Technologies Private Limited All rights reserved. </span>
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Designed by: <a href="http://bizbrainz.in/" target="_blank">BizBrainz Technologies Private Limited.</a> </span>
      </div>
    </footer>
  </div>
      <!-- partial -->
    <!-- main-panel ends -->
    </div>
  <!-- page-body-wrapper ends -->
  </div>
</div>
<!-- container-scroller -->
   



<script>

var headerArray = { Account:"<?php echo $this->session->encrypt_id; ?>"};   
var base_url={ baseurl:"/<?php echo base_url();?>" };

 
</script>
<!-- base:js -->
    

		<script src="/<?php echo base_url();?>assets/vendors/js/vendor.bundle.base.js" type="text/javascript"></script>
		<!-- endinject -->
		<!-- Plugin js for this page-->
		<script src="/<?php echo base_url();?>assets/vendors/progressbar.js/progressbar.min.js" type="text/javascript"></script>
		<script src="/<?php echo base_url();?>assets/vendors/flot/jquery.flot.js" type="text/javascript"></script>
		<script src="/<?php echo base_url();?>assets/vendors/flot/jquery.flot.resize.js" type="text/javascript"></script>
		<script src="/<?php echo base_url();?>assets/vendors/flot/curvedLines.js" type="text/javascript"></script>
		<script src="/<?php echo base_url();?>assets/vendors/chart.js/Chart.min.js" type="text/javascript"></script>
    <script src="/<?php echo base_url();?>assets/vendors/jquery.repeater/jquery.repeater.min.js"></script>
		<!-- End plugin js for this page-->
		<!-- inject:js -->
		<script src="/<?php echo base_url();?>assets/js/off-canvas.js" type="text/javascript"></script>
		<script src="/<?php echo base_url();?>assets/js/hoverable-collapse.js" type="text/javascript"></script>
		<script src="/<?php echo base_url();?>assets/js/template.js" type="text/javascript"></script>
		<script src="/<?php echo base_url();?>assets/js/settings.js" type="text/javascript"></script>
		<script src="/<?php echo base_url();?>assets/js/todolist.js" type="text/javascript"></script>
		<!-- endinject -->
		<!-- Custom js for this page-->
		<script src="/<?php echo base_url();?>assets/js/dashboard.js" type="text/javascript"></script>
		<!-- End custom js for this page-->

    <script src="/<?php echo base_url();?>assets/vendors/jquery-steps/jquery.steps.min.js" type="text/javascript"></script>
    <script src="/<?php echo base_url();?>assets/vendors/jquery-validation/jquery.validate.min.js" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <script src="/<?php echo base_url();?>assets/vendors/datatables.net/jquery.dataTables.js" type="text/javascript"></script>
    <script src="/<?php echo base_url();?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js" type="text/javascript"></script>
    <script src="/<?php echo base_url();?>assets/vendors/owl-carousel-2/owl.carousel.min.js" type="text/javascript"></script>

    <script src="/<?php echo base_url();?>assets/js/data-table.js" type="text/javascript"></script>
  
    <script src="/<?php echo base_url();?>assets/vendors/sweetalert/sweetalert.min.js" type="text/javascript"></script>
    <script src="/<?php echo base_url();?>assets/vendors/jquery.avgrund/jquery.avgrund.min.js" type="text/javascript"></script>
    <script src="/<?php echo base_url();?>assets/vendors/select2/select2.min.js" type="text/javascript"></script>
    <script src="/<?php echo base_url();?>assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="/<?php echo base_url();?>assets/js/jQuery.print.js" type="text/javascript"></script>
  
  
  <!-- Custom js for this page-->
  <script src="/<?php echo base_url();?>assets/js/wizard.js" type="text/javascript"></script>
  <script src="/<?php echo base_url();?>assets/js/owl-carousel.js" type="text/javascript"></script>
  <!-- End custom js for this page-->
  <script src="/<?php echo base_url();?>assets/js/select2.js" type="text/javascript"></script>
  <script src="/<?php echo base_url();?>assets/js/gobalSettings.js"></script>
  <script src="/<?php echo base_url();?>assets/js/form-repeater.js"></script>
  
  <script src="/<?php echo base_url();?>assets/js/Common/common.js" type="text/javascript"></script>
  
	</body>
</html>



  <script type="text/javascript">
    GetAccountSelectList("#accountchanged_selected_accountid");
  </script>