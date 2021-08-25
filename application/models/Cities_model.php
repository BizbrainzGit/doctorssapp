<?php 
 
use \Illuminate\Database\Eloquent\Model as Eloquent ;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;
 
class Cities_model extends Eloquent {
    public $timestamps = false;
    protected $table = "cities"; // table name
    public $primaryKey = 'cityid';
    protected $fillable = ['cityname','state_id','latitude','longitude','short_code'];
   

   public function CityList()
	{
		$result=self::orderBy('cityname')->get();
		return $result;
	}
	
	public function SelectedCityList($city_id)
	{
		$result=self::where('cities.id',$city_id)->get();
		return $result;
	}

	public function getCityByStateId($stateId)
	{
		$result=self::where('cities.state_id',$stateId)->get();
		return $result;
	}


	public function GetLoctionId($loctions)
	{
		$result=self::whereRaw("cities.cityname ='$loctions'")->get(['cityid']);
		return $result;
	}
	
 
}
?>