<?php 
 
use \Illuminate\Database\Eloquent\Model as Eloquent ;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;
 
class ReferADoctor_model extends Eloquent {
    public $timestamps = false;
    protected $table = "refer_a_doctor"; // table name
    public $primaryKey = 'id';
    protected $fillable = ['refered_by_doctor_id','refered_to_doctor_id','refered_patient_id','created_ip','created_by','created_on','modified_ip','modified_by','modified_on','refered_to_specializations_id','refered_to_doctor_name','refered_to_clinic_name','refered_to_phone_number'];
   


	public function addReferADoctorData($referadoctorarray){
		
		$addresult=self::create($referadoctorarray);
		return $addresult;
	}

	
    
    function SearchReferADoctor($user_id)
	{
	 
	 $result=self::Where(function($result) use ($user_id){
			if((!is_null($user_id)) && (!empty($user_id))){
				$result->whereRaw("refer_a_doctor.created_by ='".$user_id."'");
			}
		   });
	 $searchData=$result
	    ->join('user_details as udp','udp.user_id','=','refer_a_doctor.refered_patient_id')
	    ->join('user_details as uddt','uddt.user_id','=','refer_a_doctor.refered_to_doctor_id')
	    ->join('user_details as uddb','uddb.user_id','=','refer_a_doctor.refered_by_doctor_id')
	    ->join("address",'address.id','=','udp.address_id')
	    ->leftjoin("cities",'cities.cityid','=','address.city_id')
	    ->leftjoin("states",'states.state_id','=','address.state_id')
	    ->get(['refer_a_doctor.id','refered_by_doctor_id','refered_to_doctor_id','refered_patient_id',new raw('CONCAT(uddt.first_name," ",uddt.last_name) as refer_to_doctorname'),new raw('CONCAT(uddb.first_name," ",uddb.last_name) as refer_by_doctorname'),new raw('CONCAT(udp.first_name," ",udp.last_name) as patient_name'),new raw('udp.mobileno as patient_mobileno'),new raw(" Concat(address.house_no,', ',address.street,', ',address.area,', ',address.landmark,', ',cities.cityname,', ',states.state_name,', ',address.pincode) as patient_address")]);
			return $searchData;
		
	} 



	function SearchReferByADoctor($id)
	{
	 $searchData=self::join('user_details as udp','udp.user_id','=','refer_a_doctor.refered_patient_id')
	    ->join('user_details as uddt','uddt.user_id','=','refer_a_doctor.refered_to_doctor_id')
	    ->join('user_details as uddb','uddb.user_id','=','refer_a_doctor.refered_by_doctor_id')
	    ->join("address",'address.id','=','udp.address_id')
	    ->leftjoin("cities",'cities.cityid','=','address.city_id')
	    ->leftjoin("states",'states.state_id','=','address.state_id')
	    ->where('refer_a_doctor.refered_to_doctor_id','=',$id)
	    ->get(['refer_a_doctor.id','refered_by_doctor_id','refered_to_doctor_id','refered_patient_id',new raw('CONCAT(uddt.first_name," ",uddt.last_name) as refer_to_doctorname'),new raw('CONCAT(uddb.first_name," ",uddb.last_name) as refer_by_doctorname'),new raw('CONCAT(udp.first_name," ",udp.last_name) as patient_name'),new raw('udp.mobileno as patient_mobileno'),new raw(" Concat(address.house_no,', ',address.street,', ',address.area,', ',address.landmark,', ',cities.cityname,', ',states.state_name,', ',address.pincode) as patient_address")]);
			return $searchData;
		
	} 



}
?>