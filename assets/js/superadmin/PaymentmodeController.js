
PaymentmodeView();
 function PaymentmodeView(){
            $.ajax({
                type  : 'GET',
                url   : url+"superadmin/PaymentmodeController/SearchPaymentmodeList",
                async : true,
                dataType : 'json',
                success : function(result){
                 if(result.success===true){
                  paymentmodeViewList(result.data);
                  }        
                }
            });
        }


$('[data-toggle="modal"]').tooltip();


function paymentmodeViewList(paymentmodelistdata){
  if ( $.fn.DataTable.isDataTable('#paymentmodetable')) {
         $('#paymentmodetable').DataTable().destroy();
         }  
         $('#paymentmodetable tbody').empty();

         var data=paymentmodelistdata; 
         var table = $('#paymentmodetable').DataTable({
        
         paging: true,
         searching: true,
         columns: [
      {data: 'id',title: 'S No'},
      {data: 'paymentmode_name',title:'Payment Mode'},
       {data: null,
           'title' : 'Action',
           "sClass" : "center",
           mRender: function (data, type, row) {
    return '<button class="btn btn-primary btn-sm paymentmodedata_edit" data-toggle="modal" id="paymentmodedata_edit" data-target="#EditpaymentmodeModal"><a data-paymentmodeid="'+data.id+'" data-paymentmodename="' +data.paymentmode_name+ '" style="color:#FFFFFF;"><i class="mdi mdi-grease-pencil"></i></a></button>&nbsp;'
    //<button class="btn btn-danger btn-sm paymentmode_delete"><a data-paymentmodeid="'+data.id+'" data-paymentmodename="' +data.paymentmode_name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i> </a></button>&nbsp;
           } }]

       });

     table.rows.add(data).draw();
}


$(document).on('click', '.paymentmodedata_edit a', function(e){
 var id= $(this).attr("data-paymentmodeid");
 // alert(id);
$.ajax({
    type: "GET",
    url:url+'superadmin/PaymentmodeController/editpaymentmodeByid/'+id,
    dataType: 'json',
  success:function(result){
      if(result.success===true)
      { 
     
      $('#edit_paymentmodedata #edit_paymentmode_id').val(result.data[0].id);
      $('#edit_paymentmodedata #edit_paymentmode_name').val(result.data[0].paymentmode_name);
         }else{
            alert('request failed', 'error');
      }

    },
   
 fail:function(result){
      alert('Information request failed: ' + textStatus, 'error');
    }

});



 });





var paymentmodeeditform = $("#edit_paymentmodedata");
paymentmodeeditform.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
      edit_paymentmode_name :"required",
      
    }
});


$("#updatepaymentmode").click(function(){

    if(!$("#edit_paymentmodedata").valid())
   {
     return false;
   }
  
  var formData = new FormData($("#edit_paymentmodedata")[0] );
   $.ajax({
       type:"POST",
       url:url+"superadmin/PaymentmodeController/updatePaymentmodeData",
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
          $('#paymentmodedata-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);    
          $("#paymentmodedata-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");

            $("#edit_paymentmodedata")[0].reset();
            setTimeout(function(){
               $('#EditpaymentmodeModal').modal('hide');
                }, 5000); 
                PaymentmodeView(); 

         }
  else if(result.success===false){
        $('#paymentmodedata-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#paymentmodedata-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
    complete: function(){
    // Show image container
    $(".loader").hide();
},
    failure: function (result){

      $('#paymentmodedata-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#paymentmodedata-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");      
    } 
         
      });


});


$("#add_paymentmodedata").validate({
     
     rules:{
        add_paymentmode_name :"required",
     }
 });

$("#addpaymentmode").click(function() {
  
    if(!$("#add_paymentmodedata").valid())
   {
     return false;
   }
  
   var formData = new FormData($("#add_paymentmodedata")[0] );
     $.ajax({
      type:"POST",
    url:url+"superadmin/PaymentmodeController/savePaymentmodeData",
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
        $('#paymentmodedata-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
          $( "#paymentmodedata-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
        $('#add_paymentmodedata')[0].reset();
        setTimeout(function(){
               $('#AddpaymentmodeModal').modal("hide");
                    }, 5000);
        PaymentmodeView();              
         
      }
      else if(result.success===false){
        $('#paymentmodedata-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#paymentmodedata-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
    complete: function(){
    // Show image container
    $(".loader").hide();
},
    failure: function (result){

      $('#paymentmodedata-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#paymentmodedata-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");     
    } 
            
      });

});




$(document).on('click', '.paymentmode_delete a', function(e){
 
 var id= $(this).attr("data-paymentmodeid");
 var name=$(this).attr("data-paymentmodename");
 
    $.ajax({
    type: "GET",
    url:url+'superadmin/PaymentmodeController/DeletePaymentmodeById/'+id,
    dataType: 'json',
    beforeSend:function(){
                   return confirm("Are you sure? Delecte this "+name+".");
                 },
    success:function(result){
      if(result.success===true)
      { 
            swal("Deleted!", "Your"+" "+ name +" "+"has been deleted.", "success"); 
             PaymentmodeView(); 
   
      }else{
            alert('request failed', 'error');
      }

    },
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }


});


 

});

