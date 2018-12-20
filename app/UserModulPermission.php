<?php

namespace App;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class UserModulPermission extends Model implements AuditableContract
{
	use Auditable;
    protected $fillable = ['empUserId', 'modul_id'];
}
