


/* ====== Edit Profile  Start ===== */


PatientView();
 function PatientView(){
            $.ajax({
                type  : 'GET',
                url   : url+"patient/PatientProfileController/editPatientProfileByid",
                async : true,
                dataType : 'json',
                headers:headers,
                success : function(result){
                 if(result.success===true){ 
                  
        $('#patient_profiledata #patient_profile_addid').val(result.data[0].address_id);
        $('#patient_profiledata #patient_profile_userid').val(result.data[0].user_id);
        $('#patient_profiledata #patient_profile_id').val(result.data[0].id);

         $('#patient_profiledata #patient_profile_fname').val(result.data[0].first_name);
         $('#patient_profiledata #patient_profile_lname').val(result.data[0].last_name);
         $('#patient_profiledata #patient_profile_mobileno').val(result.data[0].mobileno);
         $('#patient_profiledata #patient_profile_age').val(result.data[0].age);
         $('#patient_profiledata #patient_profile_gender').val(result.data[0].gender);

         $('#patient_profiledata #patient_profile_height').val(result.data[0].height);
         $('#patient_profiledata #patient_profile_weight').val(result.data[0].weight);
         $('#patient_profiledata #patient_profile_bloodgroup').val(result.data[0].blood_group);
         $('#patient_profiledata #patient_profile_bloodprusser').val(result.data[0].blood_prusser);
         $('#patient_profiledata #patient_profile_pulse').val(result.data[0].pulse);
         $('#patient_profiledata #patient_profile_allergy').val(result.data[0].allergy);
         $('#patient_profiledata #patient_profile_diet').val(result.data[0].diet);

        $('#patient_profiledata #patient_profile_hno').val(result.data[0].house_no);
        $('#patient_profiledata #patient_profile_street').val(result.data[0].street);
        // $('#patient_profiledata #patient_profile_subarea').val(result.data[0].sub_area);
        $('#patient_profiledata #patient_profile_area').val(result.data[0].area);
        $('#patient_profiledata #patient_profile_landmark').val(result.data[0].landmark);
        $('#patient_profiledata #patient_profile_city').val(result.data[0].city_id).prop("selected", true);
        $('#patient_profiledata #patient_profile_state').val(result.data[0].state_id).prop("selected", true);
        if (result.data[0].pincode==0) {
          var pincode="";
          }else{
            var pincode=result.data[0].pincode
          }

        $('#patient_profiledata #patient_profile_pincode').val(pincode);
         

                   }else{
                      alert('request failed', 'error');
                } 
               }
  
            });
        }

/* ====== Edit Profile End ===== */

/* ====== Update profile  start ===== */

var patientaddform = $("#patient_profiledata");
patientaddform.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
      patient_profile_fname:"required",
      patient_profile_lname:"required",
      patient_profile_age:"required",
      patient_profile_gender:"required",
      patient_profile_mobileno:{required: true,number:true,minlength:10, maxlength:10},
      patient_profile_hno :"required",
      patient_profile_street:"required", 
      patient_profile_area:"required",
      patient_profile_city :"required",
      patient_profile_state :"required",
      patient_profile_pincode:{number:true,minlength:6, maxlength:6},
      
      patient_profile_height:"required",
      patient_profile_weight:"required",
      patient_profile_bloodprusser:"required",
      patient_profile_bloodgroup:"required",
      patient_profile_pulse:"required"
      
     }
});




patientaddform.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    onStepChanging: function (event, currentIndex, newIndex)
    {
        patientaddform.validate().settings.ignore = ":disabled,:hidden";
        return patientaddform.valid();
    },
    onFinishing: function (event, currentIndex)
    {
        patientaddform.validate().settings.ignore = ":disabled";
        return patientaddform.valid();
    },
    onFinished: function (event, currentIndex)
    {
         
    var formData = new FormData($("#patient_profiledata")[0] );
     $.ajax({
      type:"POST",
    url:url+"patient/PatientProfileController/updatePatientProfileDetails",
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
          $('#patient_profile_data-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
          $( "#patient_profile_data-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
          $('#patient_profiledata')[0].reset();
        window.setTimeout(function(){location.reload()},3000);
      
      }
      else{
        $('#patient_profile_data-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#patient_profile_data-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
     complete:function(){
    // Hide image container
    $(".loader").hide();
}, 
    
    failure: function (result){

      $('#patient_profile_data-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#patient_profile_data-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");     
    } 
         
      });

    }
});




/* ====== Update profile  end ===== */









