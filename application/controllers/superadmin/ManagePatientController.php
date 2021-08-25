<?php defined('BASEPATH') OR exit('No direct script access allowed');
 error_reporting(0);
include_once(APPPATH.'controllers/superadmin/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;

class ManagePatientController extends BaseController {

 public function __construct(){
		
			parent::__construct();
			$this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
			$this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
			$this->load->database();
			$this->load->model('Userdetails_model');
			
		}	
 

 public function managepatientsview(){
          $this->load->view('superadmin/managepatientsview');
      }


 public function SearchPatientListView()
		{
            
             $searchdata=$this->Userdetails_model->SearchPatientListForSuperAdmin($search_patient_name,$search_mobile_no);
            	echo json_encode(array('success'=>true,'data'=>$searchdata));
				return;
	   }
      
public function SearchPatientView()
		{
           
           $search_patient_name                 = $this->input->post("search_patient_name"); 
           $search_mobile_no                    = $this->input->post("search_mobile_no");
          $searchdata=$this->Userdetails_model->SearchPatientListForSuperAdmin($search_patient_name,$search_mobile_no);
           	echo json_encode(array('success'=>true,'data'=>$searchdata,'role'=>$userrole));
				return;
	   
		}

	}
?>