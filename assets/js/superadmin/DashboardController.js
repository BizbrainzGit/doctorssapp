
viewAccountCount();   
function viewAccountCount(){
            $.ajax({
                type  : 'GET',
                url   : url+"superadmin/DashboardController/AccountsCountForSuperAdmin",
                async : true,
                dataType : 'json',
                success : function(result){
                 if(result.success==true){
                   var items = 0;
                   items='<div class="carousel-item active"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.active+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-success">Active Accounts Count</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div><div class="carousel-item"><div class="mb-3 text-center" ><h2 class="mr-3"><span>'+result.inactive+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-success">In-Active Accounts Count</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';

                       $("#allaccount_count").html(items);

                    }        
                }
            });
        }


  


viewAllAppointment();   
function viewAllAppointment(){
            $.ajax({
                type  : 'GET',
                url   : url+"superadmin/DashboardController/totalSubscriptionAmountForSuperAdmin",
                async : true,
                dataType : 'json',
                success : function(result){
     if(result.success==true){
             var items = 0;
              items='<div class="carousel-item active"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.todayamount+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-success">Today Total Amount </h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div><div class="carousel-item"><div class="mb-3 text-center" ><h2 class="mr-3"><span id="total_appts">'+result.totalamount+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-success">Total Amount</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';
                  $("#totalamount_viewdashboard").html(items);
              }        
                }
            });
        }




function TotalAmountData(list){
  var id= list;
 $.ajax({
    type: "GET",
    url:url+'superadmin/DashboardController/totalSubscriptionAmountForSuperAdminByMonth/'+id,
    dataType: 'json',
  success:function(result){
      if(result.success==true)
      { 
          var items = 0;
             items='<div class="carousel-item active"><div class="mb-3 text-center" ><h2 class="mr-3"><span id="total_appts">'+result.totalamount+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-success">Total Appointments</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';
            
             $("#totalamount_viewdashboard").html(items);

       }else{
            alert('request failed', 'error');
      }

    },
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }


});

}

// viewDashboardAllDealclose();   
// function viewDashboardAllDealclose(){
//             $.ajax({
//                 type  : 'GET',
//                 url   : url+"superadmin/DashboardController/AllDealcloseForDashboard",
//                 async : true,
//                 dataType : 'json',
//                 success : function(result){
//      if(result.success==true){
//              var items = 0;
//           if(result.userrole=="Marketing"){
             
//               items='<div class="carousel-item active"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.todaydealclose+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Today Dealclose</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div><div class="carousel-item"><div class="mb-3 text-center" ><h2 class="mr-3"><span id="total_appts">'+result.totaldealclose+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Total Dealclose</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';


//           }else if(result.userrole=="Marketing-Lead"){
              
//               items='<div class="carousel-item active"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.alltodaydealclose+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Today Team Dealclose</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div><div class="carousel-item"><div class="mb-3 text-center" ><h2 class="mr-3"><span id="total_appts">'+result.alltotaldealclose+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Total Team Dealclose</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div><div class="carousel-item"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.todaydealclose+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Today Dealclose</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div><div class="carousel-item"><div class="mb-3 text-center" ><h2 class="mr-3"><span id="total_appts">'+result.totaldealclose+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Total Dealclose</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';

//           }else if(result.userrole=="Tele-Marketing"){

//              items='<div class="carousel-item active"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.todaydealclose+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Today Dealclose</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div><div class="carousel-item"><div class="mb-3 text-center" ><h2 class="mr-3"><span id="total_appts">'+result.totaldealclose+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Total Dealclose</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';

//           }else{
//              items='<div class="carousel-item active"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.todaydealclose+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Today Dealclose</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div><div class="carousel-item"><div class="mb-3 text-center" ><h2 class="mr-3"><span id="total_appts">'+result.totaldealclose+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Total Dealclose</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';
//           }


      
//         $("#alldealclose_viewdashboard").html(items);
//               }        
//                 }
//             });
//         }

// function AllDealcloseData(list){
//   var id= list;
  
//  $.ajax({
//     type: "GET",
//     url:url+'superadmin/DashboardController/AllDealcloseListForDashboardByMonth/'+id,
//     dataType: 'json',
//   success:function(result){
//       if(result.success==true)
//       { 
         
//           var items = 0;
//           if(result.userrole=="Marketing"){
             
//              items='<div class="carousel-item active"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.totaldealclose+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Total Dealclose</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';

//           }else if(result.userrole=="Marketing-Lead"){
             
//              items='<div class="carousel-item active"><div class="mb-3 text-center" ><h2 class="mr-3"><span id="total_dealcloses">'+result.alltotaldealclose+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Total Team Dealclose</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div><div class="carousel-item"><div class="mb-3 text-center" ><h2 class="mr-3"><span id="total_dealcloses">'+result.totaldealclose+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Total Dealclose</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';

//           }else if(result.userrole=="Tele-Marketing"){

//              items='<div class="carousel-item active"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.totaldealclose+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Total Dealclose</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';

//           }else{
//              items='<div class="carousel-item active"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.totaldealclose+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Total Dealclose</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';
//           }

//         $("#alldealclose_viewdashboard").html(items);

//        }else{
//             alert('request failed', 'error');
//       }

//     },
 
//  fail:function(result){
      
//       alert('Information request failed: ' + textStatus, 'error');
//     }


// });

// }



// viewDashboardAllMonthlySales();   
// function viewDashboardAllMonthlySales(){
//             $.ajax({
//                 type  : 'GET',
//                 url   : url+"superadmin/DashboardController/AllMonthlySalesForDashboard",
//                 async : true,
//                 dataType : 'json',
//                 success : function(result){
//      if(result.success==true){
//              var items = 0;
//           if(result.userrole=="Marketing"){
             
//               items='<div class="carousel-item active"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.todaymonthlysales+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Today Sales</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div><div class="carousel-item"><div class="mb-3 text-center" ><h2 class="mr-3"><span id="total_appts">'+result.totalmonthlysales+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Total Sales</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';


//           }else if(result.userrole=="Marketing-Lead"){
              
//               items='<div class="carousel-item active"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.alltodaymonthlysales+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Today Team Sales</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div><div class="carousel-item"><div class="mb-3 text-center" ><h2 class="mr-3"><span id="total_appts">'+result.alltotalmonthlysales+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Total Team Sales</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div><div class="carousel-item"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.todaymonthlysales+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Today Sales</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div><div class="carousel-item"><div class="mb-3 text-center" ><h2 class="mr-3"><span id="total_appts">'+result.totalmonthlysales+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Total Sales</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';

//           }else if(result.userrole=="Tele-Marketing"){

//              items='<div class="carousel-item active"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.todaymonthlysales+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Today Sales</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div><div class="carousel-item"><div class="mb-3 text-center" ><h2 class="mr-3"><span id="total_appts">'+result.totalmonthlysales+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Total Sales</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';

//           }else{
//              items='<div class="carousel-item active"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.todaymonthlysales+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Today Sales</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div><div class="carousel-item"><div class="mb-3 text-center" ><h2 class="mr-3"><span id="total_appts">'+result.totalmonthlysales+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Total Sales</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';
//           }

//         $("#allmonthlysales_viewdashboard").html(items);
//               }        
//                 }
//             });
//         }
// function AllMonthlySalesData(list){
//   var id= list;
//  $.ajax({
//     type: "GET",
//     url:url+'superadmin/DashboardController/AllMonthlySalesListForDashboardByMonth/'+id,
//     dataType: 'json',
//   success:function(result){
//       if(result.success==true)
//       { 
         
//           var items = 0;
//           if(result.userrole=="Marketing"){
             
//              items='<div class="carousel-item active"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.totalmonthlysales+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Total Sales</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';

//           }else if(result.userrole=="Marketing-Lead"){
             
//              items='<div class="carousel-item active"><div class="mb-3 text-center" ><h2 class="mr-3"><span id="total_monthlysaless">'+result.alltotalmonthlysales+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Total Team Sales</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div><div class="carousel-item"><div class="mb-3 text-center" ><h2 class="mr-3"><span id="total_monthlysaless">'+result.totalmonthlysales+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Total Sales</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';

//           }else if(result.userrole=="Tele-Marketing"){

//              items='<div class="carousel-item active"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.totalmonthlysales+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Total Sales</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';

//           }else{
//              items='<div class="carousel-item active"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.totalmonthlysales+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Total Sales</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';
//           }

//         $("#allmonthlysales_viewdashboard").html(items);

//        }else{
//             alert('request failed', 'error');
//       }

//     },
 
//  fail:function(result){
      
//       alert('Information request failed: ' + textStatus, 'error');
//     }

// });

// }



// viewDashboardAllCitywiseSales();   
// function viewDashboardAllCitywiseSales(){
//             $.ajax({
//                 type  : 'GET',
//                 url   : url+"superadmin/DashboardController/AllSalesForDashboardByCitywise",
//                 async : true,
//                 dataType : 'json',
//                 success : function(result){
//      if(result.success==true){
          
//        var data =result.data;
//        var items = "";
//        var i;
//        var n = data.length;
//     for(i=0;i<n;i++) {
//         items+='<div class="row mt-2  d-sm-flex"><div class="col-6 col-sm-6 text-left"><h5>'+data[i].cityname+'</h5></div><div class="col-6 col-sm-6 text-left"><h5>'+data[i].totalamount+'</h5> </div></div>'
//          }
    
     
//       var data1 =result.todaycitywisesales;
//          if((data1.length)>0){
//        var items1 = "";
//        var j;
//        var n = data1.length;
//      for(j=0;j<n;j++) {
//         items1+='<div class="row mt-2  d-sm-flex"> <div class="col-6 col-sm-6 text-left"><h5>'+data1[j].cityname+'</h5></div><div class="col-6 col-sm-6 text-left"><h5>'+data1[j].totalamount+'</h5> </div></div>'
//          }
//          }else{
//           items1='<div class="row mt-2  d-sm-flex"> <div class="col-6 col-sm-6 text-left"><h5></h5></div><div class="col-6 col-sm-6 text-left"><h5> 0 </h5> </div></div>'
//          }

//    $("#alltotalsalescitywise_monthname").html(result.monthview);
//    $("#alltotalsalescitywise").html(items);
//    $("#todaytotalsalescitywise").html(items1);
       
//               }        
//                 }
//             });
//         }

// function AllSalesCitywiseData(list){
  
//    $(".class-hide").hide();
//   var id= list;
//  $.ajax({
//     type: "GET",
//     url:url+'superadmin/DashboardController/AllSalesForDashboardByCitywiseMonth/'+id,
//     dataType: 'json',
//   success:function(result){
//       if(result.success==true)
//       {
//                var data =result.data;
//                var items = "";
//                var i;
//                var n = data.length;

//             for(i=0;i<n;i++) {
//                 items+='<div class="row mt-2  d-sm-flex"><div class="col-6 col-sm-6 text-left"><h5>'+data[i].cityname+'</h5></div><div class="col-6 col-sm-6 text-left"><h5>'+data[i].totalamount+'</h5> </div></div>'
//                  }
   
//              $("#alltotalsalescitywise_monthname").html(result.monthview);
//              $("#alltotalsalescitywise").html(items);

//        }else{
//             alert('request failed', 'error');
//       }

//     },
 
//  fail:function(result){
      
//       alert('Information request failed: ' + textStatus, 'error');
//     }


// });

// }