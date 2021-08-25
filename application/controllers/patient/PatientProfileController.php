<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH.'controllers/patient/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use \Illuminate\Database\Capsule\Manager as Capsule;
class PatientProfileController extends BaseController{

	public function __construct(){
		parent::__construct("Normal");
		$this->load->helper(array('form', 'url','captcha','html','language'));
		$this->load->library(array('session', 'form_validation', 'email','ion_auth'));
        $this->load->database();
		$this->load->model('User');
	    $this->load->model('Userdetails_model');
	    $this->load->model('Address_model');
	    $this->load->model('PatientDetails_model');
	    $this->load->model('Cities_model');
        $this->load->model('States_model');
       
	}
       

    public function PatientProfileView()
		{         
            $this->load->view('patient/patientprofileview');
        }
     
  
    public function editPatientProfileByid()
		{
		   $masterdb = $this->db->database;
		   $id = $this->ion_auth->get_user_id();
		   $editpatient=$this->PatientDetails_model->EditPatient($id,$masterdb);
		   echo json_encode(array('success'=>true,'data'=>$editpatient));
       }

    public function updatePatientProfileDetails(){

            $id 					                   = $this->input->post("patient_profile_id");
            $address_id 					           = $this->input->post("patient_profile_addid");
            $userid 					               = $this->input->post("patient_profile_userid");

            $patient_profile_fname       			   = $this->input->post("patient_profile_fname");
			$patient_profile_lname       			   = $this->input->post("patient_profile_lname");
			$patient_profile_mobileno       		   = $this->input->post("patient_profile_mobileno");
			$patient_profile_age       				   = $this->input->post("patient_profile_age");
			$patient_profile_gender       		       = $this->input->post("patient_profile_gender");
			
			$patient_profile_height      			   = $this->input->post("patient_profile_height");
			$patient_profile_weight       			   = $this->input->post("patient_profile_weight");
			$patient_profile_bloodgroup       	       = $this->input->post("patient_profile_bloodgroup");
			$patient_profile_bloodprusser       	   = $this->input->post("patient_profile_bloodprusser");
			$patient_profile_pulse                     = $this->input->post("patient_profile_pulse");
			$patient_profile_allergy      		  	   = $this->input->post("patient_profile_allergy");
			$patient_profile_diet                      = $this->input->post("patient_profile_diet");

			$patient_profile_hno       			       = $this->input->post("patient_profile_hno");
			$patient_profile_street       			   = $this->input->post("patient_profile_street");
			$patient_profile_area       			   = $this->input->post("patient_profile_area");
			$patient_profile_landmark       	       = $this->input->post("patient_profile_landmark");
			$patient_profile_city       		       = $this->input->post("patient_profile_city");
			$patient_profile_state       			   = $this->input->post("patient_profile_state");
			$patient_profile_pincode       			   = $this->input->post("patient_profile_pincode");

			if(isset($patient_profile_pincode) && !empty($patient_profile_pincode)){
					$patient_profile_pincode=$patient_profile_pincode;
				}else{
					$patient_profile_pincode=0;
				}


		$userId = $this->ion_auth->get_user_id();	
           $postData=array();
           
            $patientdata = [];
         
         
           $postData = dataFieldValidation($patient_profile_fname, "First Name",$patientdetails,"first_name","",$postData,"patientdataarray");
         $postData = dataFieldValidation($patient_profile_lname, "Last Name",$patientdetails,"last_name","", $postData,"patientdataarray");
         $postData = dataFieldValidation($patient_profile_mobileno, "Mobile No",$patientdetails,"mobileno","", $postData,"patientdataarray");
        $postData = dataFieldValidation($patient_profile_age, "Age",$patientdetails,"age","", $postData,"patientdataarray");
         $postData = dataFieldValidation($patient_profile_gender, "Gender",$patientdetails,"gender","", $postData,"patientdataarray");


	     

          $patientdetails=[];

         $postData = dataFieldValidation($patient_profile_height, "Height",$patientdetails,"height","",$postData,"patientdetailsarray");
         $postData = dataFieldValidation($patient_profile_weight, "Weight",$patientdetails,"weight","", $postData,"patientdetailsarray");
         $postData = dataFieldValidation($patient_profile_bloodgroup, "Blood Group",$patientdetails,"blood_group","", $postData,"patientdetailsarray");
         $postData = dataFieldValidation($patient_profile_bloodprusser, "Blood Prusser",$patientdetails,"blood_prusser","", $postData,"patientdetailsarray");
         $postData = dataFieldValidation($patient_profile_pulse, "Pulse",$patientdetails,"pulse","", $postData,"patientdetailsarray");
         $postData = dataFieldValidation($patient_profile_allergy, "Allergy",$patientdetails,"allergy","", $postData,"patientdetailsarray");
         $postData = dataFieldValidation($patient_profile_diet, "Diet",$patientdetails,"diet","", $postData,"patientdetailsarray");
         
            
           $patientadressdata = [];

        $postData = dataFieldValidation($patient_profile_hno, "Bulidding Numnber",$patientadressdata,"house_no","", $postData,"patientAddressarray");
         $postData = dataFieldValidation($patient_profile_street, "Street",$patientadressdata,"street","", $postData,"patientAddressarray");
         $postData = dataFieldValidation($patient_profile_area, "Area",$patientadressdata,"area","", $postData,"patientAddressarray");
         $postData = dataFieldValidation($patient_profile_landmark, "LandMark",$patientadressdata,"landmark","", $postData,"patientAddressarray");
         $postData = dataFieldValidation($patient_profile_city, "City",$patientadressdata,"city_id","", $postData,"patientAddressarray");
         $postData = dataFieldValidation($patient_profile_state, "State",$patientadressdata,"state_id","", $postData,"patientAddressarray");
         $postData = dataFieldValidation($patient_profile_pincode, "Pincode",$patientadressdata,"pincode","", $postData,"patientAddressarray");
     

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


}

?>