<?php
include_once(APPPATH . 'models/CommonBase_model.php');

use \Illuminate\Database\Eloquent\Model as Eloquent;
use \Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;

class Customdata_model extends CommonBase_model {
	public $timestamps = false;
	protected $table = 'custom_data';
	protected $primaryKey = 'id';
	protected $fillable = ['content_type','content','type','created_ip','created_by','created_on','modified_ip','modified_by','modified_on'];
	
	function getCustomDataList(){
		$customdata=self::get(['id','content_type']);
		return $customdata;
	}
	function addCustomData(){
		try{ 
			$customId = self::create($data)->id;
			return $customId;
		}
		catch(Exception $ex){
			
			throw new Exception($ex);
		}	
	}
	public function updateCustomDetails($data,$id){
		try{
			$customId = self::where('id','=',$id)->Update($data);
			return $customId;
		}
		catch(Exception $ex){
			
			throw new Exception($ex);
		}
	}
	public function getCustomDataByIdData($id){
		$customdatabyid=self::where('id','=',$id)->get();
		return $customdatabyid[0];
	}
}

?>