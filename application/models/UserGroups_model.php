<?php
include_once(APPPATH . 'models/CommonBase_model.php');

use \Illuminate\Database\Eloquent\Model as Eloquent;
use \Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;

class UserGroups_model extends CommonBase_model {
	public $timestamps = false;
	protected $table = 'groups';
	protected $primaryKey = 'id';
	protected $fillable = ['name','description','designation'];
	
	public function getGroups(){
		try{
			$userGroupsList = self::where('id', '>', 1)->get();
			return $userGroupsList;
		}
		catch(Exception $ex){
			throw new Exception($ex);	
		}
	}
	public function getGroupsAccount(){
		try{
			$userGroupsList = self::where('id', '>', 2)->get();
			return $userGroupsList;
		}
		catch(Exception $ex){
			throw new Exception($ex);	
		}
	}
	public function getAllGroups(){
		try{
			$userGroupsList = self::all();
			return $userGroupsList;
		}
		catch(Exception $ex){
			throw new Exception($ex);	
		}
	}
	public function DesignationListForUser()
	{
		$result=self::orderBy('designation')->whereNotIn('id',[1,2,3,4,6])->get();
		return $result;
	}
	

}

?>