<?php
$title="Prescription";
$urllink=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'?"https" : "http") . "://" .$_SERVER['HTTP_HOST'];
$doctorssapplogo=$urllink."/assets/images/logo.PNG";
$string='';
        if(isset($data) && count($data)>0){ 
                foreach ($data as $row){
                                        $id=$row->id;
                                        $created_date=$row->created_date;
                                        $patient_name=$row->patient_name;
                                        $patient_age=$row->patient_age;
                                        $patient_mobileno=$row->patient_mobileno;

                                        $doctor_name=$row->doctor_name;
                                        $doctor_mobileno=$row->doctor_mobileno;
                                        
                                         $blood_pressure=$row->blood_pressure;
                                         $pulse_rate=$row->pulse_rate;
                                         $symptoms=$row->symptoms;
                                         $diagnosis=$row->diagnosis;
                                         $note=$row->note;
                                         

                                         
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
        width: 80%;
        float: left;

       }
    
    .mainheader{
        height:13%;
    }
    .mainbody{
        height:80%;
    }
    .mainfooter{
        height:7%;
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
                           <p class="text-right"> <b> Date : '.$created_date.'.</b></p>
                           </div>

                            <div class="width40">
                                <table class="table1">
                                    <tr class="text-center">
                                        <th colspan="2" class="text-center"> Patient Details</th>
                                      </tr>
                                    <tr class="text-left">
                                      <td>Patient Name:</td>
                                      <td>'.$patient_name.'</td>
                                    </tr>
                                    <tr class="text-left">
                                      <td>Patient Age :</td>
                                      <td >'.$patient_age.'</td>
                                    </tr>
                                    <tr class="text-left">
                                      <td>Patient Mobile No. :</td>
                                      <td>'.$patient_mobileno.'</td>
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
                                         <th class="text-center">Name </th>
                                         <th class="text-center" colspan="3">Discription </th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    <tr class="text-right">
                                     <td class="text-center">Blood Pressure</td>
                                     <td class="text-center" colspan="3"> '.$blood_pressure.'</td>
                                     </tr>
                                      <tr class="text-right">
                                     <td class="text-center">Pulse Rate</td>
                                     <td class="text-center" colspan="3"> '.$pulse_rate.'</td>
                                     </tr>
                                     <tr class="text-right">
                                     <td class="text-center">Symptoms</td>
                                     <td class="text-center" colspan="3"> '.$symptoms.'</td>
                                     </tr>
                                      <tr class="text-right">
                                     <td class="text-center">Diagnosis</td>
                                     <td class="text-center" colspan="3"> '.$diagnosis.'</td>
                                     </tr>
                                      <tr class="text-right">
                                     <td class="text-center">Note</td>
                                     <td class="text-center" colspan="3"> '.$note.'</td>
                                     </tr>

                                 </tbody>
                                </table>
                            </div>
                        </div>


                      <div class="fullwidth mt-5">
                          <div class="width100">
                                <table class="table css-serial"  >
                                  <thead style="background-color: #1c2c42;color: #ffffff">
                                       <tr>
                                         <th class="text-center">S.No</th>
                                         <th class="text-center">Medical Test Name</th>
                                      </tr>
                                  </thead>
                                  <tbody>';
                                 
                                if(isset($medicaltestdata) && count($medicaltestdata)>0){ 
                                  for($k=0; $k<count($medicaltestdata);$k++){  
                                             $id = $k+1;
                                             $medicaltest_name = $medicaltestdata[$k]['medicaltest_name'];
                                   $string .=  '<tr class="text-right">
                                     <td class="text-center"> '.$id.'</td>
                                     <td class="text-center"> '.$medicaltest_name.'</td>
                                     </tr>';

                                 } }  

                               $string .= '</tbody>
                                </table>
                            </div>
                        </div>



                      <div class="fullwidth mt-5">
                          <div class="width100">
                                <table class="table css-serial"  >
                                  <thead style="background-color: #1c2c42;color: #ffffff">
                                       <tr>
                                         <th class="text-center">S.No</th>
                                         <th class="text-center">Medicine Name</th>
                                         <th class="text-center">Note</th>
                                      </tr>
                                  </thead>
                                  <tbody>';
                                 
                                if(isset($medicinedata) && count($medicinedata)>0){ 
                                  for($j=0; $j<count($medicinedata);$j++){  
                                             $id = $j+1;
                                             $medicine_name = $medicinedata[$j]['medicine_name'];
                                             $medicine_note =  $medicinedata[$j]['medicine_note'];
                                   $string .=  '<tr class="text-right">
                                     <td class="text-center"> '.$id.'</td>
                                     <td class="text-center"> '.$medicine_name.'</td>
                                     <td class="text-center">'.$medicine_note.'</td>
                                     </tr>';

                                 } }  

                               $string .= '</tbody>
                                </table>
                            </div>
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

