<?php

namespace App;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class MenuPermission extends Model implements AuditableContract
{
	use Auditable;
    protected $fillable = [
        'empuserid', 'groupid', 'permissionid',
    ];
}
