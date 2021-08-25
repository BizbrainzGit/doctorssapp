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
                  <h4 class="card-title">Manage Promocode </h4>
                  <div class="row grid-margin">
                    <div class="col-12">
                    	<div class="header">
                        <h5>
                          <div style="float:right"><button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#AddpromocodeModal"><i class="fa fa-plus" aria-hidden="true"></i>Add</button>
                          </div>
                        </h5>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="row clearfix">
                         <div class="col-2"></div>
                     <div class="col-8">
                     <form id="search_promocode" method="post" >
                      <div class="row clearfix" >
                                  <div class="col-sm-6 col-12">
                                   <div class="form-group">
                                      <label>promocode From Date :</label>          
                                         <div id="datepicker-popup" class="input-group date datepicker">
                                         <input type="text" class="form-control bet_start" placeholder="From Date " name="search_promocode_fromdate" id="search_promocode_fromdate">
                                         </div> 
                                   </div>
                                </div>

                                 <div class="col-sm-6 col-12">
                                   <div class="form-group">
                                      <label> promocode To Date :</label>          
                                         <div id="datepicker-popup" class="input-group date datepicker">
                                         <input type="text" class="form-control bet_end" placeholder="promocode Date " name="search_promocode_todate" id="search_promocode_todate">
                                         </div> 
                                   </div>
                                </div>
                                <div class="col-sm-12" style="text-align: center;">
                                  <button  type="button" id="searchpromocode" class="btn btn-primary">Search</button>
                                  <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                </div> 
                            </div> 

                   </form>
                       </div>
                          <div class="col-2"></div>
                        
                      </div>
                    </div>
                     
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="promocodetable" class="table table-hover">
                    
                        </table>
                      </div>
                    </div>
                  </div>


                </div>
              </div>
            </div>
          </div>
        </div>

          



  <!-- The Modal -->
  <div class="modal fade" id="EditpromocodeModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content"> 
        <div class="modal-header">
          <h4 class="modal-title">Edit Promocode details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div> 
        <div class="modal-body">
         
                    <div class="body">
                        <div id="promocode-editmsg"></div>
                        <form id="edit_promocode" method="post" >
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                      <input type="hidden" id="edit_promocode_id" name="edit_promocode_id"> 
                                        <label>Coupon Code :</label>
                                         <input type="text" class="form-control" placeholder="Coupon Code" name="edit_coupon_code" id="edit_coupon_code">
                                    </div>
                                </div>
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                      <input type="radio" name="promocode_type" id="edit_percentage_radio" onclick="edit_percentage();" />&nbsp; &nbsp;
                                        <label>Discount Percentage :</label>
                                         <input type="text" class="form-control discount" maxlength="2" placeholder="Discount Percentage" name="edit_discount_percentage" id="edit_discount_percentage" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                      <input type="radio" name="promocode_type"  id="edit_amount_radio"  onclick="edit_amount();"/>&nbsp; &nbsp;
                                        <label>Discount Amount :</label>
                                         <input type="text" class="form-control discount" placeholder="Discount Amount" name="edit_discount_amount" id="edit_discount_amount" disabled>
                                    </div>
                                </div> 
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label>Validity From :</label>         
                                      <div id="datepicker-popup" class="input-group date datepicker">
                                      <input type="text" class="form-control bet_start" placeholder="Validity From" name="edit_validity_from" id="edit_validity_from">
                                      </div> 
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label>Validity To :</label>                                         
                                      <div id="datepicker-popup" class="input-group date datepicker">
                                      <input type="text" class="form-control bet_end" placeholder="Validity To" name="edit_validity_to" id="edit_validity_to">
                                      </div>
                                   </div>
                                </div>
                               
                            </div>    
                        </div>
                     </div>
        <div class="modal-footer">
        <div class="col-sm-12" style="text-align: center;">
            <button type="button" id="updatepromocode" class="btn btn-primary">Update</button>
            <button type="reset" class="btn btn-outline-secondary">Reset</button>
        </div>
        </form>
        </div>  
      </div>
    </div>
  </div>


<!-- citymapping add model start-->


<div class="modal  fade" id="AddpromocodeModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Promocode details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
         <!-- Modal body -->
        <div class="modal-body">
         <div id="promocode-addmsg"></div>
                    <div class="body">
                        <form id="add_promocode" method="post" >
                            <div class="row clearfix">
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Coupon Code :</label>
                                         <input type="text" class="form-control" placeholder="Coupon Code" name="add_coupon_code" id="add_coupon_code">
                                    </div>
                                </div>
                               <div class="col-sm-6">
                                    <div class="form-group">
                                      <input type="radio" name="promocode_type"   value="percentage" onclick="percentage();" />&nbsp; &nbsp;
                                        <label>Discount Percentage :</label>
                                         <input type="text" class="form-control discount" placeholder="Discount Percentage" maxlength="2" name="add_discount_percentage" id="add_discount_percentage" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                      <input type="radio" name="promocode_type"  value="amount"  onclick="amount();"/>&nbsp; &nbsp;
                                        <label>Discount Amount :</label>
                                         <input type="text" class="form-control discount" placeholder="Discount Amount" name="add_discount_amount" id="add_discount_amount" disabled>
                                    </div>
                                </div> 
                                <div class="col-sm-6">
                                   <div class="form-group">
                                      <label>Validity From :</label>          
                                         <div id="datepicker-popup" class="input-group date datepicker">
                                         <input type="text" class="form-control bet_start" placeholder="Validity From" name="add_validity_from" id="add_validity_from">
                                         </div> 
                                   </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label>Validity To :</label>                                         
                                      <div id="datepicker-popup" class="input-group date datepicker">
                                         <input type="text" class="form-control bet_end" placeholder="Validity To" name="add_validity_to" id="add_validity_to">
                                      </div>
                                   </div>
                                </div>
                            </div>             
                        </div> 
                      </div> 

        <div class="modal-footer">
          <div class="col-sm-12" style="text-align: center;">
             <button  type="button" id="addpromocode" class="btn btn-primary">Save</button>
             <button type="reset" class="btn btn-outline-secondary">Reset</button>
          </div>
        </form>
      </div>
      </div>
    </div>
  </div>
<!-- citymapping add model end -->
      



<?php
include('Layouts/superadminLayout_Footer.php');
?>
<script src="/<?php echo base_url();?>assets/js/superadmin/PromocodeController.js"></script>
<script type="text/javascript">
     $("#add_validity_to").datepicker({
      todayHighlight: true,
      autoclose: true,
      startDate: '0d',
      format: 'dd-mm-yyyy'
});
     $('#add_validity_from').datepicker({
      todayHighlight: true,
      autoclose: true,
      startDate: '0d',
      format: 'dd-mm-yyyy'
});
     $("#edit_validity_from").datepicker({
      todayHighlight: true,
      autoclose: true,
      startDate: '0d',
      format: 'dd-mm-yyyy'
});
     $("#edit_validity_to").datepicker({
      todayHighlight: true,
      autoclose: true,
      startDate: '0d',
      format: 'dd-mm-yyyy'
});


$( "#search_promocode_todate" ).datepicker({
  todayHighlight: true,
    autoclose  : true,
    format: 'dd-mm-yyyy'
});

 $( "#search_promocode_fromdate" ).datepicker({
  todayHighlight: true,
    autoclose  : true,
    format: 'dd-mm-yyyy'
});

$('.bet_start').datepicker({
    autoclose: true,
    format: 'dd-mm-yy',
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
        autoclose: true
    })
    .on('changeDate', function (selected) {
        FromEndDate = new Date(selected.date.valueOf());
        FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));
        $('.bet_start').datepicker('setEndDate', FromEndDate);
    });



function amount() {
  document.getElementById("add_discount_amount").disabled = false;
   document.getElementById("add_discount_percentage").disabled = true;
}
function percentage() {
  document.getElementById("add_discount_percentage").disabled = false;
  document.getElementById("add_discount_amount").disabled = true;
}

function edit_amount() {
  document.getElementById("edit_discount_amount").disabled = false;
  document.getElementById("edit_discount_percentage").disabled = true;
}
function edit_percentage() {
  document.getElementById("edit_discount_percentage").disabled = false;
  document.getElementById("edit_discount_amount").disabled = true;
}

   </script>



  

