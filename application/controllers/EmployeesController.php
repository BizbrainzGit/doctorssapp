<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
include_once(APPPATH.'controllers/CommonBaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;

class EmployeesController extends CommonBaseController {
		public function __construct(){
			parent::__construct();
			$this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
			$this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
			$this->load->database();
		    $this->load->model('User');
		    $this->load->model('Userdetails_model');
		    $this->load->model('Address_model');
		    $this->load->model('customerdb/DoctorDetails_model');
		    $this->load->model('PatientDetails_model');
		    $this->load->model('Cities_model');
            $this->load->model('States_model');
            $this->load->model('Useraccounts_model');
            $this->load->model('Customdata_model');
		
		}	
 
public function SuperAdminemployeesView()
		{
          $this->load->view('superadmin/employeesview');
      }

public function AdminemployeesView()
		{
          $this->load->view('admin/employeesview');
      }
      
public function editEmployeesByid($id)
		{
	
	   $editEmployees=$this->Userdetails_model->EditEmployees($id);
	   echo json_encode(array('success'=>true,'data'=>$editEmployees));
     }

   public function editEmployeesStatusByid($id)
		{
	 		$result=$this->User->getStatus($id);
	        echo json_encode(array('success'=>true,'data'=>$result));
	     
        }


     public function updateEmployeesStatusByid(){

        $employees_status_id       			                    = $this->input->post("employees_status_id");
        $employees_status_change       			                = $this->input->post("employees_status_change"); 
        $postData=array();
		$changestatus = [];

	    $postData = dataFieldValidation($employees_status_change, "Status",$changestatus,"active","",$postData,"statusarray");
	   if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		  }
		
         $updateStatus = $this->User->updateStatus($postData['dbinput']['statusarray'],$employees_status_id);
             if($updateStatus){
				echo json_encode(array('success'=>true,'message'=>UPDATE_MSG,'data'=>$updateStatus));
				return;
              }else{
                  echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				  return;
	
                  }	
  }


     public function updateEmployeesData(){

                      $id 					               = $this->input->post("edit_employees_id");
                      $address_id 					       = $this->input->post("edit_employees_addid");
                      $user_id 				     	       = $this->input->post("edit_employees_userid");

                      $employees_role       		       = $this->input->post("edit_employees_role");

                      $employees_hno                       = $this->input->post("edit_employees_hno");
                      $employees_street                    = $this->input->post("edit_employees_street");
                      
                      $employees_area                      = $this->input->post("edit_employees_area");
                      $employees_landmark                  = $this->input->post("edit_employees_landmark");
                      $employees_city                      = $this->input->post("edit_employees_city");
                      $employees_state                     = $this->input->post("edit_employees_state");
                      $employees_pincode                   = $this->input->post("edit_employees_pincode");


                      if(isset($employees_pincode) && !empty($employees_pincode)){
					$employees_pincode=$employees_pincode;
				}else{
					$employees_pincode=0;
				}
                      $employees_fname                     = $this->input->post("edit_employees_fname");
                      $employees_lname                     = $this->input->post("edit_employees_lname");
                      $employees_mobileno                  = $this->input->post("edit_employees_mobileno");
					  $employees_gender       		       = $this->input->post("edit_employees_gender");
					  $employees_dob       		           = $this->input->post("edit_employees_dob");
					  $employees_dob                       = date("Y-m-d", strtotime($employees_dob));
                      

          $oldimage =  Userdetails_model::where('id',$id)->get(['profile_pic_path']);//fetching from database table
		 json_encode(array('data'=>$oldimage)); 
		 $oldimage1= $oldimage[0]['profile_pic_path'];

			 $sourcePath= isset($_FILES['edit_employees_photo']['tmp_name'])?$_FILES['edit_employees_photo']['tmp_name']:'';
               
			if(!empty($sourcePath))
			{
				
				$target_dir = "assets/uploads/employees/";
				$target_file = $target_dir .basename($_FILES["edit_employees_photo"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG")
					{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				} 
                  $temp=rand(0,100000).'_'; 
				$targetPath = FCPATH.$target_dir.$temp.$_FILES['edit_employees_photo']['name']; // Target path where file is to be stored
				
				if(move_uploaded_file($sourcePath,$targetPath)){

				$imagepath ="assets/uploads/employees/";
				$image=$imagepath.$temp.$_FILES['edit_employees_photo']['name'];
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
           
           $employeesdata = [];
           $postData= dataFieldValidation($employees_role, "Role ID",$employeesdata,"role_id","",$postData,"employeesdataarray");
          

          $employeesdetails=[];

         $postData = dataFieldValidation($image, "Photo",$employeesdetails,"profile_pic_path","", $postData,"employeesdetailsarray");
         $postData = dataFieldValidation($employees_fname, "First Name",$employeesdetails,"first_name","",$postData,"employeesdetailsarray");
         $postData = dataFieldValidation($employees_lname, "Last Name",$employeesdetails,"last_name","", $postData,"employeesdetailsarray");
         $postData = dataFieldValidation($employees_mobileno, "Mobile No",$employeesdetails,"mobileno","", $postData,"employeesdetailsarray");

         $postData = dataFieldValidation($employees_gender, "Gender",$employeesdetails,"gender","", $postData,"employeesdetailsarray");
         $postData = dataFieldValidation($employees_dob, "Date Of Birth",$employeesdetails,"dob","", $postData,"employeesdetailsarray");
         
          
	                
           $employeesadressdata = [];

        $postData = dataFieldValidation($employees_hno, "Bulidding Numnber",$employeesadressdata,"house_no","", $postData,"employeesAddressarray");
         $postData = dataFieldValidation($employees_street, "Street",$employeesadressdata,"street","", $postData,"employeesAddressarray");
        
       
         $postData = dataFieldValidation($employees_area, "Area",$employeesadressdata,"area","", $postData,"employeesAddressarray");
         $postData = dataFieldValidation($employees_landmark, "LandMark",$employeesadressdata,"landmark","", $postData,"employeesAddressarray");

         $postData = dataFieldValidation($employees_city, "City",$employeesadressdata,"city_id","", $postData,"employeesAddressarray");
         $postData = dataFieldValidation($employees_state, "State",$employeesadressdata,"state_id","", $postData,"employeesAddressarray");
         $postData = dataFieldValidation($employees_pincode, "Pincode",$employeesadressdata,"pincode","", $postData,"employeesAddressarray");
     
		
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
		 $userId = $this->ion_auth->get_user_id();
         $updatedlog=isUpdateLog($userId);

        $updateuser = $this->Useraccounts_model->updateAccountRole($postData['dbinput']['employeesdataarray'],$user_id);

        $employeesAddressarray = array_merge($postData['dbinput']['employeesAddressarray'],$updatedlog);
        $updateaddress = $this->Address_model->updateAddress($employeesAddressarray,$address_id);

        $employeesdetailsarray = array_merge($postData['dbinput']['employeesdetailsarray'],$updatedlog);
		$updatedetails = $this->Userdetails_model->updateUserDetails($employeesdetailsarray,$user_id);
            
             if($updatedetails||$updateaddress|| $updateuser ){

				echo json_encode(array('success'=>true,'message'=>UPDATE_MSG));
				return;
				
              }else{

                  echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

				return;
	
                  }	




            }

public function saveEmployeesData(){


			$employees_hno       				       = $this->input->post("add_employees_hno");
			$employees_street       			       = $this->input->post("add_employees_street");
			
			$employees_area       			           = $this->input->post("add_employees_area");
			$employees_landmark       			       = $this->input->post("add_employees_landmark");
			$employees_city       				       = $this->input->post("add_employees_city");
			$employees_state       			           = $this->input->post("add_employees_state");
			$employees_pincode       			       = $this->input->post("add_employees_pincode");

			if(isset($employees_pincode) && !empty($employees_pincode)){
					$employees_pincode=$employees_pincode;
				}else{
					$employees_pincode=0;
				}

			$employees_fname       			           = $this->input->post("add_employees_fname");
			$employees_lname       				       = $this->input->post("add_employees_lname");
			$employees_mobileno       			       = $this->input->post("add_employees_mobileno");
			$employees_gender       		           = $this->input->post("add_employees_gender");
			$employees_dob       		               = $this->input->post("add_employees_dob");
			$employees_dob                             = date("Y-m-d", strtotime($employees_dob));

			$employees_email       				       = $this->input->post("add_employees_email");
			$employees_password       			       = $this->input->post("add_employees_password");
			$employees_role       			           = $this->input->post("add_employees_role");

			$employees_idname="DD";
			$employees_idrole = $employees_role;
			$employees_idnumnber=rand(0,100000); 
			$employees_id = $employees_idname.$employees_idrole.$employees_idnumnber;

			$employees_accountid = $this->input->post("add_employees_accountid");
             if(isset($employees_accountid) && !empty($employees_accountid)){
					 $account_id=$employees_accountid;
				}else{
					 $account_id=$this->account_id;
				}
				

            $result=uniqueMail($employees_email);
			
			if($result>0)
			{
				echo json_encode(array('success'=>false,'message'=>EMAIL_EXISTS_MSG));
				return; 
			}
            $id=null;
			$result= uniqueUserName($employees_employe_id,$id);
			if($result>0)
			{
				echo json_encode(array('success'=>false,'message'=>EMPID_EXISTS_MSG));
				return;
			}


		
	      $sourcePath1= isset($_FILES['add_employees_photo']['tmp_name'])?$_FILES['add_employees_photo']['tmp_name']:'';
                
			if(!empty($sourcePath1))
			{
				
				$target_dir = "assets/uploads/employees/";
				$target_file = $target_dir .basename($_FILES["add_employees_photo"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			 
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF")
					{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				} 
                  $temp=rand(0,100000).'_'; 
				 $targetPath = FCPATH.$target_dir.$temp.$_FILES['add_employees_photo']['name']; // Target path where file is to be stored
				
				if(move_uploaded_file($sourcePath1,$targetPath)){

				$imagepath ="assets/uploads/employees/";
				$image=$imagepath.$temp.$_FILES['add_employees_photo']['name'];
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
           $employeesdata = [];
          $postData = dataFieldValidation($employees_password, "Password",$employeesdata,"password","", $postData,"employeesdataarray");
          $postData = dataFieldValidation($employees_email, "Email",$employeesdata,"email","",$postData,"employeesdataarray");
          $postData = dataFieldValidation($employees_id, "User ID",$employeesdata,"username","",$postData,"employeesdataarray");
          $postData= dataFieldValidation($employees_role, "Role ID",$employeesdata,"role_id","",$postData,"employeesdataarray");
	     

          $employeesdetails=[];

         $postData = dataFieldValidation($image, "Photo",$employeesdetails,"profile_pic_path","", $postData,"employeesdetailsarray");
         $postData = dataFieldValidation($employees_fname, "First Name",$employeesdetails,"first_name","",$postData,"employeesdetailsarray");
         $postData = dataFieldValidation($employees_lname, "Last Name",$employeesdetails,"last_name","", $postData,"employeesdetailsarray");
         $postData = dataFieldValidation($employees_mobileno, "Mobile No",$employeesdetails,"mobileno","", $postData,"employeesdetailsarray");
         $postData = dataFieldValidation($employees_gender, "Gender",$employeesdetails,"gender","", $postData,"employeesdetailsarray");
         $postData = dataFieldValidation($employees_dob, "Date Of Birth",$employeesdetails,"dob","", $postData,"employeesdetailsarray");

	     
            
        $employeesadressdata = [];

        $postData = dataFieldValidation($employees_hno, "Bulidding Numnber",$employeesadressdata,"house_no","", $postData,"employeesAddressarray");
        $postData = dataFieldValidation($employees_street, "Street",$employeesadressdata,"street","", $postData,"employeesAddressarray");
        
        $postData = dataFieldValidation($employees_area, "Area",$employeesadressdata,"area","", $postData,"employeesAddressarray");
        $postData = dataFieldValidation($employees_landmark, "LandMark",$employeesadressdata,"landmark","", $postData,"employeesAddressarray");

        $postData = dataFieldValidation($employees_city, "City",$employeesadressdata,"city_id","", $postData,"employeesAddressarray");
        $postData = dataFieldValidation($employees_state, "State",$employeesadressdata,"state_id","", $postData,"employeesAddressarray");
        $postData = dataFieldValidation($employees_pincode, "Pincode",$employeesadressdata,"pincode","", $postData,"employeesAddressarray");

	    if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
				echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
				return;
			}
        
 
        $createdlog=isCreatedLog($userId);
		
		$employeedata=$postData['dbinput']['employeesdataarray'];
		$group = array($employees_role); 
		$userid=$this->ion_auth->register($employees_id,$employees_password,$employees_email,$employeedata,$group);
       
        $employeesAddressarray=array_merge($postData['dbinput']['employeesAddressarray'],$createdlog);
        $addressid = $this->Address_model->addAddress($employeesAddressarray);
	   
	   $userroledataarray = array('user_id'=>$userid,'account_id'=>$account_id,'role_id'=>$employees_role);
	   $userroledata_save = $this->Useraccounts_model->addAccountRole($userroledataarray);

	   $userdetailsarray = array_merge( array('address_id'=>$addressid,'user_id'=>$userid),$postData['dbinput']['employeesdetailsarray']);
	   $userdata_save = $this->Userdetails_model->addUserDetails($userdetailsarray);
		
          
            if($addressid || $userid_save || $userdata_save){

            	$subject='NewRegistration';
				$url = getHostURL(true);
				$name=$employees_fname.' '.$employees_lname;
				$to_email=$employees_email;
				$userid=$demployees_id;
				$password=$employees_password;
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
			}
			else
			{
				echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				return;
			}	




            }



public function deleteEmployeesById($id)
		{
	 // echo $id;
	// die();
	   if(isset($id)&&$id>0){
           
            $getid=$this->Userdetails_model->EditEmployees($id);
            $address_id= $getid[0]['address_id'];
            $user_id= $getid[0]['user_id'];
            $role_id= $getid[0]['role_id'];

             $deleteAddress=$this->Address_model->deleteAddress($address_id);
	         $deleteuserdetails=$this->Userdetails_model->DeleteEmployees($id);
	         $deleteuser=$this->User->deleteUserById($user_id);
	         if($role_id==4){
                    $deleteuserdetails=$this->DoctorDetails_model->DeleteDoctordetails($user_id);
	           }

                if($deleteuserdetails && $deleteAddress && $deleteuser ) {
			                
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

public function SearchEmployeeList()
		{
           
           $employee_name                 = $this->input->post("search_employee_name");  
           $employee_designation          = $this->input->post("search_employee_designation");
           
           $masterdb = $this->db->database;
           $userrole=$this->session->userdata('user_roles');

            if($userrole=="Admin"||$userrole=="Super Admin"){
                      $account_role= $userrole;
                   }else {
                      $account_role="";
               }
          $account_id                    = $this->account_id;
          $searchdata=$this->Userdetails_model->SearchEmployee($employee_name,$employee_designation,$account_role,$account_id);
           	echo json_encode(array('success'=>true,'data'=>$searchdata,'role'=>$userrole));
				return;
	   
		}


public function forgotpasswordEmployeesById($id)
		{ 

               $newpassword=randomPassword();
               $Employeesdata=$this->Userdetails_model->EditEmployees($id);
               $identity= $Employeesdata[0]['email'] ;
               $name=$Employeesdata[0]['first_name'].' '.$Employeesdata[0]['last_name'];
			   $result=$this->ion_auth_model->reset_password($identity,$newpassword);

				$subject='Reset Password';
				$attachament =null;
			    $body=Customdata_model::where('content_type','=','Reset Password')->first()->content;
			    $body=str_replace("{Name}",$name,$body);
				$body=str_replace("{Email}",$identity,$body);
				$body=str_replace("{Password}",$newpassword,$body);
                                                                                      
            if($result){
		            if(sendEmail("bizbrainz2020@gmail.com","Hospital Project",$identity,$subject,$body,$attachament)){
				             echo json_encode(array('success'=>true,'message'=>EMAIL_RESET_LINK));
				             return;
				           }

		              }else{
			          echo json_encode(array('success'=>false,'message'=>INVALID_PASSWORD_MSG));
			           return;
		         }

		}
      

}
?>