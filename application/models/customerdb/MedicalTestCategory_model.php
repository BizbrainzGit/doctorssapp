<?php 

include_once(APPPATH . 'models/customerdb/Base_model.php');
use \Illuminate\Database\Eloquent\Model as Eloquent;
use \Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;

class MedicalTestCategory_model  extends Base_model {
    public $timestamps = false;
    protected $table = "medicaltest_category"; // table name
    public $primaryKey = 'id';
    protected $fillable = ['category_name','created_ip','created_by','created_on','modified_ip','modified_by','modified_on',];
   

   public function MedicalTestCategoryList()
	{
		$result=self::orderBy('medicaltest_category.category_name')->get();
		return $result;
	}

	public function addMedicalTestCategory($medicaltestcategoryarray){
		$addmedicaltestcategory=self::create($medicaltestcategoryarray);
		return $addmedicaltestcategory;
	}

	 function SearchMedicalTestCategory($masterdb)
	{
	 
    $listresult=self::where('medicaltest_category.id','!=',0)
                    ->get(['medicaltest_category.id','medicaltest_category.category_name']);
		return $listresult;
		
	} 

  
  function EditMedicalTestCategory($id,$masterdb)
	   {
	    $editresult=self::where('medicaltest_category.id','=',$id)
	                    ->get(['medicaltest_category.id','medicaltest_category.category_name']);
		return $editresult;
	   }

function MedicalTestCategoryUpdate($medicaltestcategoryarray,$id)
 	  {

	   $resultupdate=self::where('medicaltest_category.id','=',$id)->update($medicaltestcategoryarray);
       return $resultupdate;
     }

function DeleteMedicalTestCategory($id)
    {
	$deleteresult=self::where('medicaltest_category.id','=',$id)->delete();
       return $deleteresult;
    }     	 
	   
	

}
?>