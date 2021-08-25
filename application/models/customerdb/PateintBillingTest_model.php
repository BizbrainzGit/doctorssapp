<?php
include_once(APPPATH . 'models/customerdb/Base_model.php');
use \Illuminate\Database\Eloquent\Model as Eloquent;
use \Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;

class PateintBillingTest_model extends Base_model {
	public $timestamps = false;
	protected $table = 'patient_billing_test';
	protected $primaryKey = 'id';
	protected $fillable = ['billing_date',  'prescription_id', 'promocode_id', 'discount_amount', 'test_total_amount', 'sub_total_amount', 'gst_amount', 'grand_total_amount','paid_amount','due_amount', 'created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];

	public function addMedicalTestBilling($medicaltestarray){
		$medicaltestid=self::create($medicaltestarray);
		$id=$medicaltestid->id;
		return $id;
	}

	function SearchPatientBillingTests($userid,$masterdb)
	{

	 $result=self::Where(function($result) use ($userid){
			if((!is_null($userid)) && (!empty($userid))){
				$result->whereRaw("prescription.patient_user_id ='".$userid."'");
			}
		   });
	 $result=$result->join("prescription",'prescription.id','=','patient_billing_test.prescription_id')
	             ->join("$masterdb.user_details as ud",'ud.user_id','=','prescription.patient_user_id')
	             ->join("billing_tests",'billing_tests.patient_billing_id','=','patient_billing_test.id')
	             ->join("medical_test",'medical_test.id','=','billing_tests.test_id')
	             ->groupby('patient_billing_test.id')
		         ->get(['patient_billing_test.id',new raw(" Concat(ud.first_name,' ',ud.last_name) as patient_name"),'ud.mobileno as patient_mobileno', 'promocode_id', 'billing_date','discount_amount', 'test_total_amount', 'sub_total_amount', 'gst_amount', 'grand_total_amount',new raw('GROUP_CONCAT(DISTINCT(medicaltest_name)) as medicaltest_name')]);
		return $result; 	
		

	} 


	function GetPatientBillingTestsById($id,$masterdb)
	{

	 $result=self::where('patient_billing_test.id','=',$id)
	             ->join("prescription",'prescription.id','=','patient_billing_test.prescription_id')
	             ->join("$masterdb.user_details as pud",'pud.user_id','=','prescription.patient_user_id')
	             ->join("$masterdb.users as pu",'pu.id','=','pud.user_id')
	             ->join("$masterdb.user_details as dud",'dud.user_id','=','prescription.doctor_user_id')
	             ->join("$masterdb.users as du",'du.id','=','dud.user_id')
	             // ->join("billing_tests",'billing_tests.patient_billing_id','=','patient_billing_test.id')
		         ->get(['patient_billing_test.id','promocode_id', 'billing_date','discount_amount', 'test_total_amount', 'sub_total_amount', 'gst_amount', 'grand_total_amount',new raw(" Concat(dud.first_name,' ',dud.last_name) as doctor_name"),'dud.mobileno as doctor_mobileno','du.username as doctor_username',new raw(" Concat(pud.first_name,' ',pud.last_name) as patient_name"),'pud.mobileno as patient_mobileno','pu.username as patient_username','pu.email as patient_email']);
		return $result; 	
		

	} 



	function GetPatientBillingTestsForTestReport($masterdb)
	{
	 $result=self::join("prescription",'prescription.id','=','patient_billing_test.prescription_id')
	               ->join("$masterdb.user_details as ud",'ud.user_id','=','prescription.patient_user_id')
	               ->join("$masterdb.users as udata",'udata.id','=','ud.user_id')
		           ->get(['patient_billing_test.id',new raw(" Concat(ud.first_name,' ',ud.last_name,'-', udata.username) as patient_name")]);
		return $result; 	
		

	} 


}?>