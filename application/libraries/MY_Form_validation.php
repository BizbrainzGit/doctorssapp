<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation
{
	public function __construct( $config = array() )
	{
		parent::__construct($config);
	}
	
    public function error_array()
    {
        return $this->_error_array;
    }
    public function error_array_list_for_toastr()
	{
		if ($this->_error_array != null && count($this->_error_array) > 0){
			$str = "";
					
			foreach ($this->_error_array as $key => $value)
			{
				$str = $str . $value . "<br/>";
			}
			return trim($str,"<br/>");
		} else {
			return "Empty";
		}
	}
}

?>