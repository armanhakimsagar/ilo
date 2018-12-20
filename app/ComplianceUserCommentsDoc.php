<?php

namespace App;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class ComplianceUserCommentsDoc extends Model implements AuditableContract
{
    use Auditable;
	
    protected $table = "compliance_user_comments_doc";
    protected $fillable = [
    	'caseId', 
		'empUserId', 
		'supporting_doc', 
		'doc_orginal_name'
    ];
}
