$(document).ready(function(){


viewdoctorslist();   
        function viewdoctorslist(){
            $.ajax({
                type  : 'GET',
                url   : url+"FrontendController/DoctorsListView",
                dataType : 'json',
               success : function(result){
                     if(result.success===true){
                      doctrosdatalist(result.data);
                     }        
                   }
            });
        }


function doctrosdatalist(data){
                        var doctorslist="";
                        $.each(data,function(index,itemlist) {
                        $.each(itemlist,function(index,item) {
                        doctorslist += '<div class="col-md-12"> <div class="strip_list wow fadeIn"> <a href="#0" class="wish_bt"></a><figure><a href="'+url+'FrontendController/DoctordetailsView/'+item.user_id+'/'+item.account_id+'"><img src="'+url+item.profile_pic_path+'" alt=""></a></figure><small style="color: blue"> '+item.specialization+' </small><h3>Dr. '+item.doctor_name+' </h3><small> '+item.account_name+'</small><p> '+item.business_address+' </p> <span class="rating"><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i><i class="icon_star"></i> <small>(145)</small></span><a href="badges.html" data-toggle="tooltip" data-placement="top" data-original-title="Badge Level" class="badge_list_1"><img src="/<?php echo base_url();?>assets/frontend/img/badges/badge_1.svg" width="15" height="15" alt=""></a> <ul><li><a href="#" target="_blank">Directions</a></li><li><a href="'+url+'FrontendController/DoctordetailsView/'+item.user_id+'/'+item.account_id+'">Book Appointment</a></li> </ul></div></div>';

                          });
                        });
                    $("#doctorslistdata").html(doctorslist);
              
                     }



$("#searchdoctorsdata").click(function(){
//alert("hello");
 var search_loctions        = $('#search_loctions').val()
 var search_specialization  = $('#search_specialization').val()
   $.ajax({
    type:"POST",
    url:url+"FrontendController/DoctorsListView",
    dataType: 'json',
    data:{search_loctions:search_loctions,search_specialization:search_specialization},
    beforeSend: function(){
    // Show image container
    $(".loader").show();
   },
 success: function(result){
      
      if(result.success===true){


        //doctrosdatalist(result.data);

       }
  else if(result.success===false){
         alert(result.message);
      }
    },
    complete:function(){
    // Hide image container
    $(".loader").hide();
}, 
    failure: function (result){
      alert("Some thing went wrong try again ...");
     } 
         
      });


});



$("#bookingview_btn").click(function(){
  //alert("baburao");
  var doctors_id        = $('#booking_doctors_id').val();
  var date              = $('#booking_date1').val();
  var account_id        = $('#booking_account_id').val();
  var time              = $('#booking_time1').val();
  var doctors_fee       = $('#booking_doctors_fee').val();
  var doctors_name      = $('#booking_doctors_name').val();
  // alert(doctors_id+"-"+date+"-"+account_id+"-"+time+"-"+doctors_fee+"-"+doctors_name);
   $.ajax({
    type:"POST",
    url:url+"FrontendController/GetDoctorsAppointmentFrontView",
    dataType: 'json',
    data:{doctors_id:doctors_id,account_id:account_id},
    beforeSend: function(){
    // Show image container
    $(".loader").show();
   },
 success: function(result){
      if(result.success===true){
        alert("baburao");
        //doctrosdatalist(result.data);
        setTimeout('window.location.href = "'+url+'Bookingview"; ',1);
      // $('#patient_bookingdata #patient_booking_doctors_id').val(doctors_id);
      // $('#patient_bookingdata #patient_booking_account_id').val(account_id);
      // $('#patient_bookingdata #patient_booking_date').val(date);
      // $('#patient_bookingdata #patient_booking_time').val(time);
      // $('#patient_bookingdata #patient_booking_doctors_fee').val(doctors_fee);
      // $('#patient_bookingdata #patient_booking_doctors_name').val(doctors_name);

      $('#patient_booking_dateview').html(date);
      $('#patient_booking_timeview').html(time);
      $('#patient_booking_doctors_feeview').html(doctors_fee);
      $('#patient_booking_doctors_nameview').html(doctors_name);

       }
  else if(result.success===false){
         alert(result.message);
      }
    },
    complete:function(){
    // Hide image container
    $(".loader").hide();
}, 
    failure: function (result){
      alert("Some thing went wrong try again ...");
     } 
         
      });


});




});    //  documents ready 

