<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/superadminLayout_Header.php');
?>

<div class="main-panel">
  <div class="content-wrapper" >
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Patient Details </h4>
                  <div class="row grid-margin">
                    <div class="col-12">
                    	<div class="header"></div>
                    </div>
                    <div class="col-12">
                      <div class="row clearfix">
                         <div class="col-2"></div>
                     <div class="col-8">
                  <form id="search_patient" method="post" >
                      <div class="row clearfix" >
                                  <div class="col-sm-6 col-12">
                                   <div class="form-group">
                                      <label>Patient Name :</label>          
                                         <div id="datepicker-popup" class="input-group date datepicker">
                                         <input type="text" class="form-control" placeholder="Patient Name" name="search_patient_name" id="search_patient_name">
                                         </div> 
                                   </div>
                                </div>

                                 <div class="col-sm-6 col-12">
                                   <div class="form-group">
                                      <label> Mobile No :</label>          
                                         <div id="datepicker-popup" class="input-group date datepicker">
                                         <input type="text" class="form-control" placeholder="Mobile No" name="search_mobile_no" id="search_mobile_no">
                                         </div> 
                                   </div>
                                </div>
                                <div class="col-sm-12" style="text-align: center;">
                                  <button  type="button" id="searchpatient" class="btn btn-primary">Search</button>
                                  <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                </div> 
                            </div> 

                   </form>
                       </div>
                          <div class="col-2"></div>
                        
                      </div>
                      

                    </div>
                     
                  </div>
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

         
       

<?php
include('Layouts/superadminLayout_Footer.php');
?>
<script src="/<?php echo base_url();?>assets/js/patient/ManagePatientController.js"></script>