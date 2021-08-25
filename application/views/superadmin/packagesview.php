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
                  <h4 class="card-title">Manage Packages
                    <div style="float:right"><button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#AddpackageModal"><i class="fa fa-plus" aria-hidden="true"></i>Add</button>
                    </div>
                  </h4>
                  <div class="row grid-margin">
                    <div class="col-12">
                    	<div class="header"></div>
                    </div>
                    <div class="col-12"></div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="packagestable" class="table table-hover">
                    
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>



  <!-- The Modal -->
  <div class="modal fade" id="EditpackageModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title" id="edit_packagename_head"></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

              <form id="edit_package" method="post" >
                   <div class="modal-body">
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="hidden" id="edit_package_id" name="edit_package_id">
                                        <label>Package Name :</label>
                                        <input type="text" class="form-control" placeholder="Package Name" name="edit_package_name" id="edit_package_name">
                                    </div>
                                </div>
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Amount :</label>
                                        <input type="text" class="form-control" placeholder="Package Amount" name="edit_package_amount" id="edit_package_amount">
                                    </div>
                                </div>
                               <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Duration :</label>
                                         <input type="text" class="form-control" placeholder="Package Duration" name="edit_package_duration" id="edit_package_duration">
                                    </div>
                                </div>
                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Status:</label>
                                        <select class="form-control" name="edit_package_status" id="edit_package_status">
                                           <option value=" ">Select Package Status</option>
                                           <option value="1">Active</option>
                                           <option value="2">In-Active</option>
                                       </select>
                                    </div>
                                </div>
                            </div>
                         </div>
                     </div>
                     <div id="package-editmsg"></div>
                       <div class="modal-footer">
                            <div class="col-sm-12" style="text-align: center;">
                                    <button type="button" id="updatepackage" class="btn btn-primary">Update</button>
                                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                               
                            </div>
                       </div>
          </form>
        
      </div>
    </div>
  </div>


<!-- duration add model start-->


<div class="modal  fade" id="AddpackageModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Package details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
                    <div class="body">
                        <form id="add_package" method="post" >
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Package Name <span class="requried_class">*</span>:</label>
                                        <input type="text" class="form-control" placeholder="Package Name" name="add_package_name" id="add_package_name">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Amount <span class="requried_class">*</span>:</label>
                                        <input type="text" class="form-control" placeholder="Package Amount" name="add_package_amount" id="add_package_amount">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Duration <span class="requried_class">*</span>:</label>
                                         <input type="text" class="form-control" placeholder="Package Duration" name="add_package_duration" id="add_package_duration">
                                    </div>
                                </div>
                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Status <span class="requried_class">*</span>:</label>
                                        <select class="form-control" name="add_package_status" id="add_package_status">
                                           <option value=" ">Select Package Status</option>
                                           <option value="1">Active</option>
                                           <option value="2">In-Active</option>
                                       </select>
                                    </div>
                                </div>

                            </div>
                      </div>
                 </div>
        <div id="package-addmsg"></div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <div class="col-sm-12" style="text-align: center;">
                <button  type="button" id="addpackage" class="btn btn-primary">Save</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
                
          </div>
          </form>
      </div>
      </div>
    </div>
  </div>
<!-- duration add model end -->
       
  
<?php
include('Layouts/superadminLayout_Footer.php');
?>

    <script src="/<?php echo base_url();?>assets/js/superadmin/PackagesController.js"></script>
   

