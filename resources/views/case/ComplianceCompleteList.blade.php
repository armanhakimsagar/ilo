@extends('theme.default')
@section('content')


<div class="row" style="background-color: #00097c;color: #fff; margin-bottom: 10px">
    <div class="col-lg-12">
        <div class="panel-heading">Completed Case List</div>
    </div>
    <!-- /.col-lg-12 -->
</div>


@if(Session::has('message')) 
    <div class="alert alert-info"> {{Session::get('message')}} </div> 
@endif

<!-- /.row -->
<div class="row" style=" background-color: #eee; padding: 20px 0px 0px 0px">
    <div class="col-lg-12">

      <table id="table_id" class="display table table-striped table-bordered nowrap" cellspacing="0" width="100%" style="font-size: 12px">
          <thead>
              <tr>
              <th style="display: none">Sl</th>
              <th width="10%">Tracking No</th>
              <th width="10%">Name</th>
              <th width="10%">Country Name</th>
              <th width="10%">Complain Channel</th>
              <th width="30%">Complain Details</th>
              <th width="10%">Compliant Status</th>
              <th width="20%">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($caseadminlist as $caseadminlists)
            <tr>
              <td style="display: none">{{ $caseadminlists->application_id }}</td>
              <td width="10%">{{ $caseadminlists->applicantTrackingNo }}</td>
              <td width="10%">
                @if($caseadminlists->sufferer_name != "NULL" )
                  {{ $caseadminlists->sufferer_name }}
                @endif
              </td>
              <td width="10%">
                @if($caseadminlists->sufferer_current_country != "NULL" )
                  {{ $caseadminlists->sufferer_current_country }}
                @endif
              </td>
              <td width="10%">
                @if($caseadminlists->application_type != "NULL" )
                  {{ $caseadminlists->application_type }}
                @endif
              </td>
              <td width="30%">
                <span class="class-span">
                    @if($caseadminlists->application_text != "NULL" )
                      {{ $caseadminlists->application_text }}
                    @endif
                </span>
              </td>
              <td width="10%"><span class="label label-success">Case Completed</span></td>
              <td width="10%">
                <a href="{{ route('ComplianceDetails',$caseadminlists->applicantTrackingNo) }}" class="btn btn-success  btn-xs" data-toggle="tooltip" title="Complain Full Information ..."><span class="glyphicon glyphicon-eye-open"></span> </a>
                <a href="{{ route('comments',$caseadminlists->applicantTrackingNo) }}" class="btn btn-info  btn-xs" data-toggle="tooltip" title="Case Comments Summary"><i class="fa fa-file-text-o"></i> </a>
              </td>
            </tr>
            @endforeach
          </tbody>
      </table> 

    
    </div>
</div>

@endsection