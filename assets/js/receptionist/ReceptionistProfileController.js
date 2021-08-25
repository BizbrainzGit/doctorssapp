


/* ====== Edit Profile  Start ===== */


ReceptionistView();
 function ReceptionistView(){
            $.ajax({
                type  : 'GET',
                url   : url+"receptionist/ReceptionistProfileController/editReceptionistProfileByid",
                async : true,
                dataType : 'json',
                headers:headers,
                success : function(result){
                 if(result.success===true){ 

        $('#receptionist_profile_data #receptionist_profile_addid').val(result.data[0].address_id);
        $('#receptionist_profile_data #receptionist_profile_userid').val(result.data[0].user_id);
        $('#receptionist_profile_data #receptionist_profile_id').val(result.data[0].id);
        $('#receptionist_profile_data #receptionist_profile_hno').val(result.data[0].house_no);
        $('#receptionist_profile_data #receptionist_profile_street').val(result.data[0].street);
        $('#receptionist_profile_data #receptionist_profile_area').val(result.data[0].area);
        $('#receptionist_profile_data #receptionist_profile_landmark').val(result.data[0].landmark);
        $('#receptionist_profile_data #receptionist_profile_city').val(result.data[0].city_id).prop("selected", true);
        $('#receptionist_profile_data #receptionist_profile_state').val(result.data[0].state_id).prop("selected", true);
        if (result.data[0].pincode==0) {
          var pincode="";
          }else{
            var pincode=result.data[0].pincode
          }
        $('#receptionist_profile_data #receptionist_profile_pincode').val(pincode);
         
         $('#receptionist_profile_data #receptionist_profile_fname').val(result.data[0].first_name);
         $('#receptionist_profile_data #receptionist_profile_lname').val(result.data[0].last_name);
         $('#receptionist_profile_data #receptionist_profile_mobileno').val(result.data[0].mobileno);
         $('#receptionist_profile_data #receptionist_profile_age').val(result.data[0].age);
         $('#receptionist_profile_data #receptionist_profile_gender').val(result.data[0].gender);
         $('#receptionist_profile_data #receptionist_profile_employe_id').val(result.data[0].username);
         // $('#receptionist_profile_data #receptionist_profile_role').val(result.data[0].role_id).prop("selected", true);
         // $('#receptionist_profile_data #receptionist_profile_status').val(result.data[0].active).prop("selected", true);

          if (result.data[0].profile_pic_path==null) {
             var image="assets/images/no_image.png";
          }else{
           
            var image=result.data[0].profile_pic_path;
          }

         $("#receptionistimage").html('<img src="'+url+image+ '" width="200px"  height="100px" alt=" photo" />');

                   }else{
                      alert('request failed', 'error');
                } 
               }
  
            });
        }

/* ====== Edit Profile End ===== */

/* ====== Update profile  start ===== */

var doctoraddform = $("#receptionist_profile_data");
doctoraddform.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
      receptionist_profile_fname:"required",
      receptionist_profile_lname:"required",
      receptionist_profile_mobileno:{required: true,number:true,minlength:10, maxlength:10},
      receptionist_profile_age:"required",
      receptionist_profile_role:"required",
      receptionist_profile_area:"required",
      receptionist_profile_street:"required",
      receptionist_profile_city :"required",
      receptionist_profile_state :"required",
      receptionist_profile_pincode:{number:true,minlength:6, maxlength:6}
      
     }
});




doctoraddform.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    onStepChanging: function (event, currentIndex, newIndex)
    {
        doctoraddform.validate().settings.ignore = ":disabled,:hidden";
        return doctoraddform.valid();
    },
    onFinishing: function (event, currentIndex)
    {
        doctoraddform.validate().settings.ignore = ":disabled";
        return doctoraddform.valid();
    },
    onFinished: function (event, currentIndex)
    {
         
    var formData = new FormData($("#receptionist_profile_data")[0] );
     $.ajax({
      type:"POST",
    url:url+"receptionist/ReceptionistProfileController/updateReceptionistProfileDetails",
    dataType: 'json',
    data:formData,
    headers:headers,
    contentType: false, 
    cache: false,      
    processData:false,
    beforeSend: function(){
    // Show image container
    $(".loader").show();
},

      success: function(result){
      
      if(result.success==true){

        $('#receptionist_profile_data-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
          $( "#receptionist_profile_data-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
        $('#receptionist_profile_data')[0].reset();
        window.setTimeout(function(){location.reload()},3000);
      
      }
      else{
        $('#receptionist_profile_data-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#receptionist_profile_data-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
     complete:function(){
    // Hide image container
    $(".loader").hide();
}, 
    
    failure: function (result){

      $('#receptionist_profile_data-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#receptionist_profile_data-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");     
    } 
         
      });

    }
});




/* ====== Update profile  end ===== */









