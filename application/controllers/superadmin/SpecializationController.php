<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/superadmin/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;

class SpecializationController extends BaseController {

		public function __construct(){
		
		 parent::__construct();
		 $this->load->library(array('form_validation','ValidationTypes','session','ion_auth'));
		 $this->load->helper(array('url','html','form','util_helper','language'));
		 $this->load->database();
		 $this->load->model('User');
		 $this->load->model('Userdetails_model');
		 $this->load->model('Specialization_model');
		
		}	
 

  public function SpecializationView()
		{
          $this->load->view('superadmin/specializationview');
      }

 public function SearchSpecializationList()
		{
           
             $searchdata=$this->Specialization_model->SpecializationList();
           	echo json_encode(array('success'=>true,'data'=>$searchdata));
				return;
	   
		}
      


public function saveSpecializationData(){
            
            $specialization_name       = $this->input->post("add_specialization_name");


              $sourcePath1= isset($_FILES['add_specialization_img']['tmp_name'])?$_FILES['add_specialization_img']['tmp_name']:'';
                
			if(!empty($sourcePath1))
			{
				
				$target_dir = "assets/uploads/specialization/";
				$target_file = $target_dir .basename($_FILES["add_specialization_img"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			 
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF")
					{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				} 
                  $temp=rand(0,100000).'_'; 
				 $targetPath = FCPATH.$target_dir.$temp.$_FILES['add_specialization_img']['name']; // Target path where file is to be stored
				
				if(move_uploaded_file($sourcePath1,$targetPath)){

				$imagepath ="assets/uploads/specialization/";
				$image=$imagepath.$temp.$_FILES['add_specialization_img']['name'];
				} else{
					echo json_encode(array('success'=>false,'message'=>"File Not Uploaded..."));
					return;
				}
				
			}else{
				$imagepath =null;
				$image=null;
				// echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
				// 	return;
				
			}

            $postData=array();

          $specializationdetails=[];
          $postData = dataFieldValidation($specialization_name, "Department",$specializationdetails,"specialization","",$postData,"specializationdetailsarray");
           $postData = dataFieldValidation($image, "Specialization Img",$specializationdetails,"specialization_img","",$postData,"specializationdetailsarray");
         
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
        
		 $userId = $this->ion_auth->get_user_id();
        $createdlog=isCreatedLog($userId);

	    $specializationarray = array_merge($postData['dbinput']['specializationdetailsarray'],$createdlog);
	    $specialization_save = $this->Specialization_model->addSpecialization($specializationarray);
		
            if($specialization_save){
               	echo json_encode(array('success'=>true,'message'=>SAVE_MSG));
				return;
			}
			else
			{
				echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				return;
			}	




            }



public function editSpecializationByid($id)
		{
	   

	   $editspecialization=$this->Specialization_model->EditSpecialization($id);
	   echo json_encode(array('success'=>true,'data'=>$editspecialization));
     }
           


public function updateSpecializationData(){
            
            $id 					        = $this->input->post("edit_specialization_id");
            $specialization_name            = $this->input->post("edit_specialization_name");
            $oldimage =  Specialization_model::where('id',$id)->get(['specialization_img']);//fetching from database table
		 json_encode(array('data'=>$oldimage)); 
		 $oldimage1= $oldimage[0]['specialization_img'];

			 $sourcePath= isset($_FILES['edit_specialization_img']['tmp_name'])?$_FILES['edit_specialization_img']['tmp_name']:'';
               
			if(!empty($sourcePath))
			{
				
				$target_dir = "assets/uploads/specialization/";
				$target_file = $target_dir .basename($_FILES["edit_specialization_img"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG")
					{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				} 
                  $temp=rand(0,100000).'_'; 
				$targetPath = FCPATH.$target_dir.$temp.$_FILES['edit_specialization_img']['name']; // Target path where file is to be stored
				
				if(move_uploaded_file($sourcePath,$targetPath)){

				$imagepath ="assets/uploads/specialization/";
				$image=$imagepath.$temp.$_FILES['edit_specialization_img']['name'];
				} else{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				}
				
			}else{
				$imagepath =null;
				$image=$oldimage1;
				
			}
		
           $postData=array();
          $specializationdetails=[];
          $postData = dataFieldValidation($specialization_name, "Department",$specializationdetails,"specialization","",$postData,"  specializationdetailsarray");
            $postData = dataFieldValidation($image, "Specialization Img",$specializationdetails,"specialization_img","",$postData,"specializationdetailsarray");
         
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
        
		 $userId = $this->ion_auth->get_user_id();
         $updatedlog=isUpdateLog($userId);
		
	    $specializationarray = array_merge($postData['dbinput']['specializationdetailsarray'],$updatedlog);
	    $specialization_update = $this->Specialization_model->SpecializationUpdate($specializationarray,$id);
          
            if($specialization_update){
               	echo json_encode(array('success'=>true,'message'=>UPDATE_MSG));
				return;
			}
			else
			{
				echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				return;
			}	




            }          
public function DeleteSpecializationById($id)
		{
	
	   if(isset($id)&&$id>0){

             $deletedata=$this->Specialization_model->DeleteSpecialization($id);
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