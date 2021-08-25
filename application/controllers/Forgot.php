<?php defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Query\Expression as raw;
class Forgot extends CI_Controller {
	public function __construct()
	{
	     parent::__construct();
	    $this->load->library(array('session','form_validation','Excel_reader','email','ValidationTypes','ion_auth'));
		$this->load->helper(array('form','html','Util'));
		$this->load->database();
		$this->load->model('User');
		$this->load->model('Customdata_model');
		log_custom_message("Forgot Controller Constructor Called");  
	}
   
public function ForgetPasswordView()
	{
		$this->load->view('forgetpassword');
	}

public function changePasswordView()
	{
		$this->load->view('changepassword');
	}	

public function forgotpassword(){

		$email = $this->input->post('forgotpassword_email');
		$email=$email;
		  $resetpasswordcheck=$this->User->resetPassword($email);
		if($resetpasswordcheck<=0){
			echo json_encode(array('success'=>false,'message'=>EMAIL_DOESNT_MATCH));
			return;
		}
		else{
			$forgotten = $this->ion_auth->forgotten_password($email);
			$useremaildata=$this->User->findByEmail($email);

			if ($useremaildata == null || count($useremaildata) <= 0){
				echo json_encode(array('success'=>false,'message'=>INVALID_EMAIL_MSG));
				return;
			}
            $name=$useremaildata[0]['first_name'].' '.$useremaildata[0]['last_name'];
            // echo $email=$useremaildata[0]['email'];
			$subject='Reset Password from Hospital Project';
			$url = getHostURL(true).'Forgot/changePasswordView?token='.$forgotten['forgotten_password_code'];
			$message='<h1> Hi, '.$name.'</h1>
				<p> One last step is required </p>
				<p>Please click on the following link to forgot password your account</p>
				<p><a href='.$url.'> click here </a></p><br>
				<p>Thank You</p>';
				$attachament =null;
			if(sendEmail("tbbrao1991@gmail.com","Hospital Project",$email,$subject,$message,$attachament) && $forgotten){
				echo json_encode(array('success'=>true,'message'=>EMAIL_RESET_LINK));
                
			}
		}
	}


			
function changePassword(){
		
		        $old_password		       			= $this->input->post("old_password");
				$new_password 		    			= $this->input->post("new_password");
				$confirm_password		            = $this->input->post("confirm_password");
                 $identity = $this->session->userdata('identity');
        // $identitypass = $this->session->userdata('password');             
		
		/*if ( $identitypass == null || $identitypass!=$old_password){
			echo json_encode(array('success'=>false,'message'=>INVALID_PASSWORD_MSG));
			return;
		}*/
		
		
             $postData=array();
			 $changepassdata = [];
		  
		  $postData = dataFieldValidation($new_password, "New Password", $changepassdata, "password",  [ValidationTypes::REQUIRED],$postData,"postDataArray");
		 
         if(isset($postData['errorslist']) && is_array($postData['errorslist'])){
			echo json_encode(array('success'=>false,'message'=>'Please Enter Correct Details...'));
			return;
		     }

			$change = $this->ion_auth->change_password($identity,$old_password,$new_password);
			
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




function resetPassword(){
	    $code=$this->input->post('code');
		$newpassword = $this->input->post('newpassword');
		$confirmpassword = $this->input->post('confirmpassword');
	    $reset = $this->ion_auth->get_user_by_forgotten_password_code($code);
	//  print_r($reset);
	// echo $identity= $reset->email ;
	//  $oldpassword=$reset->password;
	//  echo $normalpassword = Password($oldpassword);

		if ($reset){ 
		 //if the reset worked then send them to the login page
			 $identity= $reset->email ;
	         $oldpassword=$reset->password;
			$result=$this->ion_auth_model->reset_password($identity,$newpassword);
            if($result){
		            	echo json_encode(array('success'=>true,'message'=>PWD_CHANGE_MSG, 'url'=>getHostURL().'login'));
					    return;
		          }else{
			         echo json_encode(array('success'=>false,'message'=>INVALID_PASSWORD_MSG));
			         return;
		        } 
			
		}
		else { //if the reset didnt work then send them back to the forgot password page
			echo json_encode(array('success'=>false,'message'=>INVALID_TOKEN_MSG));
			return;
		}
		
	}



}
?>