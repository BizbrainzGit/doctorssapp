<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH.'controllers/doctor/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use \Illuminate\Database\Capsule\Manager as Capsule;
class DoctorProfileController extends BaseController{

	public function __construct(){
		parent::__construct("Normal");
		$this->load->helper(array('form', 'url','captcha','html','language'));
		$this->load->library(array('session', 'form_validation', 'email','ion_auth'));
        $this->load->database();
        $this->load->model('User');
	    $this->load->model('Userdetails_model');
	    $this->load->model('Address_model');
	    $this->load->model('customerdb/DoctorDetails_model');
	    $this->load->model('Specialization_model');
	    $this->load->model('Cities_model');
        $this->load->model('States_model');
	}
       

        public function DoctorProfileView()
		{         
            $this->load->view('doctor/doctorprofileview');
        }
     
        public function editDoctorProfileByid()
		{  
		   $masterdb = $this->db->database;
	       $id = $this->ion_auth->get_user_id();
		   $editdoctor=$this->DoctorDetails_model->EditDoctor($id,$masterdb);
	      echo json_encode(array('success'=>true,'data'=>$editdoctor));
        }

        public function updateDoctorProfileDetails(){

            $id 					                   = $this->input->post("doctor_profile_id");
            $address_id 					           = $this->input->post("doctor_profile_addid");
            $userid 					               = $this->input->post("doctor_profile_userid");

            $doctorprofile_fname       			       = $this->input->post("doctor_profile_fname");
			$doctorprofile_lname       				   = $this->input->post("doctor_profile_lname");
			$doctorprofile_mobileno       			   = $this->input->post("doctor_profile_mobileno");
			$doctorprofile_age       				   = $this->input->post("doctor_profile_age");
			$doctorprofile_gender       		       = $this->input->post("doctor_profile_gender");
									
			$doctorprofile_designation      		   = $this->input->post("doctor_profile_designation");
			$doctorprofile_specialist       		   = $this->input->post("doctor_profile_specialist");
			$doctorprofile_department       	       = $this->input->post("doctor_profile_specialization");
			$doctorprofile_bloodgroup       	       = $this->input->post("doctor_profile_bloodgroup");
			$doctorprofile_education       			   = $this->input->post("doctor_profile_education");
			$doctorprofile_biography                   = $this->input->post("doctor_profile_biography");

			$doctorprofile_hno       				   = $this->input->post("doctor_profile_hno");
			$doctorprofile_street       			   = $this->input->post("doctor_profile_street");
			$doctorprofile_area       			       = $this->input->post("doctor_profile_area");
			$doctorprofile_landmark       			   = $this->input->post("doctor_profile_landmark");
			$doctorprofile_city       				   = $this->input->post("doctor_profile_city");
			$doctorprofile_state       			       = $this->input->post("doctor_profile_state");
			$doctorprofile_pincode       			   = $this->input->post("doctor_profile_pincode");

			if(isset($doctorprofile_pincode) && !empty($doctorprofile_pincode)){
					$doctorprofile_pincode=$doctorprofile_pincode;
				}else{
					$doctorprofile_pincode=0;
				}

          $oldimage =  Userdetails_model::where('id',$id)->get(['profile_pic_path']);//fetching from database table
		 json_encode(array('data'=>$oldimage)); 
		 $oldimage1= $oldimage[0]['profile_pic_path'];

			 $sourcePath= isset($_FILES['doctor_profile_photo']['tmp_name'])?$_FILES['doctor_profile_photo']['tmp_name']:'';
               
			if(!empty($sourcePath))
			{
				
				$target_dir = "assets/uploads/employees/";
				$target_file = $target_dir .basename($_FILES["doctor_profile_photo"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                 
   
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG")
					{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				} 
                  $temp=rand(0,100000).'_'; 
				$targetPath = FCPATH.$target_dir.$temp.$_FILES['doctor_profile_photo']['name']; // Target path where file is to be stored
				
				if(move_uploaded_file($sourcePath,$targetPath)){

				$imagepath ="assets/uploads/employees/";
				$image=$imagepath.$temp.$_FILES['doctor_profile_photo']['name'];
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
           
            $doctordata = [];
         
         
          $postData = dataFieldValidation($doctorprofile_fname, "First Name",$doctordetails,"first_name","",$postData,"doctordataarray");
         $postData = dataFieldValidation($doctorprofile_lname, "Last Name",$doctordetails,"last_name","", $postData,"doctordataarray");
         $postData = dataFieldValidation($doctorprofile_mobileno, "Mobile No",$doctordetails,"mobileno","", $postData,"doctordataarray");
         $postData = dataFieldValidation($doctorprofile_age, "Age",$doctordetails,"age","", $postData,"doctordataarray");
         $postData = dataFieldValidation($doctorprofile_gender, "Gender",$doctordetails,"gender","", $postData,"doctordataarray");
	     $postData = dataFieldValidation($image, "Photo",$doctordetails,"profile_pic_path","", $postData,"doctordataarray");

          $doctordetails=[];

         
         
         $postData = dataFieldValidation($doctorprofile_designation, "Designation",$doctordetails,"designation","",$postData,"doctordetailsarray");
         $postData = dataFieldValidation($doctorprofile_specialist, "Specialist",$doctordetails,"specialist","", $postData,"doctordetailsarray");
         $postData = dataFieldValidation($doctorprofile_department, "Specialization",$doctordetails,"specialization_id","", $postData,"doctordetailsarray");
         $postData = dataFieldValidation($doctorprofile_bloodgroup, "Blood Group",$doctordetails,"blood_group","", $postData,"doctordetailsarray");
         $postData = dataFieldValidation($doctorprofile_education, "Education",$doctordetails,"education","", $postData,"doctordetailsarray");
         $postData = dataFieldValidation($doctorprofile_biography, "Biography",$doctordetails,"biography","", $postData,"doctordetailsarray");
         
            
           $doctoradressdata = [];

        $postData = dataFieldValidation($doctorprofile_hno, "Bulidding Numnber",$doctoradressdata,"house_no","", $postData,"doctorAddressarray");
         $postData = dataFieldValidation($doctorprofile_street, "Street",$doctoradressdata,"street","", $postData,"doctorAddressarray");
         $postData = dataFieldValidation($doctorprofile_area, "Area",$doctoradressdata,"area","", $postData,"doctorAddressarray");
         $postData = dataFieldValidation($doctorprofile_landmark, "LandMark",$doctoradressdata,"landmark","", $postData,"doctorAddressarray");
         $postData = dataFieldValidation($doctorprofile_city, "City",$doctoradressdata,"city_id","", $postData,"doctorAddressarray");
         $postData = dataFieldValidation($doctorprofile_state, "State",$doctoradressdata,"state_id","", $postData,"doctorAddressarray");
         $postData = dataFieldValidation($doctorprofile_pincode, "Pincode",$doctoradressdata,"pincode","", $postData,"doctorAddressarray");
     

		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
        
 
        $userId = $this->ion_auth->get_user_id();
         $updatedlog=isUpdateLog($userId);
		
		
        $doctorAddressarray=array_merge($postData['dbinput']['doctorAddressarray'],$updatedlog);
        $updateaddress = $this->Address_model->updateAddress($doctorAddressarray,$address_id);

	    $doctordataarray = array_merge($postData['dbinput']['doctordataarray'],$updatedlog);
		$updatedetails = $this->Userdetails_model->updateUserDetails($doctordataarray,$userid);

        $doctordetailsarray = array_merge($postData['dbinput']['doctordetailsarray'],$updatedlog);
		$updatedoctordetails = $this->DoctorDetails_model->updateDoctorDetails($doctordetailsarray,$userid);
		
          
            if($updatedoctordetails||$updateaddress||$updatedetails){
               	echo json_encode(array('success'=>true,'message'=>UPDATE_MSG));
				return;
				
              }else{

                  echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

				return;
			}	




            }



}

?>