<?php

namespace App;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class CasefilingUserComment extends Model implements AuditableContract
{
    use Auditable;
	
    protected $table = "casefiling_user_comments";
    protected $fillable = [
    	'caseId', 
		'empUserId', 
		'comments',
        'commentsstatus'
    ];
}
