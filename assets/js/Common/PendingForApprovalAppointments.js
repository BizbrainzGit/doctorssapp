

$(document).ready(function(){

viewpendingforapprovalappointments();   
        function viewpendingforapprovalappointments(){
            $.ajax({
                type  : 'GET',
                url   : url+"AppointmentbookingController/SearchPendingForApprovalAppointmentsList",
                async : true,
                dataType : 'json',
                headers:headers,
                success : function(result){
               if(result.success===true){
               pendingforapprovalappointmentsListview(result.data,result.role);
        
               }        
             }
            });
        }

function pendingforapprovalappointmentsListview(pendingforapprovalListdata,role){
if ( $.fn.DataTable.isDataTable('#pendingforapprovaltable')) {
         $('#pendingforapprovaltable').DataTable().destroy();
         }  
         $('#pendingforapprovaltable tbody').empty();

         var data=pendingforapprovalListdata;
         var table = $('#pendingforapprovaltable').DataTable({
        
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
               return '<button class="btn btn-info btn-sm  status_edit" data-toggle="modal" id="status_edit" data-target="#EditstatusModal" title="Status Edit"><a data-appointmentbookingid="'+data.id+'" data-appointmentbookingname="' +data.name+ '" style="color:#ffffff"> <i class="mdi mdi-pencil-box"></i> </a></button>&nbsp;'

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
    url:url+'AppointmentbookingController/editStatusByid/'+id,
    dataType: 'json',
    headers:headers,
    success:function(result){
        if(result.success===true)
        { 
         $('#appointmentbooking_change_status_form #appointmentbooking_change_status_id').val(id);
         // $('#appointmentbooking_change_status_form #appointmentbooking_change_status').val(result.data[0].status_id).prop("selected", true);
      
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
       url:url+"AppointmentbookingController/updateStatusByid",
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

       viewpendingforapprovalappointments();

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



$(document).on('click', '.appointmentbookingdata_edit a', function(e){

 var id= $(this).attr("data-appointmentbookingid");
 // alert(id);
 $.ajax({
    type: "GET",
    url:url+'AppointmentbookingController/editAppointmentbookingByid/'+id,
    dataType: 'json',
    headers:headers,
    success:function(result){
      if(result.success===true)
      { 
      
      $('#edit_appointmentbooking #edit_appointmentbooking_id').val(result.data[0].id);
      $('#edit_appointmentbooking #edit_appointmentbooking_patient').val(result.data[0].patients_id).prop("selected", true);
      $('#edit_appointmentbooking #edit_appointmentbooking_doctor').val(result.data[0].doctors_id).prop("selected", true);
      $('#edit_appointmentbooking #edit_appointmentbooking_department').val(result.data[0].specialization_id).prop("selected", true);
      $('#edit_appointmentbooking #edit_appointmentbooking_timeslot').val(result.data[0].time_slot).prop("selected", true);
      $('#edit_appointmentbooking #edit_appointmentbooking_description').val(result.data[0].diseases_description);
      $('#edit_appointmentbooking #edit_appointmentbooking_date').val(result.data[0].appointment_date);
     
        

      }else{
            alert('request failed', 'error');
      }

    },
   
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }


});

 });


/* ======  appointmentbooking  Table  edit  end ===== */


/* ======  appointmentbooking  Table  update  start ===== */

$("#edit_appointmentbooking").validate({
     
     rules:{
        edit_appointmentbooking_patient :"required",
        edit_appointmentbooking_department :"required",
        edit_appointmentbooking_doctor :"required",
        edit_appointmentbooking_appointmentschedule :"required",
        edit_appointmentbooking_description :"required"
        
      
     }
 });

 $("#updateappointmentbooking").click(function(){

    if(!$("#edit_appointmentbooking").valid())
   {
     return false;
   }
  
  var formData = new FormData($("#edit_appointmentbooking")[0] );
   $.ajax({
       type:"POST",
       url:url+"AppointmentbookingController/updateAppointmentbookingData",
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

           $("#edit_appointmentbooking")[0].reset();
            setTimeout(function(){
               $('#EditappointmentbookingModal').modal('hide');
                }, 5000); 
       viewappointmentbooking(); 

   }
  else if(result.success===false){
        $('#appointmentbooking-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#appointmentbooking-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
    complete: function(){
    // Show image container
    $(".loader").hide();
},
    failure: function (result){

      $('#appointmentbooking-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#appointmentbooking-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");      
    } 
         
      });


});

/* ======  citymapping  Table  update  end ===== */






});    //  documents ready 

