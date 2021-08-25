<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/receptionistLayout_Header.php');
?>
<div class="main-panel">
<div class="modal fade" id="EditstatusModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Pending For Approval Appointments</h4>
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



  <div class="content-wrapper ReceptionistAppointmentsList-class" >
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Pending For Approval Appointments List </h4>
                  <div class="row grid-margin">
                    <div class="col-12">
                      <div class="header">
                        </div>
                    </div>
                   
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="pendingforapprovaltable" class="table table-hover">
                    
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
include('Layouts/receptionistLayout_Footer.php');
?>

<script src="/<?php echo base_url();?>assets/js/Common/PendingForApprovalAppointments.js"></script>

<script type="text/javascript">

  getBookingStatusForReceptionist("#appointmentbooking_change_status");
  
</script>
