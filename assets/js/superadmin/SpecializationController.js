
SpecializationView();
 function SpecializationView(){
            $.ajax({
                type  : 'GET',
                url   : url+"superadmin/SpecializationController/SearchSpecializationList",
                async : true,
                dataType : 'json',
                success : function(result){
                 if(result.success===true){
                  specializationViewList(result.data);
                  }        
                }
            });
        }





function specializationViewList(specializationlistdata){
  if ( $.fn.DataTable.isDataTable('#specializationtable')) {
         $('#specializationtable').DataTable().destroy();
         }  
         $('#specializationtable tbody').empty();

         var data=specializationlistdata; 
         var table = $('#specializationtable').DataTable({
        
         paging: true,
         searching: true,
         columns: [
      {data: 'id',title: 'S No'},
      {data: 'specialization_img',title:'Specialization Photo'},
      {data: 'specialization',title:'Specialization'},
       {data: null,
           'title' : 'Action',
           "sClass" : "center",
           mRender: function (data, type, row) {
    return '<button class="btn btn-primary btn-sm specializationdata_edit" data-toggle="modal" id="specializationdata_edit" data-target="#EditspecializationModal"><a data-specializationid="'+data.id+'" data-specializationname="' +data.specialization+ '" style="color:#FFFFFF;"><i class="mdi mdi-grease-pencil"></i></a></button>&nbsp;'
    //<button class="btn btn-danger btn-sm specialization_delete"><a data-specializationid="'+data.id+'" data-specializationname="' +data.specialization+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i> </a></button>&nbsp;
           } }],
     columnDefs: [{
     targets: 1,
     render: function(data, type, full, meta){
      if(type === 'display'){
        if(data){
             data = '<img  src="'+url+''+data+'"  />' 
        } else {
             data = '<img src="'+url+''+No_Image_Path+'" />'
        }          
      }
          return data;
       }
     }]

       });

table.rows.add(data).draw();
}

$('[data-toggle="modal"]').tooltip();

$(document).on('click', '.specializationdata_edit a', function(e){
 var id= $(this).attr("data-specializationid");
 // alert(id);
$.ajax({
    type: "GET",
    url:url+'superadmin/SpecializationController/editSpecializationByid/'+id,
    dataType: 'json',
 
  success:function(result){
      if(result.success===true)
      { 

     
      $('#edit_specializationdata #edit_specialization_id').val(result.data[0].id);
      $('#edit_specializationdata #edit_specialization_name').val(result.data[0].specialization);
      
      if (result.data[0].specialization_img==null) {
             var image=No_Image_Path;
      }else{
           
            var image=result.data[0].specialization_img;
      }
   
   $('#specialization_img_view').html('<img src="'+url+''+image+'" />');

         }else{
            alert('request failed', 'error');
      }

    },
   
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }

});



 });





var specializationeditform = $("#edit_specializationdata");
specializationeditform.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
      edit_specialization_name :"required"
    }
});


$("#updatespecialization").click(function(){

    if(!$("#edit_specializationdata").valid())
   {
     return false;
   }
  
  var formData = new FormData($("#edit_specializationdata")[0] );
   $.ajax({
       type:"POST",
       url:url+"superadmin/SpecializationController/updateSpecializationData",
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
      
      if(result.success===true){
      
        $('#specializationdata-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);    
          $("#specializationdata-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");

           $("#edit_specializationdata")[0].reset();
            setTimeout(function(){
               $('#EditspecializationModal').modal('hide');
                }, 5000); 
       SpecializationView(); 

   }
  else if(result.success===false){
        $('#specializationdata-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#specializationdata-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
    complete: function(){
    // Show image container
    $(".loader").hide();
},
    failure: function (result){

      $('#specializationdata-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#specializationdata-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");      
    } 
         
      });


});


$("#add_specializationdata").validate({
     
     rules:{
       add_specialization_name :"required"
     }
 });

$("#addspecialization").click(function() {
  
    if(!$("#add_specializationdata").valid())
   {
     return false;
   }
  
   var formData = new FormData($("#add_specializationdata")[0] );
     $.ajax({
      type:"POST",
    url:url+"superadmin/SpecializationController/saveSpecializationData",
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
        $('#specializationdata-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
          $( "#specializationdata-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
        $('#add_specializationdata')[0].reset();
        setTimeout(function(){
               $('#AddspecializationModal').modal("hide");
                    }, 5000);
        SpecializationView();              
         
      }
      else if(result.success===false){
        $('#specializationdata-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#specializationdata-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
    complete: function(){
    // Show image container
    $(".loader").hide();
},
    failure: function (result){

      $('#specializationdata-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#specializationdata-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");     
    } 




            
      });


});




$(document).on('click', '.specialization_delete a', function(e){
 
 var id= $(this).attr("data-specializationid");
 var name=$(this).attr("data-specializationname");

    $.ajax({
    type: "GET",
    url:url+'superadmin/SpecializationController/DeleteSpecializationById/'+id,
    dataType: 'json',
  beforeSend:function(){
                   return confirm("Are you sure? Delecte this "+name+".");
                 },  
  success:function(result){
      if(result.success===true)
      { 
    
    swal("Deleted!", "Your"+" "+ name +" "+"has been deleted.", "success"); 
    SpecializationView(); 
   
      }else{
            alert('request failed', 'error');
      }

    },
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }


});


 

});

