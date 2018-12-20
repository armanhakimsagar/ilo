<?php

namespace App\Http\Controllers\Compliance;

use DB;
use Auth;
use App\User;
use App\MenuPermission;
use App\app_role;
use App\AppUser;
use App\ComplianceStep;
use App\ComplianceStepUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;

class CasefilingstepController extends Controller
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
        $data['user'] = AppUser::orderBy('fullName', 'ASC')->get();
        $data['step'] = ComplianceStep::orderBy('stepSL', 'ASC')->get();
        $data['stepuser'] = ComplianceStepUser::get();

    	return View('caseFiling.filingStep')->with($data);
    }

    public function SaveStep(Request $request)
    {
        $validator = Validator::make($request->all(), [
                
                'step_name'                 => 'required|max:500',
                'step_des'                  => 'required|max:5000',
                'step_serial'               => 'required|max:500'
            
        ]);
        if ($validator->fails()) {
        return redirect('CaseStep')
                        ->withErrors($validator)
                        ->withInput();
        }else{
        	$userID = Auth::user()->empUserID;
        	$step = new ComplianceStep();
        	$stepUser = new ComplianceStepUser();

        	$stepID = date('ymdhis');
        	$step->stepId = $stepID;
        	$step->stepName = $request['step_name'];
        	$step->stepDescription = $request['step_des'];
        	$step->stepSL = $request['step_serial'];
        	$userName = $request['user'];
        	$step->created_by = $userID;

        	$step->save();

            if(isset($userName)){
            	$data = [];
            	foreach ($userName as $empuser) {
            		$data[] = [
            			'stepId'=> $stepID, 
        				'empUserId'=> $empuser,
        				'created_by'=> $userID
            		];
            	}
            	
            	DB::table('compliance_stepusers')->insert($data);
            }
    	   return redirect('/CaseStep')->with('message', 'Case filing step created successfully.');
        }
    }

    public function show($id) 
    {
      $data['stepusername'] = DB::table('compliance_stepusers')->where('stepId','=',$id)->get();
      $data['stepname'] = DB::table('compliance_steps')->where('stepId', $id)->first();
      $data['user'] = AppUser::get();

      $data['step'] = ComplianceStep::orderBy('stepSL', 'ASC')->get();
      $data['stepuser'] = ComplianceStepUser::get();
      return view('caseFiling.editfilingStep')->with($data);
    }

    public function update()
    {
    	$stepid = Input::get('stepid');
    	$stepname = Input::get('step_name');
    	$step_serial = Input::get('step_serial');
    	$step_des = Input::get('step_des');
        $userID = Auth::user()->empUserID;
        $userName = Input::get('user');

        $inactiveCheck  = DB::table('app_users')
                                ->where('status',2)
                                ->whereIn('empUserID',$userName)
                                ->get();
                                
        if($inactiveCheck->isEmpty() == false){
            return redirect('/CaseStep')->with('message', 'One of the assigned user is inactive');
        }

        DB::table('compliance_stepusers')->where('stepId', '=', $stepid)->delete();
        if(isset($userName)){
            $data = [];
            foreach ($userName as $empuser) {
                $data[] = [
                    'stepId'=> $stepid, 
                    'empUserId'=> $empuser,
                    'created_by'=> $userID
                ];
            }
            DB::table('compliance_stepusers')->insert($data);
        }
    	DB::table('compliance_steps')
            ->where('stepId','=', $stepid)
            ->update(['stepName' => $stepname, 'stepDescription' => $step_des, 'stepSL' => $step_serial]);
        return redirect('/CaseStep')->with('message', 'Case filing step updated successfully.');
    }

    public function destroy($id)
	{
	    DB::table('compliance_steps')->where('stepId','=',$id)->delete();
	    DB::table('compliance_stepusers')->where('stepId','=',$id)->delete();
	    // redirect
	    return redirect('/CaseStep')->with('message', 'Selected step is deleted successfully.');
	}
}
