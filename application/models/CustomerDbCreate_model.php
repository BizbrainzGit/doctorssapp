<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent ;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;
class CustomerDbCreate_model extends Eloquent {
      public $timestamps=false;
      protected $guarded = array();

 function CreateDynamicDatabaseTables($database_name){
       
   	$servername = "localhost";
	  $username = "root";
	  $password = "BBtpl@4321w";
// Creating a connection
   $conn = new mysqli($servername, $username, $password);
// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

// Creating a database 
		$sql = "CREATE DATABASE ".$database_name ;
		if ($conn->query($sql) === TRUE) {
		   $response= "Database created successfully with the name ".$database_name;
		} else {
		    $response= "Error creating database: ".$conn->error;
		}
 // Create connection
	$conn = new mysqli($servername, $username, $password, $database_name);

// Check connection
	if ($conn->connect_error) {
	       die("Connection failed: " . $conn->connect_error);
	    }else {
		   $response= " Connected database successfully ";
		}

  $appointment_details ="CREATE TABLE appointment_details (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  doctors_id int(11) NOT NULL,
  specialization_id int(11) NOT NULL,
  appointment_date date NOT NULL,
  patients_id int(11) NOT NULL,
  diseases_description text NOT NULL,
  status_id int(11) NOT NULL DEFAULT 1,
  time_slot varchar(30) NOT NULL,
  created_ip varchar(20) DEFAULT NULL,
  created_by int(11) DEFAULT NULL,
  created_on datetime DEFAULT NULL,
  modified_ip varchar(20) DEFAULT NULL,
  modified_by int(11) DEFAULT NULL,
  modified_on datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT ";

  
  $billing_tests ="CREATE TABLE billing_tests (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  patient_billing_id int(11) NOT NULL,
  test_id int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

$booking_sattus ="CREATE TABLE booking_status (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";


$configuration_fields ="CREATE TABLE configuration_fields (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  configuration_id int(11) NOT NULL,
  field_name varchar(150) NOT NULL,
  field_value varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

$configuration_settings ="CREATE TABLE configuration_settings (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";


$doctors_time_schedule ="CREATE TABLE doctors_time_schedule (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  doctors_id int(11) NOT NULL,
  weekday enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL,
  appointment_type tinyint(2) NOT NULL COMMENT '1 for Online, 2 for Offline',
  shift_start_time time DEFAULT NULL,
  shift_end_time time DEFAULT NULL,
  patient_time varchar(120) DEFAULT NULL,
  created_ip varchar(100) DEFAULT NULL,
  created_by int(11) DEFAULT NULL,
  created_on datetime DEFAULT NULL,
  modified_ip varchar(100) DEFAULT NULL,
  modified_by int(11) DEFAULT NULL,
  modified_on datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";


$doctor_details ="CREATE TABLE doctor_details (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_id int(11) NOT NULL,
  designation varchar(200) NOT NULL,
  specialist varchar(200) NOT NULL,
  specialization_id int(11) NOT NULL,
  consultation_fee decimal(11,0) NOT NULL,
  blood_group varchar(200) DEFAULT NULL,
  education varchar(200) DEFAULT NULL,
  biography varchar(200) DEFAULT NULL,
  created_ip varchar(20) DEFAULT NULL,
  created_by int(11) DEFAULT NULL,
  created_on date DEFAULT NULL,
  modified_ip varchar(20) DEFAULT NULL,
  modified_by int(11) DEFAULT NULL,
  modified_on date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

$medicaltest_category ="CREATE TABLE medicaltest_category (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  category_name varchar(111) NOT NULL,
  created_ip varchar(100) DEFAULT NULL,
  created_by int(11) DEFAULT NULL,
  created_on datetime DEFAULT NULL,
  modified_ip varchar(100) DEFAULT NULL,
  modified_by int(11) DEFAULT NULL,
  modified_on datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ";

$medical_test =" CREATE TABLE medical_test (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  medicaltest_category_id int(11) NOT NULL,
  medicaltest_name varchar(111) NOT NULL,
  medicaltest_price decimal(10,2) NOT NULL,
  discretion varchar(111) NOT NULL,
  medicaltest_status int(11) NOT NULL,
  created_ip varchar(100) DEFAULT NULL,
  created_by int(11) DEFAULT NULL,
  created_on datetime DEFAULT NULL,
  modified_ip varchar(100) DEFAULT NULL,
  modified_by int(11) DEFAULT NULL,
  modified_on datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ";


$patient_billing_test ="CREATE TABLE patient_billing_test (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  billing_date date NOT NULL,
  prescription_id int(11) NOT NULL,
  promocode_id int(11) DEFAULT NULL,
  discount_amount decimal(10,2) DEFAULT 0.00,
  test_total_amount decimal(10,2) DEFAULT 0.00,
  sub_total_amount decimal(10,2) DEFAULT 0.00,
  gst_amount decimal(10,2) DEFAULT 0.00,
  grand_total_amount decimal(10,2) DEFAULT 0.00,
  paid_amount decimal(10,2) DEFAULT 0.00,
  due_amount decimal(10,2) DEFAULT 0.00,
  created_ip varchar(20) DEFAULT NULL,
  created_by int(11) DEFAULT NULL,
  created_on datetime DEFAULT NULL,
  modified_ip varchar(20) DEFAULT NULL,
  modified_by int(11) DEFAULT NULL,
  modified_on datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

$patient_medicaltest_report ="CREATE TABLE patient_medicaltest_report (
  id int(11) NOT NULL  AUTO_INCREMENT PRIMARY KEY,
  billing_id int(11) NOT NULL,
  medical_test_id int(11) NOT NULL,
  medical_test_report text NOT NULL,
  created_ip varchar(20) DEFAULT NULL,
  created_by int(11) DEFAULT NULL,
  created_on datetime DEFAULT NULL,
  modified_ip varchar(20) DEFAULT NULL,
  modified_by int(11) DEFAULT NULL,
  modified_on datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

$prescription =" CREATE TABLE prescription (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  patient_user_id int(11) NOT NULL,
  doctor_user_id int(11) NOT NULL,
  appointment_id int(11) NOT NULL,
  blood_pressure varchar(111) DEFAULT NULL,
  pulse_rate varchar(111) DEFAULT NULL,
  note text DEFAULT NULL,
  symptoms text DEFAULT NULL,
  diagnosis text DEFAULT NULL,
  prescription_photo varchar(111) DEFAULT NULL,
  created_ip varchar(111) DEFAULT NULL,
  created_by int(11) DEFAULT NULL,
  created_on datetime DEFAULT NULL,
  modified_ip varchar(111) DEFAULT NULL,
  modified_by int(11) DEFAULT NULL,
  modified_on datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

$prescription_medicine ="CREATE TABLE prescription_medicine (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  prescription_id int(11) NOT NULL,
  medicine_name varchar(111) NOT NULL,
  medicine_note text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";


$prescription_tests ="CREATE TABLE prescription_tests (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  prescription_id int(11) NOT NULL,
  test_id int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";  

 $test_templates ="CREATE TABLE test_templates (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  medical_test_id int(11) NOT NULL,
  test_template text NOT NULL,
  status int(11) NOT NULL,
  created_ip varchar(20) DEFAULT NULL,
  created_by int(11) DEFAULT NULL,
  created_on datetime DEFAULT NULL,
  modified_ip varchar(20) DEFAULT NULL,
  modified_by int(11) DEFAULT NULL,
  modified_on datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";  

       if ($conn->query($appointment_details) !== TRUE) {
		  $response="Error creating table: " . $conn->error;
		} else if ($conn->query($billing_tests) !== TRUE) {
		  $response="Error creating table: " . $conn->error;
		} else if ($conn->query($booking_sattus) !== TRUE) {
		  $response="Error creating table: " . $conn->error;
		} else if ($conn->query($configuration_fields) !== TRUE) {
		 $response="Error creating table: " . $conn->error;
		} else if ($conn->query($configuration_settings)!== TRUE) {
		  $response="Error creating table: " . $conn->error;
		} else if ($conn->query($doctor_details) !== TRUE) {
		  $response="Error creating table: " . $conn->error;
		} else if ($conn->query($doctors_time_schedule) !== TRUE) {
		 $response="Error creating table: " . $conn->error;
		} else if ($conn->query($medicaltest_category) !== TRUE) {
		 $response="Error creating table: " . $conn->error;
		} else if ($conn->query($medical_test) !== TRUE) {
		  $response="Error creating table: " . $conn->error;
		} else if ($conn->query($patient_billing_test) !== TRUE) {
		  $response="Error creating table: " . $conn->error;
		}else if ($conn->query($patient_medicaltest_report) !== TRUE) {
      $response="Error creating table: " . $conn->error;
    }  else if ($conn->query($prescription) !== TRUE) {
		  $response="Error creating table: " . $conn->error;  
		}  else if ($conn->query($prescription_medicine) !== TRUE) {
		  $response="Error creating table: " . $conn->error;  
		} else if ($conn->query($prescription_tests) !== TRUE) {
      $response="Error creating table: " . $conn->error;  
    } else if ($conn->query($test_templates) !== TRUE) {
      $response="Error creating table: " . $conn->error;  
    } else{
		   $response=" All Table created successfully";
		}




$insert_booking_status="INSERT INTO booking_status (id, name) VALUES
(1, 'Pending for Approval'),
(2, 'Approved & Booked'),
(3, 'Cancelled by User'),
(4, 'Visited Doctor'),
(5, 'User failed to Visit'),
(6, 'Cancelled By Doctor'),
(7, 'Completed Consultation')";

$insert_configuration_settings="INSERT INTO configuration_settings (id, name) VALUES
(1, 'SMTP Settings'),
(2, 'Google Settings'),
(3, 'IOS Settings'),
(4, 'Other Settings')";

$insert_configuration_fields="INSERT INTO configuration_fields (id, configuration_id, field_name, field_value) VALUES
(1, 1, 'smtp_host', NULL),
(2, 1, 'smtp_port', NULL),
(3, 1, 'smtp_username', NULL),
(4, 1, 'smtp_password', NULL),
(5, 2, 'map_api_key', NULL),
(6, 2, 'fcm_android_key', NULL),
(7, 3, 'ios_fcm_key', NULL),
(8, 3, 'ios_pem_file', NULL),
(9, 1, 'smtp_sender', NULL),
(10, 1, 'smtp_tls', '0'),
(11, 1, 'smtp_ssl', '1'),
(12, 4, 'SERVICE_URL', NULL),
(13, 4, 'DEFAULT_LOGO_IMAGE', NULL),
(14, 4, 'DEFAULT_AGENT_IMAGE', NULL)";


      if ($conn->query($insert_booking_status) !== TRUE) {
		  $response="Error inserting data : " . $conn->error;
		} else if ($conn->query($insert_configuration_settings) !== TRUE) {
		  $response="Error inserting data : " . $conn->error;
		} else if ($conn->query($insert_configuration_fields) !== TRUE) {
		  $response="Error inserting data : " . $conn->error;
		}else{
		   $response=" All Table Created  And Data Inserted successfully";
		}

	return $response;
}




} ?>