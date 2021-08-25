<?php
include_once(APPPATH . 'models/CommonBase_model.php');
use \Illuminate\Database\Eloquent\Model as Eloquent;
use \Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;
//error_reporting(0);
class Userdetails_model extends CommonBase_model {

	public $timestamps = false;
	protected $database = 'doctorss_master';
	protected $table = 'user_details';
	protected $primaryKey = 'id';
	protected $fillable = ['user_id', 'address_id', 'first_name', 'last_name', 'mobileno', 'dob','age' ,'gender','profile_pic_path', 'device_token', 'device_type', 'city_id', 'created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];
	

	public function user()
	{
		return $this->belongsTo('User');
	}
	
   public function addUserDetails($userdetailsarray){
		try{
			$userDetailsId = self::create($userdetailsarray)->id;
			return $userDetailsId;
		}
		catch(Exception $ex){
			throw new Exception($ex);	
		}
	}

	function updateUserDetails($data,$user_id)
	{
		try{
			
		 return self::where('user_id','=',$user_id)->Update($data); 
		
		}
		catch(Exception $ex){
			throw new Exception($ex); //return false;
		}
		
	}
	public function addressInfo() {
		return $this->hasOne('Address_model','id','address_id')->select('house_no', 'street', 'sub_area', 'area', 'landmark', 'city_id', 'state_id', 'country', 'pincode');
	}
	
	function getAuthTokenResult($auth_token){
		$authtokencount=Capsule::Select("select count(*) as count,user_id from 'user_details' where 'auth_token'='".$auth_token."'");
		return $authtokencount[0];
	}
	function getAuthToken($user_id){
		$auth_token = self::where('user_id',$user_id)->first()->auth_token;
		if(isset($auth_token) && strlen($auth_token)>0){
			return $auth_token;
		}else{
			return null;
		}
	}


	function EditProfile($id)
	{

		$listresult=self::join('users','users.id','=','user_details.user_id')
		                  ->join('address','address.id','=','user_details.address_id')
		                  ->leftjoin('cities','cities.cityid','=','address.city_id')
	                      ->leftjoin('states','states.state_id','=','address.state_id')
		                  ->where('user_details.user_id','=',$id)
		                  ->get(['user_details.first_name','user_details.last_name','users.username','users.email','users.active','user_details.mobileno','user_details.id', 'user_details.user_id','user_details.profile_pic_path','age','gender','user_details.address_id','house_no', 'street', 'area', 'landmark', 'address.city_id', 'address.state_id', 'country', 'pincode']);
		return $listresult;
	} 	
   

   function PatientList($account_id)
	{
		 $result=self::join('users','users.id','=','user_details.user_id')
		             ->join('user_accounts','user_accounts.user_id','=','user_details.user_id')
		             ->join('groups','groups.id','=','user_accounts.role_id')
		             ->where('user_accounts.account_id','=',$account_id)		             
		             ->where('user_accounts.role_id','=','6')
		             ->get(['user_details.user_id',new raw('CONCAT(user_details.first_name,"  ",user_details.last_name) as user_name')]);
		return $result;
	}

 function DoctorList($account_id)
	{
		 $result=self::join('users','users.id','=','user_details.user_id')
		             ->join('user_accounts','user_accounts.user_id','=','user_details.user_id')
		             ->join('groups','groups.id','=','user_accounts.role_id')
		             ->where('user_accounts.account_id','=',$account_id)
		             ->where('user_accounts.role_id','=','4')
		             ->where('users.active','=','1')
		             ->get(['user_details.user_id',new raw('CONCAT(user_details.first_name,"  ",user_details.last_name) as user_name','consultation_fee')]);
		return $result;
	}


function SearchEmployee($employee_name,$employee_designation,$account_role,$account_id)
{     

		$result=self::Where( function($result) use ($employee_name,$employee_designation){
			if(count($employee_name)>0 && (!is_null($employee_name))  && (!empty($employee_name))){
				$result->whereRaw("user_details.first_name  LIKE '%$employee_name%' OR user_details.last_name LIKE '%$employee_name%'");

			} 
			if(count($employee_designation)>0 && (!is_null($employee_designation))  && (!empty($employee_designation))){
				$result->whereRaw("user_accounts.role_id ='".$employee_designation."'");
				
			} 
			
		   });
		 $searchData=$result
		 ->join('users','users.id','=','user_details.user_id')
		 ->join('user_accounts','user_accounts.user_id','=','user_details.user_id')
		 ->join('groups','groups.id','=','user_accounts.role_id')
		 ->join('address','address.id','=','user_details.address_id')
		 ->leftjoin('cities','cities.cityid','=','address.city_id')
	     ->leftjoin('states','states.state_id','=','address.state_id')
		 ->whereNotIn('user_accounts.role_id',[1,2,3,4,6])
		 ->where('user_accounts.account_id','=',$account_id)
		 ->get(['user_details.user_id',new raw('CONCAT(user_details.first_name,"  ",user_details.last_name) as name'),'users.email','users.active','users.username','user_details.id','user_details.mobileno','user_details.profile_pic_path','user_details.address_id',new raw('CONCAT(address.house_no,",  ",address.street,", ",address.area,", ",address.landmark,", ",cities.cityname,", ",states.state_name,", ",address.pincode) as address,designation')]);

     return $searchData;	
		
	} 
 
	public function EditEmployees($id)
	{
		$listresult = self::join('address','address.id','=','user_details.address_id')
		->join('users','users.id','=','user_details.user_id')
		->join('user_accounts','user_accounts.user_id','=','user_details.user_id')
        ->where('user_details.id','=',$id)
		->get(['user_details.first_name','user_details.last_name','users.username','users.email','users.active','user_accounts.role_id','user_details.mobileno','user_details.id', 'user_details.user_id','user_details.profile_pic_path','user_details.age','dob','user_details.gender','user_details.address_id','house_no', 'street', 'area', 'landmark', 'address.city_id', 'state_id', 'country', 'pincode']);
		
		return $listresult;
		
	}

function DeleteEmployees($id)
	{
	
			$deleteresult= self::where('user_details.id','=',$id)->delete();
		     return$deleteresult; 
	}


function DeleteUserdetails($user_id)
	{
	
			$deleteresult= self::where('user_details.user_id','=',$user_id)->delete();
		     return$deleteresult; 
	}

function GetDataForSuperAdminLogin($id)
	{
		 $result=self::join('users','users.id','=','user_details.user_id')
		             ->join('user_accounts','user_accounts.user_id','=','user_details.user_id')
		             ->join('groups','groups.id','=','user_accounts.role_id')
		             ->where('user_details.user_id','=',$id)
		             ->get(['user_details.user_id',new raw('CONCAT(user_details.first_name,"  ",user_details.last_name) as user_name'),'profile_pic_path','email','username','name']);
		return $result;
	}

function SearchPatientListForSuperAdmin($search_patient_name,$search_mobile_no)
{     

		$result=self::Where( function($result) use ($search_patient_name,$search_mobile_no){
			if(count($search_patient_name)>0 && (!is_null($search_patient_name))  && (!empty($search_patient_name))){
				$result->whereRaw("user_details.first_name like'%$search_patient_name%' OR user_details.last_name like'%$search_patient_name%'");

			// } else if(count($search_patient_name)>0 && (!is_null($search_patient_name))  && (!empty($search_patient_name))){
			// 	$result->whereRaw("user_details.last_name like'%$search_patient_name%'");
				
			} else if(count($search_mobile_no)>0 && (!is_null($search_mobile_no))  && (!empty($search_mobile_no))){
				$result->whereRaw("user_details.mobileno  like'%".$search_mobile_no."%'");
				
			} 
		 });
		 $searchData=$result
		             ->join('users','users.id','=','user_details.user_id')
		             ->join('user_accounts','user_accounts.user_id','=','user_details.user_id')
		             ->join('groups','groups.id','=','user_accounts.role_id')
		             ->where('user_accounts.role_id','=','6')
		             ->get(['user_details.user_id',new raw('CONCAT(user_details.first_name,"  ",user_details.last_name) as user_name'),'mobileno','mobileno',  new raw('DATE_FORMAT(user_details.dob, "%d-%m-%Y") as dob'),'age' ,'gender','profile_pic_path']);

     return $searchData;	
		
	} 

	// Front view For Doctors List 

	function DoctorListForFrontview($customerdb,$loctions,$specialization)
	{

		$result=self::Where( function($result) use ($loctions,$specialization){
			if((!is_null($loctions))  && (!empty($loctions))){
				$result->whereRaw("businessadd.city_id = ".$loctions."");

			} 
		 if( (!is_null($specialization))  && (!empty($specialization))){
				$result->whereRaw("doctor_details.specialization_id =".$specialization."");
				
			} 
		 });
		 $resultdata=$result->join('users','users.id','=','user_details.user_id')
		             ->join('user_accounts','user_accounts.user_id','=','user_details.user_id')
		             ->join('groups','groups.id','=','user_accounts.role_id')
		             ->join('accounts','accounts.id','=','user_accounts.account_id')
		             -> join('address as businessadd','businessadd.id','=','accounts.business_address_id')
	                 ->leftjoin('cities','cities.cityid','=','businessadd.city_id')
	                 ->leftjoin('states','states.state_id','=','businessadd.state_id')
		             ->join( "$customerdb.doctor_details",'doctor_details.user_id','=','user_details.user_id')
		             ->join('specializations','specializations.id','=','doctor_details.specialization_id')
		             ->where('user_accounts.role_id','=','4')
		             ->where('users.active','=','1')
		             ->get(['user_details.user_id','user_accounts.account_id',new raw('CONCAT(user_details.first_name,"  ",user_details.last_name) as doctor_name'),'gender','profile_pic_path','account_name','doctor_details.designation','doctor_details.consultation_fee','doctor_details.specialist','doctor_details.education','specialization',new raw(" Concat(businessadd.house_no,', ',businessadd.street,', ',businessadd.area,', ',businessadd.landmark,', ',cities.cityname,', ',states.state_name,', ',businessadd.pincode) as business_address")]);
		    return $resultdata;
	}

	public function getCountofDoctors()
    {
         $result=self::join('users','users.id','=','user_details.user_id')
		             ->join('user_accounts','user_accounts.user_id','=','user_details.user_id')
		             ->join('groups','groups.id','=','user_accounts.role_id')
		             ->where('user_accounts.role_id','=','4')
		             ->where('users.active','=','1')
		             ->count();
		    return $result;
    }

    public function DoctorDetailsByUserId($user_id,$customerdb){
		   $result=self::join('users','users.id','=','user_details.user_id')
		             ->join('user_accounts','user_accounts.user_id','=','user_details.user_id')
		             ->join('groups','groups.id','=','user_accounts.role_id')
		             ->join('accounts','accounts.id','=','user_accounts.account_id')
		             -> join('address as businessadd','businessadd.id','=','accounts.business_address_id')
	                 ->leftjoin('cities','cities.cityid','=','businessadd.city_id')
	                 ->leftjoin('states','states.state_id','=','businessadd.state_id')
		             ->join( "$customerdb.doctor_details",'doctor_details.user_id','=','user_details.user_id')
		             ->join('specializations','specializations.id','=','doctor_details.specialization_id')
		             ->where('user_accounts.role_id','=','4')
		             ->where('users.active','=','1')
		             ->where('user_details.user_id','=',$user_id)
		             ->get(['user_details.user_id','user_accounts.account_id',new raw('CONCAT(user_details.first_name,"  ",user_details.last_name) as doctor_name'),'gender','profile_pic_path','account_name','doctor_details.designation','doctor_details.consultation_fee','doctor_details.specialist','doctor_details.education','specialization',new raw(" Concat(businessadd.house_no,', ',businessadd.street,', ',businessadd.area,', ',businessadd.landmark,', ',cities.cityname,', ',states.state_name,', ',businessadd.pincode) as business_address")]);
		    return $result;
          }


    function DoctorForhomepage($customerdb)
	     {
		 $result=self::join('users','users.id','=','user_details.user_id')
		             ->join('user_accounts','user_accounts.user_id','=','user_details.user_id')
		             ->join('groups','groups.id','=','user_accounts.role_id')
		             ->join('accounts','accounts.id','=','user_accounts.account_id')
		             -> join('address as businessadd','businessadd.id','=','accounts.business_address_id')
	                 ->leftjoin('cities','cities.cityid','=','businessadd.city_id')
	                 ->leftjoin('states','states.state_id','=','businessadd.state_id')
		             ->join( "$customerdb.doctor_details",'doctor_details.user_id','=','user_details.user_id')
		             ->join('vspecializations','specializations.id','=','doctor_details.specialization_id')
		             ->where('user_accounts.role_id','=','4')
		             ->where('users.active','=','1')
		             ->get(['user_details.user_id','user_accounts.account_id',new raw('CONCAT(user_details.first_name,"  ",user_details.last_name) as doctor_name'),'gender','profile_pic_path','account_name','doctor_details.designation','doctor_details.consultation_fee','doctor_details.specialist','doctor_details.education','specialization',new raw(" Concat(businessadd.house_no,', ',businessadd.street,', ',businessadd.area,', ',businessadd.landmark,', ',cities.cityname,', ',states.state_name,', ',businessadd.pincode) as business_address")]);
		    return $result;
	    }


}

?>