<?php 
   use App\Http\Controllers\HomeController;
?>
@extends('theme.default')
@section('content')
<style>
  th{
    font-size: 13px;
    text-align: center;
    font-weight: bold;
  }
</style>

<div class="row" style="background-color: #00097c;color: #fff; margin-bottom: 10px">
    <div class="col-lg-12">
        <div class="panel-heading">Case Filing List</div>
    </div>
    <!-- /.col-lg-12 -->
</div>

@if(Session::has('message')) 
    <script type="text/javascript">
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            window.location.href = document.referrer;
        };
    </script>
    <div class="alert alert-info"> {{Session::get('message')}} </div> 
@endif

<!-- /.row -->
<div class="row" style=" background-color: #eee; padding: 20px 0px 0px 0px">
    <div class="col-lg-12">
        <table class="display table table-striped table-bordered nowrap" cellspacing="0" width="100%" style="font-size: 12px">
          <thead>
            <tr>
              <th>Tracking No</th>
              <th>Name</th>
              <th>Country Name</th>
              <th>Complain Details</th>
              <th>Compliant Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
             @foreach($caseadminlist as $caseadminlists)
              <tr>
                <td>
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
                <td>@if($caseadminlists->sufferer_name != "NULL")
                      {{ $caseadminlists->sufferer_name }}
                    @endif
                </td>
                <td width="20%">@if($caseadminlists->sufferer_current_country != "NULL")
                      {{ $caseadminlists->sufferer_current_country }}
                    @endif
               </td>
                <td width="30%">
                  <span class="class-span">
                      @if($caseadminlists->application_text != "NULL")
                        {{ $caseadminlists->application_text }}
                      @endif
                  </span>
                </td>
                <td><span class="label label-success">{{ $caseadminlists->application_status }}</span></td>
                <td width="12%">

                  <?php
                    $empCheckId = Auth::user()->empUserID;
                    $inactiveUserCheck = HomeController::inactiveUserCheck($empCheckId,$caseadminlists->applicantTrackingNo);
                    if(count($inactiveUserCheck) == 0){
                  ?>
                  @if($caseadminlists->case_filing_status == "Approved")
                    
                    <?php 
                      $committee  = HomeController::getCommitteeLetter($caseadminlists->applicantTrackingNo); 
                      $groupname  = HomeController::getGroupName(Auth::user()->empUserID);
                      $director   = $groupname->group_name;
                    ?>

                    @if($caseadminlists->application_status != "Case Filing done.")
                      
                      <a href="{{ route('ComplianceStart',$caseadminlists->applicantTrackingNo) }}" class="btn btn-primary  btn-xs" data-toggle="tooltip" title="Case Start"><span class="glyphicon glyphicon-send"></span> </a>

                    @elseif($caseadminlists->application_status == "Case Filing done." && ($director == "Assistant Director" || $director == "Deputy Director"))
                      
                      <a href="{{ route('ComplianceStart',$caseadminlists->applicantTrackingNo) }}" class="btn btn-danger  btn-xs" data-toggle="tooltip" title="Case Start"><span class="glyphicon glyphicon-send"></span> </a>

                    @endif


                    @if(count($committee) > 0)
                    
                      <a href="{{ route('ViewCommitteeletter',$caseadminlists->applicantTrackingNo) }}" class="btn btn-success  btn-xs" data-toggle="tooltip" title="Committee letter"><i class="fa fa-file-text-o"></i></a>
                    
                    @elseif($director == "Additional Director General")
                      <a href="{{ route('Committeeletter',$caseadminlists->applicantTrackingNo) }}" class="btn btn-danger  btn-xs" data-toggle="tooltip" title="Committee letter generate"><i class="fa fa-file-text-o"></i></a>
                    @endif
                  @else
                  @endif

                  <a href="{{ route('ComplianceDetails',$caseadminlists->applicantTrackingNo) }}" class="btn btn-success  btn-xs" data-toggle="tooltip" title="Complain Full Information ..."><span class="glyphicon glyphicon-eye-open"></span> </a>

                  <a href="{{ route('comments',$caseadminlists->applicantTrackingNo) }}" class="btn btn-info  btn-xs" data-toggle="tooltip" title="Case Filing Comments Summary"><i class="fa fa-file-text-o"></i> </a>
                  @if($caseadminlists->case_filing_status == "Approved")
                  @else
                    <a href="{{ route('CaseUserFilingStart',$caseadminlists->applicantTrackingNo) }}" class="btn btn-primary  btn-xs" data-toggle="tooltip" title="Case Start"><span class="glyphicon glyphicon-send"></span> </a>
                  @endif
                  
                  <?php }else{ ?>
                    <span class="label label-danger">Inactive.</span>
                  <?php } ?>

                </td>
              </tr>             
             @endforeach
          </tbody>
        </table>
    </div>
</div>
@endsection