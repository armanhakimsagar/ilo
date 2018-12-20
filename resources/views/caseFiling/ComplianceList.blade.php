<?php use App\Http\Controllers\HomeController;?>
@extends('theme.default')
@section('content')


<div class="row" style="background-color: #00097c;color: #fff; margin-bottom: 10px">
    <div class="col-lg-12">
        <div class="panel-heading"> New Case List</div>
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
        <table class="display table table-striped table-bordered nowrap" cellspacing="0" width="100%" style="font-size: 12px;">
          <thead>
            <tr>
              <th style="display:none">SL</th>
              <th width="10%"><b>Tracking No</b></th>
              <th width="20%">Name</th>
              <th width="20%">Country Name</th>
              <th width="20%">Complain Channel</th>
              <th width="10%">Compliant Status</th>
              <th width="20%">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($mobilecaselist as $mobilecaselists)
            <tr>
              <td style="display:none">{{ $mobilecaselists->application_id }}</td>
              <td>{{ $mobilecaselists->applicantTrackingNo }}</td>
              <td>@if($mobilecaselists->sufferer_name != "NULL" ){{ $mobilecaselists->sufferer_name }} @endif</td>
              <td>@if($mobilecaselists->sufferer_current_country != "NULL" )
                      {{ $mobilecaselists->sufferer_current_country }} 
                  @endif</td>
              <td>@if($mobilecaselists->application_type != "NULL" ){{ $mobilecaselists->application_type }} @endif</td>
              <td><span class="label label-success">{{ $mobilecaselists->application_status }}</span></td>
              <td>
                <a href="{{ route('CaseFilingStart',$mobilecaselists->applicantTrackingNo) }}" class="btn btn-primary  btn-xs" data-toggle="tooltip" title="Case Filing Start ..."><span class="glyphicon glyphicon-send"></span> </a>
                <a href="{{ route('ComplianceDetails',$mobilecaselists->applicantTrackingNo) }}" class="btn btn-success  btn-xs" data-toggle="tooltip" title="Complain Full Information ..."><span class="glyphicon glyphicon-eye-open"></span> </a>
                <a href="{{ route('comments',$mobilecaselists->applicantTrackingNo) }}" class="btn btn-info  btn-xs" data-toggle="tooltip" title="Case Filing Comments Summary"><i class="fa fa-file-text-o"></i> </a>
                <a href="" class="btn btn-danger  btn-xs"><i class="fa fa--o"></i> E filing </a>
              </td>
            </tr>
            @endforeach
          <!--
            @foreach($access_permission as $access_permissions)
              @if($access_permissions->group_name == 'all_filing_case_view')
                @foreach($mobilecaselist as $mobilecaselists)
                <tr>
                  <td>{{ $mobilecaselists->applicantTrackingNo }}</td>
                  <td>{{ $mobilecaselists->case_id }}</td>
                  <td>{{ $mobilecaselists->sufferer_name }}</td>
                  <td>{{ $mobilecaselists->sufferer_current_country }}</td>
                  <td>{{ $mobilecaselists->application_type }}</td>
                  <td>
                    <span class="class-span">
                        {{ strip_tags($mobilecaselists->application_text) }}
                    </span>
                  </td>
                  <td><span class="badge badge-default">{{ $mobilecaselists->application_status }}</span></td>
                  <td>
                    <a href="{{ route('CaseFilingStart',$mobilecaselists->applicantTrackingNo) }}" class="btn btn-primary  btn-xs" data-toggle="tooltip" title="Case Filing Start ..."><span class="glyphicon glyphicon-send"></span> </a>
                    <a href="{{ route('ComplianceDetails',$mobilecaselists->applicantTrackingNo) }}" class="btn btn-success  btn-xs" data-toggle="tooltip" title="Complain Full Information ..."><span class="glyphicon glyphicon-eye-open"></span> </a>
                    <a href="{{ route('comments',$mobilecaselists->applicantTrackingNo) }}" class="btn btn-info  btn-xs" data-toggle="tooltip" title="Case Filing Comments Summary ..."><i class="fa fa-file-text-o"></i> </a>
                  </td>
                </tr>
                @endforeach
              @else
                @foreach($casefile as $casefiles)
                <tr>
                  <td>{{ $casefiles->applicantTrackingNo }}</td>
                  <td>{{ $casefiles->case_id }}</td>
                  <td>{{ $casefiles->sufferer_name }}</td>
                  <td>{{ $casefiles->sufferer_current_country }}</td>
                  <td>{{ $casefiles->application_type }}</td>
                  <td><span class="badge badge-default">{{ $casefiles->application_status }}</span></td>
                  <td>
                    <a href="{{ route('CaseUserFilingStart',$casefiles->applicantTrackingNo) }}" class="btn btn-primary  btn-xs" data-toggle="tooltip" title="Case Filing Start ..."><span class="glyphicon glyphicon-send"></span> </a>
                    <a href="{{ route('ComplianceDetails',$casefiles->applicantTrackingNo) }}" class="btn btn-success  btn-xs" data-toggle="tooltip" title="Complain Full Information ..."><span class="glyphicon glyphicon-eye-open"></span> </a>
                    <a href="{{ route('comments',$casefiles->applicantTrackingNo) }}" class="btn btn-info  btn-xs" data-toggle="tooltip" title="Case Filing Comments Summary ..."><i class="fa fa-file-text-o"></i> </a>
                  </td>
                </tr>
                @endforeach
              @endif
            @endforeach
          -->
          </tbody>
        </table>
    </div>
</div>

@endsection