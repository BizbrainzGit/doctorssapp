
// var url=base_url.baseurl;

MedicalTestsBillingView();
 function MedicalTestsBillingView(){
            $.ajax({
                type  : 'GET',
                url   : url+"PatientBillingTestController/SearchPatientBillingTestList",
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
      {data: 'billing_date',title:'Billing Date'},
      {data: 'medicaltest_name',title: 'Test Name'},
      {data: 'grand_total_amount',title: 'Grand Total'},
      {data: null,
           'title' : 'Action',
           "sClass" : "center",
           mRender: function (data, type, row) {
         return '<button class="btn btn btn-primary btn-sm patientbillingtest_invoice" ><a data-patientbillingtestid="'+data.id+'" data-prescriptionname="' +data.name+ '" style="color:#FFFFFF;"><i class="mdi mdi-clipboard-text"></i></a></button>&nbsp; ' 
           } }]

       });

table.rows.add(data).draw();
}



$(document).on('click', '.patientbillingtest_invoice a', function(e){
 var id= $(this).attr("data-patientbillingtestid");
  // alert(id);
$.ajax({
    type: "GET",
    url:url+'PatientBillingTestController/viewPatientBillingTestsById/'+id,
    dataType: 'json',
    headers:headers,
  success:function(result){
      if(result.success===true)
      {  
            
        $(".invoice_billing_medicaltest_class").show(); 
        $(".list_billing_medicaltest_class").hide();

          $('#patientbillingtest_accountname').html(result.accountdata[0].account_name);
          $('#patientbillingtest_accountaddress').html(result.accountdata[0].business_address);
          $('#patientbillingtest_mobilenoemail').html(result.accountdata[0].mobilenoemail);

          if (result.accountdata[0].logo==null) {
             var image="";
          }else{
             var image=result.accountdata[0].logo;
          }

        $("#patientbillingtest_accountlogo").html('<img src="'+url+image+ '" width="100px"  height="100px" />');
        $("#patientbillingtest_doctorssapplogo").html('<img src="'+url+DoctorssApp_Logo+ '" width="100px"  height="100px" alt=" photo" />');


        $('#export_invoice #patientbillingtest_invoice_selectedid').val(result.data[0].id); 

        $('#patientbillingtest_invoice_id').html(result.data[0].id);
        $('#patientbillingtest_invoice_billing_date').html(result.data[0].billing_date);
        
        $('#patientbillingtest_invoice_puserid').html(result.data[0].patient_username);
        $('#patientbillingtest_invoice_pname').html(result.data[0].patient_name);
        $('#patientbillingtest_invoice_pmobile').html(result.data[0].patient_mobileno);
        // $('#patientbillingtest_invoice_appointmentdate').html(result.data[0].gst_number);


        $('#patientbillingtest_invoice_duserid').html(result.data[0].doctor_username);
        $('#patientbillingtest_invoice_dname').html(result.data[0].doctor_name);
        $('#patientbillingtest_invoice_dmobile').html(result.data[0].doctor_mobileno);
        
        
        $('#patientbillingtest_invoice_total_amount').html(result.data[0].test_total_amount);
        $('#patientbillingtest_invoice_discount_amount').html(result.data[0].discount_amount);
        $('#patientbillingtest_invoice_sub_total_amount').html(result.data[0].sub_total_amount);
        $('#patientbillingtest_invoice_gst_amount').html(result.data[0].gst_amount);
        $('#patientbillingtest_invoice_grand_total_amount').html(result.data[0].grand_total_amount);

        for(var i=0; i<result.patientbillingtest.length; i++){

           $("#myTable > tbody").append('<tr ><td > </td> <td > '+result.patientbillingtest[i].medicaltest_name+'</td><td>'+result.patientbillingtest[i].discretion+'</td><td>'+result.patientbillingtest[i].medicaltest_price+'</td></tr>');
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





//====  Invoice Start=== //

    $('#patientbillingtest_invoice_pdf').click(excelexport);
    $('#patientbillingtest_invoice_print').click(excelexport);

      function DownloadExcelInvoice(link) {
        var downloadurl=url+link;
        window.open(downloadurl, '_blank');
      }


      function excelexport(){
        var patientbillingtest_invoice_selectedid = $("#patientbillingtest_invoice_selectedid").val();
        var export_type='';
        var id = this.id;
        if(id=='patientbillingtest_invoice_pdf'){
          export_type=$("#patientbillingtest_invoice_pdf").val();  
        }
        if(id=='patientbillingtest_invoice_print'){
          export_type=$("#patientbillingtest_invoice_print").val(); 
        }

        // var obj=  {business_invoice_selectedid: business_invoice_selectedid,export_type:export_type};
        // var data = JSON.stringify(obj);
        
        jQuery.ajax({
          type: "POST",
          url:url+"PatientBillingTestController/PatientBillingTestInvoiceExport",
          dataType: 'json',
          headers:headers,
          data:{patientbillingtest_invoice_selectedid: patientbillingtest_invoice_selectedid,export_type:export_type},
          success: function(result){
            if(result.success===true){
                 $('#msg').hide().fadeIn('slow').delay(1350).fadeOut(2200);   
                 $("#msg").html("<div class='alert alert-success'>"+result.message+"</div>");
                if(result.download_type=='pdf'){
                  // alert("baburao");
                  DownloadExcelInvoice(result.data);
                  return false;
                }else{
                  
                    var printWindow = window.open('', '');
                    printWindow.document.write('<html><head><title>Patients Medical Tests Receipt</title>');
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

     

//====  Invoice end=== //
 
// drop down of patients with prescription id  start //

   function getPatientPrescriptionList(ele){ 
             var items="";
            $.ajax({
                type  : 'GET',
                url   : url+"PatientBillingTestController/GetPatientByPrescriptionMedicalTestsData",
                async : true,
                dataType : 'json',
                headers:headers,
                success : function(result){
                 if(result.success===true){
                  items+="<option value=''>--Select Patient Name --</option>";
                  $.each(result.data,function(index,item) {
                      items+="<option value='"+item.id+"'>"+item.patient_name+"</option>";
                 });
                   
                 $(ele).html(items);

                  }        
                }
            });
        }

// drop down of patients with prescription id  start //


// adding test bill details start //





  
$("#add_billing_medicaltest").validate({
     
     rules:{
        add_billing_medicaltest_patient :"required",
        // add_medicaltest_medicaltest :"required",
        // add_medicaltest_status :"required",
        // add_medicaltest_price :{required: true,number:true}
      
     }
 });



  $("#addbillingmedicaltest").click(function() {
    //alert("baburao");
    if(!$("#add_billing_medicaltest").valid())
   {
     return false;
   }
  
   var formData = new FormData($("#add_billing_medicaltest")[0] );
    $.ajax({
    type:"POST",
    url:url+"PatientBillingTestController/SavePatientBillingTestData",
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


// });
