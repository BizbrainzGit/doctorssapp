<?php defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;

class TestDBconnection extends CI_Controller {

   public function __construct(){
			parent::__construct();
			
		}	
  
public function CreateNewDB()
{
    $database_name="babutest7" ;
   echo $a= CreateDynamicDatabaseTables($database_name);


}



public function ConnectionNewDB()
{   
     $servername = "localhost";
     $username = "root";
     $password = "BBtpl@4321w";
     $dbname ="babutest1";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}else {
		    echo " Connected database successfully ";
		}

$appointment_schedule ="CREATE TABLE appointment_schedule (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  doctors_id int(11) NOT NULL,
  working_days varchar(50) NOT NULL,
  morning_time_start time DEFAULT NULL,
  morning_time_end time DEFAULT NULL,
  morning_tokens int(11) NOT NULL,
  afternoon_time_start time DEFAULT NULL,
  afternoon_time_end time DEFAULT NULL,
  afternoon_tokens int(11) NOT NULL,
  evening_time_start time DEFAULT NULL,
  evening_time_end time DEFAULT NULL,
  evening_tokens int(11) NOT NULL,
  created_ip varchar(100) DEFAULT NULL,
  created_by int(11) DEFAULT NULL,
  created_on datetime DEFAULT NULL,
  modified_ip varchar(100) DEFAULT NULL,
  modified_by int(11) DEFAULT NULL,
  modified_on datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";



$bookings ="CREATE TABLE bookings (
  id int(11) NOT NULL,
  doctors_id int(11) NOT NULL,
  specialization_id int(11) NOT NULL,
  appointment_schedule_id int(11) NOT NULL,
  patients_id int(11) NOT NULL,
  diseases_description text NOT NULL,
  datetime_start datetime NOT NULL,
  datetime_end datetime NOT NULL,
  status_id int(11) NOT NULL DEFAULT 1,
  created_ip varchar(20) DEFAULT NULL,
  created_by int(11) DEFAULT NULL,
  created_on datetime DEFAULT NULL,
  modified_ip varchar(20) DEFAULT NULL,
  modified_by int(11) DEFAULT NULL,
  modified_on datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT";


$booking_sattus ="CREATE TABLE booking_sattus (
  id int(11) NOT NULL,
  name varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";


$configuration_fields ="CREATE TABLE configuration_fields (
  id int(11) NOT NULL,
  configuration_id int(11) NOT NULL,
  field_name varchar(150) NOT NULL,
  field_value varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

$configuration_settings ="CREATE TABLE configuration_settings (
  id int(11) NOT NULL,
  name varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

$doctor_details ="CREATE TABLE doctor_details (
  id int(11) NOT NULL,
  user_id int(11) NOT NULL,
  designation varchar(200) NOT NULL,
  specialist varchar(200) NOT NULL,
  specialization_id int(11) NOT NULL,
  blood_group varchar(200) NOT NULL,
  education varchar(200) NOT NULL,
  biography varchar(200) NOT NULL,
  created_ip varchar(20) NOT NULL,
  created_by int(11) NOT NULL,
  created_on date NOT NULL,
  modified_ip varchar(20) NOT NULL,
  modified_by int(11) NOT NULL,
  modified_on date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";


$invoice_details ="CREATE TABLE invoice_details (
  id int(11) NOT NULL,
  patient_id int(11) NOT NULL,
  invoice_title varchar(111) NOT NULL,
  invoice_amount varchar(111) NOT NULL,
  payment_mode_id int(11) NOT NULL,
  payment_status_id int(11) NOT NULL,
  created_ip varchar(20) DEFAULT NULL,
  created_by int(11) DEFAULT NULL,
  created_on datetime DEFAULT NULL,
  modified_ip varchar(20) DEFAULT NULL,
  modified_by int(11) DEFAULT NULL,
  modified_on datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";



$patient_details =" CREATE TABLE patient_details (
  id int(11) NOT NULL,
  user_id int(11) UNSIGNED NOT NULL,
  height varchar(11) DEFAULT NULL,
  weight varchar(11) DEFAULT NULL,
  blood_group varchar(111) DEFAULT NULL,
  blood_prusser varchar(111) DEFAULT NULL,
  pulse varchar(111) DEFAULT NULL,
  allergy varchar(111) DEFAULT NULL,
  diet varchar(111) DEFAULT NULL,
  created_ip varchar(20) DEFAULT NULL,
  created_by int(11) DEFAULT NULL,
  created_on datetime DEFAULT NULL,
  modified_ip varchar(20) DEFAULT NULL,
  modified_by int(11) DEFAULT NULL,
  modified_on datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1; ";


$prescription =" CREATE TABLE prescription (
  id int(11) NOT NULL,
  user_id int(11) NOT NULL,
  medicine varchar(200) NOT NULL,
  test varchar(200) NOT NULL,
  note varchar(200) NOT NULL,
  symptoms varchar(200) NOT NULL,
  diagnosis varchar(200) NOT NULL,
  created_ip varchar(111) NOT NULL,
  created_by int(11) NOT NULL,
  created_on datetime NOT NULL,
  modified_ip varchar(111) NOT NULL,
  modified_by int(11) NOT NULL,
  modified_on datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ";



$prescription_tests ="CREATE TABLE prescription_tests (
  id int(11) NOT NULL,
  prescription_id int(11) NOT NULL,
  test_id int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ";


if ($conn->query($appointment_schedule) === TRUE) {
		  echo "appointment_schedule Table created successfully";
		} else {
		  echo "Error creating table: " . $conn->error;
		}		




if($conn->query($bookings) === TRUE) {
		  echo "bookings Table created successfully";
		} else {
		  echo "Error creating table: " . $conn->error;
		}		



if ($conn->query($booking_sattus) === TRUE) {
		  echo "booking_sattus Table created successfully";
		} else {
		  echo "Error creating table: " . $conn->error;
		}		







if ($conn->query($configuration_fields) === TRUE) {
		  echo "configuration_fields Table created successfully";
		} else {
		  echo "Error creating table: " . $conn->error;
		}		



if ($conn->query($configuration_settings) === TRUE) {
		  echo "configuration_settings Table created successfully";
		} else {
		  echo "Error creating table: " . $conn->error;
		}		



if ($conn->query($doctor_details) === TRUE) {
		  echo "doctor_details Table created successfully";
		} else {
		  echo "Error creating table: " . $conn->error;
		}		



if ($conn->query($invoice_details) === TRUE) {
		  echo "invoice_details Table created successfully";
		} else {
		  echo "Error creating table: " . $conn->error;
		}		



if ($conn->query($patient_details) === TRUE) {
		  echo "patient_details Table created successfully";
		} else {
		  echo "Error creating table: " . $conn->error;
		}		



if ($conn->query($prescription) === TRUE) {
		  echo "prescription Table created successfully";
		} else {
		  echo "Error creating table: " . $conn->error;
		}		



if ($conn->query($prescription_tests) === TRUE) {
		  echo "prescription_tests Table created successfully";
		} else {
		  echo "Error creating table: " . $conn->error;
		}		




}


}?>