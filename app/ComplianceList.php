<?php

namespace App;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class ComplianceList extends Model implements AuditableContract
{
	use Auditable;
	
    protected $table = "compliance_lists";
    protected $fillable = [
    	'caseId', 
		'complianceId', 
		'compliance_description'
    ];
}
