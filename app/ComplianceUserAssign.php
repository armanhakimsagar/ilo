<?php

namespace App;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class ComplianceUserAssign extends Model implements AuditableContract
{
    use Auditable;
	
    protected $table = "compliance_user_assigns";
    protected $fillable = [
    	'caseId', 
		'empUserId', 
		'status', 
		'step_order', 
		'allocated_day',
		'assign_by'
    ];
}
