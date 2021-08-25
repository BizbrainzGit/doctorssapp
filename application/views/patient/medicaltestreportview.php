<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/patientLayout_Header.php');
?>


<div class="main-panel">
  <div class="content-wrapper">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Medical Test Reports List</h4>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="medicaltestreportstable" class="table table-hover">
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
include('Layouts/patientLayout_Footer.php');
?>

<script src="/<?php echo base_url();?>assets/js/Common/MedicalTestReportsController.js" type="text/javascript"></script>
