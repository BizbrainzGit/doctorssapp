<?php
defined('BASEPATH') or die('Please set up the configuration');
Class Appointments_model extends CI_Model
{  public $app_db;
    public function __construct()
    {
        parent::__construct();
    }
	
	//get detailed patient profile
	public function get_acct_data($user_id){
		$response=array('code'=>204,'message'=>'','description'=>'');
        $this->db->select('
        ua.account_id,ua.role_id,a.account_name,a.dbname')->from('user_accounts ua');
        $this->db->where('ua.user_id',$user_id);
		$this->db->join('accounts a','a.id=ua.account_id')->limit(1);
		
	   $query=$this->db->get();
		//echo json_encode($query->result());
       // echo json_encode($this->db->last_query());
        $db_error=$this->db->error();
        if($db_error['code']!=0){
            $response['code']=DB_ERROR_CODE;
            $response['message']='';
            $response['description']=(QUERY_DEBUG==1)?$db_error['message']:'Some thing error occured';
        }
        else
        {
            $count=$query->num_rows();
			if($count>0){
				$response['code']= 200;
				$response['message']= 'Success';
				$response['description']= 'Getting the data';
				$response['result']= $query->result();
				//return json_encode($response);
			}	
        }
        return $response;
	}
	
	public function get_appointments($role_id,$user_id){
		$response=array('code'=>204,'message'=>'','description'=>$role_id);
     echo json_encode($response);
		$this->app_db->select('
        apt.id,pat.profile_pic_path,pat.first_name as patient_fname,pat.last_name as patient_lname,ud.first_name as doctor_fname, ud.last_name as doctor_lname,apt.appointment_date,apt.time_slot,bs.name')->from('appointment_details apt');
		$this->app_db->join('doctorss_master.user_details ud','apt.doctors_id=ud.user_id');
		$this->app_db->join('booking_status bs','bs.id=apt.status_id');
		$this->app_db->join('doctorss_master.user_details pat','pat.user_id=apt.patients_id');
	   	if($role_id==6)
          $this->app_db->where('apt.patients_id',$user_id);
	    else if($role_id==4)
          $this->app_db->where('apt.doctors_id',$user_id);
        			
	    
	   $query=$this->app_db->get();
		//echo json_encode($query->result());
       // echo json_encode($this->app_db->last_query());
        $db_error=$this->app_db->error();
        if($db_error['code']!=0){
            $response['code']=DB_ERROR_CODE;
            $response['message']='';
            $response['description']=(QUERY_DEBUG==1)?$app_db_error['message']:'Some thing error occured';
        }
        else
        {
            $count=$query->num_rows();
			if($count>0){
				$response['code']= 200;
				$response['message']= 'Success';
				$response['description']= 'Getting the data';
				$response['result']= $query->result();
			//	echo json_encode($response);
			}	
        }
        return $response;
	}
	
	// get all prescription details
	public function get_prescriptions($role_id,$user_id){
		$response=array('code'=>204,'message'=>'','description'=>$role_id);
     echo json_encode($response);
		$this->app_db->select('
        prs.id,pat.first_name as patient_fname,pat.last_name as patient_lname,ud.first_name as doctor_fname, ud.last_name as doctor_lname,ud.mobileno as doctor_mobile,prs.created_on as date,prs.symptoms,prs.diagnosis')->from('prescription prs');
		$this->app_db->join('doctorss_master.user_details ud','prs.doctor_user_id=ud.user_id');
	//	$this->app_db->join('booking_status bs','bs.id=apt.status_id');
		$this->app_db->join('doctorss_master.user_details pat','pat.user_id=prs.patient_user_id');
	   	if($role_id==6)
          $this->app_db->where('prs.patient_user_id',$user_id);
	    else if($role_id==4)
          $this->app_db->where('prs.doctor_user_id',$user_id);
        			
	    
	   $query=$this->app_db->get();
		//echo json_encode($query->result());
       // echo json_encode($this->app_db->last_query());
        $db_error=$this->app_db->error();
        if($db_error['code']!=0){
            $response['code']=DB_ERROR_CODE;
            $response['message']='';
            $response['description']=(QUERY_DEBUG==1)?$app_db_error['message']:'Some thing error occured';
        }
        else
        {
            $count=$query->num_rows();
			if($count>0){
				$response['code']= 200;
				$response['message']= 'Success';
				$response['description']= 'Getting the data';
				$response['result']= $query->result();
			//	echo json_encode($response);
			}	
        }
        return $response;
	}
	
	// get individual prescription details 
	public function get_prescription_by_id($prs_id){
		$response=array('code'=>204,'message'=>'','description'=>'no records');
    // echo json_encode($response);
		$this->app_db->select('
        prs.id,pat.first_name as patient_fname,pat.last_name as patient_lname,ud.first_name as doctor_fname, ud.last_name as doctor_lname,ud.mobileno as doctor_mobile,prs.created_on as date,prs.symptoms,prs.diagnosis')->from('prescription prs');
		$this->app_db->join('doctorss_master.user_details ud','prs.doctor_user_id=ud.user_id');
		$this->app_db->join('doctorss_master.user_details pat','pat.user_id=prs.patient_user_id');
	    $this->app_db->where('prs.id',$prs_id);
	
       $query=$this->app_db->get();
        $db_error=$this->app_db->error();
        if($db_error['code']!=0){
            $response['code']=DB_ERROR_CODE;
            $response['message']='';
            $response['description']=(QUERY_DEBUG==1)?$app_db_error['message']:'Some thing error occured';
        }
        else
        {
            $count=$query->num_rows();
			if($count>0){
				$response['code']= 200;
				$response['message']= 'Success';
				$response['description']= 'Getting the data';
				$response['result']= $query->result();
				$this->app_db->select('mt.medicaltest_name')->from('medical_test mt');
				$this->app_db->join('prescription_tests pt','pt.test_id=mt.id');
				$this->app_db->where('pt.prescription_id',$prs_id);
				$query1=$this->app_db->get();
					$response+=['tests'=>$query1->result()];
				$this->app_db->select('pm.medicine_name,pm.medicine_note')->from('prescription_medicine pm');
				$this->app_db->where('pm.prescription_id',$prs_id);
				$query=$this->app_db->get();
				$response+=['medicines'=>$query->result()];
				
				//  echo json_encode($this->app_db->last_query());
			
				
				
			//	echo json_encode($response);
			}	
        }
        return $response;
	}
	
	
	// get all Billings details
	public function get_billings($role_id,$user_id){
		$response=array('code'=>204,'message'=>'','description'=>$role_id);
    // echo json_encode($response);
		$this->app_db->select('
        bill.id,bill.created_on as Billdate,pat.first_name as patient_fname,pat.last_name as patient_lname,bill.grand_total_amount as GrandTotal')->from('patient_billing_test bill');
		$this->app_db->join('prescription prs','prs.id=bill.prescription_id');    	
		$this->app_db->join('doctorss_master.user_details pat','pat.user_id=prs.patient_user_id');
	    	//prescription_id
	   $query=$this->app_db->get();
		
     
        $db_error=$this->app_db->error();
        if($db_error['code']!=0){
            $response['code']=DB_ERROR_CODE;
            $response['message']='';
            $response['description']=(QUERY_DEBUG==1)?$app_db_error['message']:'Some thing error occured';
        }
        else
        {
            $count=$query->num_rows();
			if($count>0){
				$response['code']= 200;
				$response['message']= 'Success';
				$response['description']= 'Getting the data';
				$response['result']= $query->result();
				foreach($response['result'] as $row)
				{   
				  $this->app_db->select('mt.medicaltest_name as testname')->from('medical_test mt');
				  $this->app_db->join('billing_tests as bt','bt.test_id=mt.id');
				  $this->app_db->join('patient_billing_test pb','pb.id=patient_billing_id');
				  $this->app_db->where('bt.patient_billing_id',$row->id);
				  $testquery=$this->app_db->get();
          		  $db_error=$this->app_db->error();
	    		   $data[] = $testquery->result();
			       $row->tests=$testquery->result();
					
				}
			}	
        }
        return $response;
	}
	
	// get individual bill details 
	public function get_billings_by_id($bill_id){
		$response=array('code'=>204,'message'=>'','description'=>'no records');
    // echo json_encode($response);
	
		$this->app_db->select('
        bill.id,bill.created_on,pat.first_name as patient_fname,pat.last_name as patient_lname,ud.first_name as doctor_fname, ud.last_name as doctor_lname,ud.mobileno, as doctor_mobile,bill.grand_total_amount')->from('patient_billing_test bill');
			$this->app_db->join('prescription prs','prs.id=bill.prescription_id');    	
		$this->app_db->join('doctorss_master.user_details ud','prs.doctor_user_id=ud.user_id');
		$this->app_db->join('doctorss_master.user_details pat','pat.user_id=prs.patient_user_id');
	    $this->app_db->where('bill.id',$bill_id);
	
       $query=$this->app_db->get();
        $db_error=$this->app_db->error();
        if($db_error['code']!=0){
            $response['code']=DB_ERROR_CODE;
            $response['message']='';
            $response['description']=(QUERY_DEBUG==1)?$app_db_error['message']:'Some thing error occured';
        }
        else
        {
            $count=$query->num_rows();
			if($count>0){
				$response['code']= 200;
				$response['message']= 'Success';
				$response['description']= 'Getting the data';
				$response['result']= $query->result();
				$this->app_db->select('mt.medicaltest_name')->from('medical_test mt');
				$this->app_db->join('billing_tests bt','bt.test_id=mt.id');
				$this->app_db->where('pt.patient_billing_id',$bill_id);
				$query1=$this->app_db->get();
					$response+=['tests'=>$query1->result()];
				
				
				//  echo json_encode($this->app_db->last_query());
			
				
				
			//	echo json_encode($response);
			}	
        }
        return $response;
	}
	
	//get detailed patient profile
	public function all_Patient_Details($user_id){
		$response=array('code'=>204,'message'=>'','description'=>'');
		$this->db->select('ua.account_id')->from('user_accounts ua');
		$this->db->where('ua.user_id='.$user_id);
		$acctquery=$this->db->get();
		//echo json_encode();
		//echo json_encode($acctquery->account_id);
		//$acctno=$acctquery->result('account_id');
        $account_id=$acctquery->result()[0]->account_id;
		$this->db->select('u.username,u.email,ud.first_name,ud.last_name,ud.mobileno,ud.age,ud.profile_pic_path,adr.house_no,adr.street,adr.area,c.cityname,s.state_name,pd.id,pd.height,pd.weight,pd.blood_group,pd.blood_prusser,pd.pulse,pd.allergy,pd.diet')->from('users u');
		$this->db->join('user_accounts ua','ua.user_id=u.id');
        $this->db->where('ua.role_id=6 and ua.account_id='.$account_id);
		$this->db->join('user_details ud','u.id=ud.user_id');
		$this->db->join('address adr','adr.id=ud.address_id');
		$this->db->join('patient_details pd','pd.user_id=ud.user_id');
		$this->db->join('cities c','c.cityid=adr.city_id');
		$this->db->join('states s','s.state_id=c.state_id');
   
	   $query=$this->db->get();
		//echo json_encode($query->result());
      //  echo json_encode($this->db->last_query());
        $db_error=$this->db->error();
        if($db_error['code']!=0){
            $response['code']=DB_ERROR_CODE;
            $response['message']='';
            $response['description']=(QUERY_DEBUG==1)?$db_error['message']:'Some thing error occured';
        }
        else
        {
            $count=$query->num_rows();
			if($count>0){
				$response['code']= 200;
				$response['message']= 'Success';
				$response['description']= 'Getting the data';
				$response['result']= $query->result();
				//return json_encode($response);
			}	
        }
        return $response;
	}
	
	//get detailed patient profile
	public function edit_Patient_Details($user_id){
		$response=array('code'=>204,'message'=>'','description'=>'');
        $this->db->select('ud.first_name,ud.last_name,ud.mobileno,ud.gender,ud.age,ud.profile_pic_path,adr.house_no,adr.street,adr.area,adr.landmark,adr.pincode,c.cityid,c.cityname,s.state_id,s.state_name,pd.id,pd.height,pd.weight,pd.blood_group,pd.blood_prusser,pd.pulse,pd.allergy,pd.diet')->from('users u');
        $this->db->where('u.id',$user_id);
		$this->db->join('user_details ud','u.id=ud.user_id')->limit(1);
		$this->db->join('address adr','adr.id=ud.address_id')->limit(1);
		$this->db->join('patient_details pd','pd.user_id=ud.user_id')->limit(1);
		$this->db->join('cities c','c.cityid=adr.city_id');
		$this->db->join('states s','s.state_id=c.state_id');
   
	   $query=$this->db->get();
		//echo json_encode($query->result());
        //echo json_encode($this->db->last_query());
        $db_error=$this->db->error();
        if($db_error['code']!=0){
            $response['code']=DB_ERROR_CODE;
            $response['message']='';
            $response['description']=(QUERY_DEBUG==1)?$db_error['message']:'Some thing error occured';
        }
        else
        {
            $count=$query->num_rows();
			if($count>0){
				$response['code']= 200;
				$response['message']= 'Success';
				$response['description']= 'Getting the data';
				$response['result']= $query->result();
				//return json_encode($response);
			}	
        }
        return $response;
	}
    /*>>common method for updating data on required table code starts*/ 
    public function updatePatient($params)
    {
        //echo "test";exit;
                $response=array();
                if(!is_array($params))
                {
                        $response['code']=301;
                        $response['message']='Valiadtion';
                        $response['description']='Invalid input parameters';
                }
                else
                {
                        $table_name=  isset($params['table_name'])?$params['table_name']:'';
                        $table_update_data=isset($params['update_data'])?$params['update_data']:'';
                        $table_update_condition=isset($params['update_condition'])?$params['update_condition']:'';
                        $success_message=isset($params['success_message'])?$params['success_message']:'';
                        $error_message=isset($params['error_message'])?$params['error_message']:'';
                        $debug=isset($params['debug'])?$params['debug']:0;
                        if(!empty($table_name) && is_array($table_update_data) && (count($table_update_data) > 0) && is_array($table_update_condition) && (count($table_update_condition) > 0))
                        {
                                $table_name=  trim($table_name);
                                //Insert condition
                                $update_sql=$this->db->update_string($table_name,$table_update_data,$table_update_condition);
                                //echo $update_sql=$this->db->update_string($table_name,$table_update_data,$table_update_condition); exit;
                                if($debug==0)
                                {
                                    $success_message=($success_message!='')?$success_message:'updates successfully';
                                    $error_message=($error_message!='')?$error_message:'Unable to update';
                                    $update=  $this->db->query($update_sql);
                                    //echo $this->db->last_query();exit;
                                    $db_error=  $this->db->error();

                                    if($db_error['code']==0)
                                    {
                                        $update_row_count=  $this->db->affected_rows();
                                        $response['code']=($update_row_count > 0)?SUCCESS_CODE:FAIL_CODE;
                                        $response['message']=($update_row_count > 0)?'success':'fail';
                                        $response['description']=($update_row_count > 0)?$success_message:$error_message;
                                    }
                                    else
                                    {
                                        $response['code']=575;
                                        $response['message']='Data base error';
                                        $response['description']=(QUERY_DEBUG==1)?$db_error['message']:'Please inform to support team';
                                    }
                                }
                                else
                                {
                                    $response['code']=575;
                                    $response['message']='Debug mode';
                                    $response['description']=$update_sql;
                                }
                        }
                        else
                        {
                                $response['code']=301;
                                $response['message']='Valiadtion';
                                $response['description']='Table name or insert data is missing';
                        }
                }
                return json_encode($response);
    }
    /*<<common method for updating data on required table code ends*/
}