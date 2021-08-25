$(document).ready(function(){

/* ====== Packages List Start ===== */

view_packages();   
        function view_packages(){
            $.ajax({
                type  : 'GET',
                url   : url+"superadmin/PackagesController/listPackages",
                async : true,
                dataType : 'json',
                success : function(result){
if(result.success===true){
  if ( $.fn.DataTable.isDataTable('#packagestable')) {
				 $('#packagestable').DataTable().destroy();
				 }	
				 $('#packagestable tbody').empty();
				 var data=result.data; 
				 var table = $('#packagestable').DataTable({
				 paging: true,
				 searching: true,
				 columns: [
		  {data: 'id',title: 'S No.'},
		  {data: 'package_name',title:'Package Name'},
		  {data: 'package_amount',title:'Amount'},
      {data: 'package_duration',title:'Duration'},
		  {data: 'package_status',title:'Status'},
		  {data: null,
					 'title' : 'Action',
					 "sClass" : "center",
					 mRender: function (data, type, row) {
    return '<button class="btn btn-primary btn-sm packagedata_edit" data-toggle="modal" id="packagedata_edit" data-target="#EditpackageModal"><a data-packageid="'+data.id+'" data-packagename="' +data.package_name+ '" style="color:#FFFFFF;"><i class="mdi mdi-grease-pencil"></i></a></button>&nbsp;'
    //<button class="btn btn-danger btn-sm package_delete"><a data-packageid="'+data.id+'" data-packagename="' +data.package_name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i> </a></button>&nbsp;
					 } }],
					  columnDefs: [{
		  targets: 4,
         render: function(data, type, full, meta){
		  if(type === 'display'){
  			 if(data == '1' ){
               data = '<label class="badge badge-success">Active</label>' 
             } else if(data == '2' ){
               data = '<label class="badge badge-danger">In-Active</label>' 
             } 
            }
        return data;
       }
		 }]		

			 });

table.rows.add(data).draw();
         
        }        
                }
            });
        }

/* ====== Packages List  End ===== */

/* ====== Packages Edit  Start ===== */

 $(document).on('click', '.packagedata_edit a', function(e){
 var id= $(this).attr("data-packageid");
 $.ajax({
    type: "GET",
    url:url+'superadmin/PackagesController/editPackageByid/'+id,
    dataType: 'json',
  success:function(result){
      if(result.success===true)
      { 
        $('#edit_package #edit_package_id').val(result.data[0].id);
        $('#edit_package #edit_package_name').val(result.data[0].package_name);
        $('#edit_package #edit_package_amount').val(result.data[0].package_amount);
        $('#edit_package #edit_package_status').val(result.data[0].package_status).prop("selected",true);
		    $("#edit_package_duration").val(result.data[0].package_duration);
        }else{
            alert('request failed', 'error');
      }

    },
 fail:function(result){
      alert('Information request failed: ' + textStatus, 'error');
    }

});

});

/* ====== Packages Edit  End ===== */


/* ====== Packages Update  Start ===== */

$("#edit_package").validate({
     rules:{
        edit_package_name :"required",
        edit_package_amount:{required:true,number:true},
        edit_package_duration:"required",
        edit_package_status:"required"
     }
 });

 $("#updatepackage").click(function(){
	  if(!$("#edit_package").valid())
	 {
		 return false;
	 }
	var formData = new FormData($("#edit_package")[0] );
   $.ajax({
       type:"POST",
       url:url+"superadmin/PackagesController/updatePackageByid",
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
  				  $('#package-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
  			    $("#package-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
  			    $("#edit_package")[0].reset();
            setTimeout(function(){
                 $('#EditpackageModal').modal('hide');
                  }, 5000); 
           view_packages();   
         }else if(result.success===false){
  				 $('#package-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
  				 $( "#package-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
  			 }
		},
    complete: function(){
    // Show image container
    $(".loader").hide();
},
		failure: function (result){
  			$('#package-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
  			$( "#package-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	
         
      });

});

/* ====== Packages Update  End ===== */

/* ====== Packages Add  Start ===== */

$("#add_package").validate({
     
     rules:{
        add_package_name :"required",
        add_package_amount :{required:true,number:true},
        add_package_duration:"required",
        add_package_status:"required"
     }
 });

$("#addpackage").click(function() {
	  if(!$("#add_package").valid())
	 {
		 return false;
	 }
   var formData = new FormData($("#add_package")[0] );
     $.ajax({
      type:"POST",
      url:url+"superadmin/PackagesController/savePackage",
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
  				  $('#package-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
  			    $( "#package-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
  				  $('#add_package')[0].reset();
  				  setTimeout(function(){
                 $('#AddpackageModal').modal("hide");
                      }, 5000);	
  				  view_packages();   
  			  }else{
  				$('#package-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
  				$( "#package-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
  			}
		  },
      complete: function(){
    // Show image container
    $(".loader").hide();
},
		failure: function (result){
    			$('#package-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
    			$( "#package-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
	   	}	
      });
  });

/* ====== Packages Add  End ===== */



/* ====== Packages Delete  Start ===== */
$(document).on('click', '.package_delete a', function(e){
   var id= $(this).attr("data-packageid");
   var name=$(this).attr("data-packagename");
    $.ajax({
    type: "GET",
    url:url+'superadmin/PackagesController/deletePackageById/'+id,
    dataType: 'json',
     beforeSend:function(){
         return confirm("Are you sure?");
      },
     success:function(result){
        if(result.success===true)
            { 
            swal("Deleted!", "Your"+" "+ name +" "+"has been deleted.", "success"); 
            view_packages();   
            }else{
              alert('request failed', 'error');
           }
      },
    fail:function(result){
      alert('Information request failed: ' + textStatus, 'error');
    }

});

});

/* ====== Packages Delete  End ===== */


}); // documnet ready 

