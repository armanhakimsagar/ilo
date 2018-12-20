<?php

namespace App;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class ComplianceUserComment extends Model implements AuditableContract
{
    use Auditable;
	
    protected $table = "compliance_user_comments";
    protected $fillable = [
        'caseId', 
    	'tracking_no', 
		'empUserId', 
		'comments',
        'commentsstatus',
		'supportingDoc', 
		'docName'
    ];
}
