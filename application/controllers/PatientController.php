<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH.'controllers/CommonBaseController.php');
error_reporting(0);
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;
class PatientController extends CommonBaseController {
		public function __construct(){
			parent::__construct();
			$this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
			$this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
			$this->load->database();
			$this->load->model('User');
		    $this->load->model('Userdetails_model');
		    $this->load->model('Address_model');
		    $this->load->model('PatientDetails_model');
		    $this->load->model('Cities_model');
            $this->load->model('States_model');
            $this->load->model('Useraccounts_model');
            $this->load->model('PatientDocuments_model');
            $this->load->model('Customdata_model');
		}	

  public function PatientView()
		{
          $this->load->view('admin/patientview');
        }
  public function Receptionist_PatientView()
		{
          $this->load->view('receptionist/receptionistpatientview');
       }

   public function SearchPatientList()
		{
             $masterdb    = $this->db->database;
             $account_id  = $this->account_id;
             $searchdata=$this->PatientDetails_model->SearchPatients($account_id,$masterdb);
            	echo json_encode(array('success'=>true,'data'=>$searchdata));
				return;
		}
      
public function savePatientData(){
            
            $patient_fname       			           = $this->input->post("add_patient_fname");
			$patient_lname       				       = $this->input->post("add_patient_lname");
			$patient_mobileno       			       = $this->input->post("add_patient_mobileno");
			$patient_age       				           = $this->input->post("add_patient_age");
			$patient_gender       		               = $this->input->post("add_patient_gender");
			$patient_email       		               = $this->input->post("add_patient_email");
			$patient_username            		       = $this->input->post("add_patient_email");
			$patient_password       		           = $this->input->post("add_patient_password");
			$patient_role       			           = 6;

			$patient_idname="DD";
			$patient_idrole = $patient_role;
			$patient_idnumnber=rand(0,100000); 
			$patient_id = $patient_idname.$patient_idrole.$patient_idnumnber;
			
			$patient_height      			           = $this->input->post("add_patient_height");
			$patient_weight       				       = $this->input->post("add_patient_weight");
			$patient_bloodgroup       			       = $this->input->post("add_patient_bloodgroup");
			$patient_bloodprusser       			   = $this->input->post("add_patient_bloodprusser");
			$patient_pulse                             = $this->input->post("add_patient_pulse");
			$patient_allergy      		        	   = $this->input->post("add_patient_allergy");
			$patient_diet                              = $this->input->post("add_patient_diet");

			$patient_hno       				           = $this->input->post("add_patient_hno");
			$patient_street       			           = $this->input->post("add_patient_street");
			$patient_area       			           = $this->input->post("add_patient_area");
			$patient_landmark       			       = $this->input->post("add_patient_landmark");
			$patient_city       				       = $this->input->post("add_patient_city");
			$patient_state       			           = $this->input->post("add_patient_state");
			$patient_pincode       			           = $this->input->post("add_patient_pincode");

			if(isset($patient_pincode) && !empty($patient_pincode)){
					$patient_pincode=$patient_pincode;
				}else{
					$patient_pincode=0;
				}


		$result=uniqueMail($patient_email);
			if($result>0)
			{
				echo json_encode(array('success'=>false,'message'=>EMAIL_EXISTS_MSG));
				return; 
			}
			
		 $id=null;
			$result= uniqueUserName($patient_id,$id);
			if($result>0)
			{
				echo json_encode(array('success'=>false,'message'=>EMPID_EXISTS_MSG));
				return;
			}	
         
         $sourcePath1= isset($_FILES['add_patient_photo']['tmp_name'])?$_FILES['add_patient_photo']['tmp_name']:'';
                
			if(!empty($sourcePath1))
			{
				
				$target_dir = "assets/uploads/patient_photos/";
				$target_file = $target_dir .basename($_FILES["add_patient_photo"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			 
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF")
					{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				} 
                  $temp=rand(0,100000).'_'; 
				 $targetPath = FCPATH.$target_dir.$temp.$_FILES['add_patient_photo']['name']; // Target path where file is to be stored
				
				if(move_uploaded_file($sourcePath1,$targetPath)){

				$imagepath ="assets/uploads/patient_photos/";
				$image=$imagepath.$temp.$_FILES['add_patient_photo']['name'];
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
          $patient_documents = $this->input->post("add_patient_documents");
		   $userId = $this->ion_auth->get_user_id();
		   $account_id=$this->account_id;

           $postData=array();
           $patientdata = [];
         
         
          $postData = dataFieldValidation($patient_password, "Password",$patientdata,"password",[ValidationTypes::REQUIRED], $postData,"patientdataarray");
          $postData = dataFieldValidation($patient_email, "Email",$patientdata,"email",[ValidationTypes::REQUIRED],$postData,"patientdataarray");
          $postData = dataFieldValidation($patient_id, "User ID",$patientdata,"username",[ValidationTypes::REQUIRED],$postData,"patientdataarray");
          $postData= dataFieldValidation($patient_role, "Role ID",$patientdata,"role_id","",$postData,"patientdataarray");
	     
          $postData = dataFieldValidation($patient_fname, "First Name",$patientdetails,"first_name",[ValidationTypes::REQUIRED],$postData,"patientdataarray");
         $postData = dataFieldValidation($patient_lname, "Last Name",$patientdetails,"last_name",[ValidationTypes::REQUIRED], $postData,"patientdataarray");
         $postData = dataFieldValidation($patient_mobileno, "Mobile No",$patientdetails,"mobileno",[ValidationTypes::REQUIRED], $postData,"patientdataarray");
         $postData = dataFieldValidation($patient_age, "Age",$patientdetails,"age",[ValidationTypes::REQUIRED], $postData,"patientdataarray");
         $postData = dataFieldValidation($patient_gender, "Gender",$patientdetails,"gender",[ValidationTypes::REQUIRED], $postData,"patientdataarray");
         $postData = dataFieldValidation($image, "Photo",$patientdetails,"profile_pic_path","", $postData,"patientdataarray");



          $patientdetails=[];

         $postData = dataFieldValidation($patient_height, "Height",$patientdetails,"height",[ValidationTypes::REQUIRED],$postData,"patientdetailsarray");
         $postData = dataFieldValidation($patient_weight, "Weight",$patientdetails,"weight",[ValidationTypes::REQUIRED], $postData,"patientdetailsarray");
         $postData = dataFieldValidation($patient_bloodgroup, "Blood Group",$patientdetails,"blood_group",[ValidationTypes::REQUIRED], $postData,"patientdetailsarray");
         $postData = dataFieldValidation($patient_bloodprusser, "Blood Prusser",$patientdetails,"blood_prusser",[ValidationTypes::REQUIRED], $postData,"patientdetailsarray");
         $postData = dataFieldValidation($patient_pulse, "Pulse",$patientdetails,"pulse",[ValidationTypes::REQUIRED], $postData,"patientdetailsarray");
         $postData = dataFieldValidation($patient_allergy, "Allergy",$patientdetails,"allergy","", $postData,"patientdetailsarray");
         $postData = dataFieldValidation($patient_diet, "Diet",$patientdetails,"diet","", $postData,"patientdetailsarray");
         
            
        $patientadressdata = [];
        $postData = dataFieldValidation($patient_hno, "Bulidding Numnber",$patientadressdata,"house_no","", $postData,"patientAddressarray");
         $postData = dataFieldValidation($patient_street, "Street",$patientadressdata,"street",[ValidationTypes::REQUIRED], $postData,"patientAddressarray");
         $postData = dataFieldValidation($patient_area, "Area",$patientadressdata,"area",[ValidationTypes::REQUIRED], $postData,"patientAddressarray");
         $postData = dataFieldValidation($patient_landmark, "LandMark",$patientadressdata,"landmark","", $postData,"patientAddressarray");
         $postData = dataFieldValidation($patient_city, "City",$patientadressdata,"city_id",[ValidationTypes::REQUIRED], $postData,"patientAddressarray");
         $postData = dataFieldValidation($patient_state, "State",$patientadressdata,"state_id",[ValidationTypes::REQUIRED], $postData,"patientAddressarray");
         $postData = dataFieldValidation($patient_pincode, "Pincode",$patientadressdata,"pincode",[ValidationTypes::REQUIRED], $postData,"patientAddressarray");
     

		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
        
 
        $createdlog=isCreatedLog($userId);
		
		$patientdata=$postData['dbinput']['patientdataarray'];
		$group = array($patient_role); 
		$userid=$this->ion_auth->register($patient_id,$patient_password,$patient_email,$patientdata,$group);
       
        $patientAddressarray=array_merge($postData['dbinput']['patientAddressarray'],$createdlog);
        $addressid = $this->Address_model->addAddress($patientAddressarray);
        

        $userdetailsarray = array_merge( array('address_id'=>$addressid,'user_id'=>$userid),$postData['dbinput']['patientdataarray'],$createdlog);
	    $userdata_save = $this->Userdetails_model->addUserDetails($userdetailsarray);
		
        $userroledataarray = array('user_id'=>$userid,'account_id'=>$account_id,'role_id'=>$patient_role);
	    $userroledata_save = $this->Useraccounts_model->addAccountRole($userroledataarray);
   

	    $patientdetailsarray = array_merge( array('user_id'=>$userid),$postData['dbinput']['patientdetailsarray'],$createdlog);
	    $patientdata_save = $this->PatientDetails_model->addPatientDetails($patientdetailsarray);
		

		if(count($_FILES['add_patient_documents']['tmp_name'])>0){

          for ($i = 0; $i < count($_FILES['add_patient_documents']['tmp_name']); $i++) { 
           $sourcePath= isset($_FILES['add_patient_documents']['tmp_name'][$i])?$_FILES['add_patient_documents']['tmp_name'][$i]:'';
			 if(!empty($sourcePath))
			   {
				$target_dir = "assets/uploads/patientdocumnets/";
				$target_file = $target_dir .basename($_FILES["add_patient_documents"]["name"][$i]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "PDF" && $imageFileType != "DOC")
					{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				 } 
                
                $temp=rand(0,100000).'_'; 
				$targetPath = FCPATH.$target_dir.$temp.$_FILES['add_patient_documents']['name'][$i]; // Target path where file 
				if(move_uploaded_file($sourcePath,$targetPath)){
				$imagepath ="assets/uploads/patientdocumnets/";
				$image=$imagepath.$temp.$_FILES['add_patient_documents']['name'][$i];
				}else{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				}

			    }else{
				    $image=null;
				
			    }
			     if(isset($image) && !empty($image))
                  {
					     for ($i=0; $i <count($image) ; $i++) 
					    {
					       
					        $documentsArray=array('patient_id'=>$userid,'document_path'=>$image,'document_type'=>$imageFileType);

			               $result=$this->PatientDocuments_model->addPatientDocuments($documentsArray);

					    }

                 }

             } // for loop

           }
           
            if($patientdata_save&&$userdata_save&&$addressid&&$userid){


 
		        $subject='NewRegistration';
				$url = getHostURL(true);
				$name=$patient_fname.' '.$patient_lname;
				$mobileno=$patient_mobileno;
				$to_email=$patient_email;
				$userid=$patient_id;
				$password=$patient_password;
		        $hiuser = ucfirst($name);
				$body=Customdata_model::where('content_type','=','NewRegistration')->first()->content;
				$body=str_replace("{Name}",$hiuser,$body);
				$body=str_replace("{User_Id}",$userid,$body);
				$body=str_replace("{Email_Id}",$to_email,$body);
				$body=str_replace("{Password}",$password,$body);
				$body=str_replace("{URL}",$url,$body);
		        sendEmail("bizbrainz2020@gmail.com","Administrator",$to_email,$subject,$body,null);



              $patient_mobile = $mobileno;
              $patient_massage = "Dear ".$name.", Your Registration with our Hospital is Completed. You can now avail our services online. 
              Login with Email/User_Id:  ".$userid."/".$to_email.", Password : ".$password."  
              url : ".$url."";
              sendSMS($patient_mobile, $patient_massage);









               	echo json_encode(array('success'=>true,'message'=>SAVE_MSG));
				return;
			}
			else
			{
				echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				return;
			}	




            }


   public function editPatientByid($id)
		{
			   
			   $editpatient=$this->PatientDetails_model->EditPatient($id);
			   echo json_encode(array('success'=>true,'data'=>$editpatient));
        }

     public function updatePatientDetails(){

            $id 					                   = $this->input->post("edit_patient_id");
            $address_id 					           = $this->input->post("edit_patient_addid");
            $userid 					               = $this->input->post("edit_patient_userid");

            $patient_fname       			           = $this->input->post("edit_patient_fname");
			$patient_lname       				       = $this->input->post("edit_patient_lname");
			$patient_mobileno       			       = $this->input->post("edit_patient_mobileno");
			$patient_age       				           = $this->input->post("edit_patient_age");
			$patient_gender       		               = $this->input->post("edit_patient_gender");
			
			$patient_height      			           = $this->input->post("edit_patient_height");
			$patient_weight       				       = $this->input->post("edit_patient_weight");
			$patient_bloodgroup       			       = $this->input->post("edit_patient_bloodgroup");
			$patient_bloodprusser       			   = $this->input->post("edit_patient_bloodprusser");
			$patient_pulse                             = $this->input->post("edit_patient_pulse");
			$patient_allergy      		        	   = $this->input->post("edit_patient_allergy");
			$patient_diet                              = $this->input->post("edit_patient_diet");

			$patient_hno       				           = $this->input->post("edit_patient_hno");
			$patient_street       			           = $this->input->post("edit_patient_street");
			$patient_area       			           = $this->input->post("edit_patient_area");
			$patient_landmark       			       = $this->input->post("edit_patient_landmark");
			$patient_city       				       = $this->input->post("edit_patient_city");
			$patient_state       			           = $this->input->post("edit_patient_state");
			$patient_pincode       			           = $this->input->post("edit_patient_pincode");

			if(isset($patient_pincode) && !empty($patient_pincode)){
					$patient_pincode=$patient_pincode;
				}else{
					$patient_pincode=0;
				}
			$oldimage =  Userdetails_model::where('user_id',$userid)->get(['profile_pic_path']);//fetching from database table
		 json_encode(array('data'=>$oldimage)); 
		 $oldimage1= $oldimage[0]['profile_pic_path'];

			 $sourcePath= isset($_FILES['edit_patient_photo']['tmp_name'])?$_FILES['edit_patient_photo']['tmp_name']:'';
               
			if(!empty($sourcePath))
			{
				
				$target_dir = "assets/uploads/patient_photos/";
				$target_file = $target_dir .basename($_FILES["edit_patient_photo"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG")
					{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				} 
                  $temp=rand(0,100000).'_'; 
				$targetPath = FCPATH.$target_dir.$temp.$_FILES['edit_patient_photo']['name']; // Target path where file is to be stored
				
				if(move_uploaded_file($sourcePath,$targetPath)){

				$imagepath ="assets/uploads/patient_photos/";
				$image=$imagepath.$temp.$_FILES['edit_patient_photo']['name'];
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
            $patientdata = [];
         
         $postData = dataFieldValidation($patient_fname, "First Name",$patientdetails,"first_name",[ValidationTypes::REQUIRED],$postData,"patientdataarray");
         $postData = dataFieldValidation($patient_lname, "Last Name",$patientdetails,"last_name",[ValidationTypes::REQUIRED], $postData,"patientdataarray");
         $postData = dataFieldValidation($patient_mobileno, "Mobile No",$patientdetails,"mobileno",[ValidationTypes::REQUIRED], $postData,"patientdataarray");
         $postData = dataFieldValidation($patient_age, "Age",$patientdetails,"age",[ValidationTypes::REQUIRED], $postData,"patientdataarray");
         $postData = dataFieldValidation($patient_gender, "Gender",$patientdetails,"gender","", $postData,"patientdataarray");
         $postData = dataFieldValidation($image, "Photo",$patientdetails,"profile_pic_path","", $postData,"patientdataarray");


	     

          $patientdetails=[];

         $postData = dataFieldValidation($patient_height, "Height",$patientdetails,"height",[ValidationTypes::REQUIRED],$postData,"patientdetailsarray");
         $postData = dataFieldValidation($patient_weight, "Weight",$patientdetails,"weight",[ValidationTypes::REQUIRED], $postData,"patientdetailsarray");
         $postData = dataFieldValidation($patient_bloodgroup, "Blood Group",$patientdetails,"blood_group",[ValidationTypes::REQUIRED], $postData,"patientdetailsarray");
         $postData = dataFieldValidation($patient_bloodprusser, "Blood Prusser",$patientdetails,"blood_prusser",[ValidationTypes::REQUIRED], $postData,"patientdetailsarray");
         $postData = dataFieldValidation($patient_pulse, "Pulse",$patientdetails,"pulse",[ValidationTypes::REQUIRED], $postData,"patientdetailsarray");
         $postData = dataFieldValidation($patient_allergy, "Allergy",$patientdetails,"allergy","", $postData,"patientdetailsarray");
         $postData = dataFieldValidation($patient_diet, "Diet",$patientdetails,"diet","", $postData,"patientdetailsarray");
         
            
           $patientadressdata = [];

        $postData = dataFieldValidation($patient_hno, "Bulidding Numnber",$patientadressdata,"house_no","", $postData,"patientAddressarray");
         $postData = dataFieldValidation($patient_street, "Street",$patientadressdata,"street",[ValidationTypes::REQUIRED], $postData,"patientAddressarray");
         $postData = dataFieldValidation($patient_area, "Area",$patientadressdata,"area",[ValidationTypes::REQUIRED], $postData,"patientAddressarray");
         $postData = dataFieldValidation($patient_landmark, "LandMark",$patientadressdata,"landmark","", $postData,"patientAddressarray");
         $postData = dataFieldValidation($patient_city, "City",$patientadressdata,"city_id",[ValidationTypes::REQUIRED], $postData,"patientAddressarray");
         $postData = dataFieldValidation($patient_state, "State",$patientadressdata,"state_id",[ValidationTypes::REQUIRED], $postData,"patientAddressarray");
         $postData = dataFieldValidation($patient_pincode, "Pincode",$patientadressdata,"pincode",[ValidationTypes::REQUIRED], $postData,"patientAddressarray");
     

		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
        
 
        $userId = $this->ion_auth->get_user_id();
         $updatedlog=isUpdateLog($userId);
		
		
        $patientAddressarray = array_merge($postData['dbinput']['patientAddressarray'],$updatedlog);
        $updateaddress = $this->Address_model->updateAddress($patientAddressarray,$address_id);

        $patientdataarray = array_merge($postData['dbinput']['patientdataarray'],$updatedlog);
		$updatedetails = $this->Userdetails_model->updateUserDetails($patientdataarray,$userid);

        $patientdetailsarray = array_merge($postData['dbinput']['patientdetailsarray'],$updatedlog);
		$updatepatientdetails = $this->PatientDetails_model->updatePatientDetails($patientdetailsarray,$userid);
		
          
            if($updatepatientdetails||$updateaddress||$updatedetails){
               	echo json_encode(array('success'=>true,'message'=>UPDATE_MSG));
				return;
				
              }else{

                  echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

				return;
			}	




            }


public function deletePatientById($id)
		{
	
	   if(isset($id)&&$id>0){
           
            $getid=Userdetails_model::where('user_id','=',$id)->get(['address_id']);
            $address_id= $getid[0]['address_id'];
             $deletedata=$this->PatientDetails_model->DeletePatientdetails($id);
	         $deleteAddress=$this->Address_model->deleteAddress($address_id);
	         $deleteuserdetails=$this->Userdetails_model->DeleteUserdetails($id);
	         $deleteuser=$this->User->deleteUserById($id);
                if($deletedata && $deleteAddress && $deleteuserdetails && $deleteuser) {
			                
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

  // View Patient Details // 

   public function ViewPatientByid($id)
		{
			   $patientdata=$this->PatientDetails_model->ViewPatientdata($id);
			   $patientdocuments=$this->PatientDocuments_model->ViewPatientDocumentsByPateintId($id);
			   echo json_encode(array('success'=>true,'data'=>$patientdata,'patientdocuments'=>$patientdocuments));
        }

 // View Patient Details //      

}
?>