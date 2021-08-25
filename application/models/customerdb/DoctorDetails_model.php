<?php
include_once(APPPATH . 'models/customerdb/Base_model.php');
use \Illuminate\Database\Eloquent\Model as Eloquent;
use \Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;

class DoctorDetails_model extends Base_model {
	public $timestamps = false;
	protected $table = 'doctor_details';
	protected $primaryKey = 'id';
	protected $fillable = ['user_id', 'designation', 'specialist', 'specialization_id','consultation_fee','blood_group','education','biography', 'created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];

	public function getDoctorSpecializationId($doctorspecializationId,$masterdb){
		
		
	      $result=self::join("$masterdb.user_details",'user_details.user_id','=','doctor_details.user_id')
		              ->join("$masterdb.users",'users.id','=','user_details.user_id')
		              ->join("$masterdb.user_accounts",'user_accounts.user_id','=','user_details.user_id')
		              ->join("$masterdb.groups",'groups.id','=','user_accounts.role_id')
		              ->join("$masterdb.specializations",'specializations.id','=','doctor_details.specialization_id')
		              ->where('doctor_details.specialization_id','=',$doctorspecializationId)
		              ->where('users.active','=','1')
		              ->get(['doctor_details.id',new raw(" Concat(user_details.first_name,' ',user_details.last_name) as user_name"),'user_details.mobileno','user_details.gender','doctor_details.user_id','doctor_details.designation','consultation_fee','blood_group','specialist','specializations.specialization','education','biography']);
		return $result;
            
	}
	
	public function addDoctorDetails($doctordetailsarray){
		
		$addresult=self::create($doctordetailsarray);
		return $addresult;
	}

function SearchDoctors($masterdb){  

          $result=self::leftjoin("$masterdb.user_details",'user_details.user_id','=','doctor_details.user_id')
		              ->join("$masterdb.users",'users.id','=','user_details.user_id')
		              ->join("$masterdb.user_accounts",'user_accounts.user_id','=','user_details.user_id')
		              ->join("$masterdb.groups",'groups.id','=','user_accounts.role_id')
		              ->leftjoin("$masterdb.specializations",'specializations.id','=','doctor_details.specialization_id')
		              ->leftjoin("$masterdb.address",'address.id','=','user_details.address_id')
		              ->leftjoin("$masterdb.cities",'cities.cityid','=','address.city_id')
		              ->leftjoin("$masterdb.states",'states.state_id','=','address.state_id')
		              ->where('user_accounts.role_id','=',4)
		              ->get(['user_details.id','users.active','users.username',new raw(" Concat(user_details.first_name,' ',user_details.last_name) as name"),'user_details.mobileno','user_details.gender','doctor_details.user_id','doctor_details.designation','consultation_fee','blood_group','specialist','specializations.specialization','education','biography',new raw(" Concat(address.house_no,', ',address.street,', ',address.area,', ',address.landmark,', ',cities.cityname,', ',states.state_name,', ',address.pincode) as address")]);
		return $result;
        } 


	function EditDoctor($id,$masterdb){
        
		  $result=self::where('doctor_details.user_id','=',$id)
		              ->join("$masterdb.user_details",'user_details.user_id','=','doctor_details.user_id')
		              ->join("$masterdb.users",'users.id','=','user_details.user_id')
		              ->leftjoin("$masterdb.specializations",'specializations.id','=','doctor_details.specialization_id')
		              ->leftjoin("$masterdb.address",'address.id','=','user_details.address_id')
		              ->leftjoin("$masterdb.cities",'cities.cityid','=','address.city_id')
		              ->leftjoin("$masterdb.states",'states.state_id','=','address.state_id')
		              ->get(['user_details.id','user_details.address_id','users.active','user_details.first_name','user_details.last_name','user_details.mobileno','user_details.age','user_details.gender','user_details.profile_pic_path','doctor_details.user_id','designation','consultation_fee','blood_group','specialist','doctor_details.specialization_id','education','biography','address.house_no','address.street','address.area','address.landmark','address.city_id','address.state_id','address.pincode']);
		return $result;
	} 	

	function updateDoctorDetails($data,$id)
	{   

		$addresult=self::where('user_id','=',$id)->Update($data);
		return $addresult;

		}
	

	function DeleteDoctordetails($id)
	{
		 $listresult= self::where('user_id','=',$id)->delete(); 
		return $listresult;
		
	}



}

?>