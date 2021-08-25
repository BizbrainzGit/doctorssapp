<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/doctor/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;

class ReferADoctorController extends BaseController {

		public function __construct(){
		
		 parent::__construct();
		 $this->load->library(array('form_validation','ValidationTypes','session','ion_auth'));
		 $this->load->helper(array('url','html','form','util_helper','language'));
		 $this->load->database();
		 $this->load->model('User');
		 $this->load->model('Userdetails_model');
		 $this->load->model('ReferADoctor_model');
		}	
 

  public function ReferADoctorView()
		{
          $this->load->view('doctor/referadoctorview');
      }

  public function ReferByADoctorView()
		{
          $this->load->view('doctor/referbyadoctorview');
      }    

 public function SearchReferADoctorList()
		{
         $user_id=$this->ion_auth->get_user_id();
         $searchdata=$this->ReferADoctor_model->SearchReferADoctor($user_id);

        	echo json_encode(array('success'=>true,'data'=>$searchdata));
			return;
	  	}

public function SearchReferByADoctorList()
		{
         
         $id=$this->ion_auth->get_user_id();
         $searchdata=$this->ReferADoctor_model->SearchReferByADoctor($id);

        	echo json_encode(array('success'=>true,'data'=>$searchdata));
			return;
	  	}

      


public function saveReferADoctorData(){
            
            $referadoctor_patient                   = $this->input->post("add_referadoctor_patientname");
            $referadoctor_doctor_to     			= $this->input->post("add_referadoctor_doctorid");
            $referadoctor_doctor_by                 =  $this->ion_auth->get_user_id();
            $userid=User::where('users.username','=',$referadoctor_doctor_to)->get(['id']); 
            $referadoctorto=$userid[0]['id'];
		  
		    if($referadoctorto<=0)
			{
			    echo json_encode(array('success'=>false,'message'=>"User ID Dose Not Exist"));
			    return;
			}
           $postData=array();

          $referadoctordetails=[];
          
          $postData = dataFieldValidation($referadoctor_patient, "Patient Name",$referadoctordetails,"refered_patient_id","",$postData,"referadoctordetailsarray");

          $postData = dataFieldValidation($referadoctorto, "Doctor Id",$referadoctordetails,"refered_to_doctor_id","",$postData,"referadoctordetailsarray");

          $postData = dataFieldValidation($referadoctor_doctor_by, "Doctor Id",$referadoctordetails,"refered_by_doctor_id","",$postData,"referadoctordetailsarray");
         

		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
        
		 $userId = $this->ion_auth->get_user_id();
        $createdlog=isCreatedLog($userId);

	    $referadoctorarray = array_merge($postData['dbinput']['referadoctordetailsarray'],$createdlog);
	   
	    $referadoctor_save = $this->ReferADoctor_model->addReferADoctorData($referadoctorarray);
		
          
            if($referadoctor_save){
               	echo json_encode(array('success'=>true,'message'=>SAVE_MSG));
				return;
			}
			else
			{
				echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				return;
			}	




            }




}
?>