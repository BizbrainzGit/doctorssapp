<?php 
 
use \Illuminate\Database\Eloquent\Model as Eloquent ;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;
 
class Useraccounts_model extends Eloquent {
    public $timestamps = false;
    protected $table = "user_accounts"; // table name
    public $primaryKey = 'id';
    protected $fillable = ['user_id','account_id','role_id'];
   

  public function addAccountRole($accountroledataarray){
		$addresult=self::create($accountroledataarray);
		return $addresult;
	}

  public function updateAccountRole($data,$user_id){
		 $updateresult= self::where('user_id','=',$user_id)->Update($data); 
		 return $addresult;
    }

    public function DoctorsCountForAdmin($account_id){
     $countresult= self::where('account_id','=',$account_id)->where('role_id','=',4)->count(); 
     return $countresult;
    }

     public function PatientsCountForAdmin($account_id){
     $countresult= self::where('account_id','=',$account_id)->where('role_id','=',6)->count(); 
     return $countresult;
    }



}?>