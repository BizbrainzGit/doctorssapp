<?php 
 
use \Illuminate\Database\Eloquent\Model as Eloquent ;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;
 
class Specialization_model extends Eloquent {
    public $timestamps = false;
    protected $table = "specializations"; // table name
    public $primaryKey = 'id';
    protected $fillable = ['specialization','specialization_img','created_ip','created_by','created_on','modified_ip','modified_by','modified_on'];

   public function SpecializationList()
	{
		$result=self::orderBy('specializations.specialization')->get();
		return $result;
	}
	public function addSpecialization($Specializationarray){
		
		$addresult=self::create($Specializationarray);
		return $addresult;
	}

    function SearchSpecialization()
	{
	 
    $listresult=self::where('specializations.id','!=',0)->get(['specializations.id','specializations.specialization','specialization_img']);
		return $listresult;
		
	} 

 function EditSpecialization($id)
	   {
	    $editresult=self::where('specializations.id','=',$id)
		                // ->groupBy('specializations.id')
		                ->get(['specializations.id','specializations.specialization','specialization_img']);
		return $editresult;
	   }
function SpecializationUpdate($Specializationarray,$id)
 	  {

	   $resultupdate=self::where('specializations.id','=',$id)->update($Specializationarray);
       return $resultupdate;
     }

function DeleteSpecialization($id)
    {
	$deleteresult=self::where('id','=',$id)->delete();
       return $deleteresult;
    }


    public function GetSpecializationId($specialization)
	{
		$result=self::whereRaw("specializations.specialization ='$specialization'")->get(['id']);
		return $result;
	}

	 function GetSpecializationForHomepage()
	{
	 
    $listresult=self::get(['specializations.id','specializations.specialization','specialization_img']);
		return $listresult;
		
	}     	 

}
?>