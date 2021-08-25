<?php
include_once(APPPATH . 'models/customerdb/Base_model.php');
use \Illuminate\Database\Eloquent\Model as Eloquent;
use \Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;

class Prescription_model extends Base_model {
	public $timestamps = false;
	protected $table = 'prescription';
	protected $primaryKey = 'id';
	protected $fillable = ['patient_user_id','doctor_user_id','appointment_id','blood_pressure','pulse_rate','note', 'symptoms', 'diagnosis','prescription_photo', 'created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];
	
	public function addPrescription($prescriptionarray){
		$addPrescriptionid=self::create($prescriptionarray);
		$addresult=$addPrescriptionid->id;
		return $addresult;
	}

	function SearchPrescription($userid,$masterdb)
	{
	 $result=self::Where(function($result) use ($userid){
			if((!is_null($userid)) && (!empty($userid))){
				$result->whereRaw("prescription.patient_user_id ='".$userid."'");
			}
		   });
	 $result=$result->join("$masterdb.user_details as ud",'ud.user_id','=','prescription.patient_user_id')
		            ->join("$masterdb.user_details",'user_details.user_id','=','prescription.doctor_user_id')
		            ->join('appointment_details','appointment_details.id','=','prescription.appointment_id')
		            // ->whereRaw('Date(appointment_date) = CURDATE()')
		            ->get(['prescription.id',new raw(" Concat(ud.first_name,' ',ud.last_name) as patient_name"),'ud.mobileno as patient_mobileno','patient_user_id','doctor_user_id','symptoms','diagnosis',new raw(" Concat(user_details.first_name,' ',user_details.last_name) as doctor_name"),'user_details.mobileno as doctor_mobileno']);
		return $result; 	
		
	} 


	function EditPrescription($id,$masterdb)
	{
	 
	 $result=self::where('prescription.id','=',$id)
	             ->groupBy('prescription.id')
	             ->join("$masterdb.user_details as ud",'ud.user_id','=','prescription.patient_user_id')
		         ->join("$masterdb.user_details",'user_details.user_id','=','prescription.doctor_user_id')
		         ->leftjoin('prescription_tests','prescription_tests.prescription_id','=','prescription.id')
		         ->get(['prescription.id','patient_user_id','doctor_user_id','note','symptoms','diagnosis','prescription_photo',new raw(" GROUP_CONCAT(test_id) as test_id")]);
		return $result; 	

		
	} 


		function updatePrescription($data,$id)
	{   

		$addresult=self::where('id','=',$id)->Update($data);
		return $addresult;

		}
	

	function DeletePrescription($id)
	{
		 $listresult= self::where('id','=',$id)->delete(); 
		return $listresult;
		
	}


	function ViewPrescriptionById($id,$masterdb)
	{
	      
     $result=self::where('prescription.id','=',$id)
	             ->groupBy('prescription.id')
                 ->join("$masterdb.user_details as ud",'ud.user_id','=','prescription.patient_user_id')
		         ->join("$masterdb.user_details",'user_details.user_id','=','prescription.doctor_user_id')
		         ->get(['prescription.id','patient_user_id','doctor_user_id','note','symptoms','diagnosis',new raw("Concat(ud.first_name,' ',ud.last_name) as patient_name"),'ud.mobileno as patient_mobileno','ud.age as patient_age','blood_pressure','pulse_rate',new raw(" Concat(user_details.first_name,' ',user_details.last_name) as doctor_name"),'user_details.mobileno as doctor_mobileno',new raw('DATE_FORMAT(prescription.created_on, "%d-%m-%Y") as created_date')]);
		return $result; 
		
	} 



	function SearchPatientsMedicalTestsReceipts($masterdb)
	{
		
	  $result=self::join("$masterdb.user_details as ud",'ud.user_id','=','prescription.patient_user_id')
	              ->join("$masterdb.users",'users.id','=','ud.user_id')
	              ->join('prescription_tests','prescription_tests.prescription_id','=','prescription.id')
	              ->join('medical_test','medical_test.id','=','prescription_tests.test_id')
	              ->join('prescription_medicine','prescription_medicine.prescription_id','=','prescription.id')
	              ->groupBy('prescription.id')
	              ->get(['prescription.id','users.active',new raw(" Concat(ud.first_name,' ',ud.last_name) as patient_name"),'ud.mobileno as patient_mobileno',new raw("GROUP_CONCAT(test_name) as test_name"),new raw("sum(medicaltest_price) as total_medicaltest_price"),'laboratory.medicaltest_price']);
	return $result;                
		
	}   


	function ViewPatientsMedicalTestsReceiptById($id,$masterdb)
	{
		
  $result=self::join("$masterdb.user_details",'user_details.user_id','=','prescription.patient_user_id')
              ->join("$masterdb.user_details as ud",'ud.user_id','=','prescription.doctor_user_id')
              ->join("$masterdb.users",'users.id','=','user_details.user_id')
              ->leftjoin('doctor_details','doctor_details.user_id','=','prescription.doctor_user_id')
              ->leftjoin("$masterdb.specializations",'specializations.id','=','doctor_details.specialization_id')
              ->leftjoin('prescription_tests','prescription_tests.prescription_id','=','prescription.id')
              ->leftjoin("$masterdb.medical_test",'medical_test.id','=','prescription_tests.test_id')
              ->leftjoin('laboratory','laboratory.medicaltest_id','=','prescription_tests.test_id')
              ->where('prescription.id','=',$id)
              ->groupBy('prescription.id')
              ->get(['prescription.id','users.active',new raw(" Concat(user_details.first_name,' ',user_details.last_name) as patient_name"),'user_details.mobileno as patient_mobileno','user_details.age as patient_age',new raw(" Concat(ud.first_name,' ',ud.last_name) as doctor_name"),'ud.mobileno as doctor_mobileno',new raw(" GROUP_CONCAT(test_name) as test_name"),'specializations.specialization','laboratory.medicaltest_price',new raw("sum(medicaltest_price) as total_medicaltest_price"),new raw("GROUP_CONCAT(test_id) as test_id"),new raw('DATE_FORMAT(prescription.created_on, "%d-%m-%Y") as created_date')]);
	return $result;                
		
	}   


	function GetTestDetails($id,$masterdb)
	{
		
    $result=self::join('prescription_tests','prescription_tests.prescription_id','=','prescription.id')
              ->join("$masterdb.medical_test",'medical_test.id','=','prescription_tests.test_id')
              ->join('laboratory','laboratory.medicaltest_id','=','prescription_tests.test_id')
              ->where('prescription_tests.test_id','=',$id)
              ->get(['laboratory.id','laboratory.medicaltest_price','test_name']);
	return $result;                
		
	}   

function SearchMedicalTestsBilling($userid,$masterdb)
	{
	 $result=self::Where(function($result) use ($userid){
			if((!is_null($userid)) && (!empty($userid))){
				$result->whereRaw("prescription.patient_user_id ='".$userid."'");
			}
		   });
	 $result=$result->join("$masterdb.user_details as ud",'ud.user_id','=','prescription.patient_user_id')
		            ->join("$masterdb.user_details",'user_details.user_id','=','prescription.doctor_user_id')
		            ->join('prescription_tests','prescription_tests.prescription_id','=','prescription.id')
                    ->join("$masterdb.medical_test",'medical_test.id','=','prescription_tests.test_id')
		            ->get(['prescription.id',new raw(" Concat(ud.first_name,' ',ud.last_name) as patient_name"),'ud.mobileno as patient_mobileno','patient_user_id','doctor_user_id','symptoms','diagnosis',new raw(" Concat(user_details.first_name,' ',user_details.last_name) as doctor_name"),'user_details.mobileno as doctor_mobileno',new raw("GROUP_CONCAT(test_name) as test_name")]);
		return $result; 	
		
	} 
function ViewMedicalTestsById($id,$masterdb)
	{
	      
     $result=self::where('prescription.id','=',$id)
	             ->groupBy('prescription.id')
                 ->join("$masterdb.user_details as ud",'ud.user_id','=','prescription.patient_user_id')
		         ->join("$masterdb.user_details",'user_details.user_id','=','prescription.doctor_user_id')
		         ->join('medical_test','medical_test.id','=','prescription_tests.test_id')
	             ->join('prescription_medicine','prescription_medicine.prescription_id','=','prescription.id')
		         ->get(['prescription.id','patient_user_id','doctor_user_id',new raw(" GROUP_CONCAT(test_name) as test_name"),new raw(" Concat(ud.first_name,' ',ud.last_name) as patient_name"),'ud.mobileno as patient_mobileno','ud.age as patient_age',new raw(" Concat(user_details.first_name,' ',user_details.last_name) as doctor_name"),'user_details.mobileno as doctor_mobileno']);
		return $result; 
		
	} 	




	// dropdown for billing 

	function GetPatientByPrescriptionMedicalTestsData($masterdb)
	{
		
	  $result=self::join("$masterdb.user_details as ud",'ud.user_id','=','prescription.patient_user_id')
	              ->join("$masterdb.users",'users.id','=','ud.user_id')
	              ->get(['prescription.id',new raw(" Concat(ud.first_name,' ',ud.last_name ,'-', users.username) as patient_name")]);
	   return $result;                
		
	}  


	// Count Of Prescription //

	function AllPrescriptionForDashboard($doctors_id,$patients_id)
	{ 
		$result=self::Where( function($result) use ($patients_id,$doctors_id){
			if(count($patients_id)>0 && (!is_null($patients_id))  && (!empty($patients_id))){
				$result->whereRaw("prescription.patient_user_id ='".$patients_id."'");
			}
			if(count($doctors_id)>0 && (!is_null($doctors_id))  && (!empty($doctors_id))){
				$result->whereRaw("prescription.doctor_user_id ='".$doctors_id."'");
			}
		   });

		 $searchData=$result->get(['prescription.id',new raw('count(prescription.id) as total_prescriptioncount')]);
        return $searchData;	
		
	}
function ViewPrescriptionByPateintId($userid,$masterdb)
	{
	 $result=self::Where(function($result) use ($patintid){
			if((!is_null($patintid)) && (!empty($patintid))){
				$result->whereRaw("prescription.patient_user_id ='".$patintid."'");
			}
		   });
	 $result=$result->join("$masterdb.user_details as ud",'ud.user_id','=','prescription.patient_user_id')
		            ->join("$masterdb.user_details",'user_details.user_id','=','prescription.doctor_user_id')
		            ->join('appointment_details','appointment_details.id','=','prescription.appointment_id')
		            // ->whereRaw('Date(appointment_date) = CURDATE()')
		            ->get(['prescription.id',new raw(" Concat(ud.first_name,' ',ud.last_name) as patient_name"),'ud.mobileno as patient_mobileno','patient_user_id','doctor_user_id','symptoms','diagnosis',new raw(" Concat(user_details.first_name,' ',user_details.last_name) as doctor_name"),'user_details.mobileno as doctor_mobileno']);
		return $result; 	
		
	} 
}

?>