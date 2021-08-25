<?php
$title="Patients Medical Tests Receipt";
$urllink=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'?"https" : "http") . "://" .$_SERVER['HTTP_HOST'];
$doctorssapplogo=$urllink."/assets/images/logo.PNG";

  $string='';

        if(isset($data) && count($data)>0){ 
                foreach ($data as $row){
                                        $id=$row->id;
                                        $billing_date=$row->billing_date;

                                        $patient_username=$row->patient_username;
                                        $patient_name=$row->patient_name;
                                        $patient_mobileno=$row->patient_mobileno;

                                        $doctor_username=$row->doctor_username;
                                        $doctor_name=$row->doctor_name;
                                        $doctor_mobileno=$row->doctor_mobileno;

                                         
                                        $test_total_amount=$row->test_total_amount;
                                        $discount_amount=$row->discount_amount;
                                        $sub_total_amount=$row->sub_total_amount;
                                        $gst_amount=$row->gst_amount;
                                        $grand_total_amount=$row->grand_total_amount;
                                      

                                         
                 }}
                                        
           if(isset($accountdata) && count($accountdata)>0){ 
                            foreach ($accountdata as $row){
                                        $account_name=$row->account_name;
                                        $business_address=$row->business_address;
                                        $mobilenoemail=$row->mobilenoemail;
                                        $logo=$row->logo;
                                         
                               }}

           $string .=' <style type="text/css">

      .mainfullwidth{
            width: 100%;
            float: left;
          }

          .

         .fullwidth{
             width: 100%;
             float: left;
            margin: 15px 0px 15px 0px;
         }

         .width80{
             width: 100%;
             margin:auto;
         }

           .width10{
        width: 10%;
        float: left;

       }
       .widthnew80{
        width: 78%;
        float: left;

       }
    
    .mainheader{
        height:15%;
    }
    .mainbody{
        height:75%;
    }
    .mainfooter{
        height:10%;
    }
        .width100{
              width: 100%;
             float: left; 
         }  
       
       .width50{
        width: 50%;
        float: left;  
      }

       .width40{
        width: 44%;
        float: left;
      }
       .width20{
        width: 10%;
        float: left;  
         
      }

        .text-uppercase{
        text-transform: uppercase;
       }

  .text-left{
        text-align: left;
  }
     
     .text-center{
       text-align: center;
    }
.text-right
{
       text-align:right;
    }
 
.text-white {
    color: #ffffff ;
}
.bg-secondary {
    background-color: #707889 ;
}
.bg-warning{
    background-color: #fbbc06;
}
 
 .table-bordered {
    border: 1px solid #f6f2f2;
}
.table{
    width: 100%;
    margin-bottom: 1rem;
    color: #1c2c42;
}
.table {
    border-collapse: collapse;
}   

.table1 th {
    padding: 1.25rem 0.9375rem;
    vertical-align: top;
    border:none;
}              

  .table1 td {
    font-size: 0.813rem;
    padding: 0.625rem;
    color: #707889;
   border:none;
    font-weight: 500;
} 
.table th {
    padding: 5px 5px;
    border-top: 1px solid #f6f2f2;
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



 </style>

                        <div class="mainfullwidth">
                          <div class="width80">
                        <div class="mainheader">
                           <div class="width10 text-center">
                               <img src="'.$urllink.'/'.$logo.'" width="100px"  height="100px"> 
                              </div>
                              <div class="widthnew80 text-center">
                                    <b class="text-uppercase text-center">'.$account_name.'</b>
                                    <p>'.$business_address.'</p>
                                    <p>'.$mobilenoemail.'</p>
                              </div>
                              <div class="width10 text-center">
                               <img src="'.$doctorssapplogo.'" width="100px"  height="100px" >
                             </div>
                             
                        </div>

                          <hr>

                        <div class="mainbody">   
                         <div class="fullwidth">

                            <div class="width100 text-center">                              
                              <h4>'.$title.'</h1>
                            </div>

                           <div class="width50 text-left"> 
                              <p><b>Receicpt No : '.$id.'.</b></p>
                           </div> 

                           <div class="width50">
                           <p class="text-right"> <b> Date : '.$billing_date.'.</b></p>
                           </div>

                            <div class="width40">
                                <table class="table1">
                                    <tr class="text-center">
                                        <th colspan="2" class="text-center"> Patient Details</th>
                                      </tr>
                                    <tr class="text-left">
                                      <td>Patient User Id :</td>
                                      <td><span>'.$patient_username.'</span></td>
                                    </tr>
                                    <tr class="text-left">
                                      <td>Patient Name :</td>
                                      <td ><span>'.$patient_name.'</span></td>
                                    </tr>
                                    <tr class="text-left">
                                      <td>Patient Mobile No. :</td>
                                      <td><span>'.$patient_mobileno.'</span></td>
                                    </tr>
                                </table>
                              </div>

                           <div class="width20">
                              <h1></h1>
                           </div>

                            <div class="width40">
                                <table class="table1">
                                    <tr class="text-center">
                                        <th colspan="2"> Doctor Details</th>
                                      </tr>
                                    <tr class="text-left">
                                      <td>Doctor User Id :</td>
                                      <td ><span>'.$doctor_username.'</span></td>
                                    </tr>
                                    <tr class="text-left">
                                    <td>Doctor Name:</td>
                                      <td ><span>'.$doctor_name.'</span></td>
                                      
                                    </tr>
                                    <tr class="text-left">
                                      <td >Doctor Mobile No. :</td>
                                      <td><span>'.$doctor_mobileno.'</span></td>
                                    </tr>
                                </table>
                              </div>

                       </div>

                      <div class="fullwidth mt-5">
                          <div class="width100">
                                <table class="table css-serial"  >
                                  <thead style="background-color: #1c2c42;color: #ffffff">
                                       <tr>
                                         <th class="text-center">S.No</th>
                                         <th class="text-center">Medical Tests</th>
                                         <th class="text-center">Discription</th>
                                         <th class="text-center">Total Amount</th>
                                      </tr>
                                  </thead>
                                  <tbody>';
                                 
                                if(isset($patientbillingtest) && count($patientbillingtest)>0){ 
                                  for($j=0; $j<count($patientbillingtest);$j++){  
                                             $id = $j+1;
                                             $medicaltest_name = $patientbillingtest[$j]['medicaltest_name'];
                                             $discretion =  $patientbillingtest[$j]['discretion'];
                                             $medicaltest_price =  $patientbillingtest[$j]['medicaltest_price'];

                                   $string .=  '<tr class="text-right">
                                     <td class="text-center"> '.$id.'</td>
                                     <td class="text-center"> '.$medicaltest_name.'</td>
                                     <td class="text-center">'.$discretion.'</td>
                                     <td class="text-center">'.$medicaltest_price.'</td>
                                     </tr>';

                                 } }  


                               $string .= '</tbody>
                                </table>
                            </div>
                        </div>
                  
                        <div class="fullwidth">
                      
                        <p class="text-right mb-2">Tests Total Amount:&nbsp; &nbsp;'.$test_total_amount.'</p>
                        <p class="text-right mb-2">Discount Amount:&nbsp; &nbsp;'.$discount_amount.'</p>
                        <p class="text-right mb-2">Sub Total Amount: &nbsp; &nbsp;'.$sub_total_amount.'</p>
                        <p class="text-right">GST (18%) :&nbsp; &nbsp;'.$gst_amount.'</p> 
                        <h4 class="text-right mb-5">Grand Total : &nbsp; &nbsp;'.$grand_total_amount.'</h4>

                        </div>

                  
                </div>
                 <div class="mainfooter">
                  <hr>
                           <div class="fullwidth">
                           <div class="width100 text-center">
                                 <b class="text-uppercase">BizBrainz Technologies Private Limited.</b>
                                  <p>Visit Our Website www.bizbrainz.in </p>
                            </div>
                          </div> 
                  </div>

                  </div>
              </div>';

            // }}

  echo $string; 

?>

