<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH.'controllers/admin/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;
error_reporting(0);
class AdminDashboardController extends BaseController {
	
public function __construct()
	{
		parent::__construct();
		 $this->load->library(array('form_validation','ValidationTypes','excel','session','ion_auth'));
		 $this->load->helper(array('url','html','form','util_helper','language'));
		 $this->load->database();
		 $this->load->model('Useraccounts_model');
     $this->load->model('PaymentTransaction_model');
     $this->load->model('customerdb/Appointmentbooking_model');
  }

public function Dashboard()
    {         
            $this->load->view('admin/dashboard');
        }
        
    
public function DoctorsCountForAdmin()
       {   
             $monthview=date('M Y');
             $account_id=$this->account_id;
             $doctorscount=$this->Useraccounts_model->DoctorsCountForAdmin($account_id);
             echo json_encode(array('success'=>true, 'monthview'=>$monthview ,'doctorscount'=>$doctorscount));

       }

public function PatientsCountForAdmin()
       {   
             $monthview=date('M Y');
             $account_id=$this->account_id;
             $patientscount=$this->Useraccounts_model->PatientsCountForAdmin($account_id);
             echo json_encode(array('success'=>true, 'monthview'=>$monthview ,'patientscount'=>$patientscount));

       }


public function totalAppointmentsForAdmin()
       {  
          
            $month=date('Y-m');
            $monthview=date('M Y');
            $today=date("Y-m-d");
            $todayappts=$this->Appointmentbooking_model->TodayAppointmentsForAdmin($today);
            $totalappts=$this->Appointmentbooking_model->TotalAppointmentsForAdmin($month);
            echo json_encode(array('success'=>true,'monthview'=>$monthview, 'todayappts'=>$todayappts,'totalappts'=>$totalappts));

    }




public function totalAppointmentsForAdminByMonth($id)
    {  
               if($id==1){
                    $month= date('Y-m', strtotime('0 month'));
                    $monthview= date('M Y', strtotime('0 month'));
               }elseif($id==2){
                    $month= date('Y-m', strtotime('-1 month'));
                    $monthview= date('M Y', strtotime('-1 month'));
               }elseif($id==3){

                 $month= date('Y-m', strtotime('-2 month'));
                 $monthview= date('M Y', strtotime('-2 month'));
               }elseif($id==4){

                 $month= date('Y-m', strtotime('-3 month'));
                 $monthview= date('M Y', strtotime('-3 month'));
               }
         
              $totalappts=$this->Appointmentbooking_model->TotalAppointmentsForAdmin($month);
              echo json_encode(array('success'=>true,'monthview'=>$monthview,'totalappts'=>$totalappts));

    }




} ?>
