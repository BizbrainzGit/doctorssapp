<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/CommonBaseController.php');
use Illuminate\Database\Query\Expression as raw;
use \Illuminate\Database\Capsule\Manager as Capsule;
class ProfileController extends CommonBaseController{

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
	}
       

        public function AdminProfileView()
		{         
            $this->load->view('admin/profileview');
        }

       public function SuperAdminProfileView() {         
            $this->load->view('superadmin/profileview');
        }
         public function MDProfileView() {         
            $this->load->view('md/profileview');
        }
     
    public function editProfileByid()
		{
	       $id = $this->ion_auth->get_user_id();
		   $editProfile=$this->Userdetails_model->EditProfile($id);
		   echo json_encode(array('success'=>true,'data'=>$editProfile));
      }

 public function updateProfileDetails(){

            $id 					                   = $this->input->post("edit_profile_id");
            $address_id 					           = $this->input->post("edit_profile_addid");
            $userid 					               = $this->input->post("edit_profile_userid");

            $profile_fname       			           = $this->input->post("edit_profile_fname");
			$profile_lname       				       = $this->input->post("edit_profile_lname");
			$profile_mobileno       			       = $this->input->post("edit_profile_mobileno");
			
			$profile_hno       				           = $this->input->post("edit_profile_hno");
			$profile_street       			           = $this->input->post("edit_profile_street");
			$profile_area       			           = $this->input->post("edit_profile_area");
			$profile_landmark       			       = $this->input->post("edit_profile_landmark");
			$profile_city       				       = $this->input->post("edit_profile_city");
			$profile_state       			           = $this->input->post("edit_profile_state");
			$profile_pincode       			           = $this->input->post("edit_profile_pincode");

			if(isset($profile_pincode) && !empty($profile_pincode)){
					$profile_pincode=$profile_pincode;
				}else{
					$profile_pincode=0;
				}

		 $oldimage =  Userdetails_model::where('id',$id)->get(['profile_pic_path']);//fetching from database table
		 json_encode(array('data'=>$oldimage)); 
		 $oldimage1= $oldimage[0]['profile_pic_path'];

		$sourcePath= isset($_FILES['edit_profile_photo']['tmp_name'])?$_FILES['edit_profile_photo']['tmp_name']:'';
			if(!empty($sourcePath))
			{
				
				$target_dir = "assets/uploads/employees/";
				$target_file = $target_dir .basename($_FILES["edit_profile_photo"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG")
					{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				} 
                  $temp=rand(0,100000).'_'; 
				$targetPath = FCPATH.$target_dir.$temp.$_FILES['edit_profile_photo']['name']; // Target path where file is to be stored
				
				if(move_uploaded_file($sourcePath,$targetPath)){

				$imagepath ="assets/uploads/employees/";
				$image=$imagepath.$temp.$_FILES['edit_profile_photo']['name'];
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
           
            $profiledata = [];
         
         
         $postData = dataFieldValidation($profile_fname, "First Name",$profiledetails,"first_name","",$postData,"profiledataarray");
         $postData = dataFieldValidation($profile_lname, "Last Name",$profiledetails,"last_name","", $postData,"profiledataarray");
         $postData = dataFieldValidation($profile_mobileno, "Mobile No",$profiledetails,"mobileno","", $postData,"profiledataarray");
         $postData = dataFieldValidation($image, "Photo",$profiledetails,"profile_pic_path","", $postData,"profiledataarray");

        $profileadressdata = [];
        $postData = dataFieldValidation($profile_hno, "Bulidding Numnber",$profileadressdata,"house_no","", $postData,"profileAddressarray");
         $postData = dataFieldValidation($profile_street, "Street",$profileadressdata,"street","", $postData,"profileAddressarray");
         $postData = dataFieldValidation($profile_area, "Area",$profileadressdata,"area","", $postData,"profileAddressarray");
         $postData = dataFieldValidation($profile_landmark, "LandMark",$profileadressdata,"landmark","", $postData,"profileAddressarray");
         $postData = dataFieldValidation($profile_city, "City",$profileadressdata,"city_id","", $postData,"profileAddressarray");
         $postData = dataFieldValidation($profile_state, "State",$profileadressdata,"state_id","", $postData,"profileAddressarray");
         $postData = dataFieldValidation($profile_pincode, "Pincode",$profileadressdata,"pincode","", $postData,"profileAddressarray");
     

		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
        
 
         $userId = $this->ion_auth->get_user_id();
         $updatedlog=isUpdateLog($userId);
		
		
        $profileAddressarray = array_merge($postData['dbinput']['profileAddressarray'],$updatedlog);
        $updateaddress = $this->Address_model->updateAddress($profileAddressarray,$address_id);

        $profiledataarray = array_merge($postData['dbinput']['profiledataarray'],$updatedlog);
		$updatedetails = $this->Userdetails_model->updateUserDetails($profiledataarray,$userid);

            if($updateaddress||$updatedetails){
               	echo json_encode(array('success'=>true,'message'=>UPDATE_MSG));
				return;
				
              }else{

                  echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

				return;
			}	




            }

}

?>