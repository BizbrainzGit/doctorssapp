
// var url=base_url.baseurl;

TestTemplateView();
 function TestTemplateView(){
            $.ajax({
                type  : 'GET',
                url   : url+"laboratory/TestTemplateController/SearchTestTemplateListData",
                async : true,
                dataType : 'json',
                 headers:headers,
                success : function(result){
                 if(result.success===true){
                  // alert("babu");
                  TestTemplateViewList(result.data);
                  }        
                }
            });
        }

$('[data-toggle="modal"]').tooltip();

function TestTemplateViewList(TestTemplatedata){
  if ( $.fn.DataTable.isDataTable('#testtemplatetable')) {
         $('#testtemplatetable').DataTable().destroy();
         }  
         $('#testtemplatetable tbody').empty();

         var data=TestTemplatedata; 
         var table = $('#testtemplatetable').DataTable({
         paging: true,
         searching: true,
         columns: [
      {data: 'id',title: 'S No'},
      {data: 'category_name',title:'Category Name'},
      {data: 'medicaltest_name',title: 'Test Name'},
      {data: 'status',title:'Status'},
      {data: null,
           'title' : 'Action',
           "sClass" : "center",
           mRender: function (data, type, row) {
         return '<button class="btn btn btn-warning btn-sm testtemplate_view" ><a data-testtemplateid="'+data.id+'"  style="color:#FFFFFF;"><i class="mdi mdi-clipboard-text"></i></a></button>&nbsp; <button class="btn btn-primary btn-sm testtemplate_edit" ><i class="icon-pencil icon-white"></i><a data-testtemplateid="'+data.id+'" style="color:#FFFFFF;"><i class="mdi mdi-grease-pencil"></i></a></button>&nbsp;' 
           } }],
           
           columnDefs: [{
      targets: 3,
         render: function(data, type, full, meta){
      if(type === 'display'){
        if(data == '1' ){
             data = '<img id="active" src="'+url+'assets/images/active.png" heignt="32px" width="32px" align="center"/>' 
        }else{
          data = '<img id="inactive" src="'+url+'assets/images/inactive.png" heignt="32px" width="32px" align="center"/>'
        }      
          }
        return data;
       }
     }]

       });

table.rows.add(data).draw();
}




$("#AddtesttemplateId").click(function(){
     $(".listtesttemplates-class").hide();
     $(".addtesttemplates-class").show();
});



$("#add_testtemplate").validate({
     rules:{
        add_testtemplate_categoryname :"required",
        add_testtemplate_testname :"required",
        add_testtemplate_status :"required",
        add_testtemplate_report :"required"
     }
 });

$("#addtesttemplate").click(function() {
    if(!$("#add_testtemplate").valid())
     {
     return false;
     }
  
   var formData = new FormData($("#add_testtemplate")[0] );
   
     $.ajax({
      type:"POST",
      url:url+"laboratory/TestTemplateController/SaveTestTemplateData",
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
        $('#testtemplate-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
        $("#testtemplate-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
        $('#add_testtemplate')[0].reset();
         
      }
      else if(result.success===false){
        $('#testtemplate-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#testtemplate-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
    complete: function(){
    // Show image container
    $(".loader").hide();
},
    failure: function (result){

      $('#testtemplate-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#testtemplate-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");     
    }        
  });
});


/* ====== edit  details  end ===== */

$(document).on('click','.testtemplate_edit a', function(e){
    var id = $(this).data('testtemplateid');

    $.ajax({
      type:         'GET',
      url:  url+"laboratory/TestTemplateController/TestTemplateEditByIdData/"+id,
      dataType:     'json',
       headers:headers, 
    success: function(result){
  if (result.success===true){
          $(".listtesttemplates-class").hide();
          $(".edittesttemplates-class").show();

        $('#edit_testtemplate #edit_testtemplate_id').val(id);
        $('#edit_testtemplate #edit_testtemplate_categoryname').val(result.data[0].medicaltest_category_id).prop("select",true);
        $('#edit_testtemplate #edit_testtemplate_testname').val(result.data[0].medical_test_id).prop("select",true); 
        $('#edit_testtemplate #edit_testtemplate_status').val(result.data[0].status).prop("select",true);
        $('#edit_testtemplate #edit_testtemplate_report').summernote('pasteHTML', result.data[0].test_template);

      } 
      else {
        alert('request failed', 'error');
      }
  },
  failure: function (result){
     alert('request failed', 'error');
  }   


    });
    
  });

/* ====== update  details  start ===== */


$("#edit_testtemplate").validate({
     
     rules:{
        edit_testtemplate_categoryname :"required",
        edit_testtemplate_testname :"required",
        edit_testtemplate_status :"required",
        edit_testtemplate_report :"required"
     }
 });

  $("#edittesttemplate").click(function() {
   
   if(!$("#edit_testtemplate").valid())
   {
     return false;
   }

   var formData = new FormData($("#edit_testtemplate")[0]);
  
  $.ajax({
      type:"POST",
      url:url+"laboratory/TestTemplateController/UpdateTestTemplateData",
       dataType : 'json',
       data: formData,
       headers:headers,
       contentType: false, 
      cache: false,      
      processData:false,
      beforeSend: function(){
    // Show image container
    $(".loader").show();
}, 
    success: function(result){
      if(result.success===true){
          $('#testtemplate-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);    
          $("#testtemplate-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
          $('#testtemplate-editmsg')[0].reset();
      }
      else{
        $('#testtemplate-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#testtemplate-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
    complete: function(){
    // Show image container
    $(".loader").hide();
},
    failure: function (result){
      $('#testtemplate-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#testtemplate-editmsg").html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");     
    } 

            
      });


});



/* ====== view  details  start ===== */

$(document).on('click','.testtemplate_view a', function(e){
    var id = $(this).data('testtemplateid');

    $.ajax({
      type: 'GET',
      url:  url+"laboratory/TestTemplateController/TestTemplateViewByIdData/"+id,
      dataType: 'json',
      headers:headers, 
    success: function(result){
  if (result.success===true){
          $(".listtesttemplates-class").hide();
          $(".viewtesttemplates-class").show();

        // $('#edit_testtemplate #edit_testtemplate_id').val(id);
         $('#view_testtemplate_report').html(result.data[0].test_template);

      } 
      else {
        alert('request failed', 'error');
      }
  },
  failure: function (result){
     alert('request failed', 'error');
  }   


    });
    
  });


/* ====== view  details  end ===== */
