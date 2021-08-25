
accountView();
 function accountView(){
            $.ajax({
                type  : 'GET',
                url   : url+"superadmin/AccountsController/SearchAccountsList",
                async : true,
                dataType : 'json',
                success : function(result){
                 if(result.success===true){
                  accountViewList(result.data);
                  }        
                }
            });
        }

function accountViewList(accountslistdata){
  if ( $.fn.DataTable.isDataTable('#accountstable')) {
         $('#accountstable').DataTable().destroy();
         }  
         $('#accountstable tbody').empty();

         var data=accountslistdata; 
         var table = $('#accountstable').DataTable({
        
         paging: true,
         searching: true,
         columns: [
      {data: 'id',title: 'S No.'},
      {data: 'account_name',title:'Account Name'},
      {data: 'no_of_doctors',title:'No. Of Doctors'},
      {data: 'dbname',title: 'Database Name'},
      {data: 'business_address',title: 'Business Address'},
      {data: 'billing_address',title: 'Billing Address'},
      {data: 'status',title: 'Status'},
      {data: null,
           'title' : 'Action',
           "sClass" : "center",
           mRender: function (data, type, row) {
    return '<button class="btn btn-info btn-md account_status_edit" data-toggle="modal" id="account_status_edit" data-target="#EditAccountstatusModal" title="Account Status"><a data-accountid="'+data.id+'" data-accountname="' +data.account_name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-pencil-box"></i> </a></button>&nbsp;<button class="btn btn-primary btn-md editaccount" id="accountdata_edit" title="Account Edit"><a data-accountid="'+data.id+'" data-accountname="' +data.account_name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-grease-pencil"></i> </a></button>&nbsp; <button class="btn btn-warning btn-md account_adminlogin" title="Account Login"><a data-accountid="'+data.id+'" data-accountname="' +data.account_name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-account"></i> </a></button>&nbsp;'
    //<button class="btn btn-danger btn-md account_delete" title="Account Delete"><a data-accountid="'+data.id+'" data-accountname="' +data.account_name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i> </a></button>&nbsp;
           } }],

           columnDefs: [{
         targets: 6,
         render: function(data, type, full, meta){
      if(type === 'display'){
        if(data == '1' ){
             data = '<img id="active" src="'+url+Active_Image_Path+'" heignt="32px" width="32px" align="center"/>' 
        } else if(data == '0' ){
             
             data = '<img id="inactive" src="'+url+Inactive_Image_Path+'" heignt="32px" width="32px" align="center"/>'
        }          
      }
          return data;
       }
     }]

  

       });

table.rows.add(data).draw();
}

$('[data-toggle="modal"]').tooltip();

$("#search_account").validate({
     
     rules:{
        // search_account_name :"required",
        // search_account_city :"required",
      
     }
 });

$("#searchaccount").click(function() {
  
    if(!$("#search_account").valid())
   {
     return false;
   }
  
   var formData = new FormData($("#search_account")[0] );
     $.ajax({
      type:"POST",
    url:url+"superadmin/AccountsController/SearchaccountList",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,
     
    beforeSend: function(){
    // Show image container
    $(".loader").show();
},

      success: function(result){
      
      if(result.success==true){
         accountViewList(result.data);
         // window.setTimeout(function(){location.reload()},3000);
            
      }
      else if(result.success===false){
        alert('Information request failed:error, Please try Again....');
      }
    },
    complete:function(){
    // Hide image container
    $(".loader").hide();
}, 
    failure: function (result){

      alert('Information request failed: error, Please try Again....');
    } 




            
      });


});




$("#showaddaccount").click(function(){
 $(".listaccount-class").hide();
 $(".addaccount-class").show();
});

$(document).on('click', '.editaccount a', function(e){

 $(".listaccount-class").hide();
 $(".addaccount-class").hide();
 $(".editaccount-class").show();
 var id= $(this).attr("data-accountid");
$.ajax({
    type: "GET",
    url:url+'superadmin/AccountsController/editAccountsByid/'+id,
    dataType: 'json',
 
  success:function(result){
      if(result.success===true)
      { 

        $('#edit_accountdata #edit_account_id').val(result.data[0].id);
        $('#edit_accountdata #edit_account_businessaddid').val(result.data[0].business_address_id);
        $('#edit_accountdata #edit_account_billingaddid').val(result.data[0].billing_address_id);

         $('#edit_accountdata #edit_account_name').val(result.data[0].account_name);
         $('#edit_accountdata #edit_account_shortname').val(result.data[0].account_shortname);
         $('#edit_accountdata #edit_account_noofdoctors').val(result.data[0].no_of_doctors);
         $('#edit_accountdata #edit_account_dbname').val(result.data[0].dbname);
    

        $('#edit_accountdata #edit_account_business_hno').val(result.data[0].house_no);
        $('#edit_accountdata #edit_account_business_street').val(result.data[0].street);
        $('#edit_accountdata #edit_account_business_area').val(result.data[0].area);
        $('#edit_accountdata #edit_account_business_landmark').val(result.data[0].landmark);
        $('#edit_accountdata #edit_account_business_city').val(result.data[0].city_id).prop("selected", true);
        $('#edit_accountdata #edit_account_business_state').val(result.data[0].state_id).prop("selected", true);
        if (result.data[0].pincode==0) {
          var pincode="";
          }else{
            var pincode=result.data[0].pincode
          }
        $('#edit_accountdata #edit_account_business_pincode').val(pincode);
         

        $('#edit_accountdata #edit_account_billing_hno').val(result.data[0].bill_house_no);
        $('#edit_accountdata #edit_account_billing_street').val(result.data[0].bill_street);
        $('#edit_accountdata #edit_account_billing_area').val(result.data[0].area);
        $('#edit_accountdata #edit_account_billing_landmark').val(result.data[0].bill_landmark);
        $('#edit_accountdata #edit_account_billing_city').val(result.data[0].bill_city_id).prop("selected", true);
        $('#edit_accountdata #edit_account_billing_state').val(result.data[0].bill_state_id).prop("selected", true);
        if (result.data[0].bill_pincode==0) {
          var pincode="";
          }else{
            var pincode=result.data[0].bill_pincode
          }
        $('#edit_accountdata #edit_account_billing_pincode').val(pincode);
         
          if (result.data[0].logo==null) {
             var image=No_Image_Path;
          }else{
           
            var image=result.data[0].logo;
          }

         $("#accountlogoimage").html('<img src="'+url+image+ '" width="200px"  height="100px" alt=" photo" />');

  

         }else{
            alert('request failed', 'error');
      }

    },
   
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }

});



});

var accounteditform = $("#edit_accountdata");
accounteditform.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
      edit_account_name:"required",
      edit_account_shortname:"required",
      edit_account_dbname:"required",
      edit_account_noofdoctors:"required",
      
      
      edit_account_business_hno:"required",
      edit_account_business_area:"required",
      edit_account_business_street:"required",
      edit_account_business_city :"required",
      edit_account_business_state :"required",
      edit_account_business_pincode:{number:true,minlength:6, maxlength:6},

      edit_account_billing_hno:"required",
      edit_account_billing_area:"required",
      edit_account_billing_street:"required",
      edit_account_billing_city :"required",
      edit_account_billing_state :"required",
      edit_account_billing_pincode:{number:true,minlength:6, maxlength:6},

      edit_account_condition:"required"
    }
});

accounteditform.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    onStepChanging: function (event, currentIndex, newIndex)
    {
        accounteditform.validate().settings.ignore = ":disabled,:hidden";
        return accounteditform.valid();
    },
    onFinishing: function (event, currentIndex)
    {
        accounteditform.validate().settings.ignore = ":disabled";
        return accounteditform.valid();
    },
    onFinished: function (event, currentIndex)
    {

    var formData = new FormData($("#edit_accountdata")[0] );
     $.ajax({
      type:"POST",
    url:url+"superadmin/AccountsController/updateAccountData",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,
    beforeSend: function(){
    // Show image container
    $(".loader").show();
},

      success: function(result){
      
      if(result.success==true){

        $('#accountdata-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
        $( "#accountdata-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
        $('#edit_accountdata')[0].reset();
        window.setTimeout(function(){location.reload()},3000);
       
      }
      else{
        $('#accountdata-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#accountdata-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
     complete:function(){
    // Hide image container
    $(".loader").hide();
}, 
    failure: function (result){

      $('#accountdata-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#accountdata-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");     
    } 
         
      });

    }
});



$(document).on('click', '.account_delete a', function(e){
   var id= $(this).attr("data-accountid");
   var account_name=$(this).attr("data-accountname");
    
    $.ajax({
    type: "GET",
    url:url+'superadmin/AccountsController/deleteAccountById/'+id,
    dataType: 'json',
     beforeSend:function(){
                   return confirm("Are you sure? Delete Account "+account_name+".");
                 },
    success:function(result){
      if(result.success==true)
      { 
    
    swal("Deleted!", "Your"+" "+ account_name +" "+"has been deleted.", "success"); 
    window.setTimeout(function(){location.reload()},3000);
   
      }else if(result.success==false){
           
           alert('request failed', 'error');
      }

    },
 
  fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }


});

// }else{
//     swal("Cancelled", "Your imaginary file is safe :)", "error");
//   }

        
//     });

    

    });
 



/* ====== account delete end ===== */


var accountaddform = $("#add_accountdata");
accountaddform.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
      add_account_name:"required",
      add_account_shortname:"required",
      add_account_dbname:"required",
      add_account_noofdoctors:"required",
      
      add_account_fname:"required",
      add_account_lname:"required",
      add_account_mobileno:{required: true,number:true,minlength:10, maxlength:10},

      add_account_email:{required: true,email: true },
      add_account_password:"required",
      add_account_cpassword: {required: true, equalTo: "#add_account_password"},

      add_account_role:"required",
      
      add_account_business_hno:"required",
      add_account_business_area:"required",
      add_account_business_street:"required",
      add_account_business_city :"required",
      add_account_business_state :"required",
      add_account_business_pincode:{number:true,minlength:6, maxlength:6},

      add_account_billing_hno:"required",
      add_account_billing_area:"required",
      add_account_billing_street:"required",
      add_account_billing_city :"required",
      add_account_billing_state :"required",
      add_account_billing_pincode:{number:true,minlength:6, maxlength:6},

      add_account_condition:"required"
      
       
      

    }
});
accountaddform.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    onStepChanging: function (event, currentIndex, newIndex)
    {
        accountaddform.validate().settings.ignore = ":disabled,:hidden";
        return accountaddform.valid();
    },
    onFinishing: function (event, currentIndex)
    {
        accountaddform.validate().settings.ignore = ":disabled";
        return accountaddform.valid();
    },
    onFinished: function (event, currentIndex)
    {
         
    var formData = new FormData($("#add_accountdata")[0] );
     $.ajax({
      type:"POST",
    url:url+"superadmin/AccountsController/saveAccountData",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,
beforeSend: function(){
    // Show image container
    $(".loader").show();
},

      success: function(result){
      
      if(result.success==true){

        $('#accountdata-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
          $( "#accountdata-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
        $('#add_accountdata')[0].reset();
        window.setTimeout(function(){location.reload()},3000);
      
      }
      else{
        $('#accountdata-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#accountdata-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
     complete:function(){
    // Hide image container
    $(".loader").hide();
}, 
    
    failure: function (result){

      $('#accountdata-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#accountdata-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");     
    } 
         
      });

    }
});




$(document).on('click', '.account_status_edit a', function(e){
 var id= $(this).attr("data-accountid");
 $.ajax({
    type: "GET",
    url:url+'superadmin/AccountsController/editAccountStatusByid/'+id,
    dataType: 'json',
 
  success:function(result){
      if(result.success===true)
      { 
        
        $('#account_status_change_form #account_status_id').val(id);

        if (result.data[0].status==1) {
          var data="Are you sure you want to Deactivate The Account?";
           $('#activestatusmsg').html(data);
           $('#account_status_change_form #account_status_change').val(0);

        }else   if (result.data[0].status==0) {
          var data="Are you sure you want to Activate The Account?";
           $('#activestatusmsg').html(data);
           $('#account_status_change_form #account_status_change').val(1);
        }
       
    
       }else{
            alert('request failed', 'error');
      }

    },
   
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }


});

});



$("#accountupdatestatus").click(function(){
    if(!$("#account_status_change_form").valid())
   {
     return false;
   }
  var formData = new FormData($("#account_status_change_form")[0] );
  // alert("hello");
   $.ajax({
    type:"POST",
    url:url+"superadmin/AccountsController/updateAccountStatusByid",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,
beforeSend: function(){
    // Show image container
    $(".loader").show();
},
 success: function(result){
      
      if(result.success===true){
          $('#accountstatus-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);    
          $("#accountstatus-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
          $("#account_status_change_form")[0].reset();
          setTimeout(function(){
                 $('#EditAccountstatusModal').modal('hide');
                }, 5000);
          
         accountView();

      }
  else if(result.success===false){
        $('#accountstatus-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#accountstatus-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
    complete: function(){
    // Show image container
    $(".loader").hide();
},
    failure: function (result){

      $('#accountstatus-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#accountstatus-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");      
    } 
         
      });


});



// Login into Admin Role Start //
 
$(document).on('click', '.account_adminlogin a', function(e){
      var id= $(this).attr("data-accountid");
      var account_name=$(this).attr("data-accountname");
      $.ajax({
              type: "GET",
              url:url+'superadmin/AccountsController/loginAccountById/'+id,
              dataType: 'json',
              beforeSend:function(){
                   return confirm("Are you sure? Login into "+account_name+".");
                 },
              success:function(result){
                if(result.success==true)
                { 
                    if(result.success===true && result.data.user_roles=='Admin')
                    {     
                         setTimeout('window.location.href = "'+url+'Admin-Dashboard"; ',100);
                    }
                }else if(result.success==false){
                     alert('request failed', 'error');
                }
              },
            fail:function(result){
                alert('Information request failed: ' + textStatus, 'error');
              }

      });

    });
 


// Login into Admin Role End // 




