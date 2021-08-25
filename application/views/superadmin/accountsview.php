<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/superadminLayout_Header.php');
?>

  <div class="main-panel">


<div class="modal fade" id="EditAccountstatusModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Change Status</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
        <!-- Modal body -->
        <div class="modal-body">
                    <div class="body">
                      <div id="accountstatus-editmsg"></div>
                        <form id="account_status_change_form" method="post" >
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                      <input type="hidden" id="account_status_id" name="account_status_id"> 
                                       
                                    </div>
                                </div>
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                      <h4 id="activestatusmsg"></h4>
                                        <input type="hidden" id="account_status_change" name="account_status_change">
                                    </div>
                                </div>
                            </div>
            
                    </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
      <div class="col-sm-12" style="text-align: center;">
          <button type="button" id="accountupdatestatus" class="btn btn-primary">Yes</button>
          <button type="reset" class="btn btn-outline-secondary">No</button>
      </div>
      </form>
        </div>
      </div>
    </div>
  </div>





<div class="content-wrapper listaccount-class" id="">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Accounts List <div style="float:right"><button type="button" class="btn btn-info btn-sm" id="showaddaccount"><i class="fa fa-plus" aria-hidden="true"></i>Add</button></div></h4>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="accountstable" class="table table-hover">
                    
                        </table>
                      </div>
                    </div>
            
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>




        <div class="content-wrapper addaccount-class" style="display: none;" >
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Account Details
                 <a href="/<?php echo base_url();?>SuperAdmin-Manage-Accounts"> <div style="float:right"><button type="button" class="btn btn-info btn-sm"> Back </button></div></a> </h4>

                  <form id="add_accountdata"  method="post" enctype="multipart/form-data" >
                    <div>
                       <h3>Account Details</h3>
                      <section>
                        <!-- <h3>Basic Details</h3> -->
                      <div class="row clearfixed">

                        <div class="col-sm-6 col-12 form-group">
                          <label>Account Name <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" placeholder="Account Name" name="add_account_name" id="add_account_name">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Account Short Name <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " placeholder="Account Short Name" name="add_account_shortname" id="add_account_shortname">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Database name <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" placeholder="Database name" name="add_account_dbname" id="add_account_dbname">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>No. Of Doctors <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" placeholder="No. Of Doctors" name="add_account_noofdoctors" id="add_account_noofdoctors">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Logo </label>
                          <input type="file" class="form-control" name="add_account_logo" id="add_account_logo">
                          <span style="color: red">File must be in the form of Below 1 MB Only...</span>
                        </div>

                      </div>
                     
                      <h3>Admin Details</h3>
                      <div class="row clearfixed">
                        <div class="col-sm-6 col-12 form-group">
                          <label>First Name <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " placeholder="First Name" name="add_account_fname" id="add_account_fname">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Last Name <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" placeholder="Last Name" name="add_account_lname" id="add_account_lname">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Mobile Number <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" maxlength="10" placeholder="Mobile Number" name="add_account_mobileno" id="add_account_mobileno">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Email <span class="requried_class">*</span></label>
                          <input type="email" class="form-control" placeholder="Email" name="add_account_email" id="add_account_email">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Password <span class="requried_class">*</span></label>
                          <input type="password" class="form-control" placeholder="Password" name="add_account_password" id="add_account_password">
                        </div>
                         <div class="col-sm-6 col-12 form-group">
                          <label>Confirmed Password <span class="requried_class">*</span></label>
                          <input type="password" class="form-control" placeholder="Password" name="add_account_cpassword" id="add_account_cpassword">
                        </div>
                      </div>

                      </section>

                      <h3>Business Address Details</h3>
                      <section>
                        <h3>Business Address Details</h3>
                        <div class="row clearfixed">
                        <div class="col-sm-6 col-12 form-group">
                          <label>Building No/House No <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " placeholder="Building No/House No" name="add_account_business_hno" id="add_account_business_hno">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Street <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " placeholder="Street Name" name="add_account_business_street" id="add_account_business_street">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Area <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " placeholder="Area" name="add_account_business_area" id="add_account_business_area">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Landmark</label>
                          <input type="text" class="form-control " placeholder="Landmark" name="add_account_business_landmark" id="add_account_business_landmark">
                        </div>
                        
                        <div class="col-sm-6 col-12 form-group">
                          <label>State <span class="requried_class">*</span></label>
                          <select class="form-control " name="add_account_business_state" id="add_account_business_state" onchange="getCityByState('#add_account_business_city',this)"></select>
                        </div>
                        
                        <div class="col-sm-6 col-12 form-group">
                          <label>City <span class="requried_class">*</span></label>
                          <select class="form-control " name="add_account_business_city" id="add_account_business_city" ></select>
                         </div>
                        
                        <div class="col-sm-6 col-12 form-group">
                          <label>Pincode <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " maxlength="6" placeholder="Pincode" name="add_account_business_pincode" id="add_account_business_pincode">
                        </div>

                      </div>
                      </section>
                      <h3>Billing Address Details</h3>
                      <section>
                        <h3>Billing Address Details</h3>
                        <div class="row clearfixed">
                        <div class="col-sm-6 col-12 form-group">
                          <label>Building No/House No <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " placeholder="Building No/House No" name="add_account_billing_hno" id="add_account_billing_hno">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Street <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " placeholder="Street Name" name="add_account_billing_street" id="add_account_billing_street">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Area <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " placeholder="Area" name="add_account_billing_area" id="add_account_billing_area">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Landmark </label>
                          <input type="text" class="form-control " placeholder="Landmark" name="add_account_billing_landmark" id="add_account_billing_landmark">
                        </div>
                        
                        <div class="col-sm-6 col-12 form-group">
                          <label>State <span class="requried_class">*</span></label>
                          <select class="form-control " name="add_account_billing_state" id="add_account_billing_state" onchange="getCityByState('#add_account_billing_city',this)">
                          </select>
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>City <span class="requried_class">*</span></label>
                          <select class="form-control " name="add_account_billing_city" id="add_account_billing_city"></select>
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Pincode <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " maxlength="6" placeholder="Pincode" name="add_account_billing_pincode" id="add_account_billing_pincode">
                        </div>

                      </div>
                      </section>
                     <h3>Final Submit</h3>
                      <section>
                        <h3> Final Submit </h3>
                         <div class="form-check">
                          <label class="form-check-label">
                            <input class="checkbox" type="checkbox" name="add_account_condition" id="add_account_condition">
                            I Agree With The Terms and Conditions.
                          </label>
                          <div id="accountdata-addmsg"></div>
                        </div>

                      </section>

                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
         
        </div>
       

        <div class="content-wrapper editaccount-class" style="display: none;" >
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit <span id="edit_accountname_head"></span>
                 <a href="/<?php echo base_url();?>SuperAdmin-Manage-Accounts"> <div style="float:right"><button type="button" class="btn btn-info btn-sm"> Back </button></div></a> </h4>
                         
                  <form id="edit_accountdata"  method="post" enctype="multipart/form-data" >
                                        <div>
                       <h3>Account Details</h3>
                      <section>
                        <!-- <h3>Basic Details</h3> -->
                      <div class="row clearfixed">
                         <input type="hidden" name="edit_account_id" id="edit_account_id">
                         <input type="hidden" name="edit_account_businessaddid" id="edit_account_businessaddid">
                         <input type="hidden" name="edit_account_billingaddid" id="edit_account_billingaddid">
                        <div class="col-sm-6 col-12 form-group">
                          <label>Account Name <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" placeholder="Account Name" name="edit_account_name" id="edit_account_name">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Account Short Name <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " placeholder="Account Short Name" name="edit_account_shortname" id="edit_account_shortname">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>No. Of Doctors <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" placeholder="No. Of Doctors" name="edit_account_noofdoctors" id="edit_account_noofdoctors">
                        </div>
                        
                        <div class="col-sm-6 col-12 form-group">
                         <div id="accountlogoimage"></div>
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Logo </label>
                          <input type="file" class="form-control" name="edit_account_logo" id="edit_account_logo">
                          <span style="color: red">File must be in the form of Below 1 MB Only...</span>
                        </div>

                      </div>

                      </section>

                      <h3>Business Address Details</h3>
                      <section>
                        <h3>Business Address Details</h3>
                        <div class="row clearfixed">
                        <div class="col-sm-6 col-12 form-group">
                          <label>Building No/House No <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" placeholder="Building No/House No" name="edit_account_business_hno" id="edit_account_business_hno">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Street <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" placeholder="Street Name" name="edit_account_business_street" id="edit_account_business_street">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Area <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" placeholder="Area" name="edit_account_business_area" id="edit_account_business_area">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Landmark</label>
                          <input type="text" class="form-control" placeholder="Landmark" name="edit_account_business_landmark" id="edit_account_business_landmark">
                        </div>
                        
                        <div class="col-sm-6 col-12 form-group">
                          <label>State <span class="requried_class">*</span></label>
                          <select class="form-control " name="edit_account_business_state" id="edit_account_business_state" onchange="getCityByState('#edit_account_business_city',this)">
                          </select>
                        </div>
                        
                        <div class="col-sm-6 col-12 form-group">
                          <label>City <span class="requried_class">*</span></label>
                           <select class="form-control " name="edit_account_business_city" id="edit_account_business_city" >
                          </select>
                        </div>
                        

                        <div class="col-sm-6 col-12 form-group">
                          <label>Pincode <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" maxlength="6" placeholder="PINCODE" name="edit_account_business_pincode" id="edit_account_business_pincode">
                        </div>

                      </div>
                      </section>
                      <h3>Billing Address Details</h3>
                      <section>
                        <h3>Billing Address Details</h3>
                        <div class="row clearfixed">
                        <div class="col-sm-6 col-12 form-group">
                          <label>Building No/House No <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " placeholder="Building No/House No" name="edit_account_billing_hno" id="edit_account_billing_hno">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Street <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " placeholder="Street Name" name="edit_account_billing_street" id="edit_account_billing_street">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Area <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " placeholder="Area" name="edit_account_billing_area" id="edit_account_billing_area">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Landmark</label>
                          <input type="text" class="form-control " placeholder="Landmark" name="edit_account_billing_landmark" id="edit_account_billing_landmark">
                        </div>
                        
                        <div class="col-sm-6 col-12 form-group">
                          <label>State <span class="requried_class">*</span></label>
                          <select class="form-control " name="edit_account_billing_state" id="edit_account_billing_state" onchange="getCityByState('#edit_account_billing_city',this)"></select>
                        </div>
                        
                        <div class="col-sm-6 col-12 form-group">
                          <label>City <span class="requried_class">*</span></label>
                          <select class="form-control " name="edit_account_billing_city" id="edit_account_billing_city"></select>
                        </div>
                        
                         <div class="col-sm-6 col-12 form-group">
                          <label>Pincode <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " maxlength="6" placeholder="PINCODE" name="edit_account_billing_pincode" id="edit_account_billing_pincode">
                        </div>
                      </div>
                      </section>

                     <h3>Final Submit</h3>
                      <section>
                        <h3> Final Submit </h3>
                         <div class="form-check">
                          <label class="form-check-label">
                            <input class="checkbox" type="checkbox" name="edit_account_condition" id="edit_account_condition">
                            I Agree With The Terms and Conditions.
                          </label>
                          <div id="accountdata-editmsg"></div>
                        </div>

                      </section>
                      
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

 <script src="/<?php echo base_url();?>assets/js/superadmin/AccountsController.js"></script>  

 <script type="text/javascript">

  getState("#add_account_business_state");
  getState("#edit_account_business_state");

  getCityByState('#add_account_business_city',0);
  getCityByState('#edit_account_business_city',0);

  getState("#add_account_billing_state");
  getState("#edit_account_billing_state");

 getCityByState('#add_account_billing_city',0);
 getCityByState('#edit_account_billing_city',0);
  
</script>