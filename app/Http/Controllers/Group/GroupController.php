<?php

namespace App\Http\Controllers\Group;

use DB;
use Auth;
use App\User;
use App\Group;
use App\Group_role;
use App\AppUser;
use App\app_role;
use App\MenuPermission;
use App\UserGroupPermission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $userID = Auth::user()->empUserID;
        $data['modulpermission'] = MenuPermission::where('empuserid','=',$userID)
                                ->distinct()->get(['modulid','modulname']);
        //UserModulPermission::where('empUserId','=',$userID)
        $data['AccessRole'] = MenuPermission::where('empuserid','=',$userID)
                                ->distinct()->get(['pername','slog','modulid']);
        $data['role'] = app_role::get();
        return View('group.group')->with($data);
    }

    public function SaveGroup(Request $request)
    {
        $validator = Validator::make($request->all(), [
                
                'group_name'                 => 'required|max:500',
                'group_des'                  => 'required|max:5000'
            
        ]);
        if ($validator->fails()) {
        return redirect('CaseStep')
                        ->withErrors($validator)
                        ->withInput();
        }else{
            $userID = Auth::id();
            $Group = new Group();
            $GroupRole = new Group_role();
            $Group->group_id = date('mhis');
            $Group->group_name = $request['group_name'];
            $Group->description = $request['group_des'];
            $Group->created_by = $userID;
            
            $Group->save();

            if(empty($request->get('permission')))
            {
            }else{
                foreach($request->get('permission') as $per_name) 
                {
                    $data[] = [
                        'group_id'      => $Group->group_id,
                        'permission_id' => $per_name
                    ];
                }
                DB::table('group_roles')->insert($data);
            }
            return redirect('/group')->with('message', 'Group created successfully');
        }
    }

    public function GroupList()
    {
        $userID = Auth::user()->empUserID;                                
        $data['grouplist'] = Group::orderBy('id', 'asc')->get();
        return View('group.groupList')->with($data);
    }

    public function GroupEdit($id)
    {
        $userID = Auth::user()->empUserID;

        $data['role'] = app_role::get();
        $data['group'] = Group::where('group_id','=',$id)->first();
        $data['group_role'] = Group_role::where('group_id','=',$id)->get();

        return View('group.groupedit')->with($data);
    }

    public function groupUpdate()
    {
        $userID = Auth::id();
        $Group = new Group();
        $group_id = Input::get('id');
        $group_name = Input::get('group_name');
        $description = Input::get('group_des');
        $updated_by = $userID;
        DB::table('groups')
            ->where('group_id','=', $group_id)
            ->update(['group_name' => $group_name, 'description' => $description]);

        DB::table('group_roles')->where('group_id', '=', $group_id)->delete();

        if(empty(Input::get('permission')))
        {
        }else{
            foreach(Input::get('permission') as $per_name) 
            {
                $data[] = [
                    'group_id'      => $group_id,
                    'permission_id' => $per_name
                ];
            }
            //var_dump($data);die();
            DB::table('group_roles')->insert($data);
        }

        return redirect('/groupView')->with('message', 'Group updated successfully.');
    }

    public function destroy($id)
    {
        DB::table('groups')->where('group_id','=',$id)->delete();
        DB::table('group_roles')->where('group_id','=',$id)->delete();
        // redirect
        return redirect('/groupView')->with('message', 'Group deleted successfully.');
    }
}
