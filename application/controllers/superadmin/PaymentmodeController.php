<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/superadmin/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;

class PaymentmodeController extends BaseController {

		public function __construct(){
		
		 parent::__construct();
		 $this->load->library(array('form_validation','ValidationTypes','session','ion_auth'));
		 $this->load->helper(array('url','html','form','util_helper','language'));
		 $this->load->database();
		 $this->load->model('User');
		 $this->load->model('Userdetails_model');
		 $this->load->model('Paymentmode_model');
		}	
 

  public function PaymentmodeView()
		{
          $this->load->view('superadmin/paymentmodeview');
      }

 public function SearchPaymentmodeList()
		{
          
           
             $searchdata=$this->Paymentmode_model->PaymentmodeList();

           	echo json_encode(array('success'=>true,'data'=>$searchdata));
				return;
	   
		}
      


public function savePaymentmodeData(){
            
            $paymentmode_name       			        = $this->input->post("add_paymentmode_name");
           
		
           $postData=array();

          $paymentmodedetails=[];
          
          $postData = dataFieldValidation($paymentmode_name, "Payment Mode",$paymentmodedetails,"paymentmode_name","",$postData,"paymentmodedetailsarray");
         

		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
        
		 $userId = $this->ion_auth->get_user_id();
        $createdlog=isCreatedLog($userId);

	    $paymentmodearray = array_merge($postData['dbinput']['paymentmodedetailsarray'],$createdlog);
	   
	    $paymentmode_save = $this->Paymentmode_model->addPaymentmode($paymentmodearray);
		
          
            if($paymentmode_save){
               	echo json_encode(array('success'=>true,'message'=>SAVE_MSG));
				return;
			}
			else
			{
				echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				return;
			}	




            }



public function editPaymentmodeByid($id)
		{
	   

	   $editpaymentmode=$this->Paymentmode_model->EditPaymentmode($id);
	   echo json_encode(array('success'=>true,'data'=>$editpaymentmode));
     }
           


public function updatePaymentmodeData(){
            
            $id 					                        = $this->input->post("edit_paymentmode_id");
            $paymentmode_name       			        = $this->input->post("edit_paymentmode_name");
            
		
           $postData=array();

          $paymentmodedetails=[];
          
          $postData = dataFieldValidation($paymentmode_name, "payment Mode",$paymentmodedetails,"paymentmode_name","",$postData,"paymentmodedetailsarray");
        
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
        
		 $userId = $this->ion_auth->get_user_id();
         $updatedlog=isUpdateLog($userId);
		

	    $paymentmodearray = array_merge($postData['dbinput']['paymentmodedetailsarray'],$updatedlog);
	   
	    $paymentmode_update = $this->Paymentmode_model->PaymentmodeUpdate($paymentmodearray,$id);
		
          
            if($paymentmode_update){
               	echo json_encode(array('success'=>true,'message'=>SAVE_MSG));
				return;
			}
			else
			{
				echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				return;
			}	




            }          
public function DeletePaymentmodeById($id)
		{
	
	   if(isset($id)&&$id>0){
           
            $getid=Paymentmode_model::where('payment_mode.id','=',$id)->get();
            
             $deletedata=$this->Paymentmode_model->DeletePaymentmode($id);
	         
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