<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH.'controllers/CommonBaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;

class SubscriptionController extends CommonBaseController {
 public function __construct(){
			parent::__construct();
			$this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
			$this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
		  $this->load->database();
      $this->load->model('Subscription_model');
		}	
 

 public function subscriptionViewForSuperadmin(){
          $this->load->view('superadmin/subscriptionview');
      }

 public function subscriptionViewForAdmin(){
          $this->load->view('admin/subscriptionview');
      }     

public function SearchSubscriptionsList()
    {   
        $masterdb = $this->db->database;
        $searchdata=$this->Subscription_model->SearchSubscriptions($masterdb);
            echo json_encode(array('success'=>true,'data'=>$searchdata));
        return;
    }
    
 public function editSubscriptionByid($id){
     $editSubscription=$this->Subscription_model->EditSubscription($id);
     echo json_encode(array('success'=>true,'data'=>$editSubscription));
     }

 public function updateSubscriptionByid(){

          $id                                =$this->input->post("edit_subscription_id");
          $subscription_name                 = $this->input->post("edit_subscription_name");
          $subscription_duration             = $this->input->post("edit_subscription_duration");
          $subscription_description          = $this->input->post("edit_subscription_description");
          $subscription_amount               = $this->input->post("edit_subscription_amount");
          $subscription_status               = $this->input->post("edit_subscription_status");
          $subscription_startdate            = $this->input->post("edit_subscription_startdate");
           

          if(!empty($subscription_startdate)){
                $edit_subscription_startdate  = date("Y-m-d", strtotime($subscription_startdate) );
           }else{
              $edit_subscription_startdate    = ' ';
            } 
         
         $subscription_enddate               = $this->input->post("edit_subscription_enddate");

         if(!empty($subscription_enddate)){
                 $edit_subscription_enddate   = date("Y-m-d", strtotime($subscription_enddate) );
           }else{
                $edit_subscription_enddate    = ' ';
            }

         $subscription_hospitalid            = $this->input->post("edit_subscription_hospitalid");
        
         $postData=array();
         $subscriptiondata = [];
         
           
         $postData = dataFieldValidation($subscription_name, "Subscription Name",$subscriptiondata,"subscription_name",[ValidationTypes::REQUIRED],$postData,"subscriptionarray");

         $postData = dataFieldValidation($subscription_duration, "Duration",$subscriptiondata,"duration","",$postData,"subscriptionarray");

         $postData = dataFieldValidation($subscription_description, "Description",$subscriptiondata,"description","",$postData,"subscriptionarray");

         $postData = dataFieldValidation($subscription_amount, "Amount",$subscriptiondata,"amount","",$postData,"subscriptionarray");

         $postData = dataFieldValidation($subscription_status, "Status",$subscriptiondata,"is_active","",$postData,"subscriptionarray");

         $postData = dataFieldValidation($edit_subscription_startdate, "Start Date ",$subscriptiondata,"start_date",[ValidationTypes::REQUIRED],$postData,"subscriptionarray");

         $postData = dataFieldValidation($edit_subscription_enddate, "End Date",$subscriptiondata,"end_date",[ValidationTypes::REQUIRED],$postData,"subscriptionarray");

          $postData = dataFieldValidation($subscription_hospitalid, "Hospital Name",$subscriptiondata,"client_id",[ValidationTypes::REQUIRED],$postData,"subscriptionarray");

         $userId = $this->ion_auth->get_user_id();
         $updatedlog=isUpdateLog($userId);
        $subscriptionarray = array_merge($postData['dbinput']['subscriptionarray'],$updatedlog);

       $updateSubscription= $this->Subscription_model->subscriptionUpdate($subscriptionarray,$id);
          
       if($updateSubscription){ 
        echo json_encode(array('success'=>true,'message'=>UPDATE_MSG));
        return; 
              } else {
                echo json_encode(array('success'=>false,'message'=>SERVER_ERROR)); 
        return; 
                  } 
              }


 public function saveSubscription(){

               
          $subscription_name                 = $this->input->post("add_subscription_name");
          $subscription_duration             = $this->input->post("add_subscription_duration");
          $subscription_description          = $this->input->post("add_subscription_description");
          $subscription_amount               = $this->input->post("add_subscription_amount");
          $subscription_status               = $this->input->post("add_subscription_status");
          $subscription_startdate            = $this->input->post("add_subscription_startdate");

          if(!empty($subscription_startdate)){
                $add_subscription_startdate  = date("Y-m-d", strtotime($subscription_startdate) );
           }else{
              $add_subscription_startdate    = ' ';
            } 
         
         $subscription_enddate               = $this->input->post("add_subscription_enddate");

         if(!empty($subscription_enddate)){
                 $add_subscription_enddate   = date("Y-m-d", strtotime($subscription_enddate) );
           }else{
                $add_subscription_enddate    = ' ';
            }

         $subscription_hospitalid            = $this->input->post("add_subscription_hospitalid");
        
         $postData=array();
         $subscriptiondata = [];
         
           
         $postData = dataFieldValidation($subscription_name, "Subscription Name",$subscriptiondata,"subscription_name",[ValidationTypes::REQUIRED],$postData,"subscriptionarray");

         $postData = dataFieldValidation($subscription_duration, "Duration",$subscriptiondata,"duration","",$postData,"subscriptionarray");

         $postData = dataFieldValidation($subscription_description, "Description",$subscriptiondata,"description","",$postData,"subscriptionarray");

         $postData = dataFieldValidation($subscription_amount, "Amount",$subscriptiondata,"amount","",$postData,"subscriptionarray");

         $postData = dataFieldValidation($subscription_status, "Status",$subscriptiondata,"is_active","",$postData,"subscriptionarray");

         $postData = dataFieldValidation($add_subscription_startdate, "Start Date ",$subscriptiondata,"start_date",[ValidationTypes::REQUIRED],$postData,"subscriptionarray");

         $postData = dataFieldValidation($add_subscription_enddate, "End Date",$subscriptiondata,"end_date",[ValidationTypes::REQUIRED],$postData,"subscriptionarray");

           $postData = dataFieldValidation($subscription_hospitalid, "Hospital Name",$subscriptiondata,"client_id",[ValidationTypes::REQUIRED],$postData,"subscriptionarray");

         $userId = $this->ion_auth->get_user_id();
         $createdlog=isCreatedLog($userId);
        $subscriptionarray = array_merge($postData['dbinput']['subscriptionarray'],$createdlog);

         $addSubscription= $this->Subscription_model->Addsubscription($subscriptionarray);
          
         if($addSubscription){
                echo json_encode(array('success'=>true,'message'=>SAVE_MSG));
        return;
          } else {
            echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
            return;
          }
        }
    
 public function deleteSubscriptionByid($id){ 

              if(isset($id)&&$id>0){
              $deletesubscription = $this->Subscription_model->DeleteSubscription($id);
         echo json_encode(array('success'=>true,'data'=>$deletesubscription));
               } else {
               echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
               return;
          }
                 }



}
?>