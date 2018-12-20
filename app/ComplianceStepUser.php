<?php

namespace App;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class ComplianceStepUser extends  Model implements AuditableContract
{
	use Auditable;
	protected $table = "compliance_stepusers";
    protected $fillable = [
    	'stepId', 
		'empUserId',
		'created_by'
    ];
}
