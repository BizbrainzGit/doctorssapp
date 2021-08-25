<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Query\Expression as raw;
include_once(APPPATH . 'controllers/CommonBaseController.php');
class BaseController extends CommonBaseController {

	public function __construct($redirectType = "Angular")
	{
		parent::__construct($redirectType);
		if(!isset($this->session->userdata) ||  strlen($this->session->userdata('user_roles')) == 0 || $this->session->userdata('user_roles')!='Billing') {
			$protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
			if ($redirectType == "Normal"){
				echo json_encode(array('success'=>false,'message'=>"Incorrect Username or Password"));
			} else{
				
				header($this->cprotocol . ' 401');
			}
			writeLogsAndDie();
		}
	}
}
?>
