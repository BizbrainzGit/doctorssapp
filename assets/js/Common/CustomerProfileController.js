

customerProfileView();
 function customerProfileView(){
$.ajax({
    type: "GET",
    url:url+'customer/CustomerProfileController/editCustomerByid',
    dataType: 'json',
  success:function(result){
      if(result.success===true)
      {   
         $('#edit_customerprofile #edit_customer_userid').val(result.data[0].user_id);
         $('#edit_customerprofile #edit_customer_id').val(result.data[0].id);
         $('#edit_customerprofile #edit_customer_fname').val(result.data[0].first_name);
         $('#edit_customerprofile #edit_customer_lname').val(result.data[0].last_name);
         $('#edit_customerprofile #edit_customer_mobileno').val(result.data[0].mobileno);
         $('#edit_customerprofile #edit_customer_dob').val(result.data[0].dob);

        if(result.data[0].profile_pic_path==null){
                 var img=No_Image_Path;
         }else{
                 var img=result.data[0].profile_pic_path ;
        }
        $("#customerprofileimage").html('<img src="'+url+img+ '" width="200px"  height="100px" alt=" photo" />');

         }else{
            alert('request failed', 'error');
      }

    },
   
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }

});
// });

}

/* ====== Update customerprofile  start ===== */

$("#edit_customerprofile").validate({
     rules:{
          edit_customer_mobileno:{required: true,number:true,minlength:10, maxlength:10},
          edit_customer_lname:"required",
          edit_customer_fname:"required",
          edit_customer_mobileno:"required",

     }
 });

$("#customerprofileupdate").click(function() {
    if(!$("#edit_customerprofile").valid())
   {
     return false;
   }
   var formData = new FormData($("#edit_customerprofile")[0] );
     $.ajax({
     type:"POST",
    url:url+"customer/CustomerProfileController/updateCustomerData",
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
          $('#customerprofile-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
          $("#customerprofile-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
          $('#edit_customerprofile')[0].reset();          
      }
      else if(result.success==false){
          $('#customerprofile-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
          $( "#customerprofile-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
    complete:function(){
    // Hide image container
    $(".loader").hide();
}, 
    failure: function (result){

      $('#busdetails-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#busdetails-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");      
    } 
         
      });

});
/* ====== Update customerprofile  end ===== */











