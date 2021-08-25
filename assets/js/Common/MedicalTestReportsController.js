
// drop down billing patients list //

 function GetBillingPatientsList(ele){
             var items="";
            $.ajax({
                type  : 'GET',
                url   : url+"MedicalTestReportsController/GetPatientBillingTestsForTestReportData",
                dataType : 'json',
                headers:headers,
                success : function(result){
                 if(result.success===true){
                  items+="<option value=''>--Select Patient --</option>";
                   $.each(result.data,function(index,item) {
                      items+="<option value='"+item.id+"'>"+item.patient_name+"</option>";
                 });
                
                 $(ele).html(items);

                  }        
                }
            });


        }
// drop down billing test list

 function getMedicalTestByBillingId(ele,selectedValue){ 
            var id=selectedValue.value;
             var items="";
            $.ajax({
                type  : 'GET',
                url   : url+"MedicalTestReportsController/GetMedicalTestByBillingIdData/"+id,
                dataType : 'json',
                headers:headers,
                success : function(result){
                 if(result.success===true){
                  items+="<option value=''>--Select Medical Test --</option>";
                  $.each(result.data,function(index,item) {
                      items+="<option value='"+item.test_id+"'>"+item.medicaltest_name+"</option>";
                 });
                   
                 $(ele).html(items);

                  }        
                }
            });
        }

// get test template view for edit data



function getTestTemplateByTestId(ele,selectedValue){ 
             var id=selectedValue.value;
             var items="";
            // $(ele).val('');
            $.ajax({
                type  : 'GET',
                url   : url+"MedicalTestReportsController/GetTestTemplateByTestIdData/"+id,
                dataType : 'json',
                headers:headers,
                success : function(result){

                 if(result.success===true){
                    //$('#edit_testtemplate #edit_testtemplate_report').summernote('pasteHTML', result.data[0].test_template);
                    $(ele).summernote('pasteHTML', result.data[0].test_template);

                  }else{

                    alert("baburao");
                  
                  }


                }
            });
        }


// added medical test report view 


$("#add_medicaltestreport").validate({
     rules:{
        add_medicaltestreport_billingid :"required",
        add_medicaltestreport_testid :"required",
        add_medicaltestreport_tempate :"required"
     }
 });

$("#addmedicaltestreport").click(function() {

    if(!$("#add_medicaltestreport").valid())
     {
     return false;
     }
  
   var formData = new FormData($("#add_medicaltestreport")[0] );
   
     $.ajax({
      type:"POST",
      url:url+"MedicalTestReportsController/SaveMedicalTestReportData",
      dataType: 'json',
      headers:headers, 
      data:formData,
      contentType: false, 
      cache: false,      
      processData:false,
      beforeSend: function(){
    $(".loader").show();
},
      success: function(result){
      if(result.success==true){
        $('#medicaltestreport-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
        $("#medicaltestreport-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
        $('#add_medicaltestreport')[0].reset();
         
      }
      else if(result.success===false){
        $('#medicaltestreport-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#medicaltestreport-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
    complete: function(){
    $(".loader").hide();
},
    failure: function (result){

      $('#medicaltestreport-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#medicaltestreport-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");     
    }        
  });
});

// get medical report list start //
// alert("baburao");
   MedicalTestReporstView();
 function MedicalTestReporstView(){
            $.ajax({
                type  : 'GET',
                url   : url+"MedicalTestReportsController/SearchMedicalTestReportsListData",
                async : true,
                dataType : 'json',
                 headers:headers,
                success : function(result){
                 if(result.success===true){
                  // alert("babu");
                  MedicalTestReporstViewList(result.data,result.role);
                  }        
                }
            });
        }


function MedicalTestReporstViewList(TestReportsdata,role){
  if ( $.fn.DataTable.isDataTable('#medicaltestreportstable')) {
         $('#medicaltestreportstable').DataTable().destroy();
         }  
         $('#medicaltestreportstable tbody').empty();

         var data=TestReportsdata; 
         var table = $('#medicaltestreportstable').DataTable({
         paging: true,
         searching: true,
         columns: [
      {data: 'id',title: 'S No'},
      {data: 'billing_date',title:'Billing'},
      {data: 'medicaltest_name',title: 'Test Name'},
      {data: 'patient_name',title:'Patient Name'},
      {data: 'doctor_name',title:'Doctors Name'},
      {data: null,
           'title' : 'Action',
           "sClass" : "center",
           mRender: function (data, type, row) {
         return '<button class="btn btn btn-warning btn-sm testtemplate_view" ><a data-testtemplateid="'+data.id+'"  style="color:#FFFFFF;"><i class="mdi mdi-clipboard-text"></i></a></button>&nbsp; ' 
           } }]

       });

table.rows.add(data).draw();
}
 


// get medical report list end //

$(document).on('click', '.testtemplate_view a', function(e){
 var id= $(this).attr("data-testtemplateid");
  //alert(id);
$.ajax({
    type: "GET",
    url:url+'MedicalTestReportsController/viewMedicalTestReportById/'+id,
    dataType: 'json',
     headers:headers,
  success:function(result){
      if(result.success===true)
      {  

          $(".MedicalTestReportList-class").hide();
          $(".MedicalTestReportView-class").show();

          
          $('#medicaltestreportview_accountname').html(result.accountdata[0].account_name);
          $('#medicaltestreportview_accountaddress').html(result.accountdata[0].business_address);
          $('#medicaltestreportview_mobilenoemail').html(result.accountdata[0].mobilenoemail);

          if (result.accountdata[0].logo==null) {
             var image="";
          }else{
             var image=result.accountdata[0].logo;
          }

        $("#medicaltestreportview_accountlogo").html('<img src="'+url+image+ '" width="100px"  height="100px" />');
        $("#medicaltestreportview_doctorssapplogo").html('<img src="'+url+DoctorssApp_Logo+ '" width="100px"  height="100px" alt=" photo" />');

        $('#medicaltestreportview_prescription_id').val(result.data[0].id);
        $('#medicaltestreportview_prescriptionid').html(result.data[0].id);
        $('#medicaltestreportview_created_date').html(result.data[0].created_date);
        $('#medicaltestreportview_patient_name').html(result.data[0].patient_name);
       
        $('#medicaltestreportview_patient_age').html(result.data[0].patient_age);
        $('#medicaltestreportview_patient_mobileno').html(result.data[0].patient_mobileno);

        $('#medicaltestreportview_doctor_name').html(result.data[0].doctor_name);
        $('#medicaltestreportview_doctor_mobileno').html(result.data[0].doctor_mobileno);

         $('#medicaltestreportview_patient_medicaltestreport').html(result.data[0].medical_test_report);
        

      }else{
            alert('request failed', 'error');
      }

    },

   
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }

});



});

 

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