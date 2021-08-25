
MedicalTestView();
 function MedicalTestView(){
            $.ajax({
                type  : 'GET',
                url   : url+"MedicalTestController/SearchMedicalTestList",
                async : true,
                dataType : 'json',
                headers:headers,
                success : function(result){
                 if(result.success===true){
                  MedicalTestViewList(result.data);
                  }        
                }
            });
        }


$('[data-toggle="modal"]').tooltip();


function MedicalTestViewList(medicaltestlistdata){
  if ( $.fn.DataTable.isDataTable('#medicaltesttable')) {
         $('#medicaltesttable').DataTable().destroy();
         }  
         $('#medicaltesttable tbody').empty();

         var data=medicaltestlistdata; 
         var table = $('#medicaltesttable').DataTable({
        
         paging: true,
         searching: true,
         columns: [
      {data: 'id',title: 'S No.'},
      {data: 'category_name',title:'Category'},
      {data: 'medicaltest_name',title: 'Medical Test'},
      {data: 'medicaltest_price',title: 'Price'},
      {data: 'medicaltest_status',title: 'Status'},
      

       {data: null,
           'title' : 'Action',
           "sClass" : "center",
           mRender: function (data, type, row) {
    return '<button class="btn btn-primary btn-sm medicaltestdata_edit" data-toggle="modal" id="medicaltestdata_edit" data-target="#EditMedicaltestModal"><a data-medicaltestid="'+data.id+'" data-medicaltestname="' +data.name+ '" style="color:#FFFFFF;"><i class="mdi mdi-grease-pencil"></i></a></button>&nbsp;'
    //<button class="btn btn-danger btn-sm medicaltest_delete"><a data-medicaltestid="'+data.id+'" data-medicaltestname="' +data.name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i> </a></button>&nbsp;
           } }],
               columnDefs: [{
         targets: 4,
         render: function(data, type, full, meta){
      if(type === 'display'){
        if(data == '1' ){
             data = '<label class="badge badge-primary" id="1">Active</label>' 
        } else
        if(data == '0' ){
             data = '<label class="badge badge-danger" id="0">In-Active</label>' 
        }

          }

          return data;
       }
   }]


       });

table.rows.add(data).draw();
}




var medicaltesteditform = $("#edit_medicaltestdata");
medicaltesteditform.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
        edit_medicaltest_category :"required",
        edit_medicaltest_medicaltest :"required",
        edit_medicaltest_status :"required",
        edit_medicaltest_price :{required: true,number:true}
      
    }
});




$(document).on('click', '.medicaltestdata_edit a', function(e){
 var id= $(this).attr("data-medicaltestid");
  // alert(id);
$.ajax({
    type: "GET",
    url:url+'MedicalTestController/editMedicalTestByid/'+id,
    dataType: 'json',
    headers:headers,
  success:function(result){
      if(result.success===true)
      { 

     
      $('#edit_medicaltestdata #edit_medicaltest_id').val(result.data[0].id);
      $('#edit_medicaltestdata #edit_medicaltest_category').val(result.data[0].medicaltest_category_id).prop("selected", true);
      $('#edit_medicaltestdata #edit_medicaltest_medicaltest').val(result.data[0].medicaltest_name);
      $('#edit_medicaltestdata #edit_medicaltest_price').val(result.data[0].medicaltest_price);
      $('#edit_medicaltestdata #edit_medicaltest_status').val(result.data[0].medicaltest_status);
      $('#edit_medicaltestdata #edit_medicaltest_description').val(result.data[0].discretion);
     
   
         }else{
            alert('request failed', 'error');
      }

    },
   
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }

});



 });





$("#updatemedicaltest").click(function(){

    if(!$("#edit_medicaltestdata").valid())
   {
     return false;
   }
  
  var formData = new FormData($("#edit_medicaltestdata")[0] );
   $.ajax({
       type:"POST",
       url:url+"MedicalTestController/updateMedicalTestData",
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
      
        $('#medicaltestdata-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);    
        $("#medicaltestdata-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
        $("#edit_medicaltestdata")[0].reset();
            setTimeout(function(){
               $('#EditMedicaltestModal').modal('hide');
                }, 5000); 
       MedicalTestView(); 

   }
  else if(result.success===false){
        $('#medicaltestdata-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#medicaltestdata-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
     complete:function(){
    // Hide image container
    $(".loader").hide();
}, 
    failure: function (result){

      $('#medicaltestdata-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#medicaltestdata-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");      
    } 
         
      });


});


$("#add_medicaltestdata").validate({
     
     rules:{
        add_medicaltest_category :"required",
        add_medicaltest_medicaltest :"required",
        add_medicaltest_status :"required",
        add_medicaltest_price :{required: true,number:true}
      
     }
 });

  $("#addmedicaltest").click(function() {
    if(!$("#add_medicaltestdata").valid())
   {
     return false;
   }
  
   var formData = new FormData($("#add_medicaltestdata")[0] );
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
        $('#medicaltestdata-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
        $( "#medicaltestdata-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
        $('#add_medicaltestdata')[0].reset();
        setTimeout(function(){
        $('#AddMedicalTestModal').modal("hide");
                    }, 5000);
        MedicalTestView();              
         
      }
      else if(result.success===false){
        $('#medicaltestdata-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#medicaltestdata-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
     complete:function(){
    // Hide image container
    $(".loader").hide();
}, 
    failure: function (result){

      $('#medicaltestdata-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#medicaltestdata-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");     
    } 




            
      });


});




$(document).on('click', '.medicaltest_delete a', function(e){
 
 var id= $(this).attr("data-medicaltestid");
 var name=$(this).attr("data-medicaltestname");

    $.ajax({
    type: "GET",
    url:url+'MedicalTestController/DeleteMedicalTestById/'+id,
    dataType: 'json',
    headers:headers,  
    beforeSend:function(){
         return confirm("Are you sure? Delete This Laboratory Medical Test");
      },
  success:function(result){
      if(result.success===true)
      { 
    
    swal("Deleted!", "Your"+" "+ name +" "+"has been deleted.", "success"); 
    MedicalTestView(); 
   
      }else{
            alert('request failed', 'error');
      }

    },
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }


});


 

});

