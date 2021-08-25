<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/adminLayout_Header.php');
?>
  <div class="main-panel">

    <div class="content-wrapper listbusiness-class" id="">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="row grid-margin">
                    <div class="col-12">
                      <div class="header"></div>
                    </div>
                      <div class="col-sm-2 col-12"></div>
                          <div class="col-sm-8 col-12">
                            <form id="search_appointmentslist" method="post" >
                              <div class="row clearfix" >
                               <div class="col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Specialization :</label>
                                       <select style="width: 100%" class="form-control" name="search_appointmentslist_specialization" id="search_appointmentslist_specialization" onchange="getDoctorDepartment(this);">
                                        </select>
                                    </div>
                                </div>
                               <div class="col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Doctor :</label>
                                       <select  class="form-control" name="search_appointmentslist_doctor" id="search_appointmentslist_doctor">
                                       </select>
                                    </div>
                                </div>
                                  <div class="col-sm-6 col-12">
                                   <div class="form-group">
                                      <label>Appointment Date :</label>          
                                         <div id="datepicker-popup" class="input-group date datepicker">
                                         <input type="text" class="form-control" placeholder="Date" name="search_appointmentslist_date" id="search_appointmentslist_date">
                                         </div> 
                                   </div>
                                 </div>
                                  <div class="col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Shift :</label>
                                       <select  class="form-control" name="search_appointmentslist_shift" id="search_appointmentslist_shift">
                                       </select>
                                    </div>
                                </div>

                            
                                <div class="col-sm-12" style="text-align: center;">
                                  <button  type="button" id="searchappointmentslist" class="btn btn-primary">Search</button>
                                  <button type="reset" class="btn btn-secondary">Reset</button>
                                  <div id="doctorappointmentslist_msg"></div>
                                </div> 
                            </div>
                      </form>
                    </div>
                   <div class="col-sm-2 col-12"></div>
                  </div>
                   <div class="row clearfix " style="float: right;" >
                    <div class="col-sm-12 col-12 text-center">
                      <div id="doctorappointments_msg"></div>
                          <input type="hidden" name="doctorappointmentsview_appointments_id" id="doctorappointmentsview_appointments_id">
                             <button class="btn btn-primary  btn-sm" type="button" id="doctorappointments_pdf" value="pdf"><i class="mdi mdi-file-pdf"></i></button>
                             <button class="btn btn btn-success  btn-sm" type="button" id="doctorappointments_print" value="print" ><i class="mdi mdi-printer mr-1"></i></button>
                          </div>
                        </div>
                </div>
              </div>
            </div>
          </div>
        </div>

    <div class="content-wrapper">
      <div class="row">
           <div class="row clearfix" id="doctorsappointmentslist"></div>
      </div>
    </div>  



<?php
include('Layouts/adminLayout_Footer.php');
?>

<script type="text/javascript">
  
  getSpecialization("#search_appointmentslist_specialization");

  
</script>   
<script type="text/javascript">
  
  $('#search_appointmentslist_date').datepicker({
      todayHighlight: true,
      autoclose: true,
      format: 'dd-mm-yyyy'
});


</script>