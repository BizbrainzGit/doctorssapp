<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH.'controllers/superadmin/BaseController.php');
error_reporting(0);
use Illuminate\Database\Query\Expression as raw;
use \Illuminate\Database\Capsule\Manager as Capsule;
class SubscriptionController extends BaseController {
 public function __construct(){
  		  parent::__construct();
  		  $this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
  		  $this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
  		  $this->load->database();
	      $this->load->model('Subscription_model');
	      $this->load->model('SubscriptionPackage_model');
	      $this->load->model('PaymentTransaction_model');
	      $this->load->model('Accounts_model'); 
	      $this->load->model('Promocode_model');
	      $this->load->model('Userdetails_model');
	      $this->load->model('Sms_send_model');
	      $this->load->model('Customdata_model'); 
        $this->load->model('Packages_model');

		}	

 public function SubscriptionView(){
          $this->load->view('superadmin/subscriptionview');
      }

 public function SearchSubscriptionsList()
    {   
        $masterdb = $this->db->database;
        $searchdata=$this->Subscription_model->SearchSubscriptions($masterdb);
            echo json_encode(array('success'=>true,'data'=>$searchdata));
        return;
    }

    public function saveSubscription(){

               $subscription_accountid        = $this->input->post("add_subscription_accountid");
               $subscription_startdate        = $this->input->post("add_subscription_startdate");
              if(!empty($subscription_startdate)){
                    $subscription_startdate  = date("Y-m-d", strtotime($subscription_startdate) );
               }else{
                  $subscription_startdate    = ' ';
                } 
               $subscription_enddate          = $this->input->post("add_subscription_enddate");
                  if(!empty($subscription_enddate)){
                    $subscription_enddate  = date("Y-m-d", strtotime($subscription_enddate) );
               }else{
                  $subscription_enddate    = ' ';
                }
               $business_package         = $this->input->post("add_subscription_package");
                
                
                $subscription_total    = $this->input->post("add_subscription_packagetotal");
                 if(isset($subscription_total) && !empty($subscription_total)){
                     $subscription_total=$subscription_total;
                    }else{
                     $subscription_total=0;
                    }

                $subscription_discountamount = $this->input->post("add_subscription_discountamount");
                  if(isset($subscription_discountamount) && !empty($subscription_discountamount)){
                      $subscription_discountamount=$subscription_discountamount;
                     }else{
                     $subscription_discountamount=0;
                     }
         
               $subscription_promocode_id   = $this->input->post("add_subscription_promocode_id");
                if(isset($subscription_promocode_id) && !empty($subscription_promocode_id)){
                    $subscription_promocode_id=$subscription_promocode_id;
                  }else{
                    $subscription_promocode_id=0;
                  }
        
               $subscription_payment_mode  = $this->input->post("add_subscription_payment_mode");
                  if(isset($subscription_payment_mode) && !empty($subscription_payment_mode)){
                     $subscription_payment_mode=$subscription_payment_mode; 
                  }else{
                     $subscription_payment_mode=0;
                  }

              if($subscription_discountamount==0){
               $total = $subscription_total;
               }else{
                $total=$subscription_total-$subscription_discountamount;
             }

              $editAccounts=$this->Accounts_model->EditAccount($subscription_accountid);
              $business_state_id=$editAccounts[0]['state_id'];
                
              if($business_state_id ==32){
                 $cgst=$total*9/100;
                 $sgst=$total*9/100;
                 $grandtoatal=$total+$cgst+$sgst;
                 $igst=0;
                  }else if($business_state_id !=32){
                  $igst=$total*18/100;
                  $grandtoatal=$total+$igst;
                  $cgst=0;
                  $sgst=0;
                 } 

                $grandtoatal=round($grandtoatal); 

              $upi = $this->input->post("add_subscription_upi");
              $phonepay  = $this->input->post("add_subscription_phonepay");
                  if(isset($phonepay) && !empty($phonepay)){
                        $phonepay=$phonepay;
                        }else{
                        $phonepay=0;
                     }
              $amazonpay = $this->input->post("add_subscription_amazonpay");
                     if(isset($amazonpay) && !empty($amazonpay)){
                         $amazonpay=$amazonpay;
                       }else{
                       $amazonpay=0;
                      }
              $googlepay = $this->input->post("add_subscription_googlepay");
                      if(isset($googlepay) && !empty($googlepay)){
                          $googlepay=$googlepay;
                          }else{
                       $googlepay=0;
                        } 
              $paytm_upi= $this->input->post("add_subscription_paytm");
               if(isset($paytm_upi) && !empty($paytm_upi)){
                          $paytm_upi=$paytm_upi;
                          }else{
                              $paytm_upi=0;
                          }

              $upiamount = $this->input->post("add_subscription_upiamount");
                       if(empty($upiamount)){
                          $upiamount = 0.00;
                        }else{
                          $upiamount = $upiamount;
                       }

           
              $cashamount= $this->input->post("add_subscription_cashamount");
                     if(empty($cashamount)){
                           $cashamount = 0.00;
                        }else{
                           $cashamount = $cashamount;
                       }
             
               $personame = $this->input->post("add_subscription_personame");
               $neftnumber                              = $this->input->post("add_subscription_neftnumber");
            
              $chequeno = $this->input->post("add_subscription_chequeno");
                  if(isset($chequeno) && !empty($chequeno)){
                        $chequeno=$chequeno;
                     }else{
                      $chequeno=0;
                     }
              $chequeissuedate = $this->input->post("add_subscription_chequeissuedate");
                 if(empty($chequeissuedate)){
                        $chequeissuedate = null;
                        }else{
                          $chequeissuedate = date("Y-m-d", strtotime($chequeissuedate) );
                       } 

              $cheque_bankname = $this->input->post("add_subscription_cheque_bankname");
              $chequeamount = $this->input->post("add_subscription_chequeamount");
                   if(empty($chequeamount)){
                        $chequeamount                        = 0.00;
                        }else{
                          $chequeamount                      = $chequeamount;
                       } 
                 
              $neftamount = $this->input->post("add_subscription_neftamount");
                   if(empty($neftamount)){
                        $neftamount                        = 0.00;
                        }else{
                          $neftamount                      = $neftamount;
                       }

               $txnid = time(); 
                if($subscription_payment_mode==1){
                     $order_id="BB_CASH_".$txnid;
                     $status="SUCCESS";
                     $amount=$cashamount; 
                }else if($subscription_payment_mode==3){
                     $order_id="BB_UPI_".$txnid;
                     $status="SUCCESS";
                     $amount=$upiamount;
                }else if($subscription_payment_mode==2){
                      $order_id="BB_CHEQUE_".$txnid;
                      $status="SUCCESS";
                      $amount=$chequeamount;  
                }else if($subscription_payment_mode==5){
                      $order_id="BB_NEFT_".$txnid;
                      $status="SUCCESS";
                      $amount=$neftamount;  
                }else if($subscription_payment_mode==4){
                      $razorpayorder_id  = $this->input->post("add_subscription_razorpay_order_id");
                }
            
              $subscription_status = $this->input->post("add_subscription_status");
              if(isset($subscription_status) && !empty($subscription_status)){
                $subscription_status=$subscription_status;
              }else{
                $subscription_status=0;
              }

                 
              $userId = $this->ion_auth->get_user_id();  
              $postData=[];

              if(isset($business_package) && !empty($business_package))
                {
                      $package=[];
                foreach($business_package as $key=>$udata)
                {
                    $package_id  = $udata;
                    $postData = dataFieldValidation($package_id, "Package", $package,"package_id", "", $postData, "packagearray".$key);
                    }
                }

         
          $subscriptiondata = [];
         

          $postData = dataFieldValidation($subscription_accountid, "Account Id",$subscriptiondata,"account_id","", $postData,"subscriptiondataarray");
          $postData = dataFieldValidation($subscription_startdate, "Subscription Start Date",$subscriptiondata,"subscription_startdate","", $postData,"subscriptiondataarray");
          $postData = dataFieldValidation($subscription_enddate, "Subscription End Date",$subscriptiondata,"subscription_enddate","", $postData,"subscriptiondataarray");

          $postData = dataFieldValidation($subscription_total, "Package Total Amount",$subscriptiondata,"package_total_amount","", $postData,"subscriptiondataarray");

         $postData = dataFieldValidation($subscription_discountamount, "Distocunt Amount ",$subscriptiondata,"discount_amount","", $postData,"subscriptiondataarray");

          $postData = dataFieldValidation($total, "Sub Total",$subscriptiondata,"sub_total_amount","", $postData,"subscriptiondataarray");
          
          $postData = dataFieldValidation($igst, "IGST",$subscriptiondata,"igst_amount","", $postData,"subscriptiondataarray");
          $postData = dataFieldValidation($cgst, "CGST",$subscriptiondata,"cgst_amount","", $postData,"subscriptiondataarray");
          $postData = dataFieldValidation($sgst, "SGST",$subscriptiondata,"sgst_amount","", $postData,"subscriptiondataarray");
          $postData = dataFieldValidation($grandtoatal, "Grand Total",$subscriptiondata,"grand_total_amount","", $postData,"subscriptiondataarray");
          $postData = dataFieldValidation($subscription_promocode_id, "Promo Code",$subscriptiondata,"promocode_id","", $postData,"subscriptiondataarray");

       $paymenttransactiondata = [];

         $postData = dataFieldValidation($order_id, "Order Id",$paymenttransactiondata,"order_id","", $postData,"paymenttransactionarray");
         $postData = dataFieldValidation($amount, "Transaction Amount",$paymenttransactiondata,"transaction_amount","", $postData,"paymenttransactionarray");
         $postData = dataFieldValidation($status, "Transaction Status",$paymenttransactiondata,"transaction_status","", $postData,"paymenttransactionarray");
        $postData = dataFieldValidation($subscription_payment_mode, "Payment Mode",$paymenttransactiondata,"payment_mode_id","", $postData,"paymenttransactionarray");

        $postData = dataFieldValidation($upi, "UPI",$paymenttransactiondata,"upi","", $postData,"paymenttransactionarray");

        $postData = dataFieldValidation($phonepay, "Phone Pay",$paymenttransactiondata,"phonepay","", $postData,"paymenttransactionarray");

        $postData = dataFieldValidation($amazonpay, "Amazon Pay",$paymenttransactiondata,"amazonpay","", $postData,"paymenttransactionarray");

        $postData = dataFieldValidation($googlepay, "Google Pay",$paymenttransactiondata,"googlepay","", $postData,"paymenttransactionarray");
               
      $postData = dataFieldValidation($paytm_upi, "PayTm UPi",$paymenttransactiondata,"paytm_upi","", $postData,"paymenttransactionarray");

       $postData = dataFieldValidation($chequeno, "Cheque Number",$paymenttransactiondata,"cheque_number","", $postData,"paymenttransactionarray");

       $postData = dataFieldValidation($chequeissuedate, "Cheque Issue Date",$paymenttransactiondata,"cheque_issue_date","", $postData,"paymenttransactionarray");

       $postData = dataFieldValidation($cheque_bankname, "Cheque Bank Name",$paymenttransactiondata,"cheque_bankname","", $postData,"paymenttransactionarray");

       $postData = dataFieldValidation($cashamount, "Cash Amount",$paymenttransactiondata,"cash_amount","", $postData,"paymenttransactionarray");
     
     $postData = dataFieldValidation($personame, "Cash Person Name",$paymenttransactiondata,"cash_personname","", $postData,"paymenttransactionarray");
   
     $postData = dataFieldValidation($neftnumber, "NEFT /IMPS ",$paymenttransactiondata,"neft_number","", $postData,"paymenttransactionarray"); 
      
         
    if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
      echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
      return;
    }
            

                $createdlog=isCreatedLog($userId);
                $updatedlog=isUpdateLog($userId);
             
             if($subscription_total>0){
               $subscriptiondataarray = array_merge($postData['dbinput']['subscriptiondataarray'],$createdlog);
               $addSubscriptionid=$this->Subscription_model->Addsubscription($subscriptiondataarray);
             
             if(isset($business_package) && !empty($business_package))
                  {
                   foreach($business_package as $key=>$udata)
                    {
                      $package_id  = $udata;
                      $packagearray=array('account_id'=>$subscription_accountid,'package_id'=>$package_id,'subscription_id'=>$addSubscriptionid);
                      $AddPackages=$this->SubscriptionPackage_model->AddSubscriptionPackage($packagearray);
                     }
                 }
         

          if(strlen($razorpayorder_id)>0){
            $paymenttransactionarray = array_merge(array('subscription_id'=>$addSubscriptionid),$updatedlog);
            $paymenttransaction=$this->PaymentTransaction_model->UpdatePaymentTransaction($paymenttransactionarray,$razorpayorder_id); 
            $getTransactionOrderId=$this->PaymentTransaction_model->getTransactionOrderId($razorpayorder_id);
            $transaction_amount= $getTransactionOrderId[0]->transaction_amount;
            $transaction_status= $getTransactionOrderId[0]->transaction_status;
             }else{
        
           $createdlog=isCreatedLog($userId);
           $paymenttransactionarray = array_merge(array('subscription_id'=>$addSubscriptionid),$postData['dbinput']['paymenttransactionarray'],$createdlog);
           $paymenttransaction=$this->PaymentTransaction_model->addPaymentTransaction($paymenttransactionarray); 
           $getTransactionOrderId=$this->PaymentTransaction_model->getTransactionOrderId($order_id); 
           $transaction_amount = $getTransactionOrderId[0]->transaction_amount;
           $transaction_status = $getTransactionOrderId[0]->transaction_status;

          }
            
            }
            if($AddPackages&&$addSubscriptionid){
              if($transaction_amount>=$grandtoatal && $transaction_status=='SUCCESS'){ 
                  $status=4;
                  $statusupdatefordealclose = array_merge(array('payment_status'=>$status),$updatedlog);
                  $statusupdate=$this->Subscription_model->subscriptionUpdate($statusupdatefordealclose,$addSubscriptionid); 
                 }


         $accountdata=Subscription_model::join('accounts','accounts.id','=','accounts_subscriptions.account_id')
                     ->join('subscriptions_packages','subscriptions_packages.subscription_id','=','accounts_subscriptions.id')
                     ->join('packages','packages.id','=','subscriptions_packages.package_id')
                     ->join('user_accounts','user_accounts.account_id','=','accounts.id')
                     ->join('user_details','user_details.user_id','=','user_accounts.user_id')
                     ->join('users','users.id','=','user_details.user_id')
                     ->where('accounts_subscriptions.id','=',$addSubscriptionid)
                     ->where('user_accounts.role_id','=','2')
                     ->groupby('accounts_subscriptions.id')
                     ->get(['accounts_subscriptions.id',new raw('DATE_FORMAT(subscription_enddate, "%d-%m-%Y") as start_date'), new raw('DATE_FORMAT(subscription_enddate, "%d-%m-%Y") as end_date'), 'grand_total_amount','account_name',new raw('GROUP_CONCAT(DISTINCT(package_name)) as package_name'),'user_details.mobileno',new raw('CONCAT(user_details.first_name,"  ",user_details.last_name) as user_name'),'users.email']);
         $account_name=$accountdata[0]->account_name;
         $start_date=$accountdata[0]->start_date;
         $end_date=$accountdata[0]->end_date;
         $account_email=$accountdata[0]->email;
      

	    $subject='Subscription Activate Alert';
			$url = "https://app.doctorss.in";
			$name=$account_name;
			$body=Customdata_model::where('content_type','=','Subscription Activate Alert')->first()->content;
			$body=str_replace("{AccountName}",$name,$body);
			$body=str_replace("{StartDate}",$start_date,$body);
			$body=str_replace("{EndDate}",$end_date,$body);
			$body=str_replace("{URL}",$url,$body);
	   
     sendEmail("bizbrainz2020@gmail.com","Administrator",$account_email,$subject,$body,null);

	         echo json_encode(array('success'=>true,'message'=>SAVE_MSG));
	         return;
	      } else {
	        echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
	        return;
	      } 

    }


public function getAmountPromocode(){

            $accountid = $this->input->post("add_subscription_accountid");
            $promocode   = $this->input->post("add_subscription_promocode");
            $todaydate   = date("Y-m-d");
            $getpromocodeamount=$this->Promocode_model->PromocodeAmount($promocode,$todaydate);
            $promcodecount=Subscription_model::where('accounts_subscriptions.account_id','=',$accountid)->get();
            if(count($getpromocodeamount)>0){
                if($promcodecount[0]['promocode_id'] == $getpromocodeamount[0]['id']){
                    echo json_encode(array('success'=>false,'message'=>'This Promo Code Already Used...'));
                    return;   
                }else{
                    echo json_encode(array('success'=>true,'data'=>$getpromocodeamount));
                    return; 
                }

               }else{
               echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
               return;

            }    
 
          }


    public function SubscriptionExpiryEmailNotification(){
	
          
        $expirydate = Date('Y-m-d', strtotime('+15 days'));
        $expirynotification = $this->Subscription_model->SendExpiryEmailNotification($expirydate);
       foreach ($expirynotification as $row){
         
	        $subject='Subscription Expiry Alert';
			$url = "https://app.doctorss.in";
			$name=$account_name;
			$body=Customdata_model::where('content_type','=','Subscription Expiry Alert')->first()->content;
			$body=str_replace("{AccountName}",$name,$body);
			$body=str_replace("{StartDate}",$start_date,$body);
			$body=str_replace("{EndDate}",$end_date,$body);
			echo $body=str_replace("{URL}",$url,$body);
        sendEmail("bizbrainz2020@gmail.com","Administrator",$account_email,$subject,$body,null);
   
        }

   }


// Subscription Invoice Start //
   public Function SubscriptionInvoice($id){
       $resultdata=$this->Subscription_model->SubscriptionInvoiceById($id);
       $package = $resultdata[0]['package_id'];
        $packageslist=array();
       if($package!=null){
                  $array = explode(',', $package);
                  for($i=0;$i<count($array);$i++){
                  $packageslist[] = Packages_model::where('id','=',$array[$i])->get(['package_name','package_amount']);
               }
             }
      if ($resultdata){
             echo json_encode(array('success'=>true,'data'=>$resultdata,'packagesdata'=>$packageslist));
             return;
          }else{
            echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
            return;
          }
     
        }


public function SubscriptioninvoiceExport(){
    
         $id = $this->input->post("subscription_invoice_selectedid");
         $export_type = $this->input->post("export_type");
         $data=$this->Subscription_model->SubscriptionInvoiceById($id);
               $package = $data[0]['package_id'];
                 $packageslist=array();
             if($package!=null){
                  $array = explode(',', $package);
                  for($i=0;$i<count($array);$i++){
                      $packageslist[] = Packages_model::where('id','=',$array[$i])->get(['package_name','package_amount']);
               }
             }
     
    if(isset($export_type) && $export_type=='pdf'){
      $filename='Invoice-'.$id.'-'.date('YmdHis').'.pdf';
      $data2['data']=$data;
      $data2['packageslist']=$packageslist;
      $data2['print']=0;
      //load the view and saved it into $html variable
      $html=$this->load->view('export/invoiceExportPdf',$data2, true);
      //this the the PDF filename that user will get to download
      $pdfFilePath =FCPATH.'/assets/downloads/'.$filename;
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
      $data2['data']=$data;
      $data2['packageslist']=$packageslist;
      $data2['print']=1;
      $html=$this->load->view('export/invoiceExportPdf', $data2,true);
      echo json_encode(array('success'=>true,'message'=>DWNLOAD_MSG,'download_type'=>$export_type,'data'=>$html));
      return;
    }
  }




  // Subscription Invoice End //   

  // Subscription Receipt Start //


   public Function SubscriptionReceipt($id){

       $resultdata=$this->PaymentTransaction_model->SubscriptionReceiptById($id);
      if ($resultdata){
             echo json_encode(array('success'=>true,'data'=>$resultdata));
             return;
          }else{
            echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
            return;
          }
   
   }


public function SubscriptionreceiptExport(){
    
    $id = $this->input->post("subscription_receipt_selectedid");
    $export_type = $this->input->post("export_type");
    $data=$this->PaymentTransaction_model->SubscriptionReceiptById($id);

    if(isset($export_type) && $export_type=='pdf'){
      $filename='Receipt-'.$id.'-'.date('YmdHis').'.pdf';
      $data2['data']=$data;
      $data2['base_url']="/".base_url();
      $data2['print']=0;
      //load the view and saved it into $html variable
      $html=$this->load->view('export/receiptExportPdf',$data2,true);
      //this the the PDF filename that user will get to download
      $pdfFilePath =FCPATH.'assets/downloads/'.$filename;
      //load mPDF library
      $this->load->library('pdf');
       //generate the PDF from the given html
      $this->pdf->pdf->useSubstitutions = true;
    
     $this->pdf->pdf->WriteHTML($html);  
   
      ob_clean();
      $this->pdf->pdf->Output($pdfFilePath,"F");
      $file= 'assets/downloads/'.$filename;
      echo json_encode(array('success'=>true,'message'=>DWNLOAD_MSG,'download_type'=>$export_type,'data'=>$file));
      return;
      
    }

    if(isset($export_type) && $export_type=='print'){
      $data2['data']=$data;
      $data2['print']=1;
      $html=$this->load->view('export/receiptExportPrint',$data2,true);
      echo json_encode(array('success'=>true,'message'=>DWNLOAD_MSG,'download_type'=>$export_type,'data'=>$html));
      return;
    }
  }

  // Subscription Receipt End //


 }
?>