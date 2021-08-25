<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Query\Expression as raw;
class Address_model extends Eloquent{
	
    public $timestamps = false;
     protected $guarded = array();
    protected $table = "address"; // table name
    public $primaryKey = 'id';
    protected $fillable = ['house_no', 'street', 'area', 'landmark', 'city_id', 'state_id', 'country', 'pincode', 'geocoordinates', 'latitude', 'longitude', 'created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];

	public function addAddress($patientAddressarray)
	{
		$createaddress=self::create($patientAddressarray);
		$addressid=$createaddress->id;
		return $addressid;
	} 
	public function updateAddress($patientAddressarray,$address_id)
	{
		$updateaddress=self::where('address.id','=',$address_id)->update($patientAddressarray);
		return $updateaddress;
	}

		public function deleteAddress($address_id)
	{
		$deleteaddress=self::where('address.id','=',$address_id)->delete();
		return $deleteaddress;
	} 
	
}
?>

