<?php
// include_once(APPPATH . 'models/customerdb/Base_model.php');
use \Illuminate\Database\Eloquent\Model as Eloquent;
use \Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;
class PatientDetails_model extends Eloquent {
	public $timestamps = false;
	protected $table = 'patient_details';
	protected $primaryKey = 'id';
	protected $fillable = ['user_id','height','weight','blood_group','blood_prusser','pulse','allergy','diet', 'created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];
	
	public function addPatientDetails($patientdetailsarray){
		$addresult=self::create($patientdetailsarray);
		return $addresult;
	}

	function SearchPatients($account_id)
	{
		$result=self::Where(function($result) use ($userid){
			if((!is_null($account_id)) && (!empty($account_id))){
				$result->whereRaw("user_accounts.account_id ='".$account_id."'");
			}
		   });
		 $searchData=$result
		  ->join("user_details",'user_details.user_id','=','patient_details.user_id')
		  ->join("user_accounts",'user_accounts.user_id','=','user_details.user_id')
	      ->join("users",'users.id','=','user_details.user_id')
	      ->join("address",'address.id','=','user_details.address_id')
	      ->leftjoin("cities",'cities.cityid','=','address.city_id')
	      ->leftjoin("states",'states.state_id','=','address.state_id')
	      ->where('user_accounts.account_id','=',$account_id)
		  ->get(['user_details.user_id','users.active','users.username',new raw(" Concat(user_details.first_name,' ',user_details.last_name) as name"),'user_details.mobileno','user_details.age','user_details.gender','blood_group','height',new raw(" Concat(address.house_no,', ',address.street,', ',address.area,', ',address.landmark,', ',cities.cityname,', ',states.state_name,', ',address.pincode) as address")]);
     return $searchData;
	
	}


	function EditPatient($id)
	{
	      $result=self::where('patient_details.user_id','=',$id)
		              ->join("user_details",'user_details.user_id','=','patient_details.user_id')
		              ->join("users",'users.id','=','user_details.user_id')
		              ->join("address",'address.id','=','user_details.address_id')
		              ->leftjoin("cities",'cities.cityid','=','address.city_id')
		              ->leftjoin("states",'states.state_id','=','address.state_id')
		              ->get(['user_details.user_id','user_details.address_id','user_details.first_name','user_details.last_name','user_details.mobileno','user_details.age','user_details.gender','user_details.profile_pic_path','patient_details.user_id','height','blood_group','weight','blood_prusser','pulse','allergy','diet','address.house_no','address.street','address.area','address.landmark','address.city_id','address.state_id','address.pincode']);
		return $result;		

	} 	

	function updatePatientDetails($data,$id)
	{   

		$addresult=self::where('user_id','=',$id)->Update($data);
		return $addresult;

		}
	

	function DeletePatientdetails($id)
	{
		 $listresult= self::where('user_id','=',$id)->delete(); 
		return $listresult;
		
	}
 


    function ViewPatientdata($id)
	{
			      $result=self::where('patient_details.user_id','=',$id)
		              ->join("user_details",'user_details.user_id','=','patient_details.user_id')
		              ->join("users",'users.id','=','user_details.user_id')
		              ->join("address",'address.id','=','user_details.address_id')
		              ->leftjoin("cities",'cities.cityid','=','address.city_id')
		              ->leftjoin("states",'states.state_id','=','address.state_id')
		              ->get(['user_details.user_id','users.active','users.username','users.email',new raw(" Concat(user_details.first_name,' ',user_details.last_name) as name"),'user_details.mobileno','user_details.age','user_details.gender','user_details.profile_pic_path','blood_group','height',new raw(" Concat(address.house_no,', ',address.street,', ',address.area,', ',address.landmark,', <br>',cities.cityname,', ',states.state_name,', ',address.pincode) as address"),'weight']);
		return $result;
	
	}


	function AllPatientForDashboard($account_id)
	{
		$result=self::Where(function($result) use ($account_id){
			if((!is_null($account_id)) && (!empty($account_id))){
				$result->whereRaw("user_accounts.account_id ='".$account_id."'");
			}
		   });
		 $searchData=$result
		  ->join("user_details",'user_details.user_id','=','patient_details.user_id')
		  ->join("user_accounts",'user_accounts.user_id','=','user_details.user_id')
		  ->get(['user_details.user_id',new raw('count(user_details.user_id) as total_patientcount')]);
     return $searchData;
	
	}
  

}

?>