<?php 
 
use \Illuminate\Database\Eloquent\Model as Eloquent;
 
class States_model extends Eloquent {
    public $timestamps = false;
    protected $table = "states"; // table name
    public $primaryKey = 'state_id';
    protected $fillable = ['state_name'];
    
    
public function StateList()
	{
		$result=self::get();
		return $result;
	}
	public function getCityId($cityId){
		$result=self::join('cities','cities.state_id','=','states.state_id')->where('cities.cityid','=',$cityId)->get(['states.state_id','states.state_name']);
		return $result;
	}

}
?>