<?php

namespace App;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Complianceform extends Model implements AuditableContract
{
	use Auditable;
	
    protected $table = "compliance_forms";
    protected $fillable = ['caseId', 
	'applicantTrackingNo', 
	'committeeNo', 
	'complianeFor', 
	'relation', 
	'complaint_against', 
	'complaint_against_name', 
	'broker_name', 
	'brokers_mobile_no', 
	'complainant_name', 
	'complainant_country', 
	'complainant_email', 
	'complainant_mobile', 
	'complainant_address', 
	'victim_name', 
	'victim_mobile', 
	'victim_nationality', 
	'victim_country_name', 
	'victim_address', 
	'victim_passport', 
	'victim_local_no', 
	'victim_district', 
	'victim_upazilla', 
	'victim_local_address', 
	'complaint_list', 
	'complaint_description', 
	'support_doc',
    'casestatus'];
}
