


employeesView();
 function employeesView(){
            $.ajax({
                type  : 'GET',
                url   : url+"EmployeesController/SearchEmployeeList",
                async : true,
                dataType : 'json',
                headers:headers,
                success : function(result){
                 if(result.success===true){
                  employeesViewList(result.data,result.role);
                  }        
                }
            });
        }


$('[data-toggle="modal"]').tooltip();

function employeesViewList(employeeslistdata,role){
  if ( $.fn.DataTable.isDataTable('#employeestable')) {
         $('#employeestable').DataTable().destroy();
         }  
         $('#employeestable tbody').empty();

         var data=employeeslistdata; 
         var table = $('#employeestable').DataTable({
        
         paging: true,
         searching: true,
         columns: [
      {data: 'id',title: 'S No.'},
      {data: 'name',title:'Name'},
      {data: 'username',title:'Employee Id'},
      {data: 'email',title:'Email Id'},
      {data: 'designation',title: 'Designation'},
      {data: 'mobileno',title: 'Mobile No'},
      {data: 'address',title: 'Address'},
      {data: 'active',title: 'Status'},
      {data: null,
           'title' : 'Action',
           "sClass" : "center",
           mRender: function (data, type, row) {
            if(role=="Super Admin"){
              return '<button class="btn btn-warning btn-md employees_forgotpassword" title="Employe Forgot Password "><a data-employeesid="'+data.id+'" data-employeesname="' +data.name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-pencil-box"></i> </a></button>&nbsp;'
            }else{
            return '<button class="btn btn-info btn-md employees_status_edit" data-toggle="modal" id="employees_status_edit" data-target="#EditEmployeesstatusModal" title="Employe Status"><a data-employeesid="'+data.id+'" data-employeesname="' +data.name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-pencil-box"></i> </a></button>&nbsp;<button class="btn btn-primary btn-md editemployees" id="employeesdata_edit" title="Employe Edit"><a data-employeesid="'+data.id+'" data-employeesname="' +data.name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-grease-pencil"></i> </a></button>&nbsp;<button class="btn btn-warning btn-md employees_forgotpassword" title="Employe Forgot Password "><a data-employeesid="'+data.id+'" data-employeesname="' +data.name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-pencil-box"></i> </a></button>&nbsp;'}
            //<button class="btn btn-danger btn-md employees_delete" title="Employe Delete"><a data-employeesid="'+data.id+'" data-employeesname="' +data.name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i> </a></button>&nbsp;
           } }],

           columnDefs: [{
         targets: 7,
         render: function(data, type, full, meta){
      if(type === 'display'){
        if(data == '1' ){
             data = '<img id="active" src="'+url+''+Active_Image_Path+'" heignt="32px" width="32px" align="center"/>' 
        } else if(data == '0' ){
             data = '<img id="inactive" src="'+url+''+Inactive_Image_Path+'" heignt="32px" width="32px" align="center"/>'
        }          
      }
          return data;
       }
     }]

  

       });

table.rows.add(data).draw();
}

$("#search_employee").validate({
     
     rules:{
        // search_employee_name :"required",
        // search_employee_city :"required",
      
     }
 });

$("#searchemployee").click(function() {
  
    if(!$("#search_employee").valid())
   {
     return false;
   }
  
   var formData = new FormData($("#search_employee")[0] );
     $.ajax({
      type:"POST",
    url:url+"EmployeesController/SearchEmployeeList",
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
         employeesViewList(result.data);
         // window.setTimeout(function(){location.reload()},3000);
            
      }
      else if(result.success===false){
        alert('Information request failed:error, Please try Again....');
      }
    },
    complete:function(){
    // Hide image container
    $(".loader").hide();
}, 
    failure: function (result){

      alert('Information request failed: error, Please try Again....');
    } 




            
      });


});




$("#showaddemployees").click(function(){
 $(".listemployees-class").hide();
 $(".addemployees-class").show();
});

$(document).on('click', '.editemployees a', function(e){

 $(".listemployees-class").hide();
 $(".addemployees-class").hide();
 $(".editemployees-class").show();
 var id= $(this).attr("data-employeesid");

$.ajax({
    type: "GET",
    url:url+'EmployeesController/editEmployeesByid/'+id,
    dataType: 'json',
   headers:headers,
  success:function(result){
      if(result.success===true)
      { 

     
        $('#edit_employeesdata #edit_employees_addid').val(result.data[0].address_id);
        $('#edit_employeesdata #edit_employees_userid').val(result.data[0].user_id);
        $('#edit_employeesdata #edit_employees_id').val(result.data[0].id);
        $('#edit_employeesdata #edit_employees_hno').val(result.data[0].house_no);
        $('#edit_employeesdata #edit_employees_street').val(result.data[0].street);
        $('#edit_employeesdata #edit_employees_area').val(result.data[0].area);
        $('#edit_employeesdata #edit_employees_landmark').val(result.data[0].landmark);
        $('#edit_employeesdata #edit_employees_city').val(result.data[0].city_id).prop("selected", true);
        $('#edit_employeesdata #edit_employees_state').val(result.data[0].state_id).prop("selected", true);
        if (result.data[0].pincode==0) {
          var pincode="";
          }else{
            var pincode=result.data[0].pincode
          }
        $('#edit_employeesdata #edit_employees_pincode').val(pincode);
         
         $('#edit_employeesdata #edit_employees_fname').val(result.data[0].first_name);
         $('#edit_employeesdata #edit_employees_lname').val(result.data[0].last_name);
         $('#edit_employeesdata #edit_employees_mobileno').val(result.data[0].mobileno);
         $('#edit_employeesdata #edit_employees_gender').val(result.data[0].gender);
         $('#edit_employeesdata #edit_employees_dob').val(result.data[0].dob);
         // $('#edit_employeesdata #edit_employees_aadharno').val(result.data[0].aadharno);
         $('#edit_employeesdata #edit_employees_employe_id').val(result.data[0].username);
         $('#edit_employeesdata #edit_employees_role').val(result.data[0].role_id).prop("selected", true);
         $('#edit_employeesdata #edit_employees_status').val(result.data[0].active).prop("selected", true);

          if (result.data[0].profile_pic_path==null) {
             var image=No_Image_Path;
          }else{
           
            var image=result.data[0].profile_pic_path;
          }

         $("#employeesimage").html('<img src="'+url+image+ '" width="200px"  height="100px" alt=" photo" />');

         }else{
            alert('request failed', 'error');
      }

    },
   
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }

});



});

var employeeseditform = $("#edit_employeesdata");
employeeseditform.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
      edit_employees_fname:"required",
      edit_employees_lname:"required",
      edit_employees_dob:"required",
      edit_employees_gender:"required",
      edit_employees_mobileno:{required: true,number:true,minlength:10, maxlength:10},
      edit_employees_role:"required",
      edit_employees_area:"required",
      edit_employees_street:"required",
      edit_employees_city :"required",
      edit_employees_state :"required",
      edit_employees_pincode:{required: true,number:true,minlength:6, maxlength:6},
      edit_employees_condition :"required"
    }
});

employeeseditform.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    onStepChanging: function (event, currentIndex, newIndex)
    {
        employeeseditform.validate().settings.ignore = ":disabled,:hidden";
        return employeeseditform.valid();
    },
    onFinishing: function (event, currentIndex)
    {
        employeeseditform.validate().settings.ignore = ":disabled";
        return employeeseditform.valid();
    },
    onFinished: function (event, currentIndex)
    {

    var formData = new FormData($("#edit_employeesdata")[0] );
     $.ajax({
      type:"POST",
    url:url+"EmployeesController/updateEmployeesData",
    dataType: 'json',
    data:formData,
     headers:headers, 
    contentType: false, 
    cache: false,      
    processData:false,
    beforeSend: function(){
    // Show image container
    $(".loader").show();
},

      success: function(result){
      
      if(result.success==true){

        $('#employeesdata-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
        $( "#employeesdata-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
        $('#edit_employeesdata')[0].reset();
        window.setTimeout(function(){location.reload()},3000);
       
      }
      else{
        $('#employeesdata-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#employeesdata-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
     complete:function(){
    // Hide image container
    $(".loader").hide();
}, 
    failure: function (result){

      $('#employeesdata-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#employeesdata-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");     
    } 
         
      });

    }
});



$(document).on('click', '.employees_delete a', function(e){
   var id= $(this).attr("data-employeesid");
   var name=$(this).attr("data-employeesname");
    
    $.ajax({
    type: "GET",
    url:url+'EmployeesController/deleteEmployeesById/'+id,
    dataType: 'json',
    headers:headers,
    success:function(result){
      if(result.success==true)
      { 
    
    swal("Deleted!", "Your"+" "+ name +" "+"has been deleted.", "success"); 
    window.setTimeout(function(){location.reload()},3000);
   
      }else if(result.success==false){
           
           alert('request failed', 'error');
      }

    },
 
  fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }


});

    });
 
/* ====== Employees delete end ===== */


var employeesaddform = $("#add_employeesdata");
employeesaddform.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
      add_employees_fname:"required",
      add_employees_lname:"required",
      add_employees_mobileno:{required: true,number:true,minlength:10, maxlength:10},
      add_employees_email:{required: true,email: true },
      add_employees_password:"required",
      add_employees_cpassword: {required: true, equalTo: "#add_employees_password"},
      add_employees_photo:"required",
      add_employees_role:"required",
      add_employees_dob:"required",
      add_employees_gender:"required",

      add_employees_area:"required",
      add_employees_street:"required",
      add_employees_city :"required",
      add_employees_state :"required",
      add_employees_pincode:{required: true, number:true,minlength:6, maxlength:6},
      add_employees_accountid:"required",
      add_employees_condition:"required"
       
      
     
      

    }
});
employeesaddform.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    onStepChanging: function (event, currentIndex, newIndex)
    {
        employeesaddform.validate().settings.ignore = ":disabled,:hidden";
        return employeesaddform.valid();
    },
    onFinishing: function (event, currentIndex)
    {
        employeesaddform.validate().settings.ignore = ":disabled";
        return employeesaddform.valid();
    },
    onFinished: function (event, currentIndex)
    {
         
    var formData = new FormData($("#add_employeesdata")[0] );
     $.ajax({
      type:"POST",
    url:url+"EmployeesController/saveEmployeesData",
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

        $('#employeesdata-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
          $( "#employeesdata-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
        $('#add_employeesdata')[0].reset();
        window.setTimeout(function(){location.reload()},3000);
      
      }
      else{
        $('#employeesdata-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#employeesdata-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
     complete:function(){
    // Hide image container
    $(".loader").hide();
}, 
    
    failure: function (result){

      $('#employeesdata-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#employeesdata-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");     
    } 
         
      });

    }
});




$(document).on('click', '.employees_status_edit a', function(e){
 
 var id= $(this).attr("data-employeesid");

 $.ajax({
    type: "GET",
    url:url+'EmployeesController/editEmployeesStatusByid/'+id,
    dataType: 'json',
    headers:headers,
  success:function(result){
      if(result.success===true)
      { 
        
        $('#employees_status_change_form #employees_status_id').val(result.data[0].id);
        if (result.data[0].active==1) {
          var data="Are you sure you want to Deactivate The User?";
          $('#activestatusmsg').html(data);
           $('#employees_status_change_form #employees_status_change').val(0);
        }else   if (result.data[0].active==0) {
          var data="Are you sure you want to Activate The User?";
          $('#activestatusmsg').html(data);
           $('#employees_status_change_form #employees_status_change').val(1);
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

$("#employeesupdatestatus").click(function(){
  // alert("hhh");

    if(!$("#employees_status_change_form").valid())
   {
     return false;
   }
  
  var formData = new FormData($("#employees_status_change_form")[0] );
   $.ajax({
       type:"POST",
       url:url+"EmployeesController/updateEmployeesStatusByid",
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
      
        $('#citymapping-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);    
          $("#citymapping-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");

           $("#employees_status_change_form")[0].reset();
            setTimeout(function(){
               $('#EditEmployeesstatusModal').modal('hide');
                }, 5000);


       employeesView();

   }
  else if(result.success===false){
        $('#citymapping-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#citymapping-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
    complete: function(){
    // Show image container
    $(".loader").hide();
},
    failure: function (result){

      $('#citymapping-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#citymapping-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");      
    } 
         
      });


});

/* ====== Employees Forgot Password Start ===== */

$(document).on('click', '.employees_forgotpassword a', function(e){
   var id= $(this).attr("data-employeesid");
   var name=$(this).attr("data-employeesname");
    $.ajax({
    type: "GET",
    url:url+'EmployeesController/forgotpasswordEmployeesById/'+id,
    dataType: 'json',
    headers:headers,
    beforeSend:function(){
         return confirm("Are you sure? Your want to reset password of  "+name+".");
      },
    success:function(result){
      if(result.success==true)
      { 
       alert("Your Password Send To Register Email."); 
       window.setTimeout(function(){location.reload()},3000);
      }else if(result.success==false){
           alert('request failed', 'error');
      }

    },
 
  fail:function(result){
      alert('Information request failed: ' + textStatus, 'error');
    }


});

    });
 
/* ====== Employees Forgot Password end ===== */






