<?php

namespace App;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class BlastApplication extends Model implements AuditableContract
{
	use Auditable;
    protected $table = 'blast_applications';

    protected $fillable = ['application_id', 
	'apps_application_id', 
	'from_mobile', 
	'application_text', 
	'response_text', 
	'applicant_name', 
	'application_for', 
	'relation', 
	'application_against', 
	'accused', 
	'broker_name', 
	'broker_mobile_no', 
	'applicant_email', 
	'applicant_mobile_no', 
	'applicant_country', 
	'applicant_address', 
	'sufferer_name', 
	'sufferer_nationality', 
	'sufferer_passport_no', 
	'sufferer_mobile', 
	'sufferer_local_no', 
	'sufferer_local_address', 
	'updated_by', 
	'application_status', 
	'sync_datetime', 
	'created_by', 
	'sufferer_current_country', 
	'sufferer_current_address', 
	'reply_text', 
	'case_id', 
	'applicantTrackingNo', 
	'committeeNo', 
	'sufferer_district', 
	'sufferer_upazilla'];
}
