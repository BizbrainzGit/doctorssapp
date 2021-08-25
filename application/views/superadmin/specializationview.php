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
                  <h4 class="card-title">Manage Specialization </h4>
                  <div class="row grid-margin">
                    <div class="col-12">
                      <div class="header">
                        <h5>
                          <div style="float:right"><button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#AddspecializationModal"><i class="fa fa-plus" aria-hidden="true"></i>Add</button>
                          </div>
                         </h5>
                        </div>
                    </div>
               
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="specializationtable" class="table table-hover">
                    
                        </table>
                      </div>
                    </div>
                  </div>


                </div>
              </div>
            </div>
          </div>
        </div>

           






<div class="modal  fade " id="AddspecializationModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content ">  
        
        <div class="modal-header col-sm-12">
          <h4 class="modal-title">Add Specialization</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
         
        <div class="modal-body ">
                    <div class="body">
                        <form id="add_specializationdata" method="post" >
                                <div class="row clearfix">
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                      <label>Specialization <span class="requried_class">*</span></label>
                                      <input type="text" class="form-control" placeholder="Specialization" name="add_specialization_name" id="add_specialization_name">
                                    </div> 
                                  </div>
                                   <div class="col-sm-12">
                                    <div class="form-group">
                                      <label>Specialization Image <span class="requried_class">*</span></label>
                                      <input type="file" class="form-control" placeholder="Specialization" name="add_specialization_img" id="add_specialization_img">
                                    </div> 
                                  </div>
                            </div>             

        <div class="modal-footer">
          <div class="col-sm-12" style="text-align: center;">
                 <div id="specializationdata-addmsg"></div>
             <button  type="button" id="addspecialization" class="btn btn-primary">Save</button>
             <button type="reset" class="btn btn-outline-secondary">Reset</button>
          </div>
        </form>
      </div>
      </div>
    </div>
  </div>
 </div>
   </div>
   
<!-- Specialization add model end -->
      


<div class="modal  fade" id="EditspecializationModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">  
        <div class="modal-header">
          <h4 class="modal-title">Edit Specialization</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
          <form id="edit_specializationdata" method="post" >
            <div class="modal-body">
                    <div class="body">
                            <div class="row clearfix">
                                <input type="hidden" id="edit_specialization_id" name="edit_specialization_id">
                               <div class="col-sm-12">
                                  <div class="form-group">
                                    <label>Specialization <span class="requried_class">*</span></label>
                                    <input type="text" class="form-control" placeholder="Specialization" name="edit_specialization_name" id="edit_specialization_name">
                                  </div> 
                                </div>

                                 <div class="col-sm-12">
                                    <div class="form-group">
                                      <label>Specialization Image <span class="requried_class">*</span></label>
                                      <input type="file" class="form-control" placeholder="Specialization" name="edit_specialization_img" id="edit_specialization_img">
                                    </div> 
                                  </div>
                                   <div class="col-sm-12">
                                    <div id="specialization_img_view"></div>
                                   </div>

                              </div>
                            </div>             
                  
        <div class="modal-footer">
          <div class="col-sm-12" style="text-align: center;">
             <div id="specializationdata-editmsg"></div>
             <button type="button" id="updatespecialization" class="btn btn-primary">Update</button>
            <button type="reset" class="btn btn-outline-secondary">Reset</button>
          </div>
       
      </div>
      </div>
       </form>
    </div>
   </div>
  </div>



<?php
include('Layouts/superadminLayout_Footer.php');
?>
 <script src="/<?php echo base_url();?>assets/js/superadmin/SpecializationController.js"></script>