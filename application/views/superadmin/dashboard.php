<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/superadminLayout_Header.php');
?>
  <div class="main-panel">
					<div class="content-wrapper">
						<div class="row">
							<div class="col-md-12">
								<div class="tab-content tab-transparent-content pb-0">
									<div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
										<div class="row">

											<div class="col-12 col-sm-6 col-md-6 col-xl-4 grid-margin stretch-card">
												<div class="card card-backgroundcolor">
													<div class="card-body">
														<div class="d-flex flex-wrap justify-content-between">
															<h4 class="card-title"></h4>
															<!-- <div class="dropdown dropleft card-menu-dropdown">
																<button class="btn p-0" type="button" id="cardMenuButtonpurchase" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																	<i class="mdi mdi-dots-vertical card-menu-btn"></i>
																</button>
																<div class="dropdown-menu" aria-labelledby="cardMenuButtonpurchase" x-placement="left-start">

																	<a class="dropdown-item" href="#" onClick="AllDealcloseData(2);" ><?php echo date('M Y', strtotime('-1 month')); ?></a>
																  <a class="dropdown-item" onClick="AllDealcloseData(3);" href="#"><?php echo date('M Y', strtotime('-2 month')); ?></a>
																  <a class="dropdown-item"  href="#" onClick="AllDealcloseData(4);"><?php echo date('M Y', strtotime('-3 month')); ?></a>

																</div>
															</div> -->
														</div>
														<div id="purchases" class="carousel slide dashboard-widget-carousel position-static pt-2" data-ride="carousel">
															<div class="carousel-inner">
																<div id="allaccount_count"></div>
															</div>
															<a class="carousel-control-prev" href="#purchases" role="button" data-slide="prev">
															<span class="carousel-control-prev-icon" aria-hidden="true"></span>
															<span class="sr-only">Previous</span>
															</a>
															<a class="carousel-control-next" href="#purchases" role="button" data-slide="next">
															<span class="carousel-control-next-icon" aria-hidden="true"></span>
															<span class="sr-only">Next</span>
															</a>
														</div>
													</div>
												</div>
											</div>

											<div class="col-12 col-sm-6 col-md-6 col-xl-4 grid-margin stretch-card">
												<div class="card card-backgroundcolor">
													<div class="card-body">
														<div class="d-flex flex-wrap justify-content-between">
															<h4 class="card-title"> </h4>
															<div class="dropdown dropleft card-menu-dropdown">
																<button class="btn p-0" type="button" id="cardMenuButtonsales" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																	<i class="mdi mdi-dots-vertical card-menu-btn"></i>
																</button>
																<div class="dropdown-menu" aria-labelledby="cardMenuButtonsales" x-placement="left-start">
                                                                  <a class="dropdown-item" href="#" onClick="TotalAmountData(1);" ><?php echo date('M Y', strtotime('0 month')); ?></a>
																  <a class="dropdown-item" href="#" onClick="TotalAmountData(2);" ><?php echo date('M Y', strtotime('-1 month')); ?></a>
																  <a class="dropdown-item" onClick="TotalAmountData(3);" href="#"><?php echo date('M Y', strtotime('-2 month')); ?></a>
																  <a class="dropdown-item"  href="#" onClick="TotalAmountData(4);"><?php echo date('M Y', strtotime('-3 month')); ?></a>

																</div>


															</div>
														</div>
														<div id="sales" class="carousel slide dashboard-widget-carousel position-static pt-2" data-ride="carousel">
															<div class="carousel-inner">
																<div id="totalamount_viewdashboard"></div>
															</div>

															<a class="carousel-control-prev" href="#sales" role="button" data-slide="prev">
															<span class="carousel-control-prev-icon" aria-hidden="true"></span>
															<span class="sr-only">Previous</span>
															</a>
															<a class="carousel-control-next" href="#sales" role="button" data-slide="next">
															<span class="carousel-control-next-icon" aria-hidden="true"></span>
															<span class="sr-only">Next</span>
															</a>
														</div>
													</div>
												</div>
											</div>
											<div class="col-12 col-sm-6 col-md-6 col-xl-4 grid-margin stretch-card">
												<div class="card card-backgroundcolor">
													<div class="card-body">
														<div class="d-flex flex-wrap justify-content-between">
															<h4 class="card-title"></h4>
															<div class="dropdown dropleft card-menu-dropdown">
																<button class="btn p-0" type="button" id="cardMenuButtonpurchase" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																	<i class="mdi mdi-dots-vertical card-menu-btn"></i>
																</button>
																<div class="dropdown-menu" aria-labelledby="cardMenuButtonpurchase" x-placement="left-start">

																	<a class="dropdown-item" href="#" onClick="AllDealcloseData(2);" ><?php echo date('M Y', strtotime('-1 month')); ?></a>
																  <a class="dropdown-item" onClick="AllDealcloseData(3);" href="#"><?php echo date('M Y', strtotime('-2 month')); ?></a>
																  <a class="dropdown-item"  href="#" onClick="AllDealcloseData(4);"><?php echo date('M Y', strtotime('-3 month')); ?></a>

																</div>
															</div>
														</div>
														<div id="purchases" class="carousel slide dashboard-widget-carousel position-static pt-2" data-ride="carousel">
															<div class="carousel-inner">
																<div id="alldealclose_viewdashboard"></div>
															</div>
															<a class="carousel-control-prev" href="#purchases" role="button" data-slide="prev">
															<span class="carousel-control-prev-icon" aria-hidden="true"></span>
															<span class="sr-only">Previous</span>
															</a>
															<a class="carousel-control-next" href="#purchases" role="button" data-slide="next">
															<span class="carousel-control-next-icon" aria-hidden="true"></span>
															<span class="sr-only">Next</span>
															</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									
											  <!--   <div class="row">
										            <div class="col-12 grid-margin">
										              <div class="card">
										                <div class="card-body">
										                  <h4 class="card-title">Patient List </h4>
										                  <div class="row">
										                    <div class="col-12">
										                      <div class="table-responsive">
										                        <table id="projectslisttable" class="table table-hover businesstable">
										                        </table>
										                      </div>
										                    </div>
										            
										                  </div>
										                </div>
										              </div>
										            </div>
										          </div> -->

										          
									</div>
									<div class="tab-pane fade" id="users" role="tabpanel" aria-labelledby="users-tab">
										Tab Item
									</div>
									<div class="tab-pane fade" id="returns-1" role="tabpanel" aria-labelledby="returns-tab">
										Tab Item
									</div>
									<div class="tab-pane fade" id="more" role="tabpanel" aria-labelledby="more-tab">
										Tab Item
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- content-wrapper ends -->
				
<?php
include('Layouts/superadminLayout_Footer.php');
?>
   
<script src="/<?php echo base_url();?>assets/js/superadmin/DashboardController.js"></script>