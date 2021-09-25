<?php
defined('BASEPATH') or die('Please set up the configuration');
Class Doctor_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
	
    function ReferByADoctorList($userid)
    {
     $searchData=self::join('user_details as udp','udp.user_id','=','refer_a_doctor.refered_patient_id')
        ->join('user_details as uddt','uddt.user_id','=','refer_a_doctor.refered_to_doctor_id')
        ->join('user_details as uddb','uddb.user_id','=','refer_a_doctor.refered_by_doctor_id')
        ->join("address",'address.id','=','udp.address_id')
        ->leftjoin("cities",'cities.cityid','=','address.city_id')
        ->leftjoin("states",'states.state_id','=','address.state_id')
        ->where('refer_a_doctor.refered_to_doctor_id','=',$userid)
        ->get(['refer_a_doctor.id','refered_by_doctor_id','refered_to_doctor_id','refered_patient_id',new raw('CONCAT(uddt.first_name," ",uddt.last_name) as refer_to_doctorname'),new raw('CONCAT(uddb.first_name," ",uddb.last_name) as refer_by_doctorname'),new raw('CONCAT(udp.first_name," ",udp.last_name) as patient_name'),new raw('udp.mobileno as patient_mobileno'),new raw(" Concat(address.house_no,', ',address.street,', ',address.area,', ',address.landmark,', ',cities.cityname,', ',states.state_name,', ',address.pincode) as patient_address")]);
            return $searchData;
        
    } 

	//get detailed patient profile
	/*public function patient_All_Details($user_id){
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
	}*/
	


}