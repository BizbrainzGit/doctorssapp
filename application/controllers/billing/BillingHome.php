<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH.'controllers/billing/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use \Illuminate\Database\Capsule\Manager as Capsule;
class BillingHome extends BaseController{

	public function __construct(){
		parent::__construct("Normal");
		
		$this->load->helper(array('form', 'url','captcha','html','language'));
		$this->load->library(array('session', 'form_validation', 'email','ion_auth'));
        $this->load->database();
        $this->load->model('User');
        $this->load->model('Userdetails_model');
   
		
	}
        public function Dashboard()
		{         
            $this->load->view('billing/dashboard');
        }
     
    


}

?>