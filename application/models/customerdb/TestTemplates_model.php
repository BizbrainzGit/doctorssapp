<?php
include_once(APPPATH . 'models/customerdb/Base_model.php');
use \Illuminate\Database\Eloquent\Model as Eloquent;
use \Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;
class TestTemplates_model extends Base_model {
	public $timestamps = false;
	protected $table = 'test_templates';
	protected $primaryKey = 'id';
	protected $fillable = ['medical_test_id', 'test_template', 'status', 'created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];

	public function addTestTemplate($testtemplatearray){
		$addresult=self::create($testtemplatearray);
		return $addresult;
	}

	function SearchTestTemplateList()
	{

	 $result=self::join("medical_test",'medical_test.id','=','test_templates.medical_test_id')
	              ->join("medicaltest_category",'medicaltest_category.id','=','medical_test.medicaltest_category_id')
		          ->get(['test_templates.id','status','medicaltest_name','category_name']);
		return $result; 	
	} 

	function TestTemplateEditById($id)
	{
	 $result=self::Where('test_templates.id','=',$id)->join("medical_test",'medical_test.id','=','test_templates.medical_test_id')->get(['test_templates.id','medical_test_id', 'test_template', 'status','medicaltest_category_id']);
		return $result; 	
	}

	function TestTemplateViewById($id)
	{
	 $result=self::Where('test_templates.id','=',$id)->join("medical_test",'medical_test.id','=','test_templates.medical_test_id') ->join("medicaltest_category",'medicaltest_category.id','=','medical_test.medicaltest_category_id')->get(['test_templates.id','status','medicaltest_name','category_name','test_template']);
		return $result; 	
	}

	function UpdateTestTemplate($testtemplatearray,$testtemplate_id)
	{
	 $result=self::Where('test_templates.id','=',$testtemplate_id)->Update($testtemplatearray);
		return $result; 	
	}
 
   function GetTestTemplateByTestId($id){
   	$result=self::where('test_templates.medical_test_id','=',$id)->get(['medical_test_id', 'test_template']);
   	return $result;

   }

	// function GetPatientBillingTestsById($id,$masterdb)
	// {

	//  $result=self::where('patient_billing_test.id','=',$id)
	//              ->join("prescription",'prescription.id','=','patient_billing_test.prescription_id')
	//              ->join("$masterdb.user_details as pud",'pud.user_id','=','prescription.patient_user_id')
	//              ->join("$masterdb.users as pu",'pu.id','=','pud.user_id')
	//              ->join("$masterdb.user_details as dud",'dud.user_id','=','prescription.doctor_user_id')
	//              ->join("$masterdb.users as du",'du.id','=','dud.user_id')
	//              // ->join("billing_tests",'billing_tests.patient_billing_id','=','patient_billing_test.id')
	// 	         ->get(['patient_billing_test.id','promocode_id', 'billing_date','discount_amount', 'test_total_amount', 'sub_total_amount', 'gst_amount', 'grand_total_amount',new raw(" Concat(dud.first_name,' ',dud.last_name) as doctor_name"),'dud.mobileno as doctor_mobileno','du.username as doctor_username',new raw(" Concat(pud.first_name,' ',pud.last_name) as patient_name"),'pud.mobileno as patient_mobileno','pu.username as patient_username']);
	// 	return $result; 	
		

	// } 


}?>