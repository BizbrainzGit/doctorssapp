<?php
include_once(APPPATH . 'models/customerdb/Base_model.php');
use \Illuminate\Database\Eloquent\Model as Eloquent;
use \Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;

class Appointmentbooking_model extends Base_model {
	public $timestamps = false;
	protected $table = 'appointment_details';
	protected $primaryKey = 'id';
	protected $fillable = ['patients_id', 'doctors_id','specialization_id','appointment_date','diseases_description','status_id','time_slot', 'created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];

public function addAppointmentbooking($appointmentbookingarray){
		$addresult=self::create($appointmentbookingarray);
		return $addresult;
	}

function SearchAppointmentbooking($doctors_id,$patients_id,$masterdb)
	{ 
		$result=self::Where( function($result) use ($patients_id,$doctors_id){
			if(count($patients_id)>0 && (!is_null($patients_id))  && (!empty($patients_id))){
				$result->whereRaw("appointment_details.patients_id ='".$patients_id."'");
			}
			if(count($doctors_id)>0 && (!is_null($doctors_id))  && (!empty($doctors_id))){
				$result->whereRaw("appointment_details.doctors_id ='".$doctors_id."'");
			}
		   });

		
		 $searchData=$result
		 ->join(new raw("$masterdb.user_details as mudp"),'mudp.user_id','=','appointment_details.patients_id')
		 ->join(new raw("$masterdb.user_details as mudd"),'mudd.user_id','=','appointment_details.doctors_id')
		 ->join('booking_status','booking_status.id','=','appointment_details.status_id')
		 ->groupBy('appointment_details.id')
		 ->whereNotIn('appointment_details.status_id',array(1))
		 // ->whereRaw('Date(appointment_date) = CURDATE()')
		 ->get(['appointment_details.id',new raw('CONCAT(mudp.first_name,"  ",mudp.last_name) as patient_name'),new raw('CONCAT(mudd.first_name," ",mudd.last_name) as doctor_name'),'mudp.mobileno','mudp.profile_pic_path','appointment_details.patients_id','appointment_details.doctors_id','appointment_details.created_by','appointment_details.status_id',new raw('DATE_FORMAT(appointment_date, "%d-%m-%Y") as appointment_date'),'time_slot','booking_status.name as status_name']);

     return $searchData;	
		
	} 


function EditAppointmentbooking($id)
	{
	   $result=self::where('appointment_details.id','=',$id)
		          ->get(['appointment_details.id','patients_id', 'doctors_id','specialization_id','appointment_date','diseases_description','status_id','time_slot']);
		return $result;
		
	} 

function updateAppointmentbooking($data,$id)
	  {  
		$addresult=self::where('id','=',$id)->Update($data);
		return $addresult;
	}

function DeleteAppointmentbooking($id)
	{
		 $listresult= self::where('id','=',$id)->delete(); 
		return $listresult;
	}

  function updateStatus($statusarray, $id){
	   $resultupdate=self::where('id','=',$id)->update($statusarray);
        return $resultupdate;
		}

  public function TodayAppointmentsForAdmin($today){
	   $result=self:: where('appointment_details.appointment_date','=',$today)
	   ->count();
        return $result;

	}
	public function TotalAppointmentsForAdmin($month){
	    $result=self::where(new raw("(DATE_FORMAT(appointment_details.appointment_date,'%Y-%m'))"),'=',$month)
	   ->count();
        return $result;

	}		

function AddPrescriptionData($id,$masterdb)
	{
	   $result=self::where('appointment_details.id','=',$id)
	               ->where('appointment_details.status_id','=',4)
                   ->join("$masterdb.user_details as ud",'ud.user_id','=','appointment_details.patients_id')
		           ->join("$masterdb.user_details",'user_details.user_id','=','appointment_details.doctors_id')
		           ->get(['user_details.user_id',new raw('CONCAT(ud.first_name,"  ",ud.last_name) as patient_name'),'appointment_details.id','appointment_details.patients_id','appointment_details.doctors_id','appointment_details.specialization_id','appointment_details.appointment_date','diseases_description']);
		return $result;
		
	} 

function getAppointmentTimeSlotByScheduleId($appointment_doctorid, $appointment_date1){
            $result=self::where('appointment_details.appointment_date','=',$appointment_date1)
                  ->where('appointment_details.doctors_id','=',$appointment_doctorid)
		          ->get(['appointment_details.appointment_date',new raw('GROUP_CONCAT(DISTINCT(time_slot)) as time_slot')]);
		          return $result;
   
        }

function SearchPendingForApprovalAppointments($doctors_id,$patients_id,$masterdb)
	{ 
		$result=self::Where( function($result) use ($patients_id,$doctors_id){
			if(count($patients_id)>0 && (!is_null($patients_id))  && (!empty($patients_id))){
				$result->whereRaw("appointment_details.patients_id ='".$patients_id."'");
			}
			if(count($doctors_id)>0 && (!is_null($doctors_id))  && (!empty($doctors_id))){
				$result->whereRaw("appointment_details.doctors_id ='".$doctors_id."'");
			}
		   });

		// $result=self::Where( function($result) use ($doctors_id){
		// 	if(count($doctors_id)>0 && (!is_null($doctors_id))  && (!empty($doctors_id))
		// 		$result->whereRaw("appointment_details.doctors_id ='".$doctors_id."'");
		// 	}
		//    });

		
		 $searchData=$result
		 ->join(new raw("$masterdb.user_details as mudp"),'mudp.user_id','=','appointment_details.patients_id')
		 ->join(new raw("$masterdb.user_details as mudd"),'mudd.user_id','=','appointment_details.doctors_id')
		  ->join('booking_status','booking_status.id','=','appointment_details.status_id')

		 ->groupBy('appointment_details.id')
		 //->whereRaw('Date(appointment_date) = CURDATE()')
		 ->where('appointment_details.status_id','=',1)
		 ->get(['appointment_details.id',new raw('CONCAT(mudp.first_name,"  ",mudp.last_name) as patient_name'),new raw('CONCAT(mudd.first_name," ",mudd.last_name) as doctor_name'),'mudp.mobileno','mudp.profile_pic_path','appointment_details.patients_id','appointment_details.doctors_id','appointment_details.created_by','appointment_details.status_id',new raw('DATE_FORMAT(appointment_date, "%d-%m-%Y") as appointment_date'),'time_slot','booking_status.name as status_name']);

     return $searchData;	
		
	} 

function SearchAppointmentsForAddPrescription($doctors_id,$patients_id,$masterdb)
	{ 
		$result=self::Where( function($result) use ($patients_id,$doctors_id){
			if(count($patients_id)>0 && (!is_null($patients_id))  && (!empty($patients_id))){
				$result->whereRaw("appointment_details.patients_id ='".$patients_id."'");
			}
			if(count($doctors_id)>0 && (!is_null($doctors_id))  && (!empty($doctors_id))){
				$result->whereRaw("appointment_details.doctors_id ='".$doctors_id."'");
			}
		   });

		
		 $searchData=$result
		 ->join(new raw("$masterdb.user_details as mudp"),'mudp.user_id','=','appointment_details.patients_id')
		 ->join(new raw("$masterdb.user_details as mudd"),'mudd.user_id','=','appointment_details.doctors_id')
		 ->join('booking_status','booking_status.id','=','appointment_details.status_id')
		 ->groupBy('appointment_details.id')
		 ->whereNotIn('appointment_details.status_id',array(1))
		 ->where('appointment_details.status_id','=',4)
		 // ->whereRaw('Date(appointment_date) = CURDATE()')
		 ->get(['appointment_details.id',new raw('CONCAT(mudp.first_name,"  ",mudp.last_name) as patient_name'),new raw('CONCAT(mudd.first_name," ",mudd.last_name) as doctor_name'),'mudp.mobileno','mudp.profile_pic_path','appointment_details.patients_id','appointment_details.doctors_id','appointment_details.created_by','appointment_details.status_id',new raw('DATE_FORMAT(appointment_date, "%d-%m-%Y") as appointment_date'),'time_slot','booking_status.name as status_name']);

     return $searchData;	
		
	} 

function SearchTodayAppointments($doctors_id,$patients_id,$masterdb)
	{ 
		$result=self::Where( function($result) use ($patients_id,$doctors_id){
			if(count($patients_id)>0 && (!is_null($patients_id))  && (!empty($patients_id))){
				$result->whereRaw("appointment_details.patients_id ='".$patients_id."'");
			}
			if(count($doctors_id)>0 && (!is_null($doctors_id))  && (!empty($doctors_id))){
				$result->whereRaw("appointment_details.doctors_id ='".$doctors_id."'");
			}
		   });

		
		 $searchData=$result
		 ->join(new raw("$masterdb.user_details as mudp"),'mudp.user_id','=','appointment_details.patients_id')
		 ->join(new raw("$masterdb.user_details as mudd"),'mudd.user_id','=','appointment_details.doctors_id')
		 ->join('booking_status','booking_status.id','=','appointment_details.status_id')
		 ->groupBy('appointment_details.id')
		 ->whereNotIn('appointment_details.status_id',array(1))
		 ->where('appointment_details.status_id','=',2)
		 ->whereRaw('Date(appointment_date) = CURDATE()')
		 ->get(['appointment_details.id',new raw('CONCAT(mudp.first_name,"  ",mudp.last_name) as patient_name'),new raw('CONCAT(mudd.first_name," ",mudd.last_name) as doctor_name'),'mudp.mobileno','mudp.profile_pic_path','appointment_details.patients_id','appointment_details.doctors_id','appointment_details.created_by','appointment_details.status_id',new raw('DATE_FORMAT(appointment_date, "%d-%m-%Y") as appointment_date'),'time_slot','booking_status.name as status_name']);

     return $searchData;	
		
	} 


	function AllAppointmentForDashboard($doctors_id,$patients_id)
	{ 
		$result=self::Where( function($result) use ($patients_id,$doctors_id){
			if(count($patients_id)>0 && (!is_null($patients_id))  && (!empty($patients_id))){
				$result->whereRaw("appointment_details.patients_id ='".$patients_id."'");
			}
			if(count($doctors_id)>0 && (!is_null($doctors_id))  && (!empty($doctors_id))){
				$result->whereRaw("appointment_details.doctors_id ='".$doctors_id."'");
			}
		   });

		 $searchData=$result->get(['appointment_details.id',new raw('count(appointment_details.id) as total_appointmentacount')]);
     return $searchData;	
		
	}

	function AllAllTodayAppointmentForDashboard($doctors_id,$patients_id)
	{ 
		$result=self::Where( function($result) use ($patients_id,$doctors_id){
			if(count($patients_id)>0 && (!is_null($patients_id))  && (!empty($patients_id))){
				$result->whereRaw("appointment_details.patients_id ='".$patients_id."'");
			}
			if(count($doctors_id)>0 && (!is_null($doctors_id))  && (!empty($doctors_id))){
				$result->whereRaw("appointment_details.doctors_id ='".$doctors_id."'");
			}
		   });

		
		 $searchData=$result->whereNotIn('appointment_details.status_id',array(1))
		 ->where('appointment_details.status_id','=',2)
		 ->whereRaw('Date(appointment_date) = CURDATE()')
		 ->get(['appointment_details.id',new raw('count(appointment_details.id) as total_todayappointmentcount')]);

     return $searchData;	
		
	} 
	
}?>