
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/superadminLayout_Header.php');
?>
<div class="main-panel">
  
   <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form id="edit_profiledata"  method="post" enctype="multipart/form-data" >
                       <div>
                       <h3>Basic Details</h3>
                      <section>
                        <h3>Basic Details</h3>

                     <div class="row clearfixed">
                              <input type="hidden" id="edit_profile_id" name="edit_profile_id">
                              <input type="hidden" id="edit_profile_addid" name="edit_profile_addid">
                              <input type="hidden" id="edit_profile_userid" name="edit_profile_userid"> 
                       <div class="col-sm-6 col-12 form-group">
                          <label>First Name</label>
                          <input type="text" class="form-control " placeholder="Person Name" name="edit_profile_fname" id="edit_profile_fname">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Last Name</label>
                          <input type="text" class="form-control " placeholder="Person Name" name="edit_profile_lname" id="edit_profile_lname">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Mobile Number</label>
                          <input type="text" class="form-control" maxlength="10" placeholder="MOBILE NUMBER" name="edit_profile_mobileno" id="edit_profile_mobileno">
                        </div>
                         <div class="col-sm-6 col-12 form-group">
                          <div id="admin_profile_photo"></div>
                         </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Photo</label>
                          <input type="file" class="form-control" placeholder="Photo" name="edit_profile_photo" id="edit_profile_photo">
                        </div>
                        
                         </div>
                      </section>

                      <h3>Address Details</h3>
                      <section>
                        <h3>Address Details</h3>
                          <div class="row clearfixed">

                         <div class="col-sm-6 col-12 form-group">
                        <label>Building No/House No</label>
                          <input type="text" class="form-control" placeholder="Building No/House No" name="edit_profile_hno" id="edit_profile_hno">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Street</label>
                          <input type="text" class="form-control" placeholder="Street Name" name="edit_profile_street" id="edit_profile_street">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Landmark</label>
                          <input type="text" class="form-control" placeholder="Landmark" name="edit_profile_landmark" id="edit_profile_landmark">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Area</label>
                          <input type="text" class="form-control" placeholder="Area" name="edit_profile_area" id="edit_profile_area">
                        </div>
                        
                       <!--  <div class="col-sm-6 col-12 form-group">
                          <label>City</label>
                           <select class="form-control" name="edit_profile_city" id="edit_profile_city">
                          </select>
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>State</label>
                          <select class="form-control" name="edit_profile_state" id="edit_profile_state">
                            
                          </select>
                        </div> -->

                         <div class="col-sm-6 col-12 form-group">
                          <label>State <span class="requried_class">*</span></label>
                          <select class="form-control " name="edit_profile_state" id="edit_profile_state" onchange="getCityByState('#edit_profile_city',this)"></select>
                        </div>
                        
                        <div class="col-sm-6 col-12 form-group">
                          <label>City <span class="requried_class">*</span></label>
                          <select class="form-control " name="edit_profile_city" id="edit_profile_city" ></select>
                         </div>


                        <div class="col-sm-6 col-12 form-group">
                          <label>Pincode</label>
                          <input type="text" class="form-control" maxlength="6" placeholder="PINCODE" name="edit_profile_pincode" id="edit_profile_pincode">
                        </div>

                       <div class="col-sm-12" style="text-align: center;">
                          <div id="profile-editmsg"></div>
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
include('Layouts/superadminLayout_Footer.php');
?>
<script src="/<?php echo base_url();?>assets/js/Common/ProfileController.js"></script>

<script type="text/javascript">
  
  getState("#edit_profile_state");

  getCityByState('#edit_profile_city',0);

</script>