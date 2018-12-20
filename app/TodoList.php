<?php

namespace App;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class TodoList extends Model implements AuditableContract
{
	use Auditable;
    protected $fillable = ['empUserID', 'task','taskDate','priority','status'];
}
