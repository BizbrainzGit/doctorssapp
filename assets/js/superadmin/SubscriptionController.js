$(document).ready(function(){


// List  Subscription  Statt //

viewSubscriptions();   
        function viewSubscriptions(){
            $.ajax({
                type  : 'GET',
                url   : url+"superadmin/SubscriptionController/SearchSubscriptionsList",
                async : true,
                dataType : 'json',
                success : function(result){
                    if(result.success===true){
                    subscriptionListview(result.data);
                    }        
                }
            });
        }

function subscriptionListview(subscriptionListdata){

if ( $.fn.DataTable.isDataTable('#subscriptiontable')) {
         $('#subscriptiontable').DataTable().destroy();
         }  
         $('#subscriptiontable tbody').empty();
         var data=subscriptionListdata;
         var table = $('#subscriptiontable').DataTable({
        
         paging: true,
         searching: true,
         columns: [
      {data: 'id',title: 'S No.'},
      {data: 'account_name',title:'Account Name'},
      {data: 'package_name',title:'Subscription Package'},
      {data: 'start_date',title:'Start Date'},
      {data: 'end_date',title:'End Date'},
      {data: 'grand_total_amount',title:'Grand Total'},
      {data: null,
           'title' : 'Action',
           "sClass" : "center",
           mRender: function (data, type, row) {
    return '<button class="btn btn-primary btn-sm subscriptiondata_invoice"><a data-subscriptionid="'+data.id+'" data-subscriptionname="' +data.subscription_name+ '" style="color:#FFFFFF;"><i class="mdi mdi-grease-pencil"></i></a></button>&nbsp; <button class="btn btn-warning btn-sm subscriptiondata_receipt"><a data-subscriptionid="'+data.id+'" data-subscriptionname="' +data.subscription_name+ '"> <i class="mdi mdi-file"></i> </a></button>&nbsp;'
           } }

    ]
 
     //    columnDefs: [{
     //     targets: 7,
     //     render: function(data, type, full, meta){
     //  if(type === 'display'){
     //    if(data == '1' ){
     //         data = '<img id="active" src="'+url+'assets/images/active.png" heignt="32px" width="32px" align="center"/>' 
     //    } else if(data == '0' ){
             
     //         data = '<img id="inactive" src="'+url+'assets/images/inactive.png" heignt="32px" width="32px" align="center"/>'
     //    }          
     //  }
     //      return data;
     //   }
     // }]

  

       });

table.rows.add(data).draw();
}

// List Subscription  End //

// Add Subscription  Start //

$("#add_show_subscription").click(function(){
      $(".listsubscription-class").hide();
      $(".addsubscription-class").show();
});

// $(function () {
//  $("#add_subscriptiondata").steps({
//     headerTag: "h3",
//     bodyTag: "section",
//   });
//  $(".datepicker").datepicker();
// });



var subscriptionform = $("#add_subscriptiondata");
subscriptionform.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
      add_subscription_accountid:"required",
      add_subscription_startdate:"required",
      add_subscription_enddate:"required",
      add_subscription_condition:"required"
    }
});

    subscriptionform.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",

    onStepChanging: function (event, currentIndex, newIndex)
    {   
            // $(".datepicker").datepicker();
         
         if (currentIndex == 0) {
          var n = $("#add_subscription_package:checked").length;
          if(n <=0){
             alert("Please Select Any One Package !!!");
            return false;
          }
        }

         var paymentmodeid = $("#add_subscription_payment_mode:checked").val();
         var add_subscription_chequeno=$("#add_subscription_chequeno").val();
         var add_subscription_cheque_photo=$("#add_subscription_cheque_photo").val();
         var add_subscription_chequeissuedate=$("#add_subscription_chequeissuedate").val();
         
         if(paymentmodeid==2 && (!add_subscription_chequeno ||  add_subscription_chequeno.length<=0) && (!add_subscription_cheque_photo || add_subscription_cheque_photo.length<=0) && (!add_subscription_chequeissuedate || add_subscription_chequeissuedate.length<=0)){
            alert("Please fill all Cheque Mode options!!!");
            return false;
         }
         
         var add_subscription_cashamount=$("#add_subscription_cashamount").val();
         var add_subscription_personame=$("#add_subscription_personame").val();
         
         if(paymentmodeid==1 && (!add_subscription_cashamount || add_subscription_cashamount.length<=0)&& (!add_subscription_personame ||  add_subscription_personame.length<=0) ){
            alert("Please fill all Cash Mode options!!!");
            return false;
         }
         
         if (currentIndex < newIndex)
        {
            // To remove error styles
            $(".body:eq(" + newIndex + ") label.error", subscriptionform).remove();
            $(".body:eq(" + newIndex + ") .error", subscriptionform).removeClass("error");
        }
        //alert(subscriptionform.valid());
        var result = $('ul[aria-label=Pagination]').children().find('a');
        $(result).each(function ()  { 
           if($(this).text() == 'Finish') {
               $(this).attr('disabled', true);
               $(this).css('background', 'green');
               
           }
           });
        
        //alert(currentIndex);
        
        subscriptionform.validate().settings.ignore = ":disabled,:hidden";
        return subscriptionform.valid();
     
    },
    onStepChanged: function (event, currentIndex)
    {    
         var total=0;
         var packagetotal=0;
        $('#totalamount1').show();  
        $('#packagelist1').empty();
        var n = $("#add_subscription_package:checked").length;
        if (n > 0){
            $("#add_subscription_package:checked").each(function(){
                var packagename=$(this).attr("data-pname");
                var packageamount=Number($(this).attr("data-pamount"));
                 packagetotal += Number(packageamount); 
        $('#packagelist1').append('<div class="col-sm-6 col-6 form-group" id="pakagesname"><label>'+packagename+'</label></div> <div class="col-sm-6 col-6 form-group" id="pakagesname"><label>'+packagetotal+'</label></div>');   
  
            });
        }

      var packagetotal= parseFloat(packagetotal).toFixed(2);
      var total=packagetotal;
      var state_id = $('#add_subscription_companyname_state_id').val();
          if(state_id==32){
            var cgst=Number(total*9/100);
            var sgst=Number(total*9/100);
            var cgst= parseFloat(cgst).toFixed(2);
            var sgst= parseFloat(sgst).toFixed(2);
            var grandtoatal= parseFloat(total) + parseFloat(cgst)+parseFloat(sgst);
            var grandtoatal= parseFloat(grandtoatal).toFixed(2);
            var grandtoatal =Math.round(grandtoatal);
            var gst='<div class="col-sm-6 col-6 form-group"> <label> CGST </label></div> <div class="col-sm-6 col-6 form-group"><label>'+cgst+'</label></div> <div class="col-sm-6 col-6 form-group"> <label> SGST</label></div> <div class="col-sm-6 col-6 form-group"><label>'+sgst+'</label></div>';
         }else if(state_id!=32){
           var igst=Number(total*18/100);
           var igst= parseFloat(igst).toFixed(2);
           var grandtoatal= parseFloat(total) + parseFloat(igst);
           var grandtoatal= parseFloat(grandtoatal).toFixed(2);
            var grandtoatal =Math.round(grandtoatal);
          gst='<div class="col-sm-6 col-6 form-group"> <label>IGST</label></div> <div class="col-sm-6 col-6 form-group"><label>'+igst+'</label></div>';
         } 

      $('#totalamount1').empty();
      $('#totalamount1').append('<div class="col-sm-12 col-12"> <div class="row clearfixed"> <div class="col-sm-6 col-6 form-group"> <label> Gross Amount </label></div> <div class="col-sm-6 col-6 form-group"><label>'+total+'</label></div>'+gst+'<div class="col-sm-6 col-6 form-group"> <label> Total Amount </label></div> <div class="col-sm-6 col-6 form-group"><label>'+grandtoatal+'</label></div></div></div>')
      
       $('#add_subscription_total').val(grandtoatal);
       $('#add_subscription_packagetotal').val(packagetotal);

    },
    onFinishing: function (event, currentIndex)
    {  
        subscriptionform.validate().settings.ignore = ":disabled";
        return subscriptionform.valid();
       
    },
    onFinished: function (event, currentIndex)
    {

    var formData = new FormData($("#add_subscriptiondata")[0] );
     $.ajax({
    type:"POST",
    url:url+"superadmin/SubscriptionController/saveSubscription",
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
        $('#subscriptiondata-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
        $( "#subscriptiondata-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
        $('#add_subscriptiondata')[0].reset();
        
         window.setTimeout(function(){location.reload()},3000)

         }
      else{
        $('#subscriptiondata-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#subscriptiondata-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
   complete:function(){
    // Hide image container
    $(".loader").hide();
},    
    failure: function (result){

      $('#subscriptiondata-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#subscriptiondata-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");     
    } 
         
      });

    }

    // $(".datepicker").datepicker();
});

// Add Subscription  End //


// Add Subscription Promocode  Start //

 $("#applypromocode").click(function(){
     
     var add_subscription_promocode = $('#add_subscription_promocode').val();
     var add_subscription_accountid = $('#add_subscription_accountid').val();
     var totalamount = $('#add_subscription_packagetotal').val();
     var state_id = $('#add_subscription_companyname_state_id').val();

        $.ajax({
        type: "POST",
        url:url+'superadmin/SubscriptionController/getAmountPromocode',
        data:{add_subscription_promocode:add_subscription_promocode,add_subscription_accountid:add_subscription_accountid},
        dataType: 'json',
         beforeSend: function(){
            $(".loader").show();
        },  
      success:function(result){
          if(result.success===true)
          { 
              var discountamount=0 ;
            if(result.data[0].discount_amount !='NULL' && result.data[0].discount_amount >0){
            $( "#promcodeamount-msg" ).html("<div class='alert alert-success'>"+result.data[0].discount_amount+"Rs Discount to Using this Promocode </div>"); 
              discountamount=result.data[0].discount_amount;
              var discountamount= parseFloat(discountamount).toFixed(2);
            }else if(result.data[0].discount_percentage != 'NULL' && result.data[0].discount_percentage != ' '){
            $("#promcodeamount-msg" ).html("<div class='alert alert-success'>"+result.data[0].discount_percentage+"% Discount to Using this Promocode </div>");   
                    var percentage=result.data[0].discount_percentage; 
                    discountamount =(totalamount/100) * percentage ; 
                    var discountamount= parseFloat(discountamount).toFixed(2);
            }

        $('#totalamount1').hide();  
        $('#grandtotalamount').empty();
        var total=totalamount-discountamount;
        var total= parseFloat(total).toFixed(2);
          if(state_id==32){
              var cgst=Number(total*9/100);
              var sgst=Number(total*9/100);

              var cgst= parseFloat(cgst).toFixed(2);
              var sgst= parseFloat(sgst).toFixed(2);
              var grandtoatal= parseFloat(total) + parseFloat(cgst)+parseFloat(sgst);
              var grandtoatal= parseFloat(grandtoatal).toFixed(2);
              var grandtoatal =Math.round(grandtoatal);
              var gst='<div class="col-sm-6 col-6"> <label> CGST </label></div> <div class="col-sm-6 col-6"><label>'+cgst+'</label></div> <div class="col-sm-6 col-6"> <label> SGST</label></div> <div class="col-sm-6 col-6"><label>'+sgst+'</label></div>';
             
           }else{
             var igst=Number(total*18/100);
             var igst= parseFloat(igst).toFixed(2);
             var grandtoatal= parseFloat(total) + parseFloat(igst);
             var grandtoatal= parseFloat(grandtoatal).toFixed(2);
             var grandtoatal =Math.round(grandtoatal);
             var gst='<div class="col-sm-6 col-6"> <label>IGST</label></div> <div class="col-sm-6 col-6"><label>'+igst+'</label></div> ';
           } 

          $('#grandtotalamount').append('<div class="col-sm-12 col-12"> <div class="row clearfixed">                                            <div class="col-sm-6 col-6"><label> Package Total </label></div> <div class="col-sm-6 col-6"><label>'+totalamount+'</label></div>      <div class="col-sm-6 col-6"><label> Discount Amount </label></div> <div class="col-sm-6 col-6"><label>'+discountamount+'</label></div> <div class="col-sm-6 col-6"><label>Sub Total</label></div> <div class="col-sm-6 col-6"><label>'+total+'</label></div> '+gst+'<div class="col-sm-6 col-6"> <label>Grand Total</label></div> <div class="col-sm-6 col-6"><label>'+grandtoatal+'</label></div>  </div></div>');

          $('#add_subscription_discountamount').val(discountamount);
          $('#add_subscription_grandtotal').val(grandtoatal);
          $('#add_subscription_total').val('');
          $('#add_subscription_promocode_id').val(result.data[0].id);
          $('#add_subscription_packagetotal').val(totalamount);

          }else if(result.success==false){
            
                $('#totalamount1').hide();  
                $('#grandtotalamount').empty();
                 $('#promcodeamount-msg').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
                 $("#promcodeamount-msg" ).html("<div class='alert alert-danger'>"+result.message+"</div>"); 
              var total=totalamount;
               if(state_id==32){
                var cgst=Number(total*9/100);
                var sgst=Number(total*9/100);
                var cgst= parseFloat(cgst).toFixed(2);
                var sgst= parseFloat(sgst).toFixed(2);
                var grandtoatal= parseFloat(total) + parseFloat(cgst)+parseFloat(sgst);
                var grandtoatal= parseFloat(grandtoatal).toFixed(2);
                  var grandtoatal =Math.round(grandtoatal);
                  var gst='<div class="col-sm-6 col-6"> <label> CGST </label></div> <div class="col-sm-6 col-6"><label>'+cgst+'</label></div> <div class="col-sm-6 col-6 "> <label> SGST</label></div> <div class="col-sm-6 col-6"><label>'+sgst+'</label></div>';
               }else if(state_id!=32){
               var igst=Number(total*18/100);
               var igst= parseFloat(igst).toFixed(2);
               var grandtoatal= parseFloat(total) + parseFloat(igst);
               var grandtoatal= parseFloat(grandtoatal).toFixed(2);
                var grandtoatal =Math.round(grandtoatal);
               var gst='<div class="col-sm-6 col-6"> <label>IGST</label></div> <div class="col-sm-6 col-6"><label>'+igst+'</label></div>';
             } 
           $('#grandtotalamount').append('<div class="col-sm-12 col-12"> <div class="row clearfixed"><div class="col-sm-6 col-6"><label>Package Total</label></div> <div class="col-sm-6 col-6"><label>'+totalamount+'</label></div>'+gst+'<div class="col-sm-6 col-6"> <label> Grand Total </label></div> <div class="col-sm-6 col-6"><label>'+grandtoatal+'</label></div> </div></div>');
            $('#add_subscription_grandtotal').val('');
            $('#add_subscription_total').val(total);
            $('#add_subscription_packagetotal').val(totalamount);
          }
        },

       complete:function(){
        $(".loader").hide();
       },
       failure:function(result){
          alert('Information request failed: ' + textStatus, 'error');
        }
    });
});


// Add Subscription Promocode  End //


// Subscription Invoice Start //


$(document).on('click', '.subscriptiondata_invoice a', function(e){
  var id= $(this).attr("data-subscriptionid");
  var name=$(this).attr("data-subscriptionname");
  $.ajax({
    type: "GET",
    url:url+'superadmin/SubscriptionController/SubscriptionInvoice/'+id,
    dataType: 'json',
    success:function(result){
      if(result.success===true)
      {   
          $(".listsubscription-class").hide();
          $(".subscription_invoice-class").show(); 

        $('#subscription_export_invoice #subscription_invoice_selectedid').val(result.data[0].id); 
        $('#subscription_invoice_id').html(result.data[0].id);
        $('#subscription_invoice_account_name').html(result.data[0].account_name);
        $('#subscription_invoice_address').html(result.data[0].billing_address);
        // $('#subscription_invoice_gstno').html(result.data[0].gst_number);
        $('#subscription_invoice_date').html(result.data[0].invoice_date);
        // $('#subscription_invoice_duedate').html(result.data[0].duedate);
      
        if(result.data[0].cgst_amount!=null && result.data[0].sgst_amount!=null){
            $('#subscription_invoice_cgst').html(result.data[0].cgst_amount);
            $('#subscription_invoice_sgst').html(result.data[0].sgst_amount);
         
         }else{
             
              $('#subscription_invoice_cgst').html(0);
              $('#subscription_invoice_sgst').html(0);

         }

          if( result.data[0].igst_amount!=null){
          $('#subscription_invoice_igst').html(result.data[0].igst_amount);
         }else{
            $('#subscription_invoice_igst').html(0);
         }

        $('#subscription_invoice_packagetotal').html(result.data[0].package_total_amount);
        $('#subscription_invoice_dicount').html(result.data[0].discount_amount);
        $('#subscription_invoice_subtotal').html(result.data[0].sub_total_amount);
        $('#subscription_invoice_grandtotal').html(result.data[0].grand_total_amount);
       
                 
        for(var j=0; j<result.packagesdata.length;j++){
           $("#myTable > tbody").append('<tr class="text-right"><td class="text-left"></td><td class="text-left"> '+result.packagesdata[j][0].package_name+'</td><td>1</td><td>'+result.packagesdata[j][0].package_amount+'</td><td>'+result.packagesdata[j][0].package_amount+'</td></tr>');
                   } 


      }else{
            alert('Invoice Not Generated Please Dealclose Business');
         }
    },
   
 fail:function(result){
      alert('Information request failed: ' + textStatus, 'error');
    }

});
});



   $('#subscription_invoice_pdf').click(excelexport);
   $('#subscription_invoice_print').click(excelexport);

      function DownloadExcelInvoice(link) {
        var downloadurl=url+link;
        window.open(downloadurl, '_blank');
      }

      function excelexport(){
        var subscription_invoice_selectedid = $("#subscription_invoice_selectedid").val();
        var export_type='';
        var id = this.id;
        if(id=='subscription_invoice_pdf'){
          export_type=$("#subscription_invoice_pdf").val();  
        }
        if(id=='subscription_invoice_print'){
          export_type=$("#subscription_invoice_print").val(); 
        }
      
        jQuery.ajax({
          type: "POST",
          url:url+"superadmin/SubscriptionController/SubscriptioninvoiceExport",
          dataType: 'json',
          data:{subscription_invoice_selectedid: subscription_invoice_selectedid,export_type:export_type},
          success: function(result){
            if(result.success===true){
                 $('#subscription_invoice_msg').hide().fadeIn('slow').delay(1350).fadeOut(2200);   
                 $("#subscription_invoice_msg").html("<div class='alert alert-success'>"+result.message+"</div>");
                if(result.download_type=='pdf'){
                  DownloadExcelInvoice(result.data);
                  return false;
                }else{
                  
                    var printWindow = window.open('', '');
                    printWindow.document.write('<html><head><title>Invoice</title>');
                    printWindow.document.write('<link rel="stylesheet" href="'+url+'assets/vendors/css/vendor.bundle.base.css">');
                    printWindow.document.write('<link rel="stylesheet"  href="'+url+'assets/css/vertical-layout-light/style.css">');
                    printWindow.document.write('<link rel="stylesheet" href="'+url+'assets/css/custom.css">');
                    printWindow.document.write('</head><body >');
                    printWindow.document.write(result.data);
                    printWindow.document.write('</body></html>');
                    printWindow.document.close();
                    printWindow.print();
                    
                }
                
            }
            else{
              //window.location.href= '';
              setTimeout(function(){
                $('#subscription_invoice_msg').html('<div class="alert alert-failure">No Data !...</div>');
              },1000);
              }
          },
          failure: function (result){
            setTimeout(function(){
              $('#subscription_invoice_msg').html('<div class="alert alert-failure">Something went wrong in App!...</div>');
            },1000);
            
          }
        });
      }



// Subscription Invoice End  //

// Subscription Receipt Start //


$(document).on('click', '.subscriptiondata_receipt a', function(e){
   var id= $(this).attr("data-subscriptionid");
$.ajax({
    type: "GET",
    url:url+'superadmin/SubscriptionController/SubscriptionReceipt/'+id,
    dataType: 'json',
  success:function(result){
      if(result.success===true)
      { 
      
           $(".listsubscription-class").hide();
           $(".subscription_receipt-class").show(); 

        $('#subscription_export_receipt #subscription_receipt_selectedid').val(result.data[0].id);
        $('#subscription_receipt_date').html(result.data[0].receipt_date);
        $('#subscription_receipt_number').html(result.data[0].id);
        $('#subscription_receipt_account_name').html(result.data[0].account_name);
        $('#subscription_receipt_address').html(result.data[0].billing_address);

        // $('#receipt_email').html(result.data[0].email); 
        // $('#receipt_mobile_no').html(result.data[0].mobile_no);
        
        
         $('#subscription_receipt_package_total_amount').html(result.data[0].package_total_amount);
         $("#subscription_receipt_discount_amount").html(result.data[0].discount_amount);
         $("#subscription_receipt_sub_total").html(result.data[0].sub_total_amount);

       if(result.data[0].cgst_amount!=null && result.data[0].sgst_amount!=null){
        var gst=Number(Number(result.data[0].cgst_amount)+Number(result.data[0].sgst_amount));
       }else if(result.data[0].igst_amount!=null ){
         var gst=Number(result.data[0].igst_amount);
       }
        $("#subscription_receipt_gst").html(gst);

        $("#subscription_receipt_grand_total").html(result.data[0].grand_total_amount);

       
        $("#subscription_receipt_transaction_amount").html(result.data[0].transaction_amount);
        $("#subscription_receipt_transaction_status").html(result.data[0].transaction_status);
        $("#subscription_receipt_payment_methode").html(result.data[0].paymentmode_name);
        $("#subscription_receipt_order_id").html(result.data[0].order_id);
        
       
      }else{
            alert('request failed', 'error');
      }
    },
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }

});

});



    $('#subscription_receipt_pdf').click(receiptexport);
    $('#subscription_receipt_print').click(receiptexport);

    function DownloadExcelReceipt(link) {
      var downloadurl=url+link;
      window.open(downloadurl, '_blank');
    }

    function receiptexport(){
      var subscription_receipt_selectedid = $("#subscription_receipt_selectedid").val();
      var export_type='';
      var id = this.id;
      if(id=='subscription_receipt_pdf'){
        export_type=$("#subscription_receipt_pdf").val();  
      }
      if(id=='subscription_receipt_print'){
        export_type=$("#subscription_receipt_print").val(); 
      }
    
      jQuery.ajax({
        type: "POST",
        url:url+"superadmin/SubscriptionController/SubscriptionreceiptExport",
        dataType: 'JSON',
        data:{subscription_receipt_selectedid: subscription_receipt_selectedid,export_type:export_type},
        success: function(result){
          if(result.success===true){
               $('#subscription_receipt_msg').hide().fadeIn('slow').delay(1350).fadeOut(2200);   
              $("#subscription_receipt_msg").html("<div class='alert alert-success'>"+result.message+"</div>");
              if(result.download_type=='pdf'){
                DownloadExcelReceipt(result.data);
                return false;
              }else{
                
                  var printWindow = window.open('', '');
                  printWindow.document.write('<html><head><title>Receipt</title>');
                  printWindow.document.write('<link rel="stylesheet" href="'+url+'assets/vendors/css/vendor.bundle.base.css">');
                  printWindow.document.write('<link rel="stylesheet"  href="'+url+'assets/css/vertical-layout-light/style.css">');
                  printWindow.document.write('<link rel="stylesheet" href="'+url+'assets/css/custom.css">');
                  printWindow.document.write('</head><body >');
                  printWindow.document.write(result.data);
                  printWindow.document.write('</body></html>');
                  printWindow.document.close();
                  printWindow.print();
                  
              }
              
          }
          else{
            //window.location.href= '';
            setTimeout(function(){
              $('#subscription_receipt_msg').html('<div class="alert alert-failure">No Data !...</div>');
            },1000);
            }
        },
        failure: function (result){
          setTimeout(function(){
            $('#subscription_receipt_msg').html('<div class="alert alert-failure">Something went wrong in App!...</div>');
          },1000);
          
        }
      });
    }


// Subscription Receipt End //


}); // document ready 

