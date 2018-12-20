<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Announcement extends Model implements AuditableContract
{
	use Auditable;
    protected $fillable = ['announceId', 'publishDate', 'closingDate', 'priority', 'announceCategory', 
    'title', 'description', 'docName',];
}
