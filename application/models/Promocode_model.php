<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent ;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;
class Promocode_model extends Eloquent {
	
      public $timestamps=false;
      protected $guarded = array();
      protected $table="promocodes";
      public $PrimaryKey='id';
      protected $Filables=['coupon_code','discount_amount','discount_percentage','valid_form','valid_to','created_date','created_ip','created_by','created_on','modified_ip','modified_by','modified_on'];


			
		
  function Addpromocode($promocodearray){
		$addresult=self::create($promocodearray);
		return $addresult;
	} 


 function EditPromocode($id){
		$editresult=self::where('promocodes.id','=',$id)->groupBy('promocodes.id')->get(['promocodes.id','promocodes.coupon_code','promocodes.discount_percentage','promocodes.discount_amount', new raw('DATE_FORMAT(promocodes.valid_form, "%d-%m-%Y") as valid_form'), new raw('DATE_FORMAT(promocodes.valid_to, "%d-%m-%Y") as valid_to')]);
		return $editresult;
	} 

 function PromocodeList(){
		$datalistresult=self::groupBy('promocodes.id')->get(['promocodes.id','promocodes.coupon_code','promocodes.discount_percentage','promocodes.discount_amount', new raw('DATE_FORMAT(promocodes.valid_form, "%d-%m-%Y") as valid_form'), new raw('DATE_FORMAT(promocodes.valid_to, "%d-%m-%Y") as valid_to')]);
		return $datalistresult;
	}	

 function promocodeUpdate($promocodearray,$id){
		$updatedpromocode=self::where('promocodes.id','=',$id)->update($promocodearray);
		return $updatedpromocode;
	}

 function DeletePromocode($id){

	$deleteresult=self::where('id','=',$id)->delete();
    return $deleteresult;
        
        }

 function PromocodeAmount($promocode,$todaydate){

	$getresult=self::where('coupon_code','=',$promocode)
	->where('promocodes.valid_to','>=',$todaydate)
    ->where('promocodes.valid_form','<=',$todaydate)->get();
    return $getresult;
        
        }

 function SearchPromocodes($promocode_todate,$promocode_formdate){
             
         if($promocode_todate!='' &&$promocode_formdate!=' '){
		
			$service="\n AND created_on BETWEEN '$promocode_formdate' AND '$promocode_todate'";
			
		}
		else{
			$service= " ";
		}
		
           $searchagentData=Capsule::select("SELECT promocodes.id as id, promocodes.coupon_code,promocodes.discount_percentage,promocodes.discount_amount,DATE_FORMAT(promocodes.valid_form,'%d-%m-%Y') as valid_form,DATE_FORMAT(promocodes.valid_to,'%d-%m-%Y') as valid_to
		from promocodes WHERE promocodes.id !=0 ".$service);     
	return $searchagentData;

	}


} 
?>