//$(document).ready(function() {
 

function GetAccountSelectList(ele){
  var items="";
   var items1="";
      $.getJSON(url+"Welcome/GetAccountSelectList",function(selectaccountlist){
       items+="<option value=''>--Select Account --</option>";
      $.each(selectaccountlist,function(index,itemlist) {
      $.each(itemlist,function(index,item) {
       if(item.encrypted_id==AccountSelected){
           var selected="selected='selected'";
       }else{
           var selected=" ";
       }
      items+="<option value='"+item.encrypted_id+"' "+selected+" >"+item.account_role_name+"</option>";

        });
      });
       $(ele).html(items);
  
  });

}

function getPaymentstatus(ele){

   var items1="";
      $.getJSON(url+"Common/getPaymentmode",function(paymentstatus){
      // items+="<option value=''>--Select Payment Mode--</option>";
      $.each(paymentstatus,function(index,itemlist) {
      $.each(itemlist,function(index,item) {
      items1+='<li class="nav-item"><label> <input type="radio"  value='+item.id+' id="add_subscription_payment_mode" name="add_subscription_payment_mode"  onchange="showPaymentmode(this)" style="display:inline;"> <span class="form-label"> '+item.paymentmode_name+' </span> </label> </li>';

        });
      });
      

       $(ele).html(items1);
       // $("#addsubscriptionpaymentmode").html(items1);

  });
     
     
}


 function getMedicalTestCategory(ele){
             var items="";
            $.ajax({
                type  : 'GET',
                url   : url+"Common/getMedicalTestCategory",
                async : true,
                dataType : 'json',
                headers:headers,
                success : function(result){
                 if(result.success===true){

                  items+="<option value=''>--Select Medical Test Category--</option>";

                   $.each(result.data,function(index,item) {
                      items+="<option value='"+item.id+"'>"+item.category_name+"</option>";
                 });
                
                 $(ele).html(items);

                  }        
                }
            });


        }


  
  


 function getMedicalTest(ele,selectedValue){ 
            var categoryid=selectedValue.value;
             var items="";
            $.ajax({
                type  : 'GET',
                url   : url+"Common/getMedicalTest/"+categoryid,
                async : true,
                dataType : 'json',
                headers:headers,
                success : function(result){
                 if(result.success===true){
                  items+="<option value=''>--Select Medical Test --</option>";
                  $.each(result.data,function(index,item) {
                      items+="<option value='"+item.id+"'>"+item.medicaltest_name+"</option>";
                 });
                   
                 $(ele).html(items);

                  }        
                }
            });
        }

//get medical test with params
  function getMedicalTest1(ele){ 
             var categoryid=0;
             var items="";
            $.ajax({
                type  : 'GET',
                url   : url+"Common/getMedicalTest/"+categoryid,
                async : true,
                dataType : 'json',
                headers:headers,
                success : function(result){
                 if(result.success===true){
                  items+="<option value=''>--Select Medical Test --</option>";
                  $.each(result.data,function(index,item) {
                      items+="<option value='"+item.id+"'>"+item.medicaltest_name+"</option>";
                 });

                $(ele).html(items);
				       //alert(items);

                  }        
                }
            });
        }

function getPrice(ele,id){ 
             var items="";
            $.ajax({
                type  : 'POST',
                data : {testid:id},
                url   : url+"Common/getPrice",
                async : true,
                dataType : 'json',
                headers:headers,
                success : function(result){
                 if(result.success===true){
           	      $(ele).val(result.data[0]['medicaltest_price']);
                  }        
                }
            });
  
        } 


 function getDoctor(ele){
            var items="";
            $.ajax({
                type  : 'GET',
                url   : url+"Common/getDoctor",
                async : true,
                dataType : 'json',
                headers:headers,
                success : function(result){
                 if(result.success===true){
                  // alert(result.data);
                     items+="<option value=''>--Select Doctor--</option>";

                   $.each(result.data,function(index,item) {
                      items+="<option value='"+item.user_id+"'>"+item.user_name+"</option>";
                 });

                $(ele).html(items);   
            
                  }        
                }
            });
        }



 function getDoctorDepartment(ele,selectedValue){
           var doctordepartmentId =selectedValue.value;
             var items="";
            $.ajax({
                type  : 'GET',
                url   : url+"Common/getDoctorDepartment/"+doctordepartmentId,
                async : true,
                dataType : 'json',
                headers:headers,
                success : function(result){
                 if(result.success===true){
                    // alert(result.data);
                  items+="<option value=''>--Select Doctor Department--</option>";

                   $.each(result.data,function(index,item) {
                      items+="<option value='"+item.user_id+"'>"+item.user_name+" - "+item.consultation_fee+" Rs</option>";
                 });
                     $(ele).html(items);   
                  }        
                }
            });
        }


 function getPatient(ele){
             var items="";
            $.ajax({
                type  : 'GET',
                url   : url+"Common/getPatient",
                async : true,
                dataType : 'json',
                headers:headers,
                success : function(result){
                 if(result.success===true){
                  // alert(result.data);
                  items+="<option value=''>--Select Patient--</option>";

                   $.each(result.data,function(index,item) {
                      items+="<option value='"+item.user_id+"'>"+item.user_name+"</option>";
                 });
                
                $(ele).html(items);   
               
                  }        
                }
            });
        }




//getSpecialization();
 function getSpecialization(ele){
             var items="";
            $.ajax({
                type  : 'GET',
                url   : url+"Common/getSpecialization",
                async : true,
                dataType : 'json',
                headers:headers,
                success : function(result){
                 if(result.success===true){
                  items+="<option value=''>--Select Specialization--</option>";
                   $.each(result.data,function(index,item) {
                     items+="<option value='"+item.id+"'>"+item.specialization+"</option>";
                 });

                   $(ele).html(items); 

                  }        
                }
            });

        }


 function getDesignation(ele){
  var items="";
      $.getJSON(url+"Common/getDesignation",function(designation){
      items+="<option value=''>--Select Designation--</option>";
      $.each(designation,function(index,itemlist) {
      $.each(itemlist,function(index,item) {
      items+="<option value='"+item.id+"'>"+item.designation+"</option>";
        });
      });

       $(ele).html(items);   
      
  });


}



function getState(ele){

  var items="";
      $.getJSON(url+"Common/getState",function(statelist){
      items+="<option value=''>---Select State---</option>";
      $.each(statelist,function(index,itemlist) {
      $.each(itemlist,function(index,item) {
      items+="<option value='"+item.state_id+"'>"+item.state_name+"</option>";
        });
      });
    
     $(ele).html(items);  
     
  });

}



function getCityByState(ele,selectedValue){
   if (selectedValue==0) {
        var stateId=selectedValue;
   }else{
        var stateId=selectedValue.value;
   }
   var items="";
      $.getJSON(url+"Common/getCity/"+stateId,function(city){
      items+="<option value=''>--Select City--</option>";
      $.each(city,function(index,itemlist) {
      $.each(itemlist,function(index,item) {
      items+="<option value='"+item.cityid+"'>"+item.cityname+"</option>";
        });
      });

      $(ele).html(items);  
     
  });
     
     
}




  function getBookingStatus(ele){
            $.ajax({
                type  : 'GET',
                url   : url+"Common/getBookingStatus",
                async : true,
                dataType : 'json',
                headers:headers,
                success : function(result){
                 if(result.success==true){
                 var items ="<option value=''>--Select Booking Status --</option>";
                 var i;
                 var n = result.data.length;
                for(var i=0; i<n; i++){
                      items+='<option value="'+result.data[i].id+'">'+result.data[i].name+'</option>'; 
                    
                  }
                    
                $(ele).html(items);  

                    // $("#appointmentbooking_change_status").html(items);
                    // $("#add_appointmentbooking_appointmentstatus").html(items);
                    // $("#edit_appointmentbooking_appointmentstatus").html(items);
      
                 
                  }        
                }
            });
      }


function getAppointmentScheduleTime(ele,selectedValue){
     var appointment_doctorid=selectedValue.value;

     var add_appointment_date=$('#add_appointmentbooking_date').val();
           if ( add_appointment_date != null && add_appointment_date != '') {
              var appointment_date=add_appointment_date;
           }

            $.ajax({
                type  : 'Post',
                url   : url+"Common/getAppointmentTimingsWithDate",
                async : true,
                dataType : 'json',
                headers:headers,
                data:{appointment_doctorid:appointment_doctorid,appointment_date:appointment_date},
                success : function(result){
                 if(result.success==true){
                 var items ='<option value="">--Select Appointment Timings--</option>';
                 var i;
                 var n = result.data.length;
                for(var i=0; i<n; i++){
                    items+='<option value="'+result.data[i]+'">'+result.data[i]+'</option>'; 
                     }
                       $(ele).html(items);
                  }else{
                    $(ele).empty();
                    $('.doctortimeschedule-timemsg').hide().fadeIn('').delay(1000).fadeOut(2200);
                    $(".doctortimeschedule-timemsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
                   }

                }
            });


  
}




function getHospitalAccount(ele){
  var items="";
      $.getJSON(url+"Common/getHospitalAccount",function(account){
      items+="<option value=''>--Select Account Type--</option>";
      $.each(account,function(index,itemlist) {
      $.each(itemlist,function(index,item) {
      items+="<option value='"+item.id+"'>"+item.account_name+"</option>";

        });
      });
      
          // $("#add_employees_accountid").html(items);
          // $("#edit_employees_accountid").html(items);

          $(ele).html(items);

  });

}



 function packagelistview(ele){

  var items="";
      $.getJSON(url+"Common/getPackagelist",function(packagelist){
      items+=" ";
      $.each(packagelist,function(index,itemlist) {
      $.each(itemlist,function(index,item) {
      items+='<div class="col-md-6 col-xl-4 mt-2 mb-2 packageslist"><div class="card border-success border card-packages"> <div class="text-center pt-3 pb-2 card-packagehead"><h3>'+item.package_name+'</h3><h4 class="font-weight-normal mt-2 mb-2">Rs.'+item.package_amount+'</h4> <p> '+item.package_duration+'</p> </div> <div class="scrollbar"><span class="packages_scollbar"> </span></div> <p class="mt-3 mb-3 plan-cost text-gray text-center">  <label> <input type="checkbox"  value='+item.id+'  id="add_subscription_package" name="add_subscription_package[]" data-pname="'+item.package_name+'" data-pamount="'+item.package_amount+'"> Select Package </label></div></div>';
    });
     
  });
        $(ele).html(items);
     
  });

}


  function getBookingStatusForReceptionist(ele){
            $.ajax({
                type  : 'GET',
                url   : url+"Common/getBookingStatusForReceptionist",
                async : true,
                dataType : 'json',
                headers:headers,
                success : function(result){
                 if(result.success==true){
                 var items ="<option value=''>--Select Booking Status --</option>";
                 var i;
                 var n = result.data.length;
                for(var i=0; i<n; i++){
                      items+='<option value="'+result.data[i].id+'">'+result.data[i].name+'</option>'; 
                    
                  }
                    
                $(ele).html(items);
                  }        
                }
            });
      }

      function getBookingStatusForPatient(ele){
            $.ajax({
                type  : 'GET',
                url   : url+"Common/getBookingStatusForPatient",
                async : true,
                dataType : 'json',
                headers:headers,
                success : function(result){
                 if(result.success==true){
                 var items ="<option value=''>--Select Booking Status --</option>";
                 var i;
                 var n = result.data.length;
                for(var i=0; i<n; i++){
                      items+='<option value="'+result.data[i].id+'">'+result.data[i].name+'</option>'; 
                    
                  }
                    
                $(ele).html(items);
                  }        
                }
            });
      }

      function getBookingStatusForDoctor(ele){
            $.ajax({
                type  : 'GET',
                url   : url+"Common/getBookingStatusForDoctor",
                async : true,
                dataType : 'json',
                headers:headers,
                success : function(result){
                 if(result.success==true){
                 var items ="<option value=''>--Select Booking Status --</option>";
                 var i;
                 var n = result.data.length;
                for(var i=0; i<n; i++){
                      items+='<option value="'+result.data[i].id+'">'+result.data[i].name+'</option>'; 
                    
                  }
                    
                $(ele).html(items);
                  }        
                }
            });
      }



    // }); // document ready

