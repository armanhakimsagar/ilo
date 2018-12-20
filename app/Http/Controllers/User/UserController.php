<?php

namespace App\Http\Controllers\User;

use DB;
use Auth;
use App\User;
use App\Group;
use App\AppUser;
use App\MenuPermission;
use App\UserGroupPermission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\maail;
use App\casefiling_user_assign;
use App\BlastApplication;
use App\casefiling_step;
use App\committe_notification;
use App\hearing_notification;
use App\new_case_notification;
use Session;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
    	$userID = Auth::user()->empUserID;
    	$data['role'] = Group::get();
    	return View('user.user_create')->with($data);
    }

    public function allNotification(){
        $userID = Auth::user()->empUserID;
        $hearing_notification_list = hearing_notification::where('empUserId',$userID)->orderBy('id', 'desc')->get();
        $new_notification_list = new_case_notification::where('empUserId',$userID)->orderBy('id', 'desc')->get();
        $committe_notification_list = committe_notification::where('empUserId',$userID)->orderBy('id', 'desc')->get();


        return view('allNotification',compact('hearing_notification_list','new_notification_list','committe_notification_list'));
    } 

    public function updateNotification($id){
        DB::table('hearing_notifications')
                    ->where('empUserId',$id)
                    ->update(array(
                        'visual_status'=>1,
                    ));

        DB::table('new_case_notifications')
                    ->where('empUserId',$id)
                    ->update(array(
                        'visual_status'=>1,
                    ));
        DB::table('committe_notifications')
                    ->where('empUserId',$id)
                    ->update(array(
                        'visual_status'=>1,
                    ));
        DB::table('casefiling_user_assigns')
                    ->where('empUserId',$id)
                    ->update(array(
                        'visual_status'=>1,
                    ));
    }

    public function sinkNotification(){
        $userID = Auth::user()->empUserID;
        
        $count_file_list = casefiling_user_assign::where('visual_status',0)->where('empUserID',$userID)->get();
        
        $committe_file_list = 
        committe_notification::where('visual_status',0)->where('empUserId',$userID)->get();
        
        
        $hearing_file_list = hearing_notification::where('visual_status',0)
                            ->where('empUserID',$userID)
                            ->get();
        $list = [];

        foreach ($hearing_file_list as $key => $value) {
            $list[] = $value->tracking_no;
        }

        $inqiry_files        = BlastApplication::whereIn('applicantTrackingNo',$list)
                                        ->where('application_status','Case Filing done.')
                                        ->select('applicantTrackingNo')
                                        ->get();

        $hearing_files   = BlastApplication::whereIn('applicantTrackingNo',$list)
                                        ->where('application_status','Case Send for Inquery.')
                                        ->select('applicantTrackingNo')
                                        ->get();

        $inquery_list = [];
        foreach($inqiry_files as $value) {
           $inquery_list[] =  $value->applicantTrackingNo;
        }

        $hear_list = [];
        foreach($hearing_files as $value) {
           $hear_list[] =  $value->applicantTrackingNo;
        }

        $inquery_file_lists = 
        hearing_notification::where('visual_status',0)
                            ->where('empUserId',$userID)
                            ->whereIn('tracking_no',$inquery_list)
                            ->get();

        $hearing_file_lists = 
        hearing_notification::where('visual_status',0)
                            ->where('empUserId',$userID)
                            ->whereIn('tracking_no',$hear_list)
                            ->get();

        $inquery_file_count = count($inquery_file_lists);
        $hearing_file_count = count($hearing_file_lists);

        $count = casefiling_user_assign::where('visual_status',0)->where('empUserId',$userID)->count();

        $newcasecount = new_case_notification::where('visual_status',0)->where('empUserId',$userID)->count();

        $new_file_lists = 
        new_case_notification::where('visual_status',0)
                                    ->where('empUserId',$userID)
                                    ->where('visual_status',0)
                                    ->get();
        
        $committe_count = 
        committe_notification::where('visual_status',0)->where('empUserId',$userID)->count();

        $hearing_count = 
        hearing_notification::where('visual_status',0)->where('empUserId',$userID)->count();

        $array = array('newcasecount'=>$newcasecount,'new_file_lists'=>$new_file_lists,'count' => $count,'committe_count'=>$committe_count,'hearing_count'=>$hearing_count,'count_file_list'=>$count_file_list,'committe_file_list'=> $committe_file_list,'hearing_file_lists'=>$hearing_file_lists,'inquery_file_lists'=>$inquery_file_lists,'inquery_file_count'=>$inquery_file_count,'hearing_file_count'=>$hearing_file_count);
        echo json_encode($array);
    }

    public function CaseSatusView()
    {
        $data['caselist'] = casefiling_step::all();
        return View('case.CaseSatusView')->with($data);
    }

    public function CaseSatusDetails($id){
        $data['casefiling_user_assign'] = casefiling_user_assign::where('tracking_no',$id)->get();
        $data['datas'] = casefiling_user_assign::where('tracking_no',$id)->select('tracking_no','stepId')->first();
        $data['casefiling_user_assign'] = casefiling_user_assign::where('tracking_no',$id)->get();
        $data['id'] = $id;
        return View('case.CaseSatusDetails')->with($data);
    }


    public function SaveUser(Request $request)
    {
        //dd($request->all());
    	$userID = Auth::id();
        $appUser = new AppUser();
        $appUser->empUserId = date('nhis');
        $appUser->userName = $request['name'];
        $appUser->fullName = $request['full_name'];
        $appUser->DOB = $request['dob'];
        $appUser->gender = $request['gender'];
        $appUser->streetAddress = $request['street'];
        $appUser->city = $request['city'];
        $appUser->state = $request['state'];
        $appUser->postalCode = $request['postcode'];
        $appUser->cellphone = $request['cellphone'];
        $appUser->telePhone = $request['telephone'];
        $appUser->contactNumber = $request['contactnumber'];
        $appUser->alternatePhone = $request['alternatephone'];
        $appUser->email = $request['email'];
        $appUser->employeeId = $request['empID'];
        $appUser->department = $request['department'];
        $appUser->designation = $request['designation'];
        $appUser->employeeTerm = $request['empterm'];
        $appUser->password = bcrypt($request['password']);
        $appUser->status = $request['status'];
        $appUser->created_by = $userID;

        
        $validator = Validator::make($request->all(), [
                
                'name'                  => 'required|max:100',
                'full_name'             => 'required|max:100',
                'dob'                   => 'required',
                'gender'                => 'required',
                'street'                => 'max:500',
                'city'                  => 'max:500',
                'state'                 => 'max:500',
                'postcode'              => 'max:10',
                'cellphone'             => 'max:20',
                'telephone'             => 'max:20',
                'contactnumber'         => 'max:20',
                'alternatephone'        => 'max:20',
                'email'                 => 'required|unique:app_users,email|max:100',
                'empID'                 => 'required|max:100',
                'department'            => 'max:100',
                'designation'           => 'max:100',
                'empterm'               => 'max:20',
                'password'              => 'required|max:100',
                'status'                => 'required|max:10'
            
        ]);
        if ($validator->fails()) {
        return redirect('user')
                        ->withErrors($validator)
                        ->withInput();
        }else{

            $password_user = bcrypt($request['password']);
            $user = new User();
            $user->password = $password_user;
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->empUserId = $appUser->empUserId;
            $user->remember_pass = $request['password'];

            if(empty($request['image'])) { 
                $imageName = 'profile_default.png';
            } else { 
                request()->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                $imageName = time().'.'.request()->image->getClientOriginalExtension();
                request()->image->move(public_path('images'), $imageName); 
            }
            
            $appUser->userImg = $imageName;
            $user->userImg = $imageName;

            $perm = $request['group_id'];
            $perm_data = $request['premision'];
            
            if(count($perm_data) > 0)
            {
                foreach($perm_data as $per_ID) 
                    {
                        $data[] = [
                            'empuserid' => $appUser->empUserId,
                            'groupid' => $perm,
                            'permissionid' => $per_ID
                        ];
                    }
                DB::table('menu_permissions')->insert($data);
            }
            else{}
            $findRecord = DB::table('blast_a3m_account')->select('id')->orderBy('id', 'DESC')->first();
            $lastRecord = $findRecord->id;
        //var_dump($id);die();
            $data_blast_account[]=[
                'username'  => $request['name'], 
                'email'     => $request['email'], 
                'password'  => $password_user
            ];
            $data_blast_account_details[]=[
                'account_id'        => $lastRecord+1, 
                'fullname'          => $request['full_name'], 
                'firstname'         => $request['full_name'], 
                //'lastname'          => , 
                'contact_self'      => $request['cellphone'], 
                'contact_family'    => $request['contactnumber'], 
                'contact_home'      => $request['telephone'], 
                //'education'         => , 
                'organization'      => $request['department'], 
                'designation'       => $request['designation'], 
                'dateofbirth'       => $request['dob'], 
                'gender'            => 1, 
                'postalcode'        => $request['postcode'] 
                //'country'           => $request['city'] 
                //'language'          => , 
                //'timezone'          => , 
                //'citimezone'        => , 
                //'picture'           => 
            ];
            $data_blast_account_role[]=[
                'account_id'  => $lastRecord+1, 
                'role_id'     => 1
            ];
            DB::table('blast_a3m_account')->insert($data_blast_account);
            DB::table('blast_a3m_account_details')->insert($data_blast_account_details);
            DB::table('blast_a3m_rel_account_role')->insert($data_blast_account_role);
            $appUser->save();
            $user->save();

            $image = time().$_FILES['image']['name'];
            if ($request->hasFile('image')) {
                move_uploaded_file($_FILES['image']['tmp_name'], "images/" .$image);
            }


            return redirect('/userView')->with('message', 'User created successfully.');
        }
    }
    public function UserList()
    {
    	$userID = Auth::user()->empUserID;
                                
    	$data['userlist'] = AppUser::orderBy('id', 'asc')->get();

        return View('user.userlist')->with($data);
    }
    public function show($id)
    {
        $data['user'] = AppUser::where('empUserId','=',$id)->first();
        $data['role'] = Group::get();

        return View('user.user_edit')->with($data);
    }
    public function UserUpdate(Request $request)
    {
        dd($request->all());
        $validator = Validator::make($request->all(), [
                
            'user_name'        => 'required|max:100|alpha'
            
        ]);
        if ($validator->fails()) {
        return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }else{
            $userID = Auth::user()->empUserID;

                $userEditID = Input::get('empUserId');
                //var_dump(Input::file('image'));die();
                if(empty(Input::file('image'))) { 
                    $imageName = Input::get('old_img_name');
                } else { 
                    request()->validate([
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    ]);
                    $imageName = time().'.'.request()->image->getClientOriginalExtension();
                    request()->image->move(public_path('images'), $imageName); 
                }

                DB::table('app_users')
                    ->where('empUserId',$userEditID)
                    ->update([
                        'fullName'          => Input::get('full_name'),
                        'gender'            => Input::get('gender'),
                        'streetAddress'     => Input::get('street'),
                        'city'              => Input::get('city'),
                        'state'             => Input::get('state'),
                        'cellphone'         => Input::get('cellphone'),
                        'telePhone'         => Input::get('telephone'),
                        'contactNumber'     => Input::get('contactnumber'),
                        'alternatePhone'    => Input::get('alternatephone'),
                        'employeeId'        => Input::get('empID'),
                        'department'        => Input::get('department'),
                        'designation'       => Input::get('designation'),
                        'employeeTerm'      => Input::get('empterm'),
                        'status'            => Input::get('status'),
                        'updated_by'        => $userID,
                        'userImg'           => $imageName
                ]);
                DB::table('users')
                    ->where('empUserID',$userEditID)
                    ->update(['userImg'=> $imageName]);
                DB::table('user_group_permissions')->where('empUserId','=',$userEditID)->delete();

                $perm = Input::get('group_id');
                $perm_data = Input::get('premision');

                if(empty(Input::get('group_id'))){

                }else{
                    DB::table('menu_permissions')->where('empUserId','=',$userEditID)->delete();
                    if(count($perm_data) > 0)
                    {
                        foreach($perm_data as $per_ID) 
                            {
                                $data[] = [
                                    'empuserid' => $userEditID,
                                    'groupid' => $perm,
                                    'permissionid' => $per_ID
                                ];
                            }
                        DB::table('menu_permissions')->insert($data);
                    }
                 else{}
            }

            

            return redirect('/userView')->with('message', 'User updated successfully.');
        }
        
    }
    public function destroy($id)
    {
        DB::table('app_users')->where('empUserId','=',$id)->delete();
        DB::table('users')->where('empUserID','=',$id)->delete();
        DB::table('user_group_permissions')->where('empUserId','=',$id)->delete();
        DB::table('menu_permissions')->where('empUserId','=',$id)->delete();
        // redirect
        return redirect('/userView')->with('message', 'User deleted successfully.');
    }
    public function userAdd($trackingNo,$stepId){
        $userList = DB::table('casefiling_user_assigns')
                        ->select('empUserId')
                        ->where('tracking_no','=',$trackingNo)
                        ->where('inactive',0)
                        ->groupBy('empUserId')
                        ->get();

        $removeList = DB::table('casefiling_user_assigns')
                        ->select('empUserId')
                        ->where('inactive',1)
                        ->where('tracking_no','=',$trackingNo)
                        ->groupBy('empUserId')
                        ->get();

        $stepusers = DB::table('compliance_stepusers')
                        ->select('empUserId')
                        ->groupBy('empUserId')
                        ->get();
        return view('userAdd',compact('userList','stepusers','trackingNo','stepId','removeList'));
    }

    public function inactiveUser(Request $request){
        //dd($request->all());

        $checkExists = casefiling_user_assign::where('tracking_no',$request->tracking_no)
                              ->where('empUserId',$request->ReplaceTo)
                              ->get();

        $groupcheck = DB::table('compliance_stepusers')
                                        ->where('empUserId',$request->ReplaceTo)
                                        ->select('stepId')
                                        ->first();

        $groupcheckId = $groupcheck->stepId;

        $checkUser  = DB::table('casefiling_user_assigns')
                                        ->where('stepId',$groupcheckId)
                                        ->where('tracking_no',$request->tracking_no)
                                        ->where('inactive',0)
                                        ->count();
                                 
        if($checkUser < 2){
            Session::flash('duplicate', 'Please assign at list one user before remove'); 
            return redirect()->back();  
        }


        if($checkExists->isEmpty() == false){

            $inactiveCheck = DB::table('casefiling_user_assigns')
                                    ->where('empUserId',$request->ReplaceTo)
                                    ->where('tracking_no',$request->tracking_no)
                                    ->where('inactive',1)
                                    ->get();
            if($inactiveCheck->isEmpty() == false){
                Session::flash('duplicate', 'This user already removed'); 
                return redirect()->back();  
            }
            casefiling_user_assign::where('tracking_no',$request->tracking_no)
                              ->where('empUserId',$request->ReplaceTo)
                              ->update(['inactive'=>1]);
            Session::flash('duplicate', 'Successfully user removed from this case'); 
            return redirect()->back();  
        }else{
            Session::flash('duplicate', 'User not assigned in this case'); 
            return redirect()->back();  
        }
    }

    public function addUser(Request $request)
    {
        //dd($request->all());
        $tracking_no = $request->tracking_no;
        $ReplaceBy   = $request->ReplaceBy;
        $ReplaceTo   = $request->ReplaceTo;

        if($ReplaceBy == $ReplaceTo){
            Session::flash('duplicate', 'Replace to & Replace by are same'); 
            return redirect()->back();  
        }

        $ReplaceToCheck = DB::table('casefiling_user_assigns')
                                        ->where('empUserId',$request->ReplaceTo)
                                        ->where('tracking_no',$tracking_no)
                                        ->get();

        $ReplaceByCheck = DB::table('casefiling_user_assigns')
                                        ->where('empUserId',$request->ReplaceBy)
                                        ->where('tracking_no',$tracking_no)
                                        ->get();
                                        
        if($ReplaceToCheck->isEmpty() == false){
            Session::flash('duplicate', 'This user already assigned for this case'); 
            return redirect()->back();
        }
        if($ReplaceByCheck->isEmpty() == true){
            Session::flash('duplicate', 'Replace by user not assigned in this case'); 
            return redirect()->back();
        }

        $group2 = DB::table('compliance_stepusers')
                                        ->where('empUserId',$request->ReplaceTo)
                                        ->select('stepId')
                                        ->first();


        $group1 = DB::table('compliance_stepusers')
                                        ->where('empUserId',$request->ReplaceBy)
                                        ->select('stepId')
                                        ->first();

        if(isset($group1) && isset($group2)){
            $groupid2 = $group2->stepId;
            $groupid1 = $group1->stepId;

            if($groupid1 != $groupid2){
                Session::flash('duplicate', 'Not in same group'); 
                return redirect()->back();  
            }else{
                casefiling_user_assign::where('tracking_no',$tracking_no)
                                  ->where('empUserId',$request->ReplaceBy)
                                  ->update(['empUserId' => $request->ReplaceTo,'visual_status'=>0]);
                Session::flash('success', 'Successfully replace user'); 
                return redirect()->back();  
            }
        }
    }

}