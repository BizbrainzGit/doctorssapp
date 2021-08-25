
ReferADoctorView();
 function ReferADoctorView(){
            $.ajax({
                type  : 'GET',
                url   : url+"doctor/ReferADoctorController/SearchReferADoctorList",
                async : true,
                dataType : 'json',
                success : function(result){
                 if(result.success===true){
                  referadoctorViewList(result.data);
                  }        
                }
            });
        }


$('[data-toggle="modal"]').tooltip();
function referadoctorViewList(referadoctorlistdata){
  if ( $.fn.DataTable.isDataTable('#referadoctortable')) {
         $('#referadoctortable').DataTable().destroy();
         }  
         $('#referadoctortable tbody').empty();

         var data=referadoctorlistdata; 
         var table = $('#referadoctortable').DataTable({
        
         paging: true,
         searching: true,
         columns: [
      {data: 'id',title: 'S No.'},
      {data: 'patient_name',title:'Patient Name'},
      {data: 'patient_mobileno',title:'Patient Phone Number'},
      {data: 'patient_address',title:'Patient Address'},
      {data: 'refer_to_doctorname',title:'Refer To Doctor'},
    //    {data: null,
    //        'title' : 'Action',
    //        "sClass" : "center",
    //        mRender: function (data, type, row) {
    // return ''
    // //<button class="btn btn-primary btn-sm paymentmodedata_edit" data-toggle="modal" id="paymentmodedata_edit" data-target="#EditpaymentmodeModal"><a data-paymentmodeid="'+data.id+'" data-paymentmodename="' +data.paymentmode_name+ '" style="color:#FFFFFF;"><i class="mdi mdi-grease-pencil"></i></a></button>&nbsp;
    // //<button class="btn btn-danger btn-sm paymentmode_delete"><a data-paymentmodeid="'+data.id+'" data-paymentmodename="' +data.paymentmode_name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i> </a></button>&nbsp;
    //        } }
           ]

       });

     table.rows.add(data).draw();
}




$("#add_referadoctordata").validate({
     
     rules:{
        add_referadoctor_patientname :"required",
        add_referadoctor_doctorid :"required",
     }
 });

$("#addreferadoctor").click(function() {
  
    if(!$("#add_referadoctordata").valid())
   {
     return false;
   }
  
   var formData = new FormData($("#add_referadoctordata")[0] );
     $.ajax({
      type:"POST",
    url:url+"doctor/ReferADoctorController/saveReferADoctorData",
    dataType: 'json',
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
        $('#referadoctordata-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
          $( "#referadoctordata-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
        $('#add_referadoctordata')[0].reset();
        setTimeout(function(){
               $('#AddReferADoctorModal').modal("hide");
                    }, 5000);
        ReferADoctorView();              
         
      }
      else if(result.success===false){
        $('#referadoctordata-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#referadoctordata-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
     complete:function(){
    // Hide image container
    $(".loader").hide();
}, 
    failure: function (result){

      $('#referadoctordata-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#referadoctordata-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");     
    } 
            
      });

});




ReferByADoctorView();
 function ReferByADoctorView(){
            $.ajax({
                type  : 'GET',
                url   : url+"doctor/ReferADoctorController/SearchReferByADoctorList",
                async : true,
                dataType : 'json',
                success : function(result){
                 if(result.success===true){
                  referbyadoctorViewList(result.data);
                  }        
                }
            });
        }



$('[data-toggle="modal"]').tooltip();
function referbyadoctorViewList(referbyadoctorlistdata){
  if ( $.fn.DataTable.isDataTable('#referbyadoctortable')) {
         $('#referbyadoctortable').DataTable().destroy();
         }  
         $('#referbyadoctortable tbody').empty();

         var data=referbyadoctorlistdata; 
         var table = $('#referbyadoctortable').DataTable({
        
         paging: true,
         searching: true,
         columns: [
      {data: 'id',title: 'S No.'},
      {data: 'patient_name',title:'Patient Name'},
      {data: 'patient_mobileno',title:'Patient Phone Number'},
      {data: 'patient_address',title:'Patient Address'},
      {data: 'refer_by_doctorname',title:'Refer By A Doctor'},
     // {data: 'refer_to_doctorname',title:'Refer To Doctor'},
    //    {data: null,
    //        'title' : 'Action',
    //        "sClass" : "center",
    //        mRender: function (data, type, row) {
    // return ''
    // //<button class="btn btn-primary btn-sm paymentmodedata_edit" data-toggle="modal" id="paymentmodedata_edit" data-target="#EditpaymentmodeModal"><a data-paymentmodeid="'+data.id+'" data-paymentmodename="' +data.paymentmode_name+ '" style="color:#FFFFFF;"><i class="mdi mdi-grease-pencil"></i></a></button>&nbsp;
    // //<button class="btn btn-danger btn-sm paymentmode_delete"><a data-paymentmodeid="'+data.id+'" data-paymentmodename="' +data.paymentmode_name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i> </a></button>&nbsp;
    //        } }
           ]

       });

     table.rows.add(data).draw();
}


