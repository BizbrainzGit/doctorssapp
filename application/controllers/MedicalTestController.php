<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
include_once(APPPATH.'controllers/CommonBaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;

class MedicalTestController extends CommonBaseController {

		public function __construct(){
		 parent::__construct();
		 $this->load->library(array('form_validation','ValidationTypes','excel','session','ion_auth'));
		 $this->load->helper(array('url','html','form','util_helper','language'));
		 $this->load->database();
		 $this->load->model('Userdetails_model');
		 $this->load->model('customerdb/MedicalTestCategory_model');
		 $this->load->model('customerdb/MedicalTest_model');
		}	

 public function AdminMedicalTestView()
		{
          $this->load->view('admin/medicaltestview');
        }


  public function SearchMedicalTestList()
		{
             $masterdb = $this->db->database;
             $searchdata=$this->MedicalTest_model->SearchMedicalTest($masterdb);
           	 echo json_encode(array('success'=>true,'data'=>$searchdata));
				return;
	   
		}
      

     
  public function saveMedicalTestData(){
            
            $medicaltest_category                 = $this->input->post("add_medicaltest_category");
            $medicaltest_medicaltest              = $this->input->post("add_medicaltest_medicaltest");
            $medicaltest_price                    = $this->input->post("add_medicaltest_price");
            $medicaltest_status                   = $this->input->post("add_medicaltest_status");
            $medicaltest_description              = $this->input->post("add_medicaltest_description");
		
           $postData=array();
           $medicaltestdetails=[];
          
           $postData = dataFieldValidation($medicaltest_category, "Medical Test Category",$medicaltestdetails,"medicaltest_category_id","",$postData,"medicaltestdetailsarray");
           $postData = dataFieldValidation($medicaltest_medicaltest, "Medical Test Name",$medicaltestdetails,"medicaltest_name","",$postData,"medicaltestdetailsarray");
           $postData = dataFieldValidation($medicaltest_price, "Price",$medicaltestdetails,"medicaltest_price","",$postData,"medicaltestdetailsarray");
           $postData = dataFieldValidation($medicaltest_status, "Status",$medicaltestdetails,"medicaltest_status","",$postData,"medicaltestdetailsarray");
           $postData = dataFieldValidation($medicaltest_description, "Description",$medicaltestdetails,"discretion","",$postData,"medicaltestdetailsarray");
           

		   if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		   }
        
		$userId = $this->ion_auth->get_user_id();
        $createdlog=isCreatedLog($userId);

	    $medicaltestarray = array_merge($postData['dbinput']['medicaltestdetailsarray'],$createdlog);
	   
	    $MedicalTest_save = $this->MedicalTest_model->addMedicalTest($medicaltestarray);
		
          
            if($MedicalTest_save){
               	echo json_encode(array('success'=>true,'message'=>SAVE_MSG));
				return;
			} else {
				echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				return;
			}
    }
 

  public function editMedicalTestByid($id)
		{ 
         
         $masterdb = $this->db->database;
	     $editMedicalTest=$this->MedicalTest_model->EditMedicalTest($id,$masterdb);
	     echo json_encode(array('success'=>true,'data'=>$editMedicalTest));
        }
      

  public function updateMedicalTestData(){
            
            $id 					              = $this->input->post("edit_medicaltest_id");
            $medicaltest_category                 = $this->input->post("edit_medicaltest_category");
            $medicaltest_medicaltest              = $this->input->post("edit_medicaltest_medicaltest");
            $medicaltest_price                    = $this->input->post("edit_medicaltest_price");
            $medicaltest_status                   = $this->input->post("edit_medicaltest_status");
            $medicaltest_description              = $this->input->post("edit_medicaltest_description");
		
           $postData=array();
           $medicaltestdetails=[];
          
           $postData = dataFieldValidation($medicaltest_category, "Medical Test Category",$medicaltestdetails,"medicaltest_category_id","",$postData,"medicaltestdetailsarray");
           $postData = dataFieldValidation($medicaltest_medicaltest, "Medical Test Name",$medicaltestdetails,"medicaltest_name","",$postData,"medicaltestdetailsarray");
           $postData = dataFieldValidation($medicaltest_price, "Price",$medicaltestdetails,"medicaltest_price","",$postData,"medicaltestdetailsarray");
           $postData = dataFieldValidation($medicaltest_status, "Status",$medicaltestdetails,"medicaltest_status","",$postData,"medicaltestdetailsarray");
           $postData = dataFieldValidation($medicaltest_description, "Description",$medicaltestdetails,"discretion","",$postData,"medicaltestdetailsarray");

		   if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		
		   }
        
		 $userId = $this->ion_auth->get_user_id();
         $updatedlog=isUpdateLog($userId);
		

	    $medicaltestarray = array_merge($postData['dbinput']['medicaltestdetailsarray'],$updatedlog);
	   
	    $MedicalTest_update = $this->MedicalTest_model->MedicalTestUpdate($medicaltestarray,$id);
		
          
            if($MedicalTest_update){
               	echo json_encode(array('success'=>true,'message'=>UPDATE_MSG));
				return;
			}
			else
			{
				echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				return;
			}

     }
			    
           	

  public function DeleteMedicalTestById($id)
		{
	
	   if(isset($id)&&$id>0){
           
                    
             $deletedata=$this->MedicalTest_model->DeleteMedicalTest($id);
                if($deletedata) {
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