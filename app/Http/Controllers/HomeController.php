<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\User;
use App\TodoList;
use App\UserModulPermission;
use App\MenuPermission;
use App\Announcement;
use App\AppUser;
use App\AnnouncementCategory;
use App\ComplianceUserCommentsDoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\BlastApplication;
use Carbon\Carbon;
use Charts;
use App\send_mail;
use Session;
use App\ComplianceStepUser;
use App\ComplianceStep;
use App\casefiling_user_assign;
use View;
use App\Http\Controllers\Compliance\firebase\firebase;
use App\Http\Controllers\Compliance\firebase\push;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public static function push_notification($casestatus,$caseID){


         /******* Push Notification ******/

        //require_once __DIR__ . '/firebase/firebase.php';
        //require_once __DIR__ . '/firebase/push.php';

        $firebase = new Firebase();
        $push = new Push();

        // notification title
        $title = "Application status change";

        // notification message
        $message = "Your current status:".$casestatus;

        // action 
        $action = "ApplicationActivity";

 
        
        $push->setTitle($title);
        $push->setMessage($message);
           
        $push->setIsBackground(FALSE);
        $push->setAction($action);
            


        $json = '';
        $response = '';

        $json = $push->getPush();

        /*$query = "SELECT * FROM blast_ask_questions WHERE ask_question_id = ".$ask_question_id;*/

        //$result = $this->general_model->get_all_table_info_by_id('blast_ask_questions', 'ask_question_id', $ask_question_id);

        $device_token = DeviceToken($caseID);

        

        if(isset($device_token))
        {
            $response = $firebase->send($device_token,$json);
            return $response;
        }
    }

    /**

    --- casewise :  step order : 0 (case assign) 1 (case complete)
    --- userwise :  case filing user status : 0 (case assign) 1 (case complete)
    --- 
     * blast_applications table systemtodayTotalCase Today's Receive Case
     * blast_applications systemTotalCase is table Total Receive Case
     * mytodayTotalCase mytodayTotalCase is current admin cases, search by
     where('empUserId','=',$userID)
     * Today's Receive Case is mytodayTotalCase user wise
     * Total Receive cases myTotalCase
     * runningCase is blast_applications ongoing & submit cases.
    !=2 means not completed.
     * case_ongoing_inquery_user_view for inquery list. 
     * newcasefile is for list of new cases.
       case_filing_status null means filing is not started
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userID = Auth::user()->empUserID;
        $statusCheck = DB::table('app_users')
                            ->where('empUserID','=',$userID)
                            ->where('status',1)
                            ->select('status')
                            ->get();

        if($statusCheck->isEmpty() == true){
            Session::flush(); 
            Session::flash('message', 'You are currently inactive in this system'); 
            return redirect('/');
        }

        $new = DB::table('blast_applications')
                ->where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
                ->where("created_at",">", Carbon::now()->subMonths(6))
                ->where('application_status','=','RECEIVED')
                ->get();

        $prog = DB::table('blast_applications')
                ->where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
                ->where("created_at",">", Carbon::now()->subMonths(6))
                ->where('application_status','=','Case Filing On Progress.')
                ->orWhere('application_status','=','Case Filing done.')
                ->get();

        $inq = DB::table('blast_applications')
                ->where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
                ->where("created_at",">", Carbon::now()->subMonths(6))
                ->where('application_status','=','Case Inquery On Progress.')
                ->orWhere('application_status','=','Case Send for Inquery.')
                ->get();


        $com = DB::table('blast_applications')
                ->where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
                ->where("created_at",">", Carbon::now()->subMonths(6))
                ->where('application_status','=','Case Inquery Complete.')
                ->get();


        $incom = DB::table('blast_applications')
                ->where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
                ->where("created_at",">", Carbon::now()->subMonths(6))
                ->where('application_status','=','Case Inquiry Incomplete.')
                ->get();
        

        $data['chart'] = Charts::multiDatabase('bar', 'highcharts') 

            ->title("<b>Monthly Statistics</b>") 
            ->colors(['#6b5656', '#00097c','rgb(236, 151, 31)','rgb(68, 157, 68)', '#ff0000'])
            ->dimensions(1000, 500) 
            ->responsive(true)
            ->dataset('New Case', $new)
            ->dataset('Filing', $prog)
            ->dataset('Inquiry', $inq)
            ->dataset('Complete', $com)
            ->dataset('Incomplete', $incom)
            ->groupByMonth(date('Y'), true);

            
        $currentDate = date('Y-m-d');

        

        $data['static_permission'] = DB::table('menu_permissions')
                                ->where('empuserid','=',$userID)
                                ->get();

        $data['received'] = DB::table('blast_applications')
                                ->where('application_status','=','RECEIVED')
                                ->count();

        $data['progress'] = DB::table('blast_applications')
                                ->where('application_status','=','Case Filing On Progress.')
                                ->orWhere('application_status','=','Case Filing done.')
                                ->count();
                               

        $data['inquery'] = DB::table('blast_applications')
                                ->where('application_status','=','Case Inquery On Progress.')
                                ->orWhere('application_status','=','Case Send for Inquery.')
                                ->count();
  
        $data['complete'] = DB::table('blast_applications')
                                ->where('application_status','=','Case Inquery Complete.')
                                ->count();

        $data['incomplete'] = DB::table('blast_applications')
                                ->where('application_status','=','Case Inquiry Incomplete.')
                                ->count();


        //dd($data['static_permission']);
        /*                        
        $data['systemtodayTotalCase'] = DB::table('blast_applications')
                                        ->whereDate('created_at', DB::raw('CURDATE()'))->count();
        $data['systemTotalCase'] = DB::table('blast_applications')->count();

        $data['mytodayTotalCase'] = DB::table('casefiling_user_assigns')
                                ->where('empUserId','=',$userID)
                                ->whereDate('created_at', DB::raw('CURDATE()'))
                                ->count();
        $data['myTotalCase'] = DB::table('casefiling_user_assigns')
                                ->where('empUserId','=',$userID)
                                ->count();
        */
        $data['runningCase'] = DB::table('blast_applications')
                            ->where('casestatus','!=',2)
                            ->where('application_status','!=','RECEIVED')
                            ->orderBy('applicantTrackingNo','DESC')
                            ->take(15)
                            ->get();
        $data['runningCaseuser'] = DB::table('case_ongoing_filing_user_view')
                            ->where('empUserId','=',$userID)
                            ->where('casestatus','!=',2)
                            ->groupBy('case_id')
                            ->orderBy('applicantTrackingNo','DESC')
                            ->take(10)
                            ->get();

        $data['runningInqueryCaseuser'] = DB::table('case_ongoing_inquery_user_view')
                            ->where('empUserId','=',$userID)
                            ->where('casestatus','!=',2)
                            ->groupBy('case_id')
                            ->orderBy('application_id','DESC')
                            ->take(15)
                            ->get();

        $data['newcasefile'] = DB::table('case_filing_view')
                            ->where('empUserId','=',$userID)
                            ->where('case_filing_status','=', NULL)
                            ->where('case_filing_user_status','=', 0)
                            ->orderBy('application_id', 'DESC')
                            ->take(15)
                            ->get();

        $data['admincaselist'] = DB::table('blast_applications')
                                ->where('application_status','=','RECEIVED')
                                ->orderBy('application_id', 'DESC')
                                ->take(10)
                                ->get();

        $data['case_complete'] = DB::table('blast_applications')
                                ->where('application_status','=','Case Inquery Complete.')
                                ->orderBy('application_id', 'DESC')
                                ->take(10)
                                ->get();                       

        $data['case_incomplete'] = DB::table('blast_applications')
                                ->where('application_status','=','Case Inquery Incomplete.')
                                ->orderBy('application_id', 'DESC')
                                ->take(10)
                                ->get();  

        $data['completecaseadminlist'] = DB::table('case_inquery_view')
                                ->where('casestatus','=',2)
                                ->groupBy('case_id')
                                ->orderBy('application_id', 'DESC')
                                ->take(15)
                                ->get();

        $data['completecasealllist'] = DB::table('case_inquery_view')
                            ->where('empUserId','=',$userID)
                            ->where('casestatus','=', 2)
                            ->where('step_order','=', 1)
                            ->orderBy('application_id', 'DESC')
                            ->take(15)
                            ->get();

        $data['caseadminlist'] = DB::table('case_filing_view')
                                ->where('casestatus','=',1)
                                ->groupBy('caseId')
                                ->orderBy('application_id', 'DESC')
                                ->take(15)
                                ->get();
                                
        $data['caselist'] = DB::table('case_inquery_view')
                            ->where('empUserId','=',$userID)
                            ->where('status','=', 0)
                            ->where('step_order','=', 0)
                            ->orderBy('application_id', 'DESC')
                            ->take(15)
                            ->get();

        $data['todolist'] = TodoList::where('empUserID','=',$userID)
                            ->orderBy('taskDate', 'desc')
                            ->take(5)
                            ->get();
                        

        $userID = Auth::user()->empUserID;

        $data['announcement'] = Announcement::where('closingDate','>=', $currentDate)
                                            ->where('empUserId',$userID)
                                            ->orwhere('created_by',$userID)
                                            ->orwhere('announceCategory',"public")
                                            ->take(5)
                                            ->get();

        $data['access_permission'] = DB::table('access_permission_view')
                                ->where('empUserId','=',$userID)
                                ->get();



        $data['caseadminlist'] = DB::table('case_filing_view')
                                ->where('casestatus','=',0)
                                ->where('application_status','!=','Case Send for Inquery.')
                                ->where('application_status','!=','Case Inquery On Progress.')
                                ->groupBy('applicantTrackingNo')
                                ->orderBy('applicantTrackingNo', 'DESC')
                                ->get();
        //$data['count'] = 
        //send_mail::where('notification',0)->where('empUserID',$userID)->get();
        //dd($data);

        return view('home')->with($data);
    }

    public function MobileAdmin(){
        return redirect('http://stage-ilo.dnet.org.bd/account/sign_in');
    }

    public static function saveButtonHide($currentstepId,$tracking_no){

        $userID = Auth::user()->empUserID;

        $group_id = ComplianceStepUser::where('empUserId',$userID)->select('stepId')->first();
        //dd($group_id);
        $casefiling_user_assign =   casefiling_user_assign::where('tracking_no',$tracking_no)
                                                        ->where('stepId',$group_id->stepId)
                                                        ->where('status','1')
                                                        ->get();
        
        if(count($casefiling_user_assign) == 1){
            return "ok";
        }else{
            return "notok";
        }

    }

    public static function getGroupNameToSL($group_name){

        $sl = ComplianceStep::where('stepName','=',$group_name)->select('stepSL')
                                                               ->orderBy('stepSL', 'desc')
                                                               ->first();
        return $sl;

    }


    public static function NegetiveNotification($userId,$trackingId){

        
        $negetive_status =    DB::table('casefiling_user_assigns')
                              ->where('empUserId',$userId)
                              ->where('tracking_no',$trackingId)
                              ->where('visual_status',0)
                              ->first();
        

        return $negetive_status;
       

    }

     public static function FilednotificationUnset($userId){

        $unset_status =    DB::table('casefiling_user_assigns')
                              ->where('empUserId',$userId)
                              ->where('visual_status',0)
                              ->count();
    

        return $unset_status;
    }



    public static function notificationCount($empUserID){
        $userID = Auth::user()->empUserID;
        $data = send_mail::where('notification',0)->where('empUserID',$userID)->first();

        return $data;
    }


   


    public function SaveTodo(Request $request)
    {
        //dd($request->all());
        $userID = Auth::user()->empUserID;
        $todoList = new TodoList();
        $todoList->empUserID = $userID;
        $todoList->task = $request['title'];
        $todoList->taskDate = $request['taskDate']; 
        $todoList->priority = $request['priority'];
        $todoList->status = "Undone";

        $todoList->save();
        return redirect('/todo_view')->with('message', 'Task created successfully');
    }

    public function DoneTodo($id, Request $request)
    {
        $todo = TodoList::find($id);
        $todo->status = "Done";
        $todo->save();
        return redirect()->back();
    }

    public function UnDoneTodo($id, Request $request)
    {
        $todo = TodoList::find($id);
        $todo->status = "Undone";
        $todo->save();
        return redirect()->back();
    }

    public function TodoView(){
        $userID = Auth::user()->empUserID;
        $data['todolist'] = TodoList::where('empUserID','=',$userID)
                            ->orderBy('taskDate', 'desc')
                            ->paginate(5);
        return view('announcement/todo_view')->with($data);
    }

    public static function getName($id)
    {
        $fullName = AppUser::where('empUserId','=',$id)->select('*')->first();
        return $fullName;
    }
    
    public static function getId($name)
    {
        $fullName = AppUser::where('userName','=',$name)->select('empUserId')->first();
        return $fullName;
    }


    public static function getPersonAnnouncement($announceID)
    {
        $userID = Auth::user()->empUserID;
        $announcementcategory = AnnouncementCategory::where('personId','=',$userID)
                                ->where('created_by','=',$userID)
                                ->where('announceId','=', $announceID)->count();
        return $announcementcategory;
    }

    public static function getCommentsDoc($caseID,$user_id)
    {
        $commentsdoc = ComplianceUserCommentsDoc::where('caseId','=',$caseID)
                                ->where('empUserId','=',$user_id)
                                ->get();
        return $commentsdoc;
    }


    
    public static function getStepUserInfo($stepID)
    {
               
        $userInfo = DB::table('compliance_stepusers')
                    ->join('app_users','compliance_stepusers.empUserId','=','app_users.empUserId')
                    ->where('compliance_stepusers.stepId','=',$stepID)
                    ->get();
        //dd($userInfo);
        
        //dd($userInfo);
        return $userInfo;
    }

    public static function getCaseFileInfo($caseID)
    {
        $caseInfo = DB::table('casefiling_steps')
                    ->where('caseId','=',$caseID)
                    ->get();
        return $caseInfo;
    }

    public static function getCaseFileUserSTep($stepID,$empUserId)
    {
        $caseStepUserInfo = DB::table('compliance_stepusers')
                    ->where('stepId','=',$stepID)
                    ->where('empUserId','=',$empUserId)
                    ->count();
        return $caseStepUserInfo;
    }

    public static function getIdToGroup($empUserId)
    {
        $getIdToGroup = DB::table('compliance_stepusers')
                    ->where('empUserId','=',$empUserId)
                    ->select('stepId')
                    ->first();
        return $getIdToGroup;
    }

    public static function getGroupIdToGroupName($stepId)
    {
        $getIdToGroup = DB::table('compliance_steps')
                            ->where('stepId','=',$stepId)
                            ->select('stepName')
                            ->first();
        return $getIdToGroup;
    }


    public static function getGroupPermission($groupID,$permissionId)
    {
        $permissionIdInfo = DB::table('group_roles')
                    ->where('group_id','=',$groupID)
                    ->where('permission_id','=',$permissionId)
                    ->count();
        return $permissionIdInfo;
    }

    public static function getGroupPermissionList($groupID)
    {
        $permissionIdInfo = DB::table('group_roles')
                    ->join('app_roles', 'group_roles.permission_id', '=', 'app_roles.permission_id')
                    ->where('group_roles.group_id','=',$groupID)
                    ->get();
        return $permissionIdInfo;
    }

    public static function getGroupList()
    {
        $groupID = Input::get('group_id');
        $permissionIdInfo = DB::table('group_roles')
                    ->join('app_roles', 'group_roles.permission_id', '=', 'app_roles.permission_id')
                    ->where('group_roles.group_id','=',$groupID)
                    ->get();
                    
        return $permissionIdInfo;
    }

    public static function getRolePermission($userID,$groupID)
    {
        $userRoleInfo = DB::table('user_group_permissions')
                    ->where('groupId','=',$groupID)
                    ->where('empUserId','=',$userID)
                    ->count();

        return $userRoleInfo;
    }

    public static function getPendingCaseInfo($empUserId)
    {
        $pendingCaseInfo = DB::table('casefiling_user_assigns')
                    ->where('empUserId','=',$empUserId)
                    ->where('status','=', 0)
                    ->where('step_order','=', 0)
                    ->count();
        return $pendingCaseInfo;
    }

    public static function inactiveUserCheck($empUserId,$tracking_no)
    {
        $inactiveCaseInfo = DB::table('casefiling_user_assigns')
                    ->where('inactive','=',1)
                    ->where('tracking_no','=', $tracking_no)
                    ->where('empUserId','=',$empUserId)
                    ->get();

        return $inactiveCaseInfo;
    }

    public static function inactiveFullSystem($empUserId)
    {
        $inactiveFullSystem = DB::table('app_users')
                                ->where('status','=',0)
                                ->where('empUserId','=',$empUserId)
                                ->get();

        return $inactiveFullSystem;
    }


    public static function getProblemDetails($caseId)
    {
        $pendingCaseInfo = DB::table('compliance_lists')
                    ->where('caseId','=',$caseId)
                    ->get();
        return $pendingCaseInfo;
    }

    public static function getGroupName($userID)
    {
        $groupname = DB::table('menu_permissions')
                    ->join('groups','menu_permissions.groupid','=','groups.group_id')
                    ->where('menu_permissions.empuserid','=',$userID)
                    ->first();
        return $groupname;
    }

    

    public static function getGroupPermissionName($userID)
    {
        $grouppermissionname = DB::table('menu_permissions')
                                    ->join('app_roles','menu_permissions.permissionid','=','app_roles.permission_id')
                                    ->where('menu_permissions.empuserid','=',$userID)
                                    ->where('app_roles.menu_show','=',0)
                                    ->orderBy('app_roles.modul_id','ASC')
                                    ->get();
                                    
        return $grouppermissionname;
    }

    public static function getMenuPermissionName($userID,$permissionID)
    {
        $MenuPermissionname = DB::table('menu_permissions')
                    ->where('empuserid','=',$userID)
                    ->where('permissionid','=',$permissionID)
                    ->get();
        return $MenuPermissionname;
    }

    public static function getIdToName($userID)
    {

        $name = DB::table('users')
                    ->where('empUserId','=',$userID)
                    ->select('name','empUserId')
                    ->first();
        return $name;
    }

    public static function getIdToFullName($userID)
    {
        $name = DB::table('users')
                    ->where('empUserId','=',$userID)
                    ->select('FullName','empUserId')
                    ->first();
        return $name;

    }

    public static function getIdToFullNameAppUser($userID)
    {
        $name = DB::table('app_users')
                    ->where('FullName','=',$userID)
                    ->select('FullName','empUserId')
                    ->first();
        return $name->empUserId;

    }

    public static function getIdToNameAppUser($userID)
    {
        $name = DB::table('app_users')
                    ->where('empUserId','=',$userID)
                    ->select('fullName','empUserId')
                    ->first();
        return $name;

    }
    
    public static function stepIdToName($stepID)
    {
        $stepname = DB::table('compliance_steps')
                    ->select('stepName')
                    ->where('stepId','=',$stepID)
                    ->first();
        return $stepname;

    }

    public static function ComplainTypeList($agency_name){
        $application_type = DB::table('blast_applications')
                                ->select('application_type','applicantTrackingNo','application_status')
                                ->where('agency_name','=',$agency_name)
                                ->get();
        return json_decode($application_type);
    } 


    public static function getCommitteeLetter($tracking_no)
    {
        $committee = DB::table('blast_committee_letters')->where('tracking_no','=',$tracking_no)->get();
        return $committee;
    }

    public function profile()
    {
       $userID = Auth::user()->empUserID;
       $data['user'] = AppUser::where('empUserId','=',$userID)->first();

       return View('user.profile')->with($data); 
    
   }
    public function editView(){
       $userID = Auth::user()->empUserID;
       $data['user'] = AppUser::where('empUserId','=',$userID)->first();
       return View('user.edit_view')->with($data);    
    }
    

    public function UserUpdateByAdmin(Request $request){
        //dd($request->all());
        $edit_user_id = $request->empUserId;
        $id = $request->id;
        $userID = $request->empID;
        $filingassignCheck = DB::table('casefiling_user_assigns')
                                ->where('empUserId', $edit_user_id)
                                ->select('tracking_no')
                                ->get();

        $committeeassignCheck = DB::table('committe_notifications')
                                ->where('empUserId', $edit_user_id)
                                ->select('tracking_no')
                                ->get();

        $assign_user_tracking_list = [];
        foreach ($filingassignCheck as $filingassignChecks) {
            $assign_user_tracking_list[] = $filingassignChecks->tracking_no;
        }

        $committe_user_tracking_list = [];
        foreach ($committeeassignCheck as $committeeassignChecks) {
            $committe_user_tracking_list[] = $committeeassignChecks->tracking_no;
        }
        
        $groupId = DB::table('compliance_stepusers')
                            ->where('empUserId', $edit_user_id)
                            ->select('stepId')
                            ->first();
        
        if(isset($groupId->stepId)){ 
            $totalMember = DB::table('compliance_stepusers')
                                ->where('stepId',$groupId->stepId)
                                ->select('stepId')
                                ->count();
            if($totalMember < 2){
                Session::flash('message', 'Please assign at least one more member before you inactive'); 
                return redirect('/userView');
            }
        }
        $list = array_merge($assign_user_tracking_list,$committe_user_tracking_list);

        if(isset($list) && count($list) != 0){
            $item = [];
            for ($i=0; $i < count($list)-1; $i++) { 

            $item[] = DB::table('blast_applications')
                        ->select('applicantTrackingNo','application_status')
                        ->Where('applicantTrackingNo', $list[$i])
                        ->Where('application_status','Case Filing done.')
                        ->OrWhere('application_status','Case Filing On Progress.')
                        ->OrWhere('application_status','Case Send for Inquery.')
                        ->OrWhere('application_status','Case Inquery On Progress.')
                        ->first();
            }
        }
        
        if(isset($item) && count($item)!= 0){
            for ($i=0; $i <= count($item)-1; $i++) { 
                if($item[$i] != null){
                    $error = 0;
                }else{
                    $error = 1;
                }
            }
        }

        if($request->status == 2 && isset($error) && $error == 0){
            Session::flash('message', 'You can not inactive this user becasuse the user is engaged in other cases'); 
            return redirect('/userView');
        }else{
            $image = time().$_FILES['image']['name'];
        
            $user = AppUser::find($id);

            $user->fullName =$request->full_name;
            $user->gender = $request->gender;
            $user->DOB =$request->dob;
            $user->streetAddress = $request->street;
            $user->state = $request->state;    
            $user->city =$request->city;
            $user->postalCode = $request->postcode;
            $user->cellphone =$request->cellphone;
            $user->telePhone = $request->telephone;
            $user->contactNumber =$request->contactnumber;
            $user->alternatePhone = $request->alternatephone;
            $user->email =$request->email;
            $user->employeeId =$request->empID;
            $user->department =$request->department;
            $user->designation =$request->designation;
            $user->employeeTerm =$request->empterm;
            $user->status =$request->status;
                  

            if ($request->hasFile('image')) {
                $user->userImg = $image;
                AppUser::where('empUserID',$id)->update(array(
                    'userImg'=>$image,
                ));
                move_uploaded_file($_FILES['image']['tmp_name'], "images/" .$image);
            }
            $user->save();

            if($request['group_id'] != ""){
                DB::table('menu_permissions')->where('empuserid', $edit_user_id)->delete();

                $perm = $request['group_id'];
                $perm_data = $request['premision'];
                $appUser = new AppUser();

                if(count($perm_data) > 0)
                {
                foreach($perm_data as $per_ID) 
                    {
                        $data[] = [
                            'empuserid' => $edit_user_id,
                            'groupid' => $perm,
                            'permissionid' => $per_ID
                        ];
                    }

                   DB::table('menu_permissions')->insert($data);
                   
                   
                }

                
                
                if ($request->hasFile('image')) {
                    $image = time().$_FILES['image']['name'];
                    move_uploaded_file($_FILES['image']['tmp_name'], "images/" .$image);
                }
            }

           return redirect('/userView')->with('message', 'User updated successfully');
        }


        
        

    }

    public function predefinecomment()
    {
        $data['comment'] = DB::table('tbl_predefine_comments')->get();
        return View('predefine_comment')->with($data);
    }

    public function SaveComment(Request $request)
    {
        $userID = Auth::user()->empUserID;
        $comment = $request['title'];
        DB::table('tbl_predefine_comments')->insert(['comment' => $comment]);

        return redirect('/PredefineComment')->with('message', 'Inserted successfully');
    }

    public function editcomment($id)
    {
        $data['comment'] = DB::table('tbl_predefine_comments')->get();
        $data['editcomment'] = DB::table('tbl_predefine_comments')->where('id','=',$id)->first();
        return View('predefine_comment_edit')->with($data);
    }

    public function updatecomment()
    {
        $id = Input::get('id');
        $comment = Input::get('comment');

        DB::table('tbl_predefine_comments')
            ->where('id', $id)
            ->update(['comment' => $comment]);

        return redirect('/PredefineComment')->with('message', 'Inserted successfully');
    }

    public function destroy($id)
    {
        DB::table('tbl_predefine_comments')->where('id','=',$id)->delete();
        return redirect('/PredefineComment')->with('message', 'Deleted successfully');
    }
    public function queryString(Request $request){
        
        $preview_data = $request->all();
        $positionEditView    = View::make('preview', compact('preview_data'));
        $render = $positionEditView->render();

        $feedback = [
           'status'     => "success",
           'message'    => "data found",
           'data'       =>  $render
        ]; 

        return $feedback;
    }

}
