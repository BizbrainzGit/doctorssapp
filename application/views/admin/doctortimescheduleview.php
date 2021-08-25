<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/adminLayout_Header.php');
?>
<div class="main-panel">
<div class="content-wrapper listdoctortimeschedule-class">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Doctor Time Schedule<div style="float:right"><button type="button" class="btn btn-info btn-sm" id="showadddoctortimeschedule"><i class="fa fa-plus" aria-hidden="true"></i>Add</button></div></h4>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="doctortimescheduletable" class="table table-hover">
                    
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>




       <div class="content-wrapper adddoctortimeschedule-class" style="display: none;" >
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add Doctor Time schedule Details
                 <a href="/<?php echo base_url();?>Admin-Doctor-Time-Schedule"> <div style="float:right"><button type="button" class="btn btn-info btn-sm"> Back </button></div></a> </h4>

                  <form id="add_doctortimeschedule"  method="post" enctype="multipart/form-data" >

                      <div class="row clearfixed">

                        <div class="col-sm-6 col-12 form-group">
                          <label>Doctor Name <span class="requried_class">*</span></label>
                          <select  class="form-control" name="add_doctortimeschedule_doctorid" id="add_doctortimeschedule_doctorid" style="width: 100%;"></select>
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Week Days <span class="requried_class">*</span></label>
                              <select  class="form-control" name="add_doctortimeschedule_date" id="add_doctortimeschedule_date">
                                 <option value="">--- Select Week Day ---</option>
                                 <option value="Monday">Monday</option>
                                 <option value="Tuesday">Tuesday</option>
                                 <option value="Wednesday">Wednesday</option>
                                 <option value="Thursday">Thursday</option>
                                 <option value="Friday">Friday</option>
                                 <option value="Saturday">Saturday</option>
                                 <option value="Sunday">Sunday</option>
                             </select>
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label> Start Time <span class="requried_class">*</span></label>
                          <input type="time" class="form-control" placeholder=" Time Start " name="add_doctortimeschedule_timestart" id="add_doctortimeschedule_timestart">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label> End Time <span class="requried_class">*</span></label>
                          <input type="time" class="form-control" placeholder=" Time End" name="add_doctortimeschedule_timeend" id="add_doctortimeschedule_timeend">
                        </div>
                        
                        <div class="col-sm-6 col-12 form-group">
                           <label>Appointment Type <span class="requried_class">*</span></label>
                           <select  class="form-control" name="add_doctortimeschedule_appointmenttype" id="add_doctortimeschedule_appointmenttype">
                             <option value="">--- Appointment Type ---</option>
                             <option value="1">Online</option>
                             <option value="2">Offline</option>
                           </select>
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Patient Spending Time (in Minutes) <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" placeholder=" Patient Spending Time" name="add_doctortimeschedule_patient_time" id="add_doctortimeschedule_patient_time">
                        </div>

                          <div class="col-sm-12" style="text-align: center;">
                                    <div id="doctortimeschedule-addmsg"></div>
                                    <button type="button" id="adddoctortimeschedule" class="btn btn-primary">Save</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>

                      </div>

                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
       

        <div class="content-wrapper editdoctortimeschedule-class" style="display: none;" >
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit Patient Details<span id="edit_doctortimeschedulename_head"></span>
                 <a href="/<?php echo base_url();?>Admin-Doctor-Time-Schedule"> <div style="float:right"><button type="button" class="btn btn-info btn-sm"> Back </button></div></a> </h4>
                         
                  <form id="edit_doctortimeschedule"  method="post" enctype="multipart/form-data" >
                      <div class="row clearfixed">
                      <input type="hidden" id="edit_doctortimeschedule_id" name="edit_doctortimeschedule_id">
                         <div class="col-sm-6 col-12 form-group">
                          <label>Doctor Name</label>
                          <select  class="form-control" name="edit_doctortimeschedule_doctorid" id="edit_doctortimeschedule_doctorid" style="width: 100%;"></select>
                        </div>
                         <div class="col-sm-6 col-12 form-group">
                          <label>Week Days <span class="requried_class">*</span></label>
                              <select  class="form-control" name="edit_doctortimeschedule_date" id="edit_doctortimeschedule_date">
                                 <option value="">--- Select Week Day ---</option>
                                 <option value="Monday">Monday</option>
                                 <option value="Tuesday">Tuesday</option>
                                 <option value="Wednesday">Wednesday</option>
                                 <option value="Thursday">Thursday</option>
                                 <option value="Friday">Friday</option>
                                 <option value="Saturday">Saturday</option>
                                 <option value="Sunday">Sunday</option>
                             </select>
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Start Time </label>
                          <input type="time" class="form-control " placeholder="Time Start" name="edit_doctortimeschedule_timestart" id="edit_doctortimeschedule_timestart">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>End Time </label>
                          <input type="time" class="form-control " placeholder="Time End" name="edit_doctortimeschedule_timeend" id="edit_doctortimeschedule_timeend">
                        </div>

                          <div class="col-sm-6 col-12 form-group">
                        <label>Appointment Type <span class="requried_class">*</span></label>
                           <select  class="form-control" name="edit_doctortimeschedule_appointmenttype" id="edit_doctortimeschedule_appointmenttype">
                             <option value="" >--- Appointment Type ---</option>
                             <option value="1">Online</option>
                             <option value="2">Offline</option>
                           </select>
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Patient Spending Time <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " placeholder="Evening Patient Spending Time" name="edit_doctortimeschedule_patient_time" id="edit_doctortimeschedule_patient_time">
                        </div>

                         <div class="col-sm-12 col-12 form-group text-center">
                          <div id="doctortimeschedule-editmsg"></div>
                          <button type="button" class="btn btn-info btn-sm" id="updatedoctortimeschedule"> Submit </button>
                          <button type="button" class="btn btn-info btn-sm"> Reset </button>
                        </div>

                    </div>

                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>



       
         
<?php
include('Layouts/adminLayout_Footer.php');
?>
  <script src="/<?php echo base_url();?>assets/js/Common/DoctorTimeScheduleController.js"></script>
  <script type="text/javascript">

     getDoctor("#add_doctortimeschedule_doctorid");
     getDoctor("#edit_doctortimeschedule_doctorid");

  </script>