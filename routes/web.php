<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	if(Auth::check() == false){
		return view('auth.login');
	}
	else{
		return redirect('/home');
	}
});

Auth::routes();
Route::get('fileStrat',function(){
	return view('caseFiling.caseDetailsNotAccess');
});
Route::get('queryString','HomeController@queryString');
Route::get('downloadPDF','HomeController@downloadPDF');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/MobileAdmin', 'HomeController@MobileAdmin')->name('MobileAdmin');
Route::get('/profile', 'HomeController@profile')->name('profile');
Route::get('/editview', 'HomeController@editView')->name('editView');
Route::get('/userAdd/{trackingNo}/{stepId}','User\UserController@userAdd');
Route::post('/addUser','User\UserController@addUser');
/*============= Group ===================== */
Route::get('/group', 'Group\GroupController@index')->name('group');

Route::post('/groupCreate', [
	'as' => 'groupCreate', 
	'uses' => 'Group\GroupController@SaveGroup'
])->name('groupCreate');

Route::get('/groupView','Group\GroupController@GroupList')->name('groupView');
Route::get('/groupEdit/{id}','Group\GroupController@GroupEdit')->name('groupEdit');
Route::post('/groupUpdate', 'Group\GroupController@groupUpdate')->name('groupUpdate');
Route::get('/groupDestroy/{id}', 'Group\GroupController@destroy')->name('groupDestroy');

/*============= User ===================== */
Route::get('/user', 'User\UserController@index')->name('user');

Route::post('/userCreate', [
	'as' => 'userCreate', 
	'uses' => 'User\UserController@SaveUser'
])->name('userCreate');

Route::get('/userView','User\UserController@UserList')->name('userView');

Route::post('/inactiveUser','User\UserController@inactiveUser')->name('inactiveUser');

Route::get('/CaseSatusView','User\UserController@CaseSatusView')->name('CaseSatusView');

Route::get('/CaseSatusDetails/{id}','User\UserController@CaseSatusDetails')->name('CaseSatusDetails');

Route::get('/userEdit/{id}','User\UserController@show')->name('userEdit');

Route::post('/userupdate','User\UserController@UserUpdate')->name('UserUpdate');

Route::post('/user_update_by_admin','HomeController@UserUpdateByAdmin')->name('UserUpdateByAdmin');

Route::get('/userDestroy/{id}', 'User\UserController@destroy')->name('userDestroy');

/*============= Dashboard ================= */


Route::get('/todo_view','HomeController@TodoView')->name('TodoView');

Route::get('/todoComplete/{id}','HomeController@DoneTodo')->name('todoComplete');

Route::get('/todoUnComplete/{id}','HomeController@UnDoneTodo')->name('todoUnComplete');

/*============= To do List ================= */
Route::post('/todoCreate', [
	'as' => 'todoCreate', 
	'uses' => 'HomeController@SaveTodo'
])->name('todoCreate');

/*============= To do List End ================= */
/*============= Announcement Start ================= */
Route::get('/announce', 'Announcement\AnnouncementController@index')->name('announce');
Route::post('/announceCreate', [
	'as' => 'announceCreate', 
	'uses' => 'Announcement\AnnouncementController@Saveannounce'
])->name('announceCreate');

Route::get('/announceDetails/{id}','Announcement\AnnouncementController@Summary')->name('announceDetails');
Route::get('/announceView','Announcement\AnnouncementController@announceList')->name('announceView');

/*============= Announcement End ================= */
/*============= Case Start ================= */
Route::get('/CaseCreate', 'Compliance\ComplianceController@index')->name('CaseCreate');
Route::post('/complianceCreate', [
	'as' => 'complianceCreate', 
	'uses' => 'Compliance\ComplianceController@Savecompliance'
])->name('complianceCreate');
Route::get('/AllCompliance','Compliance\ComplianceController@ViewAllCase')->name('AllCompliance');
Route::get('/ComplianceList','Compliance\ComplianceController@ViewCase')->name('ComplianceList');
Route::get('/ComplianceDetails/{id}','Compliance\ComplianceController@SummaryAllCase')->name('ComplianceDetails');
Route::get('/documents/{file}', 'Compliance\ComplianceController@CompliantDownload')->name('documents');
Route::get('/comments/{file}', 'Compliance\ComplianceController@CompliantComments')->name('comments');
Route::get('/commentsDoc/{file}', 'Compliance\ComplianceController@SupportCompliantDownload')->name('commentsDoc');
Route::get('/ComplianceStart/{file}', 'Compliance\ComplianceController@CompliantStart')->name('ComplianceStart');
Route::get('/hearing_letter/{file}', 'Compliance\ComplianceController@hearingLetter')->name('hearing_letter');
Route::get('/hearing_letter_view/{file}', 'Compliance\ComplianceController@hearing_letter_view')->name('hearing_letter_view');
Route::get('generate_report/{id}','Compliance\ComplianceController@generateReport');
Route::post('reportGenerateInsert','Compliance\ComplianceController@reportGenerateInsert');
Route::get('reportGenerateView/{id}','Compliance\ComplianceController@reportGenerateView');
Route::post('/CaseStartCreate', 'Compliance\ComplianceController@ComplianceStartCreate')->name('CaseStartCreate');

Route::post('/CaseComplete', 'Compliance\ComplianceController@CaseComplete')->name('CaseComplete');

Route::get('/AllCompleteCase','Compliance\ComplianceController@ViewAllCompleteCase')->name('AllCompleteCase');

Route::get('/CaseIncomplete','Compliance\ComplianceController@AllInCompleteCase')->name('CaseIncomplete');

Route::get('/allCasesInfo','Compliance\ComplianceController@FullCases')->name('allCasesInfo');

/*============= Case End ================= */
/*============= Case Filing Step Start ================= */
Route::get('/CaseStep', 'Compliance\CasefilingstepController@index')->name('CaseStep');
Route::post('/StepCreate', [
	'as' => 'StepCreate', 
	'uses' => 'Compliance\CasefilingstepController@SaveStep'
])->name('StepCreate');
Route::get('/edit/{id}', 'Compliance\CasefilingstepController@show')->name('edit');
Route::post('/update', 'Compliance\CasefilingstepController@update')->name('update');
Route::get('/delete/{id}', 'Compliance\CasefilingstepController@destroy')->name('delete');

/*============= Case Filing Step End ================= */
/*============= Case Filing Process Start ================= */
Route::get('/FilingCaseList', 'Compliance\CasefilingprocessController@index')->name('FilingCaseList');
Route::get('/CaseFilingStart/{file}', 'Compliance\CasefilingprocessController@CaseFilingStart')->name('CaseFilingStart');
Route::post('/CaseFilingCreate', [
	'as' => 'CaseFilingCreate', 
	'uses' => 'Compliance\CasefilingprocessController@SaveFiling'
])->name('CaseFilingCreate');
Route::get('/FilingCase', 'Compliance\CasefilingprocessController@FilingCase')->name('FilingCase');
Route::get('/CaseUserFilingStart/{file}', 'Compliance\CasefilingprocessController@CaseUserFilingStart')->name('CaseUserFilingStart');
Route::post('/FilingUserCase', [
	'as' => 'FilingUserCase', 
	'uses' => 'Compliance\CasefilingprocessController@SaveUserFiling'
])->name('FilingUserCase');

/*============= Case Filing Process End ================= */

/*============= Compliant data from mobile app Start ================= */

Route::get('/mobile-compliant', 'Api\ApiController@getCompliantData');

/*============= Compliant data from mobile app End ================= */

Route::get('/PredefineComment', 'HomeController@predefinecomment')->name('PredefineComment');
Route::post('/CommentsCreate', [
	'as' => 'CommentsCreate', 
	'uses' => 'HomeController@SaveComment'
])->name('CommentsCreate');
Route::get('/EditComment/{id}', 'HomeController@editcomment')->name('EditComment');
Route::post('/CommentsUpdate', 'HomeController@updatecomment')->name('CommentsUpdate');
Route::get('/Commentsdelete/{id}', 'HomeController@destroy')->name('Commentsdelete');

/*============ Committeeletter =========================================*/
Route::get('/Committeeletter/{file}', 'Compliance\ComplianceController@CommitteeLetterGeneration')->name('Committeeletter');
Route::post('/committeeletter', [
	'as' => 'committeeletter', 
	'uses' => 'Compliance\ComplianceController@Generatecommitteeletter'
])->name('committeeletter');
Route::get('/ViewCommitteeletter/{file}', 'Compliance\ComplianceController@CommitteeLetterView')->name('ViewCommitteeletter');

Route::post('hearing_letter','Compliance\ComplianceController@hearingLetterPost');

/*======================== Email Queue ====================================*/
Route::get('groupPermission', [
	'as' => 'groupPermission', 
	'uses' => 'HomeController@getGroupList'
])->name('groupPermission');

/*======================== Report =========================================*/

Route::get('casestatus', 'ReportController@index')->name('casestatus');
Route::get('gender/{id}', 'ReportController@gender');
Route::get('agency_details', 'ReportController@agencyDetails');
Route::get('specific_agency/{id}','ReportController@specificAgency');

/*======================== Report =========================================*/

Route::get('bash_messagae', 'BashController@index');


/*======================== Email =========================================*/

//Route::get('email', 'EmailController@sendEmail');

Route::get('sink_notification', 'User\UserController@sinkNotification');

Route::get('update_notification/{id}', 'User\UserController@updateNotification');

Route::get('allNotification','User\UserController@allNotification');



/*======================== Complain Edit =========================================*/


Route::get('complain_edit/{id}', 'ComplainEdit@complainView');
Route::post('compliance_update','ComplainEdit@complianceUpdate');
Route::get('case_tracking/{id}', 'ComplainEdit@caseTracking');
Route::get('error',function(){
  abort(404);
});