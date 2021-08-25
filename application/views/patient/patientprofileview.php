
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/patientLayout_Header.php');
?>
 
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">My Profile
                 <a href="/<?php echo base_url();?>Patient-Dashboard"> <div style="float:right"><button type="button" class="btn btn-info btn-sm"> Back </button></div></a> </h4>
                 
                  <form id="patient_profiledata" method="post" enctype="multipart/form-data" >

                    <div>
                      <h3>Basic Details</h3>
                      <section>
                        <!-- <h3>Basic Details</h3> -->
                      <div class="row clearfixed">
                              <input type="hidden" id="patient_profile_id" name="patient_profile_id">
                              <input type="hidden" id="patient_profile_addid" name="patient_profile_addid">
                              <input type="hidden" id="patient_profile_userid" name="patient_profile_userid"> 

                        <div class="col-sm-6 col-12 form-group">
                          <label>First Name <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " placeholder="Person Name" name="patient_profile_fname" id="patient_profile_fname">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Last Name <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " placeholder="Person Name" name="patient_profile_lname" id="patient_profile_lname">
                        </div>
                       
                          <div class="col-sm-6 col-12 form-group">
                          <label>Age <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " placeholder="Age" name="patient_profile_age" id="patient_profile_age">
                        </div>

                         <div class="col-sm-6 col-12 form-group">
                          <label>Gender <span class="requried_class">*</span></label>
                          <select class="form-control " name="patient_profile_gender" id="patient_profile_gender">
                             <option>Select Gender</option>
                             <option value="Male">Male</option>
                             <option value="Female">Female</option>
                          </select>
                        </div>
                        
                        <div class="col-sm-6 col-12 form-group">
                          <label>Mobile Number <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" maxlength="10" placeholder="MOBILE NUMBER" name="patient_profile_mobileno" id="patient_profile_mobileno">
                        </div>
                      </div>

                      </section>
                      
                     <h3>Medical Information</h3>
                      <section>
                        <h3>Medical Information</h3>
                        <div class="row clearfixed">

                          <div class="col-sm-6 col-12 form-group">
                          <label>Height <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " placeholder="Height" name="patient_profile_height" id="patient_profile_height">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Weight <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " placeholder="Weight" name="patient_profile_weight" id="patient_profile_weight">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Blood Group <span class="requried_class">*</span></label>
                          <select class="form-control " name="patient_profile_bloodgroup" id="patient_profile_bloodgroup">
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
                        <div class="col-sm-6 col-12 form-group">
                          <label>Blood Prusser <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " placeholder="Blood Prusser" name="patient_profile_bloodprusser" id="patient_profile_bloodprusser">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Pulse <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " placeholder="Pulse" name="patient_profile_pulse" id="patient_profile_pulse">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Past Medical History</label>
                          <input type="text" class="form-control "  placeholder="Past Medical History" name="patient_profile_allergy" id="patient_profile_allergy">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Diet</label>
                          <input type="text" class="form-control "  placeholder="Diet" name="patient_profile_diet" id="patient_profile_diet">
                        </div>
                      
                      </div>
                      </section>

                      <h3>Address Details</h3>
                      <section>
                        <h3>Address Details</h3>
                        <div class="row clearfixed">
                        <div class="col-sm-6 col-12 form-group">
                        <label>Building No/House No <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " placeholder="Building No/House No" name="patient_profile_hno" id="patient_profile_hno">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Street <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " placeholder="Street Name" name="patient_profile_street" id="patient_profile_street">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Landmark</label>
                          <input type="text" class="form-control " placeholder="Landmark" name="patient_profile_landmark" id="patient_profile_landmark">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Area <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " placeholder="Area" name="patient_profile_area" id="patient_profile_area">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>State <span class="requried_class">*</span></label>
                          <select class="form-control" name="patient_profile_state" id="patient_profile_state" onchange="getCityByState('#patient_profile_city',this);" >
                          </select>
                        </div>
                        
                        <div class="col-sm-6 col-12 form-group">
                          <label>City <span class="requried_class">*</span></label>
                           <select class="form-control" name="patient_profile_city" id="patient_profile_city">
                          </select>
                        </div>
                       
                        <div class="col-sm-6 col-12 form-group">
                          <label>Pincode <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " maxlength="6" placeholder="PINCODE" name="patient_profile_pincode" id="patient_profile_pincode">
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
                          <div id="patient_profile_data-editmsg"></div>
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
include('Layouts/patientLayout_Footer.php');
?>

<script src="/<?php echo base_url();?>assets/js/patient/PatientProfileController.js"></script>

<script type="text/javascript">
  
  getState("#patient_profile_state");
  getCityByState('#patient_profile_city',0);

</script>
