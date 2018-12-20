<?php

namespace App;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class AppUser extends Model implements AuditableContract
{
	use Auditable;
    protected $fillable = ['userName','fullName','email','password','DOB','gender','streetAddress','city','state','postalCode','cellphone','telePhone','contactNumber','alternatePhone','employeeId','department','designation','employeeTerm','userImg','status'];
}
