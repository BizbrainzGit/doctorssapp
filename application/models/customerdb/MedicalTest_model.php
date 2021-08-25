<?php 

include_once(APPPATH . 'models/customerdb/Base_model.php');
use \Illuminate\Database\Eloquent\Model as Eloquent;
use \Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;

class MedicalTest_model  extends Base_model {
    public $timestamps = false;
    protected $table = "medical_test"; // table name
    public $primaryKey = 'id';
    protected $fillable = ['medicaltest_category_id','medicaltest_name','medicaltest_price','discretion','medicaltest_status','created_ip','created_by','created_on','modified_ip','modified_by','modified_on',];
   

   public function MedicalTestListByCatagoryId($id)
	{
		$result=self::where('medical_test.medicaltest_category_id','=',$id)
		            ->where('medical_test.medicaltest_status','=',1)
		            ->get(['id','medicaltest_category_id','medicaltest_name','medicaltest_price','discretion','medicaltest_status']);
		return $result;
	}
 public function MedicalTestList()
	{
		$result=self::where('medical_test.medicaltest_status','=',1)
		            ->get(['id','medicaltest_category_id','medicaltest_name','medicaltest_price','discretion','medicaltest_status']);
		return $result;
	}	
public function TestPrice($testid)
	{
		$result=self::where('medical_test.id','=',$testid)
		            ->get(['medicaltest_price']);
		return $result;
	}


	public function addMedicalTest($medicaltestarray){
		$addMedicalTest=self::create($medicaltestarray);
		return $addMedicalTest;
	}

	public function SearchMedicalTest($masterdb)
	{
	 
    $listresult=self::join('medicaltest_category','medicaltest_category.id','=','medical_test.medicaltest_category_id')
                    ->where('medical_test.id','!=',0)
                    ->get(['medical_test.id','medicaltest_category.category_name','medical_test.medicaltest_name','medical_test.medicaltest_price','medical_test.discretion','medical_test.medicaltest_status','medical_test.medicaltest_category_id']);
		return $listresult;
		
	} 

  
    public function EditMedicalTest($id,$masterdb)
	   {
	    $editresult=self::where('medical_test.id','=',$id)
	                    ->get(['medical_test.id','medical_test.medicaltest_name','medical_test.medicaltest_price','medical_test.discretion','medical_test.medicaltest_status','medical_test.medicaltest_category_id']);
		return $editresult;
	   }

    public function MedicalTestUpdate($medicaltestarray,$id)
 	  {

	   $resultupdate=self::where('medical_test.id','=',$id)->update($medicaltestarray);
       return $resultupdate;
     }

    public function DeleteMedicalTest($id)
    {
	$deleteresult=self::where('medical_test.id','=',$id)->delete();
       return $deleteresult;
    }     	 
	 

	 
	

}
?>