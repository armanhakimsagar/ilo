<?php

namespace App\Http\Controllers\Api;

use App\Complianceform;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function getCompliantData(Request $request)
	{	
		
		$compliant = new Complianceform();					

		$compliant->brokers_mobile_no		= $request->get('mobile');

		$compliant->caseId					= $request->get('question_id');
		$compliant->broker_name				= $request->get('question_text');
		$compliant->complainant_address		= $request->get('applicant_name');

		if (empty($request->get('mobile')) || $request->get('mobile')=='') {			
			return response()->json([
				'status' => false,
				'message' => "Data not insert failed!"
			],200);

		}

		$insert = $compliant->save();
		if(insert){
			return response()->json([
				'status' => true,
				'message' => "Data has been inserted successfuly"
			],200);
		}else{
			return response()->json([
				'status' => false,
				'message' => "Data not insert failed!"
			],200);
		}
		
	}
}
