<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/billingLayout_Header.php');
?>

				<div class="main-panel">
					<div class="content-wrapper">
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-sm-6 mb-4 mb-xl-0">
										<h3>Laboratory Dashboard</h3>
										
									</div>
									
								</div>
							
<!--           <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Projects List </h4>
                 
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
          </div>
     


 -->



								<div class="tab-content tab-transparent-content pb-0">
									<div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
										<div class="row">
											<div class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card">
												<div class="card">
													<div class="card-body">
														<div class="d-flex flex-wrap justify-content-between">
															<h4 class="card-title">Sales</h4>
															<div class="dropdown dropleft card-menu-dropdown">
																<button class="btn p-0" type="button" id="cardMenuButtonsales" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																	<i class="mdi mdi-dots-vertical card-menu-btn"></i>
																</button>
																<div class="dropdown-menu" aria-labelledby="cardMenuButtonsales" x-placement="left-start">
																	<a class="dropdown-item" href="#">Action</a>
																	<a class="dropdown-item" href="#">Another action</a>
																	<a class="dropdown-item" href="#">Something else here</a>
																</div>
															</div>
														</div>
														<div id="sales" class="carousel slide dashboard-widget-carousel position-static pt-2" data-ride="carousel">
															<div class="carousel-inner">
																   <div class="carousel-item active">
																	<div class="d-flex flex-wrap align-items-baseline">
																		<h2 class="mr-3">$ 27632</h2>
																		<h3 class="text-danger">+2.3%</h3>
																	</div>
																	<div class="mb-3">
																		<p class="text-muted font-weight-bold  text-small">North Ludwig <span class=" font-weight-normal">($2643M last month)</span></p>
																	</div>
																	<button class="btn btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center">
																	<i class="mdi mdi-calendar mr-1"></i>
																	<span class="text-left">
																	Oct
																	</span>
																	</button>
																</div>

																	

																	<?php  if(isset($monthlysales) ){ 
                                                                     foreach ($monthlysales as $key => $row){ 
                                                                         if($key==0){
                                                                         	$active='class="carousel-item active"';
                                                                         }else{
                                                                         	$active='class="carousel-item"';
                                                                         }

                                                                         
                                                           	         ?>

                                                               
                                                                 <div <?php echo $active ?> >
                                                                   <div class="d-flex flex-wrap align-items-baseline">
																		<h2 class="mr-3"> <span style="font-family: none">₹</span>
																		 <?php echo $company_name=$row->totalamount ?>
                                                                       </h2>
																		<!-- <h3 class="text-danger">+2.3%</h3> -->
																	</div> 

                                                                   <div class="mb-3">
                                                                   	<h3 class="text-danger"><?php echo $company_name=$row->month; ?></h3>
																		
																	</div>
                                                                  </div>	
                                                                 <?php   }}?>
																
																	
																<div class="carousel-item">
																	<div class="d-flex flex-wrap align-items-baseline">
																		<h2 class="mr-3">$ 27632</h2>
																		<h3 class="text-danger">+2.3%</h3>
																	</div>
																	<div class="mb-3">
																		<p class="text-muted font-weight-bold  text-small">North Ludwig <span class=" font-weight-normal">($2643M last month)</span></p>
																	</div>
																	<button class="btn btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center">
																	<i class="mdi mdi-calendar mr-1"></i>
																	<span class="text-left">
																	Oct
																	</span>
																	</button>
																</div>
																<div class="carousel-item">
																	<div class="d-flex flex-wrap align-items-baseline">
																		<h2 class="mr-3">$ 27632</h2>
																		<h3 class="text-danger">+2.3%</h3>
																	</div>
																	<div class="mb-3">
																		<p class="text-muted font-weight-bold  text-small">North Ludwig <span class=" font-weight-normal">($2643M last month)</span></p>
																	</div>
																	<button class="btn btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center">
																	<i class="mdi mdi-calendar mr-1"></i>
																	<span class="text-left">
																	Oct
																	</span>
																	</button>
																</div>
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
											<div class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card">
												<div class="card">
													<div class="card-body">
														<div class="d-flex flex-wrap justify-content-between">
															<h4 class="card-title">Purchases</h4>
															<div class="dropdown dropleft card-menu-dropdown">
																<button class="btn p-0" type="button" id="cardMenuButtonpurchase" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																	<i class="mdi mdi-dots-vertical card-menu-btn"></i>
																</button>
																<div class="dropdown-menu" aria-labelledby="cardMenuButtonpurchase" x-placement="left-start">
																	<a class="dropdown-item" href="#">Action</a>
																	<a class="dropdown-item" href="#">Another action</a>
																	<a class="dropdown-item" href="#">Something else here</a>
																</div>
															</div>
														</div>
														<div id="purchases" class="carousel slide dashboard-widget-carousel position-static pt-2" data-ride="carousel">
															<div class="carousel-inner">
																<div class="carousel-item active">
																	<div class="d-flex flex-wrap align-items-baseline">
																		<h2 class="mr-3">$ 27632</h2>
																		<h3 class="text-success">+2.3%</h3>
																	</div>
																	<div class="mb-3">
																		<p class="text-muted font-weight-bold  text-small">North Ludwig <span class=" font-weight-normal">($2643M last month)</span></p>
																	</div>
																	<button class="btn btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center">
																	<i class="mdi mdi-calendar mr-1"></i>
																	<span class="text-left">
																	Oct
																	</span>
																	</button>
																</div>
																<div class="carousel-item">
																	<div class="d-flex flex-wrap align-items-baseline">
																		<h2 class="mr-3">$ 27632</h2>
																		<h3 class="text-success">+2.3%</h3>
																	</div>
																	<div class="mb-3">
																		<p class="text-muted font-weight-bold text-small">North Ludwig <span class=" font-weight-normal">($2643M last month)</span></p>
																	</div>
																	<button class="btn btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center">
																	<i class="mdi mdi-calendar mr-1"></i>
																	<span class="text-left">
																	Oct
																	</span>
																	</button>
																</div>
																<div class="carousel-item">
																	<div class="d-flex flex-wrap align-items-baseline">
																		<h2 class="mr-3">$ 27632</h2>
																		<h3 class="text-success">+2.3%</h3>
																	</div>
																	<div class="mb-3">
																		<p class="text-muted font-weight-bold text-small">North Ludwig <span class=" font-weight-normal">($2643M last month)</span></p>
																	</div>
																	<button class="btn btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center">
																	<i class="mdi mdi-calendar mr-1"></i>
																	<span class="text-left">
																	Oct
																	</span>
																	</button>
																</div>
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
											<div class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card">
												<div class="card">
													<div class="card-body">
														<div class="d-flex flex-wrap justify-content-between">
															<h4 class="card-title">Returns</h4>
															<div class="dropdown dropleft card-menu-dropdown">
																<button class="btn p-0" type="button" id="cardMenuButtonreturns" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																	<i class="mdi mdi-dots-vertical card-menu-btn"></i>
																</button>
																<div class="dropdown-menu" aria-labelledby="cardMenuButtonreturns" x-placement="left-start">
																	<a class="dropdown-item" href="#">Action</a>
																	<a class="dropdown-item" href="#">Another action</a>
																	<a class="dropdown-item" href="#">Something else here</a>
																</div>
															</div>
														</div>
														<div id="returns" class="carousel slide dashboard-widget-carousel position-static pt-2" data-ride="carousel">
															<div class="carousel-inner">
																<div class="carousel-item active">
																	<div class="d-flex flex-wrap align-items-baseline">
																		<h2 class="mr-3">$ 32086</h2>
																		<h3 class="text-danger">+2.3%</h3>
																	</div>
																	<div class="mb-3">
																		<p class="text-muted font-weight-bold text-small">North Ludwig <span class=" font-weight-normal">($2643M last month)</span></p>
																	</div>
																	<button class="btn btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center">
																	<i class="mdi mdi-calendar mr-1"></i>
																	<span class="text-left">
																	Oct
																	</span>
																	</button>
																</div>
																<div class="carousel-item">
																	<div class="d-flex flex-wrap align-items-baseline">
																		<h2 class="mr-3">$ 32086</h2>
																		<h3 class="text-danger">+2.3%</h3>
																	</div>
																	<div class="mb-3">
																		<p class="text-muted font-weight-bold text-small">North Ludwig <span class=" font-weight-normal">($2643M last month)</span></p>
																	</div>
																	<button class="btn btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center">
																	<i class="mdi mdi-calendar mr-1"></i>
																	<span class="text-left">
																	Oct
																	</span>
																	</button>
																</div>
																<div class="carousel-item">
																	<div class="d-flex flex-wrap align-items-baseline">
																		<h2 class="mr-3">$ 232086</h2>
																		<h3 class="text-danger">+2.3%</h3>
																	</div>
																	<div class="mb-3">
																		<p class="text-muted font-weight-bold text-small">North Ludwig <span class=" font-weight-normal">($2643M last month)</span></p>
																	</div>
																	<button class="btn btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center">
																	<i class="mdi mdi-calendar mr-1"></i>
																	<span class="text-left">
																	Oct
																	</span>
																	</button>
																</div>
															</div>
															<a class="carousel-control-prev" href="#returns" role="button" data-slide="prev">
															<span class="carousel-control-prev-icon" aria-hidden="true"></span>
															<span class="sr-only">Previous</span>
															</a>
															<a class="carousel-control-next" href="#returns" role="button" data-slide="next">
															<span class="carousel-control-next-icon" aria-hidden="true"></span>
															<span class="sr-only">Next</span>
															</a>
														</div>
													</div>
												</div>
											</div>
											<div class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card">
												<div class="card">
													<div class="card-body">
														<div class="d-flex flex-wrap justify-content-between">
															<h4 class="card-title">Marketing</h4>
															<div class="dropdown dropleft card-menu-dropdown">
																<button class="btn p-0" type="button" id="cardMenuButtonsmarketing" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																	<i class="mdi mdi-dots-vertical card-menu-btn"></i>
																</button>
																<div class="dropdown-menu" aria-labelledby="cardMenuButtonsmarketing" x-placement="left-start">
																	<a class="dropdown-item" href="#">Action</a>
																	<a class="dropdown-item" href="#">Another action</a>
																	<a class="dropdown-item" href="#">Something else here</a>
																</div>
															</div>
														</div>
														<div id="marketing" class="carousel slide dashboard-widget-carousel position-static pt-2" data-ride="carousel">
															<div class="carousel-inner">
																<div class="carousel-item active">
																	<div class="d-flex flex-wrap align-items-baseline">
																		<h2 class="mr-3">$ 27632</h2>
																		<h3 class="text-success">+2.3%</h3>
																	</div>
																	<div class="mb-3">
																		<p class="text-muted font-weight-bold text-small">North Ludwig <span class=" font-weight-normal">($2643M last month)</span></p>
																	</div>
																	<button class="btn btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center">
																	<i class="mdi mdi-calendar mr-1"></i>
																	<span class="text-left">
																	Oct
																	</span>
																	</button>
																</div>
																<div class="carousel-item">
																	<div class="d-flex flex-wrap align-items-baseline">
																		<h2 class="mr-3">$ 27632</h2>
																		<h3 class="text-success">+2.3%</h3>
																	</div>
																	<div class="mb-3">
																		<p class="text-muted font-weight-bold text-small">North Ludwig <span class=" font-weight-normal">($2643M last month)</span></p>
																	</div>
																	<button class="btn btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center">
																	<i class="mdi mdi-calendar mr-1"></i>
																	<span class="text-left">
																	Oct
																	</span>
																	</button>
																</div>
																<div class="carousel-item">
																	<div class="d-flex flex-wrap align-items-baseline">
																		<h2 class="mr-3">$ 27632</h2>
																		<h3 class="text-success">+2.3%</h3>
																	</div>
																	<div class="mb-3">
																		<p class="text-muted font-weight-bold text-small">North Ludwig <span class=" font-weight-normal">($2643M last month)</span></p>
																	</div>
																	<button class="btn btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center">
																	<i class="mdi mdi-calendar mr-1"></i>
																	<span class="text-left">
																	Oct
																	</span>
																	</button>
																</div>
															</div>
															<a class="carousel-control-prev" href="#marketing" role="button" data-slide="prev">
															<span class="carousel-control-prev-icon" aria-hidden="true"></span>
															<span class="sr-only">Previous</span>
															</a>
															<a class="carousel-control-next" href="#marketing" role="button" data-slide="next">
															<span class="carousel-control-next-icon" aria-hidden="true"></span>
															<span class="sr-only">Next</span>
															</a>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-12 col-sm-12 col-md-12 col-xl-12 grid-margin stretch-card">
												<div class="card">
													<div class="card-body">
														<div class="d-flex flex-wrap justify-content-between">
															<div>
																<h4 class="card-title mb-3">Revenue overview</h4>
															</div>
															<div>
																<div class="d-flex align-items-center">
																	<div class="dropdown mr-2 mb-2 d-none d-md-block">
																		<button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuSizeButton4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																		2019
																		</button>
																		<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuSizeButton4" data-x-placement="bottom-end">
																			<a class="dropdown-item" href="#">2015</a>
																			<a class="dropdown-item" href="#">2016</a>
																			<a class="dropdown-item" href="#">2017</a>
																			<a class="dropdown-item" href="#">2018</a>
																		</div>
																	</div>
																	<div class="dropdown dropleft card-menu-dropdown">
																		<button class="btn p-0" type="button" id="cardMenuButtonsrevenue" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<i class="mdi mdi-dots-vertical card-menu-btn"></i>
																		</button>
																		<div class="dropdown-menu" aria-labelledby="cardMenuButtonsrevenue" x-placement="left-start">
																			<a class="dropdown-item" href="#">Action</a>
																			<a class="dropdown-item" href="#">Another action</a>
																			<a class="dropdown-item" href="#">Something else here</a>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<p class="text-muted">Customers who have upgraded the level of your products or service</p>
														<div class="mt-4 mb-4 d-sm-flex">
															<div id="legendContainer" class="mb-4 mr-4 legendContainer col-md-4 pl-0 pr-0"></div>
															<div class="col-md-6 pl-0 pr-0">
																<h6>Summary</h6>
																<p class="text-muted">A comparison of people who mark themeselves of their interest based from the date range given above.</p>
															</div>
														</div>
														<div class="row mt-1 d-sm-flex">
															<div class="col-12">
																<div class="flot-chart-container">
																	<div id="flotChart" class="flot-chart"></div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-4 d-flex flex-column">
												<div class="row flex-grow">
													<div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
														<div class="card">
															<div class="card-body">
																<div class="d-flex flex-wrap justify-content-between">
																	<h4 class="card-title mb-3">Sales top charts</h4>
																	<div class="dropdown dropleft card-menu-dropdown">
																		<button class="btn p-0" type="button" id="cardMenuButtonsalestop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<i class="mdi mdi-dots-vertical card-menu-btn"></i>
																		</button>
																		<div class="dropdown-menu" aria-labelledby="cardMenuButtonsalestop" x-placement="left-start">
																			<a class="dropdown-item" href="#">Action</a>
																			<a class="dropdown-item" href="#">Another action</a>
																			<a class="dropdown-item" href="#">Something else here</a>
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-12">
																		<div class="row">
																			<div class="col-12">
																				<p class="text-muted mb-4 text-left">Customers who have upgraded the level of your products or service</p>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-12">
																				<canvas id="salesTopChart"></canvas>
																			</div>
																		</div>
																		<div class="row mt-5 d-none d-sm-flex">
																			<div class="col-12 col-sm-6 text-left">
																				<h1>891</h1>
																				<p class="font-weight-normal text-muted">North Ludwig</p>
																			</div>
																			<div class="col-12 col-sm-6 text-left">
																				<h1>227</h1>
																				<p class="font-weight-normal text-muted">North Ludwig</p>
																			</div>
																		</div>
																		<div class="row pt-3 mt-md-4">
																			<div class="col mb-2">
																				<div class="d-flex sales-top-chart-legend align-items-center">
																					<div class="bg-info p-3 mr-3 mr-lg-0 mr-lg-3 mb-md-2 mb-lg-0">
																						<canvas id="acquisition-bar_1" height="20" width="20"></canvas>
																					</div>
																					<div class="wrapper d-flex flex-column justify-content-center">
																						<p class="font-weight-medium text-muted">Budget</p>
																						<h3 class="font-weight-medium mb-0">$12,783</h3>
																					</div>
																				</div>
																			</div>
																			<div class="col">
																				<div class="d-flex sales-top-chart-legend align-items-center">
																					<div class="bg-success p-3 mr-3 mr-lg-0 mr-lg-3 mb-md-2 mb-lg-0">
																						<canvas id="acquisition-bar_2" height="20" width="20"></canvas>
																					</div>
																					<div class="wrapper d-flex flex-column justify-content-center">
																						<p class="font-weight-medium text-muted">Sales</p>
																						<h3 class="font-weight-medium mb-0">9,065</h3>
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-12 mt-4">
																				<p class="text-muted text-left">Lorem Ipsum is simply dummy text of the printing</p>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-4 d-flex flex-column">
												<div class="row flex-grow">
													<div class="col-md-6 col-lg-12 grid-margin stretch-card">
														<div class="card bg-primary">
															<div class="card-body pb-0">
																<div class="d-flex flex-wrap justify-content-between">
																	<h4 class="card-title text-white">Marketing</h4>
																	<div class="dropdown dropleft card-menu-dropdown">
																		<button class="btn p-0 text-white" type="button" id="cardMenuButtonsalesmarketing1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<i class="mdi mdi-dots-vertical card-menu-btn"></i>
																		</button>
																		<div class="dropdown-menu" aria-labelledby="cardMenuButtonsalesmarketing1" x-placement="left-start">
																			<a class="dropdown-item" href="#">Action</a>
																			<a class="dropdown-item" href="#">Another action</a>
																			<a class="dropdown-item" href="#">Something else here</a>
																		</div>
																	</div>
																</div>
																<div class="d-flex flex-wrap align-items-center justify-content-between">
																	<div>
																		<h6 class="text-white">Past year</h6>
																		<h1 class="text-white">46360</h1>
																	</div>
																	<button class="btn btn-outline-primary btn-fw border ml-xl-4 text-white mb-4">View more</button>
																</div>
															</div>
															<div class="card-body p-0">
																<div>
																	<canvas id="areaChartMarketing"></canvas>
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-6 col-lg-12 grid-margin stretch-card">
														<div class="card">
															<div class="card-body">
																<div class="d-flex flex-wrap align-items-baseline justify-content-between">
																	<h4 class="card-title">Activity</h4>
																	<div class="dropdown dropleft card-menu-dropdown">
																		<button class="btn p-0" type="button" id="cardMenuButtonactivity" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<i class="mdi mdi-dots-vertical card-menu-btn"></i>
																		</button>
																		<div class="dropdown-menu" aria-labelledby="cardMenuButtonactivity" x-placement="left-start">
																			<a class="dropdown-item" href="#">Action</a>
																			<a class="dropdown-item" href="#">Another action</a>
																			<a class="dropdown-item" href="#">Something else here</a>
																		</div>
																	</div>
																</div>
																<div>
																	<ul class="solid-icon-list">
																		<li>
																			<h5>Offline purchases</h5>
																			<h6 class="text-muted font-weight-normal">A comparison of people who mark
																				<span class="mt-3">30 Min ago</span>
																			</h6>
																		</li>
																		<li>
																			<h5>Offline purchases</h5>
																			<h6 class="text-muted font-weight-normal">A comparison of people who mark
																				<span class="mt-3">30 Min ago</span>
																			</h6>
																		</li>
																	</ul>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-4 d-flex flex-column">
												<div class="row flex-grow">
													<div class="col-12 col-md-12 col-lg-12 grid-margin stretch-card">
														<div class="card">
															<div class="card-body">
																<div class="d-flex flex-wrap justify-content-between">
																	<h4 class="card-title mb-3">Sales in detail</h4>
																	<div class="dropdown dropleft card-menu-dropdown">
																		<button class="btn p-0" type="button" id="cardMenuButtonpurchasedetails" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<i class="mdi mdi-dots-vertical card-menu-btn"></i>
																		</button>
																		<div class="dropdown-menu" aria-labelledby="cardMenuButtonpurchasedetails" x-placement="left-start">
																			<a class="dropdown-item" href="#">Action</a>
																			<a class="dropdown-item" href="#">Another action</a>
																			<a class="dropdown-item" href="#">Something else here</a>
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-12">
																		<div class="chartjs-legend mt-4" id="chart-legends-purchase"></div>
																		<div class="row">
																			<div class="col-12">
																				<!-- <canvas id="purchaseDetails"></canvas> -->
																				<div class="chartjs-legend mt-4" id="chart-legends-purchase"><div class="row">
																					<div class="col-sm-12 col mr-3 ml-3 ml-sm-0 mr-sm-0 pr-md-0"><div class="row mb-3 align-items-center">
																						<div class="col-md-2"><span class="legend-label" style="background-color:rgba(31, 59, 179, 1)"></span></div>
																						<div class="col-md-9 pl-md-2"><h3 class="mb-0"> <span style="font-family: none; margin-left: 5px;">₹</span>
																		<?php  if(isset($offlinesales) && count($offlinesales)>0){ 
                                                                     foreach ($offlinesales as $row){ 
                                                                         echo $offlinesales=$row->totalamount;
                                                           	        }} ?>   </h3></div>

                                                           	        <div class="col-sm-12 col mr-3 ml-12 ml-sm-0 mr-sm-0 pr-md-0 tex">
                                                           	        	<div class="col-md-2"></div>
                                                           	        	<div class="col-md-9"><h5 class="mb-0" style="margin:10px;color: #25378b;text-align: center;"> Offline Sales
																		  </h5>
																	</div>


                                                           	        </div></div></div>

																				<div class="col-sm-12 col mr-3 ml-3 ml-sm-0 mr-sm-0 pr-md-0 tex"><div class="row mb-3 align-items-center"><div class="col-md-2"><span class="legend-label" style="background-color:rgba(35, 175, 71, 1)"></span></div><div class="col-md-9 pl-md-2">
																					<h3 class="mb-0" > <span style="font-family: none; margin-left: 5px;">₹</span> <?php  if(isset($online) && count($online)>0){ 
                                                                                 foreach ($online as $row){ 
                                                                                 echo $online=$row->totalamount;
                                                           	                      }} ?>  </h3>
                                                           	                </div><div class="col-sm-12 col mr-3 ml-12 ml-sm-0 mr-sm-0 pr-md-0 tex">
                                                           	        	<div class="col-md-2"></div>
                                                           	        	<div class="col-md-9"><h5 class="mb-0" style="margin:10px; color: #23af47; text-align: center;"> Online Sales
																		  </h5>
																	</div></div>

                                                           	            </div></div>

																				<div class="col-sm-6 col mr-3 ml-3 ml-sm-0 mr-sm-0 pr-md-0"><div class="row mb-3 align-items-center"><div class="col-md-2"><span class="legend-label" style="background-color:rgba(2, 171, 254, 1)"></span></div><div class="col-md-9 pl-md-2"><h3 class="mb-0">$ 87545</h3></div><div class="col-sm-12"><p class="text-muted">Offline sales</p></div></div></div>

																				<div class="col-sm-6 col mr-3 ml-3 ml-sm-0 mr-sm-0 pr-md-0"><div class="row mb-3 align-items-center"><div class="col-md-2"><span class="legend-label" style="background-color:rgba(224, 224, 224, 1)"></span></div><div class="col-md-9 pl-md-2"><h3 class="mb-0">$ 97545</h3></div><div class="col-sm-12"><p class="text-muted">Online sales</p></div></div></div>
																			       </div></div>
																			</div>
																		</div>
																		<div class="row pt-3 mt-md-4">
																			<div class="col">
																				<div class="d-flex purchase-detail-legend align-items-center">
																						<div id="circleProgress1" class="p-2"></div>
																						<div>
																							<p class="font-weight-medium text-muted text-small">Sessions</p>
																							<h3 class="font-weight-medium  mb-0">26.80%</h3>
																						</div>
																				</div>
																			</div>
																			<div class="col">
																				<div class="d-flex purchase-detail-legend align-items-center">
																						<div id="circleProgress2" class="p-2"  width="42" height="42"></div>
																						<div>
																							<p class="font-weight-medium text-muted text-small">Users</p>
																							<h3 class="font-weight-medium  mb-0">56.80%</h3>
																						</div>
																				</div>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-12 mt-4">
																				<p class="text-muted text-left">Lorem Ipsum is simply dummy text of the printing</p>
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
										<div class="row">
											<div class="col-12 col-lg-4 col-xl-4 grid-margin stretch-card">
												<div class="card">
													<div class="card-body">
														<div class="d-flex flex-wrap justify-content-between">
															<h4 class="card-title">To do</h4>
															<div class="dropdown dropleft card-menu-dropdown">
																<button class="btn p-0" type="button" id="cardMenuButtontodo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																	<i class="mdi mdi-dots-vertical card-menu-btn"></i>
																</button>
																<div class="dropdown-menu" aria-labelledby="cardMenuButtontodo" x-placement="left-start">
																	<a class="dropdown-item" href="#">Action</a>
																	<a class="dropdown-item" href="#">Another action</a>
																	<a class="dropdown-item" href="#">Something else here</a>
																</div>
															</div>
														</div>
														<div class="add-items d-flex">
															<input type="text" class="form-control todo-list-input" placeholder="Add list here">
															<button class="btn btn-primary  todo-list-add-btn">Add to list</button>
														</div>
														<div class="list-wrapper">
															<p class="text-muted">People who have a ticket reservation of the event is automatically mark as interested.</p>
															<ul class="d-flex flex-column-reverse todo-list">
																<li>
																	<div class="form-check">
																		<label class="form-check-label text-muted font-weight-medium">
																		<input class="checkbox" type="checkbox">Need to complete the product
																		Manager needs.
																		<i class="input-helper"></i></label>
																	</div>
																	<i class="remove mdi mdi-delete"></i>
																</li>
																<li>
																	<div class="form-check">
																		<label class="form-check-label text-muted font-weight-medium">
																		<input class="checkbox" type="checkbox">
																		Buy Pizza on the way to work on web design
																		<i class="input-helper"></i></label>
																	</div>
																	<i class="remove mdi mdi-delete"></i>
																</li>
																<li>
																	<div class="form-check">
																		<label class="form-check-label text-muted font-weight-medium">
																		<input class="checkbox" type="checkbox">
																		Upload the draft design for admin dashboard
																		<i class="input-helper"></i></label>
																	</div>
																	<i class="remove mdi mdi-delete"></i>
																</li>
																<li class="completed">
																	<div class="form-check">
																		<label class="form-check-label text-muted font-weight-medium">
																		<input class="checkbox" type="checkbox" checked="">
																		This morning,be sure to get up early to eat breakfast!
																		<i class="input-helper"></i></label>
																	</div>
																	<i class="remove mdi mdi-delete"></i>
																</li>
																<li>
																	<div class="form-check">
																		<label class="form-check-label text-muted font-weight-medium">
																		<input class="checkbox" type="checkbox">
																		Accompany her to thr theater to see the musical.
																		<i class="input-helper"></i></label>
																	</div>
																	<i class="remove mdi mdi-delete"></i>
																</li>
															</ul>
														</div>
													</div>
												</div>
											</div>
											<div class="col-12 col-lg-12 col-xl-12 grid-margin stretch-card">
												<div class="card">
													<div class="card-body">
														<div class="d-flex flex-wrap justify-content-between">
															<h4 class="card-title">Sales</h4>
															<div class="dropdown dropleft card-menu-dropdown">
																<button class="btn p-0" type="button" id="cardMenuButtonsales1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																	<i class="mdi mdi-dots-vertical card-menu-btn"></i>
																</button>
																<div class="dropdown-menu" aria-labelledby="cardMenuButtonsales1" x-placement="left-start">
																	<a class="dropdown-item" href="#">Action</a>
																	<a class="dropdown-item" href="#">Another action</a>
																	<a class="dropdown-item" href="#">Something else here</a>
																</div>
															</div>
														</div>
														<p class="text-muted">People who have a ticket reservation of the event is automatically mark as interested.</p>
														<div class="border pt-2 pb-2 mt-4 mb-3 border-radius-widget">
															<ul class="d-md-flex flex-wrap align-items-baseline justify-content-center list-unstyled text-center mb-0 sales-legend">
																<li class="border-right-sm">
																	<h6 class="font-weight-normal">Total</h6>
																	<h2 class="text-primary">2584</h2>
																	<p class="text-primary pl-md-4 pr-md-4">56.04 % Total</p>
																</li>
																<li class="border-right-sm">
																	<h6 class="font-weight-normal">This Year</h6>
																	<h2 class="text-primary pl-md-3 pr-3">46360</h2>
																	<p class="text-primary pl-3 pr-3">32.68 % Total</p>
																</li>
																<li class="border-right-sm">
																	<h6 class="font-weight-normal">Past year</h6>
																	<h2 class="text-primary">46360</h2>
																	<p class="text-primary">97.32% Total</p>
																</li>
																<li class="pb-2 pt-2 pl-4 pr-4">
																	<h6 class="font-weight-normal">Difference</h6>
																	<h2 class="text-primary">93819</h2>
																	<p class="text-primary">76.47% Total</p>
																</li>
															</ul>
														</div>
														<div class="row mt-1 d-sm-flex">
															<div class="col-12">
																<canvas id="salesChart"></canvas>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										
										
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
include('Layouts/billingLayout_Footer.php');
?>
   
