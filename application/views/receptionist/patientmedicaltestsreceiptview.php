<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/receptionistLayout_Header.php');
?>
<div class="main-panel">
  <div class="content-wrapper PatientsmedicaltestsreceiptList_class" >
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Patients Medical Tests Receipt </h4>
                 
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="patientsmedicaltestsreceipttable" class="table table-hover">
                    
                        </table>
                      </div>
                    </div>
                  </div>


                </div>
              </div>
            </div>
          </div>
        </div>








  <div class="content-wrapper PatientsmedicaltestsreceiptView-class" style="display: none;">
          <div class="row">
              <div class="col-lg-12">
                  <div class="card px-2">
                      <div class="card-body">
                        
                        <div id="invoice_printdata">
                          <div class="container-fluid">
                            <div class="row"> 
                            <div class="col-md-2"><img src="/<?php echo base_url();?>assets/images/BizBrainz_logo.PNG" style="height:100px;" alt="logo"/> 
                            </div>
                            <div class="col-md-8"> <h3> <div class="fullwidth text-center">
                              <b class="text-uppercase">BizBrainz Multi Speciality Hospitals</b>
                              <p>Flat No.16, Paigah Apartments, S.P Road, Secunderabad, Telangana, 500003.</p>
                              <p> +91 733 77 56789, +91 973 99 89333. Email:
                                 hyd@bizbrainz.in, blr@bizbrainz.in</p>
                              <p>visit our Website www.bizbrainz.in </p>
                            </div></h3>
                          </div>
                           <div class="col-md-2"><img src="/<?php echo base_url();?>assets/images/logo.png" style="height:100px;" alt="logo"/> 
                            </div>
                            </div>
                            <hr>
                          </div>
                          <div class="col-lg-12 pl-0 text-center text-uppercase">                              
                              <h3>Medical Test Receipt</h3>
                            </div>
                          <div class="container-fluid d-flex justify-content-between">
                            <div class="col-lg-6 pl-0 text-left">
                              <b class="mb-0 mt-5">Receipt No : <span id="patientsmedicaltestsreceipt_sno"></span> .</b>
                            </div>
                            
                            <div class="col-lg-6 pl-0 text-right">
                              <b class="mb-0 mt-5">Date : <span id="patientsmedicaltestsreceipt_date"></span></b>
                            </div>
                          </div>

                          <div class="container-fluid d-flex justify-content-between">
                            <div class="col-lg-6 pl-0 text-uppercase">
                              <h4 class="mt-5 mb-2"><b>Patient Details</b></h4>
                               <p>Patient Name : <span id="patientsmedicaltestsreceipt_patient_name"></span></p>
                               <p>Age : <span id="patientsmedicaltestsreceipt_patient_age"></span>.</p>
                              <p>Phone No. : <span id="patientsmedicaltestsreceipt_patient_mobileno"></span>.</p>
                            </div>
                            <div class="col-lg-6 pr-0 text-uppercase">
                              <h4 class="mt-5 mb-2 text-right"><b><b>Doctor Details</b></b></h4>
                              <p class="text-right">Doctor Name : <span id="patientsmedicaltestsreceipt_doctor_name"></span></p>
                              <p class="text-right">Specialization : <span id="patientsmedicaltestsreceipt_doctor_specialization"></span></p>
                              <p class="text-right">Phone No. : <span id="patientsmedicaltestsreceipt_doctor_mobileno"></span>.</p>
                            </div>
                          </div>
                          <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                            <div class="table-responsive w-100 ">
                                <table class="table css-serial" id="patientsmedicaltestsreceiptTable">
                                  <thead>
                                    <tr class="bg-dark text-white">
                                        <th>S.No</th>
                                         <th class="text-right">Medical Tests</th>
                                        <th class="text-right">Total Amount</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  </tbody>
                                </table>
                              </div>
                          </div>
                          <div class="container-fluid mt-5 w-100">
                            
                          <!-- <p class="text-right mb-2">Total Amount: &nbsp; &nbsp;<span id="patientsmedicaltestsreceipt_total_medicaltest_price"> </span></p>
                            <p class="text-right">CGST (9%) : &nbsp; &nbsp;<span id="business_invoice_cgst"></span>00</p>
                            <p class="text-right">SGST (9%) : &nbsp; &nbsp;<span id="business_invoice_sgst"></span>00</p>
                            <p class="text-right">IGST (18%) : &nbsp; &nbsp;<span id="business_invoice_igst"></span>00</p>
 -->
                            <h4 class="text-right mb-5">Total Amount : &nbsp; &nbsp; <span id="patientsmedicaltestsreceipt_grandtotal_medicaltest_price"></span></h4>
                           
                          </div>
                        </div>
                          <hr>
                 <div class="row clearfix ">
                 <div class="col-sm-12 col-12 text-center">
                       <b class="text-uppercase">BizBrainz Technologies Private Limited.</b>
                       <p>Visit Our Website www.bizbrainz.in </p>
                  </div>
                </div>
              <div class="row clearfix " >
                    <div class="col-sm-12 col-12 text-center">
                          <input type="hidden" name="patientsmedicaltestsreceipt_id" id="patientsmedicaltestsreceipt_id">
                             <button class="btn btn-primary  btn-sm" type="button" id="patientsmedicaltestsreceipt_pdf" value="pdf"><i class="mdi mdi-file-pdf"></i></button>
                             <button class="btn btn btn-success  btn-sm" type="button" id="patientsmedicaltestsreceipt_print" value="print" ><i class="mdi mdi-printer mr-1"></i></button>
                          </div>
                        </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>



<?php
include('Layouts/receptionistLayout_Footer.php');
?>

<script src="/<?php echo base_url();?>assets/js/Common/PatientsmedicaltestsreceiptController.js"></script>