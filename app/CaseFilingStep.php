<?php

namespace App;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class CaseFilingStep extends Model implements AuditableContract
{
	use Auditable;
	
    protected $table = "casefiling_steps";
    protected $fillable = [
    	'caseId', 
		'stepId', 
		'stepSL', 
		'nextstepId', 
		'status', 
		'created_by'
    ];
}
