<?php
defined('BASEPATH') or die('Please set up the configuration');
Class Patient_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
	
	//get detailed patient profile
	public function patient_All_Details($user_id){
		$response=array('code'=>204,'message'=>'','description'=>'');
        $this->db->select('u.username,u.email,ud.first_name,ud.last_name,ud.mobileno,ud.age,ud.gender,ud.profile_pic_path,adr.house_no,adr.street,adr.area,adr.pincode,c.cityid,c.cityname,s.state_id,s.state_name,pd.id,pd.height,pd.weight,pd.blood_group,pd.blood_prusser,pd.pulse,pd.allergy,pd.diet')->from('users u');
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
		$this->db->select('u.username,u.email,ud.user_id,ud.first_name,ud.last_name,ud.mobileno,ud.age,ud.gender,ud.profile_pic_path,adr.house_no,adr.street,adr.area,adr.pincode,c.cityid,c.cityname,s.state_id,s.state_name,pd.id,pd.height,pd.weight,pd.blood_group,pd.blood_prusser,pd.pulse,pd.allergy,pd.diet')->from('users u');
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
            else
			{
				$response['code']= 204;
				$response['message']= 'Failure';
				$response['description']= 'No patient with this id';
							
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

	//get detailed patient profile
	public function doctor_All_Details($user_id){
		$response=array('code'=>204,'message'=>'','description'=>'');
		$this->app_db->select('ua.account_id')->from('doctorss_master.user_accounts ua');
		$this->app_db->where('ua.user_id='.$user_id);
		$acctquery=$this->app_db->get();
		$account_id=$acctquery->result()[0]->account_id;
		$this->app_db->select('u.username,u.email,ud.first_name,ud.last_name,ud.mobileno,ud.age,ud.gender,ud.profile_pic_path,dd.designation,dd.consultation_fee,dd.blood_group,dd.education,dd.biography,adr.house_no,adr.street,adr.area,adr.pincode,c.cityid,c.cityname,s.state_id,s.state_name')->from('doctorss_master.users u');
		$this->app_db->join('doctorss_master.user_accounts ua','ua.user_id=u.id');
        $this->app_db->join('doctorss_master.user_details ud','u.id=ud.user_id');
		$this->app_db->join('doctor_details dd','dd.user_id='.$user_id);
		$this->app_db->join('doctorss_master.address adr','adr.id=ud.address_id');
		$this->app_db->join('doctorss_master.cities c','c.cityid=adr.city_id');
		$this->app_db->join('doctorss_master.states s','s.state_id=c.state_id');
		$this->app_db->where('ua.role_id=4 and ua.account_id='.$account_id.' and ud.user_id='.$user_id);
   
	   $query=$this->app_db->get();
		//echo json_encode($query->result());
      //  echo json_encode($this->db->last_query());
        $db_error=$this->app_db->error();
        if($db_error['code']!=0){
            $response['code']=DB_ERROR_CODE;
            $response['message']='Failure';
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
            else
     		{
	            $response['code']= 204;
				$response['message']= 'Failure';
				$response['description']= 'No data found';
				
				

         	}				
        }
        return $response;
	}
	


}