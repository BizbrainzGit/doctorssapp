<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH.'controllers/receptionist/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use \Illuminate\Database\Capsule\Manager as Capsule;
class ReceptionistProfileController extends BaseController{

	public function __construct(){
		parent::__construct("Normal");
		$this->load->helper(array('form', 'url','captcha','html','language'));
		$this->load->library(array('session', 'form_validation', 'email','ion_auth'));
        $this->load->database();
	    $this->load->model('User');
	    $this->load->model('Userdetails_model');
	    $this->load->model('Address_model');
	    $this->load->model('Cities_model');
        $this->load->model('States_model');
        $this->load->model('Useraccounts_model');
	}


    public function ReceptionistProfileView()
		{         
            $this->load->view('receptionist/receptionistprofileview');
        }
     
    public function editReceptionistProfileByid()
		{  
		   
	       $id = $this->ion_auth->get_user_id();
		   $editDoctorProfile=$this->Userdetails_model->EditProfile($id);
	      echo json_encode(array('success'=>true,'data'=>$editDoctorProfile));
        }

        

    public function updateReceptionistProfileDetails(){

          $id 					               = $this->input->post("receptionist_profile_id");
          $address_id 					       = $this->input->post("receptionist_profile_addid");
          $user_id 				     	       = $this->input->post("receptionist_profile_userid");

          $receptionist_profile_fname          = $this->input->post("receptionist_profile_fname");
          $receptionist_profile_lname          = $this->input->post("receptionist_profile_lname");
          $receptionist_profile_mobileno       = $this->input->post("receptionist_profile_mobileno");
          $receptionist_profile_age       	   = $this->input->post("receptionist_profile_age");
		  $receptionist_profile_gender         = $this->input->post("receptionist_profile_gender");
		  
          $receptionist_profile_hno            = $this->input->post("receptionist_profile_hno");
          $receptionist_profile_street         = $this->input->post("receptionist_profile_street");
          $receptionist_profile_area           = $this->input->post("receptionist_profile_area");
          $receptionist_profile_landmark       = $this->input->post("receptionist_profile_landmark");
          $receptionist_profile_city           = $this->input->post("receptionist_profile_city");
          $receptionist_profile_state          = $this->input->post("receptionist_profile_state");
          $receptionist_profile_pincode        = $this->input->post("receptionist_profile_pincode");


          if(isset($receptionist_profile_pincode) && !empty($receptionist_profile_pincode)){
		     $receptionist_profile_pincode=$receptionist_profile_pincode;
	            }else{
		     $receptionist_profile_pincode=0;
	          }
          
          

          $oldimage =  Userdetails_model::where('id',$id)->get(['profile_pic_path']);//fetching from database table
		 json_encode(array('data'=>$oldimage)); 
		 $oldimage1= $oldimage[0]['profile_pic_path'];

			 $sourcePath= isset($_FILES['receptionist_profile_photo']['tmp_name'])?$_FILES['receptionist_profile_photo']['tmp_name']:'';
               
			if(!empty($sourcePath))
			{
				
				$target_dir = "assets/uploads/employees/";
				$target_file = $target_dir .basename($_FILES["receptionist_profile_photo"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG")
					{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				} 
                  $temp=rand(0,100000).'_'; 
				$targetPath = FCPATH.$target_dir.$temp.$_FILES['receptionist_profile_photo']['name']; // Target path where file is to be stored
				
				if(move_uploaded_file($sourcePath,$targetPath)){

				$imagepath ="assets/uploads/employees/";
				$image=$imagepath.$temp.$_FILES['receptionist_profile_photo']['name'];
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
           // $postData= dataFieldValidation($receptionist_profile_role, "Role ID",$employeesdata,"role_id","",$postData,"employeesdataarray");
          

          $employeesdetails=[];

         $postData = dataFieldValidation($image, "Photo",$employeesdetails,"profile_pic_path","", $postData,"employeesdetailsarray");
         $postData = dataFieldValidation($receptionist_profile_fname, "First Name",$employeesdetails,"first_name","",$postData,"employeesdetailsarray");
         $postData = dataFieldValidation($receptionist_profile_lname, "Last Name",$employeesdetails,"last_name","", $postData,"employeesdetailsarray");
         $postData = dataFieldValidation($receptionist_profile_mobileno, "Mobile No",$employeesdetails,"mobileno","", $postData,"employeesdetailsarray");
         $postData = dataFieldValidation($receptionist_profile_age, "Age",$employeesdetails,"age","", $postData,"employeesdetailsarray");

         $postData = dataFieldValidation($receptionist_profile_gender, "Gender",$employeesdetails,"gender","", $postData,"employeesdetailsarray");
         $postData = dataFieldValidation($receptionist_profile_dob, "Date Of Birth",$employeesdetails,"dob","", $postData,"employeesdetailsarray");
         
          
	                
           $employeesadressdata = [];

        $postData = dataFieldValidation($receptionist_profile_hno, "Bulidding Numnber",$employeesadressdata,"house_no","", $postData,"employeesAddressarray");
         $postData = dataFieldValidation($receptionist_profile_street, "Street",$employeesadressdata,"street","", $postData,"employeesAddressarray");
        
       
         $postData = dataFieldValidation($receptionist_profile_area, "Area",$employeesadressdata,"area","", $postData,"employeesAddressarray");
         $postData = dataFieldValidation($receptionist_profile_landmark, "LandMark",$employeesadressdata,"landmark","", $postData,"employeesAddressarray");

         $postData = dataFieldValidation($receptionist_profile_city, "City",$employeesadressdata,"city_id","", $postData,"employeesAddressarray");
         $postData = dataFieldValidation($receptionist_profile_state, "State",$employeesadressdata,"state_id","", $postData,"employeesAddressarray");
         $postData = dataFieldValidation($receptionist_profile_pincode, "Pincode",$employeesadressdata,"pincode","", $postData,"employeesAddressarray");
     
		
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
		 $userId = $this->ion_auth->get_user_id();
         $updatedlog=isUpdateLog($userId);

        // $updateuser = $this->Useraccounts_model->updateAccountRole($postData['dbinput']['employeesdataarray'],$user_id);

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


}

?>