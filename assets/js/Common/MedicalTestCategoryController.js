
MedicalTestCategoryView();
 function MedicalTestCategoryView(){
            $.ajax({
                type  : 'GET',
                url   : url+"MedicalTestCategoryController/SearchMedicalTestCategoryList",
                async : true,
                dataType : 'json',
                headers:headers,
                success : function(result){
                 if(result.success===true){
                  MedicalTestCategoryViewList(result.data);
                  }        
                }
            });
        }
$('[data-toggle="modal"]').tooltip();


function MedicalTestCategoryViewList(medicaltestcategorylistdata){
  if ( $.fn.DataTable.isDataTable('#medicaltestcategorytable')) {
         $('#medicaltestcategorytable').DataTable().destroy();
         }  
         $('#medicaltestcategorytable tbody').empty();
         var data=medicaltestcategorylistdata; 
         var table = $('#medicaltestcategorytable').DataTable({
         paging: true,
         searching: true,
         columns: [
         {data: 'id',title: 'S No.'},
         {data: 'category_name',title:'Medical Test Category Name'},
         {data: null,
           'title' : 'Action',
           "sClass" : "center",
           mRender: function (data, type, row) {
           return '<button class="btn btn-primary btn-sm medicaltestcategorydata_edit" data-toggle="modal" id="medicaltestcategorydata_edit" data-target="#EditMedicalTestCategoryModal"><a data-medicaltestcategoryid="'+data.id+'" data-medicaltestcategoryname="' +data.name+ '" style="color:#FFFFFF;"><i class="mdi mdi-grease-pencil"></i></a></button>&nbsp;'
           //<button class="btn btn-danger btn-sm medicaltestcategory_delete"><a data-medicaltestcategoryid="'+data.id+'" data-medicaltestcategoryname="' +data.name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i> </a></button>&nbsp;
           } }]

       });

table.rows.add(data).draw();
}


$(document).on('click', '.medicaltestcategorydata_edit a', function(e){
 var id= $(this).attr("data-medicaltestcategoryid");
  
$.ajax({
    type: "GET",
    url:url+'MedicalTestCategoryController/editMedicalTestCategoryByid/'+id,
    dataType: 'json',
    headers:headers,
  success:function(result){
      if(result.success===true)
      { 
      $('#edit_medicaltestcategorydata #edit_medicaltestcategory_id').val(result.data[0].id);
      $('#edit_medicaltestcategorydata #edit_medicaltestcategory_name').val(result.data[0].category_name).prop("selected", true);
        }else{
            alert('request failed', 'error');
      }
    },
   
 fail:function(result){
      alert('Information request failed: ' + textStatus, 'error');
    }
  });
 });




var medicaltestcategoryeditform = $("#edit_medicaltestcategorydata");
medicaltestcategoryeditform.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
       edit_medicaltestcategory_name :"required",
    }
});


$("#updatemedicaltestcategory").click(function(){
    if(!$("#edit_medicaltestcategorydata").valid())
     {
     return false;
     }
  
  var formData = new FormData($("#edit_medicaltestcategorydata")[0] );
   $.ajax({
    type:"POST",
    url:url+"MedicalTestCategoryController/updateMedicalTestCategoryData",
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
        $('#medicaltestcategorydata-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);    
        $("#medicaltestcategorydata-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
        $("#edit_medicaltestcategorydata")[0].reset();
          setTimeout(function(){
        $('#EditMedicalTestCategoryModal').modal('hide');
                }, 5000); 
        MedicalTestCategoryView(); 
   }
  else if(result.success===false){
        $('#medicaltestcategorydata-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#medicaltestcategorydata-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
    complete:function(){
    // Hide image container
    $(".loader").hide();
}, 
    failure: function (result){

      $('#medicaltestcategorydata-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#medicaltestcategorydata-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");      
    } 
  });
});


$("#add_medicaltestcategorydata").validate({
     rules:{
        add_medicaltestcategory_name :"required"
     }
 });

$("#addmedicaltestcategory").click(function() {
    if(!$("#add_medicaltestcategorydata").valid())
     {
     return false;
     }
  
   var formData = new FormData($("#add_medicaltestcategorydata")[0] );
   
     $.ajax({
      type:"POST",
      url:url+"MedicalTestCategoryController/saveMedicalTestCategoryData",
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
        $('#medicaltestcategory-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
        $("#medicaltestcategory-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
        $('#add_medicaltestcategorydata')[0].reset();
          setTimeout(function(){
        $('#AddMedicalTestCategoryModal').modal("hide");
          }, 5000);
        MedicalTestCategoryView();              
         
      }
      else if(result.success===false){
        $('#medicaltestcategory-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#medicaltestcategory-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
    complete:function(){
    // Hide image container
    $(".loader").hide();
}, 
    failure: function (result){

      $('#medicaltestcategory-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#medicaltestcategory-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");     
    }        
  });
});




$(document).on('click', '.medicaltestcategory_delete a', function(e){
 
 var id= $(this).attr("data-medicaltestcategoryid");
 var name=$(this).attr("data-medicaltestcategoryname");

    $.ajax({
    type: "GET",
    url:url+'MedicalTestCategoryController/DeleteMedicalTestCategoryById/'+id,
    dataType: 'json',
    headers:headers,  
    beforeSend:function(){
       return confirm("Are you sure? Delete This Shift.");
     },
    success:function(result){
      if(result.success===true)
      { 
    
    swal("Deleted!", "Your"+" "+ name +" "+"has been deleted.", "success"); 
    MedicalTestCategoryView(); 
      }else{
            alert('request failed', 'error');
      }
    },
 
  fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }
  });
});

