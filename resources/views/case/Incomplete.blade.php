<?php 
   use App\Http\Controllers\HomeController;
?>
@extends('theme.default')
@section('content')


<div class="row" style="background-color: #00097c;color: #fff; margin-bottom: 10px">
    <div class="col-lg-12">
        <div class="panel-heading">Case Filing List</div>
    </div>
    <!-- /.col-lg-12 -->
</div>


@if(Session::has('message')) 
    <div class="alert alert-info"> {{Session::get('message')}} </div> 
@endif
<!-- /.row -->
<div class="row" style=" background-color: #eee; padding: 20px 0px 0px 0px">
    <div class="col-lg-12">
        <table class="display table table-striped table-bordered nowrap" cellspacing="0" width="100%" style="font-size: 12px">
          <thead>
            <tr>
              <th width="10%">Tracking No</th>
              <th width="10%">Name</th>
              <th width="10%">Country Name</th>
              <th width="10%">Complain Channel</th>
              <th width="40%">Complain Details</th>
              <th width="10%">Compliant Status</th>
              <th width="10%">Action</th>
            </tr>
          </thead>
          <tbody>
             
             @foreach($caseadminlist as $caseadminlists)
              <tr>
                <td width="10%">
                  <?php 
                    $userID = Auth::user()->empUserID;
                    $Negetivestatus = HomeController::NegetiveNotification($userID,$caseadminlists->applicantTrackingNo); 

                    if(isset($Negetivestatus)){
                      Session::put('filing_notification', Auth::user()->empUserID."new_file");
                      echo "<span class='label label-danger'>New</span>";
                    }

                    $count = HomeController::FilednotificationUnset($userID); 
                    if($count == 0){
                      Session::put('filing_notification', "");
                    }
                  ?>
                  {{ $caseadminlists->applicantTrackingNo }}
                  
                </td>
                <td width="10%">@if($caseadminlists->sufferer_name != "NULL")
                      {{ $caseadminlists->sufferer_name }}
                    @endif</td>
                <td width="10%">@if($caseadminlists->sufferer_current_country != "NULL")
                      {{ $caseadminlists->sufferer_current_country }}
                    @endif
               </td>
                <td width="10%">{{ $caseadminlists->application_type }}</td>
                <td width="30%">
                  <span class="class-span">
                    @if($caseadminlists->application_text != "NULL")
                      {{ strip_tags($caseadminlists->application_text) }}
                    @endif
                  </span>
                </td>
                <td width="10%"><span class="label label-danger">Case Incomplete</span></td>
                <td width="10%">
                  

                  <a href="{{ route('ComplianceDetails',$caseadminlists->applicantTrackingNo) }}" class="btn btn-success  btn-xs" data-toggle="tooltip" title="Complain Full Information ..."><span class="glyphicon glyphicon-eye-open"></span> </a>

                  <a href="{{ route('comments',$caseadminlists->applicantTrackingNo) }}" class="btn btn-info  btn-xs" data-toggle="tooltip" title="Case Filing Comments Summary"><i class="fa fa-file-text-o"></i> </a>
                  
                  

                </td>
              </tr>             
             @endforeach
          </tbody>
        </table>
    </div>
</div>
@endsection