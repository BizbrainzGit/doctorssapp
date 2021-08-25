<?php

  $title=" Doctor Appointments Report";
  if($print==1){ $noofrows=12;}else{ $noofrows=12;}
  $string='';


      if(isset($data) && count($data)>0){ 
         
       foreach ($data as $row){
                $id=$row->id;
                
                $doctor_name = $row->doctor_name;
                $doctor_workingdays = $row->working_days;
                $total_appointments = $row->morning_tokens+$row->afternoon_tokens+$row->evening_tokens;
               
                $patientdata = $row->HeaderData;
                $countpatientdata = count($patientdata);

      
$string='<style type="text/css">
  body {
    font-size: 1rem;
    font-family: "Poppins", sans-serif;
    font-weight: initial;
    line-height: normal;
    -webkit-font-smoothing: antialiased;
}
  .stretch-card {
    display: flex;
    align-items: stretch;
    justify-content: stretch;
}
.grid-margin {
    margin-bottom: 1.875rem;
}

.col-lg-12 {
      position: relative;
    width: 98%;
    padding-right: 15px;
    padding-left: 15px;
    float: left;
}

.stretch-card > .card {
    width: 100%;
    min-width:100%;
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
   
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid #e7eaed;*/
    border-radius: 0.375rem;
}
.card .card-body {
    padding: 1.875rem 1.875rem;
}
.card-body {
    flex: 1 1 auto;
    padding: 1.25rem;
}
.card .card-title {
    color: #1c2c42;
    margin-bottom: 1rem;
    text-transform: capitalize;
    font-size: 1rem;
}
h4{
  font-weight: 600;
    line-height: 1;
}
.card .card-description {
    margin-bottom: .875rem;
    font-weight: 400;
    color: #76838f;
}
p {
    font-size: 0.813rem;
    margin-bottom: .4rem;
    line-height: 1.3rem;
    margin-top: 0;
    text-shadow: none;
}
code {
    padding: 5px;
    color: #e94437;
    font-family: sans-serif;
    font-weight: 300;
    font-size: 0.813rem;
    border-radius: 4px;
    word-break: break-word;
}
.pt-3, .py-3 {
    padding-top: 1rem !important;
}
.table-responsive {
    display: block;
    width: 100%;
    overflow-x: auto;
    
}
.table.table-bordered{
    border-top: 1px solid #f6f2f2;
}
.table-responsive > .table-bordered {
    border: 0;
}
.table {
    margin-bottom: 0;
    width: 100%;
    color: #1c2c42;
}
thead {
    display: table-header-group;
    vertical-align: middle;
    border-color: inherit;
}
tr {
    display: table-row;
    vertical-align: inherit;
    border-color: inherit;
}
.table thead th{
    border-top: 0;
    border-bottom-width: 1px;
    font-weight: 600;
    font-size: 0.8125rem;
    padding: 1rem 0.9375rem;
    border-bottom: 1px solid #edeef2;
    text-align: inherit;
}
tbody {
    display: table-row-group;
    vertical-align: middle;
    /*border-color: inherit;*/
}
tr {
    display: table-row;
    vertical-align: inherit;
    /*border-color: inherit;*/
}
.table td {
    font-size: 0.813rem;
    padding: 0.625rem;
    color: #707889;
    /*border-bottom: 1px solid #f6f2f2;*/
    font-weight: 500;
    vertical-align: middle;
    line-height: 1;
}

/*.table-bordered td {
    border: 1px solid #f6f2f2;
    }
.table.table-bordered{
    border-top: 1px solid #f6f2f2;
}*/

</style>

 <body>     
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"> Doctor Name : '.$doctor_name.'</h4>
                  <p class="card-description"> Appointments : <code>'.$total_appointments.'</code>
                    <span style="float: right;">Date : <code>'.$doctor_workingdays.'</code></span>
                  </p>
                  <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>S No.</th>
                          <th>Patient Name</th>
                          <th>Age</th>
                          <th>Phone No.</th>
                          <th>Booking Time</th>
                        </tr>
                      </thead>
                      <tbody>'; 

                      for ($i=0; $i <$countpatientdata; $i++) {
                       
                        $string .= '<tr>
                                        <td>'.$patientdata[$i]->id.'</td>
                                        <td>'.$patientdata[$i]->patient_name.'</td>
                                        <td>'.$patientdata[$i]->age.'</td>
                                        <td>'.$patientdata[$i]->mobileno.'</td>
                                        <td>'.$patientdata[$i]->booking_time.'</td>
                                  </tr>';
                                }

                       $string .= '
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>


          </div>
        </div>
      </div>

          </body>';
// }}
echo $string;

}}
?>


