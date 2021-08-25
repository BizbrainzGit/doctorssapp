
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/doctorLayout_Header.php');
?>
 
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">My Profile
                 <a href="/<?php echo base_url();?>Doctor-Dashboard"> <div style="float:right"><button type="button" class="btn btn-info btn-sm"> Back </button></div></a> </h4>
                  <form id="doctor_profiledata" method="post" enctype="multipart/form-data" >

                    <div>
                      <h3>Basic Details</h3>
                        <section>
                          <h3>Basic Details</h3>
                            <div class="row clearfixed">
                              <input type="hidden" id="doctor_profile_id" name="doctor_profile_id">
                              <input type="hidden" id="doctor_profile_addid" name="doctor_profile_addid">
                              <input type="hidden" id="doctor_profile_userid" name="doctor_profile_userid">

                        <div class="col-sm-6 col-12 form-group">
                          <label>First Name <span class="requried_class">*</span> </label>
                          <input type="text" class="form-control" placeholder="Person Name" name="doctor_profile_fname" id="doctor_profile_fname">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Last Name <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" placeholder="Person Name" name="doctor_profile_lname" id="doctor_profile_lname">
                        </div>                   
                        <div class="col-sm-6 col-12 form-group">
                          <label>Age</label>
                          <input type="text" class="form-control" placeholder="Age" name="doctor_profile_age" id="doctor_profile_age">
                        </div>
                         <div class="col-sm-6 col-12 form-group">
                          <label>Gender</label>
                          <select class="form-control" name="doctor_profile_gender" id="doctor_profile_gender">
                             <option>Select Gender</option>
                             <option value="Male">Male</option>
                             <option value="Female">Female</option>
                          </select>
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Mobile Number <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" maxlength="10" placeholder="MOBILE NUMBER" name="doctor_profile_mobileno" id="doctor_profile_mobileno">
                        </div>
                         <div class="col-sm-6 col-12 form-group">
                         <div id="doctorimage"></div>
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Photo <span class="requried_class">*</span></label>
                          <input type="file" class="form-control" name="doctor_profile_photo" id="doctor_profile_photo">
                        </div>
                      </div>
                      </section>

                      
                    <h3>Medical Information</h3>
                      <section>
                        <h3>Medical Information</h3>
                        <div class="row clearfixed">

                          <div class="col-sm-6 col-12 form-group">
                          <label>Designation <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" placeholder="Designation" name="doctor_profile_designation" id="doctor_profile_designation">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Specialist <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" placeholder="Specialist" name="doctor_profile_specialist" id="doctor_profile_specialist">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                        <label>Specialization <span class="requried_class">*</span></label>
                        <select class="form-control" name="doctor_profile_specialization" id="doctor_profile_specialization">
                          </select>
                        </div>

                        
                        <div class="col-sm-6 col-12 form-group">
                          <label>Blood Group <span class="requried_class">*</span></label>
                          <select class="form-control" name="doctor_profile_bloodgroup" id="doctor_profile_bloodgroup">
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
                          <textarea  class="form-control" placeholder="Education Qualification" name="doctor_profile_education" id="doctor_profile_education" rows="4" cols="50"></textarea>
                        </div>
                        <div class="col-sm-12 col-12 form-group">
                          <label>Short Biography</label>
                          <textarea  class="form-control" placeholder="Biography" name="doctor_profile_biography" id="doctor_profile_biography" rows="4" cols="50"></textarea>
                        </div>
                      </div>
                      </section>

                      <h3>Address Details</h3>
                      <section>
                        <h3>Address Details</h3>
                        <div class="row clearfixed">
                        <div class="col-sm-6 col-12 form-group">
                          <label>Building No/House No</label>
                          <input type="text" class="form-control text-uppercase" placeholder="Building No/House No" name="doctor_profile_hno" id="doctor_profile_hno">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Street <span class="requried_class">*</span></label>
                          <input type="text" class="form-control text-uppercase" placeholder="Street Name" name="doctor_profile_street" id="doctor_profile_street">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Area <span class="requried_class">*</span></label>
                          <input type="text" class="form-control text-uppercase" placeholder="Area" name="doctor_profile_area" id="doctor_profile_area">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Landmark</label>
                          <input type="text" class="form-control text-uppercase" placeholder="Landmark" name="doctor_profile_landmark" id="doctor_profile_landmark">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Pincode <span class="requried_class">*</span></label>
                          <input type="text" class="form-control text-uppercase" maxlength="6" placeholder="Pincode" name="doctor_profile_pincode" id="doctor_profile_pincode">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>State <span class="requried_class">*</span></label>
                          <select class="form-control text-uppercase" name="doctor_profile_state" id="doctor_profile_state" onchange="getCityByState('#doctor_profile_city',this);">
                          </select>
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>City <span class="requried_class">*</span></label>
                           <select class="form-control text-uppercase" name="doctor_profile_city" id="doctor_profile_city">
                          </select>
                        </div>
                        

                      </div>
                      
                      </section>
                      <h3>Finish</h3>
                      <section>
                        <h3>Finish</h3>
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="checkbox" type="checkbox">
                            I agree with the Terms and Conditions.
                          </label>
                           <div class="col-sm-12 col-12 form-group">
                          <div id="doctorprofiledata-editmsg"></div>
                        </div>
                        </div>
                      </section>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!--vertical wizard-->

        </div>

           

     
<?php
include('Layouts/doctorLayout_Footer.php');
?>

<script src="/<?php echo base_url();?>assets/js/doctor/DoctorProfileController.js" type="text/javascript"></script>

<script type="text/javascript">
  
  getSpecialization("#doctor_profile_specialization");

  getState("#doctor_profile_state");

  getCityByState('#doctor_profile_city',0);

</script>
<script type="text/javascript">
     $( "#doctor_profile_dob" ).datepicker({
      todayHighlight: true,
    autoclose  : true,
    endDate  : '0d',
    Format : 'dd-mm-yy'
  });

  
  

</script>