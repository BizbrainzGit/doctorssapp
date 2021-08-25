<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/admin/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;

class DoctorController extends BaseController {

		public function __construct(){
		
			parent::__construct();
			$this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
			$this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
			$this->load->database();
		    $this->load->model('User');
		    $this->load->model('Userdetails_model');
		    $this->load->model('Address_model');
		    $this->load->model('customerdb/DoctorDetails_model');
		    $this->load->model('Specialization_model');
		    $this->load->model('Cities_model');
            $this->load->model('States_model');
            $this->load->model('Useraccounts_model');
            $this->load->model('Customdata_model');
            $this->load->model('Customdata_model');
		
		}	
 

    public function DoctorView()
		{
          $this->load->view('admin/doctorview');
      }
  
    public function CountOfDoctors()
		{
             $masterdb = $this->db->database;
             $doctorscountincb=DoctorDetails_model::count('id');
             $account_id=$this->account_id;
             $exitingdoctors=Accounts_model::where('accounts.id','=',$account_id)->get(['no_of_doctors']);
              $exitingdoctorscount=$exitingdoctors[0]['no_of_doctors'];
             if ($doctorscountincb < $exitingdoctorscount) {
             	 	echo json_encode(array('success'=>true));
				    return;
              }else{
                   
                   echo json_encode(array('success'=>false,'message'=>"Your Limited Adding Doctors Complited Forther Information Contact To Super Admin"));
				   return;
              }
           
		}

    public function SearchDoctorList()
		{
            $masterdb = $this->db->database;
            $searchdata=$this->DoctorDetails_model->SearchDoctors($masterdb);
           	echo json_encode(array('success'=>true,'data'=>$searchdata));
				return;
	   
		}
    public function editDoctorStatusByid($id)
		{
	 		$result=User::where('id','=',$id)->get(['active','id']);
	        echo json_encode(array('success'=>true,'data'=>$result));
        }

    public function updateDoctorStatusByid(){

        $doctor_status_id       			                    = $this->input->post("doctor_status_id");
        $doctor_status_change       			                = $this->input->post("doctor_status_change"); 
			
        $postData=array();
		$changestatus = [];

	    $postData = dataFieldValidation($doctor_status_change, "Status",$changestatus,"active","",$postData,"statusarray");
	     if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		  }
		
        $updateStatus = $this->User->updateStatus($postData['dbinput']['statusarray'],$doctor_status_id);
            
             if($updateStatus){

				echo json_encode(array('success'=>true,'message'=>UPDATE_MSG,'data'=>$updateStatus));
				return;
				
              }else{

                  echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

				return;
	
                  }	
       }
  


    public function saveDoctorData(){
            
            $doctor_fname       			           = $this->input->post("add_doctor_fname");
			$doctor_lname       				       = $this->input->post("add_doctor_lname");
			$doctor_mobileno       			           = $this->input->post("add_doctor_mobileno");
			$doctor_gender       		               = $this->input->post("add_doctor_gender");
			$doctor_age       		                   = $this->input->post("add_doctor_age");
			$doctor_email       		               = $this->input->post("add_doctor_email");
			$doctor_password       		               = $this->input->post("add_doctor_password");
			$doctor_role       			               = 4;

			$doctor_idname="DD";
			$doctor_idrole = $doctor_role;
			$doctor_idnumnber = rand(0,100000); 
			$doctor_id = $doctor_idname.$doctor_idrole.$doctor_idnumnber;
			
			$doctor_designation      			       = $this->input->post("add_doctor_designation");
			$doctor_specialist       				   = $this->input->post("add_doctor_specialist");
			$doctor_department       			       = $this->input->post("add_doctor_department");
			$doctor_consultationfee       			   = $this->input->post("add_doctor_consultationfee");
			$doctor_bloodgroup       			       = $this->input->post("add_doctor_bloodgroup");
			$doctor_education       			       = $this->input->post("add_doctor_education");
			$doctor_biography                          = $this->input->post("add_doctor_biography");
			

			$doctor_hno       				           = $this->input->post("add_doctor_hno");
			$doctor_street       			           = $this->input->post("add_doctor_street");
			$doctor_area       			               = $this->input->post("add_doctor_area");
			$doctor_landmark       			           = $this->input->post("add_doctor_landmark");
			$doctor_city       				           = $this->input->post("add_doctor_city");
			$doctor_state       			           = $this->input->post("add_doctor_state");
			$doctor_pincode       			           = $this->input->post("add_doctor_pincode");

			if(isset($doctor_pincode) && !empty($doctor_pincode)){
					$doctor_pincode=$doctor_pincode;
				     }else{
					  $doctor_pincode=0;
				       }  

		    $result=uniqueMail($doctor_email);
			if($result>0)
			{
			   echo json_encode(array('success'=>false,'message'=>EMAIL_EXISTS_MSG));
			   return; 
			}

		    $id=null;
			$result= uniqueUserName($doctor_id,$id);
			if($result>0)
			{
			    echo json_encode(array('success'=>false,'message'=>EMPID_EXISTS_MSG));
			    return;
			}			

            $sourcePath1= isset($_FILES['add_doctor_photo']['tmp_name'])?$_FILES['add_doctor_photo']['tmp_name']:'';
                
			if(!empty($sourcePath1))
			{
				$target_dir = "assets/uploads/employees/";
				$target_file = $target_dir .basename($_FILES["add_doctor_photo"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			   
			
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF")
					{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				    } 
	                $temp=rand(0,100000).'_'; 
					$targetPath = FCPATH.$target_dir.$temp.$_FILES['add_doctor_photo']['name']; // Target path where file is to be stored
				
				if(move_uploaded_file($sourcePath1,$targetPath)){

					$imagepath ="assets/uploads/employees/";
					$image=$imagepath.$temp.$_FILES['add_doctor_photo']['name'];
					} else{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				    }
				
			}else{
					$imagepath =null;
					$image=null;
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
						return;
			    }

	    $userId = $this->ion_auth->get_user_id();	
        $account_id=$this->account_id;
           
        $postData=array();

        $doctordata = [];
           $postData = dataFieldValidation($doctor_password, "Password",$doctordata,"password","", $postData,"doctordataarray");
           $postData = dataFieldValidation($doctor_email, "Email",$doctordata,"email","",$postData,"doctordataarray");
           $postData = dataFieldValidation($doctor_id, "User ID",$doctordata,"username","",$postData,"doctordataarray");

           $postData = dataFieldValidation($doctor_fname, "First Name",$doctordetails,"first_name","",$postData,"doctordataarray");
           $postData = dataFieldValidation($doctor_lname, "Last Name",$doctordetails,"last_name","", $postData,"doctordataarray");
           $postData = dataFieldValidation($doctor_mobileno, "Mobile No",$doctordetails,"mobileno","", $postData,"doctordataarray");
           $postData = dataFieldValidation($doctor_gender, "Gender",$doctordetails,"gender","", $postData,"doctordataarray");
           $postData = dataFieldValidation($doctor_age, "Age",$doctordetails,"age","", $postData,"doctordataarray");
	       $postData = dataFieldValidation($image, "Photo",$doctordetails,"profile_pic_path","", $postData,"doctordataarray");

        $doctordetails=[];

           $postData = dataFieldValidation($doctor_designation, "Designation",$doctordetails,"designation","",$postData,"doctordetailsarray");
           $postData = dataFieldValidation($doctor_specialist, "Specialist",$doctordetails,"specialist","", $postData,"doctordetailsarray");
           $postData = dataFieldValidation($doctor_department, "Department",$doctordetails,"specialization_id","", $postData,"doctordetailsarray");
           $postData = dataFieldValidation($doctor_consultationfee, "Consultation Fee",$doctordetails,"consultation_fee","", $postData,"doctordetailsarray");
           $postData = dataFieldValidation($doctor_bloodgroup, "Blood Group",$doctordetails,"blood_group","", $postData,"doctordetailsarray");
           $postData = dataFieldValidation($doctor_education, "Education",$doctordetails,"education","", $postData,"doctordetailsarray");
           $postData = dataFieldValidation($doctor_biography, "Biography",$doctordetails,"biography","", $postData,"doctordetailsarray");
         
            
        $doctoradressdata = [];

           $postData = dataFieldValidation($doctor_hno, "Bulidding Numnber",$doctoradressdata,"house_no","", $postData,"doctorAddressarray");
           $postData = dataFieldValidation($doctor_street, "Street",$doctoradressdata,"street","", $postData,"doctorAddressarray");
           $postData = dataFieldValidation($doctor_area, "Area",$doctoradressdata,"area","", $postData,"doctorAddressarray");
           $postData = dataFieldValidation($doctor_landmark, "LandMark",$doctoradressdata,"landmark","", $postData,"doctorAddressarray");
           $postData = dataFieldValidation($doctor_city, "City",$doctoradressdata,"city_id","", $postData,"doctorAddressarray");
           $postData = dataFieldValidation($doctor_state, "State",$doctoradressdata,"state_id","", $postData,"doctorAddressarray");
           $postData = dataFieldValidation($doctor_pincode, "Pincode",$doctoradressdata,"pincode","", $postData,"doctorAddressarray");
     

		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		   }
        
           $createdlog=isCreatedLog($userId);

           $doctordata=$postData['dbinput']['doctordataarray'];
		   $group = array($doctor_role); 
		   $userid=$this->ion_auth->register($doctor_id,$doctor_password,$doctor_email,$doctordata,$group);
       
           $doctorAddressarray=array_merge($postData['dbinput']['doctorAddressarray'],$createdlog);
           $addressid = $this->Address_model->addAddress($doctorAddressarray);

           $userdetailsarray = array_merge( array('address_id'=>$addressid,'user_id'=>$userid),$postData['dbinput']['doctordataarray'],$createdlog);
	       $userdata_save = $this->Userdetails_model->addUserDetails($userdetailsarray);
        
           $userroledataarray = array('user_id'=>$userid,'account_id'=>$account_id,'role_id'=>$doctor_role);
	       $userroledata_save = $this->Useraccounts_model->addAccountRole($userroledataarray);
   
	       $doctordetailsarray = array_merge( array('user_id'=>$userid),$postData['dbinput']['doctordetailsarray'],$createdlog);
	       $doctordata_save = $this->DoctorDetails_model->addDoctorDetails($doctordetailsarray);
		
          
        if($doctordata_save&&$userdata_save&&$addressid&&$userid){

        	   
		        $subject='NewRegistration';
				$url = getHostURL(true);
				$name=$doctor_fname.' '.$doctor_lname;
				$mobileno=$doctor_mobileno;
				$to_email=$doctor_email;
				$userid=$doctor_id;
				$password=$doctor_password;
		        $hiuser = ucfirst($name);
				$body=Customdata_model::where('content_type','=','NewRegistration')->first()->content;
				$body=str_replace("{Name}",$hiuser,$body);
				$body=str_replace("{User_Id}",$userid,$body);
				$body=str_replace("{Email_Id}",$to_email,$body);
				$body=str_replace("{Password}",$password,$body);
				$body=str_replace("{URL}",$url,$body);
		        sendEmail("bizbrainz2020@gmail.com","Administrator",$to_email,$subject,$body,null);



              $doctor_mobile = $mobileno;
              $doctor_massage = "Dear ".$name.", Your Registration with our Hospital is Completed. You can now avail our services online. 
              Login with Email/User_Id:  ".$userid."/".$to_email.", Password : ".$password." 
              url : ".$url."";
              sendSMS($doctor_mobile, $doctor_massage);

           	echo json_encode(array('success'=>true,'message'=>SAVE_MSG));
			return;
		}else{
			echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
			return;
		  }
     }


    public function editDoctorByid($id){

	   $masterdb = $this->db->database;

	   $editdoctor=$this->DoctorDetails_model->EditDoctor($id,$masterdb);
	   echo json_encode(array('success'=>true,'data'=>$editdoctor));
    }

    public function updateDoctorDetails(){

        $id 					                   = $this->input->post("edit_doctor_id");
        $address_id 					           = $this->input->post("edit_doctor_addid");
        $userid 					               = $this->input->post("edit_doctor_userid");

        $doctor_fname       			           = $this->input->post("edit_doctor_fname");
		$doctor_lname       				       = $this->input->post("edit_doctor_lname");
		$doctor_mobileno       			           = $this->input->post("edit_doctor_mobileno");
		$doctor_gender       		               = $this->input->post("edit_doctor_gender");
		$doctor_age       		                   = $this->input->post("edit_doctor_age");
					
		$doctor_designation      			       = $this->input->post("edit_doctor_designation");
		$doctor_specialist       				   = $this->input->post("edit_doctor_specialist");
		$doctor_department       			       = $this->input->post("edit_doctor_department");
		$doctor_consultationfee       	           = $this->input->post("edit_doctor_consultationfee");
		$doctor_bloodgroup       			       = $this->input->post("edit_doctor_bloodgroup");
		$doctor_education       			       = $this->input->post("edit_doctor_education");
		$doctor_biography                          = $this->input->post("edit_doctor_biography");

		$doctor_hno       				           = $this->input->post("edit_doctor_hno");
		$doctor_street       			           = $this->input->post("edit_doctor_street");
		$doctor_area       			               = $this->input->post("edit_doctor_area");
		$doctor_landmark       			           = $this->input->post("edit_doctor_landmark");
		$doctor_city       				           = $this->input->post("edit_doctor_city");
		$doctor_state       			           = $this->input->post("edit_doctor_state");
		$doctor_pincode       			           = $this->input->post("edit_doctor_pincode");

		if(isset($doctor_pincode) && !empty($doctor_pincode)){
				$doctor_pincode=$doctor_pincode;
			}else{
				$doctor_pincode=0;
			}

        $oldimage =  Userdetails_model::where('id',$id)->get(['profile_pic_path']);//fetching from database table
		json_encode(array('data'=>$oldimage)); 
		$oldimage1= $oldimage[0]['profile_pic_path'];

	    $sourcePath= isset($_FILES['edit_doctor_photo']['tmp_name'])?$_FILES['edit_doctor_photo']['tmp_name']:'';
               
	    if(!empty($sourcePath)){
				
			$target_dir = "assets/uploads/employees/";
			$target_file = $target_dir .basename($_FILES["edit_doctor_photo"]["name"]);
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                 
   
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG")
		    {
				echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
				return;
			} 
            $temp=rand(0,100000).'_'; 
			$targetPath = FCPATH.$target_dir.$temp.$_FILES['edit_doctor_photo']['name']; // Target path where file is to be stored
			if(move_uploaded_file($sourcePath,$targetPath)){
			$imagepath ="assets/uploads/employees/";
			$image=$imagepath.$temp.$_FILES['edit_doctor_photo']['name'];
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
         
        	$postData = dataFieldValidation($doctor_fname, "First Name",$doctordetails,"first_name","",$postData,"doctordataarray");
            $postData = dataFieldValidation($doctor_lname, "Last Name",$doctordetails,"last_name","", $postData,"doctordataarray");
            $postData = dataFieldValidation($doctor_mobileno, "Mobile No",$doctordetails,"mobileno","", $postData,"doctordataarray");
            $postData = dataFieldValidation($doctor_gender, "Gender",$doctordetails,"gender","", $postData,"doctordataarray");
            $postData = dataFieldValidation($doctor_age, "Age",$doctordetails,"age","", $postData,"doctordataarray");
	        $postData = dataFieldValidation($image, "Photo",$doctordetails,"profile_pic_path","", $postData,"doctordataarray");

        $doctordetails=[];
         
        	$postData = dataFieldValidation($doctor_designation, "Designation",$doctordetails,"designation","",$postData,"doctordetailsarray");
            $postData = dataFieldValidation($doctor_specialist, "Specialist",$doctordetails,"specialist","", $postData,"doctordetailsarray");
            $postData = dataFieldValidation($doctor_department, "Department",$doctordetails,"specialization_id","", $postData,"doctordetailsarray");
            $postData = dataFieldValidation($doctor_consultationfee, "Consultation Fee",$doctordetails,"consultation_fee","", $postData,"doctordetailsarray");
            $postData = dataFieldValidation($doctor_bloodgroup, "Blood Group",$doctordetails,"blood_group","", $postData,"doctordetailsarray");
            $postData = dataFieldValidation($doctor_education, "Education",$doctordetails,"education","", $postData,"doctordetailsarray");
            $postData = dataFieldValidation($doctor_biography, "Biography",$doctordetails,"biography","", $postData,"doctordetailsarray");
            
        $doctoradressdata = [];

        	$postData = dataFieldValidation($doctor_hno, "Bulidding Numnber",$doctoradressdata,"house_no","", $postData,"doctorAddressarray");
            $postData = dataFieldValidation($doctor_street, "Street",$doctoradressdata,"street","", $postData,"doctorAddressarray");
            $postData = dataFieldValidation($doctor_area, "Area",$doctoradressdata,"area","", $postData,"doctorAddressarray");
            $postData = dataFieldValidation($doctor_landmark, "LandMark",$doctoradressdata,"landmark","", $postData,"doctorAddressarray");
            $postData = dataFieldValidation($doctor_city, "City",$doctoradressdata,"city_id","", $postData,"doctorAddressarray");
            $postData = dataFieldValidation($doctor_state, "State",$doctoradressdata,"state_id","", $postData,"doctorAddressarray");
            $postData = dataFieldValidation($doctor_pincode, "Pincode",$doctoradressdata,"pincode","", $postData,"doctorAddressarray");
     

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


    public function deleteDoctorById($id){
	      
	    if(isset($id)&&$id>0){
           
            $getid=Userdetails_model::where('user_id','=',$id)->get(['address_id']);
            $address_id= $getid[0]['address_id'];
            $deletedata=$this->DoctorDetails_model->DeleteDoctordetails($id);
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

}

?>