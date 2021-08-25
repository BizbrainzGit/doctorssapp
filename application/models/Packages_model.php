<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent ;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;
class Packages_model extends Eloquent {
      public $timestamps=false;
      protected $guarded = array();
      protected $table="packages";
      public $PrimaryKey='id';
      protected $Filables=['package_name', 'package_duration', 'package_status', 'package_amount', 'created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];
  function AddPackage($packagesarray)
	{
		$addresult=self::create($packagesarray);
		$id=$addresult->id;
		return $id;
	} 
function listPackages()
	{
		$datalistresult=self::get(['id','package_name','package_amount','package_status','package_duration']);
		return $datalistresult;
	}	

function EditPackage($id)
	{
		$editresult=self::where('packages.id','=',$id)->get(['packages.id','packages.package_name','packages.package_amount','package_status','package_duration']);
		return $editresult;
	}

function UpdatePackage($packagearray, $package_id){
	$resultupdate=self::where('id','=',$package_id)->update($packagearray);
                return $resultupdate;
		}

function DeletePackage($id){
	$deleteresult=self::where('id','=',$id)->delete();
    return $deleteresult;
        	}


function GetPackageForAccountSubscription(){
	    $datalistresult=self::where('package_status','=',1)->get(['id','package_name','package_amount','package_status','package_duration']);
		return $datalistresult;

     }


} 
?>