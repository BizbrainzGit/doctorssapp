<?php
include_once(APPPATH . 'models/CommonBase_model.php');

class Base_model extends CommonBase_model {
	private $conName = 'customerdbconnection';
	public function __construct($conNameNew=array()){
		parent::__construct($conNameNew);
		$this->connection = ($conNameNew != null && !is_array($conNameNew) ? $conNameNew : $this->conName);
       
         // echo $conName;   
	}



}