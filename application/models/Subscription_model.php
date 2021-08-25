<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent ;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;
class Subscription_model extends Eloquent {
      public $timestamps=false;
      protected $guarded = array();
      protected $table="accounts_subscriptions";
      public $PrimaryKey='id';
      protected $Filables=['account_id', 'subscription_startdate', 'subscription_enddate', 'payment_status', 'promocode_id', 'discount_amount', 'package_total_amount', 'sub_total_amount', 'gst_amount', 'igst_amount', 'cgst_amount', 'sgst_amount', 'grand_total_amount', 'created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];
		
  function Addsubscription($subscriptionarray){
		$addresult=self::create($subscriptionarray);
		$subscriptionid=$addresult->id;
		return $subscriptionid;
	} 



 function subscriptionUpdate($subscriptionarray,$id){
		$updatedsubscription=self::where('accounts_subscriptions.id','=',$id)
		                         ->update($subscriptionarray);
		return $updatedsubscription;
	}

 function DeleteSubscription($id){
	$deleteresult=self::where('id','=',$id)->delete();
    return $deleteresult;
        
        }



 function SearchSubscriptions(){
             
		$searchagentData=self::join('accounts','accounts.id','=','accounts_subscriptions.account_id')
		    ->join('subscriptions_packages','subscriptions_packages.subscription_id','=','accounts_subscriptions.id')
		    ->join('packages','packages.id','=','subscriptions_packages.package_id')
		    ->groupby('accounts_subscriptions.id')
		    ->get(['accounts_subscriptions.id',new raw('DATE_FORMAT(subscription_startdate, "%d-%m-%Y") as start_date'), new raw('DATE_FORMAT(subscription_enddate, "%d-%m-%Y") as end_date'),'discount_amount', 'package_total_amount', 'sub_total_amount', 'gst_amount', 'igst_amount', 'cgst_amount', 'sgst_amount', 'grand_total_amount','account_name',new raw('GROUP_CONCAT(DISTINCT(package_name)) as package_name')]);
		return $searchagentData;
 	
	}

	function SendExpiryEmailNotification($expirydate){
             // echo $expirydate;
		$SendEmailNotification=self::join('accounts','accounts.id','=','accounts_subscriptions.account_id')
                     ->join('subscriptions_packages','subscriptions_packages.subscription_id','=','accounts_subscriptions.id')
                     ->join('packages','packages.id','=','subscriptions_packages.package_id')
                     ->join('user_accounts','user_accounts.account_id','=','accounts.id')
                     ->join('user_details','user_details.user_id','=','user_accounts.user_id')
                     ->join('users','users.id','=','user_details.user_id')
                     ->where('user_accounts.role_id','=','2')
                     ->where('accounts_subscriptions.subscription_enddate','=',$expirydate)
                     ->groupby('accounts_subscriptions.id')
                     ->get(['accounts_subscriptions.id',new raw('DATE_FORMAT(subscription_startdate, "%d-%m-%Y") as start_date'), new raw('DATE_FORMAT(subscription_enddate, "%d-%m-%Y") as end_date'), 'grand_total_amount','account_name',new raw('GROUP_CONCAT(DISTINCT(package_name)) as package_name'),'user_details.mobileno',new raw('CONCAT(user_details.first_name,"  ",user_details.last_name) as user_name'),'users.email']);
		return $SendEmailNotification;
	}

	public function SubscriptionInvoiceById($id){
          
          $result=self::join('accounts','accounts.id','=','accounts_subscriptions.account_id')
		    ->join('subscriptions_packages','subscriptions_packages.subscription_id','=','accounts_subscriptions.id')
		    ->join('packages','packages.id','=','subscriptions_packages.package_id')
		    ->join('address as billingadd','billingadd.id','=','accounts.billing_address_id')
		    ->leftjoin('cities as ct','ct.cityid','=','billingadd.city_id')
	        ->leftjoin('states as st','st.state_id','=','billingadd.state_id')
		    ->where('accounts_subscriptions.id','=',$id)
		    ->groupby('accounts_subscriptions.id')
		     ->get(['accounts_subscriptions.id',new raw('DATE_FORMAT(subscription_startdate, "%d-%m-%Y") as start_date'), new raw('DATE_FORMAT(subscription_enddate, "%d-%m-%Y") as end_date'),'discount_amount', 'package_total_amount', 'sub_total_amount', 'gst_amount', 'igst_amount', 'cgst_amount', 'sgst_amount', 'grand_total_amount','account_name',new raw(" Concat(billingadd.house_no,', ',billingadd.street,', <br> ',billingadd.area,', ',billingadd.landmark,', ',ct.cityname,',<br> ',st.state_name,', ',billingadd.pincode) as billing_address"),new raw('GROUP_CONCAT(DISTINCT(package_id)) as package_id'),new raw('DATE_FORMAT(accounts_subscriptions.created_on, "%d-%m-%Y") as invoice_date') ]);
		    return $result;
	}


} ?>