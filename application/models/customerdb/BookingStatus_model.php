<?php 
 
include_once(APPPATH . 'models/customerdb/Base_model.php');
use \Illuminate\Database\Eloquent\Model as Eloquent;
use \Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;
 
class BookingStatus_model extends Base_model {
    public $timestamps = false;
    protected $table = "booking_status"; // table name
    public $primaryKey = 'id';
    protected $fillable = ['name'];
  
   public function BookingStatusList()
	{
		$result=self::orderBy('name')->get();
		return $result;
	}
	
	public function BookingStatusListForReceptionist()
	{
		$result=self::whereIn('id',array(2,3,6))->get();
		return $result;
	}

	public function BookingStatusListForPatient()
	{
		$result=self::whereIn('id',array(3))->get();
		return $result;
	}

	public function BookingStatusListForDoctor()
	{
		$result=self::whereIn('id',array(4))->get();
		return $result;
	}
	
	
 
}
?>