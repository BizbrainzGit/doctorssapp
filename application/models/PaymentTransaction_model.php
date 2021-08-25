<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent ;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;
class PaymentTransaction_model extends Eloquent{
    public $timestamps = false;
    protected $table = "payment_transactions"; // table name
    public $primaryKey = 'id';
    protected $fillable = [ 'subscription_id', 'order_id', 'razorpay_order_id', 'razorpay_payment_id', 'razorpay_signature', 'transaction_amount', 'transaction_status', 'payment_mode_id', 'upi', 'phonepay', 'amazonpay', 'googlepay', 'paytm', 'cheque_number', 'cheque_issue_date', 'cheque_bankname', 'cheque_photo', 'cash_amount', 'cash_personname','neft_number', 'created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];

	public function addPaymentTransaction($paymentArray)
	{
		$addresult=self::create($paymentArray);
		return $addresult;
	} 
	
  public function UpdatePaymentTransaction($paymenttransactionarray,$order_id){
	    $resultupdate=self::where('order_id','=',$order_id)->update($paymenttransactionarray);
        return $resultupdate;

	}

public function getTransactionOrderId($order_id){
      $getresult=self::where('order_id','=',$order_id)->get(['transaction_amount','transaction_status','order_id']);
        return $getresult;
	}

	public function getTransactionTotalAmount($payments_id){

	    $getresult=self::where('business_payments_id','=',$payments_id)->where('transaction_status','=',"SUCCESS")->get([new raw('SUM(payment_transactions.transaction_amount) as transaction_amount')]);
        return $getresult;

	}


	public function TodayAmount($today){
	   $getresult=self::where('created_on','=',$today)->where('transaction_status','=',"SUCCESS")->sum('transaction_amount');;
        return $getresult;

	}
	public function TotalAmount($month){
	    $getresult=self::where(new raw("(DATE_FORMAT(created_on,'%Y-%m'))"),'=',$month)->where('transaction_status','=',"SUCCESS")->sum('transaction_amount');;
        return $getresult;

	}

	public function SubscriptionReceiptById($id){
          
          $result=self::join('accounts_subscriptions','accounts_subscriptions.id','=','payment_transactions.subscription_id')
            ->join('accounts','accounts.id','=','accounts_subscriptions.account_id')
		    ->join('subscriptions_packages','subscriptions_packages.subscription_id','=','accounts_subscriptions.id')
		    ->join('packages','packages.id','=','subscriptions_packages.package_id')
		    ->join('address as billingadd','billingadd.id','=','accounts.billing_address_id')
		    ->leftjoin('cities as ct','ct.cityid','=','billingadd.city_id')
	        ->leftjoin('states as st','st.state_id','=','billingadd.state_id')
	        ->leftjoin('payment_mode','payment_mode.id','=','payment_transactions.payment_mode_id')
		    ->where('accounts_subscriptions.id','=',$id)
		    ->groupby('accounts_subscriptions.id')
		     ->get(['accounts_subscriptions.id',new raw('DATE_FORMAT(subscription_startdate, "%d-%m-%Y") as start_date'), new raw('DATE_FORMAT(subscription_enddate, "%d-%m-%Y") as end_date'),'discount_amount', 'package_total_amount', 'sub_total_amount', 'gst_amount', 'igst_amount', 'cgst_amount', 'sgst_amount', 'grand_total_amount','account_name',new raw(" Concat(billingadd.house_no,', ',billingadd.street,',',billingadd.area,', ',billingadd.landmark,', ',ct.cityname,',',st.state_name,', ',billingadd.pincode) as billing_address"),new raw('GROUP_CONCAT(DISTINCT(package_id)) as package_id'),'order_id','transaction_amount', 'transaction_status','paymentmode_name', new raw('DATE_FORMAT(payment_transactions.created_on, "%d-%m-%Y") as receipt_date')]);
		    return $result;
	}
	

}
?>