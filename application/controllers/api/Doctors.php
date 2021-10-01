<?php defined('BASEPATH') or die('Something went wrong');
include_once(APPPATH.'controllers/CommonBaseController.php');
class Doctors extends CI_Controller
{
	public $data;
	public function __construct()
	{
		parent::__construct();
$this->load->library(array('session','form_validation', 'email','ion_auth','ValidationTypes'));
		$this->load->helper(array('form', 'url','captcha','html','language','security','util_helper'));
		
		$this->load->helper(array('url_helper'));

		$this->load->database();
		$this->load->model('User');
		$this->load->model('Userdetails_model');
		$this->load->model('PatientDetails_model');
        $this->load->model('PatientDocuments_model');
        $this->load->model('api/Common_model');	
        $this->load->model('api/Patient_model');		
	    $this->load->model('api/Appointments_model');
	    $this->load->model('api/Patient_model');
	    $this->load->model('ReferADoctor_model');

	}
	
	public function get_referedbyme_list()
	{
		$user_id=$this->input->post('user_id');

		   //$searchdata=$this->Doctor_model->ReferByADoctorList($user_id);	
		   $searchdata=$this->ReferADoctor_model->SearchReferADoctor($user_id);
		   echo json_encode(array('success'=>true,'data'=>$searchdata));
			return;
						
	}
	
	public function refereadoctor()
	{
		// $data['refered_by_doctor_id']=$this->input->post('refered_by_doctor_id');
		// $data['refered_to_doctor_id']=$this->input->post('refered_to_doctor_id');
		// $data['refered_to_specializations_id']=$this->input->post('refered_to_specializations_id');
		// $data['refered_patient_id']=$this->input->post('refered_patient_id');
		// $data['refered_to_doctor_name']=$this->input->post('refered_to_doctor_name');
		// $data['refered_to_clinic_name']=$this->input->post('refered_to_clinic_name');
		// $data['refered_to_phone_number']=$this->input->post('refered_to_phone_number');



		$data['refered_by_doctor_id']=16;
		$data['refered_to_doctor_id']=1;
		$data['refered_to_specializations_id']=1;
		$data['refered_patient_id']=14;
		$data['refered_to_doctor_name']="babu";
		$data['refered_to_clinic_name']="test";
		$data['refered_to_phone_number']="962587410";
		

		$createdlog=isCreatedLog($data['refered_by_doctor_id']);
		$referadoctorarray = array_merge($data,$createdlog);
      
  print_r($referadoctorarray);      
	// die();

		$referadoctor_save=$this->ReferADoctor_model->addReferADoctorData($referadoctorarray);
		if($referadoctor_save){
			
			$patientdetails=$this->Patient_model->patient_All_Details($data['refered_patient_id']);
			//$doctordetails =$this->Patient_model->doctor_All_Details($data['refered_to_doctor_id']);
			$searchdata['url'] = "https://api.whatsapp.com/send?phone=+91".$data['refered_to_phone_number']."&text=Hello, *".$data['refered_to_doctor_name']."* Appointment  with *patient Name : ".$patientdetails['result'][0]->first_name.", Mobile No : ".$patientdetails['result'][0]->mobileno.", Daigognosis* ";
			 echo json_encode(array('success'=>true,'data'=>$searchdata));
			return;
		}else{
			$searchdata['message'] = "issue on refer a doctor";
			echo json_encode(array('success'=>true,'data'=>$searchdata));
			return;
		}
		//https://api.whatsapp.com/send?phone=+919866895180&text=Hello, *prasanthi* Appointment  with *patient Name : Vijaya kumar, Mobile No : 9440221723, Daigognosis* 
		   //$searchdata=$this->Doctor_model->ReferByADoctorList($user_id);	
		//  $searchdata=$this->ReferADoctor_model->SearchReferByADoctor($id);

		  
						
	}
/*public function get_doctor_profile()
	{
				
		
			
		echo json_encode($doctor_result);
	}*/
	

}
?>
