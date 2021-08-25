<?php
include_once(APPPATH . 'models/customerdb/Base_model.php');
use \Illuminate\Database\Eloquent\Model as Eloquent;
use \Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;

class PrescriptionTests_model extends Base_model {
	public $timestamps = false;
	protected $table = 'prescription_tests';
	protected $primaryKey = 'id';
	protected $fillable = ['prescription_id','test_id'];
	

	
	public function addPrescriptionTest($prescriptiontestarray){
		
		$addresult=self::create($prescriptiontestarray);
		return $addresult;
	}

		public function deletePrescriptionTest($prescription_id)
	{
		$deleteresult=self::where('prescription_id','=',$prescription_id)->delete();
		return $deleteresult;
	}

    public function MedicalTestName($id)
	{
		$result=self::where('prescription_tests.prescription_id','=',$id)
		            ->join('medical_test','medical_test.id','=','prescription_tests.test_id')
		            ->get(['prescription_tests.id','medical_test.medicaltest_category_id','medical_test.medicaltest_name','medical_test.medicaltest_price','medical_test.discretion','medical_test.medicaltest_status']);
		return $result;
	}  

}

?>