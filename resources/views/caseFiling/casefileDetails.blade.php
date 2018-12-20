<?php use App\Http\Controllers\HomeController;?>
@extends('theme.default')
@section('content')


<div class="row" style="background-color: #00097c;color: #fff; margin-bottom: 10px">
    <div class="col-lg-12">
        <div class="panel-heading">Complaint Details </div>
    </div>
    <!-- /.col-lg-12 -->
</div>



@if(Session::has('message')) 
    <div class="alert alert-info"> {{Session::get('message')}} </div> 
@endif
<!-- /.row -->
{!! Form::open(array('url' => 'FilingUserCase','method'=>'POST','files'=>true, 'id'=>'differentForm', 'onSubmit'=>'return validate()')) !!}
@foreach($casedetails as $casealllists)
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-success">
      <div class="panel-heading">Migrant Worker Information</div>
      <div class="panel-body">
        <table class="table table-bordered">
          <?php $tracking_no = $casealllists->applicantTrackingNo; ?>
          <input type="hidden" name="tracking_no" value="{{ $casealllists->applicantTrackingNo }}">
          <input type="hidden" name="caseID" value="{{ $casealllists->case_id }}">
          <tr>
            <td><b>Tracking Number:</b> {{ $casealllists->applicantTrackingNo }}</td>
            <td><b>Name :</b> 
              @if($casealllists->sufferer_name == ""  || $casealllists->sufferer_name != "NULL")
                {{ $casealllists->sufferer_name }}
              @endif

            </td>
          </tr>
          <tr>
            
          </tr>
          <tr>
            <td><b>Mobile No:</b> 
              @if($casealllists->sufferer_mobile == ""  || $casealllists->sufferer_mobile != "NULL")
                {{ $casealllists->sufferer_mobile }}
              @endif</td>
            <td><b>Local Mobile No:</b> 
              @if($casealllists->sufferer_local_no == ""  || $casealllists->sufferer_local_no != "NULL")
                {{ $casealllists->sufferer_local_no }}
              @endif</td>
          </tr>
          <tr>
            <td><b>Nationality :</b> 
              @if($casealllists->sufferer_nationality == ""  || $casealllists->sufferer_nationality != "NULL")
                {{ $casealllists->sufferer_nationality }}
              @endif</td>
            <td><b>Passport No:</b> 
              @if($casealllists->sufferer_passport_no == ""  || $casealllists->sufferer_passport_no != "NULL")
                {{ $casealllists->sufferer_name }}
              @endif</td>
          </tr>
          <tr>
            <td><b>Country Name :</b> 
              @if($casealllists->sufferer_current_country == ""  || $casealllists->sufferer_current_country != "NULL")
                {{ $casealllists->sufferer_current_country }}
              @endif</td>
            <td><b>Case filed date:</b> {{ date("d F Y", strtotime($casealllists->created_at)) }}</td>
          </tr>
          <tr>
            <td><b>District :</b> 
              @if($casealllists->sufferer_district == ""  || $casealllists->sufferer_district != "NULL")
                {{ $casealllists->sufferer_district }}
              @endif</td>
            <td><b>Upazilla :</b> 
              @if($casealllists->sufferer_upazilla == ""  || $casealllists->sufferer_upazilla != "NULL")
                {{ $casealllists->sufferer_upazilla }}
              @endif
            </td>
          </tr>
          <tr>
            <td><b>Current Address :</b> 
              @if($casealllists->sufferer_current_address == ""  || $casealllists->sufferer_current_address != "NULL")
                {{ $casealllists->sufferer_current_address }}
              @endif
            </td>
            <td><b>Gender :</b> 

              @if($casealllists->gender != "NULL")
                {{ $casealllists->gender }}
              @endif
            </td>
          </tr>
          <tr>
            <td><b>Money transaction person name:</b> 
              @if($casealllists->money_taker_name != "NULL")
                {{ $casealllists->money_taker_name }}
              @endif</td>
            <td><b>Money transaction person phone no:</b> 
              @if($casealllists->money_taker_phone_no != "NULL")
                {{ $casealllists->money_taker_phone_no }}
              @endif</td>
          </tr>
        </table>
        <!--
        <h4><u>Document Submitted</u></h4>
        <div class="list-group">
          @foreach($casedocument as $casedocuments)
            <?php $ext = pathinfo($casedocuments->file_name, PATHINFO_EXTENSION);?>
            @if($ext == 'pdf')
              <a href="{{ route('documents',$casedocuments->file_name) }}" class="list-group-item" target="_blank">
                <i class="fa fa-file-pdf-o" style="font-size:16px;color:red"></i>{{ $casedocuments->supporting_doc_name }}</a>
              @elseif($ext == 'doc' || $ext == 'docx')
              <a href="{{ route('documents',$casedocuments->file_name) }}" class="list-group-item" target="_blank">
                <span class="glyphicon glyphicon-file" style="font-size:16px;color:blue"></span>{{ $casedocuments->supporting_doc_name }}</a>
              @elseif($ext == 'mp4')
                <video width="320" height="240" controls>
                  <source src="http://stage-ilo.dnet.org.bd/resource/media/{{ $casedocuments->file_name }}" type="video/mp4">
                </video>
              @elseif($ext == 'mp3')
                <audio controls>
                  <source src="http://stage-ilo.dnet.org.bd/resource/media/{{ $casedocuments->file_name }}" type="audio/mp3">
                </audio>
              @else
              <a href="{{ route('documents',$casedocuments->file_name) }}" class="list-group-item" target="_blank">
                <i class="glyphicon glyphicon-picture" style="font-size:16px;color:green"></i>{{ $casedocuments->supporting_doc_name }}</a>
              @endif
          @endforeach
          @foreach($casemaindocument as $casemaindocuments)
            <?php $ext = pathinfo($casemaindocuments->supporting_doc_name, PATHINFO_EXTENSION);?>
            @if($ext == 'pdf')
              <a href="{{ route('documents',$casemaindocuments->supporting_doc_name) }}" class="list-group-item" target="_blank">
                <i class="fa fa-file-pdf-o" style="font-size:16px;color:red"></i>{{ $casemaindocuments->orginal_name }}</a>
              @elseif($ext == 'doc' || $ext == 'docx')
              <a href="{{ route('documents',$casemaindocuments->supporting_doc_name) }}" class="list-group-item" target="_blank">
                <span class="glyphicon glyphicon-file" style="font-size:16px;color:blue"></span>{{ $casemaindocuments->orginal_name }}</a>
              @elseif($ext == 'mp4')
                <video width="320" height="240" controls>
                  <source src="http://stage-ilo.dnet.org.bd/resource/media/{{ $casemaindocuments->supporting_doc_name }}" type="video/mp4">
                </video>
              @elseif($ext == 'mp3')
                <audio controls>
                  <source src="http://stage-ilo.dnet.org.bd/resource/media/{{ $casemaindocuments->supporting_doc_name }}" type="audio/mp3">
                </audio>
              @else
              <a href="{{ route('documents',$casemaindocuments->supporting_doc_name) }}" class="list-group-item" target="_blank">
                <i class="glyphicon glyphicon-picture" style="font-size:16px;color:green"></i>{{ $casemaindocuments->orginal_name }}</a>
              @endif
          @endforeach
        </div>
        -->
      </div>
    </div>
  </div>
  <div class="col-lg-12">
    <div class="panel panel-success">
      <div class="panel-heading">Case Information</div>
      <div class="panel-body">
        <table class="table table-bordered">
          <tr>
            <td><b>Complaint for whom?:</b> 

              @if($casealllists->application_for == "own")
                A person lives in abroad
              @endif

              @if($casealllists->application_for == "own_other")
                A person who visit to abroad
              @endif

              @if($casealllists->application_for == "other")
                On behalf of a sufferer
              @endif


            </td>
              
            <td><b>Relation with :</b> 
              @if($casealllists->relation != "NULL")
                {{ $casealllists->relation }}
              @endif
              </td>
            
          </tr>
          <tr>
            @if($casealllists->agency_name != "NULL")
            <td><b>Agency Name :</b> 
                
                  {{ $casealllists->agency_name }}
                
              </td>
            @endif
            @if($casealllists->agency_mobile_no != "NULL")
            <td><b>Agency Mobile No:</b> 
                
                  {{ $casealllists->agency_mobile_no }}
                
            </td>
            @endif

            @if($casealllists->broker_name != "NULL")
            <td><b>Agent Name :</b> 
                
                  {{ $casealllists->broker_name }}
                
              </td>
            @endif
            @if($casealllists->broker_mobile_no != "NULL")
            <td><b>Agent Mobile No:</b> 
                
                  {{ $casealllists->broker_mobile_no }}
                
            </td>
            @endif


            @if($casealllists->company_name != "NULL")
            <td><b>Company Name :</b> 
                
                  {{ $casealllists->company_name }}
                
              </td>
            @endif
            @if($casealllists->company_mobile_no != "NULL")
            <td><b>Company Mobile No:</b> 
                
                  {{ $casealllists->company_mobile_no }}
                
            </td>
            @endif


            @if($casealllists->person_name != "NULL")
            <td><b>Person Name :</b> 
                
                  {{ $casealllists->person_name }}
                
              </td>
            @endif
            @if($casealllists->person_mobile_no != "NULL")
            <td><b>Person Mobile No:</b> 
                
                  {{ $casealllists->person_mobile_no }}
                
            </td>
            @endif


            @if($casealllists->recruitment_officer_name != "NULL")
            <td><b>Officer Name :</b> 
                
                  {{ $casealllists->recruitment_officer_name }}
                
              </td>
            @endif
            @if($casealllists->recruitment_officer_mobile_no != "NULL")
            <td><b>Officer Mobile No:</b> 
                
                  {{ $casealllists->recruitment_officer_mobile_no }}
                
            </td>
            @endif
          </tr>
          @if($casealllists->application_for != "own")
          <tr>
            @if($casealllists->applicant_name == ""  || $casealllists->applicant_name != "NULL")
            <td><b>Applicant Name :</b> 
              
                {{ $casealllists->applicant_name }}
              
            </td>
            @endif
            @if($casealllists->applicant_country == "" || $casealllists->applicant_country != "NULL")
            <td><b>Applicant Country :</b> 
              
                {{ $casealllists->applicant_country }}
              
            </td>
            @endif
          </tr>
          <tr>
            @if($casealllists->applicant_email == "" || $casealllists->applicant_email != "NULL")
            <td><b>Applicant Email :</b> 
              
                {{ $casealllists->applicant_email }}
              
            </td>
            @endif
            @if($casealllists->applicant_mobile_no == "" || $casealllists->applicant_mobile_no != "NULL")
            <td><b>Applicant Mobile No :</b> 
              
                {{ $casealllists->applicant_mobile_no }}
              
            </td>
            @endif
          </tr>
          <tr>
            @if($casealllists->applicant_address == "" || $casealllists->applicant_name != "NULL")
            <td colspan="2"><b>Applicant Address :</b> 
              
                {{ $casealllists->applicant_address }}
              
             </td>
             @endif
          </tr>
          @endif
        </table>
        <ul class="list-group">
          <li class="list-group-item list-group-item-danger">Problem Type</li>
          <?php $problemDetails = HomeController::getProblemDetails($casealllists->case_id); ?>
          @foreach($problemDetails as $problemDetailss)
            <li class="list-group-item">{{ $problemDetailss->compliance_description }}</li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-success">
      <div class="panel-heading">Compliant Details</div>
      <div class="panel-body">
        <p>
          @if($casealllists->application_text != "NULL")
          {{ strip_tags($casealllists->application_text) }}
          @endif
        </p>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-success">
      <div class="panel-heading">Case Filing Comments</div>
      <div class="panel-body">
        @foreach($casefilecomments as $casefilecommentss)
          <p>
            @if($casefilecommentss->comments != "NULL")
            <b>
              <?php $userName = HomeController::getName($casefilecommentss->empUserId); ?>
              {{ $userName['fullName'] }}
            </b><br>
            {{ strip_tags($casefilecommentss->comments) }}
          </p>
          @endif
        @endforeach
      </div>
    </div>
  </div>
</div>



<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-success">
      <div class="panel-heading">Next User <div id="error"></div></div>
      <div class="panel-body">
        @if(count($casefilestep) < 1)

          @foreach($compliancestep as $compliancesteps)
          <input type="hidden" name="stepID[]" value="{{ $compliancesteps->stepId }}">
            @if ($loop->first)
            <b>{{ $compliancesteps->stepName }}</b>
              <?php $userName = HomeController::getStepUserInfo($compliancesteps->stepId); ?>
              
              @foreach($userName as $userNames)

              <?php $casePending = HomeController::getPendingCaseInfo($userNames->empUserId); ?>
                <p>
                  <input type="checkbox" name="userAssign[]" value="{{ $userNames->empUserId }}" checked> {{ $userNames->fullName." - ".$userNames->designation }}
                  <span class="badge badge-danger">{{ " Pending Case : ".$casePending }}</span>
                </p>
              @endforeach

              <input type="hidden" name="firstStepID" value="{{ $compliancesteps->stepId }}"><br>
            @endif

            @if ($loop->last)
            <input type="hidden" name="lastStepID" value="{{ $compliancesteps->stepId }}">
            @endif
          @endforeach
        @else

          @foreach($casefilestep as $casefilesteps)
          <?php $currentstepId = $casefilesteps->currentstepId; ?>
          <input type="hidden" name="CurrentstepID" value="{{ $casefilesteps->currentstepId }}">
            @if($casefilesteps->nextstepId == $casefilesteps->laststepId && $casefilesteps->currentstepId != $casefilesteps->firststepId)
            	<?php 
	              $steps = json_decode($casefilesteps->stepId);
	              $nextStepIndex = array_search($casefilesteps->currentstepId, $steps);
	              $nextStepId = $steps[$nextStepIndex - 1];
	              $userName = HomeController::getStepUserInfo($nextStepId);
	            ?>
	            <input type="hidden" name="stepID" value="{{ $nextStepId }}">
	            <input type="hidden" name="process" value="1">

	            @foreach($userName as $userNames)

              <?php
                $checkCasewiseInactive = 
                HomeController::inactiveUserCheck($userNames->empUserId,$casealllists->applicantTrackingNo);
                $inactiveFullSystem = 
                HomeController::inactiveFullSystem($userNames->empUserId);
                //dd($inactiveFullSystem->isEmpty() == true);
                if($checkCasewiseInactive->isEmpty() == true){
                  if($inactiveFullSystem->isEmpty() == true){
              ?>

              <?php $casePending = HomeController::getPendingCaseInfo($userNames->empUserId); ?>
	              <p>
                  <input type="checkbox" name="userAssign[]" value="{{ $userNames->empUserId }}" checked="checked"> {{ $userNames->fullName." - ".$userNames->designation }}
                  <span class="badge badge-danger">{{ " Pending Case : ".$casePending }}</span>
                </p>
              <?php }} ?>
	            @endforeach
            @elseif($casefilesteps->nextstepId == $casefilesteps->laststepId && $casefilesteps->currentstepId == $casefilesteps->firststepId)
            <input type="hidden" name="stepID" value="Approved">
            <input type="hidden" name="process" value="2">
            <div class="alert alert-default">
              <span class="label label-success" style="font-size: 16px">
                <strong>Case Filing Complete.Please Assign User For Inquiry.</strong></span>
            </div>
            <div class="col-lg-6">
              <input type="checkbox" name="userAssign[]" value="1" checked style="display: none">
              <select class="form-control" name="assign_dd" required>
                <option value=''>Select Deputy Director</option>
                @foreach($ddlists as $ddlist)
                  
                  <?php
                    $name = HomeController::getIdToNameAppUser($ddlist->empUserId); 
                    echo "<option value='$name->empUserId'>";
                    echo $name->fullName;
                    echo "</option>";
                  ?>
                  
                @endforeach
              </select>
            </div>
            <div class="col-lg-6">
              <select class="form-control" name="assign_ad" required>
                <option value=''>Select Assistant Director</option>
                @foreach($adlists as $adlist)
                  <?php
                    $name = HomeController::getIdToNameAppUser($adlist->empUserId); 
                    echo "<option value='$name->empUserId'>";
                    echo $name->fullName;
                    echo "</option>";
                  ?>
                @endforeach
              </select>
            </div>
            
            @else
            <input type="hidden" name="process" value="3">
	            <?php 
	              $steps = json_decode($casefilesteps->stepId);
	              $nextStepIndex = array_search($casefilesteps->currentstepId, $steps);
	              $nextStepId = $steps[$nextStepIndex + 1];
	              $userName = HomeController::getStepUserInfo($nextStepId);  
	            ?>
	            <input type="hidden" name="stepID" value="{{ $nextStepId }}">

	              @foreach($userName as $userNames)

                  <?php
                    //dd($userName);
                    $empCheckId = $userNames->empUserId;
                    $inactiveUserCheck = HomeController::inactiveUserCheck($empCheckId,$tracking_no);
                    if(count($inactiveUserCheck) == 0){
                    //$empCheckTrackingNo = $userNames->tracking_no;

                    $casePending = HomeController::getPendingCaseInfo($userNames->empUserId); 
                  ?>
                  <?php $id = HomeController::getId($userNames->userName);?>
    	             <p><input type="checkbox" name="userAssign[]" value="{{ $id->empUserId }}" checked="checked"> {{ $userNames->fullName." - ".$userNames->designation }}
                  <span class="badge badge-danger">{{ " Pending Case : ".$casePending }}</span></p>
                  <?php } ?>
                @endforeach

	        @endif
          @endforeach
        @endif
      </div>
    </div>
  </div>
</div>
<div class="row">
    <div class="col-lg-12">
      @if($casefilesteps->nextstepId != $casefilesteps->laststepId || $casefilesteps->currentstepId != $casefilesteps->firststepId)
        <div class="panel panel-danger">
            <div class="panel-heading">Complaint Observation</div>
                <div class="panel-body">
                    <div class="col-lg-12">
                      <div class="col-lg-12">
                        <label>Documents Upload</label>
                        <input type="file" name="supportingDoc[]" multiple="multiple"  class="btn btn-default">
                    </div>
                    <div class="col-lg-12">
                        <h4>Case Observation</h4>
                        <textarea class="form-control" name="observation"></textarea><br>
                    </div>
                </div>
            </div>
        </div>
      @endif
    <hr>

    @if($casefilesteps->nextstepId == $casefilesteps->laststepId && $casefilesteps->currentstepId == $casefilesteps->firststepId)
      <button type="submit" class="btn btn-primary" name="assign" id="assign">Start</button>

    @else
      
        <button type="submit" class="btn btn-primary" name="assign" id="assign">Start</button>
    

    @endif 
    <hr>
  {{ Form::close() }}
</div>


<script language="javascript">
  function validate(){
  var chks = document.getElementsByName('userAssign[]');
  var hasChecked = false;
  for (var i = 0; i < chks.length; i++)
  {
    if (chks[i].checked)
    {
    hasChecked = true;
    break;
    }
  }
  console.log(hasChecked);
  if (hasChecked == false)
    {
    document.getElementById("error").innerHTML = "* Please select at list one user";
    return false;
    }

  return true;
  }
</script>

@endforeach

@endsection