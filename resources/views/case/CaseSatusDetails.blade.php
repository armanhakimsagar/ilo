@extends('theme.default')
@section('content')

<?php use App\Http\Controllers\HomeController;?>
<style type="text/css">
  .btn-success{
    margin-bottom: 10px;
  }
</style>

<div class="row" style="background-color: #00097c;color: #fff; margin-bottom: 10px">
    <div class="col-lg-12">
        <div class="panel-heading">Case Status Details</div>
    </div>
    <!-- /.col-lg-12 -->
</div>

<!-- /.row -->
<div class="row" style=" background-color: #eee; padding: 20px 0px 0px 0px">
      <div class="col-lg-12" style="background-color: #ccc;color: #000; margin-bottom: 10px">
        <div class="panel-heading"><b>Tracking Details of:{{ $id }} </b>
        <a class="btn btn-success" style="float: right;" href="{{ url('userAdd/'.$datas->tracking_no.'/'.$datas->stepId) }}" style="color: #fff">
            <span class="glyphicon glyphicon-tags"></span>
        </a>
        </div>
      </div>
      @foreach($casefiling_user_assign as $datas)
      <div class="col-lg-3" style="height: 200px">
      <div class="panel panel-default">
        <div class="panel-heading">
          <b>Visual Status:</b>@if($datas->visual_status == 0)
            <span class="label label-danger">Not Seen Yet</span>
          @else
            <span span class="label label-success">Seen</span>
          @endif
          
        </div>
        <div class="panel-body">
          <p><b>Assigned User:</b><?php echo HomeController::getIdToNameAppUser($datas->empUserId)->fullName; ?> </p>
          <p><b>Group name:</b><?php echo HomeController::stepIdToName($datas->stepId)->stepName; ?> </p>
          <p><b>Assign by:</b><?php echo HomeController::getIdToNameAppUser($datas->assign_by)->fullName;  ?> </p>
        </div>
      </div>
      </div>
      @endforeach
        
    
</div>

@endsection