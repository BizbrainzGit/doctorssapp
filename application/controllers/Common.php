<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/CommonBaseController.php');
ob_start();
use Illuminate\Database\Query\Expression as raw;
use \Illuminate\Database\Capsule\Manager as Capsule;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
class Common extends CommonBaseController {
	
	public function __construct()
	{
		parent::__construct();
		 $this->load->library(array('form_validation','ValidationTypes','session','ion_auth'));
		 $this->load->helper(array('url','html','form','util_helper','language'));
		 $this->load->database();
		 $this->load->model('Userdetails_model');
		 $this->load->model('UserGroups_model');
		 $this->load->model('Specialization_model');
		 $this->load->model('customerdb/DoctorTimeSchedule_model');
		 $this->load->model('customerdb/DoctorDetails_model');
		 $this->load->model('customerdb/BookingStatus_model');
		 $this->load->model('customerdb/Appointmentbooking_model');
		 $this->load->model('customerdb/MedicalTestCategory_model');
		 $this->load->model('customerdb/MedicalTest_model');
		 $this->load->model('Cities_model');
		 $this->load->model('States_model'); 
		 $this->load->model('Accounts_model');
		 $this->load->model('Packages_model');
		 $this->load->model('Paymentmode_model');

    }


	public function logout() {
		session_start();
		$this->ion_auth->logout();
		session_write_close();
		if ($this->redirectType == "Normal"){
			echo json_encode(array('success'=>true));
			header('Location:'."/".base_url(),null,302);
			return;
		} else {
			header($this->cprotocol . ' 350 ' . ' /');
			return;
		}
		
	}

	public function Superadminlogin() {
		
		$user_id= "1";
	    $encrypt_id= null;
		$issuperadmin= true;	
        $user_account_roles= null;

        $data=$this->Userdetails_model->GetDataForSuperAdminLogin($user_id);

		$email=$data[0]['email'];
		$name= $data[0]['user_name'];
		if($data[0]['profile_pic_path']==null || strlen($data[0]['profile_pic_path']) === 0){
            $profile_pic_path= "assets/images/profile-img.jpg";
		}else{
              $profile_pic_path= $data[0]['profile_pic_path'];
		}
		$user_roles=  $data[0]['name'];
		$username=  $data[0]['username'];

		 session_start();
	      $sessiondata = [
					'user_id'  => $user_id,
					'username' => $username,
					'issuperadmin' => $issuperadmin,
					'user_roles' => $user_roles,
					'user_account_roles' => $useracc_roles,
					'encrypt_id' => $encryptid,
					'email'    => $email,
					'profile_pic_path'=> $profile_pic_path,
					'name'=>$name,
				  ];
          $this->session->set_userdata($sessiondata);
		if ($this->redirectType == "Normal"){
			echo json_encode(array('success'=>true));
			header('Location:'."/".base_url()."SuperAdmin-Manage-Accounts");
			return;
		  } else {
			header($this->cprotocol . ' 350 ' . ' /');
			return;
		  }
		
	}

	
	
	public function getPaymentmode()
		{ 
		
		 $Paymentmode =$this->Paymentmode_model->PaymentmodeList();//fetching from database table 
		 echo json_encode(array('data'=>$Paymentmode));
		 return;
		} 

	public function getPaymentstatus()
		{ 

		 $Paymentstatus =$this->Paymentstatus_model->PaymentstatusList();//fetching from database table 
		 
		 echo json_encode(array('data'=>$Paymentstatus));

		 return;
		} 


	public function getMedicalTestCategory()
		{ 
		 $MedicalTestCategory = $this->MedicalTestCategory_model->MedicalTestCategoryList();//fetching from database table 
		 echo json_encode(array('success'=>true,'data'=>$MedicalTestCategory));

		 return;
		} 	

	public function getMedicalTest($id)
		{  

			 if($id==0){
			   $MedicalTest = $this->MedicalTest_model->MedicalTestList();
		        }else{
			   $MedicalTest = $this->MedicalTest_model->MedicalTestListByCatagoryId($id);//fetching from database table
		    }

			//fetching from database table 
			 echo json_encode(array('success'=>true,'data'=>$MedicalTest));
			 return;
		} 			
    public function getPrice()
		{ 
		
         $testid       =$this->input->post('testid');
		 
		 $testprice =$this->MedicalTest_model->TestPrice($testid);//fetching from database table 
		 
		 echo json_encode(array('success'=>true,'data'=>$testprice));
		 return;
		} 
	public function getPatient()
		{ 
		
         $account_id                    = $this->account_id;
		 $Patientname =$this->Userdetails_model->PatientList($account_id);//fetching from database table 
		 echo json_encode(array('success'=>true,'data'=>$Patientname));
		 return;
		} 



	public function getDoctor()
		{ 
		 $account_id    = $this->account_id;	
		 $Doctorname =$this->Userdetails_model->DoctorList($account_id);//fetching from database table 
		 echo json_encode(array('success'=>true,'data'=>$Doctorname));
		 return;
		} 	

// public function getMedicaltest()
// 		{ 
		

// 		 $Medicaltest =$this->Medicaltest_model->MedicaltestList();//fetching from database table 
// 		 echo json_encode(array('data'=>$Medicaltest));
// 		 return;
// 		} 
		
public function getSpecialization()
		{ 
         // $account_id    = $this->account_id;
		 $Specialization =$this->Specialization_model->SpecializationList();//fetching from database table 
		 echo json_encode(array('success'=>true,'data'=>$Specialization));
		 return;
		} 

	public function getDesignation()
		{
		 $designation =$this->UserGroups_model->DesignationListForUser();//fetching from database table
		 echo json_encode(array('data'=>$designation));
		 return;
		}

	// public function getCity()
	// 	{
	// 	 $cityname =$this->Cities_model->CityList();//fetching from database table
	// 	 echo json_encode(array('data'=>$cityname));
	// 	 return;
	// 	}
	
	public function getState()
		{
			$statename = $this->States_model->StateList();
		    echo json_encode(array('data'=>$statename));
		    return;
		}


public function getCity($stateId)
		{
		 if($stateId==0){
			$cityname =$this->Cities_model->CityList();
		 }else{
			$cityname = $this->Cities_model->getCityByStateId($stateId);//fetching from database table
		 }
		 echo json_encode(array('data'=>$cityname));
		 return;
		}

	
	
	public function getAppointmentTime($doctorId=null)
		{
		
		$masterdb = $this->db->database;
		$time = date("H:i:s");
  		$DoctorTime = $this->DoctorTimeSchedule_model->getAppointmentTimeByDoctorId($doctorId,$time,$masterdb);//fetching from database table
		 // }
		 
		 echo json_encode(array('success'=>true,'data'=>$DoctorTime));
		 return;
		}


	
			
    public function getDoctorDepartment($doctorspecializationId=null)
		{ 

			$masterdb = $this->db->database;
        // echo $doctorspecializationId ;

		if($doctorspecializationId==null){
		   $doctordepartmentId = $this->Userdetails_model->DoctorList($masterdb);
		 }else{
			$doctordepartmentId = $this->DoctorDetails_model->getDoctorSpecializationId($doctorspecializationId,$masterdb);//fetching from database table
		 }
		 
		 echo json_encode(array('success'=>true,'data'=>$doctordepartmentId));
		 return;
		} 



		public function getAppointmentTimingsWithDate()
		{
           
                   $appointment_doctorid   = $this->input->post("appointment_doctorid");
                   $appointment_date        = $this->input->post("appointment_date");
                   $appointment_date1 = date('Y-m-d', strtotime($appointment_date));
                   $dayofweek = date('l', strtotime($appointment_date));
                   $AppointmentTime = $this->DoctorTimeSchedule_model->getAppointmentScheduleTimeByDoctorId($appointment_doctorid,$dayofweek);
            if(count($AppointmentTime)>0){
                //echo count($AppointmentTime) ;
                for($i=0;$i<count($AppointmentTime);$i++)
                {
                $start =$AppointmentTime[$i]["shift_start_time"];
			    $end   =$AppointmentTime[$i]["shift_end_time"];
			    $duration = $AppointmentTime[$i]["patient_time"]; // how much the is the duration of a time slot
			    $cleanup  = 0; // don't mind this
				// $break_start = '11:10'; // break start
				// $break_end   = '11:25'; // break end
				$times[]=availableSlots($duration, $cleanup, $start, $end);
				
                }
                $timesarraySingle = call_user_func_array('array_merge', $times);
             
			   $AppointmentTimeSlotBooked = $this->Appointmentbooking_model->getAppointmentTimeSlotByScheduleId($appointment_doctorid, $appointment_date1);
                 $a=$AppointmentTimeSlotBooked[0]["time_slot"];
                 $b=explode(',',$a);
                 $newtimes= array_diff($timesarraySingle,$b);
                 $newtimesarray=(array_values($newtimes));
			     echo json_encode(array('success'=>true,'data'=>$newtimesarray));
			     return;

               }else{
                       echo json_encode(array('success'=>false,'message'=>"No Scheldule Available"));
					   return;
               }
			  
		}	

		public function getHospitalAccount()
		{
			 $result =$this->Accounts_model->GetAccountList();//fetching from database table
			 echo json_encode(array('data'=>$result));
			 return;
		}


		 public function getPackagelist()
		{
		  $packageslist = $this->Packages_model->GetPackageForAccountSubscription();//fetching from database table
		  echo json_encode(array('data'=>$packageslist));
		  return;
		}


		public function getBookingStatus()
		{
			
			 $status =$this->BookingStatus_model->BookingStatusList();//fetching from database table
			 echo json_encode(array('success'=>true,'data'=>$status));
			 return;
		}

		public function getBookingStatusForPatient()
		{
			 	
			 $status =$this->BookingStatus_model->BookingStatusListForPatient();//fetching from database table
			 echo json_encode(array('success'=>true,'data'=>$status));
			 return;
		}

		public function getBookingStatusForReceptionist()
		{
			 $status =$this->BookingStatus_model->BookingStatusListForReceptionist();//fetching from database table
			 echo json_encode(array('success'=>true,'data'=>$status));
			 return;
		}

		public function getBookingStatusForDoctor()
		{
			 $status =$this->BookingStatus_model->BookingStatusListForDoctor();//fetching from database table
			 echo json_encode(array('success'=>true,'data'=>$status));
			 return;
		}

   
} 
?>
