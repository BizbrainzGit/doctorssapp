<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/adminLayout_Header.php');
?>

<div class="main-panel">
   <div class="modal fade" id="EditEmployeesstatusModal">
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
                      <div id="citymapping-editmsg"></div>
                        <form id="employees_status_change_form" method="post" >
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                      <input type="hidden" id="employees_status_id" name="employees_status_id"> 
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                  <div class="form-group">
                                    <h4 id="activestatusmsg"></h4>
                                      <input type="hidden" id="employees_status_change" name="employees_status_change">
                                  </div>
                                </div>
                            </div>
                    </div>
                </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <div class="col-sm-12" style="text-align: center;">
            <button type="button" id="employeesupdatestatus" class="btn btn-primary">Yes</button>
            <button type="reset" class="btn btn-outline-secondary">No</button>
          </div>
         </form>
        </div>
      </div>
    </div>
  </div>

<div class="content-wrapper listemployees-class" id="">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Users List  <div style="float:right"><button type="button" class="btn btn-info btn-sm" id="showaddemployees"><i class="fa fa-plus" aria-hidden="true"></i>Add</button></div></h4>
                    <div class="row grid-margin">
                      <div class="col-12">
                        <div class="header"></div>
                      </div>
                     
                      <div class="col-2"></div>
                      <div class="col-8">
                      <form id="search_employee" method="post" >
                      <div class="row clearfix" >
                               <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>User Name:</label>
                                       <input type="text" class="form-control"  placeholder="Enter User Name" name="search_employee_name" id="search_employee_name">
                                    </div>
                                </div>

                                <!-- <div class="col-sm-6">
                                   <div class="form-group">
                                      <label>  Mobile Number :</label>          
                                         <input type="text" class="form-control" placeholder="Mobile Number " name="search_employee_mobileno" id="search_employee_mobileno">
                                         
                                   </div>
                                </div> -->

                                <!-- <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>City Name :</label>
                                        <select class="form-control" name="search_employee_city" id="search_employee_city">
                                       </select>
                                    </div>
                                </div> -->
                                
                                  <div class="col-sm-6">
                                   <div class="form-group">
                                      <label> Role :</label> 
                                         <select class="form-control" name="search_employee_designation" id="search_employee_designation" style="width: 100%;">
                                       </select>       
                                   </div>
                                </div>
                                 
                                <div class="col-sm-12" style="text-align: center;">
                                  <button  type="button" id="searchemployee" class="btn btn-primary">Search</button>
                                  <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                </div> 
                            </div> 

                   </form>
                       </div>
                          <div class="col-2"></div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="employeestable" class="table table-hover">
                    
                        </table>
                      </div>
                    </div>
            
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="content-wrapper addemployees-class" style="display: none;" >
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Users Details
                 <a href="/<?php echo base_url();?>Admin-Manage-Users"> <div style="float:right"><button type="button" class="btn btn-info btn-sm"> Back </button></div></a> </h4>

                  <form id="add_employeesdata"  method="post" enctype="multipart/form-data" >
                    <div>
                       <h3>Basic Details</h3>
                      <section>
                        <h3>Basic Details</h3>
                      <div class="row clearfixed">

                        <div class="col-sm-6 col-12 form-group">
                          <label>First Name <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " placeholder="Person Name" name="add_employees_fname" id="add_employees_fname">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Last Name <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " placeholder="Person Name" name="add_employees_lname" id="add_employees_lname">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Mobile Number <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" maxlength="10" placeholder="Mobile Number" name="add_employees_mobileno" id="add_employees_mobileno">
                        </div>
                       
                        <div class="col-sm-6 col-12 form-group">
                          <label> Date Of Birth <span class="requried_class">*</span></label>
                            <div id="datepicker-popup" class="input-group date datepicker">
                             <input type="text" class="form-control" placeholder="Date Of Birth" name="add_employees_dob" id="edit_employees_dob">
                            </div>
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Gender <span class="requried_class">*</span></label>
                          <select class="form-control" name="add_employees_gender" id="add_employees_gender">
                             <option value="">Select Gender</option>
                             <option value="Male">Male</option>
                             <option value="Female">Female</option>
                          </select>
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Email  <span class="requried_class">*</span></label>
                          <input type="email" class="form-control " placeholder="Email" name="add_employees_email" id="add_employees_email">
                        </div>
                        
                        <div class="col-sm-6 col-12 form-group">
                          <label>Password <span class="requried_class">*</span></label>
                          <input type="password" class="form-control" placeholder="Password" name="add_employees_password" id="add_employees_password">
                        </div>    
                        
                         <div class="col-sm-6 col-12 form-group">
                          <label>Confirmed Password <span class="requried_class">*</span></label>
                          <input type="password" class="form-control" placeholder="Password" name="add_employees_cpassword" id="add_employees_cpassword">
                        </div> 
                        
    
                        <div class="col-sm-6 col-12 form-group">
                          <label>Photo <span class="requried_class">*</span></label>
                          <input type="file" class="form-control" name="add_employees_photo" id="add_employees_photo">
                          <span style="color: red">File must be in the form of Below 1 MB Only...</span>
                        </div>
                         
                         <div class="col-sm-6 col-12 form-group">
                          <label>Designation <span class="requried_class">*</span></label>
                          <select class="form-control " name="add_employees_role" id="add_employees_role">
                             
                          </select>
                        </div>

                     
                      
                      </div>
                      </section>

                      <h3>Address Details</h3>
                      <section>
                        <h3>Address Details</h3>
                        <div class="row clearfixed">
                        <div class="col-sm-6 col-12 form-group">
                          <label>Building No/House No</label>
                          <input type="text" class="form-control " placeholder="Building No/House No" name="add_employees_hno" id="add_employees_hno">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Street <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " placeholder="Street Name" name="add_employees_street" id="add_employees_street">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Area <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " placeholder="Area" name="add_employees_area" id="add_employees_area">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Landmark</label>
                          <input type="text" class="form-control " placeholder="Landmark" name="add_employees_landmark" id="add_employees_landmark">
                        </div>
                        
                        <div class="col-sm-6 col-12 form-group">
                          <label>State <span class="requried_class">*</span></label>
                          <select class="form-control " name="add_employees_state" id="add_employees_state" onchange="getCityByState('#add_employees_city',this);" >
                          </select>
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>City <span class="requried_class">*</span></label>
                           <select class="form-control " name="add_employees_city" id="add_employees_city" >
                          </select>
                        </div>
                      
                       <div class="col-sm-6 col-12 form-group">
                          <label>Pincode <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " maxlength="6" placeholder="PINCODE" name="add_employees_pincode" id="add_employees_pincode">
                        </div>
                      </div>
                      </section>

                     <h3>Final Submit</h3>
                      <section>
                        <h3> Final Submit </h3>
                         <div class="form-check">
                          <label class="form-check-label">
                            <input class="checkbox" type="checkbox" name="add_employees_condition" id="add_employees_condition">
                            I Agree With The Terms and Conditions.
                          </label>
                          <div id="employeesdata-addmsg"></div>
                        </div>
                      </section>

                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
         
        </div>
       

        <div class="content-wrapper editemployees-class" style="display: none;" >
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit <span id="edit_employeesname_head"></span>
                 <a href="/<?php echo base_url();?>Admin-Manage-Users"> <div style="float:right"><button type="button" class="btn btn-info btn-sm"> Back </button></div></a> </h4>
                         
                  <form id="edit_employeesdata"  method="post" enctype="multipart/form-data" >
                    <div>
                            <h3>Basic Details</h3>
                      <section>
                        <h3>Basic Details</h3>
                      <div class="row clearfixed">
                              <input type="hidden" id="edit_employees_id" name="edit_employees_id">
                              <input type="hidden" id="edit_employees_addid" name="edit_employees_addid">
                              <input type="hidden" id="edit_employees_userid" name="edit_employees_userid">

                        <div class="col-sm-6 col-12 form-group">
                          <label>First Name <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " placeholder="Person Name" name="edit_employees_fname" id="edit_employees_fname">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Last Name <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " placeholder="Person Name" name="edit_employees_lname" id="edit_employees_lname">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Mobile Number <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" maxlength="10" placeholder="Mobile Number" name="edit_employees_mobileno" id="edit_employees_mobileno">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label> Date Of Birth <span class="requried_class">*</span></label>
                            <div id="datepicker-popup" class="input-group date datepicker">
                             <input type="text" class="form-control" placeholder="Date Of Birth" name="edit_employees_dob" id="edit_employees_dob">
                            </div>
                        </div>
                        
                        <div class="col-sm-6 col-12 form-group">
                          <label>Gender <span class="requried_class">*</span></label>
                          <select class="form-control" name="edit_employees_gender" id="edit_employees_gender">
                             <option value="">Select Gender</option>
                             <option value="Male">Male</option>
                             <option value="Female">Female</option>
                          </select>
                        </div>

                         
                        <div class="col-sm-6 col-12 form-group">
                         <div id="employeesimage"></div>
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Photo <span class="requried_class">*</span></label>
                          <input type="file" class="form-control" name="edit_employees_photo" id="edit_employees_photo">
                        </div>
                       <div class="col-sm-6 col-12 form-group">
                          <label>Designation <span class="requried_class">*</span></label>
                          <select class="form-control" name="edit_employees_role" id="edit_employees_role">
                          </select>
                        </div>
                      </div>

                      </section>

                      <h3>Address Details</h3>
                      <section>
                        <h3>Address Details</h3>
                        <div class="row clearfixed">
                        <div class="col-sm-6 col-12 form-group">
                          <label>Building No/House No</label>
                          <input type="text" class="form-control " placeholder="Building No/House No" name="edit_employees_hno" id="edit_employees_hno">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Street <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " placeholder="Street Name" name="edit_employees_street" id="edit_employees_street">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Area <span class="requried_class">*</span></label>
                          <input type="text" class="form-control " placeholder="Area" name="edit_employees_area" id="edit_employees_area">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Landmark</label>
                          <input type="text" class="form-control " placeholder="Landmark" name="edit_employees_landmark" id="edit_employees_landmark">
                        </div>
                        

                         <div class="col-sm-6 col-12 form-group">
                          <label>State <span class="requried_class">*</span></label>
                          <select class="form-control" name="edit_employees_state" id="edit_employees_state" onchange="getCityByState('#edit_employees_city',this)">
                          </select>
                        </div>
                        
                        <div class="col-sm-6 col-12 form-group">
                          <label>City <span class="requried_class">*</span></label>
                           <select class="form-control" name="edit_employees_city" id="edit_employees_city" >
                          </select>
                        </div>

                       

                        <div class="col-sm-6 col-12 form-group">
                          <label>Pincode <span class="requried_class">*</span></label>
                          <input type="text" class="form-control" maxlength="6" placeholder="PINCODE" name="edit_employees_pincode" id="edit_employees_pincode">
                        </div>
                      </div>
                      </section>

                     <h3>Final Submit</h3>
                      <section>
                        <h3> Final Submit </h3>
                         <div class="form-check">
                          <label class="form-check-label">
                            <input class="checkbox" type="checkbox" name="edit_employees_condition" id="edit_employees_condition">
                            I Agree With The Terms and Conditions.
                          </label>
                          <div id="employeesdata-editmsg"></div>
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
include('Layouts/adminLayout_Footer.php');
?>

<script src="/<?php echo base_url();?>assets/js/Common/EmployeesController.js" type="text/javascript"></script>

<script type="text/javascript">
  
  getDesignation("#search_employee_designation");
  getDesignation("#add_employees_role");
  getDesignation("#edit_employees_role");

  getState("#add_employees_state");
  getState("#edit_employees_state");

  getCityByState('#edit_employees_city',0)

</script>

<script type="text/javascript">
     $( "#edit_employees_dob" ).datepicker({
      todayHighlight: true,
      autoclose  : true,
      endDate  : '0d',
      Format : 'dd-mm-yy'
  });

   $( "#add_employees_dob" ).datepicker({
      todayHighlight: true,
      autoclose  : true,
      endDate  : '0d',
      Format : 'dd-mm-yy'
  });   

</script>