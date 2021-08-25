<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/CommonBaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;

class MedicalTestCategoryController extends CommonBaseController {

		public function __construct(){
		 parent::__construct();
		 $this->load->library(array('form_validation','ValidationTypes','session','ion_auth'));
		 $this->load->helper(array('url','html','form','util_helper','language'));
		 $this->load->database();
		 $this->load->model('Userdetails_model');
		 $this->load->model('customerdb/MedicalTestCategory_model');
		 
		}	

    public function AdminMedicalTestCategoryView()
		{
          $this->load->view('admin/medicaltestcategoryview');
        }

    public function SearchMedicalTestCategoryList()
		{
             $masterdb = $this->db->database;
             $searchdata=$this->MedicalTestCategory_model->SearchMedicalTestCategory($masterdb);
           	 echo json_encode(array('success'=>true,'data'=>$searchdata));
				return;
	   
		}
      

     
     public function saveMedicalTestCategoryData(){
            
           $medicaltestcategory_name        = $this->input->post("add_medicaltestcategory_name");

           $postData=array();
           $medicaltestcategorydetails=[];

           $postData = dataFieldValidation($medicaltestcategory_name, "Medical Test Category",$medicaltestcategorydetails,"category_name","",$postData,"medicaltestcategorydetailsarray");
          
		  if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		  }
        
		$userId = $this->ion_auth->get_user_id();
        $createdlog=isCreatedLog($userId);

	    $medicaltestcategoryarray = array_merge($postData['dbinput']['medicaltestcategorydetailsarray'],$createdlog);
	   
	    $MedicalTestCategory_save = $this->MedicalTestCategory_model->addMedicalTestCategory($medicaltestcategoryarray);
		
          
            if($MedicalTestCategory_save){
               	echo json_encode(array('success'=>true,'message'=>SAVE_MSG));
				return;
			} else {
				echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				return;
			}
        }
 

     public function editMedicalTestCategoryByid($id)
		{ 
         
         $masterdb = $this->db->database;
	     $editMedicalTestCategory=$this->MedicalTestCategory_model->EditMedicalTestCategory($id,$masterdb);
	     echo json_encode(array('success'=>true,'data'=>$editMedicalTestCategory));
        }
      

     public function updateMedicalTestCategoryData(){
            
            $id 					           = $this->input->post("edit_medicaltestcategory_id");
            $medicaltestcategory_name                 = $this->input->post("edit_medicaltestcategory_name");
            
           $postData=array();

           $medicaltestcategorydetails=[];
          
           $postData = dataFieldValidation($medicaltestcategory_name, "Medical Test Category",$medicaltestcategorydetails,"category_name","",$postData,"medicaltestcategorydetailsarray");
           
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		
		}
        
		 $userId = $this->ion_auth->get_user_id();
         $updatedlog=isUpdateLog($userId);
		

	    $medicaltestcategoryarray = array_merge($postData['dbinput']['medicaltestcategorydetailsarray'],$updatedlog);
	   
	    $MedicalTestCategory_update = $this->MedicalTestCategory_model->MedicalTestCategoryUpdate($medicaltestcategoryarray,$id);
		
          
            if($MedicalTestCategory_update){
               	echo json_encode(array('success'=>true,'message'=>UPDATE_MSG));
				return;
			}
			else
			{
				echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				return;
			}

     }
			    
           	

     public function DeleteMedicalTestCategoryById($id)
		{
	
	   if(isset($id)&&$id>0){
           
                    
             $deletedata=$this->MedicalTestCategory_model->DeleteMedicalTestCategory($id);
	         
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