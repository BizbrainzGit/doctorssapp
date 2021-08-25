<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/superadmin/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;

class DashboardController extends BaseController {
	
	public function __construct()
	{
		 parent::__construct();
		 $this->load->library(array('form_validation','ValidationTypes','excel','session','ion_auth'));
		 $this->load->helper(array('url','html','form','util_helper','language'));
		 $this->load->database();
		 $this->load->model('Accounts_model');
     $this->load->model('PaymentTransaction_model');
}

    
   public function AccountsCountForSuperAdmin()
		   {   
            $monthview=date('M Y');
            $active=$this->Accounts_model->ActiveAccountsCountForSuperAdmin();
             $inactive=$this->Accounts_model->InAccountsCountForSuperAdmin(); 
           	echo json_encode(array('success'=>true, 'monthview'=>$monthview ,'active'=>$active, 'inactive'=>$inactive));

		   }

public function totalSubscriptionAmountForSuperAdmin()
       {  
          
            $month=date('Y-m');
            $monthview=date('M Y');
            $today=date("Y-m-d");

            $todayamount=$this->PaymentTransaction_model->TodayAmount($today);
            $totalamount=$this->PaymentTransaction_model->TotalAmount($month);
            echo json_encode(array('success'=>true,'monthview'=>$monthview, 'todayamount'=>$todayamount,'totalamount'=>$totalamount));

    }




public function totalSubscriptionAmountForSuperAdminByMonth($id)
    {  
               if($id==1){
                    $month= date('Y-m', strtotime('0 month'));
                    $monthview= date('M Y', strtotime('0 month'));
               }elseif($id==2){
                    $month= date('Y-m', strtotime('-1 month'));
                    $monthview= date('M Y', strtotime('-1 month'));
               }elseif($id==3){

                 $month= date('Y-m', strtotime('-2 month'));
                 $monthview= date('M Y', strtotime('-2 month'));
               }elseif($id==4){

                 $month= date('Y-m', strtotime('-3 month'));
                 $monthview= date('M Y', strtotime('-3 month'));
               }
         
              $totalamount=$this->PaymentTransaction_model->TotalAmount($month);
              echo json_encode(array('success'=>true,'monthview'=>$monthview,'totalamount'=>$totalamount));

    }


// public function AllDealcloseForDashboard()
//       {  
//           $userrole=$this->session->userdata('user_roles');
//           $month=date('Y-m');
//           $monthview=date('M Y');

//           $alltodaydealclose=0;
//           $alltotaldealclose=0;
          
//           $today=date("Y-m-d");
//            if($userrole==MARKET_EXEC){
              
//               $city_id=$this->session->userdata('city_id');
//               $userid=$this->ion_auth->get_user_id();
//               $todaydealclose=$this->Business_model->TodayDealcloseForMarketingDashboard($userid,$today,$city_id);
//               $totaldealclose=$this->Business_model->TotalDealcloseForMarketingDashboard($userid,$month,$city_id);


//            }else if($userrole==MARKET_LEAD){
//                 $userid=$this->ion_auth->get_user_id();
//                 $city_id="";
//                 $todaydealclose=$this->Business_model->TodayDealcloseForMarketingDashboard($userid,$today,$city_id);
//                 $totaldealclose=$this->Business_model->TotalDealcloseForMarketingDashboard($userid,$month,$city_id);

//                $useries=CityMapping_model::where('marketlead_user_id','=',$userid)->pluck('user_id')->toArray();
//                $useries=implode(",",$useries);
//                $alltodaydealclose=$this->Business_model->TodayDealcloseForMarketingLeadDashboard($today,$useries);
//                $alltotaldealclose=$this->Business_model->TotalDealcloseForMarketingLeadDashboard($month,$useries);


//            }else if($userrole==TELE_MARKET){ 
//                 $userid=$this->ion_auth->get_user_id();
//                 $todaydealclose=$this->Business_model->TodayDealcloseForTelemarketingDashboard($userid,$today);
//                 $totaldealclose=$this->Business_model->TotalDealcloseForTelemarketingDashboard($userid,$month);

//            }else{
               
//                $todaydealclose=$this->Business_model->TodayDealcloseForAdminDashboard($today);
//                $totaldealclose=$this->Business_model->TotalDealcloseForAdminDashboard($month);
//             }      
          
//             echo json_encode(array('success'=>true,'userrole'=>$userrole, 'monthview'=>$monthview, 'todaydealclose'=>$todaydealclose,'totaldealclose'=>$totaldealclose,'alltodaydealclose'=>$alltodaydealclose,'alltotaldealclose'=>$alltotaldealclose));

//     }

// public function AllDealcloseListForDashboardByMonth($id)
//     {  
//             $userrole=$this->session->userdata('user_roles');
//             $today=date("Y-m-d");
//             $alltodaydealclose=0;
//             $alltotaldealclose=0;
//                if($id==2){
//                     $month= date('Y-m', strtotime('-1 month'));
//                     $monthview= date('M Y', strtotime('-1 month'));
//                }elseif($id==3){

//                  $month= date('Y-m', strtotime('-2 month'));
//                  $monthview= date('M Y', strtotime('-2 month'));
//                }elseif($id==4){

//                  $month= date('Y-m', strtotime('-3 month'));
//                  $monthview= date('M Y', strtotime('-3 month'));
//                }
 
//          if($userrole==MARKET_EXEC){
              
//               $city_id=$this->session->userdata('city_id');
//               $userid=$this->ion_auth->get_user_id();
//               $totaldealclose=$this->Business_model->TotalDealcloseForMarketingDashboard($userid,$month,$city_id);

//            }else if($userrole==MARKET_LEAD){
//                $userid=$this->ion_auth->get_user_id();
//                 $city_id="";
//                 $totaldealclose=$this->Business_model->TotalDealcloseForMarketingDashboard($userid,$month,$city_id);
//                $useries=CityMapping_model::where('marketlead_user_id','=',$userid)->pluck('user_id')->toArray();
//                $useries=implode(",",$useries);
//                $alltotaldealclose=$this->Business_model->TotalDealcloseForMarketingLeadDashboard($month,$useries);

//            }else if($userrole==TELE_MARKET){ 

//                 $userid=$this->ion_auth->get_user_id();
//                 $totaldealclose=$this->Business_model->TotalDealcloseForTelemarketingDashboard($userid,$month);

//            }else{
               
//                $totaldealclose=$this->Business_model->TotalDealcloseForAdminDashboard($month);
//             }
            
//             echo json_encode(array('success'=>true,'userrole'=>$userrole, 'monthview'=>$monthview, 'totaldealclose'=>$totaldealclose,'alltotaldealclose'=>$alltotaldealclose));

//     }




// public function AllMonthlySalesForDashboard()
//       {  
//           $userrole=$this->session->userdata('user_roles');
//           $month=date('Y-m');
//           $monthview=date('M Y');
//           $alltodaymonthlysales=0;
//           $alltotalmonthlysales=0;
          
//           $today=date("Y-m-d");
//            if($userrole==MARKET_EXEC){
              
//               $city_id=$this->session->userdata('city_id');
//               $userid=$this->ion_auth->get_user_id();
//               $todaymonthlysales=$this->BusinessPayments_model->TodayMonthlySalesForMarketingDashboard($userid,$today,$city_id);
//               $totalmonthlysales=$this->BusinessPayments_model->TotalMonthlySalesForMarketingDashboard($userid,$month,$city_id);


//            }else if($userrole==MARKET_LEAD){
//                 $userid=$this->ion_auth->get_user_id();
//                 $city_id="";
//                 $todaymonthlysales=$this->BusinessPayments_model->TodayMonthlySalesForMarketingDashboard($userid,$today,$city_id);
//                 $totalmonthlysales=$this->BusinessPayments_model->TotalMonthlySalesForMarketingDashboard($userid,$month,$city_id);

//                $useries=CityMapping_model::where('marketlead_user_id','=',$userid)->pluck('user_id')->toArray();
//                $useries=implode(",",$useries);
//                $alltodaymonthlysales=$this->BusinessPayments_model->TodayMonthlySalesForMarketingLeadDashboard($today,$useries);
//                $alltotalmonthlysales=$this->BusinessPayments_model->TotalMonthlySalesForMarketingLeadDashboard($month,$useries);


//            }else if($userrole==TELE_MARKET){ 
//                 $userid=$this->ion_auth->get_user_id();
//                 $todaymonthlysales=$this->BusinessPayments_model->TodayMonthlySalesForTelemarketingDashboard($userid,$today);
//                 $totalmonthlysales=$this->BusinessPayments_model->TotalMonthlySalesForTelemarketingDashboard($userid,$month);

//            }else{
               
//                $todaymonthlysales=$this->BusinessPayments_model->TodayMonthlySalesForAdminDashboard($today);
//                $totalmonthlysales=$this->BusinessPayments_model->TotalMonthlySalesForAdminDashboard($month);
//             }      
          
//             echo json_encode(array('success'=>true,'userrole'=>$userrole, 'monthview'=>$monthview, 'todaymonthlysales'=>$todaymonthlysales,'totalmonthlysales'=>$totalmonthlysales,'alltodaymonthlysales'=>$alltodaymonthlysales,'alltotalmonthlysales'=>$alltotalmonthlysales));

//     }
    
// public function AllMonthlySalesListForDashboardByMonth($id)
//     {  
//             $userrole=$this->session->userdata('user_roles');
//             $alltodaymonthlysales=0;
//             $alltotalmonthlysales=0;
//                // $month=$id;
//                if($id==2){
//                     $month= date('Y-m', strtotime('-1 month'));
//                     $monthview= date('M Y', strtotime('-1 month'));
//                }elseif($id==3){

//                  $month= date('Y-m', strtotime('-2 month'));
//                  $monthview= date('M Y', strtotime('-2 month'));
//                }elseif($id==4){

//                  $month= date('Y-m', strtotime('-3 month'));
//                  $monthview= date('M Y', strtotime('-3 month'));
//                }
               
// //            // echo date('Y-m', strtotime('-2 month'));
// //            // echo date('Y-m', strtotime('-3 month'));
//          if($userrole==MARKET_EXEC){
              
//               $city_id=$this->session->userdata('city_id');
//               $userid=$this->ion_auth->get_user_id();
//               $totalmonthlysales=$this->BusinessPayments_model->TotalMonthlySalesForMarketingDashboard($userid,$month,$city_id);

//            }else if($userrole==MARKET_LEAD){
//                $userid=$this->ion_auth->get_user_id();
//                 $city_id="";
//                 $totalmonthlysales=$this->BusinessPayments_model->TotalMonthlySalesForMarketingDashboard($userid,$month,$city_id);
//                $useries=CityMapping_model::where('marketlead_user_id','=',$userid)->pluck('user_id')->toArray();
//                $useries=implode(",",$useries);
//                $alltotalmonthlysales=$this->BusinessPayments_model->TotalMonthlySalesForMarketingLeadDashboard($month,$useries);

//            }else if($userrole==TELE_MARKET){ 

//                 $userid=$this->ion_auth->get_user_id();
//                 $totalmonthlysales=$this->BusinessPayments_model->TotalMonthlySalesForTelemarketingDashboard($userid,$month);

//            }else{
               
//                $totalmonthlysales=$this->BusinessPayments_model->TotalMonthlySalesForAdminDashboard($month);
//             }
            
//             echo json_encode(array('success'=>true,'userrole'=>$userrole, 'monthview'=>$monthview, 'totalmonthlysales'=>$totalmonthlysales,'alltotalmonthlysales'=>$alltotalmonthlysales));

//     }

// public function AllSalesForDashboardByCitywise()
//       {  
//           $userrole=$this->session->userdata('user_roles');
//           $month=date('Y-m');
//           $monthview=date('M Y');
//           $todaycitywisesales=0;
//           $totalcitywisesales=0;
//           $today=date("Y-m-d");
            
//             $todaycitywisesales=$this->BusinessPayments_model->TodaySalesForDashboardByCitywise($today);
//             $totalcitywisesales=$this->BusinessPayments_model->TotalSalesForDashboardByCitywise($month);
//             echo json_encode(array('success'=>true, 'monthview'=>$monthview, 'todaycitywisesales'=>$todaycitywisesales,'data'=>$totalcitywisesales));

//       }
      
// public function AllSalesForDashboardByCitywiseMonth($id)
//     {  
//             $userrole=$this->session->userdata('user_roles');
//             $alltodaymonthlysales=0;
//             $alltotalmonthlysales=0;
//                // $month=$id;
//                if($id==2){
//                     $month= date('Y-m', strtotime('-1 month'));
//                     $monthview= date('M Y', strtotime('-1 month'));
//                }elseif($id==3){

//                  $month= date('Y-m', strtotime('-2 month'));
//                  $monthview= date('M Y', strtotime('-2 month'));
//                }elseif($id==4){
//                  $month= date('Y-m', strtotime('-3 month'));
//                  $monthview= date('M Y', strtotime('-3 month'));
//                }
            
//              $totalcitywisesales=$this->BusinessPayments_model->TotalSalesForDashboardByCitywise($month);
//             echo json_encode(array('success'=>true, 'monthview'=>$monthview, 'data'=>$totalcitywisesales));

//     }


} ?>
