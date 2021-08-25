<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/laboratoryLayout_Header.php');
?>


<div class="main-panel">
        <div class="content-wrapper">
          <div class="row grid-margin">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">New Medical Test Report </h4>

                   <form id="add_medicaltestreport"  method="post" enctype="multipart/form-data" >
                      <div class="row clearfixed">
                       
                        <div class="col-sm-6 col-12 form-group">
                          <label>Patient With Bill Number <span class="requried_class">*</span></label>
                          <select class="form-control" name="add_medicaltestreport_billingid" id="add_medicaltestreport_billingid" onchange="getMedicalTestByBillingId('#add_medicaltestreport_testid',this)">
                          </select>
                        </div>

                         <div class="col-sm-6 col-12 form-group">
                          <label>Select Test <span class="requried_class">*</span></label>
                          <select class="form-control" name="add_medicaltestreport_testid" id="add_medicaltestreport_testid" onchange="getTestTemplateByTestId('#add_medicaltestreport_tempate',this)">
                          </select>
                        </div>

                        <div class="col-sm-12 col-12 form-group">
                          <label>Test Report Template <span class="requried_class">*</span></label>
                        <!--   <input type="text" class="form-control " placeholder="Person Name" name="add_employees_fname" id="add_employees_fname"> -->
                           <!-- <div id="summernoteExample">
                           </div> -->
                            <textarea class="form-control" name="add_medicaltestreport_tempate"
                             id="add_medicaltestreport_tempate">
                            </textarea>

                        </div>


                        <div class="col-sm-12" style="text-align: center;">
                        	<div id="medicaltestreport-addmsg"></div>
				            <button type="button" id="addmedicaltestreport" class="btn btn-primary">Save</button>
				            <button type="reset" class="btn btn-secondary">Cancel</button>
                        </div>
                      </div>
                   </form>

                </div>

              </div>
            </div>
          </div>
        
        </div>

    
   

<?php
include('Layouts/laboratoryLayout_Footer.php');
?>



<script src="/<?php echo base_url();?>assets/js/Common/MedicalTestReportsController.js" type="text/javascript"></script>


<script type="text/javascript">
   GetBillingPatientsList("#add_medicaltestreport_billingid");
   if ($("#add_medicaltestreport_tempate").length) {
    $('#add_medicaltestreport_tempate').summernote({
      height: 300,
      tabsize: 2
    });
  }
</script>
