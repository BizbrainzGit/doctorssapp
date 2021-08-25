<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/receptionistLayout_Header.php');
?>

<style type="text/css">
  .fontclass-patientview{
    font-size: 15px; font-weight: bold;
  }
   .patientdata tr:last-child td, .jsgrid .jsgrid-table tr:last-child td {
    border-bottom: 1px solid #f6f2f2;
}
</style>

<div class="main-panel">
<div class="modal fade" id="EditpatientstatusModal">
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
                      <div id="citymapping-editmsg"></div>
                        <form id="patient_status_change_form" method="post" >
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                      <input type="hidden" id="patient_status_id" name="patient_status_id"> 
                                    </div>
                                </div>
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                      <h4 id="activestatusmsg"></h4>
                                        <input type="hidden" id="patient_status_change" name="patient_status_change">
                                    </div>
                                </div>
                            </div>
                        </div>
                   </div>
        <!-- Modal footer -->
        <div class="modal-footer">
      <div class="col-sm-12" style="text-align: center;">
          <button type="button" id="patientupdatestatus" class="btn btn-primary">Yes</button>
          <button type="reset" class="btn btn-outline-secondary">No</button>
      </div>
      </form>
        </div>
      </div>
    </div>
  </div>

<div class="content-wrapper listpatient-class" id="">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Patients List  
                    <div style="float:right">
                      <button type="button" class="btn btn-info btn-sm" id="showaddpatient"><i class="fa fa-plus" aria-hidden="true"></i>Add</button>
                    </div>
                  </h4>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="patienttable" class="table table-hover">
                    
                        </table>
                      </div>
                    </div>
            
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


        <div class="content-wrapper addpatient-class" style="display: none;" >
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Patient Details
                 <a href="/<?php echo base_url();?>Receptionist-Manage-Patients"> <div style="float:right"><button type="button" class="btn btn-info btn-sm"> Back </button></div></a> </h4>

                  <form class="repeater" id="add_patientdata"  method="post" enctype="multipart/form-data" style="display: flex; flex-flow: row wrap; align-items: center;">
                    <div>

                       

                       <h3>Basic Details</h3>
                      <section>
                        <h3>Basic Details</h3>
                      <div class="row clearfixed">

                        <div class="col-sm-6 col-12 form-group">
                          <label>First Name <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" placeholder="Person Name" name="add_patient_fname" id="add_patient_fname">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Last Name <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" placeholder="Person Name" name="add_patient_lname" id="add_patient_lname">
                        </div>

                          <div class="col-sm-6 col-12 form-group">
                          <label>Age <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" placeholder="Age" name="add_patient_age" id="add_patient_age">
                        </div>
                         <div class="col-sm-6 col-12 form-group">
                          <label>Gender <span class="requried_class">*</span></label>
                          <select class="form-control" name="add_patient_gender" id="add_patient_gender">
                             <option value="">Select Gender</option>
                             <option value="Male">Male</option>
                             <option value="Female">Female</option>
                          </select>
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Mobile Number <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" maxlength="10" placeholder="MOBILE NUMBER" name="add_patient_mobileno" id="add_patient_mobileno">
                        </div>
                        
                        <div class="col-sm-6 col-12 form-group">
                          <label>Email <span class="requried_class">*</span></label>
                          <input type="email" class="form-control" placeholder="Emai" name="add_patient_email" id="add_patient_email">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Password <span class="requried_class">*</span></label>
                          <input type="password" class="form-control" placeholder="Password" name="add_patient_password" id="add_patient_password">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Confirmed Password <span class="requried_class">*</span></label>
                          <input type="password" class="form-control" placeholder=" Confirmed Password" name="add_patient_cpassword" id="add_patient_cpassword">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Photo</label>
                          <input type="file" class="form-control" name="add_patient_photo" id="add_patient_photo">
                          <span style="color: red">File must be in the form of Below 1 MB Only...</span>
                        </div>

                      </div>
                      </section>

                      
                      <h3>Medical Information</h3>
                      <section>
                        <h3>Medical Information</h3>
                        <div class="row clearfixed">
                        <div class="col-sm-6 col-12 form-group">
                          <label>Height (CM)<span class="requried_class">*</span></label>
                          <input type="text" class="form-control" placeholder="Height" name="add_patient_height" id="add_patient_height">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Weight (KG)<span class="requried_class">*</span></label>
                          <input type="text" class="form-control" placeholder="Weight" name="add_patient_weight" id="add_patient_weight">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Blood Group <span class="requried_class">*</span></label>
                          <select class="form-control" name="add_patient_bloodgroup" id="add_patient_bloodgroup">
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
                        <div class="col-sm-6 col-12 form-group">
                          <label>Blood Prusser <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" placeholder="Blood Prusser" name="add_patient_bloodprusser" id="add_patient_bloodprusser">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Pulse <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" placeholder="Pulse" name="add_patient_pulse" id="add_patient_pulse">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Past Medical History</label>
                          <textarea class="form-control"  placeholder="Past Medical History" name="add_patient_allergy" id="add_patient_allergy"></textarea>
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Diet</label>
                          <input type="text" class="form-control"  placeholder="Diet" name="add_patient_diet" id="add_patient_diet">
                        </div>

                         <div class="col-sm-12 col-12 form-group">
                           <label>Documnets Uploads  </label>
                            <div data-repeater-list="group-a">
                             <div data-repeater-item class="d-flex mb-2">
                              <div class="mb-2 mr-sm-2 mb-sm-0" style="width: 100%;">
                               <input type="file" class="form-control add_patient_documents" placeholder="Docummnets Uploads" name="add_patient_documents" id="add_patient_documents"  accept="image/png" >
                               <div id="img_err"></div>
                            </div>
                            <button data-repeater-delete type="button" class="btn btn-danger btn-sm icon-btn ml-2" >
                              <i class="mdi mdi-delete"></i>
                            </button>
                          </div>
                        </div>
                        <button data-repeater-create type="button" class="btn btn-info btn-sm icon-btn ml-2 mb-2">
                          <i class="mdi mdi-plus"></i>
                        </button>

                      <br> <span class="requried_class">Pdf, Png, Jpg, Doc Formate and less than 2MB documnets  are upload only</span> 

                        </div>

                      </div>
                      </section>

                      <h3>Address Details</h3>
                      <section>
                        <h3>Address Details</h3>
                      <div class="row clearfixed">
                         <div class="col-sm-6 col-12 form-group">
                        <label>Building No/House No</label>
                          <input type="text" class="form-control" placeholder="Building No/House No" name="add_patient_hno" id="add_patient_hno">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Street <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" placeholder="Street Name" name="add_patient_street" id="add_patient_street">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Landmark</label>
                          <input type="text" class="form-control" placeholder="Landmark" name="add_patient_landmark" id="add_patient_landmark">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Area<span class="requried_class">*</span></label>
                          <input type="text" class="form-control" placeholder="Area" name="add_patient_area" id="add_patient_area">
                        </div>
                        
                        <div class="col-sm-6 col-12 form-group">
                          <label>State <span class="requried_class">*</span></label>
                          <select class="form-control" name="add_patient_state" id="add_patient_state" onchange="getCityByState('#add_patient_city',this);">
                          </select>
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>City <span class="requried_class">*</span></label>
                           <select class="form-control" name="add_patient_city" id="add_patient_city">
                          </select>
                        </div>
                        
                        <div class="col-sm-6 col-12 form-group">
                          <label>Pincode </label>
                          <input type="text" class="form-control" maxlength="6" placeholder="Pincode" name="add_patient_pincode" id="add_patient_pincode">
                        </div>
                      </div>
                      </section>

                       <h3>Final Submit</h3>
                      <section>
                        <h3>Final Submit</h3>
                        <div class="row clearfixed">
                       </div>
                         <div class="form-check">
                          <label class="form-check-label">
                            <input class="checkbox" type="checkbox" name="add_patient_condition" id="add_patient_condition">
                            I Agree With The Terms and Conditions.
                          </label>
                         <div class="col-sm-12 col-12 form-group">
                          <div id="patientdata-addmsg"></div>
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

        <div class="content-wrapper editpatient-class" style="display: none;" >
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit Patient Details <span id="edit_patientname_head"></span>
                 <a href="/<?php echo base_url();?>Receptionist-Manage-Patients"> <div style="float:right"><button type="button" class="btn btn-info btn-sm"> Back </button></div></a> </h4>
                         
                  <form id="edit_patientdata"  method="post" enctype="multipart/form-data" >
                    <div>
                      <h3>Basic Details</h3>
                      <section>
                        <h3>Basic Details</h3>
                      <div class="row clearfixed">
                              <input type="hidden" id="edit_patient_id" name="edit_patient_id">
                              <input type="hidden" id="edit_patient_addid" name="edit_patient_addid">
                              <input type="hidden" id="edit_patient_userid" name="edit_patient_userid"> 

                        <div class="col-sm-6 col-12 form-group">
                          <label>First Name <span class="requried_class">*</span></label>
                          <input type="text" class="form-control text-uppercase" placeholder="Person Name" name="edit_patient_fname" id="edit_patient_fname">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Last Name <span class="requried_class">*</span></label>
                          <input type="text" class="form-control text-uppercase" placeholder="Person Name" name="edit_patient_lname" id="edit_patient_lname">
                        </div>

                       
                          <div class="col-sm-6 col-12 form-group">
                          <label>Age <span class="requried_class">*</span></label>
                          <input type="text" class="form-control text-uppercase" placeholder="Age" name="edit_patient_age" id="edit_patient_age">
                        </div>
                         <div class="col-sm-6 col-12 form-group">
                          <label>Gender <span class="requried_class">*</span></label>
                          <select class="form-control text-uppercase" name="edit_patient_gender" id="edit_patient_gender">
                             <option value="">Select Gender</option>
                             <option value="Male">Male</option>
                             <option value="Female">Female</option>
                          </select>
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Mobile Number <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" maxlength="10" placeholder="MOBILE NUMBER" name="edit_patient_mobileno" id="edit_patient_mobileno">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                         <div id="patientphoto"></div>
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Photo </label>
                          <input type="file" class="form-control" name="edit_patient_photo" id="edit_patient_photo">
                        </div>
                      </div>
                      </section>

                      <h3>Medical Information</h3>
                      <section>
                        <h3>Medical Information</h3>
                        <div class="row clearfixed">
                        <div class="col-sm-6 col-12 form-group">
                          <label>Height (CM) <span class="requried_class">*</span></label>
                          <input type="text" class="form-control text-uppercase" placeholder="Height" name="edit_patient_height" id="edit_patient_height">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Weight (KG) <span class="requried_class">*</span></label>
                          <input type="text" class="form-control text-uppercase" placeholder="Weight" name="edit_patient_weight" id="edit_patient_weight">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Blood Group <span class="requried_class">*</span></label>
                          <select class="form-control text-uppercase" name="edit_patient_bloodgroup" id="edit_patient_bloodgroup">
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
                        <div class="col-sm-6 col-12 form-group">
                          <label>Blood Prusser <span class="requried_class">*</span></label>
                          <input type="text" class="form-control text-uppercase" placeholder="Blood Prusser" name="edit_patient_bloodprusser" id="edit_patient_bloodprusser">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Pulse <span class="requried_class">*</span></label>
                          <input type="text" class="form-control text-uppercase" placeholder="Pulse" name="edit_patient_pulse" id="edit_patient_pulse">
                        </div>
                         <div class="col-sm-6 col-12 form-group">
                          <label>Past Medical History</label>
                          <textarea class="form-control"  placeholder="Past Medical History" name="edit_patient_allergy" id="edit_patient_allergy">
                          </textarea>
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Diet</label>
                          <input type="text" class="form-control text-uppercase"  placeholder="Diet" name="edit_patient_diet" id="edit_patient_diet">
                        </div>
                      </div>
                      </section>

                      <h3>Address Details</h3>
                      <section>
                        <h3>Address Details</h3>
                      <div class="row clearfixed">
                             
                         <div class="col-sm-6 col-12 form-group">
                        <label>Building No/House No</label>
                          <input type="text" class="form-control text-uppercase" placeholder="Building No/House No" name="edit_patient_hno" id="edit_patient_hno">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Street <span class="requried_class">*</span></label>
                          <input type="text" class="form-control text-uppercase" placeholder="Street Name" name="edit_patient_street" id="edit_patient_street">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Landmark</label>
                          <input type="text" class="form-control text-uppercase" placeholder="Landmark" name="edit_patient_landmark" id="edit_patient_landmark">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Area <span class="requried_class">*</span></label>
                          <input type="text" class="form-control text-uppercase" placeholder="Area" name="edit_patient_area" id="edit_patient_area">
                        </div>
                        
                       
                        <div class="col-sm-6 col-12 form-group">
                          <label>State <span class="requried_class">*</span></label>
                          <select class="form-control text-uppercase" name="edit_patient_state" id="edit_patient_state" onchange="getCityByState('#edit_patient_city',this);">
                            
                          </select>
                         </div>

                          <div class="col-sm-6 col-12 form-group">
                          <label>City <span class="requried_class">*</span></label>
                           <select class="form-control text-uppercase" name="edit_patient_city" id="edit_patient_city">
                            
                          </select>
                         </div>
                         
                        <div class="col-sm-6 col-12 form-group">
                          <label>Pincode <span class="requried_class">*</span></label>
                          <input type="text" class="form-control text-uppercase" maxlength="6" placeholder="PINCODE" name="edit_patient_pincode" id="edit_patient_pincode">
                        </div>
                      </div>
                      </section>
                     <h3>Final Submit</h3>
                      <section>
                        <h3> Final Submit </h3>
                         <div class="form-check">
                          <label class="form-check-label">
                            <input class="checkbox" type="checkbox" name="edit_patient_condition" id="edit_patient_condition">
                            I Agree With The Terms and Conditions.
                          </label>
                         <div class="col-sm-12 col-12 form-group">
                          <div id="patientdata-editmsg"></div>
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
      
         
<div class="content-wrapper viewpatient-class" style="display: none">
          <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Patient History   <a href="/<?php echo base_url();?>Receptionist-Manage-Patients"> <div style="float:right"><button type="button" class="btn btn-info btn-sm"> Back </button></div></a> </h4>
                 <!--  <p class="card-description">Use class <code>.accordion-bordered</code> for bordered accordions</p> -->
                  <div class="mt-4">
                    <div class="accordion accordion-bordered" id="accordion-2" role="tablist">

                      <div class="card">
                        <div class="card-header bg-warning m-2 p-2" role="tab" id="heading-4">
                          <h6 class="mb-0">
                            <a data-toggle="collapse" href="#collapse-4" aria-expanded="false" aria-controls="collapse-4">
                              Patient Details 
                            </a>
                          </h6>
                        </div>

                        <div id="collapse-4" class="collapse show m-2" role="tabpanel" aria-labelledby="heading-4" data-parent="#accordion-2">
                          <div class="card-body">

                            <div class="row clearfixed mb-5">
                              <div class="col-sm-6 col-12 text-right">
                                <span id="view_patient_photo"></span>
                              </div>
                              <div class="col-sm-6 col-12">
                                <div class="fontclass-patientview" >
                                   <i class="mdi mdi-account-circle" style="color: blue"></i><span class="ml-2" id="view_patient_username"></span>
                                </div>
                                <div class="fontclass-patientview">
                                 <i class="mdi mdi-account-circle"  style="color: blue" ></i><span class="ml-2" id="view_patient_name"></span>
                                </div>
                                 <div class="fontclass-patientview">
                                 <i class="mdi mdi-email-open"  style="color: blue" ></i><span class="ml-2" id="view_patient_email"></span> 
                                </div>
                                <div class="fontclass-patientview">
                                 <i class="mdi mdi-cellphone-iphone"  style="color: blue" ></i><span class="ml-2" id="view_patient_mobileno"></span> 
                                </div>

                              </div>
                            </div>
                            <!--  <div class="row clearfixed">
                              <div class="col-sm-3 col-12"><b>Patient Name</b></div>
                              <div class="col-sm-3 col-12"><span id="view_patient_name"></span></div>
                              <div class="col-sm-3 col-12"><b>Patient Name</b></div>
                              <div class="col-sm-3 col-12"><span id="view_patient_name"></span></div>
                              <div class="col-sm-3 col-12"><b>Patient Name</b></div>
                              <div class="col-sm-3 col-12"><span id="view_patient_name"></span></div>
                              <div class="col-sm-3 col-12"><b>Patient Name</b></div>
                              <div class="col-sm-3 col-12"><span id="view_patient_name"></span></div>

                            </div> -->

                              <div class="table-responsive">     
                              <table border="1" class="table table-bordered patientdata">
                             
                                  <tr>
                                  <th scope>Patient Gender</th>
                                  <td><span id="view_patient_gender"></span></td>
                                  <th>Patient Age</th>
                                  <td><span id="view_patient_age"></span></td>
                                </tr>
                                 <tr>
                                  <th scope>Patient Blood Group</th>
                                  <td><span id="view_patient_bloodgroup"></span></td>
                                  <th>Patient Address</th>
                                  <td><span id="view_patient_address"></span></td>
                                </tr>

                                  <tr>
                                    <th scope>Patient Height</th>
                                    <td><span id="view_patient_height"></span></td>
                                    <th scope>Patient Weight</th>
                                    <td><span id="view_patient_weight"></span></td>
                                 </tr>

                                 <!-- <tr>
                                    <th>Patient Medical History(if any)</th>
                                    <td><span id="view_patient_name"></span></td>
                                     <th>Patient Reg Date</th>
                                    <td><span id="view_patient_name"></span></td>
                                  </tr> -->

                              </table>
                              </div> 
                           
                          </div>
                        </div>
                      </div>


                      <div class="card">
                        <div class="card-header bg-warning m-2 p-2" role="tab" id="heading-5">
                          <h6 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" href="#collapse-5" aria-expanded="false" aria-controls="collapse-5">
                             Patient  Medical Documents 
                            </a>
                          </h6>
                        </div>
                        <div id="collapse-5" class="collapse m-2" role="tabpanel" aria-labelledby="heading-5" data-parent="#accordion-2">
                          <div class="card-body">
                             <p>If while signing in to your account you see an error message, you can do the following</p>
                              <div class="table-responsive">
                               <table id="patientdocumentsviewtable" class="table table-hover">
                                </table>
                             </div>
                            
                          </div>
                        </div>
                      </div>


<!--                       <div class="card">
                        <div class="card-header bg-warning m-2 p-2" role="tab" id="heading-6">
                          <h6 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" href="#collapse-6" aria-expanded="true" aria-controls="collapse-6">
                              Patient Medical History
                            </a>
                          </h6>
                        </div>
                        <div id="collapse-6" class="collapse m-2" role="tabpanel" aria-labelledby="heading-6" data-parent="#accordion-2">
                          <div class="card-body">
                            <p class="mb-0">If you wish to deactivate your account, you can go to the Settings page of your account. Click on Account Settings and then click on Deactivate.
                            You can join again as and when you wish.</p>
                          </div>
                        </div>
                      </div> -->

                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>


<?php
include('Layouts/receptionistLayout_Footer.php');
?>


<script src="/<?php echo base_url();?>assets/js/Common/PatientController.js"></script>

<script type="text/javascript">
  
   getState("#add_patient_state");
   getState("#edit_patient_state");
   getCityByState('#add_patient_city',0);
   getCityByState('#edit_patient_city',0);

</script>
