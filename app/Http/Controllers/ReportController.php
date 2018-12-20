<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Charts;
use DB;
use App\BlastApplication;

class ReportController extends Controller
{
    public function index()
    {
        // country wise Report
        $countries = DB::table('blast_applications')
                            ->select('sufferer_current_country', DB::raw('count(*) as total'))
                            ->where('sufferer_current_country','!=',"NULL")
                            ->groupBy('sufferer_current_country')
                            ->limit(5)
                            ->orderBy('total', 'desc')
                            ->get();

        //dd($countries);
        
        $complete = DB::table('blast_applications')
                            ->where('application_status',"Case Inquery Complete.")
                            ->count();
        $incomplete = DB::table('blast_applications')
                            ->where('application_status',"Case Inquiry Incomplete.")
                            ->count();
 
        // agency wise Report
                       

        $agencies = DB::table('blast_applications')
                            ->select('agency_name', DB::raw('count(*) as total'))
                            ->where('agency_name','!=',"NULL")
                            ->groupBy('agency_name')
                            ->limit(5)
                            ->orderBy('total', 'desc')
                            ->get();

    

        // channel wise Report
                       

        $application_types = DB::table('blast_applications')
                            ->select('application_type', DB::raw('count(*) as total'))
                            ->where('application_type','!=',"NULL")
                            ->groupBy('application_type')
                            ->limit(10)
                            ->orderBy('total', 'desc')
                            ->get();
    
        //dd($application_types);
        // Gender wise Report
                       

        $male = DB::table('blast_applications')
                                ->where('gender','=','Male')
                                ->count();

        $female = DB::table('blast_applications')
                                ->where('gender','=','Female')
                                ->count();

        $other = DB::table('blast_applications')
                                ->where('gender','=','Other')
                                ->count();




        // Monthly New Case Report


        $users = DB::table('blast_applications')->where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();
    	$chart = Charts::database($users, 'bar', 'highcharts') 

            ->title("Monthly New Case") 
            ->elementLabel("Total Cases") 
            ->dimensions(1000, 500) 
            ->responsive(true) 
            ->groupByMonth(date('Y'), true);

        return view('Report.case_status', compact('chart','male','female','other','countries','application_types','agencies','complete','incomplete'));
    }

    public function gender($id){

        $countries_wise_gender = DB::table('blast_applications')
                                    ->where('sufferer_current_country',"$id")
                                    ->select(DB::raw('gender as name', 'count(*) y'))
                                    ->get();

        foreach ($countries_wise_gender as $key => $value) {
            print_r($value);
        }
       // return json_encode($countries_wise_gender);
    }

    public function agencyDetails(){
        $agencylist  = BlastApplication::groupBy('agency_name')
                                ->select('agency_name', DB::raw('count(*) as total'))
                                ->where('agency_name','!=','NULL')
                                ->get();

        return view('Report.agency_list',compact('agencylist'));
    }


    public static function ComplainDetailsList($agency_name){
        $application_type = DB::table('blast_applications')
                                ->select('application_type')
                                ->where('agency_name','=',$agency_name)
                                ->get();
        return json_decode($application_type);
    } 

}
