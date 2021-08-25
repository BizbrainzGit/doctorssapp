<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/laboratoryLayout_Header.php');
?>


<div class="main-panel">

	<div class="content-wrapper listtesttemplates-class">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Test Tempates List  <div style="float:right"><button type="button" class="btn btn-info btn-sm" id="AddtesttemplateId"><i class="fa fa-plus" aria-hidden="true"></i>Add</button></div></h4>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="testtemplatetable" class="table table-hover">
                        </table>
                      </div>
                    </div>
            
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="content-wrapper addtesttemplates-class" style="display: none;">
          <div class="row grid-margin">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">New Test Report Templates  <a href="/<?php echo base_url();?>Laboratory-NewTestTemplate"> <div style="float:right"><button type="button" class="btn btn-info btn-sm"> Back </button></div></a> </h4>
                   <form id="add_testtemplate"  method="post" enctype="multipart/form-data" >
                      <div class="row clearfixed">
                        <div class="col-sm-6 col-12 form-group">
                          <label>Select Category Test <span class="requried_class">*</span></label>
                          <select class="form-control" name="add_testtemplate_categoryname" id="add_testtemplate_categoryname" onchange="getMedicalTest('#add_testtemplate_testname',this)">
                          </select>
                        </div>
                         <div class="col-sm-6 col-12 form-group">
                          <label>Select Test <span class="requried_class">*</span></label>
                          <select class="form-control" name="add_testtemplate_testname" id="add_testtemplate_testname">
                          </select>
                        </div>
                         <div class="col-sm-6 col-12 form-group">
                          <label>Status <span class="requried_class">*</span></label>
                          <select class="form-control" name="add_testtemplate_status" id="add_testtemplate_status">
                             <option value="">Select Status</option>
                             <option value="1">Active</option>
                             <option value="0">In Active</option>
                          </select>
                        </div>

                        <div class="col-sm-12 col-12 form-group">
                          <label>Test Report Template <span class="requried_class">*</span></label>
                        <!--   <input type="text" class="form-control " placeholder="Person Name" name="add_employees_fname" id="add_employees_fname"> -->
                           <!-- <div id="summernoteExample">
                           </div> -->
                            <textarea class="form-control" name="add_testtemplate_report"
                             id="add_testtemplate_report">
                            </textarea>

                        </div>


                        <div class="col-sm-12" style="text-align: center;">
                        	<div id="testtemplate-addmsg"></div>
				            <button type="button" id="addtesttemplate" class="btn btn-primary">Save</button>
				            <button type="reset" class="btn btn-secondary">Cancel</button>
                        </div>
                      </div>
                   </form>

                </div>

              </div>
            </div>
          </div>
        
        </div>

    
     <div class="content-wrapper edittesttemplates-class" style="display: none;">
          <div class="row grid-margin">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit Test Report Templates  <a href="/<?php echo base_url();?>Laboratory-NewTestTemplate"> <div style="float:right"><button type="button" class="btn btn-info btn-sm"> Back </button></div></a> </h4>
                   <form id="edit_testtemplate"  method="post" enctype="multipart/form-data" >

                   	<input type="hidden" name="edit_testtemplate_id" id="edit_testtemplate_id" >

                      <div  class="row clearfixed">
                        <div class="col-sm-6 col-12 form-group">
                          <label>Select Category Test <span class="requried_class">*</span></label>
                          <select class="form-control" name="edit_testtemplate_categoryname" id="edit_testtemplate_categoryname" onchange="getMedicalTest('#add_testtemplate_testname',this)">
                          </select>
                        </div>
                         <div class="col-sm-6 col-12 form-group">
                          <label>Select Test <span class="requried_class">*</span></label>
                          <select class="form-control" name="edit_testtemplate_testname" id="edit_testtemplate_testname">
                          </select>
                        </div>
                         <div class="col-sm-6 col-12 form-group">
                          <label>Status <span class="requried_class">*</span></label>
                          <select class="form-control" name="edit_testtemplate_status" id="edit_testtemplate_status">
                             <option value="">Select Status</option>
                             <option value="1">Active</option>
                             <option value="0">In Active</option>
                          </select>
                        </div>

                        <div class="col-sm-12 col-12 form-group">
                          <label>Test Report Template <span class="requried_class">*</span></label>
                        <!--   <input type="text" class="form-control " placeholder="Person Name" name="add_employees_fname" id="add_employees_fname"> -->
                           <!-- <div id="summernoteExample">
                           </div> --> 

                             <textarea class="form-control" name="edit_testtemplate_report"
                             id="edit_testtemplate_report">
                            </textarea>

                        </div>

                        <div class="col-sm-12" style="text-align: center;">
                        	<div id="testtemplate-editmsg"></div>
				            <button type="button" id="edittesttemplate" class="btn btn-primary">Save</button>
				            <button type="reset" class="btn btn-secondary">Cancel</button>
                        </div>

                      </div>
                   </form>
                </div>
                
              </div>
            </div>
          </div>
        
        </div>
   



    <div class="content-wrapper viewtesttemplates-class" style="display: none;">
          <div class="row grid-margin">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Test Report Templates  View<a href="/<?php echo base_url();?>Laboratory-NewTestTemplate"> <div style="float:right"><button type="button" class="btn btn-info btn-sm"> Back </button></div></a> </h4>
                  
                    <div class="row clearfixed">

                      <div id="view_testtemplate_report"></div>
                    </div>

                </div>
              </div>
            </div>
          </div>
        
        </div>



<?php
include('Layouts/laboratoryLayout_Footer.php');
?>


<script src="/<?php echo base_url();?>assets/js/laboratory/TestTemplateController.js" type="text/javascript"></script>


<script type="text/javascript">
  
getMedicalTestCategory("#add_testtemplate_categoryname");
getMedicalTestCategory("#edit_testtemplate_categoryname");

// getMedicalTest("#add_testtemplate_testname");
getMedicalTest("#edit_testtemplate_testname",0);

</script>

 <script type="text/javascript">    
            
          

  if ($("#add_testtemplate_report").length) {
    $('#add_testtemplate_report').summernote({
      height: 300,
      spellCheck: true,
      tabsize: 2

    });
  }

if ($("#edit_testtemplate_report").length) {
    $('#edit_testtemplate_report').summernote({
      height: 300,
      tabsize: 2
    });
  }
  
                                       
</script>
