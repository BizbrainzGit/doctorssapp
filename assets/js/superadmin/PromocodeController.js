var url=base_url.baseurl;



$(document).ready(function(){

viewPromocode();   

        function viewPromocode(){
            $.ajax({
                type  : 'GET',
                url   : url+"superadmin/PromocodeController/SearchPromocodesList",
                async : true,
                dataType : 'json',
                success : function(result){
if(result.success===true){
        promocodeListview(result.data);
        
  }        
                }
            });
        }

function promocodeListview(promocodeListdata){
if ( $.fn.DataTable.isDataTable('#promocodetable')) {
         $('#promocodetable').DataTable().destroy();
         }  
         $('#promocodetable tbody').empty();

         var data=promocodeListdata;
         var table = $('#promocodetable').DataTable({
        
         paging: true,
         searching: true,
         columns: [
      {data: 'id',title: 'S No.'},
      {data: 'coupon_code',title:'Coupon Code'},
      {data: 'discount_amount',title:'Discount <br> Amount'},
      {data: 'discount_percentage',title:'Discount <br> Percentage'},
      {data: 'valid_form',title:'Validity From'},
      {data: 'valid_to',title:'Validity To'},
      {data: null,
           'title' : 'Action',
           "sClass" : "center",
           mRender: function (data, type, row) {
    return '<button class="btn btn-primary btn-sm promocodedata_edit" data-toggle="modal" id="promocodedata_edit" data-target="#EditpromocodeModal"><a data-promocodeid="'+data.id+'" data-promocodename="' +data.coupon_code+ '" style="color:#FFFFFF;"><i class="mdi mdi-grease-pencil"></i></a></button>&nbsp;'
    //<button class="btn btn-danger btn-sm promocode_delete"><a data-promocodeid="'+data.id+'" data-promocodename="' +data.coupon_code+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i> </a></button>&nbsp;
           } }]

  

       });

table.rows.add(data).draw();
}


/* ======  citymapping  Table  edit  start ===== */

 $(document).on('click', '.promocodedata_edit a', function(e){
 var id= $(this).attr("data-promocodeid");
 $.ajax({
    type: "GET",
    url:url+'superadmin/PromocodeController/editPromocodeByid/'+id,
    dataType: 'json',
 
  success:function(result){
      if(result.success===true)
      { 
      
        $('#edit_promocode #edit_promocode_id').val(result.data[0].id);
        $('#edit_promocode #edit_coupon_code').val(result.data[0].coupon_code);
        $('#edit_promocode #edit_validity_from').val(result.data[0].valid_form);
        $('#edit_promocode #edit_validity_to').val(result.data[0].valid_to);
        if (result.data[0].discount_percentage) {
              
              $("#edit_percentage_radio").prop("checked", true);
              document.getElementById("edit_discount_percentage").disabled = false;
              document.getElementById("edit_discount_amount").disabled = true; 
              $('#edit_promocode #edit_discount_percentage').val(result.data[0].discount_percentage);

        }

        if(result.data[0].discount_amount){   
        $("#edit_amount_radio").prop("checked", true);
        document.getElementById("edit_discount_amount").disabled = false;
        document.getElementById("edit_discount_percentage").disabled = true;
        $('#edit_promocode #edit_discount_amount').val(result.data[0].discount_amount);
       
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



/* ======  citymapping  Table  edit  end ===== */


/* ======  citymapping  Table  update  start ===== */

$("#edit_promocode").validate({
     
     rules:{
        edit_coupon_code :"required",
        edit_validity_from :"required",

        edit_validity_to :{required:true},
        edit_discount_percentage :{number:true},
        edit_discount_amount :{number:true},
      
     }
 });

 $("#updatepromocode").click(function(){

	  if(!$("#edit_promocode").valid())
	 {
		 return false;
	 }
	
	var formData = new FormData($("#edit_promocode")[0] );
   $.ajax({
       type:"POST",
       url:url+"superadmin/PromocodeController/updatePromocodeByid",
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
			
				$('#promocode-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			    $("#promocode-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");

			     $("#edit_promocode")[0].reset();
            setTimeout(function(){
               $('#EditpromocodeModal').modal('hide');
                }, 5000); 
			 viewPromocode(); 

   }
	else if(result.success===false){
				$('#promocode-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#promocode-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  complete: function(){
    // Show image container
    $(".loader").hide();
},
		failure: function (result){

			$('#promocode-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#promocode-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	
         
      });


});

/* ======  citymapping  Table  update  end ===== */


/* ====== add  citymapping  details  start ===== */
$("#add_promocode").validate({
     
     rules:{
        add_coupon_code :"required",
        add_validity_from :"required",
        promocode_type:"required",
        add_validity_to :{required:true},
        add_discount_percentage :{number:true},
        add_discount_amount :{number:true}
      
     }
 });

$("#addpromocode").click(function() {
	
	  if(!$("#add_promocode").valid())
	 {
		 return false;
	 }
	
   var formData = new FormData($("#add_promocode")[0] );
     $.ajax({
      type:"POST",
    url:url+"superadmin/PromocodeController/savePromocode",
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
				$('#promocode-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			    $( "#promocode-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
				$('#add_promocode')[0].reset();
				setTimeout(function(){
               $('#AddpromocodeModal').modal("hide");
                    }, 5000);
        viewPromocode();             	
				 
			}
			else if(result.success===false){
				$('#promocode-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#promocode-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  complete: function(){
    // Show image container
    $(".loader").hide();
},
		failure: function (result){

			$('#promocode-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#promocode-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	




            
      });


});
/* ====== add  citymapping  details  end ===== */


$(document).on('click', '.promocode_delete a', function(e){
 
 var id= $(this).attr("data-promocodeid");
 var name=$(this).attr("data-promocodename");

    $.ajax({
    type: "GET",
    url:url+'superadmin/PromocodeController/deletePromocodeByid/'+id,
    dataType: 'json',
  beforeSend:function(){
                   return confirm("Are you sure? Delecte this "+name+".");
                 },  
  success:function(result){
      if(result.success===true)
      { 
    
    swal("Deleted!", "Your"+" "+ name +" "+"has been deleted.", "success"); 
    viewPromocode(); 
   
      }else{
            alert('request failed', 'error');
      }

    },
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }


});


 

});


/* ====== Medicalshop delete end ===== */
$("#searchpromocode").click(function() {
  
    if(!$("#search_promocode").valid())
   {
     return false;
   }
  
   var formData = new FormData($("#search_promocode")[0] );
     $.ajax({
      type:"POST",
    url:url+"superadmin/PromocodeController/SearchPromocodesList",
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
      promocodeListview(result.data);
        
      }
      else if(result.success===false){
        alert('Information request failed:error, Please try Again....');
      }
    },
    complete: function(){
    // Show image container
    $(".loader").hide();
},
    failure: function (result){

      alert('Information request failed: error, Please try Again....');
    } 




            
      });


});


});

