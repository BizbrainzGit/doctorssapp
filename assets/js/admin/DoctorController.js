

DoctorView();
 function DoctorView(){
            $.ajax({
                type  : 'GET',
                url   : url+"admin/DoctorController/SearchDoctorList",
                async : true,
                dataType : 'json',
                headers:headers,
                success : function(result){
                 if(result.success===true){
                  DoctorViewList(result.data);
                  }        
                }
            });
        }


$('[data-toggle="modal"]').tooltip();

function DoctorViewList(doctorlistdata){
  if ( $.fn.DataTable.isDataTable('#doctortable')) {
         $('#doctortable').DataTable().destroy();
         }  
         $('#doctortable tbody').empty();

         var data=doctorlistdata; 
         var table = $('#doctortable').DataTable({
        
         paging: true,
         searching: true,
         columns: [
      {data: 'user_id',title: 'S No.'},
      {data: 'username',title: 'Doctor Id'},
      {data: 'name',title:'Doctor Name'},
      {data: 'designation',title: 'Designation'},
      {data: 'specialization',title: 'Specialization'},
      {data: 'specialist',title: 'Specialist'},
      {data: 'consultation_fee',title: 'Consultation Fee'},
      {data: 'active',title: 'Status'},
      {data: null,
           'title' : 'Action',
           "sClass" : "center",
           mRender: function (data, type, row) {
    return '<button class="btn btn-info btn-md doctor_status_edit" data-toggle="modal" id="doctor_status_edit" data-target="#EditDoctorstatusModal" title="Doctor Status"><a data-doctorid="'+data.user_id+'" data-doctorname="' +data.name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-pencil-box"></i> </a></button>&nbsp;<button class="btn btn-primary btn-md editdoctor" id="doctordata_edit" title="Doctor Edit"><a data-doctorid="'+data.user_id+'" data-doctorname="' +data.name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-grease-pencil"></i> </a></button>&nbsp;'
    //<button class="btn btn-danger btn-md doctor_delete" title="Doctor Delete"><a data-doctorid="'+data.user_id+'" data-doctorname="' +data.name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i> </a></button>&nbsp;
           } }],

           columnDefs: [{
         targets: 7,
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



$("#showadddoctor").click(function(){
 
   $.ajax({
    type: "GET",
    url:url+'admin/DoctorController/CountOfDoctors',
    dataType: 'json',
    headers:headers,
    success:function(result){
      if(result.success===true){  
            $(".listdoctor-class").hide();
            $(".adddoctor-class").show();
          }else{
            alert(result.message);
      }

    },
 fail:function(result){
      alert('Information request failed: ' + textStatus, 'error');
    }

});


});

$(document).on('click', '.editdoctor a', function(e){

 $(".listdoctor-class").hide();
 $(".adddoctor-class").hide();
 $(".editdoctor-class").show();
 var id= $(this).attr("data-doctorid");
// alert(id);
$.ajax({
    type: "GET",
    url:url+'admin/DoctorController/editDoctorByid/'+id,
    dataType: 'json',
    headers:headers,
    success:function(result){
      if(result.success===true)
      { 

        $('#edit_doctordata #edit_doctor_addid').val(result.data[0].address_id);
        $('#edit_doctordata #edit_doctor_userid').val(result.data[0].user_id);
        $('#edit_doctordata #edit_doctor_id').val(result.data[0].id);

        $('#edit_doctordata #edit_doctor_fname').val(result.data[0].first_name);
        $('#edit_doctordata #edit_doctor_lname').val(result.data[0].last_name);
        $('#edit_doctordata #edit_doctor_mobileno').val(result.data[0].mobileno);
        $('#edit_doctordata #edit_doctor_gender').val(result.data[0].gender);
        $('#edit_doctordata #edit_doctor_age').val(result.data[0].age);

        $('#edit_doctordata #edit_doctor_designation').val(result.data[0].designation);
        $('#edit_doctordata #edit_doctor_specialist').val(result.data[0].specialist);
        $('#edit_doctordata #edit_doctor_department').val(result.data[0].specialization_id).prop("selected", true);
        $('#edit_doctordata #edit_doctor_consultationfee').val(result.data[0].consultation_fee);
        $('#edit_doctordata #edit_doctor_bloodgroup').val(result.data[0].blood_group);
        $('#edit_doctordata #edit_doctor_education').val(result.data[0].education);
        $('#edit_doctordata #edit_doctor_biography').val(result.data[0].biography);

        $('#edit_doctordata #edit_doctor_hno').val(result.data[0].house_no);
        $('#edit_doctordata #edit_doctor_street').val(result.data[0].street);
        $('#edit_doctordata #edit_doctor_subarea').val(result.data[0].sub_area);
        $('#edit_doctordata #edit_doctor_area').val(result.data[0].area);
        $('#edit_doctordata #edit_doctor_landmark').val(result.data[0].landmark);
        $('#edit_doctordata #edit_doctor_city').val(result.data[0].city_id).prop("selected", true);
        $('#edit_doctordata #edit_doctor_state').val(result.data[0].state_id).prop("selected", true);
        if (result.data[0].pincode==0) {
          var pincode="";
          }else{
            var pincode=result.data[0].pincode
          }
        $('#edit_doctordata #edit_doctor_pincode').val(pincode);

        $("#doctorimage").html('<img src="'+url+result.data[0].profile_pic_path+ '" width="200px"  height="100px" alt=" photo" />');

         }else{
            alert('request failed', 'error');
      }

    },
   
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }

});



});

var doctoreditform = $("#edit_doctordata");
doctoreditform.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
      edit_doctor_fname:"required",
      edit_doctor_lname:"required",
      edit_doctor_age:"required",
      edit_doctor_gender:"required",      
      edit_doctor_mobileno:{required: true,number:true,minlength:10, maxlength:10},

      edit_doctor_hno :"required",
      edit_doctor_street:"required", 
      edit_doctor_area:"required",
      edit_doctor_city :"required",
      edit_doctor_state :"required",
      edit_doctor_pincode:{number:true,minlength:6, maxlength:6},
      
      edit_doctor_designation:"required",
      edit_doctor_specialist:"required",
      edit_doctor_department:"required",
      edit_doctor_consultationfee:"required",
      edit_doctor_bloodgroup:"required",
      edit_doctor_condition:"required"
    }
});

doctoreditform.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    onStepChanging: function (event, currentIndex, newIndex)
    {
        doctoreditform.validate().settings.ignore = ":disabled,:hidden";
        return doctoreditform.valid();
    },
    onFinishing: function (event, currentIndex)
    {
        doctoreditform.validate().settings.ignore = ":disabled";
        return doctoreditform.valid();
    },
    onFinished: function (event, currentIndex)
    {

    var formData = new FormData($("#edit_doctordata")[0] );
     $.ajax({
      type:"POST",
    url:url+"admin/DoctorController/updateDoctorDetails",
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

        $('#doctordata-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
        $( "#doctordata-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
        $('#edit_doctordata')[0].reset();
        window.setTimeout(function(){location.reload()},3000);
       
      }
      else{
        $('#doctordata-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#doctordata-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
     complete:function(){
    // Hide image container
    $(".loader").hide();
}, 
    failure: function (result){

      $('#doctordata-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#doctordata-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");     
    } 
         
      });

    }
});



$(document).on('click', '.doctor_delete a', function(e){
   var id= $(this).attr("data-doctorid");
   var name=$(this).attr("data-doctorname");
    
    $.ajax({
    type: "GET",
    url:url+'admin/DoctorController/deleteDoctorById/'+id,
    dataType: 'json',
    headers:headers,
    success:function(result){
      if(result.success==true)
      { 
    
    swal("Deleted!", "Your"+" "+ name +" "+"has been deleted.", "success"); 
    window.setTimeout(function(){location.reload()},3000);
   
      }else if(result.success==false){
           
           alert('request failed', 'error');
      }

    },
 
  fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }


});



    });
 



/* ====== doctor delete end ===== */


var doctoraddform = $("#add_doctordata");
doctoraddform.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
      add_doctor_fname:"required",
      add_doctor_lname:"required",
      add_doctor_age:"required",
      add_doctor_gender:"required",
      
      add_doctor_mobileno:{required: true,number:true,minlength:10, maxlength:10},
      add_doctor_photo:"required",
      
      add_doctor_hno :"required",
      add_doctor_street:"required", 
      add_doctor_area:"required",
      add_doctor_city :"required",
      add_doctor_state :"required",
      add_doctor_pincode:{required: true,number:true,minlength:6, maxlength:6},
      
      add_doctor_email:{required: true,email: true },
      add_doctor_password:"required",
      add_doctor_cpassword: {required: true, equalTo: "#add_doctor_password"},
      
      add_doctor_designation:"required",
      add_doctor_specialist:"required",
      add_doctor_department:"required",
      add_doctor_consultationfee:"required",
      add_doctor_bloodgroup:"required",
      add_doctor_condition:"required"

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
         
    var formData = new FormData($("#add_doctordata")[0] );
     $.ajax({
      type:"POST",
    url:url+"admin/DoctorController/saveDoctorData",
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

        $('#doctordata-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
          $( "#doctordata-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
        $('#add_doctordata')[0].reset();
        window.setTimeout(function(){location.reload()},3000);
      
      }
      else{
        $('#doctordata-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#doctordata-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
     complete:function(){
    // Hide image container
    $(".loader").hide();
}, 
    
    failure: function (result){

      $('#doctordata-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#doctordata-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");     
    } 
         
      });

    }
});




$(document).on('click', '.doctor_status_edit a', function(e){
 
 var id= $(this).attr("data-doctorid");

 $.ajax({
    type: "GET",
    url:url+'admin/DoctorController/editDoctorStatusByid/'+id,
    dataType: 'json',
    headers:headers,
 
  success:function(result){
      if(result.success===true)
      { 
        
        $('#doctor_status_change_form #doctor_status_id').val(id);
        if (result.data[0].active==1) {
          var data="Are you sure you want to Deactivate The Doctor?";
          $('#activestatusmsg').html(data);
           $('#doctor_status_change_form #doctor_status_change').val(0);
        }else   if (result.data[0].active==0) {
          var data="Are you sure you want to Activate The Doctor?";
          $('#activestatusmsg').html(data);
           $('#doctor_status_change_form #doctor_status_change').val(1);
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



$("#doctorupdatestatus").click(function(){
  // alert("hhh");

    if(!$("#doctor_status_change_form").valid())
   {
     return false;
   }
  
  var formData = new FormData($("#doctor_status_change_form")[0] );
   $.ajax({
       type:"POST",
       url:url+"admin/DoctorController/updateDoctorStatusByid",
        headers:headers,
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
          $('#doctorstatus-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);    
          $("#doctorstatus-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
          $("#doctor_status_change_form")[0].reset();
            setTimeout(function(){
               $('#EditDoctorstatusModal').modal('hide');
                }, 5000);
       DoctorView();
   }
  else if(result.success===false){
        $('#doctorstatus-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#doctorstatus-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
    complete:function(){
    // Hide image container
    $(".loader").hide();
}, 
    failure: function (result){

      $('#doctorstatus-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#doctorstatus-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");      
    } 
         
      });


});







