
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/receptionistLayout_Header.php');
?>
     
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">My Profile
                   <a href="/<?php echo base_url();?>Receptionist-Dashboard"> 
                    <div style="float:right">
                      <button type="button" class="btn btn-info btn-sm"> Back </button>
                    </div>
                   </a> 
                  </h4>
                 
                  <form id="receptionist_profile_data" method="post" enctype="multipart/form-data" >
                    <div>
                      <h3>Basic Details</h3>
                      <section>
                        <!-- <h3>Basic Details</h3> -->
                      <div class="row clearfixed">
                             <input type="hidden" id="receptionist_profile_id" name="receptionist_profile_id">
                              <input type="hidden" id="receptionist_profile_addid" name="receptionist_profile_addid">
                              <input type="hidden" id="receptionist_profile_userid" name="receptionist_profile_userid">

                        <div class="col-sm-6 col-12 form-group">
                          <label>First Name <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " placeholder="Person Name" name="receptionist_profile_fname" id="receptionist_profile_fname">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Last Name <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " placeholder="Person Name" name="receptionist_profile_lname" id="receptionist_profile_lname">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Mobile Number <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" maxlength="10" placeholder="Mobile Number" name="receptionist_profile_mobileno" id="receptionist_profile_mobileno">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Age <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" placeholder="Age" name="receptionist_profile_age" id="receptionist_profile_age">
                        </div>
                        
                        <div class="col-sm-6 col-12 form-group">
                          <label>Gender</label>
                          <select class="form-control" name="receptionist_profile_gender" id="receptionist_profile_gender">
                             <option>Select Gender</option>
                             <option value="1">Male</option>
                             <option value="0">Female</option>
                          </select>
                        </div>

                         
                        <div class="col-sm-6 col-12 form-group">
                         <div id="receptionistimage"></div>
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Photo <span class="requried_class">*</span></label>
                          <input type="file" class="form-control" name="receptionist_profile_photo" id="receptionist_profile_photo">
                        </div>
                      </div>
                    </section>
                      


                      <h3>Address Details</h3>
                      <section>
                        <h3>Address Details</h3>
                        <div class="row clearfixed">
                        <div class="col-sm-6 col-12 form-group">
                        <label>Building No/House No <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " placeholder="Building No/House No" name="receptionist_profile_hno" id="receptionist_profile_hno">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Street <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " placeholder="Street Name" name="receptionist_profile_street" id="receptionist_profile_street">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Landmark</label>
                          <input type="text" class="form-control " placeholder="Landmark" name="receptionist_profile_landmark" id="receptionist_profile_landmark">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Area <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " placeholder="Area" name="receptionist_profile_area" id="receptionist_profile_area">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>State <span class="requried_class">*</span></label>
                          <select class="form-control " name="receptionist_profile_state" id="receptionist_profile_state" onchange="getCityByState('#receptionist_profile_city',this);">
                          </select>
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>City <span class="requried_class">*</span></label>
                           <select class="form-control " name="receptionist_profile_city" id="receptionist_profile_city">
                          </select>
                        </div>
                        
                        <div class="col-sm-6 col-12 form-group">
                          <label>Pincode <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " maxlength="6" placeholder="PINCODE" name="receptionist_profile_pincode" id="receptionist_profile_pincode">
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
                          <div id="receptionist_profile_data-editmsg"></div>
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
include('Layouts/receptionistLayout_Footer.php');
?>

<script src="/<?php echo base_url();?>assets/js/receptionist/ReceptionistProfileController.js"></script>

<script type="text/javascript">

  getState("#receptionist_profile_state");

  getCityByState('#receptionist_profile_city',0);

</script>

<script type="text/javascript">
     $( "#receptionist_profile_dob" ).datepicker({
       todayHighlight: true,
       autoclose  : true,
       endDate  : '0d',
       Format : 'dd-mm-yy'
  });

  
  

</script>