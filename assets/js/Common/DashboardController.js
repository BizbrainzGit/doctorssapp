

// $(document).ready(function(){

  
function viewAllAppointment(ele){
            $.ajax({
                type  : 'GET',
                url   : url+"DashboardController/AllAppointmentForDashboardData",
                dataType : 'json',
                headers:headers,
                success : function(result){
     if(result.success==true){
                 $(ele).html(result.data[0].total_appointmentacount);
              }        
                }
            });
        }


 
function viewAllPrescription(ele){
            $.ajax({
                type  : 'GET',
                url   : url+"DashboardController/AllPrescriptionForDashboardData",
                dataType : 'json',
                headers:headers,
                success : function(result){
     if(result.success==true){
                 $(ele).html(result.data[0].total_prescriptioncount);
              }        
                }
            });
        }

function viewAllMedicaltestreport(ele){
            $.ajax({
                type  : 'GET',
                url   : url+"DashboardController/AllMedicaltestreportForDashboardData",
                dataType : 'json',
                headers:headers,
                success : function(result){
     if(result.success==true){
                 $(ele).html(result.data[0].total_medicaltestreportcount);
              }        
                }
            });
        }


function viewAllPatient(ele){
            $.ajax({
                type  : 'GET',
                url   : url+"DashboardController/AllPatientForDashboardData",
                dataType : 'json',
                headers:headers,
                success : function(result){
     if(result.success==true){
                 $(ele).html(result.data[0].total_patientcount);
              }        
                }
            });
        }



function viewAllTodayDoctorAppointments(ele){
            $.ajax({
                type  : 'GET',
                url   : url+"DashboardController/AllTodayAppointmentForDashboardData",
                dataType : 'json',
                headers:headers,
                success : function(result){
     if(result.success==true){
                 $(ele).html(result.data[0].total_todayappointmentcount);
              }        
                }
            });
        }

//});    //  documents ready 

