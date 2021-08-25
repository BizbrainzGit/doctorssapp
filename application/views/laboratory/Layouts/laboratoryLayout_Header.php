<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Laboratory</title>
<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta http-equiv='cache-control' content='no-cache'>
		<meta http-equiv='expires' content='0'>
		<meta http-equiv='pragma' content='no-cache'>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Laboratory</title>
		<!-- base:css -->
		<link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/mdi/css/materialdesignicons.min.css">
		<link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/css/vendor.bundle.base.css">
		<link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    
    <link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/summernote/dist/summernote-bs4.css">
    <link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/quill/quill.snow.css">
    <link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/simplemde/simplemde.min.css">
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
          <a class="navbar-brand brand-logo" href="/<?php echo base_url();?>ManagingDirector-Dashboard"><img src="/<?php echo base_url();?>assets/images/logo.PNG" style="height:60px;" alt="logo"/></a>
          <a class="navbar-brand brand-logo-mini" href="/<?php echo base_url();?>ManagingDirector-Dashboard"><img src="/<?php echo base_url();?>assets/images/logo.PNG" height="60" alt="logo"/></a> 
          <button class="navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="mdi mdi-menu"></span>
          </button>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
          <ul class="navbar-nav">
  	      <li class="nav-item  dropdown d-none align-items-center d-lg-flex d-none">	</li>
          </ul>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-search d-none d-lg-flex">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="search">
                  <i class="mdi mdi-magnify"></i>
                  </span>
                </div>
                <input type="text" class="form-control" placeholder="Type to search..." aria-label="search" aria-describedby="search">
              </div>
            </li>
	         <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-toggle="dropdown">
              <img src="/<?php echo base_url().$this->session->profile_pic_path;?>" alt="profile" width="50px" height="50px" />
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                <!--<p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>-->
          		<a class="dropdown-item"  href="/<?php echo base_url();?>ManagingDirector-Profile">
          		<i class="mdi mdi-settings text-primary" ></i>
          		 profile 
          		</a>
              <a href="#" class="dropdown-item" data-toggle="modal" data-target="#changepswdModal"> <i class="mdi mdi-settings text-primary"></i> Change Password</a>
          		<a class="dropdown-item" href="/<?php echo base_url();?>Common/logout">
          		<i class="mdi mdi-logout text-primary"></i>
          		Logout
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
				
        <div id="right-sidebar" class="settings-panel">
          <i class="settings-close mdi mdi-close"></i>
          <ul class="nav nav-tabs" id="setting-panel" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
            </li>
          </ul>
          <div class="tab-content" id="setting-content">
            <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
              <div class="add-items d-flex px-3 mb-0">
                <form class="form w-100">
                  <div class="form-group d-flex">
                    <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                    <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
                  </div>
                </form>
              </div>
              <div class="list-wrapper px-3">
                <ul class="d-flex flex-column-reverse todo-list">
                  <li>
                    <div class="form-check">
                      <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Team review meeting at 3.00 PM
                      </label>
                    </div>
                    <i class="remove mdi mdi-delete"></i>
                  </li>
                  <li>
                    <div class="form-check">
                      <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Prepare for presentation
                      </label>
                    </div>
                    <i class="remove mdi mdi-delete"></i>
                  </li>
                  <li>
                    <div class="form-check">
                      <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Resolve all the low priority tickets due today
                      </label>
                    </div>
                    <i class="remove mdi mdi-delete"></i>
                  </li>
                  <li class="completed">
                    <div class="form-check">
                      <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Schedule meeting for next week
                      </label>
                    </div>
                    <i class="remove mdi mdi-delete"></i>
                  </li>
                  <li class="completed">
                    <div class="form-check">
                      <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Project review
                      </label>
                    </div>
                    <i class="remove mdi mdi-delete"></i>
                  </li>
                </ul>
              </div>
              <div class="events py-4 border-bottom px-3">
                <div class="wrapper d-flex mb-2">
                  <i class="mdi mdi-circle-outline text-primary mr-2"></i>
                  <span>Feb 11 2018</span>
                </div>
                <p class="mb-0 font-weight-thin text-gray">Creating component page</p>
                <p class="text-gray mb-0">build a js based app</p>
              </div>
              <div class="events pt-4 px-3">
                <div class="wrapper d-flex mb-2">
                  <i class="mdi mdi-circle-outline text-primary mr-2"></i>
                  <span>Feb 7 2018</span>
                </div>
                <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
                <p class="text-gray mb-0 ">Call Sarah Graves</p>
              </div>
            </div>
            <!-- To do section tab ends -->
            <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
              <div class="d-flex align-items-center justify-content-between border-bottom">
                <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
                <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See All</small>
              </div>
              <ul class="chat-list">
                <li class="list active">
                  <div class="profile"><img src="" alt="image"><span class="online"></span></div>
                  <div class="info">
                    <p>Thomas Douglas</p>
                    <p>Available</p>
                  </div>
                  <small class="text-muted my-auto">19 min</small>
                </li>
                <li class="list">
                  <div class="profile"><img src="" alt="image"><span class="offline"></span></div>
                  <div class="info">
                    <div class="wrapper d-flex">
                      <p>Catherine</p>
                    </div>
                    <p>Away</p>
                  </div>
                  <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                  <small class="text-muted my-auto">23 min</small>
                </li>
                <li class="list">
                  <div class="profile"><img src="" alt="image"><span class="online"></span></div>
                  <div class="info">
                    <p>Daniel Russell</p>
                    <p>Available</p>
                  </div>
                  <small class="text-muted my-auto">14 min</small>
                </li>
                <li class="list">
                  <div class="profile"><img src="" alt="image"><span class="offline"></span></div>
                  <div class="info">
                    <p>James Richardson</p>
                    <p>Away</p>
                  </div>
                  <small class="text-muted my-auto">2 min</small>
                </li>
                <li class="list">
                  <div class="profile"><img src="" alt="image"><span class="online"></span></div>
                  <div class="info">
                    <p>Madeline Kennedy</p>
                    <p>Available</p>
                  </div>
                  <small class="text-muted my-auto">5 min</small>
                </li>
                <li class="list">
                  <div class="profile"><img src="" alt="image"><span class="online"></span></div>
                  <div class="info">
                    <p>Sarah Graves</p>
                    <p>Available</p>
                  </div>
                  <small class="text-muted my-auto">47 min</small>
                </li>
              </ul>
            </div>
            <!-- chat tab ends -->
          </div>
        </div>
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
            <a class="nav-link" href="/<?php echo base_url();?>Laboratory-Dashboard">
            <i class="mdi mdi-view-dashboard menu-icon"></i>
            <span class="menu-title">Dashboard</span>
            </a>
          </li>
          
           <li class="nav-item">
            <a class="nav-link" href="/<?php echo base_url();?>Laboratory-NewTestTemplate">
            <i class="mdi mdi-view-dashboard menu-icon"></i>
            <span class="menu-title">New Test Template </span>
            </a>
          </li>

         <!--  <li class="nav-item">
            <a class="nav-link" href="/<?php echo base_url();?>Laboratory-MedicalTestReports">
            <i class="mdi mdi-view-dashboard menu-icon"></i>
            <span class="menu-title">Add Medical Test Report </span>
            </a>
          </li> -->


          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <i class="mdi mdi-view-dashboard menu-icon"></i>
            <span class="menu-title">Medical Test Reports </span>
            <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="/<?php echo base_url();?>Laboratory-New-MedicalTestReports">Add Medical Reports</a></li>
                <li class="nav-item"> <a class="nav-link" href="/<?php echo base_url();?>Laboratory-Manage-MedicalTestReports">Medical Reports List</a></li>
              </ul>
            </div>
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