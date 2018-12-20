<?php

namespace App\Http\Controllers\Compliance;

use DB;
use Auth;
use Mail;
use App\User;
use App\app_role;
use App\ComplianceShared;
use App\Complianceform;
use App\BlastApplication;
use App\ComplianceList;
use App\ComplianceSupportingDoc;
use App\ComplianceUserComment;
use App\ComplianceUserAssign;
use App\ComplianceUserCommentsDoc;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PragmaRX\Countries\Package\Countries;
use Illuminate\Support\Facades\Input;
use App\send_mail;
use App\MenuPermission;
use Validator;
use Session;
use Config;
use App\AppUser;
use App\hearing_letter;
use App\casefiling_user_assign;
use App\hearing_notification;
use App\Http\Controllers\HomeController;
use App\new_case_notification;
use App\apps_country;
use App\hearing_report_generate;

class ComplianceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //return $this->test();
    }

    /**
     * empUserID works like id, it generate from backend , format minite hour sec
     * collect all data from role , countries , agencyName 
     * @author 
     * @return all table data in ComplianceForm view
     */ 


    public function index()
    {
    	$userID = Auth::user()->empUserID;

        $data['role'] = app_role::get();
        $data['apps_country'] = apps_country::all();

        $countries = new Countries();

        $data['countries'] = $countries->all();

        $data['agencyName'] = DB::table('blast_recruiting_agency_name')
                                ->orderBy('agency_id', 'ASC')->get();
                                
        $userID = Auth::user()->empUserID;

        $data['count'] = send_mail::where('notification',0)->where('empUserID',$userID)->count();

    	return View('case.ComplianceForm')->with($data);
    }


    /**
     * save all data in BlastApplication table.
     * tracking_no geneerated from date('ymdhis')
     * apps_application_id will be 0 , if complain from web
     * database field can not be null , so check & put it null if blank
     * upload Doc in ComplianceSupportingDoc table
     * insert list of complain in ComplianceList table 
       (complaince details- comaplain name, complaince id- complaince id, caseid for link complain with ComplianceList) 
     * @author 
     * @return CaseCreate route
     */ 


    public function Savecompliance(Request $request)
    {
        $userID = Auth::user()->empUserID;
		define('MB', 1048576);
        $validator = Validator::make($request->all(), [
                
                'complianeFor'              => 'required',

                'company_name'               => 'max:100',
                'company_mobile_no'         => 'max:20',

                'agency_name'               => 'max:100',
                'agency_mobile_no'         => 'max:20',

                'agent_name'               => 'max:100',
                'agency_mobile_no'         => 'max:20',

                'person_name'               => 'max:100',
                'person_mobile_no'         => 'max:20',

                'officer_name'               => 'max:100',
                'officer_mobile_no'         => 'max:20',

                'broker_name'               => 'max:100',
                'brokers_mobile_no'         => 'max:20',

                'complainant_name'          => 'max:100',
                'complainant_address'       => 'max:1000',
                'complainant_email'         => 'max:100',
                'complainant_mobile'        => 'max:20',
                'victim_name'               => 'required|max:100',
                'victim_mobile'             => 'required|max:20',
                'victim_nationality'        => 'max:50',
                'victim_country_name'       => 'max:200',
                'victim_address'            => 'max:1000',
                'victim_passport'           => 'max:100',
                'victim_local_no'           => 'max:20',
                'victim_district'           => 'max:50',
                'victim_upazilla'           => 'max:50',
                'victim_local_address'      => 'max:1000',
                'complaint_list'            => 'required'
               
            ]);
            if ($validator->fails()) {
            return redirect('/CaseCreate')
                            ->withErrors($validator)
                            ->withInput();
            } 

            
            $allowedfileExtension=['pdf','jpg','png','docx','doc','mp4','mp3','flv','txt'];
            //dd(count($request->file('support_doc')));
            $checkStatus    =   true;
            if($request->file('support_doc') != null){

                $files = $request->file('support_doc');

                foreach($files as $file){

                    $filename = $file->getClientOriginalName();

                    $extension = $file->getClientOriginalExtension();

                    if(!in_array($extension,$allowedfileExtension)){
                        $checkStatus    =   false;
                    }
                }

                //dd($check);
                if($checkStatus == false){
                    Session::flash('message', 'Please upload pdf,jpg,png,docx,doc formatted file!'); 
                    return redirect('/CaseCreate')
                            ->withErrors($validator)
                            ->withInput();
                }
                if($_FILES['support_doc']['size']  < 10*MB){
                    Session::flash('message', 'Please upload file less than 10 mb'); 
                    return redirect('/CaseCreate')
                            ->withErrors($validator)
                            ->withInput();
                }
            //
            }
            

            $caseID = mt_rand(100000, 999999);

        	$compliance = new BlastApplication();
            $tracking_no = date('ymdhis');
            $compliance->apps_application_id = 0;
        	$compliance->applicantTrackingNo = $tracking_no;
        	$compliance->case_id = $caseID;
        	$compliance->committeeNo = $tracking_no;
        	$compliance->application_for = $request['complianeFor'];
            if(empty($request['relation'])){
                $compliance->relation = "NULL";
            }else{
                $compliance->relation = $request['relation'];
            }
            $compliance->response_text = '';
            if(empty($request['complaint_against'])){
                $compliance->application_against = "NULL";
            }else{
                $compliance->application_against = $request['complaint_against'];
            }

            if(empty($request['company_name'])){
                $compliance->company_name = "NULL";
            }else{
                $compliance->company_name = $request['company_name'];
            }
            
            if(empty($request['company_mobile_no'])){
                $compliance->company_mobile_no = "NULL";
            }else{
                $compliance->company_mobile_no = $request['company_mobile_no'];
            }

            if(empty($request['agency_name'])){
                $compliance->agency_name = "NULL";
            }else{
                $compliance->agency_name = $request['agency_name'];
            }
            
            if(empty($request['agency_mobile_no'])){
                $compliance->agency_mobile_no = "NULL";
            }else{
                $compliance->agency_mobile_no = $request['agency_mobile_no'];
            }


            if(empty($request['agent_name'])){
                $compliance->broker_name = "NULL";
            }else{
                $compliance->broker_name = $request['agent_name'];
            }
            
            if(empty($request['agent_mobile_no'])){
                $compliance->broker_mobile_no = "NULL";
            }else{
                $compliance->broker_mobile_no = $request['agent_mobile_no'];
            }


            if(empty($request['officer_name'])){
                $compliance->recruitment_officer_name = "NULL";
            }else{
                $compliance->recruitment_officer_name = $request['officer_name'];
            }
            
            if(empty($request['officer_mobile_no'])){
                $compliance->recruitment_officer_mobile_no = "NULL";
            }else{
                $compliance->recruitment_officer_mobile_no = $request['officer_mobile_no'];
            }



            if(empty($request['person_name'])){
                $compliance->person_name = "NULL";
            }else{
                $compliance->person_name = $request['person_name'];
            }
            
            if(empty($request['person_mobile_no'])){
                $compliance->person_mobile_no = "NULL";
            }else{
                $compliance->person_mobile_no = $request['person_mobile_no'];
            }

            if(empty($request['complainant_name'])){
                $compliance->applicant_name = "NULL";
            }else{
                $compliance->applicant_name = $request['complainant_name'];
            }
        	
            if(empty($request['complainant_country'])){
                $compliance->applicant_country = "NULL";
            }else{
                $compliance->applicant_country = $request['complainant_country'];
            }
        	
            if(empty($request['complainant_email'])){
                $compliance->applicant_email = "NULL";
            }else{
                $compliance->applicant_email = $request['complainant_email'];
            }
        	
            if(empty($request['complainant_mobile'])){
                $compliance->applicant_mobile_no = "NULL";
            }else{
                $compliance->applicant_mobile_no = $request['complainant_mobile'];
            }
        	
            if(empty($request['complainant_address'])){
                $compliance->applicant_address = "NULL";
            }else{
                $compliance->applicant_address = $request['complainant_address'];
            }
        	
            if(empty($request['victim_name'])){
                $compliance->sufferer_name = "NULL";
            }else{
                $compliance->sufferer_name = $request['victim_name'];
            }
        	
            if(empty($request['victim_mobile'])){
                $compliance->sufferer_mobile = "NULL";
            }else{
                $compliance->sufferer_mobile = $request['victim_mobile'];
            }
        	
            if(empty($request['victim_nationality'])){
                $compliance->sufferer_nationality = "NULL";
            }else{
                $compliance->sufferer_nationality = $request['victim_nationality'];
            }
        	
            if(empty($request['victim_country_name'])){
                $compliance->sufferer_current_country = "NULL";
            }else{
                $compliance->sufferer_current_country = $request['victim_country_name'];
            }
        	
            if(empty($request['victim_address'])){
                $compliance->sufferer_current_address = "NULL";
            }else{
                $compliance->sufferer_current_address = $request['victim_address'];
            }
        	
            if(empty($request['victim_passport'])){
                $compliance->sufferer_passport_no = "NULL";
            }else{
                $compliance->sufferer_passport_no = $request['victim_passport'];
            }
        	
            if(empty($request['victim_local_no'])){
                $compliance->sufferer_local_no = "NULL";
            }else{
                $compliance->sufferer_local_no = $request['victim_local_no'];
            }
        	
            if(empty($request['victim_district'])){
                $compliance->sufferer_district = "NULL";
            }else{
                $compliance->sufferer_district = $request['victim_district'];
            }
        	
            if(empty($request['victim_upazilla'])){
                $compliance->sufferer_upazilla = "NULL";
            }else{
                $compliance->sufferer_upazilla = $request['victim_upazilla'];
            }
        	
            if(empty($request['victim_local_address'])){
                $compliance->sufferer_local_address = "NULL";
            }else{
                $compliance->sufferer_local_address = $request['victim_local_address'];
            }
        	
            if(empty($request['complaint_description'])){
                $compliance->application_text = "NULL";
            }else{
                $compliance->application_text = $request['complaint_description'];
            }


            if(empty($request['gender'])){
                $compliance->gender = "NULL";
            }else{
                $compliance->gender = $request['gender'];
            }
            

            if(empty($request['money_taker_name'])){
                $compliance->money_taker_name = "NULL";
            }else{
                $compliance->money_taker_name = $request['money_taker_name'];
            }
            if(empty($request['money_taker_phone_no'])){
                $compliance->money_taker_phone_no = "NULL";
            }else{
                $compliance->money_taker_phone_no = $request['money_taker_phone_no'];
            }


        	$compliance->application_type = "Web";
        	//var_dump($compliance);
        	$file = $request['support_doc'];
        	$compliancesupportingdoc = new ComplianceSupportingDoc();
        	if(!empty($file)){
        	$doc  = [];
        	foreach($file as $files){
        		$filename = $files->getClientOriginalName();
        		$orginal_name = pathinfo($filename, PATHINFO_FILENAME);
        		$imageName = md5(time().$orginal_name).'.'.$files->getClientOriginalExtension();
                $files->move(public_path('ComplianceDoc'), $imageName);
            	$doc[] = [
                    'caseId' => $compliance->case_id,
            		'tracking_no' => $tracking_no,
            		'orginal_name' => $orginal_name,
            		'supporting_doc_name' => $imageName
            	    ];
        	    }
        	    DB::table('compliance_supporting_docs')->insert($doc);
        	}else{
        	    
        	}

        	$complaint_list = $request['complaint_list'];

        	$complianceListData = new ComplianceList();
            if(!empty($complaint_list)){
        	$data = [];
        	foreach ($complaint_list as $key => $value) {
        		$user_imei2 = $this->complianceList($complaint_list[$key]);
        		$data[] = [
        			'caseId' => $compliance->case_id,
        			'complianceId' => $user_imei2['checkCode'],
        			'compliance_description' => $user_imei2['checkValue']
        		];
        	}
        	   $complianceListData->insert($data);
            }else{
                
            }
        	$compliance->save();
        	

            $mail = new send_mail;
            $mail->mail_to = "system@ilo.com";
            $mail->message_content = "New Case";
            $mail->mail_from = "System Admin";
            $mail->mail_status = 0;
            $mail->notification = 0;
            $mail->empUserID = "Admin";
            $mail->tracking_number = $tracking_no;
            $mail->save();  
            
            // notification send
              
            // new case list  

            $new_case_list = BlastApplication::where('application_status','received')->get();

            $case = [];
            foreach ($new_case_list as $key => $value) {
                $case[] = [
                    'value' => $value->application_status
                ];
            };

            //dd($case);
            // new case permission view user
            
            //$user_list = MenuPermission::where('permissionid','8877662')->get();
            $user_list = DB::table('menu_permissions')
                        ->join('users','menu_permissions.empuserid','=','users.empUserID')
                        ->where('menu_permissions.permissionid','8877662')
                        ->get();

            $user_array = [];
            foreach ($user_list as $key => $value) {
                $user_array[] = $value->empuserid;
            }

            for ($i=0; $i <= count($user_array)-1 ; $i++) { 
                $new_case_notification                  = new new_case_notification;
                $new_case_notification->tracking_no     = $tracking_no;
                $new_case_notification->empUserId       = $user_array[$i];
                $new_case_notification->visual_status   = 0;
                $new_case_notification->save();
            }

        	return redirect('/FilingCaseList')->with('message', "Complain created successfully.Your tracking number is:".$compliance->applicantTrackingNo);
        
    }


     /**
     * select from case_filing_view where casestatus 1 ( on going ) for admin
       ignore group by

     * select case_inquery_view for admin 

     * for user select empUserId 
       status 0 means this case assigned for user 
       step_order

     * step order 0 means still assign this case

     * @author 
     * @return CaseCreate route
     */ 
   
    public function ViewCase()
    {
    	$userID = Auth::user()->empUserID;

        $fullname = DB::table('app_users')
                    ->where('empUserId','=',$userID)
                    ->select('FullName','empUserId')
                    ->first();

        $groupid = DB::table('menu_permissions')
                    ->where('empUserId','=',$userID)
                    ->select('groupid')
                    ->first();

        if(isset($groupid->groupid) && $groupid->groupid == '7070514'){
            $data['dg_button_check'] = "show";
        }

        $fullname = $fullname->FullName;

        $data['caseadminlist'] = DB::table('case_filing_view')
                                ->where('casestatus','=',1)
                                ->groupBy('caseId')
                                ->orderBy('applicantTrackingNo', 'DESC')
                                ->get();

        $data['caselist'] = DB::table('case_inquery_view')
                            ->where('application_status','=', 'Case Send for Inquery.')
                            ->orderBy('applicantTrackingNo', 'DESC')
                            ->groupBy('applicantTrackingNo')
        					->get();
        
        $data['access_permission'] = DB::table('access_permission_view')
                                ->where('empUserId','=',$userID)
                                ->get();

        $data['count'] = send_mail::where('notification',0)->where('empUserID',$userID)->count();

        $view_permission = DB::table('blast_committee_letters')
                                ->select('officer_name1')
                                ->where('officer_name1','=',$fullname)
                                ->orwhere('officer_name2','=',$fullname)
                                ->orwhere('dg_view','=',$groupid->groupid)
                                ->get();


        if(count($view_permission) == 0){
            $data['caselist'] = [];
            $data['caseadminlist'] = [];
            return View('case.ComplianceView')->with($data);
        }else{
            return View('case.ComplianceView')->with($data);
        }
        
    }

    /**
     * caseadminlist for show case for admin
       case_filing_user_status 0 means this case is assigned for this user. 
       1 means complated
       groupBy applicantTrackingNo ignore this part

       casealllist for users who are assigned to see case list
       case_filing_user_status 0 means this case is assigned for this user. 
       1 means complated
       casestatus != 2 means (not showing completed cases)
       because user will show all pending & not started list

     * @author 
     */ 

    public function ViewAllCase()
    {

    	$userID = Auth::user()->empUserID;
        $caseIdsConainer    =   [];
        $caseRowConainer    =   [];
        
        $data['caseadminlist'] = DB::table('case_filing_view')
                                ->where('casestatus','=',0)
                                ->where('application_status','!=','Case Send for Inquery.')
                                ->where('application_status','!=','Case Inquery On Progress.')
                                ->groupBy('applicantTrackingNo')
                                ->orderBy('applicantTrackingNo', 'DESC')
                                ->get();

        foreach($data['caseadminlist'] as $caseadminlist){
            array_push($caseIdsConainer, $caseadminlist->application_id);
            array_push($caseRowConainer, $caseadminlist);
        }        

        $data['casealllist'] = DB::table('case_filing_view')
                            ->where('empUserId','=',$userID)
                            ->where('case_filing_user_status','=', 0)
                            ->where('application_status','!=','Case Send for Inquery.')
                            ->where('application_status','!=','Case Inquery On Progress.')
                            ->where('casestatus','!=', 2)
                            ->groupBy('applicantTrackingNo')
                            ->orderBy('applicantTrackingNo', 'DESC')
                            ->get();

        foreach($data['casealllist'] as $casealllist){
            if(!in_array($casealllist->application_id, $caseIdsConainer)){
                array_push($caseRowConainer, $casealllist);
            }
        }
        $data['caseadminlist']   =     $caseRowConainer;     
        
        $data['access_permission'] = DB::table('access_permission_view')
                                        ->get();

        
        return View('case.ComplianceList')->with($data);
    }

    public function ViewAllCompleteCase()
    {
        $userID = Auth::user()->empUserID;

        $data['caseadminlist'] = DB::table('blast_applications')
                            ->where('application_status','=',"Case Inquery Complete.")
                            ->get();
        $data['casealllist'] = DB::table('blast_applications')
                            ->where('application_status','=',"Case Inquery Complete.")
                            ->get();

        return View('case.ComplianceCompleteList')->with($data);

    }

    public function FullCases()
    {
        $userID = Auth::user()->empUserID;
        $data['caseinqueryalllist'] = DB::table('blast_applications')
                            ->get();

        /*
        $data['caseinqueryalllist'] = DB::table('case_inquery_view')
                            ->where('empUserId','=',$userID)
                            ->where('casestatus','=', 2)
                            ->where('step_order','=', 1)
                            ->groupBy('case_id')
                            ->orderBy('applicantTrackingNo', 'DESC')
                            ->get();
        $data['casefilingalllist'] = DB::table('case_filing_view')
                            ->where('empUserId','=',$userID)
                            ->where('case_filing_user_status','=', 1)
                            ->where('casestatus','!=', 2)
                            ->groupBy('case_id')
                            ->orderBy('applicantTrackingNo', 'DESC')
                            ->get();
        
        */
        $data['access_permission'] = DB::table('access_permission_view')
                                ->where('empUserId','=',$userID)
                                ->get();
        $data['count'] = send_mail::where('notification',0)->where('empUserID',$userID)->count();


        return View('case.FullcaseList')->with($data);
    }

    /**
     * blast_applications, ComplianceSupportingDoc , case_supporting bring all data
     * 

     * @author 
     */ 

    public function SummaryAllCase($id)
    {
    	$userID = Auth::user()->empUserID;

        $data['casedetails'] = DB::table('blast_applications')->where('applicantTrackingNo','=',$id)->get();
        $data['casemaindocument'] = ComplianceSupportingDoc::where('tracking_no','=',$id)->get();
        $data['casedocument'] = DB::table('case_supporting')->where('applicantTrackingNo','=',$id)->get();
        $userID = Auth::user()->empUserID;
        $data['count'] = send_mail::where('notification',0)->where('empUserID',$userID)->count();

        $data['case_filing_user_comments_doc'] = DB::table('casefiling_user_comments_doc')->where('tracking_no','=',$id)->get();

        $data['case_tracking'] = DB::table('case_trackings')->where('applicantTrackingNo','=',$id)->get();

        $data['hearing_tracking'] = DB::table('hearing_letters')->where('tracking_no','=',$id)->get();

        $data['committe_tracking'] = DB::table('blast_committee_letters')->where('tracking_no','=',$id)->get();
        
        return View('case.ComplianceDetails')->with($data);
    }

    /**
     * select from blast_applications
     * ComplianceShared table for comment is shareable (0) or private(1). 
     * ComplianceUserComment for comment list
     * @author 
     */ 


    public function CompliantComments($id)
    {
    	$userID = Auth::user()->empUserID;

        $data['caseshared'] = ComplianceShared::where('tracking_no','=',$id)->get();
        $data['casedetails'] = DB::table('blast_applications')->where('applicantTrackingNo','=',$id)->get();
        $data['casecomments'] = ComplianceUserComment::where('tracking_no','=',$id)->get();

        $data['casefilingcomments'] = DB::table('casefiling_user_comments')->where('tracking_no','=',$id)->get();

        $userID = Auth::user()->empUserID;
        $data['count'] = send_mail::where('notification',0)->where('empUserID',$userID)->count();


        return View('case.ComplianceComments')->with($data);
    }


    /**
     * select data from blast_applications, ComplianceSupportingDoc & case_supporting
     * ignore access_permission
     * 
     * @author 
     */ 


    public function CompliantStart($id)
    {
        $userID = Auth::user()->empUserID;
        DB::table('casefiling_user_assigns')
            ->where('tracking_no',$id)
            ->where('empUserId',$userID)
            ->update(['visual_status' => 1]);
    	

        $data['casedetails'] = DB::table('blast_applications')->where('applicantTrackingNo','=',$id)->get();
        $data['casemaindocument'] = ComplianceSupportingDoc::where('tracking_no','=',$id)->get();
        $data['casedocument'] = DB::table('case_supporting')->where('applicantTrackingNo','=',$id)->get();

        $data['user'] = AppUser::get();
        $data['access_permission'] = DB::table('access_permission_view')
                                            ->where('empUserId','=',$userID)
                                            ->get();

        $data['hearing_tracking'] = DB::table('hearing_letters')
                                                ->where('tracking_no','=',$id)
                                                ->get();

        $data['commitee_letter_member'] = DB::table('blast_committee_letters')
                                                    ->where('tracking_no','=',$id)
                                                    ->first();
        
        $report_check = DB::table('hearing_report_generates')
                                            ->where('tracking_no','=',$id)
                                            ->get();

        $data['report_count']  = count($report_check);

        return View('case.Compliance')->with($data);
    }

    public function hearingLetter($id){
        $data['hearing_trackings'] = DB::table('hearing_letters')->where('id','=',$id)->get();

        $tracking_no = DB::table('hearing_letters')
                                                ->select('tracking_no')
                                                ->where('id','=',$id)->first();

        $hearing_tracking_no = $tracking_no->tracking_no;

        $data['commitee_letter_member'] = DB::table('blast_committee_letters')->where('tracking_no','=',$hearing_tracking_no)->first();
        return View('case.hearing_letter')->with($data);
    }

    public function hearing_letter_view($id){
        $data['hearing_trackings'] = DB::table('hearing_letters')->where('id','=',$id)->get();

        $tracking_no = DB::table('hearing_letters')
                                                ->select('tracking_no')
                                                ->where('id','=',$id)->first();

        $hearing_tracking_no = $tracking_no->tracking_no;

        $data['commitee_letter_member'] = DB::table('blast_committee_letters')->where('tracking_no','=',$hearing_tracking_no)->first();

        $committee_no = DB::table('blast_committee_letters')
                                                ->select('committee_no')
                                                ->where('tracking_no','=',$hearing_tracking_no)
                                                ->first();

        $data['committee_sarokno'] = $committee_no->committee_no;

        return View('case.hearing_letter_view')->with($data);
    }
    

    public function CaseComplete(Request $request){

        $tracking_no = $request['tracking_no'];
        $case = BlastApplication::where('applicantTrackingNo',$tracking_no)
                                ->select("case_id")
                                ->first();

        $caseID = $case->case_id;
        
        DB::table('hearing_notifications')->where('tracking_no',$tracking_no)
                                        ->update(['visual_status' => 1]);

        if(isset($request['complete']))
        {
            
            $casestatus = "Case Inquery Complete";
            $push = HomeController::push_notification($casestatus,$caseID);
            DB::table('blast_applications')->where('applicantTrackingNo',$tracking_no)
                    ->update(['casestatus' => 2,'application_status'=>'Case Inquery Complete.','updated_at'=>date('Y-m-d H:i:s')]);
            DB::table('compliance_user_assigns')->where('tracking_no',$tracking_no)
                    ->update(['step_order' => 1]);

            return redirect('AllCompleteCase');
        }
        elseif(isset($request['incomplete']))
        {
            $casestatus = "Case InComplete";
            $push = HomeController::push_notification($casestatus,$caseID);
            DB::table('blast_applications')->where('applicantTrackingNo',$tracking_no)
                    ->update(['casestatus' => 2,'application_status'=>'Case Inquiry Incomplete.','updated_at'=>date('Y-m-d H:i:s')]);
            DB::table('compliance_user_assigns')->where('tracking_no',$tracking_no)
                    ->update(['step_order' => 1]);
            return redirect('CaseIncomplete');
        }
    }


    public function AllInCompleteCase(){
        $userID = Auth::user()->empUserID;
        

        $data['caseadminlist'] = DB::table('blast_applications')
                                    ->where('application_status','=',"Case Inquiry Incomplete.")
                                    ->get();

        $data['casealllist'] = DB::table('blast_applications')
                                    ->where('application_status','=',"Case Inquiry Incomplete.")
                                    ->get();

        return View('case.Incomplete')->with($data);

    }

    public function hearingLetterPost(Request $request)
    {
            //dd($request->all());
            $userID = Auth::user()->empUserID;
            $hearing_letter                         = hearing_letter::find($request->track_id);
            $hearing_letter->tracking_no            = $request['tracking_no'];
            $hearing_letter->sarok_generate_date    = $request['sarok_generate_date'];
            $hearing_letter->register_no            = $request['register_no'];
            $hearing_letter->sunani_no              = $request['sunani_no'];
            $hearing_letter->hearing_full_date      = $request['hearing_full_date'];
            $hearing_letter->hearing_day            = $request['hearing_day'];
            $hearing_letter->hearing_time           = $request['hearing_time'];
            $hearing_letter->hearing_generate_date  = $request['hearing_generate_date'];
            $hearing_letter->created_by             = $userID;
            $hearing_letter->sufferer_name          = $request['sufferer_name'];
            $hearing_letter->sufferer_father        = $request['sufferer_father'];
            $hearing_letter->sufferer_address       = $request['sufferer_address'];
            $hearing_letter->agency_name            = $request['agency_name'];
            $hearing_letter->agency_mobile_no       = $request['agency_mobile_no'];
            $hearing_letter->agency_address         = $request['agency_address'];
            $hearing_letter->note                   = $request['note'];
            $hearing_letter->committee_no           = $request['committee_no'];
            if(isset($request['final_send'])){
                $hearing_letter->status                 = "Done";
                    
            }if(isset($request['final_save']) ){
                $hearing_letter->status                 = "Save";
            }
            $hearing_letter->save();
            return redirect('/ComplianceList')->with('message', 'Case status changed successfully');

    }

    public function ComplianceStartCreate(Request $request)
    {
        //dd($request->all());
    	$userID = Auth::user()->empUserID;
        $tracking_no = $request['tracking_no'];
    	$caseID = $request['caseID'];

    	$userComment = new ComplianceUserComment();

        $userComment->caseId = $caseID;
    	$userComment->tracking_no = $tracking_no;
    	$userComment->empUserId = $userID;
    	$userComment->comments = $request['observation'];
        $userComment->commentsstatus = 1;
        $casestatus = $request['casestatus'];
        
        
        if(isset($request['assign']) || isset($request['save']))
        {
            $hearing_letter                         = new hearing_letter;
            $hearing_letter->tracking_no            = $request['tracking_no'];
            $hearing_letter->sarok_generate_date    = $request['sarok_generate_date'];
            $hearing_letter->register_no            = $request['register_no'];
            $hearing_letter->sunani_no              = $request['sunani_no'];
            $hearing_letter->hearing_full_date      = $request['hearing_full_date'];
            $hearing_letter->hearing_day            = $request['hearing_day'];
            $hearing_letter->hearing_time           = $request['hearing_time'];
            $hearing_letter->hearing_generate_date  = $request['hearing_generate_date'];
            $hearing_letter->created_by             = $userID;
            $hearing_letter->sufferer_name          = $request['sufferer_name'];
            $hearing_letter->sufferer_father        = $request['sufferer_father'];
            $hearing_letter->sufferer_address       = $request['sufferer_address'];
            $hearing_letter->agency_name            = $request['agency_name'];
            $hearing_letter->agency_mobile_no       = $request['agency_mobile_no'];
            $hearing_letter->agency_address         = $request['agency_address'];

            if(isset($request['assign'])){
                $BlastApplication = BlastApplication::where('applicantTrackingNo',$request['tracking_no'])->first();
                $caseID = $BlastApplication->caseid;
                $casestatus = "Notification for hearing";
                $push = HomeController::push_notification($casestatus,$caseID);
                $hearing_letter->status             = "Done";
            }
            if(isset($request['save'])){

                $hearing_letter->status             = "Save";
            }
            $hearing_letter->note                   = $request['observation'];
            $hearing_letter->save();

            if($casestatus == 0)
            {

                // case inquiry start sms send (first send) 

                // insert first hearing letter table
        
                // case inquiry update status

                DB::table('blast_applications')->where('applicantTrackingNo',$tracking_no)
                    ->update(['casestatus' => 1,'application_status'=>'Case Send for Inquery.','updated_at'=>date('Y-m-d H:i:s')]);
            }else{

                // insert first hearing letter table for 2nd time

                // case inquiry update status

                DB::table('blast_applications')->where('applicantTrackingNo',$tracking_no)
                    ->update(['application_status'=>'Case Inquery On Progress.','updated_at'=>date('Y-m-d H:i:s')]); 
                DB::table('compliance_user_assigns')->where('tracking_no',$tracking_no)
                    ->where('empUserId','=',$userID)
                    ->update(['status'=>1]);
            
            }
            
        	$allocated_day = 0;

        	$personList = 1;
        	$personSeperate = explode(',', $personList);
            $data = [];
        	foreach($personSeperate as $per_ID) 
            {
                $data[] = [
                    'caseId' => $caseID,
                    'tracking_no' => $tracking_no,
                    'empUserId' => $per_ID,
                    'status' => 0,
                    'step_order' => 0,
                    'allocated_day' => $allocated_day,
                    'assign_by' => $userID
                ];
            }

            foreach($personSeperate as $userDatas){

                $email = mail_get($userDatas);
                $mail = new send_mail;
                $mail->mail_to = $email;
                $mail->tracking_number = $tracking_no;
                $mail->mail_from = mail_get($userID);
                $mail->empUserID = $per_ID;
                $mail->message_content = "This is my message";
                $mail->mail_status = 0;
                $mail->notification = 0;
                $mail->save();
            }

            $file = $request['supportingDoc'];

            if(!empty($file)){
        	$doc  = [];
        	foreach($file as $files){
        		$filename = $files->getClientOriginalName();
        		$orginal_name = pathinfo($filename, PATHINFO_FILENAME);
        		$imageName = md5(time().$orginal_name).'.'.$files->getClientOriginalExtension();
                $files->move(public_path('ComplianceCommentsDoc'), $imageName);
            	$doc[] = [
                    'caseId' => $caseID,
            		'tracking_no' => $tracking_no,
            		'empUserId' => $userID,
            		'supporting_doc' => $imageName,
            		'doc_orginal_name' => $filename
            	    ];
        	    }
        	DB::table('compliance_user_comments_doc')->insert($doc);
            }else{
                
            }
            $userComment->save();
            DB::table('compliance_user_assigns')->insert($data);
        }
        return redirect('/ComplianceList')->with('message', 'Action done successfully.');
    }

    /**
     * ComplianceDoc download 
     * 
     * @author 
     */ 


    public function CompliantDownload($file_name) 
    {
    	$file_path = public_path('ComplianceDoc/'.$file_name);
    	return response()->download($file_path);
  	}

  	public function SupportCompliantDownload($file_name) 
    {
    	$file_path = public_path('ComplianceCommentsDoc/'.$file_name);
    	return response()->download($file_path);
  	}

    public static function complianceList($id)
    {
    	if ($id == 1) {
    		$data['checkCode'] = 1;
    		$data['checkValue'] = "বেতন";
    	}elseif ($id == 2) {
    		$data['checkCode'] = 2;
    		$data['checkValue'] = "থাকার সমস্যা";
    	}elseif ($id == 3) {
    		$data['checkCode'] = 3;
    		$data['checkValue'] = "বেতন ছাড়া অতিরিক্ত কাজ";
    	}elseif ($id == 4) {
    		$data['checkCode'] = 4;
    		$data['checkValue'] = "চাকুরী নাই";
    	}elseif ($id == 5) {
    		$data['checkCode'] = 5;
    		$data['checkValue'] = "work permit / আকামা না পাওয়া";
    	}elseif ($id == 6) {
    		$data['checkCode'] = 6;
    		$data['checkValue'] = "জেলে আটকে  পড়া";
    	}elseif ($id == 7) {
    		$data['checkCode'] = 7;
    		$data['checkValue'] = "খাওয়ার সমস্যা ";
    	}elseif ($id == 8) {
    		$data['checkCode'] = 8;
    		$data['checkValue'] = "অ শারীরিক নির্যাতন / মানষিক নির্যাতন জেলে আটকে";
    	}elseif ($id == 9) {
    		$data['checkCode'] = 9;
    		$data['checkValue'] = " পরিবারের  সাথে যোগাযোগ করতে দেয় না ";
    	}elseif ($id == 10) {
    		$data['checkCode'] = 10;
    		$data['checkValue'] = "শারীরিক নির্যাতন";
    	}elseif ($id == 11) {
    		$data['checkCode'] = 11;
    		$data['checkValue'] = "বেতন জনিত সমস্যা";
    	}elseif ($id == 12) {
    		$data['checkCode'] = 12;
    		$data['checkValue'] = "অন্যান্য";
    	}
        elseif ($id == 13) {
            $data['checkCode'] = 13;
            $data['checkValue'] = "কাজ না পাওয়া";
        }
        elseif ($id == 14) {
            $data['checkCode'] = 14;
            $data['checkValue'] = "এয়ারপোর্টে আটকা পড়া";
        }
        elseif ($id == 15) {
            $data['checkCode'] = 15;
            $data['checkValue'] = "অতিরিক্ত কাজ";
        }
    	return $data;
    }

    public function CommitteeLetterGeneration($id)
    {
        $userID = Auth::user()->empUserID;
        $data['casedetails'] = DB::table('blast_applications')->where('applicantTrackingNo','=',$id)->get();
        $data['inquiry_user'] = DB::table('casefiling_user_assigns')->select('inquiry_assign1','inquiry_assign2')->where('tracking_no','=',$id)->where('inquiry_assign1','!=','NULL')->first();
        
        //dd($data['inquiry_user']);
        DB::table('committe_notifications')
                    ->where('tracking_no',$id)
                    ->where('empUserId',$userID)
                    ->update(['visual_status' => 1]);
        

        return View('case.Committeelettergeneration')->with($data);
    }

    public function Generatecommitteeletter(Request $request)
    { 

        $generate_date              = date("d-m-Y");
        $userID                     = Auth::user()->empUserID;
        $tracking_no                = Input::get('tracking_no');
        $committee_no               = Input::get('committee_no');
        $generate_date              = Input::get('published_day');
        $address                    = $request->address;
        $created_by                 = $userID;
        $agency_name                = $request->agency_name;
        $suffrer_name               = $request->suffrer_name;
        $mobile_number              = $request->mobile_number;
        $officer_name1              = $request->officer_name1;
        $officer_name2              = $request->officer_name2;
        $secretary                  = $request->secretary;
        $year                       = $request->year;
        $inquiry_assign_position1   = $request->inquiry_assign_position1;
        $inquiry_assign_position2   = $request->inquiry_assign_position2;

        $mail_to                    = Input::get('mail_to');
        $mail_from                  = Input::get('mail_from');

        $hearing_notification               = new hearing_notification;
        $hearing_notification->tracking_no  = $tracking_no;
        $hearing_notification->empUserId    = HomeController::getIdToFullNameAppUser($officer_name1);
        $hearing_notification->visual_status= 0;
        $hearing_notification->save();

        $hearing_notification               = new hearing_notification;
        $hearing_notification->tracking_no  = $tracking_no;
        $hearing_notification->empUserId    = HomeController::getIdToFullNameAppUser($officer_name2);
        $hearing_notification->visual_status= 0;
        $hearing_notification->save();

        $data = [
            'tracking_no'   => $tracking_no,
            'committee_no'  => $committee_no,
            'generate_date' => $generate_date,
            'address'       => $address,
            'status'        => 1,
            'created_by'    => $userID,
            'created_by'    => $created_by,
            'agency_name'   => $agency_name,
            'suffrer_name'  => $suffrer_name,
            'mobile_number' => $mobile_number,
            'officer_name1' => $officer_name1,
            'officer_name2' => $officer_name2,
            'secretary'     => $secretary,
            'year'          => $year,
            'inquiry_assign_position1' => $inquiry_assign_position1,
            'inquiry_assign_position2' => $inquiry_assign_position2
        ];

        DB::table('blast_committee_letters')->insert($data);

        $data['committee']=DB::table('blast_committee_letters')->where('tracking_no','=',$tracking_no)->first();

        
        
        
        return redirect('/AllCompliance')->with('message','Committee letter generated successfully .');
    }

    public function CommitteeLetterView($id)
    {
        $userID = Auth::user()->empUserID;
        $data['casedetails'] = DB::table('blast_committee_letters')->where('tracking_no','=',$id)->get(); 
        return View('case.Committeeletterview')->with($data);
    }

    public function generateReport($id){
        $data = $id;
        return view('generateReport',compact('data'));
    }

    public function reportGenerateInsert(Request $request){
       $hearing_report_generate                 = new hearing_report_generate;
       $hearing_report_generate->tracking_no    = $request->tracking_no;
       $hearing_report_generate->editor1        = $request->editor1;
       $hearing_report_generate->save();
       return redirect("reportGenerateView/$request->tracking_no");
    }

    public function reportGenerateView($id){
        $report = hearing_report_generate::where('tracking_no',$id)->get();
        return view('generateReportView',compact('report'));
    }

}
