<?php use App\Http\Controllers\HomeController;?>
@extends('theme.default')
@section('content')

<div class="row" style="background-color: #00097c;color: #fff; margin-bottom: 10px">
    <div class="col-lg-12">
        <div class="panel-heading">Edit Case Filing Step</div>
    </div>
    <!-- /.col-lg-12 -->
</div>




@if(Session::has('message')) 
    <div class="alert alert-info"> {{Session::get('message')}} </div> 
@endif
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
      <div class="col-lg-4">
          {!! Form::open(array('url' => 'update','method'=>'POST')) !!}
            <div class="form-group">
              <input type="hidden" name="stepid" value="{{ $stepname->stepId }}">
              <label for="exampleInputEmail1">Step Name</label>
              <input type="text" class="form-control" id="step_name" name="step_name" placeholder="Enter Step name" value="{{ $stepname->stepName }}">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Step Serial</label>
              <input type="number" class="form-control" id="step_serial" name="step_serial" min="1" value="{{ $stepname->stepSL }}">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Description</label>
              <textarea  class="form-control" id="step_des" name="step_des" maxlength="100">{{ $stepname->stepDescription }}</textarea>
            </div>
            <h3><u>Assign User</u></h3>
            <div class="form-check">
                
                  @foreach($user as $users)
                    <label class="form-check-label">
                      <input type="checkbox" id="user[]" name="user[]" value="{{ $users->empUserId }}" <?php 
                        $caseUserStep = HomeController::getCaseFileUserSTep($stepname->stepId,$users->empUserId);
                        if($caseUserStep > 0){ echo " checked=\"checked\""; } 
                      ?>> <span onclick="return false">{{ " ".$users->fullName }} ( {{$users->designation}} )</span><br>
                    </label> <br>
                  @endforeach
                
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
          {{ Form::close() }}
      </div>
      <div class="col-lg-8">
        @foreach($step as $steps)
        <div class="panel panel-primary">
            <div class="panel-heading text-center" style="height: 60px;background-color: #00097c;">

                <h4 class="panel-title pull-left" style="padding-top: 7.5px;"><button class="btn btn-default">{{ $steps->stepSL }}</button> {{ $steps->stepName }}</h4>
                
            </div>
            <div class="panel-body">
              @foreach($stepuser as $stepusers)
                @if($steps->stepId == $stepusers->stepId)
                  <?php $userName = HomeController::getName($stepusers->empUserId); ?>
                  <p><b>Name : </b>{{ $userName['fullName'] }}</p>
                @endif
              @endforeach
            </div>
        </div>
        @endforeach
    </div>
    <hr>
</div>

@endsection