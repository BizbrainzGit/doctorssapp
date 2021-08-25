<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/CommonBaseController.php');
error_reporting(0);
ob_start();
use Illuminate\Database\Query\Expression as raw;
use \Illuminate\Database\Capsule\Manager as Capsule;

class PatientBillingTestController extends CommonBaseController {
	
	public function __construct()
	{
		 parent::__construct();
		 $this->load->library(array('form_validation','ValidationTypes','excel','session','ion_auth'));
		 $this->load->helper(array('url','html','form','util_helper','language'));
		 $this->load->database();
		 $this->load->model('customerdb/PateintBillingTest_model');
         $this->load->model('customerdb/BillingTests_model'); 
         $this->load->model('customerdb/Prescription_model'); 
         $this->load->model('Customdata_model');  
         $this->load->model('Accounts_model'); 
    }
   
    public function MedicalTestsBillingView()
    {         
        $this->load->view('billing/medicaltestsbillingview');
    }

     public function AddMedicalTestsBillingView()
    {         
        $this->load->view('billing/addmedicaltestsbillingview');
    }
    
    public function MedicalTestsBillingViewForPatient()
    {         
        $this->load->view('patient/medicaltestsbillingview');
    }

     public function GetPatientByPrescriptionMedicalTestsData()
    {         

     // prescription
             $masterdb = $this->db->database;
             $data=$this->Prescription_model->GetPatientByPrescriptionMedicalTestsData($masterdb);
             echo json_encode(array('success'=>true,'data'=>$data));
             return;
    }

    
 public function SearchPatientBillingTestList()
    {
             $masterdb = $this->db->database;
             $userrole=$this->session->userdata('user_roles');
             if($userrole=="Patient"){
               $userid=$this->ion_auth->get_user_id();
            }else {
               $userid="";
              }
             $searchdata=$this->PateintBillingTest_model->SearchPatientBillingTests($userid,$masterdb);
             echo json_encode(array('success'=>true,'data'=>$searchdata,'role'=>$userrole));
          return;
     
    }


  public function viewPatientBillingTestsById($id)
    {
             $masterdb = $this->db->database;
             $accountid=$this->account_id;
             $accountdata=$this->Accounts_model->AccountDataById($accountid);
             $patientbillingdata=$this->PateintBillingTest_model->GetPatientBillingTestsById($id,$masterdb);
             $patientbillingtest=$this->BillingTests_model->TestListPatientBillingTestsById($id);
             echo json_encode(array('success'=>true,'data'=>$patientbillingdata,'patientbillingtest'=>$patientbillingtest,'accountdata'=>$accountdata));
          return;
     
    }




public function PatientBillingTestInvoiceExport(){
        
        // $postdata = file_get_contents("php://input");
        // $paging   = json_decode($postdata);
        // //$data=$this->Vendor_model->vendorDataDetails($paging);
             $id = $this->input->post("patientbillingtest_invoice_selectedid");
             $export_type = $this->input->post("export_type");
         
             $masterdb = $this->db->database;
              $accountid=$this->account_id;
             $accountdata=$this->Accounts_model->AccountDataById($accountid);
             $data=$this->PateintBillingTest_model->GetPatientBillingTestsById($id,$masterdb);
             $patientbillingtest=$this->BillingTests_model->TestListPatientBillingTestsById($id);

        if(isset($export_type) && $export_type=='pdf'){
            
            $filename='Patientmedicaltestsreceipt-'.$id.'-'.date('YmdHis').'.pdf';
           // die();
            $data2['data']=$data;
            $data2['patientbillingtest']=$patientbillingtest;
            $data2['accountdata']=$accountdata;
            $data2['print']=0;
            
            //load the view and saved it into $html variable
            $html=$this->load->view('export/patientmedicaltestsreceiptExportPdf',$data2, true);
     
            //this the the PDF filename that user will get to download
            $pdfFilePath =FCPATH.'assets/downloads/'.$filename;
     
            //load mPDF library
            $this->load->library('pdf');
     
           //generate the PDF from the given html
            
            $this->pdf->pdf->useSubstitutions = true;
            
            $this->pdf->pdf->WriteHTML($html);
            //download it.
            ob_clean();
            $this->pdf->pdf->Output($pdfFilePath,"F");
            $file='assets/downloads/'.$filename;
            echo json_encode(array('success'=>true,'message'=>DWNLOAD_MSG,'download_type'=>$export_type,'data'=>$file));
            //echo $file;
            return;
            
        }

        if(isset($export_type) && $export_type=='print'){
            $data2['data']=$data;
            $data2['patientbillingtest']=$patientbillingtest;
            $data2['accountdata']=$accountdata;
            $data2['print']=1;
            $html=$this->load->view('export/patientmedicaltestsreceiptExportPdf', $data2,true);
            echo json_encode(array('success'=>true,'message'=>DWNLOAD_MSG,'download_type'=>$export_type,'data'=>$html));
            return;
        }
    }


   

   public function SavePatientBillingTestData()
    {
              $masterdb = $this->db->database;
            $medicaltest_billingdate=date('Y-m-d');
            $medicaltest_patient                  = $this->input->post("add_billing_medicaltest_patient");
        
            $medicaltest_medicaltest              = $this->input->post("add_billing_medicaltest_medicaltest");
            $medicaltest_price                    = $this->input->post("price");

            $medicaltest_total                    = $this->input->post("add_billing_medicaltest_subtotal");
            $medicaltest_discount                 = $this->input->post("add_billing_medicaltest_discount");

            $medicaltest_subtotal                 = $medicaltest_total-$medicaltest_discount;
            $medicaltest_gstamount                = $this->input->post("add_billing_medicaltest_gstamount");
            $medicaltest_grandtotal               = $this->input->post("add_billing_medicaltest_grandtotal");
            $medicaltest_paidamount               = $this->input->post("add_billing_medicaltest_paidamount");
            $medicaltest_dueamount                = $this->input->post("add_billing_medicaltest_dueamount");
        
           $postData=array();
           $medicaltestdetails=[];
          
           $postData = dataFieldValidation($medicaltest_billingdate, "Billing Date",$medicaltestdetails,"billing_date","",$postData,"medicaltestdetailsarray");
           $postData = dataFieldValidation($medicaltest_patient, "Prescription Patient Name ",$medicaltestdetails,"prescription_id",[ValidationTypes::REQUIRED],$postData,"medicaltestdetailsarray");
            $postData = dataFieldValidation($medicaltest_total, "Tests Total",$medicaltestdetails,"test_total_amount","",$postData,"medicaltestdetailsarray");
           $postData = dataFieldValidation($medicaltest_discount, "Discount",$medicaltestdetails,"discount_amount","",$postData,"medicaltestdetailsarray");
           $postData = dataFieldValidation($medicaltest_subtotal, "Sub Total",$medicaltestdetails,"sub_total_amount","",$postData,"medicaltestdetailsarray");
            $postData = dataFieldValidation($medicaltest_gstamount, "Gst",$medicaltestdetails,"gst_amount","",$postData,"medicaltestdetailsarray");
           $postData = dataFieldValidation($medicaltest_grandtotal, "Grand Total",$medicaltestdetails,"grand_total_amount","",$postData,"medicaltestdetailsarray");
           $postData = dataFieldValidation($medicaltest_paidamount, "Paid Amount",$medicaltestdetails,"paid_amount","",$postData,"medicaltestdetailsarray");
           $postData = dataFieldValidation($medicaltest_dueamount, "Due Amount",$medicaltestdetails,"due_amount","",$postData,"medicaltestdetailsarray");
           

                if(isset($medicaltest_medicaltest) && !empty($medicaltest_medicaltest))
                        {
                              $medicaltest=[];
                            foreach($medicaltest_medicaltest as $key=>$data)
                            {
                                  $medicaltest_id  = $data;
                                  $postData = dataFieldValidation($medicaltest_id, "Test Id", $medicaltest,"test_id", "", $postData, "medicaltestarray".$key);
                                }
                        }


           if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
            echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
            return;
           }
        
        $userId = $this->ion_auth->get_user_id();
        $createdlog=isCreatedLog($userId);

        $medicaltestarray = array_merge($postData['dbinput']['medicaltestdetailsarray'],$createdlog);
        $billing_id = $this->PateintBillingTest_model->addMedicalTestBilling($medicaltestarray);

        if($billing_id>0){
                
                 if(isset($medicaltest_medicaltest) && !empty($medicaltest_medicaltest))
                  {
                        foreach($medicaltest_medicaltest as $key=>$data)
                        {
                            $medicaltest_id  = $data;
                            $medicaltestdataarray=array('patient_billing_id'=>$billing_id,'test_id'=>$medicaltest_id);
                            $medicaltest=$this->BillingTests_model->addBillingTest($medicaltestdataarray);
                        }

                 }
        }


          if ($billing_id>0 &&  $medicaltest) {

                     $id = $billing_id;
                     $data=$this->PateintBillingTest_model->GetPatientBillingTestsById($id,$masterdb);
                     $patientbillingtest=$this->BillingTests_model->TestListPatientBillingTestsById($id);
                      
                    $data2['data']=$data;
                    $data2['patientbillingtest']=$patientbillingtest;
                    
                    $html=$this->load->view('export/patientmedicaltestsreceiptExportPdf',$data2, true);
                    $filename='Patientmedicaltestsreceipt-'.$id.'-'.date('YmdHis').'.pdf';
                    //this the the PDF filename that user will get to download
                    $pdfFilePath =FCPATH.'/assets/downloads/'.$filename;
             
                    //load mPDF library
                    $this->load->library('pdf');
             
                   //generate the PDF from the given html
                    
                    $this->pdf->pdf->useSubstitutions = true;
                    
                    $this->pdf->pdf->WriteHTML($html);
                    //download it.
                    ob_clean();
                    $this->pdf->pdf->Output($pdfFilePath,"F");
                    $file='assets/downloads/'.$filename;
                    $subject='Bill-Receipt';
                    $name=$data[0]['patient_name'];
                    $to_email=$data[0]['patient_email'];
                    $body=Customdata_model::where('content_type','=','BillingReceipt')->first()->content;
                    $body=str_replace("{Name}",$name,$body);
                    $attachments='assets/downloads/'.$filename; 
                    $x=sendEmail("bizbrainz2020@gmail.com","Administrator",$to_email,$subject,$body,$attachments);
                  

                   echo json_encode(array('success'=>true,'message'=>SAVE_MSG));
                     return;

               }else{

                  echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
                  return;

               }
   




    }






}
?>