<?php 
 
use \Illuminate\Database\Eloquent\Model as Eloquent ;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;
 
class Paymentmode_model extends Eloquent {
    public $timestamps = false;
    protected $table = "payment_mode"; // table name
    public $primaryKey = 'id';
    protected $fillable = ['paymentmode_name','created_ip','created_by','created_on','modified_ip','modified_by','modified_on'];
   

   public function PaymentmodeList()
	{
		$result=self::orderBy('payment_mode.paymentmode_name')->get();
		return $result;
	}
	public function addPaymentmode($paymentmodearray){
		
		$addresult=self::create($paymentmodearray);
		return $addresult;
	}

	
    
    function SearchPaymentmode()
	{
	 
    $listresult=self::where('payment_mode.id','!=',0)->get(['payment_mode.id','payment_mode.paymentmode_name']);
		return $listresult;
		
	} 

 function EditPaymentmode($id)
	   {
	    $editresult=self::where('payment_mode.id','=',$id)
		                // ->groupBy('payment_mode.id')
		                ->get(['payment_mode.id','payment_mode.paymentmode_name']);
		return $editresult;
	   }
function PaymentmodeUpdate($paymentmodearray,$id)
 	  {

	   $resultupdate=self::where('payment_mode.id','=',$id)->update($paymentmodearray);
       return $resultupdate;
     }

function DeletePaymentmode($id)
    {
	$deleteresult=self::where('id','=',$id)->delete();
       return $deleteresult;
    }     	 

}
?>