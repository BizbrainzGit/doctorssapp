<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
//$route['default_controller']              = 'Welcome';
$route['default_controller']           = 'FrontendController';
$route['404_override'] = '';
$route['translate_uri_dashes']            = FALSE;

// for Super Admin Role start //

$route['SuperAdmin-Dashboard']                   = 'superadmin/SuperAdminHome/Dashboard';
$route['SuperAdmin-Manage-Healthdepartment']     = 'superadmin/SpecializationController/SpecializationView';
$route['SuperAdmin-Manage-HospitalDetails']      = 'superadmin/HospitaldetailsController/HospitalDetailsView';
$route['SuperAdmin-Manage-Accounts']             = 'superadmin/AccountsController/AccountsView';
$route['SuperAdmin-Manage-Packages']             = 'superadmin/PackagesController/packagesView';
$route['SuperAdmin-Manage-Subscriptions']        = 'superadmin/SubscriptionController/SubscriptionView';
$route['SuperAdmin-Manage-PaymentsMethodes']     = 'superadmin/PaymentmodeController/PaymentmodeView';



$route['SuperAdmin-Manage-Promocode']             = 'superadmin/PromocodeController/managepromocodesview';

$route['SuperAdmin-Manage-Patient']               = 'superadmin/ManagePatientController/managepatientsview';

// $route['SuperAdmin-Manage-Subscriptions']         = 'SubscriptionController/subscriptionViewForSuperadmin';

$route['Superadmin-Manage-Profile']               = 'ProfileController/SuperAdminProfileView';


// for Super Admin Role End //


// for Admin Role start //

$route['Admin-Dashboard']                        = 'admin/AdminDashboardController/Dashboard';
$route['Admin-Manage-Doctors']                   = 'admin/DoctorController/DoctorView';

$route['Admin-Manage-MedicalTest']               = 'MedicalTestController/AdminMedicalTestView';
$route['Admin-Manage-MedicalTestCategory']       = 'MedicalTestCategoryController/AdminMedicalTestCategoryView';
$route['Admin-Manage-Profile']                   = 'ProfileController/AdminProfileView';
$route['Admin-Print-Prescription']               = 'PrescriptionController/PrescriptionViewForAdmin';
$route['Admin-Manage-Users']                     = 'EmployeesController/AdminemployeesView';
$route['Admin-Manage-Patients']                  = 'PatientController/PatientView';
$route['Admin-Manage-AppointmentBooking']        = 'AppointmentbookingController/AdminAppointmentBookingView';
$route['Admin-New-AppointmentBooking']           = 'AppointmentbookingController/AdminNewAppointmentBookingView';
$route['Admin-PendingForApproval-Appointments']  = 'AppointmentbookingController/AdminPendingForApprovalAppointmentsView';
$route['Admin-Doctor-Appointments-Report']       = 'DoctorsAppointmentsListController/AdminDoctorsAppointmentsListView';
$route['Admin-Doctor-Time-Schedule']             = 'DoctorTimeScheduleController/AdmindoctortimescheduleView';
// for Admin Role End //


// for Managing Director Role start //

$route['ManagingDirector-Dashboard']       = 'md/MDHome/Dashboard';
$route['ManagingDirector-Profile']         = 'ProfileController/MDProfileView';


// for Managing Director Role End //


// for Doctor Role start //

$route['Doctor-Dashboard']                   =  'doctor/DoctorHome/Dashboard';
$route['Doctor-Profile']                     =  'doctor/DoctorProfileController/DoctorProfileView';
$route['Doctor-Refer-A-Doctor']              =  'doctor/ReferADoctorController/ReferADoctorView';
$route['Doctor-Refer-By-A-Doctor']           =  'doctor/ReferADoctorController/ReferByADoctorView';

$route['Doctor-Manage-Prescription']         =  'PrescriptionController/PrescriptionViewForDoctor';
$route['Doctor-Patient-Medical-Receipts']    =  'PatientsmedicaltestsreceiptController/PatientsMedicalTestsReceiptViewForDoctor';
$route['Doctor-Manage-Appointments']         = 'AppointmentbookingController/DoctorAppointmentView';
$route['Doctor-Today-Appointments']          = 'TodayAppointmentsController/DoctorTodayAppointmentsView';
// for Doctor Role End //


// for Receptionist Role start //

$route['Receptionist-Dashboard']               = 'receptionist/ReceptionistHome/Dashboard';
$route['Receptionist-Profile']                 = 'receptionist/ReceptionistProfileController/ReceptionistProfileView';

$route['Receptionist-Manage-Patients']               = 'PatientController/Receptionist_PatientView';
$route['Receptionist-Manage-Appointments']           = 'AppointmentbookingController/ReceptionistAppointmentView';
$route['Receptionist-New-AppointmentBooking']        = 'AppointmentbookingController/ReceptionistNewAppointmentBookingView';
$route['Receptionist-PendingForApproval-Appointments']  = 'AppointmentbookingController/ReceptionistPendingForApprovalAppointmentsView';
$route['Receptionist-Doctor-Appointments-Report']    = 'DoctorsAppointmentsListController/ReceptionistDoctorsAppointmentsListView';
$route['Receptionist-Patients-MedicalTests-Receipt'] = 'PatientsmedicaltestsreceiptController/PatientsMedicalTestsReceiptViewForReceptionist';
$route['Receptionist-Add-Prescription']              = 'AddPrescriptionController/AddPrescriptionForReceptionist';
$route['Receptionist-Manage-Prescription']           = 'PrescriptionController/ManagePrescriptionViewForReceptionist';
$route['Receptionist-In-Patients']                   = 'InPatientController/InPatientViewForReceptionist';


// for Receptionist Role End //


// for Patient Role start //

$route['Patient-Dashboard']                 = 'patient/PatientHome/Dashboard';
$route['Patient-Profile']                   = 'patient/PatientProfileController/PatientProfileView';

// $route['Patient-Manage-Appointments']       = 'AppointmentsController/PatientAppointmentView';

$route['Patient-Manage-AppointmentBooking'] = 'AppointmentbookingController/PatientAppointmentBookingView';
$route['Patient-New-AppointmentBooking']    = 'AppointmentbookingController/PatientNewAppointmentBookingView';
$route['Patient-Print-Prescription']        = 'PrescriptionController/PrescriptionViewForPatient';
$route['Patient-MedicalTest-Bills']         = 'PatientBillingTestController/MedicalTestsBillingViewForPatient';
$route['Patient-MedicalTest-Reports']       = 'MedicalTestReportsController/MedicalTestReportListViewForPatient';


// for Patient Role End //

// for Laboratory Role start //

$route['Laboratory-Dashboard']                       = 'laboratory/LaboratoryHome/Dashboard';
$route['Laboratory-NewTestTemplate']                 = 'laboratory/TestTemplateController/AddTestTemplateView';

$route['Laboratory-New-MedicalTestReports']          = 'MedicalTestReportsController/AddMedicalTestReportView';
$route['Laboratory-Manage-MedicalTestReports']       = 'MedicalTestReportsController/MedicalTestReportListView';

// for Laboratory Role End //

// for Billing Role start //

$route['Billing-Dashboard']                 = 'billing/BillingHome/Dashboard';
$route['Billing-MedicalTestsBilling']       = 'PatientBillingTestController/MedicalTestsBillingView';
$route['Billing-AddMedicalTestsBilling']    = 'PatientBillingTestController/AddMedicalTestsBillingView';
// for Billing Role End //
$route['login']                           = 'LoginController/loginView';
$route['Customer-Registation']            = 'LoginController/CustomerRegistation';
$route['Forget-Password']                 = 'Forgot/ForgetPasswordView';

$route['Account-Select']                  = 'Welcome/AccountSelectView';


// for frontend view start //

$route['Contact']                   = 'FrontendController/ContactView';
$route['Listview']                  = 'FrontendController/ListView';
$route['Clinicview']                = 'FrontendController/ClinicView';
$route['Bookingview']               = 'FrontendController/AppointmentBookingView'; 
$route['Confirmview']               = 'FrontendController/ConfirmBookingView';

// for fronend view end //