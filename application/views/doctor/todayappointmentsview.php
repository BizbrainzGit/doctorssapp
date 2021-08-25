<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/doctorLayout_Header.php');
?>
<div class="main-panel">
<div class="modal fade" id="EditstatusModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Appointment Booking Status</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
                    <div class="body">
                      <div id="appointmentbooking-editmsg"></div>
                        <form id="appointmentbooking_change_status_form" method="post" >
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                      <input type="hidden" id="appointmentbooking_change_status_id" name="appointmentbooking_change_status_id"> 
                                       
                                    </div>
                                </div>
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Appointment Status :</label>
                                       
                                          <select class='form-control' name="appointmentbooking_change_status" id="appointmentbooking_change_status">
                                            <option id="">Select Status</option>
                                          </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
      <div class="col-sm-12" style="text-align: center;">
          <button type="button" id="updatestatus" class="btn btn-primary">Update</button>
          <button type="reset" class="btn btn-outline-secondary">Reset</button>
      </div>
        </div>
      </div>
    </div>
  </div>



  <div class="content-wrapper DoctorTodayAppointmentsList-class" >
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Today Appointments List </h4>
                  <div class="row grid-margin">
                    <div class="col-12">
                      <div class="header">
                        </div>
                    </div>
                   
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="todayappointmentstable" class="table table-hover">
                    
                        </table>
                      </div>
                    </div>
                  </div>


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
                  <h4 class="card-title">Patient History   <a href="/<?php echo base_url();?>Doctor-Today-Appointments"> <div style="float:right"><button type="button" class="btn btn-info btn-sm"> Back </button></div></a> </h4>
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
                             <!-- <p>If while signing in to your account you see an error message, you can do the following</p> -->
                              <div class="table-responsive">
                               <!-- <table id="patientAppointmentsviewtable" class="table table-hover"> -->
                                <table id="patientdocumentsviewtable" class="table table-hover">
                                </table>
                             </div>
                            
                          </div>
                        </div>
                      </div>


                      <div class="card">
                        <div class="card-header bg-warning m-2 p-2" role="tab" id="heading-6">
                          <h6 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" href="#collapse-6" aria-expanded="true" aria-controls="collapse-6">
                              Patient Medical History
                            </a>
                          </h6>
                        </div>
                        <div id="collapse-6" class="collapse m-2" role="tabpanel" aria-labelledby="heading-5" data-parent="#accordion-2">
                          <div class="card-body">
                             <!-- <p>If while signing in to your account you see an error message, you can do the following</p> -->
                              <div class="table-responsive">
                               <table id="patientAppointmentsviewtable" class="table table-hover">
                                </table>
                             </div>
                            
                          </div>
                        </div>
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
                        <h4 class="card-title">Patient Prescription   <a href="/<?php echo base_url();?>Doctor-Today-Appointments"> <div style="float:right"><button type="button" class="btn btn-info btn-sm"> Back </button></div></a> </h4>
                          <div class="row clearfix">
                            <div class="col-md-2"><img src="/<?php echo base_url();?>assets/images/BizBrainz_logo.PNG" style="height:100px;" alt="logo"/> 
                            </div>
                            <div class="col-md-8"> <h3> <div class="fullwidth text-center">
                              <b class="text-uppercase">BizBrainz Multi Speciality Hospitals</b>
                              <p>Flat No.16, Paigah Apartments, S.P Road, Secunderabad, Telangana, 500003.</p>
                              <p> +91 733 77 56789, +91 973 99 89333. Email:
                                 hyd@bizbrainz.in, blr@bizbrainz.in</p>
                              <p>visit our Website www.bizbrainz.in </p>
                            </div></h3>
                          </div>
                           <div class="col-md-2"><img src="/<?php echo base_url();?>assets/images/logo.png" style="height:100px;" alt="logo"/> 
                            </div>
                          </div>
                           <hr>

                           <div class="row clearfix">
                            <div class="col-sm-5 col-12">
                                 <div class="col-sm-6 col-12">
                                  <b><span>S.No : </span> <span id="prescriptionview_prescription_id"></span></b>   
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

               <!--    <div class="row clearfix " >
                    <div class="col-sm-12 col-12 text-center">
                          <input type="hidden" name="prescriptionview_prescription_id" id="prescriptionview_prescription_id">
                             <button class="btn btn-primary  btn-sm" type="button" id="prescription_pdf" value="pdf"><i class="mdi mdi-file-pdf"></i></button>
                             <button class="btn btn btn-success  btn-sm" type="button" id="prescription_print" value="print" ><i class="mdi mdi-printer mr-1"></i></button>
                          </div>
                        </div> -->
                      </div>
                  </div>
              </div>
          </div>
        </div>
        <!-- content-wrapper ends -->


<?php
include('Layouts/doctorLayout_Footer.php');
?>

<script src="/<?php echo base_url();?>assets/js/Common/TodayAppointments.js"></script>
<script type="text/javascript">
  
  getBookingStatusForDoctor("#appointmentbooking_change_status");

</script>

