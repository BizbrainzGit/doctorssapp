<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/doctorLayout_Header.php');
?>
<div class="main-panel">
  <div class="content-wrapper" >
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Refere A Doctors List</h4>
                  <div class="row grid-margin">
                    <div class="col-12">
                      <div class="header">
                        <h5>
                          <div style="float:right"><button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#AddReferADoctorModal"><i class="fa fa-plus" aria-hidden="true"></i>Add</button>
                          </div>
                        </h5>
                      </div>
                    </div>
               
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="referadoctortable" class="table table-hover">
                    
                        </table>
                      </div>
                    </div>
                  </div>


                </div>
              </div>
            </div>
          </div>
        </div>



<div class="modal  fade " id="AddReferADoctorModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content ">  
        
        <div class="modal-header col-sm-12">
          <h4 class="modal-title">Refer A Doctor </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
         
        <div class="modal-body ">
                    <div class="body">
                        <form id="add_referadoctordata" method="post" >
                                <div class="row clearfix">
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                      <label>Patient Name <span class="requried_class">*</span></label>
                                      <select  class="form-control" name="add_referadoctor_patientname" id="add_referadoctor_patientname"></select>
                                    </div> 
                                  </div>
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                      <label>Refered By Doctor Id <span class="requried_class">*</span></label>
                                      <input type="text" class="form-control" placeholder="Doctor Id" name="add_referadoctor_doctorid" id="add_referadoctor_doctorid">
                                    </div> 
                                  </div>
                            </div>             
                       

        <div class="modal-footer">
          <div class="col-sm-12" style="text-align: center;">
             <button  type="button" id="addreferadoctor" class="btn btn-primary">Save</button>
             <button type="reset" class="btn btn-outline-secondary">Reset</button>
          </div>
        </form>
      </div>
      <div id="referadoctordata-addmsg"></div>
      </div>
    </div>
  </div>
 </div>
   </div>
   


<?php
include('Layouts/doctorLayout_Footer.php');
?>
<script src="/<?php echo base_url();?>assets/js/doctor/ReferADoctorController.js"></script>

<script type="text/javascript">

  getPatient("#add_referadoctor_patientname");
  
</script>
