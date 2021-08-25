<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/adminLayout_Header.php');
?>

<div class="main-panel">
<div class="modal fade" id="EditDoctorstatusModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Change Status</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
       </div>
        <!-- Modal body -->
        <div class="modal-body">
                    <div class="body">
                      <div id="doctorstatus-editmsg"></div>
                        <form id="doctor_status_change_form" method="post" >
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                      <input type="hidden" id="doctor_status_id" name="doctor_status_id"> 
                                       
                                    </div>
                                </div>
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                      <h4 id="activestatusmsg"></h4>
                                       
                                        <input type="hidden" id="doctor_status_change" name="doctor_status_change">
                                         
                                    </div>
                                </div>
                            </div>
            
                    </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
      <div class="col-sm-12" style="text-align: center;">
          <button type="button" id="doctorupdatestatus" class="btn btn-primary">Yes</button>
          <button type="reset" class="btn btn-outline-secondary">No</button>
      </div>
      </form>
        </div>
      </div>
    </div>
  </div>

<div class="content-wrapper listdoctor-class" id="">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Doctors List  <div style="float:right"><button type="button" class="btn btn-info btn-sm" id="showadddoctor"><i class="fa fa-plus" aria-hidden="true"></i>Add</button></div></h4>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="doctortable" class="table table-hover"></table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

  <div class="content-wrapper adddoctor-class" style="display: none;" >
    <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Doctor Details
              <a href="/<?php echo base_url();?>Admin-Manage-Doctors"> <div style="float:right"><button type="button" class="btn btn-info btn-sm"> Back </button></div></a> </h4>

                <form id="add_doctordata"  method="post" enctype="multipart/form-data" >
                <div>
                  <h3>Basic Details</h3>
                    <section>
                       <h3>Basic Details</h3>
                      <div class="row clearfixed">

                        <div class="col-sm-6 col-12 form-group">
                          <label>First Name <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" placeholder="Person Name" name="add_doctor_fname" id="add_doctor_fname">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Last Name <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" placeholder="Person Name" name="add_doctor_lname" id="add_doctor_lname">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Age <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" placeholder="Age" name="add_doctor_age" id="add_doctor_age">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Gender <span class="requried_class">*</span></label>
                          <select class="form-control" name="add_doctor_gender" id="add_doctor_gender">
                             <option>Select Gender</option>
                             <option value="Male">Male</option>
                             <option value="Female">Female</option>
                          </select>
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Mobile Number <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" maxlength="10" placeholder="MOBILE NUMBER" name="add_doctor_mobileno" id="add_doctor_mobileno">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Email <span class="requried_class">*</span></label>
                          <input type="email" class="form-control" placeholder="Email" name="add_doctor_email" id="add_doctor_email">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Password <span class="requried_class">*</span></label>
                          <input type="password" class="form-control" placeholder="Password" name="add_doctor_password" id="add_doctor_password">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Confirmed Password <span class="requried_class">*</span></label>
                          <input type="password" class="form-control" placeholder="Password" name="add_doctor_cpassword" id="add_doctor_cpassword">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Photo <span class="requried_class">*</span></label>
                          <input type="file" class="form-control" name="add_doctor_photo" id="add_doctor_photo">
                          <span style="color: red">File must be in the form of Below 1 MB Only...</span>
                        </div>

                      </div>

                    </section>

                    <h3>Medical Information</h3>
                    <section>
                      <h3>Medical Information</h3>
                       <div class="row clearfixed">

                        <div class="col-sm-6 col-12 form-group">
                          <label>Designation <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" placeholder="Designation" name="add_doctor_designation" id="add_doctor_designation">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Specialist <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" placeholder="Specialist" name="add_doctor_specialist" id="add_doctor_specialist">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Specialization <span class="requried_class">*</span></label>
                          <select class="form-control" name="add_doctor_department" id="add_doctor_department">
                          </select>
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Consultation Fee <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" placeholder="Consultation Fee" name="add_doctor_consultationfee" id="add_doctor_consultationfee">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Blood Group <span class="requried_class">*</span></label>
                          <select class="form-control" name="add_doctor_bloodgroup" id="add_doctor_bloodgroup">
                             <option value="">Select Blood Group</option>
                             <option value="A+">A+</option>
                             <option value="A-">A-</option>
                             <option value="B+">B+</option>
                             <option value="B-">B-</option>
                             <option value="AB+">AB+</option>
                             <option value="AB-">AB-</option>
                             <option value="O+">O+</option>
                             <option value="O-">O-</option>
                          </select>
                        </div>

                        <div class="col-sm-12 col-12 form-group">
                          <label>Education/Degree</label>
                          <textarea  class="form-control" placeholder="Education Qualification" name="add_doctor_education" id="add_doctor_education" rows="4" cols="50"></textarea>
                        </div>

                        <div class="col-sm-12 col-12 form-group">
                          <label>Short Biography</label>
                          <textarea  class="form-control" placeholder="Biography" name="add_doctor_biography" id="add_doctor_biography" rows="4" cols="50"></textarea>
                        </div>

                      </div>
                    </section>

                    <h3>Address Details</h3>
                    <section>
                      <h3>Address Details</h3>
                       <div class="row clearfixed">

                        <div class="col-sm-6 col-12 form-group">
                          <label>Building No/House No <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " placeholder="Building No/House No" name="add_doctor_hno" id="add_doctor_hno">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Street <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " placeholder="Street Name" name="add_doctor_street" id="add_doctor_street">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Area <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " placeholder="Area" name="add_doctor_area" id="add_doctor_area">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Landmark</label>
                          <input type="text" class="form-control " placeholder="Landmark" name="add_doctor_landmark" id="add_doctor_landmark">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>State <span class="requried_class">*</span></label>
                          <select class="form-control " name="add_doctor_state" id="add_doctor_state" onchange="getCityByState('#add_doctor_city',this);">
                          </select>
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>City <span class="requried_class">*</span></label>
                           <select class="form-control " name="add_doctor_city" id="add_doctor_city" >
                          </select>
                        </div>

                     

                        <div class="col-sm-6 col-12 form-group">
                          <label>Pincode <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " maxlength="6" placeholder="Pincode" name="add_doctor_pincode" id="add_doctor_pincode">
                        </div>

                      </div>
                    </section>

                    <h3>Final Submit</h3>
                    <section>
                      <h3> Final Submit </h3>
                        <div class="form-check">
                          <label class="form-check-label">
                          <input class="checkbox" type="checkbox" name="add_doctor_condition" id="add_doctor_condition">
                          I Agree With The Terms and Conditions.
                          </label>
                          <div class="col-sm-12 col-12 form-group">
                          <div id="doctordata-addmsg"></div>
                        </div>
                      </div>

                    </section>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
       

        <div class="content-wrapper editdoctor-class" style="display: none;" >
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit Doctor Details<span id="edit_doctorname_head"></span>
                    <a href="/<?php echo base_url();?>Admin-Manage-Doctors"> <div style="float:right"><button type="button" class="btn btn-info btn-sm"> Back </button></div></a> </h4>
                         
                      <form id="edit_doctordata"  method="post" enctype="multipart/form-data" >
                        <div>
                          <h3>Basic Details</h3>
                            <section>
                             <h3>Basic Details</h3>
                              <div class="row clearfixed">
                                <input type="hidden" id="edit_doctor_id" name="edit_doctor_id">
                                <input type="hidden" id="edit_doctor_addid" name="edit_doctor_addid">
                                <input type="hidden" id="edit_doctor_userid" name="edit_doctor_userid">

                                <div class="col-sm-6 col-12 form-group">
                                  <label>First Name <span class="requried_class">*</span> </label>
                                  <input type="text" class="form-control" placeholder="Person Name" name="edit_doctor_fname" id="edit_doctor_fname">
                                </div>

                                <div class="col-sm-6 col-12 form-group">
                                  <label>Last Name <span class="requried_class">*</span></label>
                                  <input type="text" class="form-control" placeholder="Person Name" name="edit_doctor_lname" id="edit_doctor_lname">
                                </div>

                                <div class="col-sm-6 col-12 form-group">
                                  <label>Age <span class="requried_class">*</span></label>
                                  <input type="text" class="form-control" placeholder="Age" name="edit_doctor_age" id="edit_doctor_age">
                                </div>                     
                        
                                <div class="col-sm-6 col-12 form-group">
                                  <label>Gender <span class="requried_class">*</span></label>
                                  <select class="form-control" name="edit_doctor_gender" id="edit_doctor_gender">
                                   <option>Select Gender</option>
                                   <option value="Male">Male</option>
                                   <option value="Female">Female</option>
                                  </select>
                                </div>

                                <div class="col-sm-6 col-12 form-group">
                                  <label>Mobile Number <span class="requried_class">*</span></label>
                                  <input type="text" class="form-control" maxlength="10" placeholder="MOBILE NUMBER" name="edit_doctor_mobileno" id="edit_doctor_mobileno">
                                </div>

                                <div class="col-sm-6 col-12 form-group"> <div id="doctorimage"></div> </div>

                                <div class="col-sm-6 col-12 form-group">
                                  <label>Photo <span class="requried_class">*</span></label>
                                  <input type="file" class="form-control" name="edit_doctor_photo" id="edit_doctor_photo">
                                </div>
                      
                              </div>

                            </section>

                          <h3>Medical Information</h3>
                            <section>
                              <h3>Medical Information</h3>
                                <div class="row clearfixed">

                                  <div class="col-sm-6 col-12 form-group">
                                    <label>Designation <span class="requried_class">*</span></label>
                                    <input type="text" class="form-control" placeholder="Designation" name="edit_doctor_designation" id="edit_doctor_designation">
                                  </div>

                                  <div class="col-sm-6 col-12 form-group">
                                    <label>Specialist <span class="requried_class">*</span></label>
                                    <input type="text" class="form-control" placeholder="Specialist" name="edit_doctor_specialist" id="edit_doctor_specialist">
                                  </div>

                                  <div class="col-sm-6 col-12 form-group">
                                    <label>Specialization <span class="requried_class">*</span></label>
                                    <select class="form-control" name="edit_doctor_department" id="edit_doctor_department"> 
                                    </select>
                                  </div>

                                  <div class="col-sm-6 col-12 form-group">
                                    <label>Consultation Fee <span class="requried_class">*</span></label>
                                    <input type="text" class="form-control" placeholder="Consultation Fee" name="edit_doctor_consultationfee" id="edit_doctor_consultationfee">
                                  </div>

                                  <div class="col-sm-6 col-12 form-group">
                                    <label>Blood Group <span class="requried_class">*</span></label>
                                    <select class="form-control" name="edit_doctor_bloodgroup" id="edit_doctor_bloodgroup">
                                       <option>Select Blood Group</option>
                                       <option value="A+">A+</option>
                                       <option value="A-">A-</option>
                                       <option value="B+">B+</option>
                                       <option value="B-">B-</option>
                                       <option value="AB+">AB+</option>
                                       <option value="AB-">AB-</option>
                                       <option value="O+">O+</option>
                                       <option value="O-">O-</option>
                                    </select>
                                  </div>

                                  <div class="col-sm-12 col-12 form-group">
                                    <label>Education/Degree</label>
                                    <textarea  class="form-control" placeholder="Education Qualification" name="edit_doctor_education" id="edit_doctor_education" rows="4" cols="50"></textarea>
                                  </div>

                                  <div class="col-sm-12 col-12 form-group">
                                    <label>Short Biography</label>
                                    <textarea  class="form-control" placeholder="Biography" name="edit_doctor_biography" id="edit_doctor_biography" rows="4" cols="50"></textarea>
                                  </div>

                                </div>
                            </section>
              
                          <h3>Address Details</h3>
                            <section>
                              <h3>Address Details</h3>
                                <div class="row clearfixed">

                                  <div class="col-sm-6 col-12 form-group">
                                    <label>Building No/House No</label>
                                    <input type="text" class="form-control " placeholder="Building No/House No" name="edit_doctor_hno" id="edit_doctor_hno">
                                  </div>

                                  <div class="col-sm-6 col-12 form-group">
                                    <label>Street <span class="requried_class">*</span></label>
                                    <input type="text" class="form-control " placeholder="Street Name" name="edit_doctor_street" id="edit_doctor_street">
                                  </div>

                                  <div class="col-sm-6 col-12 form-group">
                                    <label>Area <span class="requried_class">*</span></label>
                                    <input type="text" class="form-control " placeholder="Area" name="edit_doctor_area" id="edit_doctor_area">
                                  </div>

                                  <div class="col-sm-6 col-12 form-group">
                                    <label>Landmark</label>
                                    <input type="text" class="form-control " placeholder="Landmark" name="edit_doctor_landmark" id="edit_doctor_landmark">
                                  </div>

                                  <div class="col-sm-6 col-12 form-group">
                                    <label>Pincode <span class="requried_class">*</span></label>
                                    <input type="text" class="form-control " maxlength="6" placeholder="Pincode" name="edit_doctor_pincode" id="edit_doctor_pincode">
                                  </div>
                                 
                                  <div class="col-sm-6 col-12 form-group">
                                    <label>State <span class="requried_class">*</span></label>
                                    <select class="form-control " name="edit_doctor_state" id="edit_doctor_state" onchange="getCityByState('#edit_doctor_city',this);">
                                    </select>
                                  </div>

                                  <div class="col-sm-6 col-12 form-group">
                                    <label>City <span class="requried_class">*</span></label>
                                     <select class="form-control " name="edit_doctor_city" id="edit_doctor_city">
                                    </select>
                                  </div>

                                 

                                </div>
                            </section>

                          <h3>Final Submit</h3>
                            <section>
                             <h3> Final Submit </h3>
                                <div class="form-check">
                                    <label class="form-check-label">
                                    <input class="checkbox" type="checkbox" name="edit_doctor_condition" id="edit_doctor_condition">
                                    I Agree With The Terms and Conditions.
                                    </label>
                                  <div class="col-sm-12 col-12 form-group"> 
                                    <div id="doctordata-editmsg"> </div>
                                  </div>
                                </div>

                            </section>

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

<script src="/<?php echo base_url();?>assets/js/admin/DoctorController.js"></script>

<script type="text/javascript">
  
  getSpecialization("#add_doctor_department");
  getSpecialization("#edit_doctor_department");

  getState("#add_doctor_state");
  getState("#edit_doctor_state");

  getCityByState('#add_doctor_city',0);
  getCityByState('#edit_doctor_city',0);
  
</script>
<script type="text/javascript">
   $( "#edit_doctor_dob" ).datepicker({
    todayHighlight: true,
    autoclose  : true,
    endDate  : '0d',
    Format : 'dd-mm-yy'
  });

   $( "#add_doctor_dob" ).datepicker({
    todayHighlight: true,
    autoclose  : true,
    endDate  : '0d',
    Format : 'dd-mm-yy'
  });   

  

</script>