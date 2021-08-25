<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/billingLayout_Header.php');
?>
<div class="main-panel">
  <div class="content-wrapper list_billing_medicaltest_class">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
             <!--      <h4 class="card-title">Madical Tests Billing </h4> -->
                  <div class="row grid-margin">
                    <div class="col-12">
                      <div class="header">
                            <h4> Madical Tests Billing List</h4>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="medicaltestsbillingtable" class="table table-hover">
                    
                        </table>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>


  <div class="content-wrapper invoice_billing_medicaltest_class" style="display: none">
          <div class="row">
              <div class="col-lg-12">
                  <div class="card px-2">
                      <div class="card-body">
                        <h4 class="card-title">
                        <a href="/<?php echo base_url();?>Billing-MedicalTestsBilling"> <div style="float:right"><button type="button" class="btn btn-info btn-sm"> Back </button></div></a> 
                          </h4>

                        <div id="invoice_printdata">
                          <div class="container-fluid">
                            <div class="row clearfix">
                            <div class="col-md-2">
                              <div id="patientbillingtest_accountlogo"></div>
                            </div>

                            <div class="col-md-8"> <h3> <div class="fullwidth text-center">
                              <b class="text-uppercase" id="patientbillingtest_accountname"></b>
                              <p id="patientbillingtest_accountaddress"></p> 
                              <p id="patientbillingtest_mobilenoemail"></p>
                            </div>
                          </h3>
                          </div>

                           <div class="col-md-2">
                             <div id="patientbillingtest_doctorssapplogo"></div>
                            </div>
                          </div>
                            <hr>
                          </div>
                         <!--  <div class="col-lg-12 pl-0 text-center text-uppercase">                              
                              <h1>Invoice</h1>
                            </div> -->
                          <div class="container-fluid d-flex justify-content-between">
                            <div class="col-lg-6 pl-0 text-left">
                              <b class="mb-0 mt-5">S.No : <span id="patientbillingtest_invoice_id"></span> .</b>
                            </div>
                            
                            <div class="col-lg-6 pl-0 text-right">
                              <b class="mb-0 mt-5">Date : <span id="patientbillingtest_invoice_billing_date"></span> .</b>
                            </div>
                          </div>

                          <div class="container-fluid d-flex justify-content-between">
                            <div class="col-lg-6 pl-0 text-uppercase">
                              <h6 class="mt-5 mb-2"><b>Patient Details.</b></h6> 
                               <p>Patient User Id : <span id="patientbillingtest_invoice_puserid">Baburao</span></p>
                               <p>Patient Name : <span id="patientbillingtest_invoice_pname">Baburao</span></p>
                               <p>Patient Mobile : <span id="patientbillingtest_invoice_pmobile">Baburao</span></p>
                               <p>Appointment Date : <span id="patientbillingtest_invoice_appointmentdate">Baburao</span></p>
                            </div>
                            <div class="col-lg-6 pr-0 text-uppercase">
                              <h6 class="text-right mt-5 mb-2"><b>Doctors Details.</b></h6>
                              <p class="text-right">Doctors UserId : <span id="patientbillingtest_invoice_duserid"></span></p>
                               <p class="text-right">Doctors Name : <span id="patientbillingtest_invoice_dname"></span></p>
                              <p class="text-right">Doctors Mobile : <span id="patientbillingtest_invoice_dmobile">.</span></p>
                            </div>
                          </div>
                          <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                            <div class="table-responsive w-100 ">
                                <table class="table css-serial" id="myTable">
                                  <thead>
                                    <tr class="bg-dark text-white">
                                        <th>S.No</th>
                                        <th>Medical Test Name</th>
                                        <th>Discretion</th>
                                        <th>Total</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  </tbody>
                                </table>
                              </div>
                          </div>
                          <div class="container-fluid mt-5 w-100">
                            <p class="text-right mb-2">Total Amount:&nbsp; &nbsp;<span id="patientbillingtest_invoice_total_amount"></span></p>
                            <p class="text-right mb-2">Discount Amount:&nbsp; &nbsp;<span id="patientbillingtest_invoice_discount_amount"></span></p>
                          <p class="text-right mb-2">Sub Total Amount: &nbsp; &nbsp;<span id="patientbillingtest_invoice_sub_total_amount"></span></p>
                            <p class="text-right">GST (18%) :&nbsp; &nbsp;<span id="patientbillingtest_invoice_gst_amount"></span></p>
                            <h4 class="text-right mb-5">Grand Total : &nbsp; &nbsp;<span id="patientbillingtest_invoice_grand_total_amount"></span></h4>
                            <hr>
                          </div>
                        </div>


                          <div class="container-fluid w-100">
                            <form id="export_invoice" method="post">
                              <input type="hidden" id="patientbillingtest_invoice_selectedid" name="patientbillingtest_invoice_selectedid">
                           
                           <div style="text-align: center;">
                        <button class="btn btn-primary btn-sm" type="button" id="patientbillingtest_invoice_pdf" value="pdf"><i class="mdi mdi-file-pdf"></i></button>
                        <button class="btn btn-primary btn-sm" type="button" id="patientbillingtest_invoice_print" value="print" ><i class="mdi mdi-printer"></i></button> 
                     
                    </div>
                           </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>


<?php
include('Layouts/billingLayout_Footer.php');
?>

 <script src="/<?php echo base_url();?>assets/js/Common/PatientBillingTestController.js" type="text/javascript"></script>