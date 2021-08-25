<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/adminLayout_Header.php');
?>
<div class="main-panel">
  <div class="content-wrapper" >
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Manage Medical Test </h4>
                   <div class="row grid-margin">
                    <div class="col-12">
                      <div class="header">
                            <h5>
                          <div style="float:right"><button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#AddMedicalTestModal"><i class="fa fa-plus" aria-hidden="true"></i>Add</button></div>
                         </h5>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="medicaltesttable" class="table table-hover">
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      

<div class="modal  fade " id="AddMedicalTestModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content ">  
        <!-- Modal Header -->
        <div class="modal-header col-sm-12">
          <h4 class="modal-title">Add Medical Test</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
         <!-- Modal body -->
           <form id="add_medicaltestdata" method="post" >
              <div class="modal-body ">
                    <div class="row clearfix">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Medical Test Category <span class="requried_class">*</span></label>
                          <select class="form-control" name="add_medicaltest_category" id="add_medicaltest_category">
                        </select>
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Medical Test <span class="requried_class">*</span></label>
                         <input type="text" class="form-control" name="add_medicaltest_medicaltest" id="add_medicaltest_medicaltest">
                        </div>
                      </div>
                     
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Price <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" placeholder="Price" name="add_medicaltest_price" id="add_medicaltest_price">
                       </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Status <span class="requried_class">*</span></label>
                          <select class="form-control" name="add_medicaltest_status" id="add_medicaltest_status">
                            <option value="">-- Select Status --</option>
                            <option value="1">Active</option>
                            <option value="0">In-Active</option>
                        </select>
                        </div>
                      </div>

                      <div class="col-sm-12">
                        <div class="form-group">
                          <label>Description </label>
                          <textarea class="form-control" placeholder="Description" name="add_medicaltest_description" id="add_medicaltest_description"></textarea>
                       </div>
                      </div>

                    </div>
                  <div id="medicaltestdata-addmsg"></div>
                </div>  


                <div class="modal-footer">
                   <div class="col-sm-12" style="text-align: center;">
                     <button  type="button" id="addmedicaltest" class="btn btn-primary">Save</button>
                     <button type="reset" class="btn btn-outline-secondary">Reset</button>
                   </div>
            
               </div>
              </form>
              </div>
            </div>
          </div>
<!-- medicaltest Test add model end -->
      



<div class="modal  fade" id="EditMedicaltestModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Medical Test</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
         <!-- Modal body -->
             <form id="edit_medicaltestdata" method="post" >
        <div class="modal-body">
                   <!--  <div class="body"> -->
                    
                            <div class="row clearfix">
                              <input type="hidden" id="edit_medicaltest_id" name="edit_medicaltest_id">
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                      <label>Medical Test Category <span class="requried_class">*</span></label>
                                      <select class="form-control" name="edit_medicaltest_category" id="edit_medicaltest_category">
                                    </select>
                                    </div>
                                  </div>

                                  <div class="col-sm-6">
                                    <div class="form-group">
                                      <label>Medical Test <span class="requried_class">*</span></label>
                                     <input type="text" class="form-control" name="edit_medicaltest_medicaltest" id="edit_medicaltest_medicaltest">
                                    </div>
                                  </div>
                                 
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                      <label>Price <span class="requried_class">*</span></label>
                                      <input type="text" class="form-control" placeholder="Price" name="edit_medicaltest_price" id="edit_medicaltest_price">
                                   </div>
                                  </div>

                                  <div class="col-sm-6">
                                    <div class="form-group">
                                      <label>Status <span class="requried_class">*</span></label>
                                      <select class="form-control" name="edit_medicaltest_status" id="edit_medicaltest_status">
                                        <option value="">-- Select Status --</option>
                                        <option value="1">Active</option>
                                        <option value="0">In-Active</option>
                                    </select>
                                    </div>
                                  </div>

                                  <div class="col-sm-12">
                                    <div class="form-group">
                                      <label>Description </label>
                                      <textarea class="form-control" placeholder="Description" name="edit_medicaltest_description" id="edit_medicaltest_description"></textarea>
                                   </div>
                                  </div>
                              </div>
                              <div id="medicaltestdata-editmsg"></div>
                            </div>             
                       
                    <div class="modal-footer">
                      <div class="col-sm-12" style="text-align: center;">
                         <button type="button" id="updatemedicaltest" class="btn btn-primary">Update</button>
                        <button type="reset" class="btn btn-outline-secondary">Reset</button>
                      </div>
                   
                    </div>
                      </form>
                  </div>
                </div>
              </div>






<?php
include('Layouts/adminLayout_Footer.php');
?>

<script src="/<?php echo base_url();?>assets/js/Common/MedicalTestController.js"></script>

<script type="text/javascript">
  
getMedicalTestCategory("#add_medicaltest_category");
getMedicalTestCategory("#edit_medicaltest_category");

</script>