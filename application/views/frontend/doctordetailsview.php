
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('static/header.php');
?>
<main>
		<div id="breadcrumb">
			<div class="container">
				<ul>
					<li><a href="#">Home</a></li>
					<li><a href="#">Category</a></li>
					<li>Page active</li>
				</ul>
			</div>
		</div>
		<!-- /breadcrumb -->

		<div class="container margin_60">
			<div class="row">
				<div class="col-xl-8 col-lg-8">
					<nav id="secondary_nav">
						<div class="container">
							<ul class="clearfix">
								<li><a href="#section_1" class="active">General info</a></li>
								<!-- <li><a href="#section_2">Reviews</a></li> -->
								<li><a href="#sidebar">Booking</a></li>
							</ul>
						</div>
					</nav>
					<div id="section_1">
						<div class="box_general_3">

							   <?php if(isset($doctordetailsdata )){ 
                                 // print_r($doctordetailsdata);
							   	foreach($doctordetailsdata as $row){ ?>
                               

							<div class="profile">
								<div class="row">
									<div class="col-lg-5 col-md-4">
										<figure>
											<img src="/<?php echo base_url();?><?php echo $row->profile_pic_path; ?>" alt="" class="img-fluid">
										</figure>
									</div>
									<div class="col-lg-7 col-md-8">
										<small><?php echo $row->specialization; ?></small>
										<h1>DR.<?php echo $row->doctor_name; ?></h1>
										<span class="rating">
											<i class="icon_star voted"></i>
											<i class="icon_star voted"></i>
											<i class="icon_star voted"></i>
											<i class="icon_star voted"></i>
											<i class="icon_star"></i>
											<small>(145)</small>
											<a href="badges.html" data-toggle="tooltip" data-placement="top" data-original-title="Badge Level" class="badge_list_1"><img src="img/badges/badge_1.svg" width="15" height="15" alt=""></a>
										</span>
										<ul class="statistic">
											<li>854 Views</li>
											<li>124 Patients</li>
										</ul>
										<ul class="contacts">
											<li>
												<small><?php echo $row->account_name; ?></small>
												<h6><?php echo $row->business_address; ?></h6>
												 
												<!-- <a href="https://www.google.com/maps/dir//Assistance+%E2%80%93+H%C3%B4pitaux+De+Paris,+3+Avenue+Victoria,+75004+Paris,+Francia/@48.8606548,2.3348734,14z/data=!4m15!1m6!3m5!1s0x0:0xa6a9af76b1e2d899!2sAssistance+%E2%80%93+H%C3%B4pitaux+De+Paris!8m2!3d48.8568376!4d2.3504305!4m7!1m0!1m5!1m1!1s0x47e67031f8c20147:0xa6a9af76b1e2d899!2m2!1d2.3504327!2d48.8568361" target="_blank"> <strong>View on map</strong></a>
 -->											</li>
											<li>
												<!-- <h6>Phone</h6> <a href="tel://000434323342">+00043 4323342</a> - <a href="tel://000434323342">+00043 4323342</a></li> -->
										</ul>
									</div>
								</div>
							</div>
							

							<input  type="hidden" id="booking_doctors_id" value="<?php echo $row->user_id; ?>">
							<input  type="hidden" id="booking_account_id" value="<?php echo $row->account_id; ?>">

							<?php }} ?>
							<!-- <hr> -->
							
							<!-- /profile -->
							<!-- <div class="indent_title_in">
								<i class="pe-7s-user"></i>
								<h3>Professional statement</h3>
								<p>Mussum ipsum cacilds, vidis litro abertis.</p>
							</div>
							<div class="wrapper_indent">
								<p>Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Nullam mollis. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapi.</p>
								<h6>Specializations</h6>
								<div class="row">
									<div class="col-lg-6">
										<ul class="bullets">
											<li>Abdominal Radiology</li>
											<li>Addiction Psychiatry</li>
											<li>Adolescent Medicine</li>
											<li>Cardiothoracic Radiology </li>
										</ul>
									</div>
									<div class="col-lg-6">
										<ul class="bullets">
											<li>Abdominal Radiology</li>
											<li>Addiction Psychiatry</li>
											<li>Adolescent Medicine</li>
											<li>Cardiothoracic Radiology </li>
										</ul>
									</div>
								</div>
							
							</div>
							

							<hr>

							<div class="indent_title_in">
								<i class="pe-7s-news-paper"></i>
								<h3>Education</h3>
								<p>Mussum ipsum cacilds, vidis litro abertis.</p>
							</div>
							<div class="wrapper_indent">
								<p>Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Nullam mollis. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapi.</p>
								<h6>Curriculum</h6>
								<ul class="list_edu">
									<li><strong>New York Medical College</strong> - Doctor of Medicine</li>
									<li><strong>Montefiore Medical Center</strong> - Residency in Internal Medicine</li>
									<li><strong>New York Medical College</strong> - Master Internal Medicine</li>
								</ul>
							</div>
							

							<hr>

							<div class="indent_title_in">
								<i class="pe-7s-cash"></i>
								<h3>Prices &amp; Payments</h3>
								<p>Mussum ipsum cacilds, vidis litro abertis.</p>
							</div>
							<div class="wrapper_indent">
								<p>Zril causae ancillae sit ea. Dicam veritus mediocritatem sea ex, nec id agam eius. Te pri facete latine salutandi, scripta mediocrem et sed, cum ne mundi vulputate. Ne his sint graeco detraxit, posse exerci volutpat has in.</p>
								<div class="table-responsive">
								<table class="table table-striped">
									<thead>
										<tr>
											<th>Service - Visit</th>
											<th>Price</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>New patient visit</td>
											<td>$34</td>
										</tr>
										<tr>
											<td>General consultation</td>
											<td>$60</td>
										</tr>
										<tr>
											<td>Back Pain</td>
											<td>$40</td>
										</tr>
										<tr>
											<td>Diabetes Consultation</td>
											<td>$55</td>
										</tr>
										<tr>
											<td>Eating disorder</td>
											<td>$60</td>
										</tr>
										<tr>
											<td>Foot Pain</td>
											<td>$35</td>
										</tr>
									</tbody>
								</table>
								</div>
							</div> -->
							
						</div>
						
					</div>
					<!-- /box_general -->

					<!-- <div id="section_2">
						<div class="box_general_3">
							<div class="reviews-container">
								<div class="row">
									<div class="col-lg-3">
										<div id="review_summary">
											<strong>4.7</strong>
											<div class="rating">
												<i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
											</div>
											<small>Based on 4 reviews</small>
										</div>
									</div>
									<div class="col-lg-9">
										<div class="row">
											<div class="col-lg-10 col-9">
												<div class="progress">
													<div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
											<div class="col-lg-2 col-3"><small><strong>5 stars</strong></small></div>
										</div>
									
										<div class="row">
											<div class="col-lg-10 col-9">
												<div class="progress">
													<div class="progress-bar" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
											<div class="col-lg-2 col-3"><small><strong>4 stars</strong></small></div>
										</div>
									
										<div class="row">
											<div class="col-lg-10 col-9">
												<div class="progress">
													<div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
											<div class="col-lg-2 col-3"><small><strong>3 stars</strong></small></div>
										</div>
									
										<div class="row">
											<div class="col-lg-10 col-9">
												<div class="progress">
													<div class="progress-bar" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
											<div class="col-lg-2 col-3"><small><strong>2 stars</strong></small></div>
										</div>
									
										<div class="row">
											<div class="col-lg-10 col-9">
												<div class="progress">
													<div class="progress-bar" role="progressbar" style="width: 0" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
											<div class="col-lg-2 col-3"><small><strong>1 stars</strong></small></div>
										</div>
										
									</div>
								</div>
							

								<hr>

								<div class="review-box clearfix">
									<figure class="rev-thumb"><img src="http://via.placeholder.com/150x150.jpg" alt="">
									</figure>
									<div class="rev-content">
										<div class="rating">
											<i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
										</div>
										<div class="rev-info">
											Admin – April 03, 2016:
										</div>
										<div class="rev-text">
											<p>
												Sed eget turpis a pede tempor malesuada. Vivamus quis mi at leo pulvinar hendrerit. Cum sociis natoque penatibus et magnis dis
											</p>
										</div>
									</div>
								</div>
							

								<div class="review-box clearfix">
									<figure class="rev-thumb"><img src="http://via.placeholder.com/150x150.jpg" alt="">
									</figure>
									<div class="rev-content">
										<div class="rating">
											<i class="icon-star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
										</div>
										<div class="rev-info">
											Ahsan – April 01, 2016
										</div>
										<div class="rev-text">
											<p>
												Sed eget turpis a pede tempor malesuada. Vivamus quis mi at leo pulvinar hendrerit. Cum sociis natoque penatibus et magnis dis
											</p>
										</div>
									</div>
								</div>
							

								<div class="review-box clearfix">
									<figure class="rev-thumb"><img src="http://via.placeholder.com/150x150.jpg" alt="">
									</figure>
									<div class="rev-content">
										<div class="rating">
											<i class="icon-star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
										</div>
										<div class="rev-info">
											Sara – March 31, 2016
										</div>
										<div class="rev-text">
											<p>
												Sed eget turpis a pede tempor malesuada. Vivamus quis mi at leo pulvinar hendrerit. Cum sociis natoque penatibus et magnis dis
											</p>
										</div>
									</div>
								</div>
							
							</div>
						
							<hr>
							<div class="text-right"><a href="submit-review.html" class="btn_1">Submit review</a></div>
						</div>
					</div> -->
					<!-- /section_2 -->
				</div>
				<!-- /col -->
				<aside class="col-xl-4 col-lg-4" id="sidebar">
					<div class="box_general_3 booking">
						<form method="POST" >
							<div class="title">
							<h3>Book a Time Slot</h3>
						<!-- 	<small>Monday to Friday 09.00am-06.00pm</small> -->
							</div>
							<div class="row">
								<div class="col-6">
									<div class="form-group">
										<input class="form-control" type="text" id="booking_date1" data-lang="en" onchange="GetTimeSlotsData()">
									</div>
								</div>
								<div class="col-6">
									<div class="form-group">
										
											<select class="form-control" id="booking_time1" name="booking_time1">
											 <!--  <option class="form-control"  >
											  </option> -->
											</select>

										<!-- <input class="form-control" type="text" id="booking_time" value="9:00 am"> -->
									</div>
								</div>
							</div>
							<!-- /row -->
							<ul class="treatments clearfix">
								<li>
									<div class="checkbox">
										 <?php if(isset($doctordetailsdata )){ 
                                          // print_r($doctordetailsdata);
							   	          foreach($doctordetailsdata as $row){ ?>
							   	        <input type="text" id="booking_doctors_name" name="booking_doctors_name" value="<?php echo $row->doctor_name; ?>">

										<input type="checkbox" class="css-checkbox" id="booking_doctors_fee" name="booking_doctors_fee" value="<?php echo $row->consultation_fee; ?>">
										<label for="booking_doctors_fee" class="css-label">Consultation Fee<strong><?php echo $row->consultation_fee; ?>
											
										</strong></label>
										<?php }} ?>
									</div>
								</li>
								<!-- <li>
									<div class="checkbox">
										<input type="checkbox" class="css-checkbox" id="visit2" name="visit2">
										<label for="visit2" class="css-label">Cardiovascular screen <strong>$55</strong></label>
									</div>
								</li>
								<li>
									<div class="checkbox">
										<input type="checkbox" class="css-checkbox" id="visit3" name="visit3">
										<label for="visit3" class="css-label">Diabetes consultation <strong>$55</strong></label>
									</div>
								</li>
								<li>
									<div class="checkbox">
										<input type="checkbox" class="css-checkbox" id="visit4" name="visit4">
										<label for="visit4" class="css-label">General visit <strong>$55</strong></label>
									</div>
								</li> -->
							</ul>
							<hr>
							<button type="button" class="btn_1 full-width" id="bookingview_btn" name="bookingview_btn">Book Now12</button>
						<!-- 	<a href="#"> <input >
							</a> -->
						</form>
					</div>
					<!-- /box_general -->
				</aside>
				<!-- /asdide -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</main>
	<!-- /main -->

 <?php
include('static/footer.php');
?>

<script type="text/javascript">
	$('#booking_date1').dateDropper({
           format:"dd/m/Y"

		});
	
		// $('#booking_time').timeDropper({
		// 	setCurrentTime: false,
		// 	meridians: true,
		// 	primaryColor: "#e74e84",
		// 	borderColor: "#e74e84",
		// 	minutesInterval: '15'
		// });

function GetTimeSlotsData() {

  var doctors_id        = $('#booking_doctors_id').val();
  var date              = $('#booking_date1').val();
  var account_id        = $('#booking_account_id').val();
  // alert(date);
  // alert(doctors_id);
  // alert(account_id);

   $.ajax({
    type:"POST",
    url:url+"FrontendController/GetTimeSlotsForAppointmentFrontView",
    dataType: 'json',
    data:{doctors_id:doctors_id,date:date,account_id:account_id},
    beforeSend: function(){
    // Show image container
    $(".loader").show();
   },
 success: function(result){
      if(result.success===true){
                var items ='<option value="">--Timings--</option>';
                 var i;
                 var n = result.data.length;
                 //alert(n);
                for(var i=0; i<n; i++){
                    items+='<option value="'+result.data[i]+'">'+result.data[i]+'</option>'; 
                     }
               $("#booking_time1").html(items);
       }
  else if(result.success===false){
  	     $("#booking_time1").empty();
         alert(result.message);
      }
    },
    complete:function(){
    // Hide image container
    $(".loader").hide();
}, 
    failure: function (result){
      alert("Some thing went wrong try again ...");
     } 
         
      });



}


</script>


<script src="/<?php echo base_url();?>assets/js/Common/FrontendController.js"></script>