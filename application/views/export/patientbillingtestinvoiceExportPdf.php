<?php
$title="Invoice";
$logo="https://devapp.adzbill.in/assets/images/BB_Final_1.JPG";
$logo2="https://devapp.adzbill.in/assets/images/logo.png";
if($print==1){ $noofrows=12;}else{ $noofrows=20;}
  $string='';
  
   // if(isset($invoicedata) && count($invoicedata)>0){ 
   //                                          foreach ($invoicedata as $row){
   //                                      $created_on=$row->created_on; 
   //                                       }} 


             if(isset($data) && count($data)>0){ 
                foreach ($data as $row){

                                        $account_name=$row->account_name;
                                        $billing_address=$row->billing_address;

                                        $package_total_amount=$row->package_total_amount;
                                        $discount_amount=$row->discount_amount;
                                        $sub_total_amount=$row->sub_total_amount;
                                        $grand_total_amount=$row->grand_total_amount;
                                        
                                        $invoice_date=$row->invoice_date; 
                                        $receipt_no=$row->id; 
                                      
                                        $sgst=$row->sgst_amount;
                                        $cgst=$row->cgst_amount;
                                        $igst=$row->igst_amount;

                                        
}}
                                        
           

      $string =' <style type="text/css">
        .mainfullwidth{
            width: 100%;
            float: left;
            
         }
         .fullwidth{
            width: 100%;
            float: left;
            margin: 10px 0px 10px 0px;
         }
         .width30{
        width: 30%;
        float: left;
       }
        .width20{
        width: 20%;
        float: left;

       }
        .width10{
        width: 10%;
        float: left;

       }
       .widthnew80{
        width: 80%;
        float: left;

       }
        .width25{
        width: 25%;
        float: left;

       }
      
       .width70{
        width: 70%;
        float: left;
       }
       .width75{
        width: 75%;
        float: left;
       }
         .width80{
            width: 100%;
            margin:left;
         }
       
       .width50{
        width: 50%;
        float: left;
       }
       .text-uppercase{
        
        text-transform: uppercase;
       }
       .text-right{
        text-align: right;
       }
     
      .text-center{
        text-align: center;
       }

       table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
} 

p{   
        margin: 0px;
        padding: 2px;
       }
       div{
        margin: 0px;
        padding: 0px;
       }
 </style>


  <div class="mainfullwidth">
              <div class="width80">
                      <div class="fullwidth">
                            <div class="width10 text-center"><img src="'.$logo.'" style="height:100px;" alt="logo"> 
                            </div>
                            <div class="widthnew80 text-center">
                                    <b class="text-uppercase text-center">BizBrainz Technologies Private Limited</b>
                                    <p>Flat No.16, Paigah Apartments,S.P Road, Secunderabad, Telangana, 500003.</p>
                                    <p> +91 733 77 56789, +91 973 99 89333. Email: hyd@bizbrainz.in, blr@bizbrainz.in</p>
                              </div>
                              <div class="width10 text-center"><img src="'.$logo2.'" style="height:100px;" alt="logo"> 
                            </div>
                         </div>



                    <hr>
                    <div class="fullwidth">
                    <div class="col-lg-12 pl-0 text-center text-uppercase">                              
                              <h1>Invoice</h1>
                            </div> 
                     <div class="width50"> 
                         <p><b>Invoice No : '.$receipt_no.'.</b></p>
                      </div> 
                       <div class="width50">
                        <p class="text-right"> <b>Invoice Date : '.$invoice_date.'.</b></p>
                      </div>
                       <div class="width50 text-uppercase">
                            <p><b>BizBrainz Technologies Private Limited.</b></p>
                              <p>Flat No.16, Paigah Apartments<br>S.P Road, Secunderabad,<br>Telangana,500003.</p>
                              <p>GST No. : 36AAICB5799E1ZA </p>
                      </div>
                      <div class="width50 text-uppercase text-right"> 
                         
                              <p class="mt-5 mb-2 text-right"><b>'.$account_name.'</b></p>
                              <p class="text-right">'.$billing_address.'</p>
                            

                      </div>
                      
                   </div>
                    
                      <div class="fullwidth" >
                            <table class="table">
                                  <thead style="background-color: #1c2c42;color: #ffffff">
                                    <tr>
                                        <th>Description</th>
                                        <th>Quantity</th>
                                        <th>Unit cost</th>
                                        <th>Total</th>
                                      </tr>
                                  </thead>
                                  <tbody> ' ;
                                 
                                if(isset($packageslist) && count($packageslist)>0){ for($j=0; $j<count($packageslist);$j++){  
                                             $package_amount = $packageslist[$j][0]['package_amount']+$uppersale;
                                             $package_name =  $packageslist[$j][0]['package_name'];

                                   $string .=  '<tr class="text-right">
                                     <td class="text-left"> '.$package_name.'</td>
                                     <td>1</td>
                                     <td>'.$package_amount.'</td>
                                     <td>'.$package_amount.'</td>
                                     </tr>';

                                 } }  

                                

                               $string .=   '</tbody>
                            </table>
                        </div>
                       <div class="fullwidth">
                        <p class="text-right mb-2">Package Total Amount:&nbsp; &nbsp;'.$package_total_amount.'</p>
                        <p class="text-right mb-2">Discount Amount:&nbsp; &nbsp;'.$discount_amount.'</p>
                        <p class="text-right mb-2">Sub Total Amount: &nbsp; &nbsp;'.$sub_total_amount.'</p>
                        <p class="text-right">SGST (9%) :&nbsp; &nbsp;'.$sgst.'</p>
                        <p class="text-right">CGST (9%) :&nbsp; &nbsp;'.$cgst.'</p>
                        <p class="text-right">IGST (18%) :&nbsp; &nbsp;'.$igst.'</p> 
                        <h4 class="text-right mb-5">Grand Total : &nbsp; &nbsp;'.$grand_total_amount.'</h4>
                            <hr>
                        </div>
                        <div class="fullwidth text-center">
                                    <b class="text-uppercase">BizBrainz Technologies Private Limited.</b>
                                     <p>Visit Our Website www.bizbrainz.in </p>
                            </div>
                 </div>
              </div> ';

            // }}

  echo $string; 

?>

