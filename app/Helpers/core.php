<?php
use App\User;
use App\BlastApplication;
use App\send_mail;

function mail_get($id){
	//dd($id);
	$mail = User::where('empUserID','=',$id)->first()->email;
	if($mail != null){
		return $mail;	
	}else{
		return "no data found";
	}
	
}
function get_id($id){
	$mail = User::where('empUserID','=',$id)->first()->empUserId;
	if($mail != null){
		return $mail;	
	}else{
		return "no data found";
	}
	
}

function DeviceToken($caseid){
	//dd($caseid);
	$result = BlastApplication::where('case_id','=',$caseid)->select('device_token')->first();
	if(isset($result)){
		return $result->device_token;
	}
}

function TrackCheck($applicantTrackingNo){
	//dd($applicantTrackingNo);
	$userID = Auth::user()->empUserID;
	$count = send_mail::where('notification',0)
						->where('tracking_number',$applicantTrackingNo)
						->get();

	//dd($count);
	if(sizeof($count) > 0){
		return "<span class='label label-danger'>NEW</span>";
	}
	
}