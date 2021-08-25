
// var url=base_url.baseurl;


$(document).ready(function() {
      viewDoctorsAppointments();   
        function viewDoctorsAppointments(){
            $.ajax({
                type  : 'GET',
                url   : url+"DoctorsAppointmentsListController/DoctorsAppointmentsList",
                async : true,
                dataType : 'json',
                headers:headers,
                success : function(result){
                if(result.success==true){
                viewDoctorsAppointmentsList(result.data);      
      
              }        
                }
            });
        }

  function viewDoctorsAppointmentsList(doctorsappointments){

       var items = "";
       var edititems = "";
       
       var i;
       var n = doctorsappointments.length;
     if (n==0) {
      items="<div class='alert alert-danger'>No Appointments For This Doctor... <br>Plz Select Another Doctor or Another Date...</div>";
     }else{
      for(var i=0; i<n; i++){
      var patientdata= doctorsappointments[i].header_data
      var a = patientdata.length;

      // alert(a);
      var patients = "";
      for (var j = 0; j<a; j++) {
       patients+='<tr><td>'+patientdata[j].id+'</td><td>'+patientdata[j].patient_name+'</td><td>'+patientdata[j].age+'</td><td>'+patientdata[j].mobileno+'</td><td>'+patientdata[j].booking_time+'</td></tr>'
      }
       
        items+='<div class="col-lg-6 grid-margin stretch-card" style="max-width:none;"><div class="card"><div class="card-body"><h3 class="card-title">Doctor Name : '+doctorsappointments[i].doctor_name+'</h3><div class="table-responsive"> <p class="card-title">Shift : <code>'+doctorsappointments[i].shift_name+'</code></p> <p class="card-title">Appointments : <code>'+doctorsappointments[i].shift_tokens+'</code>    <span style="float: right;">Date : <code>'+doctorsappointments[i].time_schedule_date+'</code></span></p>  <table class="table table-bordered"><thead><tr><th>S No.</th><th>Patient Name</th><th>Age</th><th>Phone No.</th><th>Booking Time</th></tr></thead><tbody> '+patients+'   </tbody></table></div></div>    </div></div>';


     }
   }
        
        $("#doctorsappointmentslist").html(items);
  
  }





// ==== business search starts == //

$("#search_appointmentslist").validate({
     
     rules:{
        // search_business_cname :"required",
        // search_business_city :"required",
      
     }
 });

$("#searchappointmentslist").click(function() {
    if(!$("#search_appointmentslist").valid())
   {
     return false;
   }
  
   var formData = new FormData($("#search_appointmentslist")[0] );
     $.ajax({
      type:"POST",
    url:url+"DoctorsAppointmentsListController/DoctorsAppointmentsList",
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
          viewDoctorsAppointmentsList(result.data);      
       }
      else if(result.success===false){
         $("#doctorsappointmentslist").empty();
         $('#doctorappointmentslist_msg').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
         $( "#doctorappointmentslist_msg" ).html("<div class='alert alert-danger'> No Data Avaiable !...</div>");
      }
    },
    complete: function(){
    // Show image container
    $(".loader").hide();
},
    failure: function (result){

      alert('Information request failed: error, Please try Again....');
    } 

 });


});
// ==== business search ends == //









}); // document ready



 //====  Prescription Start=== //

   $('#doctorappointments_pdf').click(pdfexport);
   $('#doctorappointments_print').click(pdfexport);
   
      function DownloadDoctorappointments(link) {
        var downloadurl=url+link;
        window.open(downloadurl, '_blank');
      }

      function pdfexport(){
        var export_type='';
        var id = this.id;

        if(id=='doctorappointments_pdf'){
          export_type=$("#doctorappointments_pdf").val();  
        }
        if(id=='doctorappointments_print'){
          export_type=$("#doctorappointments_print").val(); 
        }
        
       
        jQuery.ajax({
          type: "POST",
          url:url+"DoctorsAppointmentsListController/DoctorsAppointmentsExport",
          dataType: 'json',
          headers:headers,
          data: {export_type:export_type},
         success: function(result){
          if(result.success===true){
           $('#doctorappointments_msg').hide().fadeIn('slow').delay(1350).fadeOut(2200);   
           $("#doctorappointments_msg").html("<div class='alert alert-success'>"+result.message+"</div>");
          if(result.download_type=='pdf'){
            DownloadDoctorappointments(result.data);
            return false;
          }else{
            
              var printWindow = window.open('', '', 'height=400,width=800');
              printWindow.document.write('<html><head><title>Doctors Appointments Report</title>');
              
              printWindow.document.write('</head><body>');
              printWindow.document.write(result.data);
              printWindow.document.write('</body></html>');
              printWindow.document.close();
              printWindow.print();
              
          }
          
      }
      else{
        //window.location.href= '';
        setTimeout(function(){
          $('#doctorappointments_msg').html('<div class="alert alert-failure">No Data !...</div>');
        },1000);
        }
    },
          failure: function (result){
            setTimeout(function(){
              $('#doctorappointments_msg').html('<div class="alert alert-failure">Something went wrong in App!...</div>');
            },1000);
            
          }
        });
      }

// });

