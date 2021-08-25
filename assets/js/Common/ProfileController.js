

ProfileView();

 function ProfileView(){
$.ajax({
    type: "GET",
    url:url+'ProfileController/editProfileByid',
    dataType: 'json',
    headers:headers,
    success:function(result){
      if(result.success===true)
      { 
       // alert(result.data[0].user_id);
     
        $('#edit_profiledata #edit_profile_addid').val(result.data[0].address_id);
        $('#edit_profiledata #edit_profile_userid').val(result.data[0].user_id);
        $('#edit_profiledata #edit_profile_id').val(result.data[0].id);

         $('#edit_profiledata #edit_profile_fname').val(result.data[0].first_name);
         $('#edit_profiledata #edit_profile_lname').val(result.data[0].last_name);
         $('#edit_profiledata #edit_profile_mobileno').val(result.data[0].mobileno);

       
        $('#edit_profiledata #edit_profile_hno').val(result.data[0].house_no);
        $('#edit_profiledata #edit_profile_street').val(result.data[0].street);
        $('#edit_profiledata #edit_profile_area').val(result.data[0].area);
        $('#edit_profiledata #edit_profile_landmark').val(result.data[0].landmark);
        $('#edit_profiledata #edit_profile_city').val(result.data[0].city_id).prop("selected", true);
        $('#edit_profiledata #edit_profile_state').val(result.data[0].state_id).prop("selected", true);
        if (result.data[0].pincode==0) {
          var pincode="";
          }else{
            var pincode=result.data[0].pincode
          }
        $('#edit_profiledata #edit_profile_pincode').val(pincode);
        if(result.data[0].profile_pic_path==null){
              var img_path=No_Image_Path;
        }else{
            var img_path=result.data[0].profile_pic_path;
        }
      $("#admin_profile_photo").html('<img src="'+url+img_path+ '" width="100px"  height="100px" alt="photo" />');
         
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

/* ====== Update profile  start ===== */


var profileeditform = $("#edit_profiledata");
profileeditform.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
      edit_profile_fname:"required",
      edit_profile_lname:"required",
      edit_profile_mobileno:{required: true,number:true,minlength:10, maxlength:10},
      edit_profile_street:"required",
      edit_profile_area:"required",
      edit_profile_city :"required",
      edit_profile_state :"required",
      edit_profile_pincode:{number:true,minlength:6, maxlength:6}
    }
});

profileeditform.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    onStepChanging: function (event, currentIndex, newIndex)
    {
        profileeditform.validate().settings.ignore = ":disabled,:hidden";
        return profileeditform.valid();
    },
    onFinishing: function (event, currentIndex)
    {
        profileeditform.validate().settings.ignore = ":disabled";
        return profileeditform.valid();
    },
    onFinished: function (event, currentIndex)
    {


 var formData = new FormData($("#edit_profiledata")[0] );
     $.ajax({
     type:"POST",
    url:url+"ProfileController/updateProfileDetails",
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
          $('#profile-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
          $("#profile-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");

           ProfileView();        
      }
      else if(result.success==false){
          $('#profile-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
          $( "#profile-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
    complete: function(){
    // Show image container
    $(".loader").hide();
},
    failure: function (result){

      $('#profile-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#profile-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");      
    } 
         
      });




    }
});

// Profile Upate Ends //













