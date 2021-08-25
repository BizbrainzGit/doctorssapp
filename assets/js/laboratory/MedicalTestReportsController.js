
// drop down billing patients list //

 function GetBillingPatientsList(ele){
             var items="";
            $.ajax({
                type  : 'GET',
                url   : url+"laboratory/MedicalTestReportsController/GetPatientBillingTestsForTestReportData",
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
                url   : url+"laboratory/MedicalTestReportsController/GetMedicalTestByBillingIdData/"+id,
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
                url   : url+"laboratory/MedicalTestReportsController/GetTestTemplateByTestIdData/"+id,
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
      url:url+"laboratory/MedicalTestReportsController/SaveMedicalTestReportData",
      dataType: 'json',
      headers:headers, 
      data:formData,
      contentType: false, 
      cache: false,      
      processData:false,
//       beforeSend: function(){
//     $(".loader").show();
// },
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
//     complete: function(){
//     $(".loader").show();
// },
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
                url   : url+"laboratory/MedicalTestReportsController/SearchMedicalTestReportsListData",
                async : true,
                dataType : 'json',
                 headers:headers,
                success : function(result){
                 if(result.success===true){
                  // alert("babu");
                  MedicalTestReporstViewList(result.data);
                  }        
                }
            });
        }


function MedicalTestReporstViewList(TestReportsdata){
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

