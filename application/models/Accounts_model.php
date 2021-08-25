<?php 
 
use \Illuminate\Database\Eloquent\Model as Eloquent ;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;
 
class Accounts_model extends Eloquent {	
    public $timestamps = false;
    protected $table = "accounts"; // table name
    public $primaryKey = 'id';
    protected $fillable = ['account_name','account_shortname','logo','no_of_doctors','status','dbname','encrypted_id','business_address_id','billing_address_id','created_ip','created_by','created_on','modified_ip','modified_by','modified_on'];

	public function addAccount($accountdetailsarray){
		$addresult=self::create($accountdetailsarray);
		$addresultid=$addresult->id;
		return $addresultid;
	}
public function accountById($id)
	{	
	  return Accounts_model::find($id);
	}

    function SearchAccounts()
	{
	 
            $listresult=self::join('address as businessadd','businessadd.id','=','accounts.business_address_id')
	                    ->join('address as billingadd','billingadd.id','=','accounts.billing_address_id')
	                    ->leftjoin('cities','cities.cityid','=','businessadd.city_id')
	                    ->leftjoin('states','states.state_id','=','businessadd.state_id')
	                    ->leftjoin('cities as ct','ct.cityid','=','billingadd.city_id')
	                    ->leftjoin('states as st','st.state_id','=','billingadd.state_id')
	                  ->where('accounts.id','!=',0)
	                  ->get(['accounts.id','accounts.account_name','accounts.status','accounts.dbname','no_of_doctors','accounts.encrypted_id','accounts.business_address_id',new raw(" Concat(businessadd.house_no,', ',businessadd.street,', ',businessadd.area,', ',businessadd.landmark,', ',cities.cityname,', ',states.state_name,', ',businessadd.pincode) as business_address"),new raw(" Concat(billingadd.house_no,', ',billingadd.street,', ',billingadd.area,', ',billingadd.landmark,', ',ct.cityname,', ',st.state_name,', ',billingadd.pincode) as billing_address")]);
		return $listresult;
		
	} 

 function EditAccount($id)
	   {
	    $editresult=self::join('address as businessadd','businessadd.id','=','accounts.business_address_id')
	                    ->join('address as billingadd','billingadd.id','=','accounts.billing_address_id')
	                    ->leftjoin('cities','cities.cityid','=','businessadd.city_id')
	                    ->leftjoin('states','states.state_id','=','businessadd.state_id')
	                    ->leftjoin('cities as ct','ct.cityid','=','billingadd.city_id')
	                    ->leftjoin('states as st','st.state_id','=','billingadd.state_id')
	                    ->where('accounts.id','=',$id)
		                ->get(['accounts.id as id','account_name','account_shortname','logo','no_of_doctors','accounts.status','dbname','encrypted_id','business_address_id','billing_address_id','businessadd.house_no', 'businessadd.street', 'businessadd.area', 'businessadd.landmark', 'businessadd.city_id', 'businessadd.state_id','businessadd.pincode','billingadd.house_no as bill_house_no', 'billingadd.street as bill_street', 'billingadd.area as bill_area', 'billingadd.landmark as bill_landmark', 'billingadd.city_id as bill_city_id', 'billingadd.state_id as bill_state_id','billingadd.pincode as bill_pincode']);
		return $editresult;
	   }
function AccountUpdate($accountarray,$id)
 	  {

	   $resultupdate=self::where('accounts.id','=',$id)->update($accountarray);
       return $resultupdate;
     }

function DeleteAccount($id)
    {
	$deleteresult=self::where('id','=',$id)->delete();
       return $deleteresult;
    }   

  public function GetAccountList()
	{	
			$result=self::where('status','=',"1")->get();
             return $result;
	} 

public function GetAccountDatabaseById($accountid)
	{	
			$result=self::where('accounts.id','=',$accountid)->where('status','=',"1")->get();
             return $result;
	} 



	public function LoginAccountById($id){
	        $loginresult=self::join('user_accounts','user_accounts.account_id','=','accounts.id')
	                          ->join('users','users.id','=','user_accounts.user_id')
	                          ->join('user_details','user_details.user_id','=','users.id') 
	                          ->join('groups','groups.id','=','user_accounts.role_id') 
	                          ->where('accounts.id','=',$id)
	                          ->where('user_accounts.role_id','=',2)
	                          ->get(['accounts.id','user_accounts.user_id','user_details.first_name','user_details.last_name','user_details.profile_pic_path','account_name','account_shortname','status','encrypted_id','groups.name','email','username']);
	        return $loginresult;
	}


	public function ActiveAccountsCountForSuperAdmin(){
		$result=self::where('status','=',"1")->count();
             return $result;
	}
	public function InAccountsCountForSuperAdmin(){
		$result=self::where('status','=',"2")->count();
             return $result;
	}


    function AccountDataById($accountid)
	{
	 
            $result=self::join('user_accounts','user_accounts.account_id','=','accounts.id')
	                    ->join('users','users.id','=','user_accounts.user_id')
	                    ->join('user_details','user_details.user_id','=','users.id') 
	                    ->join('address as businessadd','businessadd.id','=','accounts.business_address_id')
	                    ->join('address as billingadd','billingadd.id','=','accounts.billing_address_id')
	                    ->leftjoin('cities','cities.cityid','=','businessadd.city_id')
	                    ->leftjoin('states','states.state_id','=','businessadd.state_id')
	                    ->leftjoin('cities as ct','ct.cityid','=','billingadd.city_id')
	                    ->leftjoin('states as st','st.state_id','=','billingadd.state_id')
	                    ->where('accounts.id','=',$accountid)
	                    ->where('user_accounts.role_id','=',2)
	                    ->get(['accounts.id','accounts.account_name','accounts.status','accounts.dbname','no_of_doctors','accounts.encrypted_id','accounts.business_address_id',new raw(" Concat(businessadd.house_no,', ',businessadd.street,', ',businessadd.area,', ',businessadd.landmark,',<br> ',cities.cityname,', ',states.state_name,', ',businessadd.pincode) as business_address"),new raw(" Concat(billingadd.house_no,', ',billingadd.street,', ',billingadd.area,', ',billingadd.landmark,', <br> ',ct.cityname,', ',st.state_name,', ',billingadd.pincode) as billing_address"),new raw(" Concat(mobileno,', ',email) as mobilenoemail"),'logo']);
		return $result;
		
	} 




	   function CliniclistForFrontView()
	{
	 
            $listresult=self::join('address as businessadd','businessadd.id','=','accounts.business_address_id')
	                    ->join('address as billingadd','billingadd.id','=','accounts.billing_address_id')
	                    ->leftjoin('cities','cities.cityid','=','businessadd.city_id')
	                    ->leftjoin('states','states.state_id','=','businessadd.state_id')
	                    ->leftjoin('cities as ct','ct.cityid','=','billingadd.city_id')
	                    ->leftjoin('states as st','st.state_id','=','billingadd.state_id')
	                     ->where('accounts.id','!=',0)
	                    ->get(['accounts.id','accounts.account_name','accounts.status','accounts.dbname','no_of_doctors','accounts.encrypted_id','accounts.business_address_id',new raw(" Concat(businessadd.house_no,', ',businessadd.street,', ',businessadd.area,', ',businessadd.landmark,', ',cities.cityname,', ',states.state_name,', ',businessadd.pincode) as business_address"),new raw(" Concat(billingadd.house_no,', ',billingadd.street,', ',billingadd.area,', ',billingadd.landmark,', ',ct.cityname,', ',st.state_name,', ',billingadd.pincode) as billing_address"),'logo']);
		return $listresult;
		
	} 

}
?>