

PatientView();
 function PatientView(){
            $.ajax({
                type  : 'GET',
                url   : url+"PatientController/SearchPatientList",
                async : true,
                dataType : 'json',
                  headers:headers,
                success : function(result){
                 if(result.success===true){
                  PatientViewList(result.data);

                  }        
                }
            });
        }

function PatientViewList(patientlistdata){
  if ( $.fn.DataTable.isDataTable('#patienttable')) {
         $('#patienttable').DataTable().destroy();
         }  
         $('#patienttable tbody').empty();

         var data=patientlistdata; 
         var table = $('#patienttable').DataTable({
        
         paging: true,
         searching: true,
         columns: [
      {data: 'user_id',title: 'S No.'},
      {data: 'username',title:'Patient Id'},
      {data: 'name',title:'Patient Name'},
      {data: 'mobileno',title: 'Mobile No'},
      {data: 'age',title: 'Age'},
      {data: 'blood_group',title: 'Blood Group'},
      {data: 'address',title: 'Address'},
      {data: null,
           'title' : 'Action',
           "sClass" : "center",
           mRender: function (data, type, row) {
    return '<button class="btn btn-primary btn-md editpatient" id="patientdata_edit" title="Patient Edit"><a data-patientid="'+data.user_id+'" data-patientname="' +data.name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-grease-pencil"></i> </a></button>&nbsp; <button class="btn btn-warning btn-md patient_view" title="Patient View"><a data-patientid="'+data.user_id+'" data-patientname="' +data.name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-eye"></i> </a></button>&nbsp;'
    //<button class="btn btn-danger btn-md patient_delete" title="Patient Delete"><a data-patientid="'+data.user_id+'" data-patientname="' +data.name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i> </a></button>&nbsp; 
           } }],



       });

table.rows.add(data).draw();
}
$('[data-toggle="modal"]').tooltip();

$("#showaddpatient").click(function(){
 $(".listpatient-class").hide();
 $(".addpatient-class").show();
});

$(document).on('click', '.editpatient a', function(e){
 $(".listpatient-class").hide();
 $(".addpatient-class").hide();
 $(".editpatient-class").show();
 var id= $(this).attr("data-patientid");
// alert(id);
$.ajax({
      type: "GET",
      url:url+'PatientController/editPatientByid/'+id,
      dataType: 'json',
      headers:headers,
  success:function(result){
      if(result.success===true)
      { 
// alert(result.data[0].user_id);
     
        $('#edit_patientdata #edit_patient_addid').val(result.data[0].address_id);
        $('#edit_patientdata #edit_patient_userid').val(result.data[0].user_id);
        $('#edit_patientdata #edit_patient_id').val(result.data[0].id);

         $('#edit_patientdata #edit_patient_fname').val(result.data[0].first_name);
         $('#edit_patientdata #edit_patient_lname').val(result.data[0].last_name);
         $('#edit_patientdata #edit_patient_mobileno').val(result.data[0].mobileno);
         $('#edit_patientdata #edit_patient_age').val(result.data[0].age);
         $('#edit_patientdata #edit_patient_gender').val(result.data[0].gender);

         $('#edit_patientdata #edit_patient_height').val(result.data[0].height);
         $('#edit_patientdata #edit_patient_weight').val(result.data[0].weight);
         $('#edit_patientdata #edit_patient_bloodgroup').val(result.data[0].blood_group);
         $('#edit_patientdata #edit_patient_bloodprusser').val(result.data[0].blood_prusser);
         $('#edit_patientdata #edit_patient_pulse').val(result.data[0].pulse);
         $('#edit_patientdata #edit_patient_allergy').val(result.data[0].allergy);
         $('#edit_patientdata #edit_patient_diet').val(result.data[0].diet);

        $('#edit_patientdata #edit_patient_hno').val(result.data[0].house_no);
        $('#edit_patientdata #edit_patient_street').val(result.data[0].street);
        // $('#edit_patientdata #edit_patient_subarea').val(result.data[0].sub_area);
        $('#edit_patientdata #edit_patient_area').val(result.data[0].area);
        $('#edit_patientdata #edit_patient_landmark').val(result.data[0].landmark);
        $('#edit_patientdata #edit_patient_city').val(result.data[0].city_id).prop("selected", true);
        $('#edit_patientdata #edit_patient_state').val(result.data[0].state_id).prop("selected", true);
        if (result.data[0].pincode==0) {
          var pincode="";
          }else{
            var pincode=result.data[0].pincode
          }
        $('#edit_patientdata #edit_patient_pincode').val(pincode);
         
        if (result.data[0].profile_pic_path==null) {
             var image=No_Image_Path;
          }else{
           
            var image=result.data[0].profile_pic_path;
          }

         $("#patientphoto").html('<img src="'+url+image+ '" width="200px"  height="100px" alt=" photo" />');

         
        


         }else{
            alert('request failed', 'error');
      }

    },
   
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }

});



});

var patienteditform = $("#edit_patientdata");
patienteditform.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
      // edit_patient_fname:"required",
      // edit_patient_lname:"required",
      // edit_patient_age:{required: true,number:true},
      // edit_patient_gender:"required",
      // edit_patient_mobileno:{required: true,number:true,minlength:10, maxlength:10},
      // edit_patient_street:"required", 
      // edit_patient_area:"required",
      // edit_patient_city :"required",
      // edit_patient_state :"required",
      // edit_patient_pincode:{number:true,minlength:6, maxlength:6},
      // edit_patient_height:{required: true,number:true},
      // edit_patient_weight:{required: true,number:true},
      // edit_patient_bloodprusser:{required: true,number:true},
      // edit_patient_bloodgroup:"required",
      // edit_patient_pulse:{required: true,number:true},
      // edit_patient_condition:"required"
    }
});

patienteditform.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    onStepChanging: function (event, currentIndex, newIndex)
    {
        patienteditform.validate().settings.ignore = ":disabled,:hidden";
        return patienteditform.valid();
    },
    onFinishing: function (event, currentIndex)
    {
        patienteditform.validate().settings.ignore = ":disabled";
        return patienteditform.valid();
    },
    onFinished: function (event, currentIndex)
    {

    var formData = new FormData($("#edit_patientdata")[0] );
     $.ajax({
      type:"POST",
    url:url+"PatientController/updatePatientDetails",
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

        $('#patientdata-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
        $( "#patientdata-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
        $('#edit_patientdata')[0].reset();
        window.setTimeout(function(){location.reload()},3000);
       
      }
      else{
        $('#patientdata-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#patientdata-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
     complete:function(){
    // Hide image container
    $(".loader").hide();
}, 
    failure: function (result){

      $('#patientdata-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#patientdata-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");     
    } 
         
      });

    }
});



$(document).on('click', '.patient_delete a', function(e){
   var id= $(this).attr("data-patientid");
   var name=$(this).attr("data-patientname");
    
    $.ajax({
    type: "GET",
    url:url+'PatientController/deletePatientById/'+id,
    dataType: 'json',
    headers:headers,
    beforeSend:function(){
         return confirm("Are you sure? Delete "+name+".");
      },
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
 



/* ====== patient delete end ===== */


var patientaddform = $("#add_patientdata");
patientaddform.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
      add_patient_fname:"required",
      add_patient_lname:"required",
      add_patient_age:{required: true,number:true},
      add_patient_gender:"required",
      add_patient_mobileno:{required: true,number:true,minlength:10, maxlength:10},
      add_patient_street:"required", 
      add_patient_area:"required",
      add_patient_city :"required",
      add_patient_state :"required",
      add_patient_pincode:{number:true,minlength:6, maxlength:6},
      add_patient_email:{required: true,email: true},
      add_patient_password:"required",
      add_patient_cpassword: {required: true, equalTo: "#add_patient_password"},
      add_patient_height:{required: true,number:true},
      add_patient_weight:{required: true,number:true},
      add_patient_bloodprusser:{required: true,number:true},
      add_patient_bloodgroup:"required",
      add_patient_pulse:{required: true,number:true},
      add_patient_condition:"required"
    }
});
patientaddform.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    onStepChanging: function (event, currentIndex, newIndex)
    {   

              if($(".add_patient_documents").val() != '')
               {
               var count_of = $(".add_patient_documents").get(0).files.length;
               // alert(count_of);
               for (var i = 0; i < $(".add_patient_documents").get(0).files.length; ++i)
               {
                   var img =$(".add_patient_documents").get(0).files[i].name;
                   var img_file_size=$(".add_patient_documents").get(0).files[i].size;
                   if(img_file_size<2097152)
                   {
                      var img_ext = img.split('.').pop().toLowerCase();
                      if($.inArray(img_ext,['jpg','jpeg','pdf','png','doc'])===-1)
                      {
                         alert("File ("+img+") type not allowed.");
                          return false;
                      }
                   }
                   else
                   {
                       alert("File("+img+") size is Not More Than 2MB.")
                        return false;
                   }    
                }  
             }
        patientaddform.validate().settings.ignore = ":disabled,:hidden";
        return patientaddform.valid();
    },
    onFinishing: function (event, currentIndex)
    {
        patientaddform.validate().settings.ignore = ":disabled";
        return patientaddform.valid();
    },
    onFinished: function (event, currentIndex)
    {
         

 

    var formData = new FormData($("#add_patientdata")[0] );
   

      $.ajax({
      type:"POST",
      url:url+"PatientController/savePatientData",
      dataType: 'json',
      headers:headers,
      data:formData,
      async: false,
      cache: false,
      processData: false,
      contentType: false,
      beforeSend: function(){
      // Show image container
      $(".loader").show();
},

      success: function(result){
      
      if(result.success==true){

        $('#patientdata-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
          $( "#patientdata-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
        $('#add_patientdata')[0].reset();
         window.setTimeout(function(){location.reload()},3000);
      
      }
      else{
        $('#patientdata-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#patientdata-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
     complete:function(){
    // Hide image container
    $(".loader").hide();
}, 
    
    failure: function (result){

      $('#patientdata-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#patientdata-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");     
    } 
         
      });

    }
});



// Patient View Start//



$(document).on('click', '.patient_view a', function(e){

 var id= $(this).attr("data-patientid");
// alert(id);
$.ajax({
      type: "GET",
      url:url+'PatientController/ViewPatientByid/'+id,
      dataType: 'json',
      headers:headers,
  success:function(result){
      if(result.success===true)
      { 
         $(".listpatient-class").hide();
         $(".viewpatient-class").show();
        
         // alert(result.data[0].user_id);
     

         $("#view_patient_name").html(result.data[0].name);
         $('#view_patient_username').html(result.data[0].username);
         $('#view_patient_email').html(result.data[0].email);
         $('#view_patient_mobileno').html(result.data[0].mobileno);

         $('#view_patient_age').html(result.data[0].age);
         $('#view_patient_gender').html(result.data[0].gender);
        $('#view_patient_bloodgroup').html(result.data[0].blood_group); 
         $('#view_patient_address').html(result.data[0].address); 

         $('#view_patient_height').html(result.data[0].height);
         $('#view_patient_weight').html(result.data[0].weight);
       
         $('#view_patient_bloodprusser').html(result.data[0].blood_prusser);
         $('#view_patient_pulse').html(result.data[0].pulse);

         if (result.data[0].profile_pic_path==null) {
             var image=No_Image_Path;
          }else{
           
            var image=result.data[0].profile_pic_path;
          }

         $("#view_patient_photo").html('<img src="'+url+image+ '" width="200px"  height="100px" alt=" photo" />');
        
         if ( $.fn.DataTable.isDataTable('#patientdocumentsviewtable')) {
         $('#patientdocumentsviewtable').DataTable().destroy();
         }  
         $('#patientdocumentsviewtable tbody').empty();

         var data=result.patientdocuments; 
         var table = $('#patientdocumentsviewtable').DataTable({
         paging: true,
         searching: true,
         columns: [
      {data: 'id',title: 'S No.'},
      {data: 'document_path',title:'Document Name'},
      {data: null,
           'title' : 'Action',
           "sClass" : "center",
           mRender: function (data, type, row) {
    return '<button class="btn btn-primary btn-md"  title="Download"> <a href="'+url+data.document_path+'" download style="color:#FFFFFF;"> <i class="mdi mdi-download"></i> </a></button>&nbsp; <button class="btn btn-warning btn-md patient_view" title="Document View"><a href="'+url+data.document_path+'" loader target="_blank" style="color:#FFFFFF;"> <i class="mdi mdi-eye"></i> </a></button>&nbsp;'
           } }],

       });

table.rows.add(data).draw();
// }



         }else{
            alert('request failed', 'error');
      }

    },
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }

});

});


//  Patient View End //





