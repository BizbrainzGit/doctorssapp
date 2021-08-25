<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;
class SubscriptionPackage_model extends Eloquent{
	
    public $timestamps = false;
    protected $table = "subscriptions_packages"; // table name
    public $primaryKey = 'id';
    protected $fillable = [ 'account_id', 'package_id', 'subscription_id'];

	public function AddSubscriptionPackage($packageArray)
	{
		$addresult=self::create($packageArray);
		return $addresult;
	} 
	
	public function deleteBPackage($business_id)
	{
		$deleteresult=self::where('business_id','=',$business_id)->delete();
		return $deleteresult;
	}

	






	
}
