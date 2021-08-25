<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent ;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;
class Sms_send_model extends Eloquent {
	
      public $timestamps=false;
      protected $guarded = array();
      protected $table="send_sms";
      public $PrimaryKey='id';
      protected $Filables=['vendor_id', 'mobile_number', 'message', 'response', 'created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];


		
  function Smssend($smsarray){
		$addresult=self::create($smsarray);
		return $addresult;
	} 


 

} 
?>