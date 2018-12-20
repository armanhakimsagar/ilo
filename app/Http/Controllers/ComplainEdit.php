<?php

namespace App\Http\Controllers;
use App\case_tracking;
use Illuminate\Http\Request;
use App\BlastApplication;
use Auth;
use App\app_role;
use PragmaRX\Countries\Package\Countries;
use App\send_mail;
use DB;
use Validator;
use Session;

class ComplainEdit extends Controller
{
    public function complainView($id){

    	$userID = Auth::user()->empUserID;

        $data['role'] = app_role::get();
        //$data['countries']$countries = new Countries();

        $countries = new Countries();

        $data['countries'] = $countries->all();

        $data['agencyName'] = DB::table('blast_recruiting_agency_name')
                                ->orderBy('agency_id', 'ASC')->get();
                                

        $data['count'] = send_mail::where('notification',0)->where('empUserID',$userID)->count();

    	$data['case_tracking'] = DB::table('blast_applications')
    						->where('applicantTrackingNo', '=',$id)
    						->get();

    	return view('case.CaseEdit')->with($data);

    }

    public function complianceUpdate(Request $request){
        //dd($request->all());
		//define('MB', 1048576);
		$userID = Auth::user()->empUserID;
        $validator = Validator::make($request->all(), [
                
                'complianeFor'              => 'required',
                'broker_name'               => 'max:100',
                'brokers_mobile_no'         => 'max:20',
                'complainant_name'          => 'max:100',
                'complainant_address'       => 'max:1000',
                'complainant_email'         => 'max:100',
                'complainant_mobile'        => 'max:20',
                'victim_name'               => 'max:100',
                'victim_mobile'             => 'max:20',
                'victim_nationality'        => 'max:50',
                'victim_country_name'       => 'max:200',
                'victim_address'            => 'max:1000',
                'victim_passport'           => 'max:100',
                'victim_local_no'           => 'max:20',
                'victim_district'           => 'max:50',
                'victim_upazilla'           => 'max:50',
                'victim_local_address'      => 'max:1000'
               
            ]);
            if ($validator->fails()) {
            return redirect('/CaseCreate')
                            ->withErrors($validator)
                            ->withInput();
            } 

                if($request['relation'] != ""){
                	$relation = $request['relation'];
                }else{
                	$relation = "NULL";
                }

                if($request['agency_name'] != ""){
                	$agency_name = $request['agency_name'];
                }else{
                	$agency_name = "NULL";
                }

                if($request['application_against'] != ""){
                	$application_against = $request['application_against'];
                }else{
                	$application_against = "NULL";
                }

                if($request['accused'] != ""){
                	$accused = $request['accused'];
                }else{
                	$accused = "NULL";
                }
                
                if($request['agency_name'] != ""){
                	$agency_name = $request['agency_name'];
                }else{
                	$agency_name = "NULL";
                }

                if($request['agency_mobile_no'] != ""){
                	$agency_mobile_no = $request['agency_mobile_no'];
                }else{
                	$agency_mobile_no = "NULL";
                }

                if($request['company_name'] != ""){
                	$company_name = $request['company_name'];
                }else{
                	$company_name = "NULL";
                }

                if($request['company_mobile_no'] != ""){
                	$company_mobile_no = $request['company_mobile_no'];
                }else{
                	$company_mobile_no = "NULL";
                }

                if($request['agent_name'] != ""){
                	$broker_name = $request['agent_name'];
                }else{
                	$broker_name = "NULL";
                }

                if($request['agent_mobile_no'] != ""){
                	$broker_mobile_no = $request['agent_mobile_no'];
                }else{
                	$broker_mobile_no = "NULL";
                }

                if($request['person_name'] != ""){
                	$person_name = $request['person_name'];
                }else{
                	$person_name = "NULL";
                }


				if($request['person_mobile_no'] != ""){
                	$person_mobile_no = $request['person_mobile_no'];
                }else{
                	$person_mobile_no = "NULL";
                }

                if($request['officer_name'] != ""){
                	$recruitment_officer_name = $request['officer_name'];
                }else{
                	$recruitment_officer_name = "NULL";
                }


                if($request['officer_mobile_no'] != ""){
                	$recruitment_officer_mobile_no = $request['officer_mobile_no'];
                }else{
                	$recruitment_officer_mobile_no = "NULL";
                }

                if($request['applicant_email'] != ""){
                	$applicant_email = $request['applicant_email'];
                }else{
                	$applicant_email = "NULL";
                }

                if($request['complainant_name'] != ""){
                	$complainant_name = $request['complainant_name'];
                }else{
                	$complainant_name = "NULL";
                }

                if($request['complainant_email'] != ""){
                	$complainant_email = $request['complainant_email'];
                }else{
                	$complainant_email = "NULL";
                }

                if($request['complainant_mobile'] != ""){
                	$complainant_mobile = $request['complainant_mobile'];
                }else{
                	$complainant_mobile = "NULL";
                }

                if($request['complainant_address'] != ""){
                	$complainant_address = $request['complainant_address'];
                }else{
                	$complainant_address = "NULL";
                }
                

                if($request['applicant_mobile_no'] != ""){
                	$applicant_mobile_no = $request['applicant_mobile_no'];
                }else{
                	$applicant_mobile_no = "NULL";
                }

                if($request['victim_name'] != ""){
                	$sufferer_name = $request['victim_name'];
                }else{
                	$sufferer_name = "NULL";
                }

                if($request['victim_mobile'] != ""){
                	$sufferer_mobile = $request['victim_mobile'];
                }else{
                	$sufferer_mobile = "NULL";
                }


				if($request['victim_nationality'] != ""){
                	$sufferer_nationality = $request['victim_nationality'];
                }else{
                	$sufferer_nationality = "NULL";
                }

                if($request['victim_country_name'] != ""){
                	$victim_country_name = $request['victim_country_name'];
                }else{
                	$victim_country_name = "NULL";
                }


				if($request['victim_address'] != ""){
                	$sufferer_current_address = $request['victim_address'];
                }else{
                	$sufferer_current_address = "NULL";
                }

				if($request['victim_passport'] != ""){
                	$sufferer_passport_no = $request['victim_passport'];
                }else{
                	$sufferer_passport_no = "NULL";
                }

				if($request['victim_local_no'] != ""){
                	$sufferer_local_no = $request['victim_local_no'];
                }else{
                	$sufferer_local_no = "NULL";
                }

				if($request['victim_district'] != ""){
                	$sufferer_district = $request['victim_district'];
                }else{
                	$sufferer_district = "NULL";
                }

				if($request['victim_upazilla'] != ""){
                	$sufferer_upazilla = $request['victim_upazilla'];
                }else{
                	$sufferer_upazilla = "NULL";
                }


				if($request['victim_local_address'] != ""){
                	$sufferer_local_address = $request['victim_local_address'];
                }else{
                	$sufferer_local_address = "NULL";
                }

        		$tracking_no = $request['tracking_no'];

            DB::table('blast_applications')
                    ->where('applicantTrackingNo', $tracking_no)
                    ->update(array( 'application_for' => "NULL",
                                    'relation' => "NULL",
                                    'agency_name' => "NULL",
                                    'agency_mobile_no' => "NULL",
                                    'company_name' => "NULL",
                                    'company_mobile_no' => "NULL",
                                    'broker_name' => "NULL",
                                    'broker_mobile_no' => "NULL",
                                    'person_name' => "NULL",
                                    'person_mobile_no' => "NULL",
                                    'recruitment_officer_name' => "NULL",
                                    'recruitment_officer_mobile_no'=>"NULL"));

            DB::table('blast_applications')
			        ->where('applicantTrackingNo', $tracking_no)
			        ->update(array( 'application_for' => $request['complianeFor'],
                                    'application_against' => $request['complaint_against'],
                                    'relation' => $relation,
			        				'agency_name' => $agency_name,
			        				'agency_mobile_no' => $agency_mobile_no,
			        				'company_name' => $company_name,
			        				'company_mobile_no' => $company_mobile_no,
			        				'broker_name' => $broker_name,
			        				'broker_mobile_no' => $broker_mobile_no,
			        				'person_name' => $person_name,
			        				'person_mobile_no' => $person_mobile_no,
			        				'recruitment_officer_name' => $recruitment_officer_name,
                                    'recruitment_officer_mobile_no'=>$recruitment_officer_mobile_no,
			    					'applicant_name' => $complainant_name,
			    					'applicant_email' => $complainant_email,
			    					'applicant_mobile_no' => $complainant_mobile,
			    					'applicant_address' => $complainant_address,
			    					'sufferer_name' => $sufferer_name,
			    				   	'sufferer_mobile' => $sufferer_mobile,
			    					'sufferer_nationality' => $sufferer_nationality,
			    					'sufferer_current_country' => $victim_country_name,
			    					'sufferer_current_address' => $sufferer_current_address,
			    					'sufferer_passport_no' => $sufferer_passport_no,
			    				   	'sufferer_local_no' => $sufferer_local_no,
			    					'sufferer_district' => $sufferer_district,
			    					'sufferer_upazilla' => $sufferer_upazilla,
			    					'sufferer_local_address' => $sufferer_local_address,
                                    'gender' => $request['gender']));


		        
			        $old_complianeFor = $request['old_complianeFor'];
			        $old_sufferer_nationality = $request['old_sufferer_nationality'];
		        	$oldrelation = $request['old_relation'];
	                $oldapplication_against = $request['old_agency_name'];
	        	    $oldaccused = $request['old_application_against'];

	                $oldagency_name = $request['old_agency_name'];
	                $oldagency_mobile_no = $request['old_agency_mobile_no'];
	                $oldcompany_name = $request['old_company_name'];
	                $oldcompany_mobile_no = $request['old_company_mobile_no'];
	                $oldbroker_mobile_no = $request['old_broker_mobile_no'];
	                $oldbroker_name = $request['old_broker_name'];
	                $oldperson_name = $request['old_person_name'];
	                $oldperson_mobile_no = $request['old_person_mobile_no'];
	                $oldrecruitment_officer_name = $request['old_recruitment_officer_name'];
	                $oldrecruitment_officer_mobile_no = $request['old_recruitment_officer_mobile_no'];

	                $oldapplicant_name = $request['old_applicant_name'];
	                $oldapplicant_email = $request['old_applicant_email'];
	                $oldapplicant_mobile_no = $request['old_applicant_mobile_no'];
	                $oldapplicant_address = $request['old_applicant_address'];
	                $oldsufferer_name = $request['old_sufferer_name'];
	                $oldsufferer_mobile = $request['old_sufferer_mobile'];
	                $oldsufferer_nationality = $request['old_sufferer_nationality'];
	                $oldsufferer_current_country = $request['old_sufferer_current_country'];
	                $oldsufferer_current_address = $request['old_sufferer_current_address'];
	                $oldsufferer_passport_no = $request['old_sufferer_passport_no'];
	                $oldsufferer_local_no = $request['old_sufferer_local_no'];
	                $oldsufferer_district = $request['old_sufferer_district'];
	                $oldsufferer_upazilla = $request['old_sufferer_upazilla'];
	                $oldsufferer_local_address = $request['old_sufferer_local_address'];
                    $oldgender = $request['gender'];
	        		$tracking_no = $request['tracking_no'];



		        	$case_tracking = new case_tracking;
		            $case_tracking->apps_application_id = 0;
		        	$case_tracking->applicantTrackingNo = $tracking_no;
		        	$case_tracking->application_for = $old_complianeFor;

		            if($oldrelation != ""){
		            	$case_tracking->relation = $oldrelation;
		            }else{
		            	$case_tracking->relation = "NULL";
		            }

                    if($oldgender != ""){
                        $case_tracking->gender = $oldgender;
                    }else{
                        $case_tracking->gender = "NULL";
                    }
		            
		            if($oldapplication_against != ""){
		            	$case_tracking->application_against = $oldapplication_against;
		            }else{
		            	$case_tracking->application_against = "NULL";
		            }

		            if($oldapplicant_address != ""){
		            	$case_tracking->applicant_address = $oldapplicant_address;
		            }else{
		            	$case_tracking->applicant_address = "NULL";
		            }
		            
		            
		            if($oldaccused != ""){
		            	$case_tracking->agency_name = $oldaccused;
		            }else{
		            	$case_tracking->agency_name = "NULL";
		            }
		            





		            if($oldagency_name != ""){
		            	$case_tracking->agency_name = $oldagency_name;
		            }else{
		            	$case_tracking->agency_name = "NULL";
		            }
		            
		            if($oldagency_mobile_no != ""){
		            	$case_tracking->agency_mobile_no = $oldagency_mobile_no;
		            }else{
		            	$case_tracking->agency_mobile_no = "NULL";
		            }

                    if($oldcompany_name != ""){
                        $case_tracking->company_name = $oldcompany_name;
                    }else{
                        $case_tracking->company_name = "NULL";
                    }
                    
                    if($oldcompany_mobile_no != ""){
                        $case_tracking->company_mobile_no = $oldcompany_mobile_no;
                    }else{
                        $case_tracking->company_mobile_no = "NULL";
                    }

                    if($oldbroker_name != ""){
                        $case_tracking->broker_name = $oldbroker_name;
                    }else{
                        $case_tracking->broker_name = "NULL";
                    }
                    
                    if($oldbroker_mobile_no != ""){
                        $case_tracking->broker_mobile_no = $oldbroker_mobile_no;
                    }else{
                        $case_tracking->broker_mobile_no = "NULL";
                    }

                    if($oldperson_name != ""){
                        $case_tracking->person_name = $oldperson_name;
                    }else{
                        $case_tracking->person_name = "NULL";
                    }
                    
                    if($oldperson_mobile_no != ""){
                        $case_tracking->person_mobile_no = $oldperson_mobile_no;
                    }else{
                        $case_tracking->person_mobile_no = "NULL";
                    }

                    if($oldrecruitment_officer_name != ""){
                        $case_tracking->recruitment_officer_name = $oldrecruitment_officer_name;
                    }else{
                        $case_tracking->recruitment_officer_name = "NULL";
                    }
                    
                    if($oldrecruitment_officer_mobile_no != ""){
                        $case_tracking->recruitment_officer_mobile_no = $oldrecruitment_officer_mobile_no;
                    }else{
                        $case_tracking->recruitment_officer_mobile_no = "NULL";
                    }


                    if($oldsufferer_current_address!= ""){
                        $case_tracking->sufferer_current_address = $oldsufferer_current_address;
                    }else{
                        $case_tracking->sufferer_current_address = "NULL";
                    }

		            




		            if($oldapplicant_name != ""){
		            	$case_tracking->applicant_name = $oldapplicant_name;
		            }else{
		            	$case_tracking->applicant_name = "NULL";
		            }
		            
		            if($oldapplicant_email != ""){
		            	$case_tracking->applicant_email = $oldapplicant_email;
		            }else{
		            	$case_tracking->applicant_email = "NULL";
		            }

		            if($oldapplicant_mobile_no != ""){
		            	$case_tracking->applicant_mobile_no = $oldapplicant_mobile_no;
		            }else{
		            	$case_tracking->applicant_mobile_no = "NULL";
		            }

		            if($oldsufferer_name != ""){
		            	$case_tracking->sufferer_name = $oldsufferer_name;
		            }else{
		            	$case_tracking->sufferer_name = "NULL";
		            }
	            

		            if($oldsufferer_mobile != ""){
		            	$case_tracking->sufferer_mobile = $oldsufferer_mobile;
		            }else{
		            	$case_tracking->sufferer_mobile = "NULL";
		            }
	            

		            if($oldsufferer_nationality != ""){
		            	$case_tracking->sufferer_nationality = $oldsufferer_nationality;
		            }else{
		            	$case_tracking->sufferer_nationality = "NULL";
		            }
	            

		            if($oldsufferer_current_country != ""){
		            	$case_tracking->sufferer_current_country = $oldsufferer_current_country;
		            }else{
		            	$case_tracking->sufferer_current_country = "NULL";
		            }
	            

		            if($oldsufferer_passport_no != ""){
		            	$case_tracking->sufferer_passport_no = $oldsufferer_passport_no;
		            }else{
		            	$case_tracking->sufferer_passport_no = "NULL";
		            }
	            

		            if($oldsufferer_local_no != ""){
		            	$case_tracking->sufferer_local_no = $oldsufferer_local_no;
		            }else{
		            	$case_tracking->sufferer_local_no = "NULL";
		            }
	            

		            if($oldsufferer_district != ""){
		            	$case_tracking->sufferer_district = $oldsufferer_district;
		            }else{
		            	$case_tracking->sufferer_district = "NULL";
		            }
	            

		            if($oldsufferer_upazilla != ""){
		            	$case_tracking->sufferer_upazilla = $oldsufferer_upazilla;
		            }else{
		            	$case_tracking->sufferer_upazilla = "NULL";
		            }
	            

		            if($oldsufferer_local_address != ""){
		            	$case_tracking->sufferer_local_address = $oldsufferer_local_address;
		            }else{
		            	$case_tracking->sufferer_local_address = "NULL";
		            }
	            
	            
	                $case_tracking->application_text = "NULL";

	                $case_tracking->reply_text = "NULL";
	                $case_tracking->response_text = "NULL";
		            
		            $case_tracking->user_id = $userID;
		            $case_tracking->save();

		    Session::flash('message', 'Case updated successfully!'); 
        	return redirect('/ComplianceDetails/'.$tracking_no);
        
    	}

    public function caseTracking($id){
    	//dd($id);
        $data['casedetails'] = DB::table('case_trackings')
        							->where('application_id',$id)
        							->get();
        //dd($data['casedetails']);
        return view('case.trackingDetails')->with($data);
    }



}
