<?php
include_once(APPPATH . 'models/customerdb/Base_model.php');
use \Illuminate\Database\Eloquent\Model as Eloquent;
use \Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;

class PatientMedicalTestReports_model extends Base_model {
	public $timestamps = false;
	protected $table = 'patient_medicaltest_report';
	protected $primaryKey = 'id';
	protected $fillable = ['billing_id', 'medical_test_id', 'medical_test_report', 'created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];

	public function addMedicalTestReport($dataarray){
		$addresult=self::create($dataarray);
		return $addresult;
	}

	public function SearchMedicalTestReportsList($masterdb,$userid)
	{
		$result=self::Where(function($result) use ($userid){
			if((!is_null($userid)) && (!empty($userid))){
				$result->whereRaw("prescription.patient_user_id ='".$userid."'");
			}
		   });
		$result=$result->join('patient_billing_test','patient_billing_test.id','=','patient_medicaltest_report.billing_id')
		             ->join("prescription",'prescription.id','=','patient_billing_test.prescription_id')
	                 ->join("$masterdb.user_details as pud",'pud.user_id','=','prescription.patient_user_id')
	                 ->join("$masterdb.users as pu",'pu.id','=','pud.user_id')
	                 ->join("$masterdb.user_details as dud",'dud.user_id','=','prescription.doctor_user_id')
	                 ->join("$masterdb.users as du",'du.id','=','dud.user_id')
	                 ->join("medical_test",'medical_test.id','=','patient_medicaltest_report.medical_test_id')
		             ->get(['patient_medicaltest_report.id','billing_date',new raw(" Concat(dud.first_name,' ',dud.last_name,'-',du.username) as doctor_name"),'dud.mobileno as doctor_mobileno',new raw(" Concat(pud.first_name,' ',pud.last_name,'-',pu.username) as patient_name"),'pud.mobileno as patient_mobileno','medicaltest_name']);
		return $result;
	}

	function AllMedicaltestreportForDashboard($doctors_id,$patients_id)
	{ 
		$result=self::Where( function($result) use ($patients_id,$doctors_id){
			if(count($patients_id)>0 && (!is_null($patients_id))  && (!empty($patients_id))){
				$result->whereRaw("prescription.patient_user_id ='".$patients_id."'");
			}
			if(count($doctors_id)>0 && (!is_null($doctors_id))  && (!empty($doctors_id))){
				$result->whereRaw("prescription.doctor_user_id ='".$doctors_id."'");
			}
		   });

		 $searchData=$result->join('patient_billing_test','patient_billing_test.id','=','patient_medicaltest_report.billing_id')
		             ->join("prescription",'prescription.id','=','patient_billing_test.prescription_id')->get(['patient_medicaltest_report.id',new raw('count(patient_medicaltest_report.id) as total_medicaltestreportcount')]);
        return $searchData;	
		
	}

public function ViewMedicalTestReport($masterdb,$id)
	{
		
		$result=self::where('patient_medicaltest_report.id','=',$id)
		             ->join('patient_billing_test','patient_billing_test.id','=','patient_medicaltest_report.billing_id')
		             ->join("prescription",'prescription.id','=','patient_billing_test.prescription_id')
	                 ->join("$masterdb.user_details as pud",'pud.user_id','=','prescription.patient_user_id')
	                 ->join("$masterdb.users as pu",'pu.id','=','pud.user_id')
	                 ->join("$masterdb.user_details as dud",'dud.user_id','=','prescription.doctor_user_id')
	                 ->join("$masterdb.users as du",'du.id','=','dud.user_id')
	                 ->join("medical_test",'medical_test.id','=','patient_medicaltest_report.medical_test_id')
		             ->get(['patient_medicaltest_report.id','billing_date',new raw(" Concat(dud.first_name,' ',dud.last_name,'-',du.username) as doctor_name"),'dud.mobileno as doctor_mobileno',new raw(" Concat(pud.first_name,' ',pud.last_name,'-',pu.username) as patient_name"),'pud.age as patient_age','pud.mobileno as patient_mobileno','medicaltest_name',new raw('DATE_FORMAT(patient_medicaltest_report.created_on, "%d-%m-%Y") as created_date'),'patient_medicaltest_report.medical_test_report']);
		return $result;
	}


}

?>