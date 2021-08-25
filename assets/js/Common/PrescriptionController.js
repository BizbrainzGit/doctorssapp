
PrescriptionView();
 function PrescriptionView(){
            $.ajax({
                type  : 'GET',
                url   : url+"PrescriptionController/SearchPrescriptionList",
                async : true,
                dataType : 'json',
                 headers:headers,
                success : function(result){
                 if(result.success===true){
                  PrescriptionViewList(result.data,result.role);
                  }        
                }
            });
        }


$('[data-toggle="modal"]').tooltip();


function PrescriptionViewList(prescriptionlistdata,role){
  if ( $.fn.DataTable.isDataTable('#prescriptiontable')) {
         $('#prescriptiontable').DataTable().destroy();
         }  
         $('#prescriptiontable tbody').empty();

         var data=prescriptionlistdata; 
         var table = $('#prescriptiontable').DataTable({
        
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
            if(role=="Admin"){
               return '<button class="btn btn btn-warning btn-sm prescriptiondata_view" ><a data-prescriptionid="'+data.id+'" data-prescriptionname="' +data.name+ '" style="color:#FFFFFF;"><i class="mdi mdi-eye"></i></a></button>'

          } else if(role=="Patient"){
              return '<button class="btn btn btn-warning btn-sm prescriptiondata_view" ><a data-prescriptionid="'+data.id+'" data-prescriptionname="' +data.name+ '" style="color:#FFFFFF;"><i class="mdi mdi-eye"></i></a></button>'

          } else if(role=="Doctor"){
              return '<button class="btn btn btn-warning btn-sm prescriptiondata_view" ><a data-prescriptionid="'+data.id+'" data-prescriptionname="' +data.name+ '" style="color:#FFFFFF;"><i class="mdi mdi-eye"></i></a></button>'
          } else {
         return ' <button class="btn btn btn-warning btn-sm prescriptiondata_view" ><a data-prescriptionid="'+data.id+'" data-prescriptionname="' +data.name+ '" style="color:#FFFFFF;"><i class="mdi mdi-eye"></i></a></button>&nbsp;' }
         //<button class="btn btn-danger btn-sm prescription_delete"><a data-prescriptionid="'+data.id+'" data-prescriptionname="' +data.name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i> </a></button>&nbsp;
         //<button class="btn btn-primary btn-sm prescriptiondata_edit" data-toggle="modal" id="prescriptiondata_edit" data-target="#EditprescriptionModal"><a data-prescriptionid="'+data.id+'" data-prescriptionname="' +data.name+ '" style="color:#FFFFFF;"><i class="mdi mdi-grease-pencil"></i></a></button>&nbsp;
           } }]

       });

table.rows.add(data).draw();
}


var prescriptioneditform = $("#edit_prescriptiondata");
prescriptioneditform.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
        edit_prescription_patient :"required",
        edit_prescription_test :"required",
        edit_prescription_medicine:"required",
        edit_prescription_diagnosis:"required",
        edit_prescription_photo:"required"
    }
});


$(document).on('click', '.prescriptiondata_edit a', function(e){
 var id= $(this).attr("data-prescriptionid");
$.ajax({
    type: "GET",
    url:url+'PrescriptionController/editprescriptionByid/'+id,
    dataType: 'json',
     headers:headers,
  success:function(result){
      if(result.success===true)
      { 
     
      $('#edit_prescriptiondata #edit_prescription_id').val(result.data[0].id);
      $('#edit_prescriptiondata #edit_prescription_patient').val(result.data[0].patient_user_id).prop("selected", true);
      $('#edit_prescriptiondata #edit_prescription_doctorid').val(result.data[0].doctor_user_id).prop("selected", true);
      $('#edit_prescriptiondata #edit_prescription_medicine').val(result.data[0].medicine);
      $('#edit_prescriptiondata #edit_prescription_note').val(result.data[0].note);
      $('#edit_prescriptiondata #edit_prescription_symptoms').val(result.data[0].symptoms);
      $('#edit_prescriptiondata #edit_prescription_diagnosis').val(result.data[0].diagnosis);
        
    var values = result.data[0].test_id;
    var selectedValues=new Array();
    $.each(values.split(","), function(i,e){
      selectedValues[i]=e;
       });

    $("#edit_prescription_test").select2().val(selectedValues).trigger('change');
    
      if (result.data[0].prescription_photo==null) {
             var image=No_Image_Path;
          }else{
           
            var image=result.data[0].prescription_photo;
          }

         $("#prescriptionphoto").html('<img src="'+url+image+ '" width="200px"  height="100px" alt=" photo" />');



         }else{
            alert('request failed', 'error');
      }

    },
   
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }

});



 });







$("#updateprescription").click(function(){
    if(!$("#edit_prescriptiondata").valid())
   {
     return false;
   }
  
  var formData = new FormData($("#edit_prescriptiondata")[0] );
   $.ajax({
       type:"POST",
       url:url+"PrescriptionController/updatePrescriptionData",
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
      
        $('#prescriptiondata-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);    
          $("#prescriptiondata-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");

           $("#edit_prescriptiondata")[0].reset();
            setTimeout(function(){
               $('#EditprescriptionModal').modal('hide');
                }, 5000); 
       PrescriptionView(); 

   }
  else if(result.success===false){
        $('#prescriptiondata-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#prescriptiondata-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
    complete: function(){
    // Show image container
    $(".loader").hide();
},
    failure: function (result){

      $('#prescriptiondata-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#prescriptiondata-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");      
    } 
         
      });


});






$(document).on('click', '.prescription_delete a', function(e){
 
 var id= $(this).attr("data-prescriptionid");
 var name=$(this).attr("data-prescriptionname");

    $.ajax({
    type: "GET",
    url:url+'PrescriptionController/deletePrescriptionById/'+id,
    dataType: 'json',
     headers:headers,
     beforeSend:function(){
         return confirm("Are you sure? Delete This Prescription.");
      },
  success:function(result){
      if(result.success===true)
      { 
    
    swal("Deleted!", "Your"+" "+ name +" "+"has been deleted.", "success"); 
    PrescriptionView(); 
   
      }else{
            alert('request failed', 'error');
      }

    },
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }


});

});

$(document).on('click', '.prescriptiondata_view a', function(e){
 var id= $(this).attr("data-prescriptionid");
  //alert(id);
$.ajax({
    type: "GET",
    url:url+'PrescriptionController/viewPrescriptionById/'+id,
    dataType: 'json',
     headers:headers,
  success:function(result){
      if(result.success===true)
      {  

          $(".PrescriptionList-class").hide();
          $(".PrescriptionView-class").show();

          
          $('#prescriptionview_accountname').html(result.accountdata[0].account_name);
          $('#prescriptionview_accountaddress').html(result.accountdata[0].business_address);
          $('#prescriptionview_mobilenoemail').html(result.accountdata[0].mobilenoemail);

          if (result.accountdata[0].logo==null) {
             var image="";
          }else{
             var image=result.accountdata[0].logo;
          }

        $("#prescriptionview_accountlogo").html('<img src="'+url+image+ '" width="100px"  height="100px" />');
        $("#prescriptionview_doctorssapplogo").html('<img src="'+url+DoctorssApp_Logo+ '" width="100px"  height="100px" alt=" photo" />');

        $('#prescriptionview_prescription_id').val(result.data[0].id);
        $('#prescriptionview_prescriptionid').html(result.data[0].id);
        $('#prescriptionview_created_date').html(result.data[0].created_date);
        $('#prescriptionview_patient_name').html(result.data[0].patient_name);
       
        $('#prescriptionview_patient_age').html(result.data[0].patient_age);
        $('#prescriptionview_patient_mobileno').html(result.data[0].patient_mobileno);

        $('#prescriptionview_doctor_name').html(result.data[0].doctor_name);
        $('#prescriptionview_doctor_mobileno').html(result.data[0].doctor_mobileno);

        $('#prescriptionview_patient_bloodpressure').html(result.data[0].blood_pressure);
        $('#prescriptionview_patient_pulserate').html(result.data[0].pulse_rate);
      
        $('#prescriptionview_symptoms').html(result.data[0].symptoms);
        $('#prescriptionview_diagnosis').html(result.data[0].diagnosis);
          $('#prescriptionview_note').html(result.data[0].note);
       

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

 

 //====  Prescription Start=== //

   $('#prescription_pdf').click(prescriptionexcelexport);
   $('#prescription_print').click(prescriptionexcelexport);
   
      function DownloadExcelPrescription(link) {
        var downloadurl=url+link;
        window.open(downloadurl, '_blank');
      }

      function prescriptionexcelexport(){
        var prescriptionview_prescription_id = $("#prescriptionview_prescription_id").val();
       // alert(prescriptionview_prescription_id);
        var export_type='';
        var id = this.id;
        if(id=='prescription_pdf'){
          export_type=$("#prescription_pdf").val();  
        }
        if(id=='prescription_print'){
          export_type=$("#prescription_print").val(); 
        }
        
        jQuery.ajax({
          type: "POST",
          url:url+"PrescriptionController/prescriptionExport",
          dataType: 'json',
          headers:headers,
          data:{prescriptionview_prescription_id: prescriptionview_prescription_id,export_type:export_type},
          success: function(result){
            if(result.success===true){
                 $('#msg').hide().fadeIn('slow').delay(1350).fadeOut(2200);   
                 $("#msg").html("<div class='alert alert-success'>"+result.message+"</div>");
                if(result.download_type=='pdf'){
                  DownloadExcelPrescription(result.data);
                  return false;
                }else{
                  
                    var printWindow = window.open('', '');
                    printWindow.document.write('<html><head><title>Prescription</title>');
                    printWindow.document.write('<link rel="stylesheet" href="'+url+'assets/vendors/css/vendor.bundle.base.css">');
                    printWindow.document.write('<link rel="stylesheet"  href="'+url+'assets/css/vertical-layout-light/style.css">');
                    printWindow.document.write('<link rel="stylesheet" href="'+url+'assets/css/custom.css">');
                    printWindow.document.write('</head><body >');
                    printWindow.document.write(result.data);
                    printWindow.document.write('</body></html>');
                    printWindow.document.close();
                    printWindow.print();
                    
                }
                
            }
            else{
              //window.location.href= '';
              setTimeout(function(){
                $('#msg').html('<div class="alert alert-failure">No Data !...</div>');
              },1000);
              }
          },
          failure: function (result){
            setTimeout(function(){
              $('#msg').html('<div class="alert alert-failure">Something went wrong in App!...</div>');
            },1000);
            
          }
        });
      }

// });

