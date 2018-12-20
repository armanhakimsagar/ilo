<?php

namespace App\Http\Controllers\Compliance;

use DB;
use Auth;
use App\BlastApplication;
use App\User;
use App\MenuPermission;
use App\app_role;
use App\ComplianceShared;
use App\Complianceform;
use App\ComplianceList;
use App\ComplianceStep;
use App\ComplianceSupportingDoc;
use App\ComplianceUserComment;
use App\ComplianceUserAssign;
use App\CaseFilingStep;
use App\CasefilingUserComment;
use App\ComplianceUserCommentsDoc;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PragmaRX\Countries\Package\Countries;
use Illuminate\Support\Facades\Input;
use App\Helpers\core;
use App\send_mail;
use App\ComplianceStepUser;
use App\committe_notification;
use App\Http\Controllers\HomeController;

class CasefilingprocessController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * This is for DG admin :

       select from blast_applications table for admin view.
       because admin can show all list but stuff will show only approved case.

       This is for if assign for view :

       case_filing_view table is same blast_applications (inner join).
       select from case_filing_view table from show case who have 
       gruop wise permission or single permission.
       case_filing_status null means group or user can view this list
       
       


     * ignore access_permission from everywhere (its not working now)
     * @author 
     * @return ComplianceList with all data.
     */ 


    public function index()
    {
        $userID = Auth::user()->empUserID;
        $data['casefile'] = DB::table('case_filing_view')
                            ->where('empUserId','=',$userID)
                            ->where('case_filing_status','=', NULL)
                            ->where('case_filing_user_status','=', 0)
                            ->orderBy('created_at', 'DESC')
                            ->get();
                            
        $data['mobilecaselist'] = DB::table('blast_applications')
                                ->where('application_status','=','RECEIVED')
                                ->orderBy('applicantTrackingNo', 'DESC')
                                ->get();

        $data['access_permission'] = DB::table('access_permission_view')
                                ->where('empUserId','=',$userID)
                                ->get();

        $userID = Auth::user()->empUserID;
        
        $data['count'] = send_mail::where('notification',0)->where('empUserID',$userID)->count();

        return View('caseFiling.ComplianceList')->with($data);
    }
    
    /**
     * select data from blast_applications  (for show case details)
       ComplianceSupportingDoc              (after filing if admin upload any attachment)
       case_supporting                      (for show case related details)
       CaseFilingStep                       (for previous current & next step for this case)
       ComplianceStep                       (Compliance Step is list of step)
       tbl_predefine_comments               (any comments against this case)
     * 
     * @author 
     */ 



    public function CaseFilingStart($caseid)
    {
        $data['userID'] = Auth::user()->empUserID;
        //dd($data['userID']);
        $data['casedetails'] = DB::table('blast_applications')->where('applicantTrackingNo','=',$caseid)->get();
        $data['casemaindocument'] = ComplianceSupportingDoc::where('tracking_no','=',$caseid)->get();
        $data['casedocument'] = DB::table('case_supporting')->where('applicantTrackingNo','=',$caseid)->get();
        $data['casefilestep'] = CaseFilingStep::where('caseId','=',$caseid)->get();
        $data['compliancestep'] = ComplianceStep::orderBy('stepSL', 'asc')->get();
        $data['comment'] = DB::table('tbl_predefine_comments')->get();
        $data['user'] = User::get();
        $userID = Auth::user()->empUserID;
        $data['count'] = send_mail::where('notification',0)->where('empUserID',$userID)->count();


        send_mail::where('tracking_number',$caseid)
                ->update(['notification' => 1]);


        return View('caseFiling.caseDetails')->with($data);

    }



    public function CaseUserFilingStart($caseid)
    {
        $userID = Auth::user()->empUserID;
        DB::table('casefiling_user_assigns')
                ->where('tracking_no',$caseid)
                ->where('empUserId',$userID)
                ->update(['visual_status' => 1]);


        $data['ddlists'] = DB::table('compliance_stepusers')->where('stepId','=','180712055108')->get();
        $data['adlists'] = DB::table('compliance_stepusers')->where('stepId','=','180712055152')->get();

        $data['casedetails'] = DB::table('blast_applications')->where('applicantTrackingNo','=',$caseid)->get();
        $data['casedocument'] = DB::table('case_supporting')->where('applicantTrackingNo','=',$caseid)->get();
        $data['casefilestep'] = CaseFilingStep::where('tracking_no','=',$caseid)->get();
        $data['casefilecomments'] = CasefilingUserComment::where('tracking_no','=',$caseid)->get();
        $data['casemaindocument'] = ComplianceSupportingDoc::where('tracking_no','=',$caseid)->get();

        $data['compliancestep'] = ComplianceStep::orderBy('stepSL', 'asc')->get();
        $data['user'] = User::get();

        $validCaseCheck = DB::table('casefiling_user_assigns')
                        ->where('tracking_no','=',$caseid)
                        ->where('empUserId','=',$userID)
                        ->where('status','=',0)
                        ->where('step_order','=',0)
                        ->get();

        if(count($validCaseCheck) > 0 ){
            DB::table('casefiling_user_assigns')
                    ->where('tracking_no',$caseid)
                    ->where('empUserId',$userID)
                    ->update(['status' => 0]);
                    
            return View('caseFiling.casefileDetails')->with($data);
        }else{
            return View('caseFiling.caseDetailsNotAccess')->with('message', 'This case is already filed from your group!');
        }   
    }


    /**
     * insert data in CaseFilingSteps for start case. (all data came from hidden field)
     * upload file in casefiling_user_comments_doc tabel
     * insert casefiling_user_comments for any comment added against this case
     * atlast update time & application_status in blast_applications table for sink 
       mobile apps
     * @author 
     */ 


    public function SaveFiling(Request $request)
    {
        $userID = Auth::user()->empUserID;
        $data = new CaseFilingStep();

        $data->caseId   = $request['caseID'];
        $data->tracking_no = $request['tracking_no'];
        $data->firststepId = $request['firstStepID'];
        $data->laststepId = $request['lastStepID'];
        $data->stepId = json_encode($request['stepID']);
        $data->nextstepId = $request['firstStepID'];
        $data->currentstepId = $request['firstStepID'];
        $userAssign = $request['userAssign'];
        $data->created_by = $userID;
        $observation = $request['observation'];
        $file = $request['supportingDoc'];

        if(!empty($file))
        {
            $doc  = [];
            foreach($file as $files){
                $filename = $files->getClientOriginalName();
                $orginal_name = pathinfo($filename, PATHINFO_FILENAME);
                $imageName = md5(time().$orginal_name).'.'.$files->getClientOriginalExtension();
                $files->move(public_path('ComplianceDoc'), $imageName);
                $doc[] = [
                    'caseId' => $request['caseID'],
                    'tracking_no' => $request['tracking_no'],
                    'empUserId' => $userID,
                    'supporting_doc' => $imageName,
                    'doc_orginal_name' => $filename
                ];
            }
        $db = DB::table('casefiling_user_comments_doc')->insert($doc);
        
        }else{}

        DB::table('casefiling_user_comments')->insert([
             'caseId' => $request['caseID'],
             'tracking_no' => $request['tracking_no'],
             'empUserId' => $userID,
             'comments' => $observation
        ]);

        //dd($userAssign);
        if(!empty($userAssign))
        {
            $userData = [];
            foreach ($userAssign as $key => $value) {
                $userData[] = [
                    'caseId' => $request['caseID'],
                    'tracking_no' => $request['tracking_no'],
                    'empUserId' => $userAssign[$key],
                    'stepId' => $request['firstStepID'],
                    'assign_by' => $userID
                ];
            }
            // mail send & database insert for case assign
            
            foreach($userData as $userDatas){
                $email = mail_get($userDatas['empUserId']);
                $mail = new send_mail;
                $mail->mail_to = $email;
                $mail->message_content = "Case Filing Started :".$userDatas['tracking_no'];
                $mail->tracking_number = $userDatas['tracking_no'];
                $mail->mail_from = mail_get($userID);
                $mail->empUserID = $userDatas['empUserId'];
                $mail->mail_status = 0;
                $mail->notification = 0;
                $mail->save();
            }
            //dd($userData);
            DB::table('casefiling_user_assigns')->insert($userData);
        }else{}

        $data->save();
        DB::table('blast_applications')->where('case_id',$request['caseID'])->update(['application_status'=> 'Case Filing On Progress.','updated_at'=>date('Y-m-d H:i:s')]);

        
        $casestatus = "Case filing start successfully";
        $push = HomeController::push_notification($casestatus,$request['caseID']);
        
        return redirect('/FilingCaseList')->with('message', 'Case is started successfully. Please start the filing process.');
    }

    public function SaveUserFiling(Request $request)
    {
        //dd($request->all());
        //dd($request->all());
        $checkStatus = DB::table('casefiling_user_assigns')
                                ->where('empUserId','=',Auth::user()->empUserID)
                                ->where('inactive',1)
                                ->where('tracking_no',$request['tracking_no'])
                                ->get();

        //dd($checkStatus->isEmpty());
        if($checkStatus->isEmpty() == false){
            return View('caseFiling.caseDetailsNotAccess')->with('message', 'This case is already filed from your group!');
        }

        $userID = Auth::user()->empUserID;
        
        $data = new CaseFilingStep();
        $tracking_no = $request['tracking_no'];
        $caseId = $request['caseID'];
        $stepId = $request['stepID'];
        $CurrentstepID = $request['CurrentstepID'];
        $userAssign = $request['userAssign'];
        $created_by = $userID;

        $observation = $request['observation'];
        $file = $request['supportingDoc'];
        if(!empty($file))
        {
            $doc  = [];
            foreach($file as $files){
                $filename = $files->getClientOriginalName();
                $orginal_name = pathinfo($filename, PATHINFO_FILENAME);
                $imageName = md5(time().$orginal_name).'.'.$files->getClientOriginalExtension();
                $files->move(public_path('ComplianceDoc'), $imageName);
                $doc[] = [
                    'caseId' => $caseId,
                    'tracking_no' => $request['tracking_no'],
                    'empUserId' => $userID,
                    'supporting_doc' => $imageName,
                    'doc_orginal_name' => $filename
                ];
            }
        DB::table('casefiling_user_comments_doc')->insert($doc);
        }else{}

        DB::table('casefiling_user_comments')->insert([
                     'caseId' => $caseId,
                     'tracking_no' => $request['tracking_no'],
                     'empUserId' => $userID,
                     'comments' => $observation
                    ]);

        $process = $request['process'];
        
        // full case step to back step process here. (file send to previous user, down to up)

        if($process == 1){
            

            $userData = [];
            foreach ($userAssign as $key => $value) {
                $userData[] = [
                    'caseId' => $caseId,
                    'tracking_no' => $tracking_no,
                    'empUserId' => $userAssign[$key],
                    'stepId' => $stepId,
                    'assign_by' => $userID
                ];
            }

            
            foreach($userData as $userDatas){
                $email = mail_get($userDatas['empUserId']);
                $mail = new send_mail;
                $mail->mail_to = $email;
                $mail->tracking_number = $userDatas['tracking_no'];
                $mail->mail_from = mail_get($userID);
                $mail->empUserID = $userDatas['empUserId'];
                $mail->mail_status = 0;
                $mail->notification = 0;
                $mail->save();
            }

            
            DB::table('casefiling_user_assigns')->insert($userData);
            DB::table('casefiling_steps')->where('caseId',$caseId)->update(['currentstepId'=> $stepId]);
            DB::table('casefiling_user_assigns')->where('caseId',$caseId)->where('empUserId',$userID)->where('stepId',$CurrentstepID)->update(['status'=> 1]);


        }

        // complete will hit here

        if($process == 2)
        {
            // after complete case set notifications
            $casestatus = "Case Inquery Complete";
            $push = HomeController::push_notification($casestatus,$request['caseID']);

            $ComplianceStep         = ComplianceStep::where('stepSL',1)->first();
            $directorId             = $ComplianceStep->stepId;
            $compliance_stepuser    = ComplianceStepUser::where('stepID',$directorId)->get();
            $count                  = count($compliance_stepuser);

            foreach ($compliance_stepuser as $compliance_stepusers) {
                $committe_notification              = new committe_notification;
                $committe_notification->tracking_no  = $request['tracking_no'];
                $committe_notification->empUserID    = $compliance_stepusers->empUserId;
                $committe_notification->visual_status= 0;
                $committe_notification->save();
            }
            
            DB::table('casefiling_steps')->where('caseId',$caseId)->update(['status'=> $stepId]);
            DB::table('casefiling_user_assigns')->where('caseId',$caseId)->where('empUserId',$userID)->update(['status'=> 1,'inquiry_assign1'=>$request->assign_ad,'inquiry_assign2'=>$request->assign_dd]);

            DB::table('casefiling_user_assigns')->where('caseId',$caseId)->update(['step_order'=> 1]);
            DB::table('blast_applications')->where('case_id',$caseId)->update(['application_status'=> 'Case Filing done.','updated_at'=>date('Y-m-d H:i:s')]);

            

        }

        // full case step to next step process here. (file send to next user, up to down)

        if($process == 3)
        {
            //dd("3");


            $casestatus = "Case filing done";
            $push = HomeController::push_notification($casestatus,$caseId);

            if(isset($filename)){
                $orginal_name = pathinfo($filename, PATHINFO_FILENAME);
                $imageName = md5(time().$orginal_name).'.'.$files->getClientOriginalExtension();
                //move_uploaded_file($filename, "CaseFilingDoc/".$imageName);
                $doc[] = [
                    'caseId' => $caseId,
                    'tracking_no' => $request['tracking_no'],
                    'empUserId' => $userID,
                    'supporting_doc' => $imageName,
                    'doc_orginal_name' => $filename
                ];
                //DB::table('casefiling_user_comments_doc')->insert($doc);
            }

            $userData = [];
            foreach ($userAssign as $key => $value) {
                $userData[] = [
                    'caseId' => $caseId,
                    'tracking_no' => $tracking_no,
                    'empUserId' => $userAssign[$key],
                    'stepId' => $stepId,
                    'assign_by' => $userID
                ];
            }
            
            foreach($userData as $userDatas){
                $email = mail_get($userDatas['empUserId']);
                $mail = new send_mail;
                $mail->mail_to = $email;
                $mail->tracking_number = $userDatas['tracking_no'];
                $mail->mail_from = mail_get($userID);
                $mail->empUserID = $userDatas['empUserId'];
                $mail->mail_status = 0;
                $mail->notification = 0;
                $mail->save();
            }
            
            DB::table('casefiling_user_assigns')->insert($userData);
            DB::table('casefiling_steps')->where('caseId',$caseId)->update(['nextstepId'=> $stepId ,'currentstepId'=> $stepId]);
            DB::table('casefiling_user_assigns')->where('caseId',$caseId)->where('empUserId',$userID)->where('stepId',$CurrentstepID)->update(['status'=> 1]);


        }


        return redirect('/AllCompliance')->with('message', 'Case filing start successfully.');
    }

    public function FilingCase()
    {
        $userID = Auth::user()->empUserID;
        $data['casefile'] = DB::table('casefiling_steps as db1step')
                            ->join('casefiling_user_assigns as db1filing','db1step.currentstepId','=','db1filing.stepId')
                            ->join('blast_applications as db2com','db2com.case_id','=','db1step.caseId')
                            ->where('db1filing.empUserId','=',$userID)
                            ->where('db1step.status','=', NULL)
                            ->get();
        $data['access_permission'] = DB::table('access_permission_view')
                                ->where('empUserId','=',$userID)
                                ->get();
        return VIew('caseFiling.ComplianceFilingList')->with($data);
    }

}
