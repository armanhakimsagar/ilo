<?php use App\Http\Controllers\HomeController;?>
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
              <th>Tracking No</th>
              <th>Name</th>
              <th>Country Name</th>
              <th>Complain Channel</th>
              <th>Complain Details</th>
              <th>Compliant Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($casefile as $casealllists)
              <tr>
              <td>{{ $casealllists->applicantTrackingNo }}</td>
              <td>{{ $casealllists->sufferer_name }}</td>
              <td>{{ $casealllists->sufferer_current_country }}</td>
              <td>{{ $casealllists->application_type }}</td>
              <td>
                <span class="class-span">
                    {{ strip_tags($caseadminlists->application_text) }}
                </span>
              </td>
              <td><span class="label label-success">{{ $casealllists->application_status }}</span></td>
              <td>
                <a href="{{ route('CaseUserFilingStart',$casealllists->applicantTrackingNo) }}" class="btn btn-primary  btn-xs" data-toggle="tooltip" title="Case Filing Start ..."><span class="glyphicon glyphicon-send"></span> </a>
                <a href="{{ route('ComplianceDetails',$casealllists->case_id) }}" class="btn btn-success  btn-xs" data-toggle="tooltip" title="Complain Full Information ..."><span class="glyphicon glyphicon-eye-open"></span> </a>
                <a href="{{ route('comments',$casealllists->case_id) }}" class="btn btn-info  btn-xs" data-toggle="tooltip" title="Case Filing Comments Summary ..."><i class="fa fa-file-text-o"></i> </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>
</div>

@endsection
