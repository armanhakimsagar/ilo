@extends('theme.default')
@section('content')

<div class="row" style="background-color: #00097c;color: #fff; margin-bottom: 10px">
    <div class="col-lg-12">
        <div class="panel-heading">Inquiry Case List</div>
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
              <th style="display: none">sl</th>
              <th width="10%">Tracking No</th>
              <th width="10%">Name</th>
              <th width="10%">Country Name</th>
              <th width="10%">Complain Channel</th>
              <th width="20%">Complain Details</th>
              <th width="20%">Compliant Status</th>
              <th width="14%">Action</th>
            </tr>
          </thead>
          <tbody>
          
          
            @foreach($caselist as $casealllists)
            <tr>
              <td style="display: none">{{ $casealllists->application_id }}</td>
              <td>{{ $casealllists->applicantTrackingNo }}</td>
              <td>@if($casealllists->sufferer_name != "NULL")
                  {{ $casealllists->sufferer_name }}
                  @endif
              </td>
              <td>
                @if($casealllists->sufferer_current_country != "NULL")
                  {{ $casealllists->sufferer_current_country }}
                @endif</td>
              <td>{{ $casealllists->application_type }}</td>
              <td>
                <span class="class-span">
                    @if($casealllists->application_text != "NULL")
                      {{ strip_tags($casealllists->application_text) }}
                    @endif
                </span>
              </td>
              <td><span class="label label-success">
                @if($casealllists->application_status =="Case Inquery On Progress.")
                  Case Inquiry On Progress.
                @else
                  Case Inquiry On Progress.
                @endif
              </span></td>
              <td>
                @if(!isset($dg_button_check))
                <a href="{{ route('ComplianceStart',$casealllists->applicantTrackingNo) }}" class="btn btn-primary  btn-xs" data-toggle="tooltip" title="Case Inquery Start ..."><span class="glyphicon glyphicon-send"></span> </a>
                @endif
                <a href="{{ route('ComplianceDetails',$casealllists->applicantTrackingNo) }}" class="btn btn-success  btn-xs" data-toggle="tooltip" title="Complain Full Information ..."><span class="glyphicon glyphicon-eye-open"></span> </a>
                <a href="{{ route('comments',$casealllists->applicantTrackingNo) }}" class="btn btn-info  btn-xs" data-toggle="tooltip" title="Case Inquery Comments Summary ..."><i class="fa fa-file-text-o"></i> </a>
              </td>
            </tr>
            @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection