<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/superadmin/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;

class PromocodeController extends BaseController {

 public function __construct(){
		
			parent::__construct();
			$this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
			$this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
			$this->load->database();
			$this->load->model('Promocode_model');
			
		}	
 

 public function managepromocodesview(){
          $this->load->view('superadmin/managepromocodesview');
      }


 public function editPromocodeByid($id){
	
	   $editPromocode=$this->Promocode_model->EditPromocode($id);
	   echo json_encode(array('success'=>true,'data'=>$editPromocode));
     }


 public function updatePromocodeByid(){

         $id 					                         =$this->input->post("edit_promocode_id");
         $edit_coupon_code       		           = $this->input->post("edit_coupon_code");
         $validity_from                   = $this->input->post("edit_validity_from");
          if(!empty($validity_from)){
                    $edit_validity_from                   = date("Y-m-d", strtotime($validity_from) );
           }else{
                   $edit_validity_from      = ' ';
            } 

         $validity_to                      = $this->input->post("edit_validity_to");

         if(!empty($validity_to)){
                      $edit_validity_to                     = date("Y-m-d", strtotime($validity_to) );
           }else{
                    $edit_validity_to      = ' '; 
                  }

         $edit_discount_percentage             = $this->input->post("edit_discount_percentage");
         $edit_discount_amount                 = $this->input->post("edit_discount_amount"); 
         

         $postData=array();
		     $promocodedata = [];

         $postData = dataFieldValidation($edit_coupon_code, "Coupon Code",$promocodedata,"coupon_code",[ValidationTypes::REQUIRED],$postData,"promocodearray");

         $postData = dataFieldValidation($edit_validity_from, "Validity From",$promocodedata,"valid_form",[ValidationTypes::REQUIRED],$postData,"promocodearray");

         $postData = dataFieldValidation($edit_validity_to, "Validity To",$promocodedata,"valid_to",[ValidationTypes::REQUIRED],$postData,"promocodearray");

         $postData = dataFieldValidation($edit_discount_percentage, "Discount Percentage",$promocodedata,"discount_percentage","",$postData,"promocodearray");

         $postData = dataFieldValidation($edit_discount_amount, "Discount Amount",$promocodedata,"discount_amount","",$postData,"promocodearray");

			       $userId = $this->ion_auth->get_user_id();
         $updatedlog=isUpdateLog($userId);
        $promocodearray = array_merge($postData['dbinput']['promocodearray'],$updatedlog);

	     $updatePromocode= $this->Promocode_model->promocodeUpdate($promocodearray,$id);
			    
	     if($updatePromocode){ 
				echo json_encode(array('success'=>true,'message'=>UPDATE_MSG));
				return;	
              } else {
              	echo json_encode(array('success'=>false,'message'=>SERVER_ERROR)); 
				return; 
                  }	
              }


 public function savePromocode(){

               
          $add_coupon_code       			        = $this->input->post("add_coupon_code");
          $validity_from                      = $this->input->post("add_validity_from");

          if(!empty($validity_from)){
                   $add_validity_from  = date("Y-m-d", strtotime($validity_from) );
           }else{
                   $add_validity_from      = ' ';
            } 
         
         $validity_to       		      = $this->input->post("add_validity_to");

         if(!empty($validity_to)){
                     $add_validity_to     = date("Y-m-d", strtotime($validity_to) );
           }else{
                    $add_validity_to      = ' ';
            }

       

         $add_discount_percentage             = $this->input->post("add_discount_percentage");
         $add_discount_amount                 = $this->input->post("add_discount_amount"); 
			
				
         $postData=array();
		 $promocodedata = [];
         
           
         $postData = dataFieldValidation($add_coupon_code, "Coupon Code",$promocodedata,"coupon_code",[ValidationTypes::REQUIRED],$postData,"promocodearray");

         $postData = dataFieldValidation($add_validity_from, "Validity From",$promocodedata,"valid_form",[ValidationTypes::REQUIRED],$postData,"promocodearray");

         $postData = dataFieldValidation($add_validity_to, "Validity To",$promocodedata,"valid_to",[ValidationTypes::REQUIRED],$postData,"promocodearray");

         $postData = dataFieldValidation($add_discount_percentage, "Discount Percentage",$promocodedata,"discount_percentage","",$postData,"promocodearray");

         $postData = dataFieldValidation($add_discount_amount, "Discount Amount",$promocodedata,"discount_amount","",$postData,"promocodearray");

         $userId = $this->ion_auth->get_user_id();
         $createdlog=isCreatedLog($userId);
        $promocodearray = array_merge($postData['dbinput']['promocodearray'],$createdlog);

         $addPromocode= $this->Promocode_model->Addpromocode($promocodearray);
			    
         if($addPromocode){
               	echo json_encode(array('success'=>true,'message'=>SAVE_MSG));
				return;
			    } else {
						echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
						return;
					}
			  }
		
 public function deletePromocodeByid($id){ 

              if(isset($id)&&$id>0){
              $deletePromocode = $this->Promocode_model->DeletePromocode($id);
			   echo json_encode(array('success'=>true,'data'=>$deletePromocode));
               } else {
               echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
               return;
					}
                 }


 public function SearchPromocodesList()
    {
          
           $search_promocode_fromdate                = $this->input->post("search_promocode_fromdate"); 
           if(!empty($search_promocode_fromdate)){
               $promocode_formdate                       = date("Y-m-d", strtotime($search_promocode_fromdate) );
           }else{
               $promocode_formdate                       = ' ';
            }
           

           $search_promocode_todate                  = $this->input->post("search_promocode_todate"); 

           if(!empty($search_promocode_todate)){
               $promocode_todate                         = date("Y-m-d", strtotime($search_promocode_todate) );
           }else{
               $promocode_todate                       = ' ';
            }
           

          $searchdata=$this->Promocode_model->SearchPromocodes($promocode_todate,$promocode_formdate);

            echo json_encode(array('success'=>true,'data'=>$searchdata));
        return;
    
    }             


}
?>