<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH.'controllers/superadmin/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;

class PackagesController extends BaseController {
		public function __construct(){
			parent::__construct();
			$this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
			$this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
			$this->load->database();
			$this->load->model('Packages_model');
		}	
 

   public function packagesView()
		  {
          $this->load->view('superadmin/packagesview');
        }

 public function listPackages()
		{
          $packageslist=$this->Packages_model->listPackages();
	        echo json_encode(array('success'=>true,'data'=>$packageslist));
        }

 public function savePackage()
        {  
          $package_name       			           = $this->input->post("add_package_name");
          $package_amount       			         = $this->input->post("add_package_amount");
          $package_status       			         = $this->input->post("add_package_status");
          $package_duration       		         = $this->input->post("add_package_duration");
            	
          $postData=array();
		      $packagedata = [];
          $postData = dataFieldValidation($package_name, "Package Name",$packagedata,"package_name",[ValidationTypes::REQUIRED],$postData,"packagearray");
          $postData = dataFieldValidation($package_amount, "Package Amount",$packagedata,"package_amount",[ValidationTypes::REQUIRED],$postData,"packagearray");
          $postData = dataFieldValidation($package_status, "Package Status",$packagedata,"package_status",[ValidationTypes::REQUIRED],$postData,"packagearray");
          $postData = dataFieldValidation($package_duration, "Sub Duration",$packagedata,"package_duration",[ValidationTypes::REQUIRED],$postData,"packagearray");
    		  if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
    		  echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
    			return;
    		  }
         $userId = $this->ion_auth->get_user_id();
         $createdlog=isCreatedLog($userId);
         $packagearray = array_merge($postData['dbinput']['packagearray'],$createdlog);
         $addPackage= $this->Packages_model->AddPackage($packagearray);
         if($addPackage){
                echo json_encode(array('success'=>true,'message'=>SAVE_MSG));
    		        return;
    			   }else{
    		        echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
    			    return;
    		    }
    			
       }

public function editPackageByid($id)
	   {
	     $editPackage=$this->Packages_model->EditPackage($id);
	     echo json_encode(array('success'=>true,'data'=>$editPackage));
       }

public function updatePackageByid()
       {

        $package_id 					           =$this->input->post("edit_package_id");
        $package_name       			       = $this->input->post("edit_package_name");
	      $package_amount       			     = $this->input->post("edit_package_amount"); 
	      $package_status       			     = $this->input->post("edit_package_status");
	      $package_duration       			   = $this->input->post("edit_package_duration"); 
        $postData=array();
		    $packagedata = [];
        $postData = dataFieldValidation($package_name, "Package Name",$packagedata,"package_name",[ValidationTypes::REQUIRED],$postData,"packagearray");
          $postData = dataFieldValidation($package_amount, "Package Amount",$packagedata,"package_amount",[ValidationTypes::REQUIRED],$postData,"packagearray");
          $postData = dataFieldValidation($package_status, "Package Status",$packagedata,"package_status",[ValidationTypes::REQUIRED],$postData,"packagearray");
          $postData = dataFieldValidation($package_duration, "Sub Duration",$packagedata,"package_duration",[ValidationTypes::REQUIRED],$postData,"packagearray");
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
         
         $userId = $this->ion_auth->get_user_id();
         $updatedlog=isUpdateLog($userId);
         $packagearray = array_merge($postData['dbinput']['packagearray'],$updatedlog);
         $updatepackage = $this->Packages_model->UpdatePackage($packagearray,$package_id);
       if($updatepackage){
          echo json_encode(array('success'=>true,'message'=>UPDATE_MSG));
		      return;
		      } else {
          echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
          return;
          }	
       }

public function deletePackageById($id)
       {
       if(isset($id)&&$id>0){
          $deletepackage = $this->Packages_model->DeletePackage($id);
           if($deletepackage){
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