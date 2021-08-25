<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH.'controllers/CommonBaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;

class DoctorTimeScheduleController extends CommonBaseController {

		public function __construct(){
			parent::__construct();
			$this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
			$this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
			$this->load->database();
			$this->load->model('customerdb/DoctorTimeSchedule_model');
			
		}	

public function AdmindoctortimescheduleView()
		{
            $this->load->view('admin/doctortimescheduleview');
        }

public function SearchDoctorTimescheduleList()
		{
	      $masterdb = $this->db->database;
	      $DoctorTimeScheduleList=$this->DoctorTimeSchedule_model->DoctorTimeScheduleList($masterdb);
		   echo json_encode(array('success'=>true,'data'=>$DoctorTimeScheduleList));
        }

public function editDoctorTimescheduleByid($id)
		{
		   $editresult=$this->DoctorTimeSchedule_model->EditDoctorTimeSchedule($id);
		   echo json_encode(array('success'=>true,'data'=>$editresult));
        }



public function updateDoctorTimeSchedule(){

        $id                                 = $this->input->post("edit_doctortimeschedule_id");
        $doctortimeschedule_doctorid        = $this->input->post("edit_doctortimeschedule_doctorid");
        $doctortimeschedule_date            = $this->input->post("edit_doctortimeschedule_date"); 
        $doctortimeschedule_appointmenttype = $this->input->post("edit_doctortimeschedule_appointmenttype");
		$doctortimeschedule_patient_time    = $this->input->post("edit_doctortimeschedule_patient_time"); 
		$doctortimeschedule_timestart       = $this->input->post("edit_doctortimeschedule_timestart");
		$doctortimeschedule_timeend         = $this->input->post("edit_doctortimeschedule_timeend");  
				
          $postData=array();

		  $doctortimescheduledata = [];
          $postData = dataFieldValidation($doctortimeschedule_doctorid, "Doctor Name",$doctortimescheduledata,"doctors_id","",$postData,"doctortimeschedulearray");
          $postData = dataFieldValidation($doctortimeschedule_date, "Week Days",$doctortimescheduledata,"weekday","",$postData,"doctortimeschedulearray");
          $postData = dataFieldValidation($doctortimeschedule_appointmenttype, "Appointment Type",$doctortimescheduledata,"appointment_type","",$postData,"doctortimeschedulearray");
          $postData = dataFieldValidation($doctortimeschedule_patient_time, "Patinet Time",$doctortimescheduledata,"patient_time","",$postData,"doctortimeschedulearray");
          $postData = dataFieldValidation($doctortimeschedule_timestart, "Start Time",$doctortimescheduledata,"shift_start_time","",$postData,"doctortimeschedulearray");
          $postData = dataFieldValidation($doctortimeschedule_timeend, "End Time",$doctortimescheduledata,"shift_end_time","",$postData,"doctortimeschedulearray");
          

	
			if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
				echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
				return;
			}


           $userId = $this->ion_auth->get_user_id();
           $updatedlog=isUpdateLog($userId);	 
		   $doctortimeschedulearray = array_merge($postData['dbinput']['doctortimeschedulearray'],$updatedlog);
		   $updateDoctorTimeschedule= $this->DoctorTimeSchedule_model->UpdateDoctorTimeSchedule($doctortimeschedulearray,$id);
				 

	               if($updateDoctorTimeschedule){
			               	echo json_encode(array('success'=>true,'message'=>UPDATE_MSG));
							return;
				     }else{
							echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
							return;
				    }

			

        }


public function saveDoctorTimeSchedule(){

        $doctortimeschedule_doctorid        = $this->input->post("add_doctortimeschedule_doctorid");
        $doctortimeschedule_date            = $this->input->post("add_doctortimeschedule_date"); 
        $doctortimeschedule_appointmenttype = $this->input->post("add_doctortimeschedule_appointmenttype");
		$doctortimeschedule_patient_time    = $this->input->post("add_doctortimeschedule_patient_time"); 
		$doctortimeschedule_timestart       = $this->input->post("add_doctortimeschedule_timestart");
		$doctortimeschedule_timeend         = $this->input->post("add_doctortimeschedule_timeend"); 
			

		$result=$this->DoctorTimeSchedule_model->CheckDoctorTimeSchedule($doctortimeschedule_doctorid,$doctortimeschedule_date,$doctortimeschedule_appointmenttype,$doctortimeschedule_timestart,$doctortimeschedule_timeend);
			if($result>0)
			{
				echo json_encode(array('success'=>false,'message'=>"Doctor Have Already Scheduled..."));
				return; 
			}
         
          $postData=array();
		  $doctortimescheduledata = [];
          $postData = dataFieldValidation($doctortimeschedule_doctorid, "Doctor Name",$doctortimescheduledata,"doctors_id","",$postData,"doctortimeschedulearray");

          $postData = dataFieldValidation($doctortimeschedule_date, "Week Days",$doctortimescheduledata,"weekday","",$postData,"doctortimeschedulearray");

          $postData = dataFieldValidation($doctortimeschedule_appointmenttype, "Appointment Type",$doctortimescheduledata,"appointment_type","",$postData,"doctortimeschedulearray");

          $postData = dataFieldValidation($doctortimeschedule_patient_time, "Patient Time",$doctortimescheduledata,"patient_time","",$postData,"doctortimeschedulearray");

          $postData = dataFieldValidation($doctortimeschedule_timestart, "Start Time",$doctortimescheduledata,"shift_start_time","",$postData,"doctortimeschedulearray");

          $postData = dataFieldValidation($doctortimeschedule_timeend, "End Time",$doctortimescheduledata,"shift_end_time","",$postData,"doctortimeschedulearray");
          
	
			if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
				echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
				return;
			}


           $userId = $this->ion_auth->get_user_id();
           $createdlog=isCreatedLog($userId);	 
		   $doctortimeschedulearray = array_merge($postData['dbinput']['doctortimeschedulearray'],$createdlog);
		   $addDoctorTimeschedule= $this->DoctorTimeSchedule_model->AddDoctorTimeSchedule($doctortimeschedulearray);
				 

           if($addDoctorTimeschedule){
	               	echo json_encode(array('success'=>true,'message'=>SAVE_MSG));
					return;
		     }else{
					echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
					return;
		    }

			

        }

public function deleteDoctorTimeScheduleById($id){ 

               if(isset($id)&&$id>0){

				       	$deleteresult = $this->DoctorTimeSchedule_model->DeleteDoctorTimeSchedule($id);
					      if($deleteresult){
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





}
?>