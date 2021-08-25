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

                                <div class="col-sm-12" id="appointmentbooking_changed">
                                </div>
                               <div class="col-sm-12" id="appointmentbooking_changed_dropdown" style="display: none">
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Appointment Status :</label>
                                          <select class='form-control' name="appointmentbooking_change_status" id="appointmentbooking_change_status">
                                            <option id="">Select Status</option>
                                          </select>
                                    </div>
                                </div>

                                 <div class="col-sm-12" style="text-align: center;">
                                    <button type="button" id="updatestatus" class="btn btn-primary">Update</button>
                                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                 </div>
                               </div>


                            </div>
                        </form>
                    </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
     
        </div>
      </div>
    </div>
  </div>



  <div class="content-wrapper ReceptionistAppointmentsList-class" >
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Appointment Bookings List </h4>
                  <div class="row grid-margin">
                    <div class="col-12">
                      <div class="header">
                        </div>
                    </div>
                   
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="appointmentbookingtable" class="table table-hover">
                    
                        </table>
                      </div>
                    </div>
                  </div>


                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="content-wrapper PrescriptionWrite-class" style="display: none;" >
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add Prescription
                 <a href="/<?php echo base_url();?>Doctor-Manage-Appointments"> <div style="float:right"><button type="button" class="btn btn-info btn-sm"> Back </button></div></a> </h4>

                  <form class="repeater" id="add_prescriptiondata"   method="post" enctype="multipart/form-data"  style="display: flex; flex-flow: row wrap; align-items: center;">

                      <div class="row clearfixed">
                      
                      <input type="hidden" id="add_prescription_appointment_id" name="add_prescription_appointment_id">
                      <input type="hidden" id="add_prescription_patient_id" name="add_prescription_patient_id">
                      <input type="hidden" id="add_prescription_doctor_id" name="add_prescription_doctor_id">

                       <div class="col-sm-12 col-12 form-group">
                         <h5 style="color: #1A73E8;">Patient Name : <span id="add_prescription_patientname"></span> </h5>
                       </div>

                       <div class="col-sm-6 col-12 form-group">
                          <label>Blood Pressure : </label>
                          <input type="text" class="form-control" placeholder="Blood Pressure" name="add_prescription_bloodpressure" id="add_prescription_bloodpressure"  >
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Pulse Rate : </label>
                          <input type="text" class="form-control" placeholder="Pulse Rate" name="add_prescription_pulserate" id="add_prescription_pulserate"  >
                        </div>
                        
                        <div class="col-sm-6 col-12 form-group">
                          <label>Symptoms : <span class="requried_class">*</span> </label>
                          <textarea class="form-control " placeholder="Symptoms" name="add_prescription_symptoms" id="add_prescription_symptoms" rows="4" cols="50"></textarea>
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                           <label>Diagnosis :</label>
                           <textarea class="form-control " placeholder="Diagnosis" name="add_prescription_diagnosis" id="add_prescription_diagnosis" rows="4" cols="50"></textarea>
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                        <label>Note :</label>
                        <textarea class="form-control " placeholder="Note" name="add_prescription_note" id="add_prescription_note" rows="4" cols="50"></textarea>
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                           <label>Medical Tests <span class="requried_class">*</span></label>
                          <select style="width: 100%" class="form-control js-example-basic-multiple w-100" multiple="multiple" name="add_prescription_test[]" id="add_prescription_test" placeholder="Medical Tests">
                        </select>
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Prescription Photo <span class="requried_class">*</span></label>
                          <input type="file" class="form-control" name="add_prescription_photo" id="add_prescription_photo">
                          <span style="color: red">File must be in the form of Below 1 MB Only...</span>
                        </div>
                          
                        <div class="col-sm-12 col-12 form-group">
                        <label>Medicine : <span class="requried_class">*</span> </label> 
                         <div data-repeater-list="group-a">
                          <div data-repeater-item class="d-flex mb-2">
                            <div class="mb-2 mr-sm-2 mb-sm-0" style="width: 100%;">
                              <input type="text" class="form-control form-control-sm" id="add_prescription_medicine" name="add_prescription_medicine" placeholder="Add Medicine">
                            </div>
                            <div class="mb-2 mr-sm-2 mb-sm-0" style="width: 100%;">
                              <input type="text" class="form-control form-control-sm" id="add_prescription_medicinenote" name="add_prescription_medicinenote" placeholder="Note">
                            </div>
                            <button data-repeater-delete type="button" class="btn btn-danger btn-sm icon-btn ml-2" >
                              <i class="mdi mdi-delete"></i>
                            </button>
                          </div>
                        </div>
                        <button data-repeater-create type="button" class="btn btn-info btn-sm icon-btn ml-2 mb-2">
                          <i class="mdi mdi-plus"></i>
                        </button>
                      </div>

                        <div class="col-sm-12" style="text-align: center;">
                          <div id="prescriptiondata-addmsg"></div>
                          <button type="button" id="addprescription" class="btn btn-primary">Save</button>
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
include('Layouts/doctorLayout_Footer.php');
?>

<script src="/<?php echo base_url();?>assets/js/Common/AppointmentbookingController.js"></script>

<script type="text/javascript">
  
  getMedicalTest("#add_prescription_test",0);
   getBookingStatusForDoctor("#appointmentbooking_change_status");

</script>
