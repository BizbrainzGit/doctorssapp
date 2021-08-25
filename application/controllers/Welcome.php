<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Query\Expression as raw;
use \Illuminate\Database\Capsule\Manager as Capsule;

class Welcome extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation','ValidationTypes','session','ion_auth'));
		$this->load->helper(array('form','html','Util'));
		$this->load->database();
		$this->load->model('User');
		$this->load->model('Userdetails_model');
		$this->load->model('Userdetails_model');
		$this->load->model('Subscription_model');
		$this->load->model('Customdata_model');
		log_custom_message("Welcome Controller Constructor Called");
	}

	// == front end pages  start===  //
 //    public function LoginView() 
	// {
	// 	$this->load->view('loginview');
	// }
 
	 public function AccountSelectView() 
	{    
		$this->load->view('accountselecteview');
	}

	 public function GetAccountSelectList() 
	 {    
		   $id= $this->ion_auth->get_user_id();
		   $AccountSelectList=$this->User->userAccountsRole($id);
		   echo json_encode(array('data'=>$AccountSelectList));
		    return;
	  }

//         public function testEmail(){
        	 
//     //             $id                                  = $addSubscriptionid;
// 		  //       $subject='Feedback';
// 				//
// 				// $name=$business_cname;
// 		  //       $hiuser = ucfirst($name);
// 				// $body=Customdata_model::where('content_type','=','Feedback')->first()->$customer_email;
// 				// $body=str_replace("{CompanyName}",$hiuser,$body);
// 				// $body=str_replace("{URL}",$url,$body);
          

//               $email="bizbrainz2020@gmail.com";
//               $url = getHostURL(true).'Welcome/AccountSelectView';
//                $subject='Feedback';
              
//                $base_url='http://172.16.0.60/WebServices/';
//                $activation=md5($email.time());
//                $time = time();
              
//                $body="Dear Thank you for the subscription for the plan of next Here is the URL of doctorss app.% https://app.doctorss.in%. Our support team will help you further assistance. Thank you sir, BizBrainz Support Team. ".$url.'/'.$activation." "; 



// 		      echo $a= sendEmail("bizbrainz2020@gmail.com","Administrator",$email,$subject,$body,null);
//         }

// public function testSMS()
// {
//             $mobileno='9160687119';
            
//             $massage = "Dear Patient helo123";
//             sendSMS($mobileno, $massage);
//          }
	
}
?>