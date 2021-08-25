<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/CommonBaseController.php');
ob_start();
use Illuminate\Database\Query\Expression as raw;
use \Illuminate\Database\Capsule\Manager as Capsule;
class DashboardController extends CommonBaseController {
	
	public function __construct()
	{
		parent::__construct();
		 $this->load->library(array('form_validation','ValidationTypes','excel','session','ion_auth'));
		 $this->load->helper(array('url','html','form','util_helper','language'));
		 $this->load->database();
		 $this->load->model('customerdb/Appointmentbooking_model');
     $this->load->model('customerdb/Prescription_model');
     $this->load->model('customerdb/PrescriptionTests_model');
     $this->load->model('customerdb/PatientMedicalTestReports_model');
     $this->load->model('PatientDetails_model');
    }
	

 public function AllAppointmentForDashboardData()
		{
            $userrole=$this->session->userdata('user_roles');
            if($userrole=="Doctor"){
               $doctors_id=$this->ion_auth->get_user_id();
               $patients_id="";
              }else if($userrole=="Patient"){
               $patients_id=$this->ion_auth->get_user_id();
                $doctors_id="";
              }else{
                  $patients_id="";
                  $doctors_id="";
              }

             $searchdata=$this->Appointmentbooking_model->AllAppointmentForDashboard($doctors_id,$patients_id);
           	 echo json_encode(array('success'=>true,'data'=>$searchdata,'role'=>$userrole));
			    	return;
	   
		}

 public function AllPrescriptionForDashboardData()
    {
            $userrole=$this->session->userdata('user_roles');
            if($userrole=="Doctor"){
               $doctors_id=$this->ion_auth->get_user_id();
               $patients_id="";
              }else if($userrole=="Patient"){
               $patients_id=$this->ion_auth->get_user_id();
                $doctors_id="";
              }else{
                  $patients_id="";
                  $doctors_id="";
              }

             $searchdata=$this->Prescription_model->AllPrescriptionForDashboard($doctors_id,$patients_id);
             echo json_encode(array('success'=>true,'data'=>$searchdata,'role'=>$userrole));
            return;
     
    } 
    

    public function AllMedicaltestreportForDashboardData()
    {
            $userrole=$this->session->userdata('user_roles');
            if($userrole=="Doctor"){
               $doctors_id=$this->ion_auth->get_user_id();
               $patients_id="";
              }else if($userrole=="Patient"){
               $patients_id=$this->ion_auth->get_user_id();
                $doctors_id="";
              }else{
                  $patients_id="";
                  $doctors_id="";
              }

             $searchdata=$this->PatientMedicalTestReports_model->AllMedicaltestreportForDashboard($doctors_id,$patients_id);
             echo json_encode(array('success'=>true,'data'=>$searchdata,'role'=>$userrole));
            return;
     
    }  


    public function AllPatientForDashboardData()
    {
            // $userrole=$this->session->userdata('user_roles');
            // if($userrole=="Doctor"){
            //    $doctors_id=$this->ion_auth->get_user_id();
            //    $patients_id="";
            //   }else if($userrole=="Patient"){
            //    $patients_id=$this->ion_auth->get_user_id();
            //     $doctors_id="";
            //   }else{
            //       $patients_id="";
            //       $doctors_id="";
            //   }
            $account_id=$this->account_id;
             $searchdata=$this->PatientDetails_model->AllPatientForDashboard($account_id);
             echo json_encode(array('success'=>true,'data'=>$searchdata));
            return;
     
    }   




 public function AllTodayAppointmentForDashboardData()
    {
            $userrole=$this->session->userdata('user_roles');
            if($userrole=="Doctor"){
               $doctors_id=$this->ion_auth->get_user_id();
               $patients_id="";
              }else if($userrole=="Patient"){
               $patients_id=$this->ion_auth->get_user_id();
                $doctors_id="";
              }else{
                  $patients_id="";
                  $doctors_id="";
              }

             $searchdata=$this->Appointmentbooking_model->AllAllTodayAppointmentForDashboard($doctors_id,$patients_id);
             echo json_encode(array('success'=>true,'data'=>$searchdata,'role'=>$userrole));
            return;
     
    }

}
?>