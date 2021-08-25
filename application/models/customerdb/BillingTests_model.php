<?php
include_once(APPPATH . 'models/customerdb/Base_model.php');
use \Illuminate\Database\Eloquent\Model as Eloquent;
use \Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;

class BillingTests_model extends Base_model {
	public $timestamps = false;
	protected $table = 'billing_tests';
	protected $primaryKey = 'id';
	protected $fillable = ['patient_billing_id','test_id'];
	
	public function addBillingTest($testarray){
		
		$addresult=self::create($testarray);
		return $addresult;
	}

		public function deleteBillingTest($billing_id)
	{
		$deleteresult=self::where('patient_billing_id','=',$billing_id)->delete();
		return $deleteresult;
	}

	public function TestListPatientBillingTestsById($id)
	{
		$result=self::where('patient_billing_id','=',$id)
		->join('medical_test','medical_test.id','=','billing_tests.test_id')
		->get(['billing_tests.test_id','medicaltest_name', 'medicaltest_price', 'discretion']);
		return $result;
	}



}

?>