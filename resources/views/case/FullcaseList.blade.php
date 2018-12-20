@extends('theme.default')
@section('content')


<div class="row" style="background-color: #00097c;color: #fff; margin-bottom: 10px">
    <div class="col-lg-12">
        <div class="panel-heading">Full Case List</div>
    </div>
    <!-- /.col-lg-12 -->
</div>



@if(Session::has('message')) 
    <div class="alert alert-info"> {{Session::get('message')}} </div> 
@endif
<!-- /.row -->
<div class="row">
  <div class="col-lg-12">
  </div>
</div>
<hr>
<div class="row" style=" background-color: #eee; padding: 20px 0px 0px 0px">
    <div class="col-lg-12">
        <table class="display table table-striped table-bordered nowrap" cellspacing="0" width="100%" style="font-size: 12px">
          <thead>
            <tr>
              <th style="display: none">sl</th>
              <th width="10%">Tracking No</th>
              <th width="10%">Name</th>
              
              <th width="10%">Complain Channel</th>
              <th width="50%">Complain Details</th>
              <th width="20%">Complain Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($caseinqueryalllist as $caseadminlists)
            <tr>
              <td style="display: none">{{ $caseadminlists->application_id }}</td>
              <td width="10%">{{ $caseadminlists->applicantTrackingNo }}</td>
              <td width="10%">
                @if($caseadminlists->sufferer_name != "NULL")
                  {{ $caseadminlists->sufferer_name }}
                @endif
              </td>
              
              <td width="10%">{{ $caseadminlists->application_type }}</td>
              <td width="60%">
                <span class="class-span">
                    @if($caseadminlists->application_text != "NULL")
                      {{ strip_tags($caseadminlists->application_text) }}
                    @endif
                
                </span>
              </td>
              <td width="20%">
              <span class="label label-success">
                @if($caseadminlists->application_status == "RECEIVED")
                  Received
                @elseif($caseadminlists->application_status == "Case Filing On Progress.")
                  Case Filing On Progress
                @elseif($caseadminlists->application_status == "Case Filing done.")
                  Case Filing done 
                @elseif($caseadminlists->application_status == "Case Send for Inquery.")
                  Case Inquiry On Progress
                @elseif($caseadminlists->application_status == "Case Inquery Complete.")
                  Case Complete
                @elseif($caseadminlists->application_status == "Case Inquiry Incomplete.")
                  Case Incomplete  
                @endif

              </span></td>
            </tr>
            @endforeach
        
          </tbody>
        </table>
    </div>
</div>

@endsection