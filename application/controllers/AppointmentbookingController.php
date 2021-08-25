<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/CommonBaseController.php');
error_reporting(0);
ob_start();
use Illuminate\Database\Query\Expression as raw;
use \Illuminate\Database\Capsule\Manager as Capsule;

class AppointmentbookingController extends CommonBaseController {
	
	public function __construct()
	{
		parent::__construct();
		 $this->load->library(array('form_validation','ValidationTypes','excel','session','ion_auth'));
		 $this->load->helper(array('url','html','form','util_helper','language'));
		 $this->load->database();
		 $this->load->model('User');
		 $this->load->model('Userdetails_model'); 
     $this->load->model('Customdata_model');
		 $this->load->model('customerdb/Appointmentbooking_model');
     $this->load->model('customerdb/Prescription_model');
     $this->load->model('customerdb/PrescriptionTests_model');
    }
	
public function AdminAppointmentBookingView()
      {
          $this->load->view('admin/appointmentbookingview');
      }

public function AdminNewAppointmentBookingView()
      {
          $this->load->view('admin/newappointmentbookingview');
      }

public function AdminPendingForApprovalAppointmentsView()
      {
          $this->load->view('admin/pendingforapprovalappointmentsview');
      }      

public function DoctorAppointmentView()
      {
          $this->load->view('doctor/appointmentbookingview');
        }

public function ReceptionistAppointmentView()
      {
          $this->load->view('receptionist/appointmentbookingview');
      }  
public function ReceptionistNewAppointmentBookingView()
      {
          $this->load->view('receptionist/newappointmentbookingview');
      }            
public function ReceptionistPendingForApprovalAppointmentsView()
      {
          $this->load->view('receptionist/pendingforapprovalappointmentsview');
      }      


public function PatientAppointmentBookingView()
      {
          $this->load->view('patient/appointmentbookingview');
      }
public function PatientNewAppointmentBookingView()
      {
          $this->load->view('patient/newappointmentbookingview');
      }


 public function SearchAppointmentbookingList()
		{
            
            $masterdb = $this->db->database;
            $userrole=$this->session->userdata('user_roles');

            if($userrole=="Doctor"){
              $doctors_id=$this->ion_auth->get_user_id();

              }
              if($userrole=="Patient"){
               $patients_id=$this->ion_auth->get_user_id();
              }
             $searchdata=$this->Appointmentbooking_model->SearchAppointmentbooking($doctors_id,$patients_id,$masterdb);
           	 echo json_encode(array('success'=>true,'data'=>$searchdata,'role'=>$userrole));
				return;
	   
		}


    public function editStatusByid($id)
		  {
			   $result=Appointmentbooking_model::where('id','=',$id)->get(['status_id','id']);
	        echo json_encode(array('success'=>true,'data'=>$result));
	     
        }

      


    public function updateStatusByid(){

        $appointmentbooking_change_status_id    = $this->input->post("appointmentbooking_change_status_id");
        $appointmentbooking_change_status       = $this->input->post("appointmentbooking_change_status");
        $postData=array();
		    $changestatus = [];
		    $postData = dataFieldValidation($appointmentbooking_change_status, "Status",$changestatus,"status_id","",$postData,"statusarray");
        $updateStatus = $this->Appointmentbooking_model->updateStatus($postData['dbinput']['statusarray'],$appointmentbooking_change_status_id);
        
             if($updateStatus){
     
               $appiontmentdata=$this->Appointmentbooking_model->EditAppointmentbooking($appointmentbooking_change_status_id);
               $appointmentbooking_patient=$appiontmentdata[0]['patients_id'];
               $appointmentbooking_doctor=$appiontmentdata[0]['doctors_id'];
               $appointdate=$appiontmentdata[0]['appointment_date'];
               $appointtime=$appiontmentdata[0]['time_slot'];

               $patientdata=$this->User->findById($appointmentbooking_patient);
               $patientname=$patientdata[0]['first_name'].' '.$patientdata[0]['last_name'];
               $patient_email=$patientdata[0]['email'];
               $patient_mobile=$patientdata[0]['mobileno'];


               $doctordata=$this->User->findById($appointmentbooking_doctor);
               $doctorname=$doctordata[0]['first_name'].' '.$doctordata[0]['last_name'];
               $doctor_email=$doctordata[0]['email'];
               $doctor_mobile=$doctordata[0]['mobileno'];

              
              if ($appointmentbooking_change_status==2) {
                  $subject='Appointment Booking Confirmed';
                  $body=Customdata_model::where('content_type','=','PatientAppointmentConfimred')->first()->content;
                  $body=str_replace("{Name}",$patientname,$body);
                  $body=str_replace("{Doctor_name}",$doctorname,$body);
                  $body=str_replace("{Date}",$appointdate,$body);
                  $body=str_replace("{Time}",$appointtime,$body);
                  sendEmail("bizbrainz2020@gmail.com","Administrator",$patient_email,$subject,$body,null);


                 $patient_mobile = $patient_mobile;
                 $patient_massage = "Dear ".$patientname.", Your appointment is confirmed with Dr. ".$doctorname." on ".$appointdate." at ".$appointtime.". Please report 15 mins before the scheduled time.";
                 sendSMS($patient_mobile, $patient_massage);


                  $body1=Customdata_model::where('content_type','=','DoctorAppointmentConfirmed')->first()->content;
                  $body1=str_replace("{Name}",$doctorname,$body1);
                  $body1=str_replace("{Patient_name}",$patientname,$body1);
                  $body1=str_replace("{Date}",$appointdate,$body1);
                  $body1=str_replace("{Time}",$appointtime,$body1);
                  sendEmail("bizbrainz2020@gmail.com","Administrator",$doctor_email,$subject,$body1,null);


                 $patient_mobile = $patient_mobile;
                 $patient_massage = "Dear ".$patientname.", Your appointment is confirmed with Dr. ".$doctorname." on ".$appointdate." at ".$appointtime.". Please report 15 mins before the scheduled time.";
                 sendSMS($patient_mobile, $patient_massage);

                  

              }else if ($appointmentbooking_change_status==3||$appointmentbooking_change_status==6) {

                $subject='Appointment Booking Cancelled';
                  $body=Customdata_model::where('content_type','=','PatientAppointmentCancelled')->first()->content;
                  $body=str_replace("{Name}",$patientname,$body);
                  $body=str_replace("{Doctor_name}",$doctorname,$body);
                  $body=str_replace("{Date}",$appointdate,$body);
                  $body=str_replace("{Time}",$appointtime,$body);
                  sendEmail("bizbrainz2020@gmail.com","Administrator",$patient_email,$subject,$body,null);

                  $patient_mobile = $patient_mobile;
                  $patient_massage = "Dear ".$patientname.", Your appointment is cancelled  with Dr. ".$doctorname." on ".$appointdate." at ".$appointtime." on your request.";
                 sendSMS($patient_mobile, $patient_massage);


                  $body1=Customdata_model::where('content_type','=','DoctorAppointmentCancelled')->first()->content;
                  $body1=str_replace("{Name}",$doctorname,$body1);
                  $body1=str_replace("{Patient_name}",$patientname,$body1);
                  $body1=str_replace("{Date}",$appointdate,$body1);
                  $body1=str_replace("{Time}",$appointtime,$body1);
                  sendEmail("bizbrainz2020@gmail.com","Administrator",$doctor_email,$subject,$body1,null); 

                  $patient_mobile = $patient_mobile;
                  $patient_massage = "Dear ".$patientname.", Your Appointment is Cancelled with Dr. ".$doctorname." on ".$appointdate." at ".$appointtime.". Sorry for the inconvenience.";
                 sendSMS($patient_mobile, $patient_massage);

                  
              }
             

               
		          echo json_encode(array('success'=>true,'message'=>UPDATE_MSG,'data'=>$updateStatus));
		          return;
              
              }else{
                  echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
		              return;

                  }	
  }
      

public function saveAppointmentbookingData(){
            
            $appointmentbooking_department   = $this->input->post("add_appointmentbooking_department");
            $appointmentbooking_doctor       = $this->input->post("add_appointmentbooking_doctor");
            $appointmentbooking_date1         = $this->input->post("add_appointmentbooking_date");
            $appointmentbooking_date         = date('Y-m-d', strtotime($appointmentbooking_date1));
            $appointmentbooking_status       = 1;
            $appointmentbooking_description  = $this->input->post("add_appointmentbooking_description");
            $appointmentbooking_timeslot     = $this->input->post("add_appointmentbooking_timeslot");
           

 
            if ($this->session->userdata('user_roles')=='Patient') {
            	$appointmentbooking_patient  =  $this->ion_auth->get_user_id();
            } else {
            	 $appointmentbooking_patient = $this->input->post("add_appointmentbooking_patient");
            }
                

            // $count=Appointmentbooking_model::where('doctors_id','=',$appointmentbooking_doctor)->count();
            //   if($count>10){
            //         echo json_encode(array('success'=>false,'message'=>APPOINTMENTBOOKING_FAIL_MSG));
            //         return;
            //     }

           
         $postData=array();

         $appointmentdetails=[];
         
         $postData = dataFieldValidation($appointmentbooking_patient, "Appointment Patient",$appointmentdetails,"patients_id","",$postData,"appointmentdetailsarray");
         $postData = dataFieldValidation($appointmentbooking_doctor, "Appointment Doctor",$appointmentdetails,"doctors_id","",$postData,"appointmentdetailsarray");
         $postData = dataFieldValidation($appointmentbooking_department, "Department",$appointmentdetails,"specialization_id","",$postData,"appointmentdetailsarray");
         $postData = dataFieldValidation($appointmentbooking_date, "Appointment Date",$appointmentdetails,"appointment_date","",$postData,"appointmentdetailsarray");

         $postData = dataFieldValidation($appointmentbooking_status, "Appointment Doctor",$appointmentdetails,"status_id","",$postData,"appointmentdetailsarray");
         $postData = dataFieldValidation($appointmentbooking_description, "Description",$appointmentdetails,"diseases_description","",$postData,"appointmentdetailsarray");
         $postData = dataFieldValidation($appointmentbooking_timeslot, "Appointment TimeSlot",$appointmentdetails,"time_slot","",$postData,"appointmentdetailsarray");
        
         

		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
        
		    $userId = $this->ion_auth->get_user_id();
        $createdlog=isCreatedLog($userId);

	    $appointmentarray = array_merge($postData['dbinput']['appointmentdetailsarray'],$createdlog);
	    $appointmentbooking_save = $this->Appointmentbooking_model->addAppointmentbooking($appointmentarray);
          
      if($appointmentbooking_save){

               $patientdata=$this->User->findById($appointmentbooking_patient);
               $patientname=$patientdata[0]['first_name'].' '.$patientdata[0]['last_name'];
               $patient_email=$patientdata[0]['email'];
               $patient_mobile=$patientdata[0]['mobileno'];

               $doctordata=$this->User->findById($appointmentbooking_doctor);
               $doctorname=$doctordata[0]['first_name'].' '.$doctordata[0]['last_name'];
               $doctor_email=$doctordata[0]['email'];
               $doctor_mobile=$doctordata[0]['mobileno'];

              $subject='Appointment Booking';
             
              $appointdate=$appointmentbooking_date;
              $appointtime=$appointmentbooking_timeslot;

              $body=Customdata_model::where('content_type','=','PatientAppointmentBooking')->first()->content;
              $body=str_replace("{Name}",$patientname,$body);
              $body=str_replace("{Doctor_name}",$doctorname,$body);
              $body=str_replace("{Date}",$appointdate,$body);
              $body=str_replace("{Time}",$appointtime,$body);
              sendEmail("bizbrainz2020@gmail.com","Administrator",$patient_email,$subject,$body,null);

              $patient_mobile = $patient_mobile;
              $patient_massage = "Dear ".$patientname.", Your appointment is booked with Dr. ".$doctorname." on ".$appointdate." at ".$appointtime.". Once Confirmed will notify you.";
              sendSMS($patient_mobile, $patient_massage);



              $body1=Customdata_model::where('content_type','=','DoctorAppointmentBooking')->first()->content;
              $body1=str_replace("{Name}",$doctorname,$body1);
              $body1=str_replace("{Patient_name}",$patientname,$body1);
              $body1=str_replace("{Date}",$appointdate,$body1);
              $body1=str_replace("{Time}",$appointtime,$body1);
              sendEmail("bizbrainz2020@gmail.com","Administrator",$doctor_email,$subject,$body1,null); 


              
              $doctor_mobile = $doctor_mobile;
              $doctor_massage = "Dear ".$doctorname.", We had scheduled an appointment with  ".$patientname."  on ".$appointdate." at ".$appointtime.". ";
              sendSMS($doctor_mobile, $doctor_massage);




               	echo json_encode(array('success'=>true,'message'=>SAVE_MSG));
				        return;
			}else{
      				echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
      				return;
			}	




            }


public function editAppointmentbookingByid($id)
    {
      $masterdb = $this->db->database;
	    $editappointmentbooking=$this->Appointmentbooking_model->EditAppointmentbooking($id,$masterdb);
	    echo json_encode(array('success'=>true,'data'=>$editappointmentbooking));
    }

public function updateAppointmentbookingData(){
            
        $id 					                   = $this->input->post("edit_appointmentbooking_id");
        $patient_id				               = $this->input->post("edit_appointmentbooking_patient_id");
        $doctor_id 					             = $this->input->post("edit_appointmentbooking_doctor_id");
        $schedule_id 					           = $this->input->post("edit_appointmentbooking_schedule_id");

        $appointmentbooking_department   = $this->input->post("edit_appointmentbooking_department");
        $appointmentbooking_doctor       = $this->input->post("edit_appointmentbooking_doctor");
        $appointmentbooking_schedule     = $this->input->post("edit_appointmentbooking_appointmentschedule");
        $appointmentbooking_description  = $this->input->post("edit_appointmentbooking_description");
        
        if ($this->session->userdata('user_roles')=='Patient') {
        	$appointmentbooking_patient  =  $this->ion_auth->get_user_id();
        } else {
        	 $appointmentbooking_patient = $this->input->post("edit_appointmentbooking_patient");
        }
            
       		
         $postData=array();

         $appointmentdetails=[];
          
         $postData = dataFieldValidation($appointmentbooking_patient, "Appointment Patient",$appointmentdetails,"patients_id","",$postData,"appointmentdetailsarray");
         $postData = dataFieldValidation($appointmentbooking_doctor, "Appointment Doctor",$appointmentdetails,"doctors_id","",$postData,"appointmentdetailsarray");
         $postData = dataFieldValidation($appointmentbooking_department, "Department",$appointmentdetails,"specialization_id","",$postData,"appointmentdetailsarray");
         $postData = dataFieldValidation($appointmentbooking_schedule, "Appointment Schedule",$appointmentdetails,"appointment_schedule_id","",$postData,"appointmentdetailsarray");
         $postData = dataFieldValidation($appointmentbooking_description, "Description",$appointmentdetails,"diseases_description","",$postData,"appointmentdetailsarray");
         
         
         
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
        
		 $userId = $this->ion_auth->get_user_id();
         $updatedlog=isUpdateLog($userId);
		

	    $appointmentbookingarray = array_merge($postData['dbinput']['appointmentdetailsarray'],$updatedlog);
	   
	    $appointmentbooking_update= $this->Appointmentbooking_model->updateAppointmentbooking($appointmentbookingarray,$id);
		
          
            if($appointmentbooking_update){
               	echo json_encode(array('success'=>true,'message'=>UPDATE_MSG));
				return;
			}
			else
			{
				echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				return;
			}	




            }
public function deleteAppointmentbookingById($id)
		{
	
	   if(isset($id)&&$id>0){
           
          
             $deletedata=$this->Appointmentbooking_model->DeleteAppointmentbooking($id);
	         
                if($deletedata) {
			                
	                 echo json_encode(array('success'=>true,'message'=>DELTE_MSG));
	                 return;

                 }else{
                     echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
		              return;
                      }   
     	    }else{

                  echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				              return;
     	    }
      
	  
     
       }

// Patient history by appointment id  Start //


  public function ShowPatienthistoryAppointmentById($id)
    {
      $masterdb = $this->db->database;
      $Appointmentbookingpatientid=Appointmentbooking_model::where('appointment_details.id','=',$id)->get(['patients_id']);
      $patientid=$Appointmentbookingpatientid[0]['patients_id'];
      
        die();
      echo json_encode(array('success'=>true,'patientdata'=>$patientdata,'patientdocument'=>$patientdocument));
    }

// Patient history by appointment id  End   //


public function SearchPendingForApprovalAppointmentsList()
    {
            
            $masterdb = $this->db->database;
            $userrole=$this->session->userdata('user_roles');

            if($userrole=="Doctor"){
              $doctors_id=$this->ion_auth->get_user_id();
              }
              if($userrole=="Patient"){
               $patients_id=$this->ion_auth->get_user_id();
              }
             $searchdata=$this->Appointmentbooking_model->SearchPendingForApprovalAppointments($doctors_id,$patients_id,$masterdb);
             echo json_encode(array('success'=>true,'data'=>$searchdata,'role'=>$userrole));
        return;
     
    }


}
?>