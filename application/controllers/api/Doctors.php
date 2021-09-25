<?php defined('BASEPATH') or die('Something went wrong');
include_once(APPPATH.'controllers/CommonBaseController.php');
class Doctors extends CI_Controller
{
	public $data;
	public function __construct()
	{
		parent::__construct();
$this->load->library(array('session','form_validation', 'email','ion_auth','ValidationTypes'));
		$this->load->helper(array('form', 'url','captcha','html','language','security','util_helper','db_helper'));
		
	//	$this->load->helper(array('url_helper'));
		$this->load->database();
		$this->load->model('User');
		$this->load->model('Userdetails_model');
		$this->load->model('PatientDetails_model');
        $this->load->model('PatientDocuments_model');
        $this->load->model('api/Common_model');	
        $this->load->model('api/Patient_model');		
	    $this->load->model('api/Appointments_model');
	}
	
	public function get_referedbyme_list()
	{
	
		$user_id=json_decode($_POST['user_id']);
		   $searchdata=$this->Doctor_model->ReferByADoctorList($user_id);	
		   echo json_encode(array('success'=>true,'data'=>$searchdata));
			return;
						
	}
	

/*public function get_doctor_profile()
	{
				
		
			
		echo json_encode($doctor_result);
	}*/
	

}
?>