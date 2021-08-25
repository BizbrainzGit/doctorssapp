
viewDoctorsCount();   
function viewDoctorsCount(){
            $.ajax({
                type  : 'GET',
                url   : url+"admin/AdminDashboardController/DoctorsCountForAdmin",
                async : true,
                dataType : 'json',
                success : function(result){
                 if(result.success==true){
                   var items = 0;
                   items='<div class="carousel-item active"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.doctorscount+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-success">Total Doctors</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';

                    $("#total_doctorscount").html(items);

                    }        
                }
            });
        }


  
viewPatientsCount();   
function viewPatientsCount(){
            $.ajax({
                type  : 'GET',
                url   : url+"admin/AdminDashboardController/PatientsCountForAdmin",
                async : true,
                dataType : 'json',
                success : function(result){
                 if(result.success==true){
                   var items = 0;
                   items='<div class="carousel-item active"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.patientscount+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-success">Total Patients</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';
                    $("#total_patientscount").html(items);

                    }        
                }
            });
        }



viewAllAppointment();   
function viewAllAppointment(){
            $.ajax({
                type  : 'GET',
                url   : url+"admin/AdminDashboardController/totalAppointmentsForAdmin",
                async : true,
                dataType : 'json',
                headers:headers,
                success : function(result){
     if(result.success==true){
             var items = 0;
              items='<div class="carousel-item active"><div class="mb-3 text-center"><h2 class="mr-3"><span>'+result.todayappts+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-success">Today Total Appointments </h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div><div class="carousel-item"><div class="mb-3 text-center" ><h2 class="mr-3"><span>'+result.totalappts+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-success">Total Appointments</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';
                  $("#totalapp_viewdashboard").html(items);
              }        
                }
            });
        }




function TotalAppointmentData(list){
  var id= list;
 $.ajax({
    type: "GET",
    url:url+'admin/AdminDashboardController/totalAppointmentsForAdminByMonth/'+id,
    dataType: 'json',
     headers:headers,
  success:function(result){
      if(result.success==true)
      { 
          var items = 0;
             items='<div class="carousel-item active"><div class="mb-3 text-center" ><h2 class="mr-3"><span>'+result.totalappts+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-success">Total Appointments</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';
            
             $("#totalapp_viewdashboard").html(items);

       }else{
            alert('request failed', 'error');
      }

    },
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }


});

}
