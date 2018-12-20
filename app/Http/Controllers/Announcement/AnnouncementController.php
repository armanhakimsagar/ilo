<?php

namespace App\Http\Controllers\Announcement;

use DB;
use Auth;
use App\User;
use App\Group;
use App\AppUser;
use App\MenuPermission;
use App\Announcement;
use App\UserGroupPermission;
use App\AnnouncementCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;

class AnnouncementController extends Controller
{
    public function index()
    {
    	$userID = Auth::user()->empUserID;
        $data['modulpermission'] = MenuPermission::where('empuserid','=',$userID)
                                ->distinct()->get(['modulid','modulname']);
        //UserModulPermission::where('empUserId','=',$userID)
        $data['AccessRole'] = MenuPermission::where('empuserid','=',$userID)
                                ->distinct()->get(['pername','slog','modulid']);
        $data['user'] = AppUser::get();
    	$data['role'] = Group::get();
    	return View('announcement.announce_create')->with($data);
    }

    public function Saveannounce(Request $request)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
                
                'title'                 => 'required|max:1000',
                'description'           => 'max:1000',
                'docuName'              => 'mimes:jpeg,png,jpg,doc,docx,pdf|max:2048'
            
        ]);
        if ($validator->fails()) {
        return redirect('announce')
                        ->withErrors($validator)
                        ->withInput();
        }else{
        	$userID = Auth::user()->empUserID;
        	$announcement = new Announcement();
        	$announcementCategory = new AnnouncementCategory();

        	$announcement->announceId = date('ymhis');;
        	$announcement->publishDate = $request['publishDate'];
        	$announcement->closingDate = $request['closingDate'];
        	$announcement->priority = $request['priority'];
        	$announcement->announceCategory = $request['optradio'];
        	$announcement->title = $request['title'];
        	$announcement->description = $request['description'];
            $announcement->empUserId = $request['empUserId'];
        	$announcement->created_by = $userID;
            if(empty($request['docuName'])){
                $imageName = '';
            }else{
                $imageName = time().'.'.request()->docuName->getClientOriginalExtension();
                request()->docuName->move(public_path('AnnounceDoc'), $imageName); 
            }
            /*
        	$personList = Input::get('my_data');
            //var_dump($personList);die();
        	$personSeperate = explode(',', $personList);
            //var_dump($personList);die();
            $data = [];
        	foreach($personSeperate as $per_ID) 
            {
                $data[] = [
                    'announceId' => $announcement->announceId,
                    'personId' => $per_ID,
                    'created_by' => $userID
                ];
            }
            //var_dump($data);die();
        	
            */
        	$announcement->docName = $imageName;
            //DB::table('announcement_categories')->insert($data);
        	$announcement->save();
        }
    	return redirect('/announceView')->with('message', 'Announcement created successfully.');
    }

    public function Summary($id, Request $request)
    {
    	$userID = Auth::user()->empUserID;
        $data['modulpermission'] = MenuPermission::where('empuserid','=',$userID)
                                ->distinct()->get(['modulid','modulname']);
        //UserModulPermission::where('empUserId','=',$userID)
        $data['AccessRole'] = MenuPermission::where('empuserid','=',$userID)
                                ->distinct()->get(['pername','slog','modulid']);

    	$data['announceDetails'] = Announcement::where('announceId','=',$id)->get();
    	return View('announcement.announce_details')->with($data);
    }

    public function announceList()
    {
    	$userID = Auth::user()->empUserID;
        $data['announcement'] = Announcement::where('empUserId',$userID)
                                            ->orwhere('created_by',$userID)
                                            ->orwhere('announceCategory',"public")
                                            ->take(5)
                                            ->get();
                                
    	return View('announcement.announce_list')->with($data);
    }
}
