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
            <h4 class="card-title">Manage Medical Test Category's </h4>
            <div class="row grid-margin">
              <div class="col-12">
                <div class="header">
                  <h5><div style="float:right"><button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#AddMedicalTestCategoryModal"><i class="fa fa-plus" aria-hidden="true"></i>Add</button></div></h5>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="table-responsive">
                  <table id="medicaltestcategorytable" class="table table-hover"></table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

            



  <div class="modal  fade " id="AddMedicalTestCategoryModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content "> 
        <div class="modal-header col-sm-12">
          <h4 class="modal-title">Add Medical Test Category </h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body ">
          <div class="body">
            <form id="add_medicaltestcategorydata" method="post" >
              <div class="row clearfix">
                <div class="col-sm-12 form-group">
                    <label>Medical Test Category <span class="requried_class">*</span></label>
                    <input type="text" class="form-control" placeholder="Medical Test Category" name="add_medicaltestcategory_name" id="add_medicaltestcategory_name">
                </div>
              </div>
            <div id="medicaltestcategory-addmsg"></div>
          </div> 
        <div class="modal-footer">
          <div class="col-sm-12" style="text-align: center;">
             <button  type="button" id="addmedicaltestcategory" class="btn btn-primary">Save</button>
             <button type="reset" class="btn btn-outline-secondary">Reset</button>
          </div>
        </form>
      </div>
      </div>
    </div>
  </div>
  </div>

  <div class="modal  fade" id="EditMedicalTestCategoryModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content"> 
        <div class="modal-header">
          <h4 class="modal-title">Edit Medical Test Category</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
          <form id="edit_medicaltestcategorydata" method="post" >
        <div class="modal-body">
              <div class="body">
                <div class="row clearfix">
                  <input type="hidden" id="edit_medicaltestcategory_id" name="edit_medicaltestcategory_id">
                     <div class="col-sm-12">
                        <div class="form-group">
                          <label>Medical Test Category <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" placeholder="Medical Test Category" name="edit_medicaltestcategory_name" id="edit_medicaltestcategory_name">
                        </div>
                      </div>                                
                    </div>
                   <div id="medicaltestcategorydata-editmsg"></div>
                </div>             
                       
        <div class="modal-footer">
          <div class="col-sm-12" style="text-align: center;">
             <button type="button" id="updatemedicaltestcategory" class="btn btn-primary">Update</button>
            <button type="reset" class="btn btn-outline-secondary">Reset</button>
          </div>
      </div>
      </div>
      </form>
      </div>
    </div>
  </div>



<?php
include('Layouts/adminLayout_Footer.php');
?>

<script src="/<?php echo base_url();?>assets/js/Common/MedicalTestCategoryController.js"></script>

