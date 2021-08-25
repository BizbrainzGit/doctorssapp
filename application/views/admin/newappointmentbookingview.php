<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/adminLayout_Header.php');
?>
<div class="main-panel">
  <div class="content-wrapper" >
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">New Appointment Booking</h4>
                  <div class="row grid-margin">
                    <div class="col-12">
                      <div class="header">
                        <h5>
                          <div style="float:right"><button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#AddappointmentbookingModal"><i class="fa fa-plus" aria-hidden="true"></i>Add</button></div>
                         </h5>
                        </div>
                    </div>
                   
                  </div>
                  <div class="row">
                    <div class="col-12">

                        <form id="add_appointmentbooking" method="post" >
                        <div class="row clearfix">
                          <div class="col-sm-6">
                            <div class="form-group">
                                <label> Patient Name<span class="requried_class">*</span>:</label>
                                 <select  class="form-control" name="add_appointmentbooking_patient" id="add_appointmentbooking_patient">
                               
                                </select>
                            </div>
                          </div>

                          <div class="col-sm-6">
                                    <div class="form-group">
                                        <label> Appointment Date <span class="requried_class">*</span>:</label>
                                         <input type="text" class="form-control" placeholder="Date" name="add_appointmentbooking_date" id="add_appointmentbooking_date"  >
                                     </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label> Specialization <span class="requried_class">*</span>:</label>
                                         <select style="width: 100%"  class="form-control " name="add_appointmentbooking_department" id="add_appointmentbooking_department" onchange="getDoctorDepartment('#add_appointmentbooking_doctor',this);">
                                        </select>
                                     </div>
                                </div>

                                 <div class="col-sm-6">
                                    <div class="form-group">
                                        <label> Doctor <span class="requried_class">*</span> :</label>
                                         <select  class="form-control " name="add_appointmentbooking_doctor" id="add_appointmentbooking_doctor" onchange="getAppointmentScheduleTime('#add_appointmentbooking_timeslot',this);" >
                                        </select>
                                     </div>
                                </div>
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                        <label> Appointment Schedule Time <span class="requried_class">*</span> :</label>
                                         <select  class="form-control " name="add_appointmentbooking_timeslot" id="add_appointmentbooking_timeslot" >
                                        </select>
                                     </div>
                                </div>
                                <div class="col-sm-12">
                                   <div class="doctortimeschedule-timemsg"></div>
                                </div>
                                                             
                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        <label> Description :</label>
                                         <textarea class="form-control" placeholder="Description " name="add_appointmentbooking_description" id="add_appointmentbooking_description" rows="2"></textarea>
                                    </div>
                                </div>

                        <div class="col-sm-12">
                          <div id="appointmentbooking-addmsg"></div>
                        </div>

                        <div class="col-sm-12" style="text-align: center;">
                           <button  type="button" id="addappointmentbooking" class="btn btn-primary">Save</button>
                           <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>


                    </div>             
                 
              </form>


                    
                    </div>
                  </div>


                </div>
              </div>
            </div>
          </div>
        </div>


<?php
include('Layouts/adminLayout_Footer.php');
?>

<script src="/<?php echo base_url();?>assets/js/Common/AppointmentbookingController.js"></script>

<script type="text/javascript">
  getPatient("#add_appointmentbooking_patient");
  getSpecialization("#add_appointmentbooking_department");
</script>

<script type="text/javascript">
     $( "#add_appointmentbooking_date" ).datepicker({
      todayHighlight: true,
      autoclose  : true,
      startDate  : '0d',
      Format : 'dd-mm-yy'
  });
 
     </script>


