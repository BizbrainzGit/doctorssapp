<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH.'controllers/laboratory/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use \Illuminate\Database\Capsule\Manager as Capsule;
class TestTemplateController extends BaseController{

	public function __construct(){
		parent::__construct("Normal");
		$this->load->helper(array('form', 'url','captcha','html','language'));
		$this->load->library(array('session', 'form_validation', 'email','ion_auth'));
        $this->load->database();
        $this->load->model('customerdb/TestTemplates_model');
	}
       

    public function AddTestTemplateView()
     {         
            
        $this->load->view('laboratory/newtesttempateview');

       }
     
    
    public function SearchTestTemplateListData()
		{
            $searchdata=$this->TestTemplates_model->SearchTestTemplateList();
           	echo json_encode(array('success'=>true,'data'=>$searchdata));
		    return;
		}
	 public function TestTemplateEditByIdData($id)
		{
            $editdata=$this->TestTemplates_model->TestTemplateEditById($id);
            if ($editdata) {
            		echo json_encode(array('success'=>true,'data'=>$editdata));
		             return;
            }else{
                
                    echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				    return;
            }
           
		}	

     public function TestTemplateViewByIdData($id)
		{
            $editdata=$this->TestTemplates_model->TestTemplateViewById($id);
            if ($editdata) {
            		echo json_encode(array('success'=>true,'data'=>$editdata));
		             return;
            }else{
                
                    echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				    return;
            }
           
		}
		
    public function SaveTestTemplateData(){

			$testtemplate_testname       			   = $this->input->post("add_testtemplate_testname");
			$testtemplate_status       			       = $this->input->post("add_testtemplate_status");
			$testtemplate_report       				   = $this->input->post("add_testtemplate_report");
			
            $result=TestTemplates_model::where('medical_test_id','=',$testtemplate_testname )->count();
			if($result>0)
			{
				echo json_encode(array('success'=>false,'message'=>"The Test Already Have Template"));
				return; 
			}
		
        $postData=array();
        $testtemplatedata = [];
        $postData = dataFieldValidation($testtemplate_testname, "Test Id",$testtemplatedata,"medical_test_id","", $postData,"testtemplatearray");
        $postData = dataFieldValidation($testtemplate_status, "Status",$testtemplatedata,"status","", $postData,"testtemplatearray");
        $postData = dataFieldValidation($testtemplate_report, "Report Data",$testtemplatedata,"test_template","", $postData,"testtemplatearray");
       
	    if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
				echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
				return;
			}
        
        $userId = $this->ion_auth->get_user_id();	
        $createdlog=isCreatedLog($userId);
        $testtemplatearray=array_merge($postData['dbinput']['testtemplatearray'],$createdlog);
	    $savedata = $this->TestTemplates_model->addTestTemplate($testtemplatearray);
		
          
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
    

    public function UpdateTestTemplateData(){
           
            $testtemplate_id             			   = $this->input->post("edit_testtemplate_id");
			$testtemplate_testname       			   = $this->input->post("edit_testtemplate_testname");
			$testtemplate_status       			       = $this->input->post("edit_testtemplate_status");
			$testtemplate_report       				   = $this->input->post("edit_testtemplate_report");
		   
        $postData=array();
        $testtemplatedata = [];
        $postData = dataFieldValidation($testtemplate_testname, "Test Id",$testtemplatedata,"medical_test_id","", $postData,"testtemplatearray");
        $postData = dataFieldValidation($testtemplate_status, "Status",$testtemplatedata,"status","", $postData,"testtemplatearray");
        $postData = dataFieldValidation($testtemplate_report, "Report Data",$testtemplatedata,"test_template","", $postData,"testtemplatearray");
       
	    if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
				echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
				return;
			}
		         $userId = $this->ion_auth->get_user_id();
                 $updatedlog=isUpdateLog($userId);

		        $testtemplatearray=array_merge($postData['dbinput']['testtemplatearray'],$updatedlog);
			    $updatedata = $this->TestTemplates_model->UpdateTestTemplate($testtemplatearray,$testtemplate_id);
		            if($updatedata){
		               	echo json_encode(array('success'=>true,'message'=>UPDATE_MSG));
						return;
					}
					else
					{
						echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
						return;
					}	




            }

}?>