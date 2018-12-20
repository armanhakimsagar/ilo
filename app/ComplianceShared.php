<?php

namespace App;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class ComplianceShared extends Model implements AuditableContract
{
	use Auditable;
	
    protected $table = "compliance_shareds";
    protected $fillable = [
    	'caseId', 
		'status'
    ];
}
