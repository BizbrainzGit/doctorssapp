<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/patientLayout_Header.php');
?>

<div class="main-panel">
  <div class="content-wrapper PrescriptionList-class" >
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Manage Prescription </h4>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="prescriptiontable" class="table table-hover">
                    
                        </table>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>



<!-- partial -->

<style type="text/css">
  .table-nobordered{
                  
  }

  .table1 th {
    padding: 1.25rem 0.9375rem;
    vertical-align: top;
    border:none;
}              

  .table1 td {
    font-size: 0.813rem;
    padding: 0.625rem;
    color: #707889;
   border:none;
    font-weight: 500;
} 
.table th {
    padding: 5px 5px;
    border-top: 1px solid #f6f2f2;
}
 </style>
            
        <div class="content-wrapper PrescriptionView-class" style="display: none" >
          <div class="row">
              <div class="col-lg-12">
                  <div class="card px-2">
                      <div class="card-body">
                          <div class="row clearfix">
                            <div class="col-md-2">
                              <div id="prescriptionview_accountlogo"></div>
                            </div>

                            <div class="col-md-8"> <h3> <div class="fullwidth text-center">
                              <b class="text-uppercase" id="prescriptionview_accountname"></b>
                              <p id="prescriptionview_accountaddress"></p> 
                              <p id="prescriptionview_mobilenoemail"></p>
                            </div>
                          </h3>
                          </div>

                           <div class="col-md-2">
                             <div id="prescriptionview_doctorssapplogo"></div>
                            </div>
                           
                          </div>
                           <hr>

                           <div class="row clearfix">
                            <div class="col-sm-5 col-12">
                                 <div class="col-sm-6 col-12">
                                  <b><span>S.No : </span> <span id="prescriptionview_prescriptionid"></span></b>   
                                 </div>
                            </div>
                            <div class="col-sm-6 col-12 text-right">
                                  <b><span>Date:</span> <span id="prescriptionview_created_date"></span></b>
                              </div>
                          </div>

                         <div class="row clearfix">
                            <div class="col-sm-5 col-12">
                                <table class="table1">
                                    <tr class="text-center">
                                        <th colspan="2"> Patient Details  </th>
                                      </tr>
                                    <tr class="text-right">
                                      <td class="text-left">Patient Name : </td>
                                      <td class="text-left"><span id="prescriptionview_patient_name"></span></td>
                                    </tr>
                                    <tr class="text-right">
                                      <td class="text-left">Patient Age (Years) : </td>
                                      <td class="text-left"><span id="prescriptionview_patient_age"></span></td>
                                    </tr>
                                    <tr class="text-right">
                                      <td class="text-left">Patient Mobile No. :</td>
                                      <td class="text-left"><span id="prescriptionview_patient_mobileno"></span></td>
                                    </tr>
                                </table>
                              </div>
                           <div class="col-sm-2 col-12"></div>
                            <div class="col-sm-5 col-12">
                                <table class="table1">
                                    <tr class="text-center">
                                        <th colspan="2"> Doctor Details</th>
                                      </tr>
                                    <tr class="text-right">
                                      <td class="text-left">Doctor Name : </td>
                                      <td class="text-left"><span id="prescriptionview_doctor_name"></span></td>
                                    </tr>
                                    <tr class="text-right">
                                      <td class="text-left">Doctor Mobile No. : </td>
                                      <td class="text-left"><span id="prescriptionview_doctor_mobileno"></span></td>
                                    </tr>
                                </table>
                              </div>

                       </div>
                        
                        <div class="row clearfix mt-5">
                          <div class="col-sm-6 col-12">
                                <table class="table table-bordered">
                                  <thead>
                                    <tr class="bg-primary text-white">
                                        <th> Blood Pressure</th>
                                      </tr>
                                    </thead>  
                                    <tr class="text-right">
                                      <td class="text-left"><span id="prescriptionview_patient_bloodpressure"></span></td>
                                    </tr>
                                </table>
                            </div>
                        <!-- </div>
                        <div class="row clearfix mt-5"> -->
                          <div class="col-sm-6 col-12">
                                <table class="table table-bordered">
                                  <thead>
                                    <tr class="bg-primary text-white">
                                        <th> Pulse Rate</th>
                                      </tr>
                                    </thead>  
                                    <tr class="text-right">
                                      <td class="text-left"><span id="prescriptionview_patient_pulserate"></span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                         <div class="row clearfix mt-5">
                          <div class="col-sm-12 col-12">
                                <table class="table table-bordered">
                                  <thead>
                                    <tr class="bg-primary text-white">
                                        <th> Symptoms</th>
                                      </tr>
                                    </thead>  
                                    <tr class="text-right">
                                      <td class="text-left"><span id="prescriptionview_symptoms"></span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row clearfix mt-5">
                          <div class="col-sm-12 col-12">
                                <table class="table table-bordered">
                                  <thead>
                                    <tr class="bg-primary text-white">
                                        <th> Diagnosis</th>
                                      </tr>
                                    </thead>  
                                    <tr class="text-right">
                                      <td class="text-left"><span id="prescriptionview_diagnosis"></span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row clearfix mt-5">
                          <div class="col-sm-12 col-12">
                                <table class="table table-bordered">
                                  <thead>
                                    <tr class="bg-primary text-white">
                                        <th> Note</th>
                                      </tr>
                                    </thead>  
                                    <tr class="text-right">
                                      <td class="text-left"><span id="prescriptionview_note"></span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="row clearfix mt-5">
                          <div class="col-sm-12 col-12">
                                <table class="table table-bordered" id="medical_tests">
                                   <thead>
                                    <tr class="bg-primary text-white">
                                      <th>Meidical Tests</th>
                                    </tr>
                                  </thead>

                                  <tbody>
                                  </tbody>

                                </table>
                            </div>
                        </div>

                        <div class="row clearfix mt-5">
                            <div class="col-sm-12 col-12">
                                <table class="table table-bordered" id="medicineNames">

                                  <thead>
                                    <tr class="bg-primary text-white">
                                      <th>Medicines</th>
                                      <th>Instuctions</th>
                                    </tr>
                                  </thead>

                                  <tbody>
                                  </tbody>



                                    <!-- <tr class="bg-primary  text-white">
                                        <th> Medicine</th>
                                      </tr>
                                    <tr class="text-right">
                                      <td class="text-left"><span id="prescriptionview_medicine"></span></td>
                                    </tr> -->
                                   
                                </table>
                            </div>
                        </div>

                        

             
                  <hr>
                 <div class="row clearfix ">
                 <div class="col-sm-12 col-12 text-center">
                       <b class="text-uppercase">BizBrainz Technologies Private Limited.</b>
                       <p>Visit Our Website www.bizbrainz.in </p>
                  </div>
                </div>

                  <div class="row clearfix " >
                    <div class="col-sm-12 col-12 text-center">
                          <input type="hidden" name="prescriptionview_prescription_id" id="prescriptionview_prescription_id">
                             <button class="btn btn-primary  btn-sm" type="button" id="prescription_pdf" value="pdf"><i class="mdi mdi-file-pdf"></i></button>
                             <button class="btn btn btn-success  btn-sm" type="button" id="prescription_print" value="print" ><i class="mdi mdi-printer mr-1"></i></button>
                          </div>
                        </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>
        <!-- content-wrapper ends -->



<?php
include('Layouts/patientLayout_Footer.php');
?>

<script src="/<?php echo base_url();?>assets/js/Common/PrescriptionController.js"></script>