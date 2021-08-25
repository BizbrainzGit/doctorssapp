<?php
  $title="Receipt"; 
  $logo="https://devapp.adzbill.in/assets/images/BB_Final_1.JPG";
  $logo2="https://devapp.adzbill.in/assets/images/logo.png";
  $string='';
  $string.='<style type="text/css">
         .mainfullwidth{
            width: 100%;
            float: left;
            border:1px solid ;
            border-radius:20px;
           
         }
         .fullwidth{
            width: 100%;
            float: left;
         }
         .width80{
            width: 100%;
            margin:auto;
         }
       
       .width50{
        width: 50%;
        float: left;
       }
       .width30{
        width: 30%;
        float: left;
       }
       .width70{
        width: 70%;
        float: left;
        text-align: center;
       }
       .width75{
        width: 75%;
        float: left;
       }
        .width60{
        width: 60%;
        float: left;
       }
        .width40{
        width: 40%;
        float: left;

       }

       .width20{
        width: 20%;
        float: left;

       }

        .width15{
        width: 15%;
        float: left;

       } 
      .width25{
        width: 25%;
        float: left;

       }

       .width45{
          width: 48%;
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
       p{
        margin: 0px;
        padding: 2px;
       }
       div{
        margin: 0px;
        padding: 0px;
       }
       </style>';
    
  
         if(isset($data) && count($data)>0){ 
                  foreach ($data as $row){

                                        $account_name=$row->account_name;

                                        $package_total_amount=$row->package_total_amount;
                                        $discount_amount=$row->discount_amount;
                                        $sub_total_amount=$row->sub_total_amount;

                                        $igst_amount=$row->igst_amount;
                                        $cgst_amount=$row->cgst_amount;
                                        $sgst_amount=$row->sgst_amount;

                                        $grand_total_amount=$row->grand_total_amount;

                                        $receipt_date=$row->receipt_date;

                                        $address=$row->billing_address;

                                       

                                        if($igst_amount==0){
                                          $gst=($cgst_amount+$cgst_amount);
                                        }else{
                                          $gst=$igst_amount;
                                        }

                                     
                                        $paymentmode_name=$row->paymentmode_name;
                                        
                                        $order_id=$row->order_id;
                                        $transaction_status=$row->transaction_status;
                                        $transaction_amount=$row->transaction_amount; 
                                       
                                        $id=$row->id;
                                      
       
      $string .=' 
<div class="mainfullwidth">
  <div class="width80">
    <div class="fullwidth" style="border-bottom:1px solid;">
          <div class="width15 text-center">
            <img src="'.$logo.'" style="height:80px;" alt="logo">
         </div>
         <div class="width70">
            <h1>'.$title.'</h1>   
         </div>
          <div class="width15 text-center">
            <img src="'.$logo.'" style="height:80px;" alt="logo">
         </div>
    </div>
       <div class="fullwidth">
          <div class="width50">
            <div class="width50">
               <p>Receipt No. :</p>
                </div>
            <div class="width50">
               <div><p>'.$id.'</p></div>
            </div>
         </div>
         <div class="width50">
          <div class="width50">
                 <p>Date :</p>
                </div>
            <div class="width50">
               <div><p>'.$receipt_date.'</p></div>
            </div> 
         </div>
       </div>

    <div class="fullwidth">
          <div class="width50">
            <div class="width50">
               <p>Business Name :</p>
                </div>
            <div class="width50">
               <div><p>'.$account_name.'</p></div>
            </div>
         </div>
   </div>

   <div class="fullwidth">
          <div class="width25">
            <p>Address :</p>
         </div>
         <div class="width75">
             <div><p>'.$address.'</p></div>
         </div>
   </div>

   

          <div class="fullwidth" style="padding:10px;">
                   <div class="width45" style="margin:  0px 3px 0px 3px; border: 1px solid gray; border-radius: 12px;">
                     <div style="height:400px;">
                          <div class="fullwidth"  style="text-align: center; background-color: gray;border-radius: 12px 12px 0px 0px;">
                            <h4>Terms and Conditions</h4>
                         </div>

                        <div class="fullwidth">
                              <ul>
                                <li>After payment clearance only contract will be activation.</li>
                                <li>BizBrainz DOES NOT GUARANTEE and do not intend to guarantee any business to its vendor, it is merely a medium which connects general public with vendors of goods and services listed with BizBrainz.
                              </li>
                              <li>After payment clearance customer should be provide content and photos with in 7 Working days for website </li>
                              <li>Contract’s duration is one year or more, unless determined by the parties under this agreement/contract.
                             </li>
                              
                              </ul> 
                        </div>
                       </div>
                       
                         
                  </div>

              <div class="width45" style="margin: 0px 3px 0px 3px; border: 1px solid gray; border-radius: 12px; ">
                     <div style="height:400px;">
                         <div class="fullwidth"  style="text-align: center;  background-color: gray; border-radius: 12px 12px 0px 0px;">
                            <h4>PAYMENT DETAILS</h4>
                         </div>

                        
                        <div class="fullwidth" style="padding-left: 5px;">
                            <div class="width60"> <p>Package Total Amount: </p> </div>
                            <div class="width30"><p >'.$package_total_amount.'</p ></div>
                        </div> 

                        <div class="fullwidth" style="padding-left: 5px;">
                            <div class="width60"> <p>Discount Amount: </p> </div>
                            <div class="width30"><p >'.$discount_amount.'</p ></div>
                        </div>

                        <div class="fullwidth" style="padding-left: 5px;">
                            <div class="width60"> <p>Sub Total Amount: </p> </div>
                            <div class="width30"><p >'.$sub_total_amount.'</p ></div>
                        </div>

                        <div class="fullwidth" style="padding-left: 5px;">
                            <div class="width60"> <p> GST : </p> </div>
                            <div class="width30"><p >'.$gst.'</p ></div>
                        </div>
                         
                        <div class="fullwidth" style="padding-left: 5px;">
                            <div class="width60"> <p> <b>Grand Total : </b></p> </div>
                            <div class="width30"><p><b>'.$grand_total_amount.'</b></p ></div>
                        </div>

                          <div class="fullwidth" style="padding-left: 5px;">
                           <div class="width30">  <p>Order ID:</p>  </div>
                           <div class="width60">  <p > '.$order_id.' </p > </div>
                         </div>

                         <div class="fullwidth" style="padding-left: 5px;">
                           <div class="width50">  <p>Payment Method:</p>  </div>
                           <div class="width50">  <p > '.$paymentmode_name.' </p > </div>
                         </div>

                         <div class="fullwidth" style="padding-left: 5px;">
                           <div class="width50">  <p>Transaction Amount:</p>  </div>
                           <div class="width50">  <p > '.$transaction_amount.' </p > </div>
                         </div>

                          <div class="fullwidth" style="padding-left: 5px;">
                           <div class="width50">  <p>Transaction Status:</p>  </div>
                           <div class="width50">  <p > '.$transaction_status.' </p > </div>
                         </div>


                            
                        
                      </div>
                 </div>
            <hr>
                           <div class="fullwidth text-center">
                                    <b class="text-uppercase">BizBrainz Technologies Private Limited</b>
                                    <p>CIN: U72900TG2019PTC134639, GST: 36AAICB5799E1ZA </p>
                                    <p>Flat No.16, Paigah Apartments,S.P Road, Secunderabad,Telangana,500003.</p>
                                    <p> +91 733 77 56789 , +91 973 99 89333  Email:
                                       hyd@bizbrainz.in , blr@bizbrainz.in</p>
                                    <p>visit our Website www.bizbrainz.in </p>
                            </div>

  </div>
</div>';


}}

echo $string;



                        
?>

