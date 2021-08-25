<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/CommonBaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;

class PrescriptionController extends CommonBaseController {
	
		public function __construct(){
		 parent::__construct();
		 $this->load->library(array('form_validation','ValidationTypes','excel','session','ion_auth'));
		 $this->load->helper(array('url','html','form','util_helper','language'));
		 $this->load->database();
		 $this->load->model('User');
		 $this->load->model('Userdetails_model');
		 $this->load->model('Accounts_model');
		 $this->load->model('customerdb/Prescription_model');
		 $this->load->model('customerdb/PrescriptionTests_model');
		 $this->load->model('customerdb/PrescriptionMedicine_model');
		 $this->load->model('customerdb/Appointmentbooking_model');
		}	
 
public function PrescriptionViewForSuperAdmin()
		{
          $this->load->view('superadmin/prescriptionview');
       }

 public function PrescriptionViewForAdmin()
		{
          $this->load->view('admin/prescriptionview');
       }

  public function PrescriptionViewForPatient()
		{
          $this->load->view('patient/prescriptionview');
       }

  public function ManagePrescriptionViewForReceptionist()
		{
          $this->load->view('receptionist/prescriptionview');
       } 

public function PrescriptionViewForDoctor()
		{
          $this->load->view('doctor/prescriptionview');
       }     

 public function SearchPrescriptionList()
		{
             $masterdb = $this->db->database;
             $userrole=$this->session->userdata('user_roles');
             
             if($userrole=="Patient"){
               $userid=$this->ion_auth->get_user_id();
            }else {
               $userid="";
              }


             $searchdata=$this->Prescription_model->SearchPrescription($userid,$masterdb);
           	 echo json_encode(array('success'=>true,'data'=>$searchdata,'role'=>$userrole));
				return;
	   
		}
      




public function editPrescriptionByid($id)
		{
	   $masterdb = $this->db->database;
	   $editappointment=$this->Prescription_model->EditPrescription($id,$masterdb);
	   echo json_encode(array('success'=>true,'data'=>$editappointment));
     }
           


public function updatePrescriptionData(){
            
            $id 					                        = $this->input->post("edit_prescription_id");
            $prescription_medicine                          = $this->input->post("edit_prescription_medicine"); 
           	$prescription_test       				        = $this->input->post("edit_prescription_test");
           	$prescription_note       				        = $this->input->post("edit_prescription_note");
           	$prescription_symptoms       				    = $this->input->post("edit_prescription_symptoms");
           	$prescription_diagnosis       				    = $this->input->post("edit_prescription_diagnosis");
           	


		    $oldimage =  Prescription_model::where('id',$id)->get(['prescription_photo']);//fetching from database table
		    json_encode(array('data'=>$oldimage)); 
		    $oldimage1= $oldimage[0]['prescription_photo'];

			 $sourcePath= isset($_FILES['edit_prescription_photo']['tmp_name'])?$_FILES['edit_prescription_photo']['tmp_name']:'';
               
			if(!empty($sourcePath))
			{
				
				$target_dir = "assets/uploads/prescription/";
				$target_file = $target_dir .basename($_FILES["edit_prescription_photo"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG")
					{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				} 
                  $temp=rand(0,100000).'_'; 
				$targetPath = FCPATH.$target_dir.$temp.$_FILES['edit_prescription_photo']['name']; // Target path where file is to be stored
				
				if(move_uploaded_file($sourcePath,$targetPath)){

				$imagepath ="assets/uploads/prescription/";
				$image=$imagepath.$temp.$_FILES['edit_prescription_photo']['name'];
				} else{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				}
				
			}else{
				$imagepath =null;
				$image=$oldimage1;
				
			}
          $postData=array();

          $prescriptiondetails=[];
          
          $postData = dataFieldValidation($prescription_medicine, "Prescription Medicine",$prescriptiondetails,"medicine_name",[ValidationTypes::REQUIRED],$postData,"prescriptiondetailsarray");
          $postData = dataFieldValidation($prescription_note, "Prescription Note",$prescriptiondetails,"Note",[ValidationTypes::REQUIRED], $postData,"prescriptiondetailsarray");
          $postData = dataFieldValidation($prescription_symptoms, "Prescription Symptoms",$prescriptiondetails,"symptoms",[ValidationTypes::REQUIRED], $postData,"prescriptiondetailsarray");
          $postData = dataFieldValidation($prescription_diagnosis, "Prescription Diagnosis",$prescriptiondetails,"diagnosis",[ValidationTypes::REQUIRED], $postData,"prescriptiondetailsarray");
          $postData = dataFieldValidation($image, "Prescription Photo",$prescriptiondetails,"prescription_photo",[ValidationTypes::REQUIRED], $postData,"prescriptiondetailsarray");
         
         if(isset($prescription_test) && !empty($prescription_test))
        {
              $test=[];
		    foreach($prescription_test as $key=>$udata)
		    {
			      $test_id  = $udata;
			      $postData = dataFieldValidation($test_id, "Test", $test,"test_id", "", $postData, "testarray".$key);
		        }
        } 
	
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}


		  
         
         $userId = $this->ion_auth->get_user_id();
         $updatedlog=isUpdateLog($userId);
         $prescriptionarray = array_merge($postData['dbinput']['prescriptiondetailsarray'],$updatedlog);
	     $updateprescription = $this->Prescription_model->updatePrescription($prescriptionarray,$id);


        if(isset($prescription_test) && !empty($prescription_test)){  
         $deleteTest = $this->PrescriptionTests_model->deletePrescriptionTest($id);
         if($deleteTest>0)
         {
	         	 foreach($prescription_test as $key=>$udata)
					    {  
					        $test_id  = $udata;
					        $testarray=array('prescription_id'=>$id,'test_id'=>$test_id);
					        $addprescriptiontest=$this->PrescriptionTests_model->addPrescriptionTest($testarray);
					    }
	     }else{

				 foreach($prescription_test as $key=>$udata)
					    {  
					        $test_id  = $udata;
					        $testarray=array('prescription_id'=>$id,'test_id'=>$test_id);
					        $addprescriptiontest=$this->PrescriptionTests_model->addPrescriptionTest($testarray);
					    }
			  }
        
          }
                   
            
             if($updateprescription||$addprescriptiontest){
				echo json_encode(array('success'=>true,'message'=>UPDATE_MSG));
				return;
              }else{
                  echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				   return;
              }	




            }


      
public function deletePrescriptionById($id)
		{
	
	   if(isset($id)&&$id>0){
            $deletedata=$this->Prescription_model->DeletePrescription($id);
            $deleteTest = $this->PrescriptionTests_model->deletePrescriptionTest($id);
            if($deletedata && $deleteTest) {
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


   public function viewPrescriptionById($id)
		{
	           $masterdb = $this->db->database;
	           $accountid=$this->account_id;
	           $accountdata=$this->Accounts_model->AccountDataById($accountid);
	           $Prescriptionbyid=$this->Prescription_model->ViewPrescriptionById($id,$masterdb);
	           $MedicineList=$this->PrescriptionMedicine_model->ViewMedicinesByPrescriptionId($id);
	           $MedicalTest=$this->PrescriptionTests_model->MedicalTestName($id);
	             if($Prescriptionbyid){
			                 echo json_encode(array('success'=>true,'data'=>$Prescriptionbyid,'medicaltest'=>$MedicalTest,'medicines'=>$MedicineList,'accountdata'=>$accountdata));
			                 return;
                       }else{
                             echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				              return;
                      } 
        }



public function prescriptionExport(){
		 $masterdb = $this->db->database;
		 $id = $this->input->post("prescriptionview_prescription_id");
	     $export_type = $this->input->post("export_type");
	    // $data=$this->Prescription_model->ViewPrescriptionById($id,$masterdb);

	           $accountid=$this->account_id;
	           $accountdata=$this->Accounts_model->AccountDataById($accountid);
	           $Prescriptionbyid=$this->Prescription_model->ViewPrescriptionById($id,$masterdb);
	           $MedicineList=$this->PrescriptionMedicine_model->ViewMedicinesByPrescriptionId($id);
	           $MedicalTest=$this->PrescriptionTests_model->MedicalTestName($id);


		if(isset($export_type) && $export_type=='pdf'){
			$filename='Prescription-'.$id.'-'.date('YmdHis').'.pdf';
			$data2['data']=$Prescriptionbyid;
			$data2['accountdata']=$accountdata;
			$data2['medicinedata']=$MedicineList;
			$data2['medicaltestdata']=$MedicalTest;
			$data2['print']=0;
			//load the view and saved it into $html variable
			$html=$this->load->view('export/prescriptionExportPdf',$data2, true);
			//this the the PDF filename that user will get to download
			$pdfFilePath =FCPATH.'assets/downloads/'.$filename;
			//load mPDF library
			$this->load->library('pdf');
		   //generate the PDF from the given html
			$this->pdf->pdf->useSubstitutions = true;
			$this->pdf->pdf->WriteHTML($html);
			//download it.
			ob_clean();
			$this->pdf->pdf->Output($pdfFilePath,"F");
			$file='assets/downloads/'.$filename;
			echo json_encode(array('success'=>true,'message'=>DWNLOAD_MSG,'download_type'=>$export_type,'data'=>$file));
			//echo $file;
			return;
			
		}

		if(isset($export_type) && $export_type=='print'){
			$data2['data']=$Prescriptionbyid;
			$data2['accountdata']=$accountdata;
			$data2['medicinedata']=$MedicineList;
			$data2['medicaltestdata']=$MedicalTest;
			$data2['print']=1;
			$html=$this->load->view('export/prescriptionExportPdf', $data2,true);
			echo json_encode(array('success'=>true,'message'=>DWNLOAD_MSG,'download_type'=>$export_type,'data'=>$html));
	 		return;
		}
	}    


}
?>