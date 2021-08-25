
// var url=base_url.baseurl;

MedicalTestsBillingView();
 function MedicalTestsBillingView(){
            $.ajax({
                type  : 'GET',
                url   : url+"billing/MedicalTestsBillingController/SearchMedicalTestsList",
                async : true,
                dataType : 'json',
                 headers:headers,
                success : function(result){
                 if(result.success===true){
                  MedicalTestsBillingViewList(result.data,result.role);
                  }        
                }
            });
        }


$('[data-toggle="modal"]').tooltip();


function MedicalTestsBillingViewList(medicaltestsbillingdata,role){
  if ( $.fn.DataTable.isDataTable('#medicaltestsbillingtable')) {
         $('#medicaltestsbillingtable').DataTable().destroy();
         }  
         $('#medicaltestsbillingtable tbody').empty();

         var data=medicaltestsbillingdata; 
         var table = $('#medicaltestsbillingtable').DataTable({
        
         paging: true,
         searching: true,
         columns: [
      {data: 'id',title: 'S No'},
      {data: 'patient_name',title:'Patient Name'},
      {data: 'patient_mobileno',title: 'Patient Mobile No'},
      {data: 'doctor_name',title:'Doctor Name'},
      {data: 'doctor_mobileno',title: 'Doctor Mobile No'},
      {data: 'test_name',title: 'Medical Tests'},
      
       {data: null,
           'title' : 'Action',
           "sClass" : "center",
           mRender: function (data, type, row) {
         return '<button class="btn btn btn-primary btn-sm medicaltests_billing" ><a data-prescriptionid="'+data.id+'" data-prescriptionname="' +data.name+ '" style="color:#FFFFFF;"><i class="mdi mdi-clipboard-text"></i></a></button>&nbsp; ' 
         //<button class="btn btn-danger btn-sm prescription_delete"><a data-prescriptionid="'+data.id+'" data-prescriptionname="' +data.name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i> </a></button>&nbsp;
           } }]

       });

table.rows.add(data).draw();
}



$(document).on('click', '.medicaltests_billing a', function(e){
 var id= $(this).attr("data-prescriptionid");
 // alert(id);
$.ajax({
    type: "GET",
    url:url+'billing/MedicalTestsBillingController/viewMedicalTestsById/'+id,
    dataType: 'json',
     headers:headers,
  success:function(result){
      if(result.success===true)
      {  

          $(".MedicalTestsBillingList_class").hide();
          $(".MedicalTestsBillingView-class").show();
        // alert("hello");
        // alert(result.data);
        $('#prescriptionview_prescription_id').val(result.data[0].id);

        $('#prescriptionview_patient_name').html(result.data[0].patient_name);
        $('#prescriptionview_patient_age').html(result.data[0].patient_age);
        $('#prescriptionview_patient_mobileno').html(result.data[0].patient_mobileno);

        $('#prescriptionview_doctor_name').html(result.data[0].doctor_name);
        $('#prescriptionview_doctor_mobileno').html(result.data[0].doctor_mobileno);

        $('#prescriptionview_test_name').html(result.data[0].test_name);
       

      }else{
            alert('request failed', 'error');
      }

    },
   
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }

});



});

 
// adding test bill details start //

  
$("#add_billing_medicaltest").validate({
     
     rules:{
        add_billing_medicaltest_patient :"required",
        // add_medicaltest_medicaltest :"required",
        // add_medicaltest_status :"required",
        // add_medicaltest_price :{required: true,number:true}
      
     }
 });

alert("baburao");

  $("#addbillingmedicaltest").click(function() {
    alert("baburao");
    if(!$("#add_billing_medicaltest").valid())
   {
     return false;
   }
  
   var formData = new FormData($("#add_billing_medicaltest")[0] );
    $.ajax({
    type:"POST",
    url:url+"MedicalTestController/saveMedicalTestData",
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
        $('#billingmedicaltest-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
        $("#billingmedicaltest-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
        $('#add_billing_medicaltest')[0].reset();
      }
      else if(result.success===false){
        $('#billingmedicaltest-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#billingmedicaltest-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
     complete:function(){
    // Hide image container
    $(".loader").hide();
}, 
    failure: function (result){

      $('#billingmedicaltest-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#billingmedicaltest-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");     
    } 

      });


});


// adding test billing details end //




































$(document).on('click', '.prescriptiondata_edit a', function(e){
 var id= $(this).attr("data-prescriptionid");
$.ajax({
    type: "GET",
    url:url+'billing/MedicalTestsBillingController/editprescriptionByid/'+id,
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
 


         }else{
            alert('request failed', 'error');
      }

    },
   
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }

});



 });





var prescriptioneditform = $("#edit_prescriptiondata");
prescriptioneditform.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
        edit_prescription_patient :"required",
        edit_prescription_test :"required",
        edit_prescription_medicine:"required"
    }
});


$("#updateprescription").click(function(){
    if(!$("#edit_prescriptiondata").valid())
   {
     return false;
   }
  
  var formData = new FormData($("#edit_prescriptiondata")[0] );
   $.ajax({
       type:"POST",
       url:url+"billing/MedicalTestsBillingController/updatePrescriptionData",
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
    complete:function(){
    // Hide image container
    $(".loader").hide();
}, 
    failure: function (result){

      $('#prescriptiondata-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#prescriptiondata-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");      
    } 
         
      });


});


// $("#add_prescriptiondata").validate({
     
//      rules:{
//         add_prescription_patient :"required",
//         add_prescription_test :"required",
//         add_prescription_medicine:"required"
//      }
//  });

// $("#addprescription").click(function() {
//     if(!$("#add_prescriptiondata").valid())
//    {
//      return false;
//    }
  
//    var formData = new FormData($("#add_prescriptiondata")[0] );
//      $.ajax({
//       type:"POST",
//     url:url+"billing/MedicalTestsBillingController/savePrescriptionData",
//     dataType: 'json',
//     headers:headers,
//     data:formData,
//     contentType: false, 
//     cache: false,      
//     processData:false,

//       success: function(result){
//       if(result.success==true){
//         $('#prescriptiondata-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
//           $( "#prescriptiondata-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
//         $('#add_prescriptiondata')[0].reset();
//         setTimeout(function(){
//                $('#AddprescriptionModal').modal("hide");
//                     }, 5000);
//         PrescriptionView();              
         
//       }
//       else if(result.success===false){
//         $('#prescriptiondata-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
//         $( "#prescriptiondata-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
//       }
//     },
    
//     failure: function (result){

//       $('#prescriptiondata-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
//       $( "#prescriptiondata-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");     
//     } 
           
//   });


// });




$(document).on('click', '.prescription_delete a', function(e){
 
 var id= $(this).attr("data-prescriptionid");
 var name=$(this).attr("data-prescriptionname");

    $.ajax({
    type: "GET",
    url:url+'billing/MedicalTestsBillingController/deletePrescriptionById/'+id,
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

$(document).on('click', '.medicaltests_billing a', function(e){
 var id= $(this).attr("data-prescriptionid");
 // alert(id);
$.ajax({
    type: "GET",
    url:url+'billing/MedicalTestsBillingController/viewPrescriptionById/'+id,
    dataType: 'json',
     headers:headers,
  success:function(result){
      if(result.success===true)
      {  

          $(".MedicalTestsBillingList_class").hide();
          $(".MedicalTestsBillingView-class").show();
        // alert("hello");
        // alert(result.data);
        $('#prescriptionview_prescription_id').val(result.data[0].id);

        $('#prescriptionview_patient_name').html(result.data[0].patient_name);
        $('#prescriptionview_patient_age').html(result.data[0].patient_age);
        $('#prescriptionview_patient_mobileno').html(result.data[0].patient_mobileno);

        $('#prescriptionview_doctor_name').html(result.data[0].doctor_name);
        $('#prescriptionview_doctor_mobileno').html(result.data[0].doctor_mobileno);

        $('#prescriptionview_medicine').html(result.data[0].medicine);
        $('#prescriptionview_note').html(result.data[0].note);
        $('#prescriptionview_symptoms').html(result.data[0].symptoms);
        $('#prescriptionview_diagnosis').html(result.data[0].diagnosis);
        $('#prescriptionview_test_name').html(result.data[0].test_name);
       

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

   $('#prescription_pdf').click(excelexport);
   $('#prescription_print').click(excelexport);
   
      function DownloadExcelPrescription(link) {
        var downloadurl=url+link;
        window.open(downloadurl, '_blank');
      }

      function excelexport(){
        var prescriptionview_prescription_id = $("#prescriptionview_prescription_id").val();
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
          url:url+"billing/MedicalTestsBillingController/prescriptionExport",
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

