<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Query\Expression as raw;
use \Illuminate\Database\Capsule\Manager as Capsule;
 error_reporting(0);
class LoginController extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('session','form_validation', 'email','ion_auth','ValidationTypes'));
		$this->load->helper(array('form', 'url','captcha','html','language','security','util_helper'));
		$this->load->database();
		$this->load->model('User');
		$this->load->model('Userdetails_model');
		$this->load->model('Address_model');
		$this->load->model('PatientDetails_model');
		log_custom_message("Welcome Controller Constructor Called");
	}
	public function loginView()
	{
		$this->load->view('loginview');

	}
	public function is_user_logged_in(){ 
		if($this->is_user_logged_in) {
			$data = [
					    'user_id'  => $this->ion_auth->get_user_id(),
						'username' => $username,
						'issuperadmin' => $issuperadmin,
						'user_roles' => $userroles,
						'user_account_roles' => $useracc_roles,
						'encrypt_id' => $encryptid,
						'email'    => $email,
						'profile_pic_path'=> $user->Userdetails->profile_pic_path,
						'name'=>$name,
				];
			
			echo json_encode(array("success"=> true, "data" => $data));
			return;
		} else {
			echo json_encode(array("success"=> false));
			return;
		}
	}


	public function login(){
		try{
			log_custom_message("Login Method Called");
			if($this->is_user_logged_in) {
				$data = [
					    'user_id'  => $this->ion_auth->get_user_id(),
						'username' => $username,
						'issuperadmin' => $issuperadmin,
						'user_roles' => $userroles,
						'user_account_roles' => $useracc_roles,
						'encrypt_id' => $encryptid,
						'email'    => $email,
						'profile_pic_path'=> $user->Userdetails->profile_pic_path,
						'name'=>$name,
					];
				echo json_encode(array("success"=> true, "data" => $data));
				return;
			}
			
			$postdata = file_get_contents("php://input");
			$data = json_decode($postdata);
			
			
			$dbData = [];
			$loginData=array();
			$loginData = dataFieldValidation($data->email, 'Email', $dbData, "email",[ValidationTypes::REQUIRED], $loginData, "loginArray");
			$loginData = dataFieldValidation($data->password, 'Password', $dbData, "password",[ValidationTypes::REQUIRED], $loginData, "loginArray");
			
			if(isset($postData['errorslist']) && is_array($errors['errorslist'])){
				if(count($errors['errorslist'])>0){
					echo json_encode(array('success'=>false,'message'=>$errors['errorslist']));
					return;
				}
			}
			
			$username = isset($data->email) ? $data->email : '';
			$password = isset($data->password) ? $data->password : '';
			
			
			$remember = false;
			if (isset($data->rememberme)){
				$remember = $data->rememberme;
			}
			
			if (empty($username) || empty($password))
			{   
				echo json_encode(array('success'=>false,'message'=>"Username or Password Empty"));
				return;
			}
		    			
			$usr_result=$this->ion_auth->login($username, $password, $remember);
			
			if ($usr_result === true) //active user record is present
			{
				$user = User::with('userdetails')->find($this->ion_auth->get_user_id());
				if($user->Userdetails->profile_pic_path === null || strlen($user->Userdetails->profile_pic_path) === 0){
					$user->Userdetails->profile_pic_path = 'assets/images/profile-img.jpg';
				}

				$user_id=$this->ion_auth->get_user_id();
				$username = $user->username;
				$email = $user->email;
				$name = trim($user->Userdetails->first_name . ' ' . $user->Userdetails->last_name);
				$issuperadmin =$this->ion_auth->in_group("Super Admin");

				if($issuperadmin){
					$userroles = 'Super Admin';
				  }else{
					$userroledata=User::userAccountsRole($this->ion_auth->get_user_id());
					foreach($userroledata as $value){
						// $account_id=$value->account_id;
						// $encryptid= $value->encrypted_id;
						$userroles[]=$value->name;
						if($value->name=='Super Admin'){
								$userroles[] = 'Admin';
						     }
						 $useraccroles[$value->encrypted_id] = $value->name;

					   }
					// $useraccroles =count($useraccroles);   
                     if(count($useraccroles)>1){
                     	   $userroles="";
                           $useracc_roles =$useraccroles;
                         }else{
                            $userroles=$userroles[0] ;
                            $encryptid= $value->encrypted_id;
                         }

					 
				 }
				
				//set the session variables

				$sessiondata = [
					'user_id'  => $this->ion_auth->get_user_id(),
					'username' => $username,
					'issuperadmin' => $issuperadmin,
					'user_roles' => $userroles,
					'user_account_roles' => $useracc_roles,
					'encrypt_id' => $encryptid,
					'email'    => $email,
					'profile_pic_path'=> $user->Userdetails->profile_pic_path,
					'name'=>$name,
				  ];
				
				$this->session->set_userdata($sessiondata);
				echo json_encode( array("success"=> true, 'data'=>$sessiondata));
				return;
			}
			else
			{
				if (strpos($this->ion_auth->errors(),"Account is inactive") > 0){
					echo json_encode(array("success"=> false, 'message'=> "Your account is inactive. Please contact administrator."));
					return;
				} else {
					echo json_encode(array("success"=> false, 'message'=> "Incorrect Username or Password"));
					return;
				}
			}		
		
		}catch(Exception $ex){
			 log_custom_message("Error:" . $ex. print_r($_REQUEST, TRUE)
							. "\nJSON Data:\n" . file_get_contents("php://input"));
		}
	}
	
public function SelectAccount(){
			 
			  $id            = $this->ion_auth->get_user_id();
			  $encryptid     = $this->input->post("account_selected_accountid");
		      $usr_result=$this->User->AccountsRoleData($id,$encryptid);
         
			if ($usr_result) //active user record is present
			  { 
				$user = User::with('userdetails')->find($this->ion_auth->get_user_id());
				if($user->Userdetails->profile_pic_path === null || strlen($user->Userdetails->profile_pic_path) === 0){
					$user->Userdetails->profile_pic_path = 'assets/images/profile-img.jpg';
				}

				$user_id=$this->ion_auth->get_user_id();
				$username = $user->username;
				$email = $user->email;
				$name = trim($user->Userdetails->first_name . ' ' . $user->Userdetails->last_name);
				$issuperadmin =$this->ion_auth->in_group("Super Admin");
				if($issuperadmin){
					$userroles = 'Super Admin';
				  }else{
					$userroledata=User::AccountsRoleData($id,$encryptid);
					foreach($userroledata as $value){
						$account_id=$value->account_id;
						$encryptid= $value->encrypted_id;
						$userroles[]=$value->name;
						if($value->name=='Super Admin'){
								$userroles[] = 'Admin';
						     }
						 $useraccroles[$value->encrypted_id] = $value->name;

					   }
					// $useraccroles =count($useraccroles);   
                     if(count($useraccroles)>1){
                     	   $userroles="";
                           $useracc_roles =$useraccroles;
                         }else{
                            $userroles=$userroles[0] ;
                            $encryptid= $value->encrypted_id;
                         }

					 
				 }
				
				//set the session variables

                 $sessiondata = [
					'user_id'  => $this->ion_auth->get_user_id(),
					'username' => $username,
					'issuperadmin' => $issuperadmin,
					'user_roles' => $userroles,
					'user_account_roles' => $useracc_roles,
					'encrypt_id' => $encryptid,
					'email'    => $email,
					'profile_pic_path'=> $user->Userdetails->profile_pic_path,
					'name'=>$name,
				  ];

					$this->session->set_userdata($sessiondata);
					echo json_encode( array("success"=> true, 'data'=>$sessiondata));
					return;
			   }
			else
			 { 
				echo json_encode(array("success"=> false, 'message'=> "Incorrect Username or Password"));
					return;
			 }		
		
		}
	

function CustomerChangePassword(){
		
		        $customer_old_password		       			= $this->input->post("customer_old_password");
				$customer_new_password 		    			= $this->input->post("customer_new_password");
				$customer_confirm_password		            = $this->input->post("customer_confirm_password");
                $customer_identity = $this->session->userdata('identity');
                 // $identitypass = $this->session->userdata('password');             
		/*if ( $identitypass == null || $identitypass!=$old_password){
			echo json_encode(array('success'=>false,'message'=>INVALID_PASSWORD_MSG));
			return;
		}*/
		
             $postData=array();
			 $changepassdata = [];
		  
		  $postData = dataFieldValidation($customer_new_password, "New Password", $changepassdata, "password",  [ValidationTypes::REQUIRED],$postData,"postDataArray");
		 
         if(isset($postData['errorslist']) && is_array($postData['errorslist'])){
			echo json_encode(array('success'=>false,'message'=>'Please Enter Correct Details...'));
			return;
		     }

			$change = $this->ion_auth->change_password($customer_identity,$customer_old_password,$customer_new_password);

			
			if ($change)
			{
				echo json_encode(array('success'=>true,'message'=>PASSWORD_CHANGED));
				return;
			}
			else
			{
				echo json_encode(array('success'=>false,'message'=>PASSWORD_NOTCHANGED));
			return;
			}

			}

	

			
	
	 public function CustomerRegistation()
	{
		
		$this->load->view('registation');
	}

	public function saveCustomerData(){
			
		$customer_password       			           = $this->input->post("customerregister_password");
		$customer_fname       			               = $this->input->post("customerregister_firstname");
		$customer_lname       				           = $this->input->post("customerregister_lastname");
		$customer_mobileno       			           = $this->input->post("customerregister_mobilenumber");
		$customer_email       				           = $this->input->post("customerregister_email");
		// $customer_dateofbirth       			       = $this->input->post("customerregister_dateofbirth");
		$customer_role       			               = 6;
	
		
		   $userId = null;	
	       $postData=array();
	       $customerUserdata = [];
	     
          $postData = dataFieldValidation($customer_password, "Password",$customerUserdata,"password",[ValidationTypes::REQUIRED], $postData,"customerUserdataarray");
          $postData = dataFieldValidation($customer_email, "Email",$customerUserdata,"email",[ValidationTypes::REQUIRED],$postData,"customerUserdataarray");
          $postData = dataFieldValidation($customer_email, "User ID",$customerUserdata,"username",[ValidationTypes::REQUIRED],$postData,"customerUserdataarray");
          $postData= dataFieldValidation($customer_role, "Role ID",$customerUserdata,"role_id",[ValidationTypes::REQUIRED],$postData,"customerUserdataarray");

         $customersdetails=[];

         $postData = dataFieldValidation($customer_fname, "First Name",$customersdetails,"first_name",[ValidationTypes::REQUIRED],$postData,"customersdetailsarray");
         $postData = dataFieldValidation($customer_lname, "Last Name",$customersdetails,"last_name",[ValidationTypes::REQUIRED], $postData,"customersdetailsarray");
         $postData = dataFieldValidation($customer_mobileno, "Mobile No",$customersdetails,"mobileno",[ValidationTypes::REQUIRED], $postData,"customersdetailsarray");
         // $postData = dataFieldValidation($customer_dateofbirth, "Date Of Birth",$customersdetails,"dob","", $postData,"customersdetailsarray");
 
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
        
 
        $createdlog=isCreatedLog($userId);

		$customerUserdata=$postData['dbinput']['customerUserdataarray'];
		 $group = array($customer_role); 
	     $userid=$this->ion_auth->register($customer_email,$customer_password,$customer_email,$customerUserdata,$group);

         $Addressarray=array_merge($postData['dbinput'],$createdlog);
        $addressid = $this->Address_model->addAddress($Addressarray);
 
         $userdetailsarray = array_merge( array('user_id'=>$userid,'address_id'=>$addressid),$postData['dbinput']['customersdetailsarray'],$createdlog);
	     $userdata_save = $this->Userdetails_model->addUserDetails($userdetailsarray);

	    $patientdetailsarray = array_merge( array('user_id'=>$userid),$createdlog);
	    $patientdata_save = $this->PatientDetails_model->addPatientDetails($patientdetailsarray);
		
            if($userdata_save&&$userid){
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