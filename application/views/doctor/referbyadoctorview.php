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
                  <h4 class="card-title">Refered By A Me List</h4>
                  <!-- <div class="row grid-margin">
                    <div class="col-12">
                      <div class="header">
                        <h5>
                          <div style="float:right"><button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#AddReferADoctorModal"><i class="fa fa-plus" aria-hidden="true"></i>Add</button>
                          </div>
                        </h5>
                      </div>
                    </div>
               
                  </div> -->
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="referbyadoctortable" class="table table-hover">
                    
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
include('Layouts/doctorLayout_Footer.php');
?>
<script src="/<?php echo base_url();?>assets/js/doctor/ReferADoctorController.js"></script>

