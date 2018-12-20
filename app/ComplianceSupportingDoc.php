<?php

namespace App;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class ComplianceSupportingDoc extends Model implements AuditableContract
{
    use Auditable;
	
    protected $table = "compliance_supporting_docs";
    protected $fillable = [
    	'caseId', 
    	'tracking_no',
		'supporting_doc_name', 
		'orginal_name'
    ];
}
