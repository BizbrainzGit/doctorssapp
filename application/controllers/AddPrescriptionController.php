<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/CommonBaseController.php');
error_reporting(0);
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;

class AddPrescriptionController extends CommonBaseController {
	
		public function __construct(){
		 parent::__construct();
		 $this->load->library(array('form_validation','ValidationTypes','excel','session','ion_auth'));
		 $this->load->helper(array('url','html','form','util_helper','language'));
		 $this->load->database();
		 $this->load->model('User');
		 $this->load->model('Userdetails_model');
		 $this->load->model('customerdb/Prescription_model');
		 $this->load->model('customerdb/PrescriptionTests_model');
		 $this->load->model('customerdb/PrescriptionMedicine_model');
		 $this->load->model('customerdb/Appointmentbooking_model');
		}	
 


  public function AddPrescriptionForReceptionist()
		{
          $this->load->view('receptionist/addprescriptionview');
       } 
  

 public function SearchAppointmentbookingList()
		{
            
            $masterdb = $this->db->database;
            $userrole=$this->session->userdata('user_roles');

            if($userrole=="Doctor"){
              $doctors_id=$this->ion_auth->get_user_id();

              }
              if($userrole=="Patient"){
               $patients_id=$this->ion_auth->get_user_id();
              }
             $searchdata=$this->Appointmentbooking_model->SearchAppointmentsForAddPrescription($doctors_id,$patients_id,$masterdb);
           	 echo json_encode(array('success'=>true,'data'=>$searchdata,'role'=>$userrole));
				return;
	   
		}




   public function AppointmentDataForPrescription($id)
      {
          $masterdb = $this->db->database;
          $PrescriptionDataAdd=$this->Appointmentbooking_model->AddPrescriptionData($id,$masterdb);
          if (count($PrescriptionDataAdd)>0) {
            echo json_encode(array('success'=>true,'data'=>$PrescriptionDataAdd));
            return;
          } else {
             echo json_encode(array('success'=>false,'message'=>"This Patient is not Consult to Doctor"));
                  return;
          }
      }
    


public function savePrescriptionData(){
            
        $prescription_appointmentid                     = $this->input->post("add_prescription_appointment_id");

        $prescription_patient       			        = $this->input->post("add_prescription_patient_id");
        $prescription_bloodpressure       			    = $this->input->post("add_prescription_bloodpressure");
        $prescription_pulserate       			        = $this->input->post("add_prescription_pulserate");
       
        $prescription_medicine                          = $this->input->post("group-a");
       	$prescription_test       				        = $this->input->post("add_prescription_test");
       	$prescription_note       				        = $this->input->post("add_prescription_note");
       	$prescription_symptoms       				    = $this->input->post("add_prescription_symptoms");
       	$prescription_diagnosis       				    = $this->input->post("add_prescription_diagnosis");
       	
        $prescription_doctorid       			        = $this->input->post("add_prescription_doctor_id");
             
		    $sourcePath1= isset($_FILES['add_prescription_photo']['tmp_name'])?$_FILES['add_prescription_photo']['tmp_name']:'';
                
			if(!empty($sourcePath1))
			{
				
				$target_dir = "assets/uploads/prescription/";
				$target_file = $target_dir .basename($_FILES["add_prescription_photo"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			 
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF")
					{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				} 
                  $temp=rand(0,100000).'_'; 
				$targetPath = FCPATH.$target_dir.$temp.$_FILES['add_prescription_photo']['name']; // Target path where file is to be stored
				
				if(move_uploaded_file($sourcePath1,$targetPath)){

				$imagepath ="assets/uploads/prescription/";
				$image=$imagepath.$temp.$_FILES['add_prescription_photo']['name'];
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


          $postData=array();

          $prescriptiondetails=[];
          
          $postData = dataFieldValidation($prescription_appointmentid, "Prescription Appointment Id",$prescriptiondetails,"appointment_id","",$postData,"prescriptiondetailsarray");
          $postData = dataFieldValidation($prescription_patient, "Prescription Patient",$prescriptiondetails,"patient_user_id","",$postData,"prescriptiondetailsarray");
          $postData = dataFieldValidation($prescription_doctorid, "Prescription Doctor",$prescriptiondetails,"doctor_user_id","",$postData,"prescriptiondetailsarray");
          $postData = dataFieldValidation($prescription_bloodpressure, "Blood Pressure",$prescriptiondetails,"blood_pressure","", $postData,"prescriptiondetailsarray");
          $postData = dataFieldValidation($prescription_pulserate, "Pulse Rate",$prescriptiondetails,"pulse_rate","", $postData,"prescriptiondetailsarray");
          $postData = dataFieldValidation($prescription_note, "Prescription Note",$prescriptiondetails,"note","", $postData,"prescriptiondetailsarray");
          $postData = dataFieldValidation($prescription_symptoms, "Prescription Symptoms",$prescriptiondetails,"symptoms","", $postData,"prescriptiondetailsarray");
          $postData = dataFieldValidation($prescription_diagnosis, "Prescription Diagnosis",$prescriptiondetails,"diagnosis","", $postData,"prescriptiondetailsarray");
          $postData = dataFieldValidation($image, "Prescription Photo",$prescriptiondetails,"prescription_photo","", $postData,"prescriptiondetailsarray");
        
         
          if(isset($prescription_test) && !empty($prescription_test))
	        {
	              $test=[];
			      foreach($prescription_test as $key=>$udata)
			    {
			      $test_id  = $udata;
			      $postData = dataFieldValidation($test_id, "Test", $test,"test_id", "", $postData, "testarray".$key);
			        }
	        }

	         if(isset($prescription_medicine) && !empty($prescription_medicine))
	        {
	              $medicine=[];
			      for ($i=0; $i <count($prescription_medicine) ; $i++) 
			        {
                   
		           $postData = dataFieldValidation($prescription_medicine[$i]['add_prescription_medicine'], "Medicine Name", $medicine,"medicine_name", "", $postData, "medicinearray".$i);
		            $postData = dataFieldValidation($prescription_medicine[$i]['add_prescription_medicinenote'], "Medicine Name", $medicine,"medicine_note", "", $postData, "medicinearray".$i);
			       
			        }
	        }
	
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
		
          $userId = $this->ion_auth->get_user_id();
          $createdlog=isCreatedLog($userId);
   
		        $prescriptionarray = array_merge($postData['dbinput']['prescriptiondetailsarray'],$createdlog);
	   
	            $prescription_save = $this->Prescription_model->addPrescription($prescriptionarray);
		
			    
			     if(isset($prescription_test) && !empty($prescription_test))
                  {
					    foreach($prescription_test as $key=>$udata)
					    {
					        $test_id  = $udata;
					        $testarray=array('prescription_id'=>$prescription_save,'test_id'=>$test_id);
					        $Packages=$this->PrescriptionTests_model->addPrescriptionTest($testarray);
					    }

                 }

                 if(isset($prescription_medicine) && !empty($prescription_medicine))
                  {
					     for ($i=0; $i <count($prescription_medicine) ; $i++) 
					    {
					       
					        $medicinearray=array('prescription_id'=>$prescription_save,'medicine_name'=>$prescription_medicine[$i]['add_prescription_medicine'],'medicine_note'=>$prescription_medicine[$i]['add_prescription_medicinenote']);
					        $medicine=$this->PrescriptionMedicine_model->addPrescriptionMedicine($medicinearray);
					    }

                 }

                   if($prescription_save){

		            $change_status  = 7;
		            $postData=array();
				    $changestatus = [];
				    $postData = dataFieldValidation($change_status, "Status",$changestatus,"status_id","",$postData,"statusarray");

		             $updateStatus = $this->Appointmentbooking_model->updateStatus($postData['dbinput']['statusarray'],$prescription_appointmentid);

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