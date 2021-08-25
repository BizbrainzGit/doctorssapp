<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/doctorLayout_Header.php');
?>

				<div class="main-panel">
					<div class="content-wrapper">
						<div class="row">
							<div class="col-md-12">

								<div class="row">
									<div class="col-sm-6 mb-4 mb-xl-0">
										<h3>Welcome  <?php echo $this->session->name;?> !</h3>
										<!-- <h6 class="font-weight-normal mb-0 text-muted">You have done 57.6% more sales today.</h6> -->
									</div>
									<div class="col-sm-6">
										<div class="d-flex align-items-center justify-content-md-end">
											<div class=" pr-4 mb-3 mb-xl-0 d-xl-block d-none">
												<p class="text-muted">Today</p>
												<h6 class="font-weight-medium text-dark mb-0"><?php echo date('d-M-Y'); ?></h6>
											</div>
										
										
										</div>
									</div>
								</div>
								
								<div class="tab-content tab-transparent-content pb-0">
									<div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
										<div class="row">
											 <div class="col-12 col-sm-6 col-md-6 col-xl-4 grid-margin stretch-card">
												<div class="card">
													<div class="card-body">
													  <div id="returns" class="carousel slide dashboard-widget-carousel position-static pt-2" data-ride="carousel">
															<div class="carousel-inner">
																<div class="carousel-item active">
																	<div class="mb-3 text-center">
																	<h2 class="mr-3"><span id="total_todayappointments">120</span></h2>
																    </div>
																    <div class="mb-3 text-center">
																    	<h4 class="text-success">Today Appointments</h4>
																    </div>
		                                                                <div class="mb-3 text-center">
		                                                                	 <a href="/<?php echo base_url();?>Doctor-Today-Appointments">
		                                                                	 <button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text"><span class="text-center">View</span> <i class="mdi mdi mdi-forward"></i></button>
		                                                                	 </a>
		                                                                </div>
															    </div>
															</div>
														</div>
													</div>
												</div>
											</div>


										   <div class="col-12 col-sm-6 col-md-6 col-xl-4 grid-margin stretch-card">
												<div class="card">
													<div class="card-body">
													  <div id="returns" class="carousel slide dashboard-widget-carousel position-static pt-2" data-ride="carousel">
															<div class="carousel-inner">
																<div class="carousel-item active">
																	<div class="mb-3 text-center">
																	<h2 class="mr-3"><span id="total_appointments" ></span></h2>
																    </div>
																    <div class="mb-3 text-center">
																    	<h4 class="text-success">Total Appointments</h4>
																    </div>
		                                                                <div class="mb-3 text-center">
		                                                                	  <a  href="/<?php echo base_url();?>Doctor-Manage-Appointments">
		                                                                	 <button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text"><span class="text-center">View</span> <i class="mdi mdi mdi-forward"></i> </button>
		                                                                	</a>
		                                                                </div>
															    </div>
															</div>
														</div>
													</div>
												</div>
											</div>

											 <div class="col-12 col-sm-6 col-md-6 col-xl-4 grid-margin stretch-card">
												<div class="card">
													<div class="card-body">
													  <div id="returns" class="carousel slide dashboard-widget-carousel position-static pt-2" data-ride="carousel">
															<div class="carousel-inner">
																<div class="carousel-item active">
																	<div class="mb-3 text-center">
																	<h2 class="mr-3"><span id="total_prescriptions"></span></h2>
																    </div>
																    <div class="mb-3 text-center">
																    	<h4 class="text-success">Total Prescriptions</h4>
																    </div>
		                                                                <div class="mb-3 text-center">
		                                                                	 <a  href="/<?php echo base_url();?>Doctor-Manage-Prescription">
		                                                                	 <button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text"><span class="text-center">View</span> <i class="mdi mdi mdi-forward"></i></button>
		                                                                	</a>
		                                                                </div>
															    </div>
															</div>
														</div>
													</div>
												</div>
											</div>
										
									</div>
									
								</div>
							</div>
						</div>
					</div>

				</div>
					<!-- content-wrapper ends -->
			
<?php
include('Layouts/doctorLayout_Footer.php');
?>
   
   <script src="/<?php echo base_url();?>assets/js/Common/DashboardController.js"></script>
<script>
	viewAllAppointment("#total_appointments"); 
	viewAllPrescription("#total_prescriptions");
	viewAllTodayDoctorAppointments("#total_todayappointments");
</script>
