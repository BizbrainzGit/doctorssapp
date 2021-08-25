<?php
include_once(APPPATH . 'models/customerdb/Base_model.php');
use \Illuminate\Database\Eloquent\Model as Eloquent;
use \Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;

class PrescriptionMedicine_model extends Base_model {
	public $timestamps = false;
	protected $table = 'prescription_medicine';
	protected $primaryKey = 'id';
	protected $fillable = ['prescription_id','medicine_name','medicine_note'];
	public function addPrescriptionMedicine($medicinearray){
		
		$addresult=self::create($medicinearray);
		return $addresult;
	}

	public function ViewMedicinesByPrescriptionId($prescription_id)
	{
		$medicineList = self::where('prescription_id','=',$prescription_id)->get();
		return $medicineList;
	}
		public function deletePrescriptionMedicine($prescription_id)
	{
		$deleteresult=self::where('prescription_id','=',$prescription_id)->delete();
		return $deleteresult;
	}



}

?>