<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/CommonBaseController.php');
error_reporting(0);
ob_start();
use Illuminate\Database\Query\Expression as raw;
use \Illuminate\Database\Capsule\Manager as Capsule;

class TodayAppointmentsController extends CommonBaseController {
	
	public function __construct()
	{
		parent::__construct();
		 $this->load->library(array('form_validation','ValidationTypes','excel','session','ion_auth'));
		 $this->load->helper(array('url','html','form','util_helper','language'));
		 $this->load->database();
		 $this->load->model('User');
		 $this->load->model('Userdetails_model'); 
     $this->load->model('Customdata_model');
     $this->load->model('PatientDetails_model');
     $this->load->model('PatientDocuments_model');
		 $this->load->model('customerdb/Appointmentbooking_model');
     $this->load->model('customerdb/Prescription_model');
     $this->load->model('customerdb/PrescriptionTests_model');
     $this->load->model('customerdb/PrescriptionMedicine_model');
     $this->load->model('customerdb/PrescriptionTests_model');
    }
	

public function DoctorTodayAppointmentsView()
      {
          $this->load->view('doctor/todayappointmentsview');
      }           


 public function SearchTodayAppointmentsList()
		{
            
            $masterdb = $this->db->database;
            $userrole=$this->session->userdata('user_roles');

            if($userrole=="Doctor"){
              $doctors_id=$this->ion_auth->get_user_id();

              }
              if($userrole=="Patient"){
               $patients_id=$this->ion_auth->get_user_id();
              }
             $searchdata=$this->Appointmentbooking_model->SearchTodayAppointments($doctors_id,$patients_id,$masterdb);
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
		    $postData = dataFieldValidation($appointmentbooking_change_status, "Status",$changestatus,"status_id",[ValidationTypes::REQUIRED],$postData,"statusarray");
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
      
// View Patient Details // 

   public function ViewPatientByidInDoctors($id)
    {    
          $masterdb = $this->db->database;
          $patintdata=Appointmentbooking_model::where('id','=',$id)->get(['id','patients_id']);
          $patintid= $patintdata[0]['patients_id'];
          $patientdata=$this->PatientDetails_model->ViewPatientdata($patintid);
          $patientdocuments=$this->PatientDocuments_model->ViewPatientDocumentsByPateintId($patintid);
          $patientappointments=$this->Prescription_model->ViewPrescriptionByPateintId($patintid,$masterdb);
          echo json_encode(array('success'=>true,'data'=>$patientdata,'patientdocuments'=>$patientdocuments,'patientappointments'=>$patientappointments));
        }

 // View Patient Details //      
public function viewPrescriptionByIdInDoctors($id)
    {
             $masterdb = $this->db->database;
             $Prescriptionbyid=$this->Prescription_model->ViewPrescriptionById($id,$masterdb);
             $MedicineList=$this->PrescriptionMedicine_model->ViewMedicinesByPrescriptionId($id);
             $MedicalTest=$this->PrescriptionTests_model->MedicalTestName($id);

               if($Prescriptionbyid){
                       echo json_encode(array('success'=>true,'data'=>$Prescriptionbyid,'medicaltest'=>$MedicalTest,'medicines'=>$MedicineList));
                       return;
                       }else{
                             echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
                      return;
                      } 
        }


}
?>