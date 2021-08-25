
// var url=base_url.baseurl;


PatientsMedicalTestsReceiptView();
 function PatientsMedicalTestsReceiptView(){
            $.ajax({
                type  : 'GET',
                url   : url+"PatientsmedicaltestsreceiptController/SearchPatientsMedicalTestsReceiptsList",
                async : true,
                dataType : 'json',
                headers:headers,
                success : function(result){
                 if(result.success===true){
                  PatientsMedicalTestsReceiptViewList(result.data);
                  }        
                }
            });
        }


$('[data-toggle="modal"]').tooltip();


function PatientsMedicalTestsReceiptViewList(PatientsMedicalTestsReceiptlistdata){
  if ( $.fn.DataTable.isDataTable('#patientsmedicaltestsreceipttable')) {
         $('#patientsmedicaltestsreceipttable').DataTable().destroy();
         }  
         $('#patientsmedicaltestsreceipttable tbody').empty();

         var data=PatientsMedicalTestsReceiptlistdata; 
         var table = $('#patientsmedicaltestsreceipttable').DataTable({
        
         paging: true,
         searching: true,
         columns: [
      {data: 'id',title: 'S No.'},
      {data: 'patient_name',title:'Patient Name'},
      {data: 'patient_mobileno',title: 'Patient Mobile No'},
      {data: 'test_name',title:'Medical Tests'},
      {data: 'total_medicaltest_price',title: 'Price'},
      
       {data: null,
           'title' : 'Action',
           "sClass" : "center",
           mRender: function (data, type, row) {
    return '<button class="btn btn-primary btn-sm patientsmedicaltestsreceiptdata_view" ><a data-patientsmedicaltestsreceiptid="'+data.id+'" data-patientsmedicaltestsreceiptname="' +data.name+ '" style="color:#FFFFFF;"><i class="mdi mdi-receipt"></i></a></button>&nbsp;'
           } }]

       });

table.rows.add(data).draw();
}






$(document).on('click', '.patientsmedicaltestsreceiptdata_view a', function(e){
 var id= $(this).attr("data-patientsmedicaltestsreceiptid");
 // alert(id);
$.ajax({
    type: "GET",
    url:url+'PatientsmedicaltestsreceiptController/ViewPatientsMedicalTestsReceiptById/'+id,
    dataType: 'json',
      headers:headers,
  success:function(result){
      if(result.success===true)
      {  

          $(".PatientsmedicaltestsreceiptList_class").hide();
          $(".PatientsmedicaltestsreceiptView-class").show();
        // alert("hello");
        // alert(result.data);
        $('#patientsmedicaltestsreceipt_id').val(result.data[0].id); 
        $('#patientsmedicaltestsreceipt_sno').html(result.data[0].id); 
        $('#patientsmedicaltestsreceipt_date').html(result.data[0].created_date);

        $('#patientsmedicaltestsreceipt_patient_name').html(result.data[0].patient_name);
        $('#patientsmedicaltestsreceipt_patient_age').html(result.data[0].patient_age);
        $('#patientsmedicaltestsreceipt_patient_mobileno').html(result.data[0].patient_mobileno);

        $('#patientsmedicaltestsreceipt_doctor_name').html(result.data[0].doctor_name);
        $('#patientsmedicaltestsreceipt_doctor_specialization').html(result.data[0].specialization);
        $('#patientsmedicaltestsreceipt_doctor_mobileno').html(result.data[0].doctor_mobileno);

        $('#patientsmedicaltestsreceipt_grandtotal_medicaltest_price').html(result.data[0].total_medicaltest_price);
         for(var j=0; j<result.testlist.length;j++){
           $("#patientsmedicaltestsreceiptTable > tbody").append('<tr class="text-right"><td class="text-left"></td><td class="text-left"> '+result.testlist[j][0].test_name+'</td><td>'+result.testlist[j][0].medicaltest_price+'</td></tr>');
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

   $('#patientsmedicaltestsreceipt_pdf').click(excelexport);
   $('#patientsmedicaltestsreceipt_print').click(excelexport);
   
      function DownloadExcelPatientsMedicalTestsReceipt(link) {
        var downloadurl=url+link;
        window.open(downloadurl, '_blank');
      }

      function excelexport(){
        var patientsmedicaltestsreceipt_id = $("#patientsmedicaltestsreceipt_id").val();
        var export_type='';
        var id = this.id;
        if(id=='patientsmedicaltestsreceipt_pdf'){
          export_type=$("#patientsmedicaltestsreceipt_pdf").val();  
        }
        if(id=='patientsmedicaltestsreceipt_print'){
          export_type=$("#patientsmedicaltestsreceipt_print").val(); 
        }
        
        jQuery.ajax({
          type: "POST",
          url:url+"PatientsmedicaltestsreceiptController/PatientsMedicalTestsReceiptExport",
          dataType: 'json',
            headers:headers,
          data:{patientsmedicaltestsreceipt_id: patientsmedicaltestsreceipt_id,export_type:export_type},
          success: function(result){
            if(result.success===true){
                 $('#msg').hide().fadeIn('slow').delay(1350).fadeOut(2200);   
                 $("#msg").html("<div class='alert alert-success'>"+result.message+"</div>");
                if(result.download_type=='pdf'){
                  DownloadExcelPatientsMedicalTestsReceipt(result.data);
                  return false;
                }else{
                  
                    var printWindow = window.open('', '');
                    printWindow.document.write('<html><head><title>Medical Tests Receipt</title>');
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





