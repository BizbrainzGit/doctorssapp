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
                  <h4 class="card-title">Manage Payment Mode</h4>
                  <div class="row grid-margin">
                    <div class="col-12">
                      <div class="header">
                        <h5>
                          <div style="float:right"><button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#AddpaymentmodeModal"><i class="fa fa-plus" aria-hidden="true"></i>Add</button>
                          </div>
                        </h5>
                      </div>
                    </div>
               
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="paymentmodetable" class="table table-hover">
                    
                        </table>
                      </div>
                    </div>
                  </div>


                </div>
              </div>
            </div>
          </div>
        </div>



<div class="modal  fade " id="AddpaymentmodeModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content ">  
        
        <div class="modal-header col-sm-12">
          <h4 class="modal-title">Add Payment Mode </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
         
        <div class="modal-body ">
         <div id="paymentmodedata-addmsg"></div>
                    <div class="body">
                        <form id="add_paymentmodedata" method="post" >
                                <div class="row clearfix">
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                      <label>Payment Mode <span class="requried_class">*</span></label>
                                      <input type="text" class="form-control" placeholder="Payment Mode" name="add_paymentmode_name" id="add_paymentmode_name">
                                    </div> 
                                  </div>
                            </div>             
                       

        <div class="modal-footer">
          <div class="col-sm-12" style="text-align: center;">
             <button  type="button" id="addpaymentmode" class="btn btn-primary">Save</button>
             <button type="reset" class="btn btn-outline-secondary">Reset</button>
          </div>
        </form>
      </div>
      </div>
    </div>
  </div>
 </div>
   </div>
   
<!-- Payment Mode add model end -->

<div class="modal  fade" id="EditpaymentmodeModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Payment Mode </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
         <!-- Modal body -->
        <div class="modal-body">
         <div id="paymentmodedata-editmsg"></div>
                    <div class="body">
                        <form id="edit_paymentmodedata" method="post" >
                            <div class="row clearfix">
                                <input type="hidden" id="edit_paymentmode_id" name="edit_paymentmode_id">
                               <div class="col-sm-12">
                                  <div class="form-group">
                                    <label>Payment Mode <span class="requried_class">*</span></label>
                                    <input type="text" class="form-control" placeholder="Payment Mode" name="edit_paymentmode_name" id="edit_paymentmode_name">
                                  </div> 
                                </div>
                              
                              </div>
                            </div>             
                       <!--  </div> 
                      </div>  -->

        <div class="modal-footer">
          <div class="col-sm-12" style="text-align: center;">
             <button type="button" id="updatepaymentmode" class="btn btn-primary">Update</button>
            <button type="reset" class="btn btn-outline-secondary">Reset</button>
          </div>
        </form>
      </div>
      </div>
    </div>
  </div>
 </div>



<?php
include('Layouts/superadminLayout_Footer.php');
?>
<script src="/<?php echo base_url();?>assets/js/superadmin/PaymentmodeController.js"></script>