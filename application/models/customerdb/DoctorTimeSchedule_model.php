<?php 

include_once(APPPATH . 'models/customerdb/Base_model.php');
use \Illuminate\Database\Eloquent\Model as Eloquent;
use \Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;

class DoctorTimeSchedule_model extends Base_model {
      public $timestamps=false;
      protected $guarded = array();
      protected $table="doctors_time_schedule";
      public $PrimaryKey='id';
      protected $Filables=[ 'doctors_id', 'weekday', 'appointment_type','shift_start_time', 'shift_end_time', 'patient_time','created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];
		
  function AddDoctorTimeSchedule($doctortimeschedulearray)
	{
		$addresult=self::create($doctortimeschedulearray);
		return $addresult; 
	}
function DoctorTimeScheduleList($masterdb)
	{
	 $result=self::join("$masterdb.user_details",'user_details.user_id','=','doctors_time_schedule.doctors_id')
	              ->get(['doctors_time_schedule.id','weekday','appointment_type','patient_time',new raw('DATE_FORMAT(doctors_time_schedule.shift_start_time, "%l:%i %p") as shift_start_time'),new raw('DATE_FORMAT(doctors_time_schedule.shift_end_time, "%l:%i %p") as shift_end_time'),new raw(" Concat(user_details.first_name,' ',user_details.last_name) as doctor_name"),]);
		return $result;
	}	

function EditDoctorTimeSchedule($id)
	{
		$editresult=self::where('doctors_time_schedule.id','=',$id)->get();
		return $editresult;
	} 

function UpdateDoctorTimeSchedule($doctortimeschedulearray,$id)
	{
		$editresult=self::where('doctors_time_schedule.id','=',$id)->Update($doctortimeschedulearray);
		return $editresult;
	} 

function DeleteDoctorTimeSchedule($id){
				$deleteresult=self::where('doctors_time_schedule.id','=',$id)->delete();
			    return $deleteresult;
        
        }

  function getAppointmentScheduleTimeByDoctorId($appointment_doctorid,$dayofweek){

		$result=self::where('doctors_time_schedule.doctors_id','=',$appointment_doctorid)
		            ->where('doctors_time_schedule.weekday','=',$dayofweek)
		            ->get(['doctors_time_schedule.id', 'shift_start_time', 'shift_end_time', 'patient_time']);
       // echo $result;exit;
        return $result;
		
	}

   function CheckDoctorTimeSchedule($doctortimeschedule_doctorid,$doctortimeschedule_weekday,$doctortimeschedule_appointmenttype,$doctortimeschedule_timestart,$doctortimeschedule_timeend){
		$result=self::where('doctors_time_schedule.doctors_id','=',$doctortimeschedule_doctorid)
		             ->where('doctors_time_schedule.weekday','=',$doctortimeschedule_weekday)
		             //->where('doctors_time_schedule.appointment_type','=',$doctortimeschedule_appointmenttype)
		             ->whereRaw(' (("'.$doctortimeschedule_timestart.'" between shift_start_time and shift_end_time ) OR ("'.$doctortimeschedule_timeend.'" between shift_start_time and shift_end_time)) ')
		             ->get()->count();
        return $result;
		
	}





 //   function AppointmentTimeList()
	// {
	// 	$result=self::get(['doctors_time_schedule.id',new raw('CONCAT(morning_time_start," - ",morning_time_end) as morning_time'),new raw('CONCAT(afternoon_time_start," - ",afternoon_time_end) as afternoon_time'),new raw('CONCAT(evening_time_start," - ",evening_time_end) as evening_time') ]);
	// 	 return $result;
		
	// }


	// public function getAppointmentTimeByDoctorId($doctorId,$time,$masterdb){
		
		
	//   $result=self::join("$masterdb.user_details",'user_details.user_id','=','doctors_time_schedule.doctors_id')
	//                ->join("$masterdb.users",'users.id','=','user_details.user_id')
	//                ->where('doctors_time_schedule.doctors_id', '=',$doctorId)
	//                //->where('doctors_time_schedule.morning_time_start', '<' ,''.$time.'' )
	//                // ->where('user_accounts.account_id','=',$account_id)
	//                ->join('working_shifts','working_shifts.id','=','doctors_time_schedule.shift_id')
	//                ->get(['doctors_time_schedule.id','doctors_time_schedule.doctors_id' ,new raw(" Concat(user_details.first_name,' ',user_details.last_name) as doctor_name"),new raw(" Concat(shift_start_time,' - ',shift_end_time) as appointment_schedule_time"),new raw('DATE_FORMAT(doctors_time_schedule.weekday, "%d-%b") as appointment_schedule_date'),'doctors_time_schedule.shift_id','working_shifts.shift_name']);
	// 	return $result;
	// }

	








 //   function HeaderData(){
   	
	// 	return $this->hasMany('Appointmentbooking_model','appointment_schedule_id','id')
	// 	->join(new raw("doctorss_master.user_details as dmudp"),'dmudp.user_id','=','patients_id')
	// 	->join(new raw("doctorss_master.user_details as dmudd"),'dmudd.user_id','=','doctors_id')
	// 	->select('bookings.id','appointment_schedule_id','patients_id','doctors_id','specialization_id',new raw('CONCAT(dmudp.first_name," ",dmudp.last_name) as patient_name'),new raw('CONCAT(dmudd.first_name," ",dmudd.last_name) as doctor_name'),'dmudp.mobileno','dmudp.age',new raw('DATE_FORMAT(bookings.booking_time, "%l:%i %p") as booking_time'));
	// }
	
	// function DoctorsAppointmentsList($appointmentslist_specialization,$appointmentslist_doctor,$appointmentslist_date,$appointmentslist_shift,$masterdb)
	// { 
	//    $result=self::with('HeaderData')

	//     ->Where( function($result) use ($appointmentslist_specialization,$appointmentslist_doctor,$appointmentslist_date,$appointmentslist_shift){
	// 	if(count($appointmentslist_date)>0 && (!is_null($appointmentslist_date))  && (!empty($appointmentslist_date))){
	// 		$result->whereRaw("doctors_time_schedule.weekday ='".$appointmentslist_date."'");
	// 	   }
	//      if(count($appointmentslist_doctor)>0 && (!is_null($appointmentslist_doctor))  && (!empty($appointmentslist_doctor))){
	// 		   $result->whereRaw("doctors_time_schedule.doctors_id ='".$appointmentslist_doctor."'");
	// 	   } 
	// 	 if(count($appointmentslist_specialization)>0 && (!is_null($appointmentslist_specialization))  && (!empty($appointmentslist_specialization))){
	// 		 $result->whereRaw("bookings.specialization_id ='".$appointmentslist_specialization."'");
	// 	   }
	// 	 if(count($appointmentslist_shift)>0 && (!is_null($appointmentslist_shift))  && (!empty($appointmentslist_shift))){
 //               $result->whereRaw("doctors_time_schedule.shift_id ='".$appointmentslist_shift."'");
	// 	   }
		   
	// 	  });
	// 	 $doctorScheduleData=$result
	// 	 ->join(new raw("$masterdb.user_details as mudd"),'mudd.user_id','=','doctors_time_schedule.doctors_id')
	// 	 ->leftjoin('bookings','bookings.appointment_schedule_id','=','doctors_time_schedule.id')
	// 	 ->join('working_shifts','working_shifts.id','=','doctors_time_schedule.shift_id')
	// 	 ->orderBy('doctors_time_schedule.weekday', 'desc')
	// 	 ->groupBy('doctors_time_schedule.doctors_id')
	// 	 // ->where('doctors_time_schedule.weekday'<=today)
	// 	 ->get(['doctors_time_schedule.id',new raw('DATE_FORMAT(doctors_time_schedule.weekday, "%d-%m-%Y") as weekday'),'patient_time',new raw('CONCAT(mudd.first_name," ",mudd.last_name) as doctor_name'),'doctors_time_schedule.shift_id','working_shifts.shift_name']);

 //     return $doctorScheduleData;	
		
	// } 
  

	// function DoctorsAppointmentsReport($masterdb)
	// { 
	// 	$result=self::with('HeaderData');
	// 	$doctorScheduleData=$result
	// 	   ->join(new raw("$masterdb.user_details as mudd"),'mudd.user_id','=','doctors_time_schedule.doctors_id')
	// 	   ->leftjoin('bookings','bookings.appointment_schedule_id','=','doctors_time_schedule.id')
	// 	   ->join('working_shifts','working_shifts.id','=','doctors_time_schedule.shift_id')
	//       ->orderBy('doctors_time_schedule.weekday', 'desc')
	// 	  ->groupBy('doctors_time_schedule.doctors_id')
	//       ->get(['doctors_time_schedule.id',new raw('DATE_FORMAT(doctors_time_schedule.weekday, "%d-%m-%Y") as weekday'),'patient_time',new raw('CONCAT(mudd.first_name," ",mudd.last_name) as doctor_name'),'doctors_time_schedule.shift_id','working_shifts.shift_name']);
 //     return $doctorScheduleData;	
		
	// } 

} 
?>