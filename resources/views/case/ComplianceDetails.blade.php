<?php use App\Http\Controllers\HomeController;?>
@extends('theme.default')
@section('content')
@if(Session::has('message')) 
    <div class="alert alert-info"> {{Session::get('message')}} </div> 
@endif
@if(Session::has('update')) 
    <div class="alert alert-info"> {{Session::get('update')}} </div> 
@endif

@foreach($casedetails as $casealllists)

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"> Complain Details 

          @if($casealllists->application_status == "RECEIVED" || $casealllists->application_status == "Case Filing On Progress." || $casealllists->application_status == "Case Filing On Progress." )
          <a href="{{ url('complain_edit/'.$casealllists->applicantTrackingNo) }}" class="btn btn-success col-lg-2" style="float: right">Edit</a>
          @endif

        </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<!-- /.row -->

<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-success">
      <div class="panel-heading">Migrant Worker Information</div>
      <div class="panel-body">
        <table class="table table-bordered">
          <tr>
            <td width="50%"><b>Tracking No:</b> 
              @if($casealllists->applicantTrackingNo != "NULL")
                {{ $casealllists->applicantTrackingNo }}
              @endif</td>
            <td><b>Case filed date:</b> {{ date("d F Y", strtotime($casealllists->created_at)) }}</td>
          </tr>
          <tr>
            <td width="50%"><b>Name :</b> 
              @if($casealllists->sufferer_name != "NULL")
                {{ $casealllists->sufferer_name }}
              @endif</td>
              <td><b>Application Channel :</b> 
              @if($casealllists->application_type != "NULL")
                {{ $casealllists->application_type }}
              @endif</td>
          </tr>
          
          <tr>
            <td><b>Mobile No:</b> 
              @if($casealllists->sufferer_mobile != "NULL")
                {{ $casealllists->sufferer_mobile }}
              @endif</td>
            <td><b>Local Mobile No:</b> 
              @if($casealllists->sufferer_local_no != "NULL")
                {{ $casealllists->sufferer_local_no }}
              @endif</td>
          </tr>
          <tr>
            <td><b>Nationality :</b> 
              @if($casealllists->sufferer_nationality != "NULL")
                {{ $casealllists->sufferer_nationality }}
              @endif</td>
            <td><b>Passport No:</b> 
              @if($casealllists->sufferer_passport_no != "NULL")
                {{ $casealllists->sufferer_passport_no }}
              @endif</td>
          </tr>
          <tr>
            <td colspan="1"><b>Country Name :</b> 
              @if($casealllists->sufferer_current_country != "NULL")
                {{ $casealllists->sufferer_current_country }}
              @endif</td>
              <td colspan="1"><b>Gender :</b> 
              @if($casealllists->gender != "NULL")
                {{ $casealllists->gender }}
              @endif</td>
          </tr>
          <tr>
            <td><b>District :</b> 
              @if($casealllists->sufferer_district != "NULL")
                {{ $casealllists->sufferer_district }}
              @endif</td>
            <td><b>Upazilla :</b> 
              @if($casealllists->sufferer_upazilla != "NULL")
                {{ $casealllists->sufferer_upazilla }}
              @endif</td>
          </tr>
          <tr>
            <td><b>Current Address :</b> 
              @if($casealllists->sufferer_current_address != "NULL")
                {{ $casealllists->sufferer_current_address }}
              @endif</td>
            <td><b>Local Address :</b> 
              @if($casealllists->sufferer_local_address != "NULL")
                {{ $casealllists->sufferer_local_address }}
              @endif</td>
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
        <h4><u>Document Submitted</u></h4>
        <div class="list-group">
          @foreach($casedocument as $casedocuments)
          @if($casedocuments->supporting_doc_name != "")
            @if($casealllists->application_type == "Web")

              <?php $ext = pathinfo($casedocuments->file_name, PATHINFO_EXTENSION);?>
              @if($ext == 'pdf')
                <a href="{{ route('documents',$casedocuments->file_name) }}" class="list-group-item" target="_blank">
                  <i class="fa fa-file-pdf-o" style="font-size:16px;color:red"></i>{{ $casedocuments->supporting_doc_name }}</a>
                @elseif($ext == 'doc' || $ext == 'docx')
                <a href="{{ route('documents',$casedocuments->file_name) }}" class="list-group-item" target="_blank">
                  <span class="glyphicon glyphicon-file" style="font-size:16px;color:blue"></span>{{ $casedocuments->supporting_doc_name }}</a>
                @elseif($ext == 'mp4')
                  <video width="320" height="240" controls>
                    <source src="{{ asset('ComplianceDoc/'.$casedocuments->supporting_doc_name)}}" type="video/mp4">
                  </video>
                @elseif($ext == 'mp3')
                  <audio controls>
                    <source src="{{ asset('ComplianceDoc/'.$casedocuments->file_name)}}" type="video/mp4">
                  </audio>
                @else
                <a href="{{ route('documents',$casedocuments->file_name) }}" class="list-group-item" target="_blank">
                  <i class="glyphicon glyphicon-picture" style="font-size:16px;color:green"></i>{{ $casedocuments->supporting_doc_name }}</a>
                @endif

            @else

              <?php $ext = pathinfo($casedocuments->file_name, PATHINFO_EXTENSION);?>
              @if($ext == 'pdf')
                <a href="http://stage-ilo.dnet.org.bd/resource/media/<?php echo $casedocuments->file_name ?>" class="list-group-item" target="_blank">
                  <i class="fa fa-file-pdf-o" style="font-size:16px;color:red"></i>{{ $casedocuments->supporting_doc_name }}</a>
                @elseif($ext == 'doc' || $ext == 'docx')
                <a href="http://stage-ilo.dnet.org.bd/resource/media/<?php echo $casedocuments->file_name ?>" class="list-group-item" target="_blank">
                  <span class="glyphicon glyphicon-file" style="font-size:16px;color:blue"></span>{{ $casedocuments->supporting_doc_name }}</a>
                @elseif($ext == 'mp4')
                  <video width="320" height="240" controls>
                    <source src="http://stage-ilo.dnet.org.bd/resource/media/<?php echo $casedocuments->file_name ?>" type="video/mp4">
                  </video>
                @elseif($ext == 'mp3')
                  <audio controls>
                    <source src="http://stage-ilo.dnet.org.bd/resource/media/<?php echo $casedocuments->file_name ?>" type="video/mp4">
                  </audio>
                @else
                <a href="http://stage-ilo.dnet.org.bd/resource/media/<?php echo $casedocuments->file_name ?>" class="list-group-item" target="_blank">
                  <i class="glyphicon glyphicon-picture" style="font-size:16px;color:green"></i>{{ $casedocuments->supporting_doc_name }}</a>
                @endif

              @endif
          @endif
          @endforeach
          

          @foreach($casemaindocument as $casemaindocuments)
          
            @if($casealllists->application_type == "Web")
            <?php $ext = pathinfo($casemaindocuments->supporting_doc_name, PATHINFO_EXTENSION);?>
            @if($ext == 'pdf')
              <a href="{{ route('documents',$casemaindocuments->supporting_doc_name) }}" class="list-group-item" target="_blank">
                <i class="fa fa-file-pdf-o" style="font-size:16px;color:red"></i>{{ $casemaindocuments->orginal_name }}</a>
              @elseif($ext == 'doc' || $ext == 'docx')
              <a href="{{ route('documents',$casemaindocuments->supporting_doc_name) }}" class="list-group-item" target="_blank">
                <span class="glyphicon glyphicon-file" style="font-size:16px;color:blue"></span>{{ $casemaindocuments->orginal_name }}</a>
              @elseif($ext == 'mp4')
                <video width="320" height="240" controls>
                  <source src="{{ asset('ComplianceDoc/'.$casemaindocuments->supporting_doc_name)}}" type="video/mp4">
                </video>
              @elseif($ext == 'mp3')
                <audio controls>
                  <source src="{{ asset('ComplianceDoc/'.$casemaindocuments->supporting_doc_name)}}" type="video/mp4">
                </audio>
              @else
              <a href="{{ route('documents',$casemaindocuments->supporting_doc_name) }}" class="list-group-item" target="_blank">
                <i class="glyphicon glyphicon-picture" style="font-size:16px;color:green"></i>{{ $casemaindocuments->orginal_name }}</a>
              @endif

            @else
              <?php $ext = pathinfo($casemaindocuments->supporting_doc_name, PATHINFO_EXTENSION);?>
            @if($ext == 'pdf')
              <a href="{{ route('documents',$casemaindocuments->supporting_doc_name) }}" class="list-group-item" target="_blank">
                <i class="fa fa-file-pdf-o" style="font-size:16px;color:red"></i>{{ $casemaindocuments->orginal_name }}</a>
              @elseif($ext == 'doc' || $ext == 'docx')
              <a href="{{ route('documents',$casemaindocuments->supporting_doc_name) }}" class="list-group-item" target="_blank">
                <span class="glyphicon glyphicon-file" style="font-size:16px;color:blue"></span>{{ $casemaindocuments->orginal_name }}</a>
              @elseif($ext == 'mp4')
                <video width="320" height="240" controls>
                  <source src="{{ asset('ComplianceDoc/'.$casemaindocuments->supporting_doc_name)}}" type="video/mp4">
                </video>
              @elseif($ext == 'mp3')
                <audio controls>
                  <source src="{{ asset('ComplianceDoc/'.$casemaindocuments->supporting_doc_name)}}" type="video/mp4">
                </audio>
              @else
              <a href="{{ route('documents',$casemaindocuments->supporting_doc_name) }}" class="list-group-item" target="_blank">
                <i class="glyphicon glyphicon-picture" style="font-size:16px;color:green"></i>{{ $casemaindocuments->orginal_name }}</a>
              @endif
            @endif
          @endforeach

          @if(isset($case_filing_user_comments_doc))
            @foreach($case_filing_user_comments_doc as $case_filing_user_comments_docs)
                <a href="{{ route('documents',$case_filing_user_comments_docs->supporting_doc) }}" class="list-group-item" target="_blank">
                  <i class="fa fa-file-pdf-o" style="font-size:16px;color:red"></i>
                  {{ $case_filing_user_comments_docs->doc_orginal_name }}</a>
            @endforeach
          @endif
        </div>
        
      </div>
    </div>
  </div>
  <div class="col-lg-12">
    <div class="panel panel-success">
      <div class="panel-heading">Case Information</div>
      <div class="panel-body">
        <table class="table table-bordered">
          <tr>
            <td><b>Complaint is given by:</b> 
              @if($casealllists->application_for != "NULL")


                  @if($casealllists->application_for == "own")
                    Person who already went abroad
                  @endif
                  @if($casealllists->application_for == "own_other")
                    Person who wants to go abroad
                  @endif
                  @if($casealllists->application_for == "other")
                    On behalf of a sufferer
                  @endif

              @endif

            </td>
              
            <td><b>Relation with :</b> 
              @if($casealllists->relation != "NULL")
                {{ $casealllists->relation }}
              @endif
              </td>
              
          </tr>
          <tr>
          
          @if($casealllists->application_for == "other") 
            <td><b>Applicant Name :</b> 
                @if($casealllists->applicant_name != "NULL")
                {{ $casealllists->applicant_name }}
                @endif
            </td>
           
            
            <td><b>Applicant Country :</b> 
                @if($casealllists->applicant_country != "NULL")
                {{ $casealllists->applicant_country }}
                @endif
            </td>
            
          </tr>
          <tr>
            
            <td><b>Applicant Email :</b> 
                @if($casealllists->applicant_email != "NULL")
                {{ $casealllists->applicant_email }}
                @endif
            </td>
            
            
            <td><b>Applicant Mobile No :</b> 
                @if($casealllists->applicant_mobile_no != "NULL")
                {{ $casealllists->applicant_mobile_no }}
                @endif
            </td>
            
          </tr>
          <tr>
          
            <td colspan="2"><b>Applicant Address :</b> 
                @if($casealllists->applicant_address != "NULL")
                {{ $casealllists->applicant_address }}
                @endif
            </td>
            
          </tr>
        @endif
          <tr>
            @if($casealllists->broker_name != "NULL")
            <td><b>Agent Name :</b> 
                
                  {{ $casealllists->broker_name }}
                
              </td>
            @endif
            @if($casealllists->broker_mobile_no != "NULL")
            <td><b>Agent Mobile No :</b> 
                
                  {{ $casealllists->broker_mobile_no }}
                
              </td>
            @endif

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


            @if($casealllists->company_name != "NULL")
            <td><b>Other Name :</b> 
                
                  {{ $casealllists->company_name }}
                
              </td>
            @endif
            @if($casealllists->company_mobile_no != "NULL")
            <td><b>Other Mobile No:</b> 
                
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
      <div class="panel-heading">Complaint Details</div>
      <div class="panel-body">
        <p>@if($casealllists->application_text != "NULL")
            {{ strip_tags($casealllists->application_text) }}
          @endif</p>
      </div>
    </div>
  </div>
</div>
@endforeach

  @if(isset($case_tracking) && count($case_tracking) !=0)

    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-success">
          <div class="panel-heading">Case Edit History</div>
          <div class="panel-body">
            <table class="table">
              <tr>
                <th>Case Edited By</th>
                <th>Changed Time</th>
                <th>Detials</th>
              </tr>
              @foreach($case_tracking as $case_trackings) 
                <tr>
                    <td><?php $name = HomeController::getName($case_trackings->user_id);
                              echo $name->userName; 
                        ?></td>
                    <td>{{ $case_trackings->created_at }}</td>
                    <td><a href="../case_tracking/{{ $case_trackings->application_id }}">Details</a></td>
                </tr>
              @endforeach
            </table>
          </div>
        </div>
      </div>
    </div>
    
  @endif



@if(isset($hearing_tracking) && count($hearing_tracking) !=0)
<div class="row">
 <div class="col-lg-12">
    <div class="panel panel-success">
      <div class="panel-heading">Commmitte Letter Tracking History</div>
      <div class="panel-body">
        <table class="table table-bordered">
          <tr>
            <th width="20%">Tracking no</th>
            <th width="20%">Committee No</th>
            <th width="30%">Created By</th>
            <th width="20%">Date</th>
          </tr>
            <?php //dd($hearing_tracking); ?>
            @foreach($committe_tracking as $committe_trackings)
              <tr>
            
                <td>
                      <a href="{{ url('ViewCommitteeletter/'.$committe_trackings->tracking_no) }}">
                        {{ $committe_trackings->tracking_no }}
                      </a>
                  </td>
                  <td>
                    {{ $committe_trackings->committee_no }}

                  </td>
                  <td>
                    <?php 
                      $name =HomeController::getIdToName($committe_trackings->created_by);
                      echo $name->name; 
                    ?>  
                  </td>
                  <td>{{ $committe_trackings->created_at }}</td>
                </a>
            
              </tr>
            @endforeach
          
        </table>
      </div>
    </div>
  </div>
</div>
@endif


@if(isset($hearing_tracking) && count($hearing_tracking) !=0)
<div class="row">
 <div class="col-lg-12">
    <div class="panel panel-success">
      <div class="panel-heading">Hearing Letter Tracking History</div>
      <div class="panel-body">
        <table class="table table-bordered">
          <tr>
            <th width="20%">Tracking no</th>
            <th width="20%">Created By</th>
            <th width="35%">Note</th>
            <th width="10%">Status</th>
            <th width="15%">Date</th>
          </tr>
            <?php //dd($hearing_tracking); ?>
            @foreach($hearing_tracking as $hearing_trackings)
              <tr>
            
                <td>
                      <a href="{{ url('hearing_letter_view/'.$hearing_trackings->id) }}">
                          {{ $hearing_trackings->tracking_no }}
                      </a>
                  </td>
                  <td>
                    <?php 
                      $name =HomeController::getIdToName($hearing_trackings->created_by);
                      echo $name->name; 
                    ?>  
                  </td>
                  <td>
                    <?php  
                      $note = $hearing_trackings->note;
                      echo substr($note,0,100);
                    ?>
                  </td>
                  <td>
                      @if($hearing_trackings->status == "Save")
                        <span class="label label-primary">
                          {{ $hearing_trackings->status }}
                        </span>
                      @elseif($hearing_trackings->status == "Done")
                        <span class="label label-success">
                          Send
                        </span>
                      @endif

                  </td>
                  <td>{{ $hearing_trackings->created_at }}</td>
                </a>
            
              </tr>
            @endforeach
          
        </table>
      </div>
    </div>
  </div>
</div>
@endif

@endsection