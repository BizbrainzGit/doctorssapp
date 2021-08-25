<?php
defined('BASEPATH') or die('Please set up the configuration');
Class Common_model extends CI_Model
{  public $app_db;
    public function __construct()
    {
        parent::__construct();
    }
	
	/*>>Getting data from table code starts*/
    public function getData($cols,$table_name,$list_name)
    {
        $response=array();
        $query=$this->db->select($cols)->from($table_name)->get();
        //echo $this->db->last_query();exit;
        $db_error=$this->db->error();
        if($db_error['code']!=0){
            $response['code']='575';
            $resposne['message']='';
            $response['description']=(QUERY_DEBUG==1)?$db_error['message']:'Some thing error occured';
        }
        else
        {
            $count=$query->num_rows();
            $response['code']=($count > 0)?200 :204;
            $response['message']=($count  > 0 )?'Success':'Fail';
            $response['description']=($count  > 0 )?'Getting the '.$list_name.' data':'No results found';
            $response['result_count']=$count;
            $response[($list_name!='')?$list_name:'common_result']=($count  > 0 )?$query->result():(object) null;
        }
        return $response;
    }
	/*>>Getting data from table using single where condition code starts*/
    public function getDataWhere($cols,$table_name,$where_col,$where_col_val,$list_name)
    {
        $response=array();
        $this->db->select($cols)->from($table_name);
        $query=$this->db->where($where_col,$where_col_val)->get();
        //echo $this->db->last_query();//exit;
        $db_error=$this->db->error();
        if($db_error['code']!=0){
            $response['code']='575';
            $resposne['message']='';
            $response['description']=(QUERY_DEBUG==1)?$db_error['message']:'Some  error occured';
        }
        else
        {
            $count=$query->num_rows();
            $response['code']=($count > 0)?200 :204;
            $response['description']=($count  > 0 )?'Getting the '.$list_name.' data':'No results found';
            $response['result_count']=$count;
            $response[($list_name!='')?$list_name:'common_result']=($count  > 0 )?$query->result():(object) null;
        }
        return $response;
    }
	
	/* common method for inserting data on required table code starts */
	public function common_insert($params)
	{
		$response=array();
		if(!is_array($params))
		{
			 $response['code']=301;
             $response['message']='Validation';
             $response['description']='Invalid input parameters';
         }
		else
		{
			    $table_name=isset($params['table_name'])?$params['table_name']:'';
                $table_insert_data=isset($params['insert_data'])?$params['insert_data']:'';
                $success_message=isset($params['success_message'])?$params['success_message']:'';
                $error_message=isset($params['error_message'])?$params['error_message']:'';
                $debug=isset($params['debug'])?$params['debug']:0;
                if(!empty($table_name) && is_array($table_insert_data) && (count($table_insert_data) > 0))
                {
                   $table_name=  trim($table_name);
                                if($debug==0)
                                {
								$insert_sql=$this->db->insert($table_name,$table_insert_data);
                     								//echo json_encode($insert_sql);
								$insert_id = $this->db->insert_id();
                                  $success_message=($success_message!='')?$success_message:'inserted successfully';
                                    $error_message=($error_message!='')?$error_message:'Unable to insert';
                                    $db_error=  $this->db->error();
                                    if($db_error['code']==0)
                                    {
                                        $inserted_row_count=  $this->db->affected_rows();
                                        $response['code']=($inserted_row_count > 0)?200:204;
                                        $response['message']=($inserted_row_count > 0)?$success_message:$error_message;
										$response['description']=$table_insert_data;
										$response['id']=$insert_id;
                                    }
                                    else
                                    {
                                        $response['code']=575;
                                        $response['message']='Data base error';
										$response['description']='Database error-'.$table_insert_data;
                                   }
                                }
                                else
                                {
                                    $response['code']=575;
                                    $response['message']='Document could not be inserted';
                                    $response['description']=$table_insert_data.' could not be inserted';
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
			
//common method for inserting data on required database and tables code starts 

	
    /*>>common method for updating data on required table code starts*/ 
    public function common_update($params)
    {
        //echo "test";exit;
                $response=array();
                if(!is_array($params))
                {
                        $response['code']=301;
                        $response['message']='Validation';
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
                                    $success_message=($success_message!='')?$success_message:'updated successfully';
                                    $error_message=($error_message!='')?$error_message:'Unable to update';
                                    $update=  $this->db->query($update_sql);
                                    //echo $this->db->last_query();exit;
                                    $db_error=  $this->db->error();

                                    if($db_error['code']==0)
                                    {
                                        $update_row_count=  $this->db->affected_rows();
                                        $response['code']=($update_row_count > 0)?200:204;
                                        $response['message']=($update_row_count > 0)?$success_message:$error_message;
										$response['description']="updated successfully";
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
                                $response['message']='Data missing!';
                                
                        }
                }
                return json_encode($response);
    }
 
 /*<<common method for updating data on required table code ends*/
  public function common_update_db($params)
    {
        //echo "test";exit;
                $response=array();
                if(!is_array($params))
                {
                        $response['code']=301;
                        $response['message']='Validation';
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
                                $update_sql=$this->app_db->update_string($table_name,$table_update_data,$table_update_condition);
                              
							   //echo $update_sql=$xthis->app_db->update_string($table_name,$table_update_data,$table_update_condition); exit;
                                if($debug==0)
                                {
                                    $success_message=($success_message!='')?$success_message:'updated successfully';
                                    $error_message=($error_message!='')?$error_message:'Unable to update';
                                    $update=  $this->app_db->query($update_sql);
                                    //echo $this->db->last_query();exit;
                                    $db_error=  $this->db->error();

                                    if($db_error['code']==0)
                                    {
                                        $update_row_count =  $this->app_db->affected_rows();
                                        $response['code']=($update_row_count > 0)?200:204;
                                        $response['message']=($update_row_count > 0)?$success_message:$error_message;
										$response['description']="updated successfully";
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
                                $response['message']='Data missing!';
                                
                        }
                }
                return json_encode($response);
    } 
 
 
 
 public function common_delete($table,$conditionarray)
    {
        $response=array();
        $sql=$this->db->delete($table,$conditionarray);
        $action=$this->db->affected_rows();
        //echo $this->db->last_query();exit;
        if($action==true){
		  $response['code']=200;
          $response['message']='Document deleted successfully!';
		}
        else{
          $response['code']=575;
          $response['message']='Document not  deleted!';
		}			
         return json_encode($response);
    }	
}