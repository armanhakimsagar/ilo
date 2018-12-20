<?php

namespace App;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Group_role extends Model implements AuditableContract
{
	use Auditable;
    protected $fillable = ['group_id', 'permission_id'];
}
