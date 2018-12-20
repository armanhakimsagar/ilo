<?php

use Illuminate\Http\Request;
use App\send_mail;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::post('send_mails', function(Request $request) {
    $send_mail = send_mail::create($request->all);
    
    if(count($send_mail) == 0){
       $feedback = [
           'status'     => "error",
           'message'    => "insert error"
        ]; 
       
    }else{
        $feedback = [
           'status'     => "success",
           'message'    => "inserted successfully"
        ]; 
    }
    
    return $feedback;
});

Route::get('send_mails', function() {
    // If the Content-Type and Accept headers are set to 'application/json', 
    // this will return a JSON structure. This will be cleaned up later.
    $send_mail = send_mail::all();
    if(count($send_mail) == 0){
       $feedback = [
           'status'     => "error",
           'message'    => "data not found",
           'data'       => null
        ]; 
       
    }else{
        $feedback = [
           'status'     => "success",
           'message'    => "data found",
           'data'       => $send_mail
        ]; 
    }
    
    return $feedback;
});
