<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH.'controllers/laboratory/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use \Illuminate\Database\Capsule\Manager as Capsule;
class MedicalTestReportsController extends BaseController{

	public function __construct(){
		parent::__construct("Normal");
		$this->load->helper(array('form', 'url','captcha','html','language'));
		$this->load->library(array('session', 'form_validation', 'email','ion_auth'));
        $this->load->database();
        $this->load->model('customerdb/TestTemplates_model');
        $this->load->model('customerdb/PateintBillingTest_model');
        $this->load->model('customerdb/BillingTests_model'); 
        $this->load->model('customerdb/PatientMedicalTestReports_model');
	}

    public function AddMedicalTestReportView()
       {         
         $this->load->view('laboratory/addmedicaltestreportview');
       }
    public function MedicalTestReportListView()
       {         
         $this->load->view('laboratory/medicaltestreportview');
       }   

    public function GetPatientBillingTestsForTestReportData()
       {    
            $masterdb    = $this->db->database;     
       	    $data=$this->PateintBillingTest_model->GetPatientBillingTestsForTestReport($masterdb);
           	echo json_encode(array('success'=>true,'data'=>$data));
		    return;

       }

    public function GetMedicalTestByBillingIdData($id){

            $data=$this->BillingTests_model->TestListPatientBillingTestsById($id);
           	echo json_encode(array('success'=>true,'data'=>$data));
		    return;
       } 

    public function GetTestTemplateByTestIdData($id){
      	  $data=$this->TestTemplates_model->GetTestTemplateByTestId($id);
      	      if ($data){	 
      	  	             echo json_encode(array('success'=>true,'data'=>$data));
      	  		         return;
      	          }else{
                   echo json_encode(array('success'=>false,'message'=>"Test Do Not Have Decultf Template"));
		     	    return;
      	      }
           

       }
    
    public function SearchMedicalTestReportsListData()
		{  
			$masterdb    = $this->db->database;
            $searchdata=$this->PatientMedicalTestReports_model->SearchMedicalTestReportsList($masterdb);
           	echo json_encode(array('success'=>true,'data'=>$searchdata));
		    return;
		}
	 // public function TestTemplateEditByIdData($id)
		// {
  //           $editdata=$this->TestTemplates_model->TestTemplateEditById($id);
  //           if ($editdata) {
  //           		echo json_encode(array('success'=>true,'data'=>$editdata));
		//              return;
  //           }else{
                
  //                   echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
		// 		    return;
  //           }
           
		// }	

  //    public function TestTemplateViewByIdData($id)
		// {
  //           $editdata=$this->TestTemplates_model->TestTemplateViewById($id);
  //           if ($editdata) {
  //           		echo json_encode(array('success'=>true,'data'=>$editdata));
		//              return;
  //           }else{
                
  //                   echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
		// 		    return;
  //           }
           
		// }
		
    public function SaveMedicalTestReportData(){

			$medicaltestreport_billingid       			       = $this->input->post("add_medicaltestreport_billingid");
			$medicaltestreport_testid       			       = $this->input->post("add_medicaltestreport_testid");
			$medicaltestreport_tempate       				   = $this->input->post("add_medicaltestreport_tempate");
			
        $postData=array();
        $medicaltestreportdata = [];
        $postData = dataFieldValidation($medicaltestreport_billingid, "Billing Id",$medicaltestreportdata,"billing_id","", $postData,"medicaltestreportarray");
        $postData = dataFieldValidation($medicaltestreport_testid, "Test Id",$medicaltestreportdata,"medical_test_id","", $postData,"medicaltestreportarray");
        $postData = dataFieldValidation($medicaltestreport_tempate, "Medical Report ",$medicaltestreportdata,"medical_test_report","", $postData,"medicaltestreportarray");
       
	    if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
				echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
				return;
			}
        
        $userId = $this->ion_auth->get_user_id();	
        $createdlog=isCreatedLog($userId);
        $medicaltestreportarray=array_merge($postData['dbinput']['medicaltestreportarray'],$createdlog);
	    $savedata = $this->PatientMedicalTestReports_model->addMedicalTestReport($medicaltestreportarray);
		
          
            if($savedata){
               	echo json_encode(array('success'=>true,'message'=>SAVE_MSG));
				return;
			}
			else
			{
				echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				return;
			}	




            }
    

   //  public function UpdateTestTemplateData(){
           
   //          $testtemplate_id             			   = $this->input->post("edit_testtemplate_id");
			// $testtemplate_testname       			   = $this->input->post("edit_testtemplate_testname");
			// $testtemplate_status       			       = $this->input->post("edit_testtemplate_status");
			// $testtemplate_report       				   = $this->input->post("edit_testtemplate_report");
		   
   //      $postData=array();
   //      $testtemplatedata = [];
   //      $postData = dataFieldValidation($testtemplate_testname, "Test Id",$testtemplatedata,"medical_test_id","", $postData,"testtemplatearray");
   //      $postData = dataFieldValidation($testtemplate_status, "Status",$testtemplatedata,"status","", $postData,"testtemplatearray");
   //      $postData = dataFieldValidation($testtemplate_report, "Report Data",$testtemplatedata,"test_template","", $postData,"testtemplatearray");
       
	  //   if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			// 	echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			// 	return;
			// }
		 //         $userId = $this->ion_auth->get_user_id();
   //               $updatedlog=isUpdateLog($userId);

		 //        $testtemplatearray=array_merge($postData['dbinput']['testtemplatearray'],$updatedlog);
			//     $updatedata = $this->TestTemplates_model->UpdateTestTemplate($testtemplatearray,$testtemplate_id);
		 //            if($updatedata){
		 //               	echo json_encode(array('success'=>true,'message'=>UPDATE_MSG));
			// 			return;
			// 		}
			// 		else
			// 		{
			// 			echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
			// 			return;
			// 		}	


   //          }

}?>