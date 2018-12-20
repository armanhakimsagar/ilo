<?php

namespace App;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class app_role extends Model implements AuditableContract
{
	use Auditable;
    protected $fillable = ['permission_id', 'permission_name'];
}
