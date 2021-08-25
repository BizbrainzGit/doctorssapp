<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/receptionistLayout_Header.php');
?>

  <div class="main-panel">

<div class="content-wrapper listinpatient-class" id="">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">InPatients List  <div style="float:right"><button type="button" class="btn btn-info btn-sm" id="showaddinpatient"><i class="fa fa-plus" aria-hidden="true"></i>Add</button></div></h4>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="inpatienttable" class="table table-hover">
                    
                        </table>
                      </div>
                    </div>
            
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>




        <div class="content-wrapper addinpatient-class" style="display: none;"  >

          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h3 class="card-title">In Patient Details
                  <a href="/<?php echo base_url();?>Receptionist-In-Patients"> <div style="float:right"><button type="button" class="btn btn-info btn-sm"> Back </button></div></a> </h3>

                  <form id="add_inpatientdata"  method="post" enctype="multipart/form-data" >
                        <h4>Basic Details</h4>
                      <div class="row clearfixed">

                        <div class="col-sm-6 col-12 form-group">
                          <label>Patient Name <span class="requried_class">*</span></label>
                           <select class='form-control' name="add_inpatient_patientid" id="add_inpatient_patientid">
                          </select>
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Joining Date <span class="requried_class">*</span></label>
                          <input type="date" class="form-control"  placeholder="Joining Date" name="add_inpatient_joiningdate" id="add_inpatient_joiningdate">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Ward <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" placeholder="Ward" name="add_inpatient_ward" id="add_inpatient_ward">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Bed No <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" placeholder="Bed No" name="add_inpatient_bedno" id="add_inpatient_bedno">
                        </div>

                        <div class="col-sm-12" style="text-align: center;">
                          <div id="inpatientdata-addmsg"></div>
                          <button  type="button" id="addinpatient" class="btn btn-primary">Save</button>
                          <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                      </div>
                   
                  </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
         

        <div class="content-wrapper editinpatient-class" style="display: none;" >
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit InPatient Details<span id="edit_inpatientname_head"></span>
                 <a href="/<?php echo base_url();?>Receptionist-In-Patients"> <div style="float:right"><button type="button" class="btn btn-info btn-sm"> Back </button></div></a> </h4>
                         
                  <form id="edit_inpatientdata"  method="post" enctype="multipart/form-data" >
                      <div class="row clearfixed">
                              <input type="hidden" id="edit_inpatient_id" name="edit_inpatient_id">
                               
                        <div class="col-sm-6 col-12 form-group">
                          <label>Patient Name <span class="requried_class">*</span></label>
                           <select class='form-control' name="edit_inpatient_patientid" id="edit_inpatient_patientid">
                          </select>
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Joining Date <span class="requried_class">*</span></label>
                          <input type="date" class="form-control"  placeholder="Joining Date" name="edit_inpatient_joiningdate" id="edit_inpatient_joiningdate">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Ward <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" placeholder="Ward" name="edit_inpatient_ward" id="edit_inpatient_ward">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Bed No <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" placeholder="Bed No" name="edit_inpatient_bedno" id="edit_inpatient_bedno">
                        </div>

                        <div class="col-sm-12" style="text-align: center;">
                          <div id="inpatientdata-editmsg"></div>
                          <button  type="button" id="updateinpatient" class="btn btn-primary">Update</button>
                          <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                      
                      </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
         
        </div>
      
      
         
<?php
include('Layouts/receptionistLayout_Footer.php');
?>

<script src="/<?php echo base_url();?>assets/js/Common/InPatientController.js"></script>

<script type="text/javascript">
  
  getPatient("#add_inpatient_patientid");
  getPatient("#edit_inpatient_patientid");

</script>
