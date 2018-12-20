<?php use App\Http\Controllers\HomeController;?>
@extends('theme.default')
@section('content')



<div class="row" style="background-color: #00097c;color: #fff; margin-bottom: 10px">
    <div class="col-lg-12">
        <div class="panel-heading">Case Filing Step</div>
    </div>
    <!-- /.col-lg-12 -->
</div>




@if(Session::has('message')) 
    <div class="alert alert-info"> {{Session::get('message')}} </div> 
@endif



@if($errors->has('step_name'))
  <div class="alert alert-info"> {{ $errors->first('step_name') }} </div>
@endif
@if($errors->has('step_des'))
  <div class="alert alert-info"> {{ $errors->first('step_des') }} </div>
@endif
@if($errors->has('step_serial'))
  <div class="alert alert-info"> {{ $errors->first('step_serial') }} </div>
@endif



<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
      <div class="col-lg-4">
          {!! Form::open(array('url' => 'StepCreate','method'=>'POST')) !!}
            <div class="form-group">
              <label for="exampleInputEmail1">Step Name</label>
              <input type="text" class="form-control" id="step_name" name="step_name" placeholder="Enter Step name" required="required">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Step Serial</label>
              <input type="number" class="form-control" id="step_serial" name="step_serial" min="1" required="required">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Description</label>
              <textarea  class="form-control" id="step_des" name="step_des" maxlength="100"></textarea>
            </div>
            <h3><u>Assign User</u></h3>
            <div class="form-check">
               <!--  <label class="form-check-label"> -->
                  @foreach($user as $users)
                      <input class="form-check-input" type="checkbox" name="user[]" value="{{ $users->empUserId }}"> 
                      {{ " ".$users->fullName }} ( {{$users->designation}} )
                      
                      <br>
                  @endforeach

                <!-- </label> -->
            </div>
            <br>
            
            


            <button type="submit" class="btn btn-primary">Save</button>
          {{ Form::close() }}
      </div>
      <div class="col-lg-8">
        @foreach($step as $steps)
        <div class="panel panel-primary">
            <div class="panel-heading text-center" style="height: 60px; background-color: #00097c">
                
                <h4 class="panel-title pull-left" style="padding-top: 7.5px;height: 50px">
                  <button class="btn btn-default">{{ $steps->stepSL }}</button>
                  {{ $steps->stepName }}
                  
                </h4>
                
                 <div class="pull-right">

                    <a href="{{ URL::to('edit/'.$steps->stepId) }}" class="btn btn-default" role="button"><i class="fa fa-pencil-square-o"></i></a>
                 </div>
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
</div>

@endsection