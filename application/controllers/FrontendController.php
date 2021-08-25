<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Query\Expression as raw;
use \Illuminate\Database\Capsule\Manager as Capsule;
error_reporting(0);
class FrontendController extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation','ValidationTypes','session','ion_auth'));
		$this->load->helper(array('form','html','Util'));
		$this->load->database();
		$this->load->model('User');
		$this->load->model('Userdetails_model');
		$this->load->model('Accounts_model');
		$this->load->model('Cities_model');
		$this->load->model('Specialization_model'); 
		$this->load->model('customerdb/DoctorTimeSchedule_model');
		$this->load->model('customerdb/Appointmentbooking_model');
	}

	// == front end pages  start===  //
    public function index() 
	{  

		    $data = array();
            $customerbddata = $this->Accounts_model->GetAccountList(); //get customer db 
             foreach ($customerbddata as $row) {
		      $customerdb=$row->dbname;
              $data['doctordata'][] = $this->Userdetails_model->DoctorListForFrontview($customerdb,$loctions1,$specialization1); //limit,start
               
             }
         $data['specializationdata']= $this->Specialization_model->GetSpecializationForHomepage();     
		$this->load->view('frontend/homeview',$data);
	}

	public function ContactView() 
	{
		$this->load->view('frontend/contact');
	}
    

    public function ClinicView() 
	{               
              $data['clinicdata']= $this->Accounts_model->CliniclistForFrontView(); //limit,start
              //print_r($data['clinicdata']);
              $this->load->view('frontend/clinicview',$data);
		
	}


	  public function getCityForSearch()
		{
		 
			$cityname =$this->Cities_model->CityList();
		    echo json_encode(array('success'=>true,'data'=>$cityname));
		    return;
		}

		public function getSpecializationForSearch()
		{ 
       
		 $Specialization =$this->Specialization_model->SpecializationList();//fetching from database table 
		 echo json_encode(array('success'=>true,'data'=>$Specialization));
		 return;
		} 


	public function ListView() 
	{               
              // print_r($root_array);
             $this->load->view('frontend/listview');
	}


	public function DoctorsListView() 
	{               
		    

		     $loctions = $this->input->post('search_loctions');
		     $specialization = $this->input->post('search_specialization');
            //whereRaw('cityname like',"%$loctions%")->get(['id']);
		       $loctions12=$this->Cities_model->GetLoctionId($loctions);
		       $loctions1=$loctions12[0]['cityid'];
		       $specialization12=$this->Specialization_model->GetSpecializationId($specialization);
		       $specialization1 = $specialization12[0]['id']; 
		    $data = array();
            $customerbddata = $this->Accounts_model->GetAccountList(); //get customer db 
             foreach ($customerbddata as $row) {
		      $customerdb=$row->dbname;
              $data[] = $this->Userdetails_model->DoctorListForFrontview($customerdb,$loctions1,$specialization1); //limit,start
               
             }

             echo json_encode(array('success'=>true,'data'=>$data));
		      return;

		
	}

	public function DoctordetailsView() 
	{   
	     $user_id    =  $this->uri->segment(3);  // doctor userid
         $account_id =  $this->uri->segment(4);  // account id 
         $customerbddata = $this->Accounts_model->GetAccountDatabaseById($account_id);
         $customerdb=$customerbddata[0]->dbname;
         $data['doctordetailsdata'] = $this->Userdetails_model->DoctorDetailsByUserId($user_id,$customerdb); //limit,start
      //  print_r($data);

                $acc = $this->Accounts_model->accountById($account_id);
				if ($acc){
					$dbname1=$acc->dbname;
					setCustomerDBNameIntoEloquent($acc->dbname);
					$accountName=$acc->account_name;
				} else {
					echo json_encode(array('success'=>false,'message'=>INVALID_ACCOUNT));
					writeLogsAndDie();
				} 

           $appointment_doctorid   = $user_id ;
           $appointment_date        = date("Y-m-d");
           $appointment_date1 = date('Y-m-d', strtotime($appointment_date));
           $dayofweek = date('l', strtotime($appointment_date));
           $AppointmentTime = $this->DoctorTimeSchedule_model->getAppointmentScheduleTimeByDoctorId($appointment_doctorid,$dayofweek);
       // print_r($AppointmentTime);
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
                 $data['timeslotsdata']=$newtimesarray;
			   //echo json_encode(array('success'=>true,'data'=>$newtimesarray));
                }
		        

		     $this->load->view('frontend/doctordetailsview',$data); 
	
 
	
        }

   public function AppointmentBookingView() 
	   {
        $this->load->view('frontend/appointmentbookingview');
      }

   public function ConfirmBookingView() 
	   {
        $this->load->view('frontend/confirmview');
      }





      public function GetTimeSlotsForAppointmentFrontView(){


      	 $doctorid           =  $this->input->post('doctors_id');  // doctor userid
         $appointment_date   =  $this->input->post('date');  // account id 
         $account_id         =  $this->input->post('account_id');  // account id 

         $appointment_date      = date('Y-m-d', strtotime($appointment_date));

         $customerbddata = $this->Accounts_model->GetAccountDatabaseById($account_id);
         $customerdb=$customerbddata[0]->dbname;
        // $data['doctordetailsdata'] = $this->Userdetails_model->DoctorDetailsByUserId($user_id,$customerdb); //limit,start
      //  print_r($data);

                $acc = $this->Accounts_model->accountById($account_id);
				if ($acc){
					$dbname1=$acc->dbname;
					setCustomerDBNameIntoEloquent($acc->dbname);
					$accountName=$acc->account_name;
				} else {
					echo json_encode(array('success'=>false,'message'=>INVALID_ACCOUNT));
					writeLogsAndDie();
				} 

          
           $dayofweek = date('l', strtotime($appointment_date));
           $AppointmentTime = $this->DoctorTimeSchedule_model->getAppointmentScheduleTimeByDoctorId($doctorid,$dayofweek);
       // print_r($AppointmentTime);
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
             
			   $AppointmentTimeSlotBooked = $this->Appointmentbooking_model->getAppointmentTimeSlotByScheduleId($doctorid, $appointment_date);
                 $a=$AppointmentTimeSlotBooked[0]["time_slot"];
                 $b=explode(',',$a);
                 $newtimes= array_diff($timesarraySingle,$b);
                 $newtimesarray=(array_values($newtimes));
                 $data['timeslotsdata']=$newtimesarray;
			     echo json_encode(array('success'=>true,'data'=>$newtimesarray));
                 return;

               }else{
                       echo json_encode(array('success'=>false,'message'=>"No Scheldule Available"));
					   return;
               }
      }


      public function GetDoctorsAppointmentFrontView(){

      	 $doctorid           =  $this->input->post('doctors_id');  // doctor userid
         $account_id         =  $this->input->post('account_id');  // account id 
         $customerbddata = $this->Accounts_model->GetAccountDatabaseById($account_id);
         $customerdb=$customerbddata[0]->dbname;
         $doctordetailsdata = $this->Userdetails_model->DoctorDetailsByUserId($doctorid,$customerdb); //limit,start
      
            if($doctordetailsdata>0){
			     echo json_encode(array('success'=>true,'data'=>$doctordetailsdata));
                 return;
               }else{
                       echo json_encode(array('success'=>false,'message'=>"No Doctors Available"));
					   return;
               }
      }

 }?>