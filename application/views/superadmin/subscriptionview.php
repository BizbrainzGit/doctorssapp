<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/superadminLayout_Header.php');
?>

<?php
$txnid = time();
$merchant_order_id="BB_RAZORPAY_".$txnid;
$surl = '/'.base_url().'RazorpayController/success';
$furl = '/'.base_url().'RazorpayController/failed';        
$key_id = $this->config->item('RAZOR_KEY_ID');
$currency_code = $this->config->item('DISPLAY_CURRENCY'); 
$card_holder_name=isset($card_holder_name)?$card_holder_name:"Test";
$productinfo=isset($merchant_product_info_id)?$merchant_product_info_id:null;
 ?>
<div class="modal fade" id="razorPayModal" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Pay Now</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
        <!-- Modal body -->
        <div class="modal-body">
                    <div class="body">
                            <div class="row clearfix">
                              <div class="col-sm-12">
                                <h6>Are you sure you want to Pay Online?</h6>
                              </div>
                                <div class="col-sm-12">
                <form name="razorpay-form" id="razorpay-form" action="/<?php echo base_url();?>RazorpayController/callback" method="POST" target="_blank">
                  <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" />
                  <input type="hidden" name="razorpay_signature" id="razorpay_signature" />
                  <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo $merchant_order_id; ?>"/>
                  <input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="<?php echo $txnid; ?>"/>
                  <input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="<?php echo $productinfo; ?>"/>
                  <input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="<?php echo $surl; ?>"/>
                  <input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="<?php echo $furl; ?>"/>
                  <input type="hidden" name="card_holder_name_id" id="card_holder_name_id" value="<?php echo $card_holder_name; ?>"/>
                  <input type="hidden" name="merchant_total" id="merchant_total" value=""/>
                  <input type="hidden" name="merchant_amount" id="merchant_amount" value=""/>
                  <input type="hidden" name="razorpay_order_id" id="razorpay_order_id" value=""/>
                </form>


                
                                </div>
                                  
                            </div>
                    </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
      <div class="row">
        <div class="col-lg-12 text-right">
          <input  id="submit-pay" type="submit" onclick="razorpaySubmit(this);" value="Yes" class="btn btn-primary" />
          <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-secondary">No</button>
        </div>
      </div>
        </div>
      </div>
    </div>
  </div>
<!-- Order ID-->
<div class="modal fade"  role="dialog" id="orderGeneration">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Order Generation</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
                    <div class="body">
                        <div id="orderMessage"></div>
                            <div class="row clearfix">
                              <div class="col-sm-12">
                                <h6>Are you sure you want to Genarate an Order?</h6>
                              </div>
                                <div class="col-sm-12">
                <form name="orderRazorpayForm" id="orderRazorpayForm" method="POST">
                  <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo $merchant_order_id; ?>"/>
                  <input type="hidden" name="merchant_total" id="merchant_total" value=""/>
                  <input type="hidden" name="merchant_amount" id="merchant_amount" value=""/>
                </form>
                                </div>
                                  
                            </div>
                    </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
      <div class="row">
        <div class="col-lg-12 text-right">
            <button type="button" id="orderButton" class="btn btn-primary orderButton">Yes</button>
             <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>
      </div>
        </div>
      </div>
    </div>
  </div>
<!-- End of Order ID-->

<div class="main-panel">

   <div class="content-wrapper listsubscription-class">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Manage Subscription </h4>
                  <div class="row grid-margin">
                    <div class="col-12">
                      <div class="header">
                            <h5>
                          <div style="float:right"><button type="button" class="btn btn-info btn-md" id="add_show_subscription"><i class="fa fa-plus" aria-hidden="true"></i>Add</button></div>
                         </h5>
                        </div>
                    </div>
                    <div class="col-12"></div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="subscriptiontable" class="table table-hover">
                        </table>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
      </div>

          <!--- Selected Pakges View   -->
      

        <div class="content-wrapper addsubscription-class" style="display: none">
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Account Subscription 
                 <a href="/<?php echo base_url();?>SuperAdmin-Manage-Subscriptions"> <div style="float:right"><button type="button" class="btn btn-info btn-sm"> Back </button></div></a> </h4>

                <form  method="post" name="add_subscriptiondata"  id="add_subscriptiondata" >
                    <div>
                       <h3>Package Selection</h3>
                        <section>
                         <h3>Package Selection</h3>
                           <div class="row clearfixed">
                                   <div class="col-sm-6 col-12 form-group">
                                     <label>Select Account <span class="requried_class">*</span>:</label>
                                      <select class="form-control" placeholder="Select Account " name="add_subscription_accountid" id="add_subscription_accountid">
                                      </select>
                                   </div>
                                   <div class="col-sm-3 col-12">
                                    <div class="form-group">
                                        <label>Start Date <span class="requried_class">*</span>:</label>  
                                          <div id="datepicker-popup" class="input-group date datepicker" >
                                            <input type="text" class="form-control bet_start" placeholder="Start Date" name="add_subscription_startdate" id="add_subscription_startdate">
                                          </div>

                                       </div>
                                    </div>
                                <div class="col-sm-3 col-12">
                                  <div class="form-group">
                                     <label>End Date <span class="requried_class">*</span>:</label>
                                        <div id="datepicker-popup" class="input-group date datepicker">
                                            <input type="text" class="form-control bet_end" placeholder="End Date" name="add_subscription_enddate" id="add_subscription_enddate">
                                          </div>
                                   </div>
                                </div>
                              </div>
                             <div class="row pricing-table" id="addpackagelist"> </div>

                       </section>

                      <h3>Selected Details</h3>
                        <section>
                        <h3>Selected Detail</h3>
                         <div class="row clearfixed" id="packagelist1">
                         </div>
                         <div class="row clearfixed" id="totalamount1">
                         </div>
                          <div class="row clearfixed">
                          <div class="col-sm-6 col-12">
                          <label>Promocode</label>
                         <input type="hidden" class="form-control" name="add_subscription_total" id="add_subscription_total">

                          <input type="text" class="form-control" placeholder="Promocode Enter" name="add_subscription_promocode" id="add_subscription_promocode">
                        </div>
                         <div class="col-sm-4 col-12 mt-2">
                           <label> </label>
                          <button type="button" class="btn btn-primary form-control" name="applypromocode" id="applypromocode">Apply Promocode</button>
                          </div>
                          </div>
                          <div id="promcodeamount-msg"></div>

                         <div class="row clearfixed" >
                           <div class="col-sm-12 col-12" id="discount"></div>
                        </div>
                        <div class="row clearfixed" >
                          <div class="col-sm-12 col-12" id="grandtotalamount"> </div>

                         <input type="hidden" class="form-control" name="add_subscription_discountamount" id="add_subscription_discountamount">
                         <input type="hidden" class="form-control" name="add_subscription_grandtotal" id="add_subscription_grandtotal">
                         <input type="hidden" class="form-control" name="add_subscription_promocode_id" id="add_subscription_promocode_id">
                         <input type="hidden" class="form-control" name="add_subscription_packagetotal" id="add_subscription_packagetotal">
                         

                        </div>
                      </section>

                      <h3>Mode of Payments</h3>
                      <section>
                       <h3>Mode of Payments</h3>
                      <div class="row clearfixed">
                        <div class="col-sm-4 col-12">
                         <ul class="nav nav-pills nav-pills-vertical nav-pills-info">
                             <span id="addsubscriptionpaymentmode"></span>
                          </ul>
                      </div>

                    <div class="col-sm-8 col-12"> 
                      <div class="tab-content tab-content-vertical" id="paymentmode_cash" style="display: none">
                        <h5>Cash Details : </h5>
                           <div class="row clearfixed">
                            <div class="col-sm-6 col-12 form-group">
                              <label>Amount</label>
                              <input type="text" class="form-control" placeholder="Amount" name="add_subscription_cashamount" id="add_subscription_cashamount">
                            </div>
                            <div class="col-sm-6 col-12 form-group">
                              <label>Person Name</label>
                              <input type="text" class="form-control" placeholder="Person Name" name="add_subscription_personame" id="add_subscription_personame">
                            </div>
                         </div> 
                      </div>

                       <div class="tab-content tab-content-vertical" id="paymentmode_neft" style="display: none">
                        <h5>NEFT/IMPS Details : </h5>
                           <div class="row clearfixed">
                            <div class="col-sm-6 col-12 form-group">
                              <label>NEFT/IMPS Number</label>
                              <input type="text" class="form-control" placeholder="NEFT/IMPS Number" name="add_subscription_neftnumber" id="add_subscription_neftnumber">
                            </div>
                             <div class="col-sm-6 col-12 form-group">
                              <label>NEFT/IMPS Amount</label>
                              <input type="text" class="form-control" placeholder="NEFT/IMPS Amount" name="add_subscription_neftamount" id="add_subscription_neftamount">
                            </div>
                         </div> 
                      </div>
                      <div class="tab-content tab-content-vertical" id="paymentmode_upi" style="display: none">
                         <h5> UPI Details : </h5>
                         <div class="row clearfixed">
                          <div class="col-sm-6 col-12 form-group">
                            <label>UPI Number</label>
                            <input type="text" class="form-control" placeholder="UPI Number" name="add_subscription_upi" id="add_subscription_upi">
                          </div>
                            <div class="col-sm-6 col-12 form-group">
                            <label>Phone Pay</label>
                            <input type="text" class="form-control" placeholder="Phone Pay Number" name="add_subscription_phonepay" id="add_subscription_phonepay">
                          </div>
                           <div class="col-sm-6 col-12 form-group">
                            <label>Amazon Pay</label>
                            <input type="text" class="form-control" placeholder="Amazon Pay Number" name="add_subscription_amazonpay" id="add_subscription_amazonpay">
                          </div>
                           <div class="col-sm-6 col-12 form-group">
                            <label>Google Pay</label>
                            <input type="text" class="form-control" placeholder="GooglePay Number" name="add_subscription_googlepay" id="add_subscription_googlepay">
                          </div>
                           <div class="col-sm-6 col-12 form-group">
                            <label>PayTm UPI Number</label>
                            <input type="text" class="form-control" placeholder="PayTm UPI Number" name="add_subscription_paytm" id="add_subscription_paytm">
                          </div>

                          <div class="col-sm-6 col-12 form-group">
                            <label>Amount</label>
                            <input type="text" class="form-control" placeholder="Amount" name="add_subscription_upiamount" id="add_subscription_upiamount">
                          </div>
                         </div>
                      </div>
                      <div class="tab-content tab-content-vertical" id="paymentmode_cheque" style="display: none">
                        <h5> Cheque Details : </h5>
                         <div class="row clearfixed">
                          <div class="col-sm-6 col-12 form-group">
                            <label>Cheque Number</label>
                            <input type="text" class="form-control" placeholder="Cheque Number" name="add_subscription_chequeno" id="add_subscription_chequeno">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Cheque Issue Date</label>
                            <input type="text" class="form-control" placeholder="Cheque Issue Date" name="add_subscription_chequeissuedate" id="add_subscription_chequeissuedate">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Bank Name</label>
                            <input type="text" class="form-control " placeholder="Bank Name" name="add_subscription_cheque_bankname" id="add_subscription_cheque_bankname">
                          </div>
                           <div class="col-sm-6 col-12 form-group">
                            <label>Photo</label>
                           <input type="file" class="form-control" name="add_subscription_cheque_photo" id="add_subscription_cheque_photo">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Cheque Amount</label>
                            <input type="text" class="form-control" placeholder="Cheque Amount" name="add_subscription_chequeamount" id="add_subscription_chequeamount">
                          </div>
                         </div> 
                      </div>
                     </div>
                </div>
                </section>

                      <h3>Final</h3>
                      <section> 
                       <h3>Final</h3>
                      <input type="hidden" class="form-control" name="add_subscription_razorpay_order_id" id="add_subscription_razorpay_order_id" value="<?php echo $merchant_order_id; ?>">
                               <div class="form-check">
                                  <label class="form-check-label">
                                  <input class="checkbox" type="checkbox" name="add_subscription_condition" id="add_subscription_condition">
                                    I Agree With The Terms and Conditions.
                                  </label>
                                  <div id="subscriptiondata-addmsg"></div>
                                </div>

                        </section>

                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
         
        </div>


        <div class="content-wrapper subscription_invoice-class" style="display: none">
          <div class="row">
              <div class="col-lg-12">
                  <div class="card px-2">
                      <div class="card-body">
                        <div id="invoice_printdata">
                          <div class="container-fluid">
                            <div class="row"> 
                            <div class="col-md-2">
                              <img src="/<?php echo base_url();?>assets/images/BizBrainz_logo.PNG" style="height:100px;" alt="logo"/> 
                            </div>
                            <div class="col-md-8 text-center"> 
                              <h3><div class="fullwidth text-center">
                                    <b class="text-uppercase">BizBrainz Technologies Private Limited</b>
                                    <p>Flat No.16, Paigah Apartments, S.P Road, Secunderabad, Telangana, 500003.</p>
                                    <p> +91 733 77 56789, +91 973 99 89333. Email:
                                       hyd@bizbrainz.in, blr@bizbrainz.in</p>
                                    <!-- <p>visit our Website www.bizbrainz.in </p> -->
                            </div></h3>
                          </div>
                           <div class="col-md-2">
                              <img src="/<?php echo base_url();?>assets/images/logo.PNG" style="height:100px;" alt="logo"/> 
                            </div>

                            </div>
                            <hr>
                          </div>
                          <div class="col-lg-12 pl-0 text-center text-uppercase">                              
                              <h1>Invoice</h1>
                            </div>
                          <div class="container-fluid d-flex justify-content-between">
                            <div class="col-lg-6 pl-0 text-left">
                              <b class="mb-0 mt-5">Invoice No : <span id="subscription_invoice_id"></span> .</b>
                            </div>
                            
                            <div class="col-lg-6 pl-0 text-right">
                              <b class="mb-0 mt-5">Date : <span id="subscription_invoice_date"></span> .</b>
                            </div>
                          </div>

                          <div class="container-fluid d-flex justify-content-between">
                            <div class="col-lg-6 pl-0 text-uppercase">
                              <h4 class="mt-5 mb-2"><b>BizBrainz Technologies Private Limited.</b></h4>
                               <p>Flat No.16, Paigah Apartments<br>S.P Road, Secunderabad,<br>Telangana,500003.</p>
                              <p>GST No. : 36AAICB5799E1ZA </p>
                            </div>
                            <div class="col-lg-6 pr-0 text-uppercase">
                              <h4 class="mt-5 mb-2 text-right"><b><span id="subscription_invoice_account_name"></span></b></h4>
                              <p class="text-right"><span id="subscription_invoice_address"></span></p>
                              <p class="text-right">GST No. :<span id="subscription_invoice_gstno">.</span></p>
                            </div>
                          </div>
                          <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                            <div class="table-responsive w-100 ">
                                <table class="table css-serial" id="myTable">
                                  <thead>
                                    <tr class="bg-dark text-white">
                                        <th>S.No</th>
                                        <th>Description</th>
                                        <th class="text-right">Quantity</th>
                                        <th class="text-right">Unit cost</th>
                                        <th class="text-right">Total</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  </tbody>
                                </table>
                              </div>
                          </div>
                          <div class="container-fluid mt-5 w-100">
                            
                            <p class="text-right mb-2">Package Total Amount:&nbsp; &nbsp;<span id="subscription_invoice_packagetotal"></span></p>
                            <p class="text-right mb-2">Discount Amount:&nbsp; &nbsp;<span id="subscription_invoice_dicount"></span></p>
                            <p class="text-right mb-2">Sub Total Amount: &nbsp; &nbsp;<span id="subscription_invoice_subtotal"></span></p>
                            <p class="text-right">CGST (9%) :&nbsp; &nbsp;<span id="subscription_invoice_cgst"></span></p>
                            <p class="text-right">SGST (9%) :&nbsp; &nbsp;<span id="subscription_invoice_sgst"></span></p>
                            <p class="text-right">IGST (18%) :&nbsp; &nbsp;<span id="subscription_invoice_igst"></span></p>
                            <h4 class="text-right mb-5">Grand Total : &nbsp; &nbsp;<span id="subscription_invoice_grandtotal"></span>  </h4>


                            <hr>
                          </div>
                        </div>
                          <div class="container-fluid w-100">
                            <form id="subscription_export_invoice" method="post">
                              <input type="hidden" id="subscription_invoice_selectedid" name="subscription_invoice_selectedid">
                           
                           <div style="text-align: center;">
                        <button class="btn btn-primary btn-sm" type="button" id="subscription_invoice_pdf" value="pdf"><i class="mdi mdi-file-pdf"></i></button>
                        <div id="subscription_invoice_msg"> </div>
                        </div>
                           </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>
    <!--- Receipt Start-->
    <div class="content-wrapper subscription_receipt-class" style="display: none">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                   <div class="row grid-margin">
                    <div class="col-12">
                      <div class="header">
                             <div class="container-fluid w-100">
                              <div id="subscription_receipt_msg"> </div>
                            <form id="subscription_export_receipt" method="post">
                              <input type="hidden" id="subscription_receipt_selectedid" name="subscription_receipt_selectedid">
                           <div style="float: right;">
                            <button class="btn btn-primary btn-sm" type="button" id="subscription_receipt_pdf" value="pdf"><i class="mdi mdi-file-pdf"></i></button>
                           </div>
                           </form>
                          </div>
                       </div>
                     </div>
                     
                     <div class="col-12" id="receipt_printdata" style="border: 2px solid; border-radius: 12px;">
                          <div class="row clearfixed receipt-header">                          
                             <div class="col-sm-3 col-12 text-center">
                               <img src="/<?php echo base_url();?>assets/images/BizBrainz_logo.PNG" style="height:100px;" alt="logo"/>
                             </div>
                             <div class="col-sm-6 col-12 receipt_heading text-center">
                                 <h1>Receipt</h1>   
                             </div>
                             <div class="col-sm-3 col-12 text-center">
                               <img src="/<?php echo base_url();?>assets/images/logo.png" style="height:100px;" alt="logo"/>
                             </div>
                          </div>
                      
                        <div class="row clearfixed receipt_line1"> 
                            <div class="col-sm-2">
                                <label >Receipt No. :</label>
                             </div>
                             <div class="col-sm-4">
                                  <div id="subscription_receipt_number"></div>
                             </div>
                             <div class="col-sm-2">
                                <label >Date : </label>
                             </div>
                             <div class="col-sm-4">
                                  <div id="subscription_receipt_date"></div>
                             </div>
                        </div> 

                         <div class="row clearfixed receipt_line2"> 
                            <div class="col-sm-2">
                               <label > Account Name:</label>
                            </div>
                            <div class="col-sm-10 border_bottom">
                              <div id="subscription_receipt_account_name"></div>
                            </div>
                         </div>
                       <div class="row clearfixed receipt_line2"> 
                             <div class="col-sm-2">
                               <label >Address :</label>
                             </div>
                             <div class="col-sm-10 border_bottom">
                               <span id="subscription_receipt_address"></span>
                             </div>
                       </div> 
                  <div class="row clearfixed receipt_line2">
                    <div class="col-sm-6">
                        <div class="row">
                        <div class="col-sm-12">
                          <div style="padding: 10px 0px 0px 15px;text-align: justify;">

                             <h3 style="text-align: center;">Terms and Conditions</h3>
                              <ul>
                                <li>After payment clearance only contract will be activation.</li>
                                <li>BizBrainz DOES NOT GUARANTEE and do not intend to guarantee any business to its vendor, it is merely a medium which connects general public with vendors of goods and services listed with BizBrainz.
                              </li>
                              <li>After payment clearance customer should be provide content and photos with in 7 Working days for website </li>
                              <li>The Advertiser has given his consent to contact him for any business promotion of BizBrainz during the tenure of this agreement. Whether the Advertiser has registered their entity/firm’s contact numbers as per customer request.</li>
                              <li>Contract’s duration is one year or more, unless determined by the parties under this agreement/contract.
                              </li>
                            </ul>
                            
                          </div>
                        </div> 
                        </div> 

                        </div>
                      
                      

                         <div class="col-sm-6">
                          <div style="background-color: ;border: 1px solid;border-radius: 12px;">
                            <h4 style="text-align: center;padding: 10px 0px 10px 0px ; background-color: gray;border-radius: 12px 12px 0px 0px;">PAYMENT DETAILS</h4>

                           <div class="row" style="padding-left: 5px;">
                             <div class="col-sm-6"> <p>Pacckage Total Amount:</p>   </div>
                              <div class="col-sm-5" style="border-bottom: 1px solid"><span id="subscription_receipt_package_total_amount"></span>
                             </div>
                          </div>
                         <div class="row" style="padding-left: 5px;">
                           <div class="col-sm-6"> <p>Discount Amount:</p>   </div>
                           <div class="col-sm-5" style="border-bottom: 1px solid"><span id="subscription_receipt_discount_amount"></span>
                           </div>
                         </div>
                        <div class="row" style="padding-left: 5px;">
                            <div class="col-sm-6"> <p>Sub Total Amount:</p>   </div>
                            <div class="col-sm-5" style="border-bottom: 1px solid"><span id="subscription_receipt_sub_total"></span>
                            </div>
                        </div>
                         <div class="row" style="padding-left: 5px;">
                           <div class="col-sm-6"> <p>GST:</p>   </div>
                           <div class="col-sm-5" style="border-bottom: 1px solid"><span id="subscription_receipt_gst"></span>
                           </div>
                        </div>
                         <div class="row" style="padding-left: 5px;">
                           <div class="col-sm-6"> <p>Grand Total:</p>   </div>
                           <div class="col-sm-5" style="border-bottom: 1px solid"><span id="subscription_receipt_grand_total"></span>
                         </div>
                        </div>

                         <div class="row receipt_line2" style="padding-left: 5px;">
                           <div class="col-sm-6">  <p>Order ID:</p>  </div>
                           <div class="col-sm-6">  <span id="subscription_receipt_order_id"></span> </div>
                        </div>

                         <div class="row receipt_line2" style="padding-left: 5px;">
                           <div class="col-sm-6">  <p>Payment Method:</p>  </div>
                           <div class="col-sm-6">  <span id="subscription_receipt_payment_methode"></span> </div>
                         </div>

                        <div class="row receipt_line2" style="padding-left: 5px;">
                           <div class="col-sm-6">  <p>Transction Amount:</p>  </div>
                           <div class="col-sm-6">  <span id="subscription_receipt_transaction_amount"></span> </div>
                        </div>

                         <div class="row receipt_line2" style="padding-left: 5px;">
                           <div class="col-sm-6">  <p>Transction Status:</p>  </div>
                           <div class="col-sm-6">  <span id="subscription_receipt_transaction_status"></span> </div>
                         </div>

                        
                      </div>
                    </div>
                    </div> 

                     <div class="row clearfixed receipt_line2" style="border-top: 1px solid;"> 
                               <div class="col-sm-12 text-center">
                                    <b class="text-uppercase">BizBrainz Technologies Private Limited</b>
                                     <strong><p>CIN: U72900TG2019PTC134639, GST: 36AAICB5799E1ZA </p></strong>
                                    <p>Flat No.16, Paigah Apartments,S.P Road, Secunderabad,Telangana,500003.</p>
                                    <p> +91 733 77 56789 , +91 973 99 89333   <b>Email:</b>
                                       hyd@bizbrainz.in , blr@bizbrainz.in</p>
                                    <p>visit our Website <b style="font-size: 20px;">www.bizbrainz.in</b></p>
                                </div>
                      </div>  
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
 <!-- Reciept Ends -->




<?php
include('Layouts/superadminLayout_Footer.php');
?>

<script src="/<?php echo base_url();?>assets/js/superadmin/SubscriptionController.js"></script>

<script type="text/javascript">
  
  getPaymentstatus("#addsubscriptionpaymentmode");
  
</script>
  <script type="text/javascript">

    //GetAccountSelectList("#account_selected_accountid");
getHospitalAccount("#add_subscription_accountid");
packagelistview("#addpackagelist");


$(function () {
    $(document).on('click', "#add_subscription_startdate", function (e){
        $(this).datepicker({
             todayHighlight: true,
             autoclose: true,
             startDate: '0d',
            format: 'dd-mm-yyyy'
            });
    });

 $(document).on('click', "#add_subscription_enddate", function (e){
        $(this).datepicker({
              todayHighlight: true,
               autoclose: true,
               startDate: '0d',
               format: 'dd-mm-yyyy'
            });
    });


$('.bet_start').datepicker({
    autoclose: true,
    format: 'dd-mm-yyyy',
    todayHighlight: true,
    startDate: '0d'
});
var startDate = new Date('18-09-2019');
var FromEndDate = new Date();
var ToEndDate = new Date();
ToEndDate.setDate(ToEndDate.getDate() + 365);

$('.bet_start').datepicker({
    weekStart: 1,
    startDate: '18-09-2019',
    endDate: FromEndDate,
    autoclose: true
})
    .on('changeDate', function (selected) {
        startDate = new Date(selected.date.valueOf());
        startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
        $('.bet_end').datepicker('setStartDate', startDate);
    });
    
$('.bet_end')
    .datepicker({
        weekStart: 1,
        startDate: startDate,
        endDate: ToEndDate,
        format: 'dd-mm-yyyy',
        autoclose: true

    })
    .on('changeDate', function (selected) {
        FromEndDate = new Date(selected.date.valueOf());
        FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));
        $('.bet_start').datepicker('setEndDate', FromEndDate);
    });

});

function showPaymentmode(test){
    var test = test.value;
    if(test==1)
      { 
       var grand_total=((document.getElementById('add_subscription_grandtotal').value)>0)? document.getElementById('add_subscription_grandtotal').value:document.getElementById('add_subscription_total').value;
         document.getElementById("add_subscription_cashamount").value = grand_total;
         document.getElementById("add_subscription_upiamount").value = '';
         document.getElementById("add_subscription_chequeamount").value ='';
         document.getElementById("add_subscription_neftamount").value ='';
          
        $("#paymentmode_cash").show();
        $("#paymentmode_upi").hide();
        $("#paymentmode_cheque").hide();
        $("#paymentmode_neft").hide();
        $("#razorPayModal").hide(); 

      $("#add_subscription_upi").val('');
      $("#add_subscription_phonepay").val('');
      $("#add_subscription_amazonpay").val('');
      $("#add_subscription_googlepay").val('');
      $("#add_subscription_paytm").val('');

      $("#add_subscription_chequeno").val('');
      $("#add_subscription_chequeissuedate").val('');
      $("#add_subscription_cheque_bankname").val('');
      $("#add_subscription_cheque_photo").val(''); 

      $("#add_subscription_neftnumber").val('');

      }else if(test==3){

        var grand_total=((document.getElementById('add_subscription_grandtotal').value)>0)? document.getElementById('add_subscription_grandtotal').value:document.getElementById('add_subscription_total').value;
        document.getElementById("add_subscription_cashamount").value = '';
        document.getElementById("add_subscription_upiamount").value = grand_total;
        document.getElementById("add_subscription_chequeamount").value ='';
        document.getElementById("add_subscription_neftamount").value ='';
          
        $("#paymentmode_cash").hide();
        $("#paymentmode_upi").show();
        $("#paymentmode_cheque").hide();
        $("#paymentmode_neft").hide();
        $("#razorPayModal").hide(); 

     
      $("#add_subscription_chequeno").val('');
      $("#add_subscription_chequeissuedate").val('');
      $("#add_subscription_cheque_bankname").val('');
      $("#add_subscription_cheque_photo").val(''); 

      $("#add_subscription_cashdate").val('');
      $("#add_subscription_personame").val('');

      $("#add_subscription_neftnumber").val('');

      }else if(test==2){

        var grand_total=((document.getElementById('add_subscription_grandtotal').value)>0)? document.getElementById('add_subscription_grandtotal').value:document.getElementById('add_subscription_total').value;
        document.getElementById("add_subscription_cashamount").value = '';
         document.getElementById("add_subscription_upiamount").value = '';
        document.getElementById("add_subscription_chequeamount").value =grand_total;
        document.getElementById("add_subscription_neftamount").value ='';
          
        $("#paymentmode_cash").hide();
        $("#paymentmode_upi").hide();
        $("#paymentmode_paytm").hide();
        $("#paymentmode_cheque").show();
        $("#paymentmode_neft").hide();
        $("#razorPayModal").hide(); 

      $("#add_subscription_upi").val('');
      $("#add_subscription_phonepay").val('');
      $("#add_subscription_amazonpay").val('');
      $("#add_subscription_googlepay").val('');
      $("#add_subscription_paytm").val('');

      $("#add_subscription_cashdate").val('');
      $("#add_subscription_personame").val('');

      $("#add_subscription_neftnumber").val('');

        
      }else if(test==5)
      {   
         var grand_total=((document.getElementById('add_subscription_grandtotal').value)>0)? document.getElementById('add_subscription_grandtotal').value:document.getElementById('add_subscription_total').value;
        document.getElementById("add_subscription_cashamount").value = '';
         document.getElementById("add_subscription_upiamount").value = '';
        document.getElementById("add_subscription_chequeamount").value ='';
        document.getElementById("add_subscription_neftamount").value =grand_total;
        $("#paymentmode_cash").hide();
        $("#paymentmode_upi").hide();
        $("#paymentmode_paytm").hide();
        $("#paymentmode_cheque").hide();
        $("#paymentmode_neft").show();
        $("#razorPayModal").hide(); 

        $("#add_subscription_upi").val('');
        $("#add_subscription_phonepay").val('');
        $("#add_subscription_amazonpay").val('');
        $("#add_subscription_googlepay").val('');
        $("#add_subscription_paytm").val('');

        $("#add_subscription_chequeno").val('');
        $("#add_subscription_chequeissuedate").val('');
        $("#add_subscription_cheque_bankname").val('');
        $("#add_subscription_cheque_photo").val(''); 

        $("#add_subscription_cashdate").val('');
        $("#add_subscription_personame").val('');

      }else if(test==4){

      $("#add_subscription_upi").val('');
      $("#add_subscription_phonepay").val('');
      $("#add_subscription_amazonpay").val('');
      $("#add_subscription_googlepay").val('');
      $("#add_subscription_paytm").val('');

      $("#add_subscription_chequeno").val('');
      $("#add_subscription_chequeissuedate").val('');
      $("#add_subscription_cheque_bankname").val('');
      $("#add_subscription_cheque_photo").val(''); 

      $("#add_subscription_cashdate").val('');
      $("#add_subscription_personame").val('');
    
      $("#add_subscription_neftnumber").val('');

    var base_url='/<?php echo base_url();?>';
    $("#orderGeneration").modal();
    var merchant_total=0;
    var merchant_amount=0;
    var grand_total=((document.getElementById('add_subscription_grandtotal').value)>0)? document.getElementById('add_subscription_grandtotal').value:document.getElementById('add_subscription_total').value;
    alert(grand_total);
    var merchant_total=((grand_total*100)>0)? (grand_total*100):100;
    var merchant_amount=((grand_total)>0)? grand_total:1;
    alert(merchant_total);
    alert(merchant_amount);
    document.getElementById('merchant_total').value=merchant_total;
    document.getElementById('merchant_amount').value=merchant_amount;

    $(document).ready(function(){
    $('#orderButton').click(function(){
    var merchant_order_id= $("#merchant_order_id").val();
    var merchant_total= $("#merchant_total").val();
    var merchant_amount= $("#merchant_amount").val();
   $.ajax({
    type: "POST",
     dataType: 'json',
    url:base_url+"RazorpayController/orderRazorPayGeneration",
    cache: false,
    data: {merchant_order_id:merchant_order_id,merchant_total:merchant_total,merchant_amount:merchant_amount},
    success: function(result) {
        if(result.success===true){
             $("#orderGeneration").modal("hide");
            $("#razorPayModal").modal();
            var razorpay_order_id=result.message;
            document.getElementById('razorpay_order_id').value=razorpay_order_id;
           
        }else{
              $('#orderMessage').hide().fadeIn('slow').delay(1000).fadeOut(2200);
             $( "#orderMessage").html("<div class='alert alert-danger'>Some thing went wrong Please try again ...</div>");
        }
    }
   });
  });
});


  }
  }


    </script> 



<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
  
  var razorpay_submit_btn, razorpay_instance;
  function razorpaySubmit(el){
var email="test";
var mobileno="9652589420";
var card_holder_name="baburao";
// var email=document.getElementById('add_business_email').value;
// var mobileno=document.getElementById('add_business_mobileno').value;
// var card_holder_name=document.getElementById('add_business_pname').value;
var razorpay_order_id=document.getElementById('razorpay_order_id').value;
//alert(razorpay_order_id);
//alert(email);
//alert(mobileno);
//alert(card_holder_name);
  var razorpay_options = {
    key: "<?php echo $key_id; ?>",
    description: "Order # <?php echo $merchant_order_id; ?>",
    netbanking: true,
    currency: "<?php echo $currency_code; ?>",
  prefill:{
  },
    notes: {
      soolegal_order_id: "<?php echo $merchant_order_id; ?>",
    },
    "handler": function (transaction) {
        document.getElementById('razorpay_payment_id').value = transaction.razorpay_payment_id;
        document.getElementById('razorpay_signature').value = transaction.razorpay_signature;
        document.getElementById('razorpay-form').submit();
       // document.getElementById("razorpay_payment_order_id").value=transaction.razorpay_payment_id ;
       // document.getElementById("razorpay_payment_transaction_amount").value=merchant_total1;
    },
    "modal": {
        "ondismiss": function(){
          $('#razorPayModal').modal('hide');
            console.log("This code runs when the popup is closed");
           // location.reload()
        }
    }
  };
razorpay_options.order_id=razorpay_order_id;
razorpay_options.amount=merchant_total;
razorpay_options.name=card_holder_name;
razorpay_options.prefill.name=card_holder_name;
razorpay_options.prefill.email=email;
razorpay_options.prefill.contact=mobileno;
    if(typeof Razorpay == 'undefined'){
      setTimeout(razorpaySubmit, 200);
      if(!razorpay_submit_btn && el){
        razorpay_submit_btn = el;
        el.disabled = true;
        el.value = 'Please wait...';  
      }
    } else {
      if(!razorpay_instance){
        razorpay_instance = new Razorpay(razorpay_options);
        if(razorpay_submit_btn){
          razorpay_submit_btn.disabled = false;
          razorpay_submit_btn.value = "Pay Now";
        }
      }
      razorpay_instance.open();
    }
  }   
  //end of payment gateway razorpay 
</script>
