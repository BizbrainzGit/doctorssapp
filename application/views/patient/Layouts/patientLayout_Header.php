<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Hospital</title>
<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta http-equiv='cache-control' content='no-cache'>
		<meta http-equiv='expires' content='0'>
		<meta http-equiv='pragma' content='no-cache'>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- base:css -->
		<link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/mdi/css/materialdesignicons.min.css">
		<link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/css/vendor.bundle.base.css">
		<link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/owl-carousel-2/owl.theme.default.min.css">
		<!-- endinject -->
		<!-- plugin css for this page -->
		<!-- End plugin css for this page -->
		
		<link rel="shortcut icon" href="/<?php echo base_url();?>assets/images/favicon.png" />
<!-- plugin css for this page -->
  <link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/select2/select2.min.css">
  <link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
  <link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">

<!-- inject:css -->
     <link rel="stylesheet" type = "text/css" href="/<?php echo base_url();?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet"type = "text/css"   href="/<?php echo base_url();?>assets/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="stylesheet" type = "text/css" href="/<?php echo base_url();?>assets/css/custom.css">
    <style type="text/css">
      .loader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url("/<?php echo base_url();?>assets/images/Doctors_Gif.GIF") 50% 50% no-repeat rgb(249,249,249);
    opacity: .8;
    }
    </style>
</head>
<body>

<div class="loader" style="display: none"></div>
	<div class="container-scroller">
			<!-- partial:partials/_navbar.html -->
			<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-left navbar-brand-wrapper d-flex align-items-center justify-content-between">
          <a class="navbar-brand brand-logo" href="/<?php echo base_url();?>Patient-Dashboard"><img src="/<?php echo base_url();?>assets/images/Logoapp.png"  height="60px" width="60px" alt="logo"/></a>
          <a class="navbar-brand brand-logo-mini" href="/<?php echo base_url();?>Patient-Dashboard"><img src="/<?php echo base_url();?>assets/images/Logoapp.png" alt="logo"/></a> 
          <button class="navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="mdi mdi-menu"></span>
          </button>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
          <ul class="navbar-nav">
	<li class="nav-item  dropdown d-none align-items-center d-lg-flex d-none">	</li>
            
          </ul>
          <ul class="navbar-nav navbar-nav-right">
<!--             <li class="nav-item nav-search d-none d-lg-flex">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="search">
                  <i class="mdi mdi-magnify"></i>
                  </span>
                </div>
                <input type="text" class="form-control" placeholder="Type to search..." aria-label="search" aria-describedby="search">
              </div>
            </li> -->
            <li class="nav-item">
               <div class="input-group">
                   <select class="form-control form-control-lg" id="accountchanged_selected_accountid" name="accountchanged_selected_accountid" >
                   </select>
               </div>
            </li>
	    <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-toggle="dropdown">
              <img src="/<?php echo base_url().$this->session->profile_pic_path;?>" alt="profile" width="50px" height="50px" />
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                <!--<p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>-->
		<a class="dropdown-item" href="/<?php echo base_url();?>Patient-Profile">
		   <i class="mdi mdi-account-edit text-primary"></i> My Profile </a>
        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#changepswdModal"> 
        	<i class="mdi mdi-settings text-primary"></i> Change Password</a>
		<a class="dropdown-item" href="/<?php echo base_url();?>Common/logout">
		    <i class="mdi mdi-logout text-primary"></i> Logout
		</a>
              </div>
            </li>
            
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
			<!-- partial -->
			<div class="container-fluid page-body-wrapper">
				
        <!-- partial -->
				<!-- partial:partials/_sidebar.html -->
				<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link d-flex">
              <div class="profile-image">
                <img src="/<?php echo base_url().$this->session->profile_pic_path;?>" alt="image">
              </div>
              <div class="profile-name">
                <p class="name">
                  <?php echo $this->session->name;?>
                </p>
                <p class="designation">
                  <?php echo $this->session->user_roles;?>
                </p>
              </div>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/<?php echo base_url();?>Patient-Dashboard">
            <i class="mdi mdi-view-dashboard menu-icon"></i>
            <span class="menu-title">Dashboard</span>
            </a>
          </li>
           <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <i class="mdi mdi-account-multiple menu-icon"></i>
            <span class="menu-title">Appointment  Details</span>
            <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="/<?php echo base_url();?>Patient-New-AppointmentBooking">Appointment Booking</a></li>
                <li class="nav-item"> <a class="nav-link" href="/<?php echo base_url();?>Patient-Manage-AppointmentBooking">Appointment List</a></li>
              </ul>
            </div>
          </li>


          <li class="nav-item">
            <a class="nav-link" href="/<?php echo base_url();?>Patient-Print-Prescription">
            <i class="mdi mdi-printer menu-icon"></i>
            <span class="menu-title">Prescriptions</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="/<?php echo base_url();?>Patient-MedicalTest-Bills">
            <i class="mdi mdi-clipboard-text menu-icon"></i>
            <span class="menu-title">Medical Test Bills</span>
            </a>
          </li> 

          <li class="nav-item">
            <a class="nav-link" href="/<?php echo base_url();?>Patient-MedicalTest-Reports">
            <i class="mdi mdi-clipboard-text menu-icon"></i>
            <span class="menu-title">Medical Test Reports</span>
            </a>
          </li> 

         
        </ul>
      </nav>
				<!-- partial -->



         <!-- Modal -->
  <div class="modal fade" id="changepswdModal" role="dialog">
    <div class="modal-dialog modal-md">
    <form method="post" id="changepasswordForm" name="changepasswordForm">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Change Password</h4>
        </div>
        
        <div class="modal-body">
        
            <div id="alert-msg"></div>
          <div class="form-row">
            <div class="form-group col-md-12">
          <label for="old_password">Old Password</label>
          <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Old Password">
        </div>
       </div> 
       <div class="form-row">
            <div class="form-group col-md-12">
          <label for="new_password">New Password</label>
          <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password">
        </div>
       </div>
       <div class="form-row">
            <div class="form-group col-md-12">
          <label for="confirm_password">Confirm Password</label>
          <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
        </div> 
       </div>
          <div class="form-row">
              <div class="form-group col-md-12" style="text-align:center">
                <button type="button" id="cpswd_save" class="btn btn-primary">Submit</button>
                <button class="btn btn-secondary btn-md" type="reset"> Reset </button>&nbsp;
              </div>
           </div>
          
        </div>
        <div class="modal-footer">
          
      </div>

      </div>
      </form>
    </div>
  </div>