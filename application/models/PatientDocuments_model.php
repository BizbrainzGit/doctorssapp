<?php 
 
use \Illuminate\Database\Eloquent\Model as Eloquent ;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;
 
class PatientDocuments_model extends Eloquent {	
    public $timestamps = false;
    protected $table = "patient_documents"; // table name
    public $primaryKey = 'id';
    protected $fillable = ['patient_id', 'document_path', 'document_type', 'created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];

	public function addPatientDocuments($documentsArray){
		$addresult=self::create($documentsArray);
		return $addresult;
	}
    
    public function ViewPatientDocumentsByPateintId($id){
		$addresult=self::where('patient_documents.patient_id','=',$id)->get();
		return $addresult;
	}

}
?>