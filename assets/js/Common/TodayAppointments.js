

$(document).ready(function(){

viewtodayappointmentbooking();   
        function viewtodayappointmentbooking(){
            $.ajax({
                type  : 'GET',
                url   : url+"TodayAppointmentsController/SearchTodayAppointmentsList",
                async : true,
                dataType : 'json',
                headers:headers,
                success : function(result){
               if(result.success===true){
               TodayAppointmentsListview(result.data,result.role);
        
               }        
             }
            });
        }

function TodayAppointmentsListview(todayappointmentsListdata,role){
if ( $.fn.DataTable.isDataTable('#todayappointmentstable')) {
         $('#todayappointmentstable').DataTable().destroy();
         }  
         $('#todayappointmentstable tbody').empty();

         var data=todayappointmentsListdata;
         var table = $('#todayappointmentstable').DataTable({
        
         paging: true,
         searching: true,
         columns: [
      {data: 'id',title: 'S No.'},
      {data: 'profile_pic_path',title:'Patient Photo'},
      {data: 'patient_name',title:'Patient Name'},
      {data: 'doctor_name',title:'Doctor Name'},
      {data: 'appointment_date',title:'Appointment Date'},
      {data: 'time_slot',title:'Appointment Time'},
      {data: 'status_name',title:'Status'},
      {data: null,
           'title' : 'Action',
           "sClass" : "center",
           mRender: function (data, type, row) {
            if(role=="Patient"){
             return  ''

          }else if(role=="Receptionist"){
               return '<button class="btn btn-info btn-sm  status_edit" data-toggle="modal" id="status_edit" data-target="#EditstatusModal" title="Status Edit"><a data-appointmentbookingid="'+data.id+'" data-appointmentbookingname="' +data.name+ '" style="color:#ffffff"> <i class="mdi mdi-pencil-box"></i> </a></button>&nbsp;'

          }else if(role=="Doctor"){
               return '<button class="btn btn-info btn-sm  status_edit" data-toggle="modal" id="status_edit" data-target="#EditstatusModal" title="Status Edit"><a data-appointmentbookingid="'+data.id+'" data-appointmentbookingname="' +data.name+ '" style="color:#ffffff"> <i class="mdi mdi-pencil-box"></i> </a></button>&nbsp; <button class="btn btn-warning btn-md patient_view" title="Patient View"><a data-appointmentbookingid="'+data.id+'" data-appointmentbookingname="' +data.name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-eye"></i> </a></button>&nbsp;'

          } else {
   
       return  '<button class="btn btn-info btn-sm  status_edit" data-toggle="modal" id="status_edit" data-target="#EditstatusModal" title="Status Edit"><a data-appointmentbookingid="'+data.id+'" data-appointmentbookingname="' +data.name+ '" style="color:#ffffff"> <i class="mdi mdi-pencil-box"></i> </a></button>&nbsp;'  }
    //<button class="btn btn-danger btn-sm appointmentbooking_delete"><a data-appointmentbookingid="'+data.id+'" data-appointmentbookingname="' +data.name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i> </a></button>&nbsp;
           } }],

    columnDefs: [{
     targets: 1,
     render: function(data, type, full, meta){
      if(type === 'display'){
        if(data){
             data = '<img  src="'+url+''+data+'"  />' 
        } else {
             data = '<img src="'+url+''+No_Image_Path+'" />'
        }          
      }
          return data;
       }
     }]
       });

table.rows.add(data).draw();


}





/* ======  citymapping  Table  edit  start ===== */

$(document).on('click', '.status_edit a', function(e){

 var id= $(this).attr("data-appointmentbookingid");
 $.ajax({
    type: "GET",
    url:url+'TodayAppointmentsController/editStatusByid/'+id,
    dataType: 'json',
    headers:headers,
    success:function(result){
        if(result.success===true)
        { 
         $('#appointmentbooking_change_status_form #appointmentbooking_change_status_id').val(id);
         $('#appointmentbooking_change_status_form #appointmentbooking_change_status').val(result.data[0].status_id).prop("selected", true);
      
         }else{
              alert('request failed', 'error');
        }
      },
   fail:function(result){
        
        alert('Information request failed: ' + textStatus, 'error');
      }
 });


});



 $("#updatestatus").click(function(){

    if(!$("#appointmentbooking_change_status_form").valid())
   {
     return false;
   }
  
  var formData = new FormData($("#appointmentbooking_change_status_form")[0] );
   $.ajax({
       type:"POST",
       url:url+"TodayAppointmentsController/updateStatusByid",
    dataType: 'json',
    headers:headers,
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
        $('#appointmentbooking-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);    
        $("#appointmentbooking-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");

           $("#appointmentbooking_change_status_form")[0].reset();
            setTimeout(function(){
               $('#EditstatusModal').modal('hide');
                }, 5000); 

       viewappointmentbooking();

   }
  else if(result.success===false){
        $('#appointmentbooking-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#appointmentbooking-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
    complete:function(){
    // Hide image container
    $(".loader").hide();
}, 
    failure: function (result){

      $('#appointmentbooking-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#appointmentbooking-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");      
    } 
         
      });


});







$(document).on('click', '.ShowPatienthistory a', function(e){
     var id= $(this).attr("data-appointmentbookingid");
     var name=$(this).attr("data-appointmentbookingname");
    $.ajax({
    type: "GET",
    url:url+'TodayAppointmentsController/ShowPatienthistoryAppointmentById/'+id,
    dataType: 'json',
    headers:headers,
      success:function(result){
          if(result.success===true)
          { 
              alert("Babu Rao");
       
          }else{
                alert('request failed', 'error');
          }

        },
     fail:function(result){
          
          alert('Information request failed: ' + textStatus, 'error');
        }

 
      });


 

});




// Patient history by appointment id  End   //




// Patient View Start//



$(document).on('click', '.patient_view a', function(e){

 var id= $(this).attr("data-appointmentbookingid");
// alert(id);
$.ajax({
      type: "GET",
      url:url+'TodayAppointmentsController/ViewPatientByidInDoctors/'+id,
      dataType: 'json',
      headers:headers,
  success:function(result){
      if(result.success===true)
      { 
         $(".DoctorTodayAppointmentsList-class").hide();
         $(".viewpatient-class").show();
        
         // alert(result.data[0].user_id);
     

         $("#view_patient_name").html(result.data[0].name);
         $('#view_patient_username').html(result.data[0].username);
         $('#view_patient_email').html(result.data[0].email);
         $('#view_patient_mobileno').html(result.data[0].mobileno);

         $('#view_patient_age').html(result.data[0].age);
         $('#view_patient_gender').html(result.data[0].gender);
        $('#view_patient_bloodgroup').html(result.data[0].blood_group); 
         $('#view_patient_address').html(result.data[0].address); 

         $('#view_patient_height').html(result.data[0].height);
         $('#view_patient_weight').html(result.data[0].weight);
       
         $('#view_patient_bloodprusser').html(result.data[0].blood_prusser);
         $('#view_patient_pulse').html(result.data[0].pulse);

         if (result.data[0].profile_pic_path==null) {
             var image=No_Image_Path;
          }else{
           
            var image=result.data[0].profile_pic_path;
          }

         $("#view_patient_photo").html('<img src="'+url+image+ '" width="200px"  height="100px" alt=" photo" />');
        
         if ( $.fn.DataTable.isDataTable('#patientdocumentsviewtable')) {
         $('#patientdocumentsviewtable').DataTable().destroy();
         }  
         $('#patientdocumentsviewtable tbody').empty();

         var data=result.patientdocuments; 
         var table = $('#patientdocumentsviewtable').DataTable({
         paging: true,
         searching: true,
         columns: [
      {data: 'id',title: 'S No.'},
      {data: 'document_path',title:'Document Name'},
      {data: null,
           'title' : 'Action',
           "sClass" : "center",
           mRender: function (data, type, row) {
    return '<button class="btn btn-primary btn-md"  title="Download"> <a href="'+url+data.document_path+'" download style="color:#FFFFFF;"> <i class="mdi mdi-download"></i> </a></button>&nbsp; <button class="btn btn-warning btn-md patient_view" title="Document View"><a href="'+url+data.document_path+'" loader target="_blank" style="color:#FFFFFF;"> <i class="mdi mdi-eye"></i> </a></button>&nbsp;'
           } }],

       });

table.rows.add(data).draw();

         if ( $.fn.DataTable.isDataTable('#patientAppointmentsviewtable')) {
         $('#patientAppointmentsviewtable').DataTable().destroy();
         }  
         $('#patientAppointmentsviewtable tbody').empty();

         var data=result.patientappointments; 
         var table = $('#patientAppointmentsviewtable').DataTable({
         paging: true,
         searching: true,
         columns: [
      {data: 'id',title: 'S No'},
      {data: 'patient_name',title:'Patient Name'},
      {data: 'patient_mobileno',title: 'Patient Mobile No'},
      {data: 'doctor_name',title:'Doctor Name'},
      {data: 'doctor_mobileno',title: 'Doctor Mobile No'},
      {data: 'symptoms',title: 'Symptoms'},
      {data: 'diagnosis',title: 'Diagnosis'},
      {data: null,
           'title' : 'Action',
           "sClass" : "center",
           mRender: function (data, type, row) {
    return ' <button class="btn btn btn-warning btn-sm prescriptiondata_view" ><a data-prescriptionid="'+data.id+'" data-prescriptionname="' +data.name+ '" style="color:#FFFFFF;"><i class="mdi mdi-eye"></i></a></button>'
           } }],

       });

table.rows.add(data).draw();
// }



         }else{
            alert('request failed', 'error');
      }

    },
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }

});

});


//  Patient View End //


$(document).on('click', '.prescriptiondata_view a', function(e){
 var id= $(this).attr("data-prescriptionid");
 // alert(id);
$.ajax({
    type: "GET",
    url:url+'TodayAppointmentsController/viewPrescriptionByIdInDoctors/'+id,
    dataType: 'json',
     headers:headers,
  success:function(result){
      if(result.success===true)
      {  

          $(".viewpatient-class").hide();
          $(".PrescriptionView-class").show();

        $('#prescriptionview_prescription_id').html(result.data[0].id);
        $('#prescriptionview_created_date').html(result.data[0].created_date);
        $('#prescriptionview_patient_name').html(result.data[0].patient_name);
        $('#prescriptionview_patient_bloodpressure').html(result.data[0].blood_pressure);
        $('#prescriptionview_patient_pulserate').html(result.data[0].pulse_rate);
        $('#prescriptionview_patient_age').html(result.data[0].patient_age);
        $('#prescriptionview_patient_mobileno').html(result.data[0].patient_mobileno);

        $('#prescriptionview_doctor_name').html(result.data[0].doctor_name);
        $('#prescriptionview_doctor_mobileno').html(result.data[0].doctor_mobileno);

        // $('#prescriptionview_medicinename').html(result.data[0].created_date);
        // $('#prescriptionview_medicinenote').html(result.data[0].medicine_note);
        $('#prescriptionview_note').html(result.data[0].note);
        $('#prescriptionview_symptoms').html(result.data[0].symptoms);
        $('#prescriptionview_diagnosis').html(result.data[0].diagnosis);
        // $('#prescriptionview_test_name').html(result.data[0].test_name);

        for(var i=0; i<result.medicaltest.length;i++){
           $("#medical_tests > tbody").append('<tr class="text-left"><td class="text-left"> '+result.medicaltest[i].medicaltest_name+'</td></tr>');
                 } 

        for(var j=0; j<result.medicines.length;j++){
           $("#medicineNames > tbody").append('<tr class="text-left"><td class="text-left"> '+result.medicines[j].medicine_name+'</td><td class="text-left"> '+result.medicines[j].medicine_note+'</td></tr>');
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

 




});    //  documents ready 

