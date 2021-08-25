

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

$(document).ready(function(){
	$("#loginForm").validate({
      rules: {
        email: {
         required: true,
          //email: true
        },
        password: {
          required: true,
          minlength: 5
        },
	  },
	  messages: {
       email: {
          required: "Please enter a username",
          minlength: "Your username must consist of at least 2 characters"
        },
        password: {
          required: "Please provide a password",
          minlength: "Your password must be at least 5 characters long"
        }
      },
      errorPlacement: function(label, element) {
        label.addClass('mt-2 text-danger');
        label.insertAfter(element);
      },
      highlight: function(element, errorClass) {
        $(element).parent().addClass('has-danger')
        $(element).addClass('form-control-danger')
      }
	});
    //
  

$('#login-button').click(function(e){
	 if(!$("#loginForm").valid())
	 {
		 return false;
	 }
	var email = $("#email").val();
	var password = $("#password").val();
	login={email:email,password:password};	
	var Login = JSON.stringify(login);
	$.ajax({
		type: "POST",
		url:url+'LoginController/login',
		data:Login,
		dataType: 'json',
		success: function(result){
      // alert(result.data.user_account_roles);
      if (result.success===true && result.data.user_account_roles!=null){
        // alert("babu");
          setTimeout('window.location.href = "'+url+'Account-Select"; ',100);
          }else  if (result.success===true){
             
      if(result.success===true && result.data.user_roles=='Super Admin')
      {     
        setTimeout('window.location.href = "'+url+'SuperAdmin-Dashboard"; ',100);
      }
      if(result.success===true && result.data.user_roles=='Admin')
      {     
        setTimeout('window.location.href = "'+url+'Admin-Dashboard"; ',100);
      }
      if(result.success==true && result.data.user_roles=='MD')
      {
       setTimeout('window.location.href = "'+url+'ManagingDirector-Dashboard"; ',100);
      }
      if(result.success==true && result.data.user_roles=='Doctor')
      {
       setTimeout('window.location.href = "'+url+'Doctor-Dashboard"; ',100);
      }
      if(result.success==true && result.data.user_roles=='Receptionist')
      {
       setTimeout('window.location.href = "'+url+'Receptionist-Dashboard"; ',100);
      }
      if(result.success==true && result.data.user_roles=='Patient')
      {
       
        setTimeout('window.location.href = "'+url+'"; ',100);
      }
      if(result.success==true && result.data.user_roles=='Laboratory')
      {
       setTimeout('window.location.href = "'+url+'Laboratory-Dashboard"; ',100);
      }
      if(result.success==true && result.data.user_roles=='Billing')
      {
       setTimeout('window.location.href = "'+url+'Billing-Dashboard"; ',100);
      }

        }

			if(result.success===false){
				alert(result.message); 
			}
		}
		
		});
});




  $('#accountchanged_selected_accountid').on('change', function() { 
      var account_selected_accountid = $("#accountchanged_selected_accountid").val();
      SwitchSelectAccount(account_selected_accountid)
  });

  $('#account_selected_accountid').on('change', function() { 
      var account_selected_accountid = $("#account_selected_accountid").val();
      SwitchSelectAccount(account_selected_accountid)
  });

 function SwitchSelectAccount(account_selected_accountid) {
       // alert(account_selected_accountid);
  var account_selected_accountid = account_selected_accountid 
   $.ajax({
    type: "POST",
    url:url+'LoginController/SelectAccount',
    data:{account_selected_accountid:account_selected_accountid},
    dataType: 'json',
    success: function(result){
         // alert(result.data);
      if(result.success===true && result.data.user_roles=='Super Admin')
      {     
        setTimeout('window.location.href = "'+url+'SuperAdmin-Dashboard"; ',100);
      }
      if(result.success===true && result.data.user_roles=='Admin')
      {     
        setTimeout('window.location.href = "'+url+'Admin-Dashboard"; ',100);
      }
      if(result.success==true && result.data.user_roles=='MD')
      {
       setTimeout('window.location.href = "'+url+'ManagingDirector-Dashboard"; ',100);
      }
      if(result.success==true && result.data.user_roles=='Doctor')
      {
       setTimeout('window.location.href = "'+url+'Doctor-Dashboard"; ',100);
      }
      if(result.success==true && result.data.user_roles=='Receptionist')
      {
       setTimeout('window.location.href = "'+url+'Receptionist-Dashboard"; ',100);
      }

      if(result.success==true && result.data.user_roles=='Patient')
      {
       setTimeout('window.location.href = "'+url+'Patient-Dashboard"; ',100);
      }

      if(result.success===false){
        alert(result.message); 
      }
    }
    
    });
};


$('#customer_forgetpassword').validate({
    rules:{
    forgotpassword_email: {required: true }
  }
  
});

$("#customerforgetpassword").click(function(){
  
  
  if(!$("#customer_forgetpassword").valid()){
    return false;
  }

  var forgotpassword_email=$("#forgotpassword_email").val();
   // alert(forgotpassword_email);
  $.ajax({
      type:"POST",
     url:url+"Forgot/forgotpassword",
      dataType : 'json',
      cache :false,
      data:{forgotpassword_email:forgotpassword_email},
      success: function(result)
      {
      if(result.success==true)
      {
       
      $('#forgotpassword-msg').hide().fadeIn('slow').delay(350).fadeOut('slow');
      $("#forgotpassword-msg").html("<div class='alert alert-success'>"+result.message+"</div>");
      $('#customer_forgetpassword')[0].reset();
      }else{
         $('#forgotpassword-msg').hide().fadeIn('slow').delay(350).fadeOut('slow');
         $("#forgotpassword-msg").html("<div class='alert alert-success'>"+result.message+"</div>");

      }
      
    },
    failure: function (result)
    {
          
      $('#forgotpassword-msg').hide().fadeIn('slow').delay(350).fadeOut('slow');
      $( "#forgotpassword-msg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ..</div>");
    }   
  });
});



$('#changepasswordForm').validate({
    rules:{
  
  old_password: {
            required: true
        },
  new_password: {
            required: true
        },
  confirm_password : {
                equalTo : '[name="new_password"]'
        }
  
  }
  
  
});


$("#cpswd_save").click(function(){
  
  if(!$("#changepasswordForm").valid()){
    return false;
  }
  
  var old_password=$("#old_password").val();
  var new_password=$("#new_password").val();
  var confirm_password=$("#confirm_password").val();
  
  $.ajax({
      type:"POST",
      url:url+"Forgot/Changepassword",
      dataType : 'json',
      cache :false,
      data: {old_password:old_password,new_password:new_password,confirm_password:confirm_password},
      success: function(result)
      {
      if(result.success==true)
      {
       $('#alert-msg').hide().fadeIn('slow').delay(350).fadeOut('slow');
      $("#alert-msg").html("<div class='alert alert-success'>"+result.message+"</div>");
      $('#changepasswordForm')[0].reset();
          
          setTimeout(function(){
          $('#changepswdModal').modal('hide');
              },900);       
      }else{

           $('#alert-msg').hide().fadeIn('slow').delay(350).fadeOut('slow');
      $("#alert-msg").html("<div class='alert alert-success'>"+result.message+"</div>");

      }
      
    },
    failure: function (result)
    {
       $('#alert-msg').hide().fadeIn('slow').delay(350).fadeOut('slow');
      $( "#alert-msg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ..</div>");
    }   
  });
});



/* ====== add  citymapping  details  start ===== */
$("#customerregister_form").validate({
     
     rules:{
        customerregister_firstname:"required",
        customerregister_lastname :"required",
        customerregister_mobilenumber:{required: true,number:true,minlength:10, maxlength:10},
        // customerregister_dateofbirth :"required",
        customerregister_email:{required: true,email: true },
        customerregister_password:"required",
        customerregister_confirmpassword: {required: true, equalTo: "#customerregister_password"}
     }
 });

$("#customerregister_save").click(function() {
  
    if(!$("#customerregister_form").valid())
   {
     return false;
   }
 
   var formData = new FormData($("#customerregister_form")[0] );
     $.ajax({
      type:"POST",
    url:url+"LoginController/saveCustomerData",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,

      success: function(result){
      
      if(result.success==true){
        $('#customerdetails-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);    
        $( "#customerdetails-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
        $('#customerregister_form')[0].reset();
         
      }
      else if(result.success===false){
        $('#customerdetails-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#customerdetails-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
    
    failure: function (result){

      $('#customerdetails-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#customerdetails-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");      
    } 




            
      });


});
/* ====== add  citymapping  details  end ===== */


$('#customer_changepasswordForm').validate({
    rules:{
  
  customer_old_password: {
            required: true
        },
  customer_new_password: {
            required: true
        },
  customer_confirm_password : {
                equalTo : '[name="customer_new_password"]'
        }
  
  }
  
  
});


$("#customer_cpswd_save").click(function(){
  
  if(!$("#customer_changepasswordForm").valid()){
    return false;
  }
  
  var customer_old_password=$("#customer_old_password").val();
  var customer_new_password=$("#customer_new_password").val();
  var customer_confirm_password=$("#customer_confirm_password").val();
   
  $.ajax({
      type:"POST",
      url:url+"LoginController/CustomerChangePassword",
      dataType : 'json',
      cache :false,
      data: {customer_old_password:customer_old_password,customer_new_password:customer_new_password,customer_confirm_password:customer_confirm_password},
      success: function(result)
      {
      if(result.success==true)
      {
       $('#alert-msg').hide().fadeIn('slow').delay(350).fadeOut('slow');
      $("#alert-msg").html("<div class='alert alert-success'>"+result.message+"</div>");
      $('#customer_changepasswordForm')[0].reset();
          
          setTimeout(function(){
          $('#customer_changepswdModal').modal('hide');
              },900);       
      }else{

           $('#alert-msg').hide().fadeIn('slow').delay(350).fadeOut('slow');
      $("#alert-msg").html("<div class='alert alert-success'>"+result.message+"</div>");

      }
      
    },
    failure: function (result)
    {
       $('#alert-msg').hide().fadeIn('slow').delay(350).fadeOut('slow');
      $( "#alert-msg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ..</div>");
    }   
  });
});




  /* change password validation */
  $("#changepasswordForm").validate({
      rules:
   {
      new_password: {
            required: true
      },
      confirm_password : {
                required: true
      },
    },
       messages:
    {
            new_password:"Please enter New Password",
            confirm_password:"Please enter the Confirm Password match with the New Password"
    }
       });  
    /* end of Change password validation */
/* Change Password Button*/
$("#changepassword-button").click(function(){
  
  if(!$("#changepasswordForm").valid()){
    return false;
  }
  var token=getUrlParameter("token");
  var new_password=$("#new_password").val();
  var confirm_password=$("#confirm_password").val();
  // alert(new_password);
  $.ajax({
      type:"POST",
      url:url+"Forgot/resetPassword/",
      dataType : 'json',
      cache :false,
      data: {newpassword:new_password,confirmpassword:confirm_password,code:token},
      success: function(result)
      {
      if(result.success==true)
      {
       $('#changepassword-msg').hide().fadeIn('slow').delay(350).fadeOut('slow');
       $("#changepassword-msg").html("<div class='alert alert-success'>"+result.message+"</div>");
       $('#changepasswordForm')[0].reset();
      }else{
        $('#changepassword-msg').hide().fadeIn('slow').delay(350).fadeOut('slow');
       $("#changepassword-msg").html("<div class='alert alert-danger'>"+result.message+"</div>");

      }
      
    },
    failure: function (result)
    {
       $('#changepassword-msg').hide().fadeIn('slow').delay(350).fadeOut('slow');
      $( "#changepassword-msg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ..</div>");
    }   
  });
});






});
