<?php

namespace App;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class ComplianceStep extends  Model implements AuditableContract
{
	use Auditable;
	protected $table = "compliance_steps";
    protected $fillable = [
    	'stepId', 
		'stepName', 
		'stepDescription',
		'stepSL',
		'created_by'
    ];
}
