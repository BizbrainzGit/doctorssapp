


/* ====== Edit Profile  Start ===== */


DoctorView();
 function DoctorView(){
            $.ajax({
                type  : 'GET',
                url   : url+"doctor/DoctorProfileController/editDoctorProfileByid",
                async : true,
                dataType : 'json',
                headers:headers,
                success : function(result){
                 if(result.success===true){ 

                  $('#doctor_profiledata #doctor_profile_addid').val(result.data[0].address_id);
                  $('#doctor_profiledata #doctor_profile_userid').val(result.data[0].user_id);
                  $('#doctor_profiledata #doctor_profile_id').val(result.data[0].id);

                   $('#doctor_profiledata #doctor_profile_fname').val(result.data[0].first_name);
                   $('#doctor_profiledata #doctor_profile_lname').val(result.data[0].last_name);
                   $('#doctor_profiledata #doctor_profile_mobileno').val(result.data[0].mobileno);
                   $('#doctor_profiledata #doctor_profile_age').val(result.data[0].age);
                   $('#doctor_profiledata #doctor_profile_gender').val(result.data[0].gender);
                   
                  $('#doctor_profiledata #doctor_profile_designation').val(result.data[0].designation);
                  $('#doctor_profiledata #doctor_profile_specialist').val(result.data[0].specialist);
                  $('#doctor_profiledata #doctor_profile_specialization').val(result.data[0].specialization_id).prop("selected", true);
                  $('#doctor_profiledata #doctor_profile_bloodgroup').val(result.data[0].blood_group);
                  $('#doctor_profiledata #doctor_profile_education').val(result.data[0].education);
                  $('#doctor_profiledata #doctor_profile_biography').val(result.data[0].biography);

                  $('#doctor_profiledata #doctor_profile_hno').val(result.data[0].house_no);
                  $('#doctor_profiledata #doctor_profile_street').val(result.data[0].street);
                  $('#doctor_profiledata #doctor_profile_subarea').val(result.data[0].sub_area);
                  $('#doctor_profiledata #doctor_profile_area').val(result.data[0].area);
                  $('#doctor_profiledata #doctor_profile_landmark').val(result.data[0].landmark);
                  $('#doctor_profiledata #doctor_profile_city').val(result.data[0].city_id).prop("selected", true);
                  $('#doctor_profiledata #doctor_profile_state').val(result.data[0].state_id).prop("selected", true);


                  if (result.data[0].pincode==0) {
                    var pincode="";
                    }else{
                      var pincode=result.data[0].pincode
                    }
                  $('#doctor_profiledata #doctor_profile_pincode').val(pincode);

                  $("#doctorimage").html('<img src="'+url+result.data[0].profile_pic_path+ '" width="200px"  height="100px" alt=" photo" />');

                   }else{
                      alert('request failed', 'error');
                } 
               }
  
            });
        }

/* ====== Edit Profile End ===== */

/* ====== Update profile  start ===== */

var doctoraddform = $("#doctor_profiledata");
doctoraddform.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
      doctor_profile_fname:"required",
      doctor_profile_lname:"required",
      doctor_profile_age:"required",
      
      doctor_profile_mobileno:{required: true,number:true,minlength:10, maxlength:10},

      doctor_profile_hno :"required",
      doctor_profile_street:"required", 
      doctor_profile_area:"required",
      doctor_profile_city :"required",
      doctor_profile_state :"required",
      doctor_profile_pincode:{number:true,minlength:6, maxlength:6},
      
      doctor_profile_designation:"required",
      doctor_profile_specialist:"required",
      doctor_profile_department:"required",
      doctor_profile_bloodgroup:"required"
      
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
         
    var formData = new FormData($("#doctor_profiledata")[0] );
     $.ajax({
      type:"POST",
    url:url+"doctor/DoctorProfileController/updateDoctorProfileDetails",
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

        $('#doctorprofiledata-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
          $( "#doctorprofiledata-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
        $('#doctor_profiledata')[0].reset();
        window.setTimeout(function(){location.reload()},3000);
      
      }
      else{
        $('#doctorprofiledata-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#doctorprofiledata-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
     complete:function(){
    // Hide image container
    $(".loader").hide();
}, 
    
    failure: function (result){

      $('#doctorprofiledata-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#doctorprofiledata-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");     
    } 
         
      });

    }
});




/* ====== Update profile  end ===== */









