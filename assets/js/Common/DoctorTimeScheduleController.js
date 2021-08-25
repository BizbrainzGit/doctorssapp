


DoctorTimescheduleView();
 function DoctorTimescheduleView(){
            $.ajax({
                type  : 'GET',
                url   : url+"DoctorTimeScheduleController/SearchDoctorTimescheduleList",
                async : true,
                dataType : 'json',
                headers:headers,
                success : function(result){
                 if(result.success===true){
                  DoctorTimescheduleViewList(result.data);

                  }        
                }
            });
        }

function DoctorTimescheduleViewList(doctortimeschedulelistdata){
  if ( $.fn.DataTable.isDataTable('#doctortimescheduletable')) {
         $('#doctortimescheduletable').DataTable().destroy();
         }  
         $('#doctortimescheduletable tbody').empty();

         var data=doctortimeschedulelistdata; 
         var table = $('#doctortimescheduletable').DataTable({
        
         paging: true,
         searching: true,
         columns: [
      {data: 'id',title: 'S No'},
      {data: 'doctor_name',title:'Doctor Name'},
      {data: 'weekday',title: 'Schedule Week Day'},
      {data: 'appointment_type',title: 'Appointment Type'},
      {data: 'shift_start_time',title: 'Start Time'},
      {data: 'shift_end_time',title: 'End Time'},
      {data: 'patient_time',title: 'Patient Spending Time ( In Minutes)'},
      {data: null,
           'title' : 'Action',
           "sClass" : "center",
           mRender: function (data, type, row) {
    return '<button class="btn btn-primary btn-md editdoctortimeschedule" id="doctortimeschedule_edit" title="Employe Edit"><a data-doctortimescheduleid="'+data.id+'" data-doctortimeschedulename="' +data.doctor_name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-grease-pencil"></i> </a></button>&nbsp;'
    //<button class="btn btn-danger btn-md doctortimeschedule_delete" title="Employe Delete"><a data-doctortimescheduleid="'+data.id+'" data-doctortimeschedulename="' +data.doctor_name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i> </a></button>&nbsp;
           } }],
           columnDefs: [{
         targets: 3,
         render: function(data, type, full, meta){
      if(type === 'display'){
        if(data == '1' ){
             data = '<label class="badge badge-success" id="online">Online </label>' 
        } else
        if(data == '2' ){
             data = '<label class="badge badge-primary" id="offline">Offline</label>' 
        }         
          }

          return data;
       }
   }]

       });

table.rows.add(data).draw();
}

$('[data-toggle="modal"]').tooltip();


$("#showadddoctortimeschedule").click(function(){
 $(".listdoctortimeschedule-class").hide();
 $(".adddoctortimeschedule-class").show();
});

$(document).on('click', '.editdoctortimeschedule a', function(e){

 $(".listdoctortimeschedule-class").hide();
 $(".adddoctortimeschedule-class").hide();
 $(".editdoctortimeschedule-class").show();
 var id= $(this).attr("data-doctortimescheduleid");
$.ajax({
    type: "GET",
    url:url+'DoctorTimeScheduleController/editDoctorTimescheduleByid/'+id,
    dataType: 'json',
    headers:headers,
  success:function(result){
      if(result.success===true)
      { 

         $('#edit_doctortimeschedule #edit_doctortimeschedule_id').val(result.data[0].id);
         $('#edit_doctortimeschedule #edit_doctortimeschedule_doctorid').val(result.data[0].doctors_id).prop("seleted",true);
         $('#edit_doctortimeschedule #edit_doctortimeschedule_date').val(result.data[0].weekday).prop("seleted",true);
         $('#edit_doctortimeschedule #edit_doctortimeschedule_appointmenttype').val(result.data[0].appointment_type);
         $('#edit_doctortimeschedule #edit_doctortimeschedule_patient_time').val(result.data[0].patient_time);
         $('#edit_doctortimeschedule #edit_doctortimeschedule_timestart').val(result.data[0].shift_start_time);
         $('#edit_doctortimeschedule #edit_doctortimeschedule_timeend').val(result.data[0].shift_end_time);
         
         }else{
            alert('request failed', 'error');
      }

    },
   
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }

});



});




$("#edit_doctortimeschedule").validate({
     
     rules:{
        edit_doctortimeschedule_doctorid :"required",
        edit_doctortimeschedule_date :"required",
        edit_doctortimeschedule_appointmenttype :"required",
        edit_doctortimeschedule_timestart :"required",
        edit_doctortimeschedule_timeend :"required",
        edit_doctortimeschedule_patient_time :"required"
                
     }
 });


$("#updatedoctortimeschedule").click(function() {

	  if(!$("#edit_doctortimeschedule").valid())
	 {
		 return false;
	 }   	

    var formData = new FormData($("#edit_doctortimeschedule")[0] );
     $.ajax({
      type:"POST",
    url:url+"DoctorTimeScheduleController/updateDoctorTimeSchedule",
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
      
      if(result.success==true){

        $('#doctortimeschedule-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
        $( "#doctortimeschedule-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
        $('#edit_doctortimeschedule')[0].reset();

         window.setTimeout(function(){location.reload()},5000);
      
      }
      else{
        $('#doctortimeschedule-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#doctortimeschedule-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
     complete:function(){
    // Hide image container
    $(".loader").hide();
}, 
    
    failure: function (result){

      $('#doctortimeschedule-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#doctortimeschedule-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");     
    } 
         
      });

});


$(document).on('click', '.doctortimeschedule_delete a', function(e){
   var id= $(this).attr("data-doctortimescheduleid");
   var name=$(this).attr("data-doctortimeschedulename");
    
    $.ajax({
    type: "GET",
    url:url+'DoctorTimeScheduleController/deleteDoctorTimeScheduleById/'+id,
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
 



/* ====== doctortimeschedule delete end ===== */

$("#add_doctortimeschedule").validate({
     
     rules:{
        add_doctortimeschedule_doctorid :"required",
        add_doctortimeschedule_date :"required",
        add_doctortimeschedule_appointmenttype :"required",
        add_doctortimeschedule_patient_time :"required",
        add_doctortimeschedule_timestart :"required",
        add_doctortimeschedule_timeend :"required"
                
     }
 });


$("#adddoctortimeschedule").click(function() {

	  if(!$("#add_doctortimeschedule").valid())
	 {
		 return false;
	 }   	

    var formData = new FormData($("#add_doctortimeschedule")[0] );
      $.ajax({
      type:"POST",
      url:url+"DoctorTimeScheduleController/saveDoctorTimeSchedule",
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
      
      if(result.success==true){

        $('#doctortimeschedule-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
          $( "#doctortimeschedule-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
        $('#add_doctortimeschedule')[0].reset();

         window.setTimeout(function(){location.reload()},3000);
      
      }
      else{
        $('#doctortimeschedule-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#doctortimeschedule-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
     complete:function(){
    // Hide image container
    $(".loader").hide();
}, 
    
    failure: function (result){

      $('#doctortimeschedule-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#doctortimeschedule-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");     
    } 
         
      });

});









