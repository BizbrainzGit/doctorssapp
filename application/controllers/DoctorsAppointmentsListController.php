<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/CommonBaseController.php');

error_reporting(1);
ob_start();
use Illuminate\Database\Query\Expression as raw;
use \Illuminate\Database\Capsule\Manager as Capsule;

class DoctorsAppointmentsListController extends CommonBaseController {
	
	public function __construct()
	{
		parent::__construct();
		 $this->load->library(array('form_validation','ValidationTypes','excel','session','ion_auth'));
		 $this->load->helper(array('url','html','form','util_helper','language'));
		 $this->load->database();
		 $this->load->model('User');
		 $this->load->model('Userdetails_model');
		 $this->load->model('customerdb/Appointmentbooking_model');
     $this->load->model('customerdb/DoctorTimeSchedule_model'); 
     $this->load->model('customerdb/AppoinmentShift_model');
		

    }
	
 public function AdminDoctorsAppointmentsListView()
      {
          $this->load->view('admin/doctorsappointmentslistview');
      }

public function ReceptionistDoctorsAppointmentsListView()
      {
          $this->load->view('receptionist/doctorsappointmentslistview');
      }

 public function DoctorsAppointmentsList()
    {    
          $masterdb = $this->db->database;
          $appointmentslist_specialization    = $this->input->post("search_appointmentslist_specialization"); 
          $appointmentslist_doctor            = $this->input->post("search_appointmentslist_doctor");
          $appointmentslist_date              = $this->input->post("search_appointmentslist_date");
          if($appointmentslist_date) {
             $appointmentslist_date           = date("Y-m-d", strtotime($appointmentslist_date) );
              }else{
           	 $appointmentslist_date=date("Y-m-d") ;
           }
          $appointmentslist_shift              = $this->input->post("search_appointmentslist_shift");
          
          

         $TotalAppointments=$this->DoctorTimeSchedule_model->DoctorsAppointmentsList($appointmentslist_specialization,$appointmentslist_doctor,$appointmentslist_date,$appointmentslist_shift,$masterdb);
        
        if(count($TotalAppointments)>0){
                  echo json_encode(array('success'=>true,'data'=>$TotalAppointments));
                  return;
             }else{
                  echo json_encode(array('success'=>false));
                  return;
             }
              
             
    }    
public function DoctorsAppointmentsExport(){
              
    $masterdb = $this->db->database;
    $export_type = $this->input->post("export_type");
    $data = $this->DoctorTimeSchedule_model->DoctorsAppointmentsReport($masterdb);
    
    if(isset($export_type) && $export_type == 'pdf'){
      $filename = 'AppointmentsReport-'.date('dmYHis').'.pdf';
      $data2['data'] = $data;
      $data2['print'] = 0;

      $html = $this->load->view('export/appointmentreportExportPdf',$data2, true);
      $pdfFilePath = FCPATH.'assets/downloads/'.$filename;
      $this->load->library('pdf');

      $this->pdf->pdf->useSubstitutions = true;
      $this->pdf->pdf->WriteHTML($html);
      ob_clean();
      $this->pdf->pdf->Output($pdfFilePath, "F");
      $file='assets/downloads/'.$filename;
      echo json_encode(array('success'=>true,'message'=>DWNLOAD_MSG,'download_type'=>$export_type,'data'=>$file));
      return;

    }
        
     if(isset($export_type) && $export_type=='print'){
      $data2['data'] = $data;
      $data2['print'] = 1;
      $html=$this->load->view('export/appointmentreportExportPdf', $data2,true);
      echo json_encode(array('success'=>true,'message'=>DWNLOAD_MSG,'download_type'=>$paging->export_type,'data'=>$html));
      return;
    }



  }    


}
?>