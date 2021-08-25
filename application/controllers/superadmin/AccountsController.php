<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/superadmin/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;

class AccountsController extends BaseController {
		public function __construct(){
			parent::__construct();
			$this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
			$this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
			$this->load->database();
			$this->load->model('User');
		    $this->load->model('Userdetails_model');
		    $this->load->model('Address_model');
		    $this->load->model('Accounts_model');
		    $this->load->model('Useraccounts_model');
		    $this->load->model('CustomerDbCreate_model');
		    $this->load->model('Customdata_model');
		
		}	

public function AccountsView()
		{
          $this->load->view('superadmin/accountsview');
        }

public function SearchAccountsList()
		{
           
            $searchdata=$this->Accounts_model->SearchAccounts();
           	echo json_encode(array('success'=>true,'data'=>$searchdata));
				return;
	   
		}

public function editAccountsByid($id)
		{
	
	 		  $editAccounts=$this->Accounts_model->EditAccount($id);
	          echo json_encode(array('success'=>true,'data'=>$editAccounts));
	          return;
        }

   public function editAccountStatusByid($id)
		{
	 		$result=Accounts_model::where('id','=',$id)->get(['status','id']);
	        echo json_encode(array('success'=>true,'data'=>$result));
	        return;
	     
        }


     public function updateAccountStatusByid(){

        $account_status_id       			                    = $this->input->post("account_status_id");
        $account_status_change       			                = $this->input->post("account_status_change"); 
			
        $postData=array();
		$changestatus = [];

	    $postData = dataFieldValidation($account_status_change,"Status",$changestatus,"status","",$postData,"statusarray");

	    if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		 }
		 
		 $userId = $this->ion_auth->get_user_id();
         $updatedlog=isUpdateLog($userId);

		$statusarray=array_merge($postData['dbinput']['statusarray'],$updatedlog);
        $updateStatus = $this->Accounts_model->AccountUpdate($statusarray,$account_status_id);
       
             if($updateStatus){
				      echo json_encode(array('success'=>true,'message'=>UPDATE_MSG));
				      return;
				
               }else{
                       echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				       return;
	
                  }	


       }

     public function updateAccountData(){


     	    $account_id       		           = $this->input->post("edit_account_id");
			$account_businessaddid       	   = $this->input->post("edit_account_businessaddid");
			$account_billingaddid       	   = $this->input->post("edit_account_billingaddid");


            $account_name       		       = $this->input->post("edit_account_name");
			$account_shortname       		   = $this->input->post("edit_account_shortname");
			$account_noofdoctors       		   = $this->input->post("edit_account_noofdoctors");

			$account_business_hno       	   = $this->input->post("edit_account_business_hno");
			$account_business_street       	   = $this->input->post("edit_account_business_street");
			$account_business_area       	   = $this->input->post("edit_account_business_area");
			$account_business_landmark         = $this->input->post("edit_account_business_landmark");
			$account_business_city       	   = $this->input->post("edit_account_business_city");
			$account_business_state       	   = $this->input->post("edit_account_business_state");
			$account_business_pincode          = $this->input->post("edit_account_business_pincode");

			if(isset($account_business_pincode) && !empty($account_business_pincode)){
					$account_business_pincode=$account_business_pincode;
				}else{
					$account_business_pincode=0;
				}

            $account_billing_hno       		  = $this->input->post("edit_account_billing_hno");
			$account_billing_street       	  = $this->input->post("edit_account_billing_street");
			$account_billing_area       	  = $this->input->post("edit_account_billing_area");
			$account_billing_landmark         = $this->input->post("edit_account_billing_landmark");
			$account_billing_city       	  = $this->input->post("edit_account_billing_city");
			$account_billing_state       	  = $this->input->post("edit_account_billing_state");
			$account_billing_pincode       	  = $this->input->post("edit_account_billing_pincode");

			if(isset($account_billing_pincode) && !empty($account_billing_pincode)){
					$account_billing_pincode=$account_billing_pincode;
				}else{
					$account_billing_pincode=0;
				}

         $oldimage =  Accounts_model::where('accounts.id',$account_id)->get(['logo']);//fetching from database table
		 json_encode(array('data'=>$oldimage)); 
		 $oldimage1= $oldimage[0]['logo'];

			 $sourcePath= isset($_FILES['edit_account_logo']['tmp_name'])?$_FILES['edit_account_logo']['tmp_name']:'';
               
			if(!empty($sourcePath))
			{
				
				$target_dir = "assets/uploads/hospital_logos/";
				$target_file = $target_dir .basename($_FILES["edit_account_logo"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG")
					{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				} 
                  $temp=rand(0,100000).'_'; 
				$targetPath = FCPATH.$target_dir.$temp.$_FILES['edit_account_logo']['name']; // Target path where file is to be stored
				
				if(move_uploaded_file($sourcePath,$targetPath)){

				$imagepath ="assets/uploads/hospital_logos/";
				$image=$imagepath.$temp.$_FILES['edit_account_logo']['name'];
				} else{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				}
				
			}else{
				$imagepath =null;
				$image=$oldimage1;
				
			}

         $userId = $this->ion_auth->get_user_id();	
         $postData=array();

        $accountdetails=[];
         $postData = dataFieldValidation($account_name, "Account Name",$accountdetails,"account_name","",$postData,"accountdetailsarray");
         $postData = dataFieldValidation($account_shortname, "Account Short Name",$accountdetails,"account_shortname","", $postData,"accountdetailsarray");
         $postData = dataFieldValidation($account_noofdoctors, "No. Of Doctors",$accountdetails,"no_of_doctors","", $postData,"accountdetailsarray");
         $postData = dataFieldValidation($image, "Logo",$accountdetails,"logo","", $postData,"accountdetailsarray");
         
            
         $accountbusinessadressdata = [];

         $postData = dataFieldValidation($account_business_hno, "Bulidding Numnber",$accountbusinessadressdata,"house_no","", $postData,"accountbusinessadressarray");
         $postData = dataFieldValidation($account_business_street, "Street",$accountbusinessadressdata,"street","", $postData,"accountbusinessadressarray");
        
         $postData = dataFieldValidation($account_business_area, "Area",$accountbusinessadressdata,"area","", $postData,"accountbusinessadressarray");
         $postData = dataFieldValidation($account_business_landmark, "LandMark",$accountbusinessadressdata,"landmark","", $postData,"accountbusinessadressarray");

         $postData = dataFieldValidation($account_business_city, "City",$accountbusinessadressdata,"city_id","", $postData,"accountbusinessadressarray");
         $postData = dataFieldValidation($account_business_state, "State",$accountbusinessadressdata,"state_id","", $postData,"accountbusinessadressarray");
         $postData = dataFieldValidation($account_business_pincode, "Pincode",$accountbusinessadressdata,"pincode","", $postData,"accountbusinessadressarray");
     

         $accountbillingadressdata = [];

         $postData = dataFieldValidation($account_billing_hno, "Bulidding Numnber",$accountbillingadressdata,"house_no","", $postData,"accountbillingadressarray");
         $postData = dataFieldValidation($account_billing_street, "Street",$accountbillingadressdata,"street","", $postData,"accountbillingadressarray");
        
         $postData = dataFieldValidation($account_billing_area, "Area",$accountbillingadressdata,"area","", $postData,"accountbillingadressarray");
         $postData = dataFieldValidation($account_billing_landmark, "LandMark",$accountbillingadressdata,"landmark","", $postData,"accountbillingadressarray");

         $postData = dataFieldValidation($account_billing_city, "City",$accountbillingadressdata,"city_id","", $postData,"accountbillingadressarray");
         $postData = dataFieldValidation($account_billing_state, "State",$accountbillingadressdata,"state_id","", $postData,"accountbillingadressarray");
       
         $postData = dataFieldValidation($account_billing_pincode, "Pincode",$accountbillingadressdata,"pincode","", $postData,"accountbillingadressarray");

		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}

		 $userId = $this->ion_auth->get_user_id();
         $updatedlog=isUpdateLog($userId);

        $accountbusinessadressarray=array_merge($postData['dbinput']['accountbusinessadressarray'],$updatedlog);
        $businessaddressid = $this->Address_model->updateAddress($accountbusinessadressarray,$account_businessaddid);

        $accountbillingadressarray=array_merge($postData['dbinput']['accountbillingadressarray'],$updatedlog);
        $billingaddressid = $this->Address_model->updateAddress($accountbillingadressarray,$account_billingaddid );

	    $accountdetailsarray = array_merge($postData['dbinput']['accountdetailsarray'],$updatedlog);
	    $accountdata_update = $this->Accounts_model->AccountUpdate($accountdetailsarray,$account_id );
		
          
            
             if($accountdata_update || $businessaddressid || $billingaddressid){

					echo json_encode(array('success'=>true,'message'=>UPDATE_MSG));
					return;

                    }else{

	                  echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
					  return;
	
                  }	




            }

public function saveAccountData(){

            $account_fname       			   = $this->input->post("add_account_fname");
	    	$account_lname       			   = $this->input->post("add_account_lname");
			$account_mobileno       		   = $this->input->post("add_account_mobileno");
			$account_email       			   = $this->input->post("add_account_email");
			// $account_username       		   = $this->input->post("add_account_email");
			$account_password       		   = $this->input->post("add_account_password");
			$account_role       			   = 2;

            $account_name       		       = $this->input->post("add_account_name");
			$account_shortname       		   = $this->input->post("add_account_shortname");
			$account_noofdoctors       		   = $this->input->post("add_account_noofdoctors");
			$account_dbname       			   = $this->input->post("add_account_dbname");
            $dbname="doctorss_";
			$numnber='_'.rand(0,100000); 
			$account_dbname = $dbname.$account_dbname.$numnber;
          

            $account_idname="DD";
			$account_idrole = $account_role;
			$account_idnumnber = rand(0,100000); 
			$account_username = $account_idname.$account_idrole.$account_idnumnber;
            
			$account_status       			   = 1;
			$account_business_hno       	   = $this->input->post("add_account_business_hno");
			$account_business_street       	   = $this->input->post("add_account_business_street");
			$account_business_area       	   = $this->input->post("add_account_business_area");
			$account_business_landmark         = $this->input->post("add_account_business_landmark");
			$account_business_city       	   = $this->input->post("add_account_business_city");
			$account_business_state       	   = $this->input->post("add_account_business_state");
			$account_business_pincode          = $this->input->post("add_account_business_pincode");

			if(isset($account_business_pincode) && !empty($account_business_pincode)){
					$account_business_pincode=$account_business_pincode;
				}else{
					$account_business_pincode=0;
				}

            $account_billing_hno       		  = $this->input->post("add_account_billing_hno");
			$account_billing_street       	  = $this->input->post("add_account_billing_street");
			$account_billing_area       	  = $this->input->post("add_account_billing_area");
			$account_billing_landmark         = $this->input->post("add_account_billing_landmark");
			$account_billing_city       	  = $this->input->post("add_account_billing_city");
			$account_billing_state       	  = $this->input->post("add_account_billing_state");
			$account_billing_pincode       	  = $this->input->post("add_account_billing_pincode");

			if(isset($account_billing_pincode) && !empty($account_billing_pincode)){
					$account_billing_pincode=$account_billing_pincode;
				}else{
					$account_billing_pincode=0;
				}
		 
		    $result=uniqueMail($account_email);
			
			if($result>0)
			{
				echo json_encode(array('success'=>false,'message'=>EMAIL_EXISTS_MSG));
				return; 
			}
            
             $id=null;
			$result= uniqueUserName($account_username,$id);
			if($result>0)
			{
				echo json_encode(array('success'=>false,'message'=>EMPID_EXISTS_MSG));
				return;
			}	
            
         $sourcePath1= isset($_FILES['add_account_logo']['tmp_name'])?$_FILES['add_account_logo']['tmp_name']:'';
                
			if(!empty($sourcePath1))
			{
				
				$target_dir = "assets/uploads/hospital_logos/";
				$target_file = $target_dir .basename($_FILES["add_account_logo"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			 
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF")
					{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				} 
                  $temp=rand(0,100000).'_'; 
				 $targetPath = FCPATH.$target_dir.$temp.$_FILES['add_account_logo']['name']; // Target path where file is to be stored
				
				if(move_uploaded_file($sourcePath1,$targetPath)){

				$imagepath ="assets/uploads/hospital_logos/";
				$image=$imagepath.$temp.$_FILES['add_account_logo']['name'];
				} else{
					echo json_encode(array('success'=>false,'message'=>"File Not Uploaded..."));
					return;
				}
				
			}else{
				$imagepath =null;
				$image=null;
				// echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
				// 	return;
				
			}

		$userId = $this->ion_auth->get_user_id();	
        $postData=array();
         
        $accountdata = [];
         
         $postData = dataFieldValidation($account_email, "Email",$accountdata,"email","",$postData,"accountdataarray");
         $postData = dataFieldValidation($account_username, "User Name",$accountdata,"username","",$postData,"accountdataarray");
         $postData = dataFieldValidation($account_password, "Password",$accountdata,"password","", $postData,"accountdataarray");
         $postData = dataFieldValidation($account_status, "Status",$accountdata,"active","", $postData,"accountdataarray");
         
         $accountdetailsdata = [];

         $postData = dataFieldValidation($account_fname, "First Name",$accountdetailsdata,"first_name","",$postData,"accountdetailsdataarray");
         $postData = dataFieldValidation($account_lname, "Last Name",$accountdetailsdata,"last_name","", $postData,"accountdetailsdataarray");
         $postData = dataFieldValidation($account_mobileno, "Mobile No",$accountdetailsdata,"mobileno","", $postData,"accountdetailsdataarray");

        $accountdetails=[];

         $postData = dataFieldValidation($account_name, "Account Name",$accountdetails,"account_name","",$postData,"accountdetailsarray");
         $postData = dataFieldValidation($account_shortname, "Account Short Name",$accountdetails,"account_shortname","", $postData,"accountdetailsarray");
         $postData = dataFieldValidation($account_noofdoctors, "No. Of Doctors",$accountdetails,"no_of_doctors","", $postData,"accountdetailsarray");
         $postData = dataFieldValidation($account_dbname, "DB Name",$accountdetails,"dbname","", $postData,"accountdetailsarray");
         $postData = dataFieldValidation($account_status, "Status",$accountdetails,"status","", $postData,"accountdetailsarray");
         $postData = dataFieldValidation($image, "Logo",$accountdetails,"logo","", $postData,"accountdetailsarray");
            
         $accountbusinessadressdata = [];

         $postData = dataFieldValidation($account_business_hno, "Bulidding Numnber",$accountbusinessadressdata,"house_no","", $postData,"accountbusinessadressarray");
         $postData = dataFieldValidation($account_business_street, "Street",$accountbusinessadressdata,"street","", $postData,"accountbusinessadressarray");
         $postData = dataFieldValidation($account_business_area, "Area",$accountbusinessadressdata,"area","", $postData,"accountbusinessadressarray");
         $postData = dataFieldValidation($account_business_landmark, "LandMark",$accountbusinessadressdata,"landmark","", $postData,"accountbusinessadressarray");
         $postData = dataFieldValidation($account_business_city, "City",$accountbusinessadressdata,"city_id","", $postData,"accountbusinessadressarray");
         $postData = dataFieldValidation($account_business_state, "State",$accountbusinessadressdata,"state_id","", $postData,"accountbusinessadressarray");
         $postData = dataFieldValidation($account_business_pincode, "Pincode",$accountbusinessadressdata,"pincode","", $postData,"accountbusinessadressarray");
     

         $accountbillingadressdata = [];

         $postData = dataFieldValidation($account_billing_hno, "Bulidding Numnber",$accountbillingadressdata,"house_no","", $postData,"accountbillingadressarray");
         $postData = dataFieldValidation($account_billing_street, "Street",$accountbillingadressdata,"street","", $postData,"accountbillingadressarray");
         $postData = dataFieldValidation($account_billing_area, "Area",$accountbillingadressdata,"area","", $postData,"accountbillingadressarray");
         $postData = dataFieldValidation($account_billing_landmark, "LandMark",$accountbillingadressdata,"landmark","", $postData,"accountbillingadressarray");
         $postData = dataFieldValidation($account_billing_city, "City",$accountbillingadressdata,"city_id","", $postData,"accountbillingadressarray");
         $postData = dataFieldValidation($account_billing_state, "State",$accountbillingadressdata,"state_id","", $postData,"accountbillingadressarray");
         $postData = dataFieldValidation($account_billing_pincode, "Pincode",$accountbillingadressdata,"pincode","", $postData,"accountbillingadressarray");
     
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
        
 
        $createdlog=isCreatedLog($userId);
        
        $accountdata=$postData['dbinput']['accountdataarray'];

       $group =array($account_role);
       

	    $userid=$this->ion_auth->register($account_username,$account_password,$account_email,$accountdata,$group);
   
        $accountbusinessadressarray=array_merge($postData['dbinput']['accountbusinessadressarray'],$createdlog);
        $businessaddressid = $this->Address_model->addAddress($accountbusinessadressarray);

        $accountbillingadressarray=array_merge($postData['dbinput']['accountbillingadressarray'],$createdlog);
        $billingaddressid = $this->Address_model->addAddress($accountbillingadressarray);
        
    
	    $accountdetailsarray = array_merge( array('business_address_id'=>$businessaddressid,'billing_address_id'=>$billingaddressid),$postData['dbinput']['accountdetailsarray'],$createdlog);
	    $accountdata_id = $this->Accounts_model->addAccount($accountdetailsarray);
        
        $userdetailsarray = array_merge( array('user_id'=>$userid),array('address_id'=>$businessaddressid),$postData['dbinput']['accountdetailsdataarray'],$createdlog);
	    $accountdetails_save = $this->Userdetails_model->addUserDetails($userdetailsarray);
       
        $accountroledataarray = array('user_id'=>$userid,'account_id'=>$accountdata_id,'role_id'=>$account_role);
	    $accountroledata_save = $this->Useraccounts_model->addAccountRole($accountroledataarray);
          


            if($accountdata_id && $businessaddressid && $billingaddressid && $accountroledata_save){

            	 $createdb= $this->CustomerDbCreate_model->CreateDynamicDatabaseTables($account_dbname);

                 $account_encryptid= encode($accountdata_id,ENCRYPT_KEY);
                 $updatedlog=isUpdateLog($userId);
	             $accountdetailsarray = array_merge(array('encrypted_id'=>$account_encryptid),$updatedlog);
	             $accountdata_update = $this->Accounts_model->AccountUpdate($accountdetailsarray,$accountdata_id);


	            	 if($createdb&&$accountdata_update){

	            	 	 $subject='NewRegistration';
				$url = getHostURL(true);
				$name=$account_fname.' '.$account_lname;
				$to_email=$account_email;
				$userid=$account_username;
				$password=$account_password;
		        $hiuser = ucfirst($name);
				$body=Customdata_model::where('content_type','=','NewRegistration')->first()->content;
				$body=str_replace("{Name}",$hiuser,$body);
				$body=str_replace("{User_Id}",$userid,$body);
				$body=str_replace("{Email_Id}",$to_email,$body);
				$body=str_replace("{Password}",$password,$body);
				$body=str_replace("{URL}",$url,$body);
		        sendEmail("bizbrainz2020@gmail.com","Administrator",$to_email,$subject,$body,null);


		               	echo json_encode(array('success'=>true,'message'=>SAVE_MSG));
						return;
				      }else{
						echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
						return;
				       }
				       	
			   }else{
				echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				return;
			}	


      }



public function deleteAccountById($id)
		{
	
	   if(isset($id)&&$id>0){
             $deletedata=$this->Accounts_model->DeleteAccount($id);
                if($deletedata ) {
			                 echo json_encode(array('success'=>true,'message'=>DELTE_MSG));
			                 return;
                        }else{
                             echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				              return;
                         }   
     	      }else{
                  echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				              return;
     	       }
     
       }

public function loginAccountById($id){
	if (isset($id)&&$id>0) {
		$logindata=$this->Accounts_model->LoginAccountById($id);

		if($logindata){
             $user_id=$logindata[0]['user_id'];
             $encryptid=$logindata[0]['encrypted_id'];
             $userroles=$logindata[0]['name'];
             if($logindata[0]['logo'] === null || strlen($logindata[0]['logo']) === 0){
					$logo = 'assets/images/profile-img.jpg';
				}else{
                    $logo=$logindata[0]['logo'];
				}
             $name=$logindata[0]['first_name'].' '.$logindata[0]['last_name'];
             $username=$logindata[0]['username'];
             $email =$logindata[0]['email'];
             $issuperadmin=1;
             $useracc_roles=null;
             session_start();
				$sessiondata = [
					'user_id'  =>  $user_id,
					'username' => $username,
					'issuperadmin' => $issuperadmin,
					'user_roles' => $userroles,
					'user_account_roles' => $useracc_roles,
					'encrypt_id' => $encryptid,
					'email'    => $email,
					'logo'=> $logo,
					'name'=>$name,
				  ];
				 $this->session->set_userdata($sessiondata);
	         echo json_encode(array('success'=>true,'data'=>$sessiondata));
		}else{
			echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
			return;
		}
	}else{
		echo json_encode(array('success'=>false,'message'=>IDNOTEXIT_ERROR));
		return;
	}

}       
 

      

}
?>