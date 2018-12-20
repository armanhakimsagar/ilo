<?php

use Faker\Generator as Faker;

$factory->define(App\BlastApplication::class, function (Faker $faker) {
        return [
	        
	        'apps_application_id' => 0,
	        'application_for' =>"own",
	        'from_mobile' => "NULL",
	        'applicant_name' => "NULL",
	        'relation' => "NULL",
	        'accused' => "NULL",
	        'agency_name' => "NULL",
	        'agency_mobile_no' => "NULL",
	        'company_name' => "NULL",
	        'company_mobile_no' => "NULL",
	        'person_name' => "NULL",
	        'person_mobile_no' => "NULL",
	        'recruitment_officer_name' => "NULL",
	        'recruitment_officer_mobile_no' => "NULL",
	        'applicant_email' => "NULL",
	        'applicant_mobile_no' => "NULL",
	        'applicant_country' => "NULL",
	        'applicant_address' => "NULL",
	        'sufferer_mobile' => "NULL",
	        'sufferer_local_no' => "NULL",
	        'sufferer_local_address' => "NULL",
	        'case_id' => mt_rand(100000, 999999),
	        'committeeNo' => date('ymdhis').rand(0,100000),
	        'application_text' =>$faker->paragraph,
	        'response_text' => 'text',
	        'application_against' =>"agent",
			'broker_name' => $faker->lastName,
			'broker_mobile_no' => $faker->creditCardNumber,
			'sufferer_name'	=> $faker->lastName,
			'sufferer_nationality' => $faker->city,
			'sufferer_passport_no' => $faker->creditCardNumber,
			'application_status'   => "RECEIVED",
			'sufferer_current_country' => "Anguilla",
			'applicantTrackingNo' => date('ymdhis').rand(0,100000),
			'application_type'	=> "Web",
			'gender'	=> "Male",
	    ];
});
