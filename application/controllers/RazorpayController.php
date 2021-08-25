<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/CommonBaseController.php');
error_reporting(1);
ob_start();
use Illuminate\Database\Query\Expression as raw;
use \Illuminate\Database\Capsule\Manager as Capsule;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
class RazorpayController extends CommonBaseController {
	
	public function __construct()
	{
		parent::__construct();
		 $this->load->library(array('form_validation','ValidationTypes','excel','session','ion_auth'));
		 $this->load->helper(array('url','html','form','util_helper','language'));
		 $this->load->database();
		 $this->load->model('Accounts_model');
		 $this->load->model('PaymentTransaction_model');

    }

	public function orderRazorPayGeneration(){
		
		$currency_code = $this->config->item('DISPLAY_CURRENCY');
		$amount = round($this->input->post('merchant_total'),0);
		$key_id = $this->config->item('RAZOR_KEY_ID');
		$key_secret = $this->config->item('RAZOR_KEY_SECRET');
		$merchant_order_id = $this->input->post('merchant_order_id');
		$api = new Api($key_id, $key_secret);
		//session_start();
		try
		{
			$razorpayOrder  = $api->order->create(array(
				'receipt' => $merchant_order_id,
				'amount' => $amount,
				'payment_capture' => 1,
				'currency' => $currency_code
				)
			  );
			
			$razorpayOrderId = $razorpayOrder['id'];
			//$_SESSION['razorpay_order_id'] = $razorpayOrderId;
			echo json_encode(array('success'=>true,'message'=>$razorpayOrderId));
			return;
		}
		catch(SignatureVerificationError $e)
		{
			$error = 'Razorpay Order Error : ' . $e->getMessage();
			echo json_encode(array('success'=>false,'message'=>$e->getMessage()));
			return;
		}
		
	}
	
	// callback method
	public function callback(){
	
		if (!empty($this->input->post('razorpay_payment_id')) && !empty($this->input->post('merchant_order_id'))) {
			$razorpay_payment_id = $this->input->post('razorpay_payment_id');
			$razorpay_signature = $this->input->post('razorpay_signature');
            $merchant_order_id = $this->input->post('merchant_order_id');
			$razorpay_order_id = $this->input->post('razorpay_order_id');
            $currency_code = $this->config->item('DISPLAY_CURRENCY');
            $amount = $this->input->post('merchant_total');
			$key_id = $this->config->item('RAZOR_KEY_ID');
			$key_secret = $this->config->item('RAZOR_KEY_SECRET');
			$api = new Api($key_id, $key_secret);
			$error='Transaction Failed';
			$success=true;
			/*$payment = $api->payment->fetch($this->input->post('razorpay_payment_id'));
			$paymentResult=$payment->capture(array('amount' => $amount));
			
			// echo '<pre>';print_r($paymentResult);
			$status=$paymentResult->status;
			$pay_order_id=$paymentResult->description;
			$payment_amount=$paymentResult->amount;
			$email=$paymentResult->email;
			$contact=$paymentResult->contact;
			$card=isset($paymentResult->card)? $paymentResult->card:null;
			if(isset($card)&&count($card)>0){
				$id=$paymentResult->card->id;
				$last4=$paymentResult->card->last4;
				$network=$paymentResult->card->network;
				$type=$paymentResult->card->type;
				$name=$paymentResult->card->name;
			}*/
			
			try
			{
				// Please note that the razorpay order ID must
				// come from a trusted source (session here, but
				// could be database or something else)
				$attributes = array(
					'razorpay_order_id' => $razorpay_order_id,
					'razorpay_payment_id' => $razorpay_payment_id,
					'razorpay_signature' =>$razorpay_signature
				);
		
				$api->utility->verifyPaymentSignature($attributes);
			}
			catch(SignatureVerificationError $e)
			{
				$success = false;
				$error = 'Razorpay Error : ' . $e->getMessage();
			}
			$Array=array('amount'=>$amount,'description'=>$merchant_order_id,'razorpay_payment_id'=>$razorpay_payment_id,'razorpay_signature'=>$razorpay_signature,'razorpay_order_id'=>$razorpay_order_id);
			if ($success === true)
			{
				$this->success($Array);	
			}
			else
			{
				$this->failed($Array);
			}
			
		}else{
			echo 'An error occured. Contact site administrator, please!';
		}
	} 
    public function success($successArray) {
        $data['title'] = 'Payment Transaction Successfully';
		$data['message'] ='Thanks for the Payment.';
		//$data['status']=$successArray['status'];
		$data['amount']=$successArray['amount'];
		//$data['email']=$successArray['email'];
		//$data['contact']=$successArray['contact'];
		$data['pay_order_id']=$successArray['description'];
		$data['razorpay_payment_id']=$successArray['razorpay_payment_id'];
		$data['razorpay_signature']=$successArray['razorpay_signature'];
		$data['razorpay_order_id']=$successArray['razorpay_order_id'];
		 //$status=$successArray['status'];
	     $amount=$successArray['amount']/100;
	     $status='SUCCESS';
    
           $postData=array();
          $paymenttransactiondata = [];
        
         $postData = dataFieldValidation($data['pay_order_id'], "Order Id",$paymenttransactiondata,"order_id","", $postData,"paymenttransactionarray");
         $postData = dataFieldValidation($amount, "Transaction Amount",$paymenttransactiondata,"transaction_amount","", $postData,"paymenttransactionarray");
         $postData = dataFieldValidation($status, "Transaction Status",$paymenttransactiondata,"transaction_status","", $postData,"paymenttransactionarray");
		 $postData = dataFieldValidation($data['razorpay_payment_id'], "Payment ID",$paymenttransactiondata,"razorpay_payment_id","", $postData,"paymenttransactionarray");
		  $postData = dataFieldValidation($data['razorpay_signature'], "RazorPay Signature",$paymenttransactiondata,"razorpay_signature","", $postData,"paymenttransactionarray");
          $postData = dataFieldValidation($data['razorpay_order_id'], "RazorPay Order Id",$paymenttransactiondata,"razorpay_order_id","", $postData,"paymenttransactionarray");
		 $userId = $this->ion_auth->get_user_id();
          $createdlog=isCreatedLog($userId);
         $paymenttransactionarray = array_merge($postData['dbinput']['paymenttransactionarray'],$createdlog);
         $Packagesupdate=$this->PaymentTransaction_model->addPaymentTransaction($paymenttransactionarray); 

        $this->load->view('success', $data);
    }  
    public function failed($failureArray){
        $data['title'] = 'Transaction Failed | BizBrainz';
		$data['message'] ='Your Transaction failed..';
		//$data['status']=$failureArray['status'];
		$data['amount']=$failureArray['amount'];
		//$data['email']=$failureArray['email'];
		//$data['contact']=$failureArray['contact'];
		$data['pay_order_id']=$failureArray['description'];
		$data['razorpay_payment_id']=$failureArray['razorpay_payment_id'];
        $data['razorpay_signature']=$failureArray['razorpay_signature'];
		$data['razorpay_order_id']=$failureArray['razorpay_order_id'];
         //$status=$failureArray['status'];
	     $amount=$failureArray['amount']/100;
	     
	      $status='FAILURE';
           $postData=array();
          $paymenttransactiondata = [];
    
         $postData = dataFieldValidation($data['pay_order_id'], "Order Id",$paymenttransactiondata,"order_id","", $postData,"paymenttransactionarray");
         $postData = dataFieldValidation($amount, "Transaction Amount",$paymenttransactiondata,"transaction_amount","", $postData,"paymenttransactionarray");
         $postData = dataFieldValidation($status, "Transaction Status",$paymenttransactiondata,"transaction_status","", $postData,"paymenttransactionarray");
		 $postData = dataFieldValidation($data['razorpay_payment_id'], "Payment ID",$paymenttransactiondata,"razorpay_payment_id","", $postData,"paymenttransactionarray");
		 $postData = dataFieldValidation($data['razorpay_signature'], "RazorPay Signature",$paymenttransactiondata,"razorpay_signature","", $postData,"paymenttransactionarray");
		 $postData = dataFieldValidation($data['razorpay_order_id'], "RazorPay Order Id",$paymenttransactiondata,"razorpay_order_id","", $postData,"paymenttransactionarray");
         $userId = $this->ion_auth->get_user_id();
          $createdlog=isCreatedLog($userId); 
         $paymenttransactionarray = array_merge($postData['dbinput']['paymenttransactionarray'],$createdlog);
         $Packagesupdate=$this->PaymentTransaction_model->addPaymentTransaction($paymenttransactionarray); 

           $this->load->view('failure', $data);

    }

} 
?>
