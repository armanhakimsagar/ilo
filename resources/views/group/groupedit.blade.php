<?php use App\Http\Controllers\HomeController;?>
@extends('theme.default')
@section('content')


<div class="row" style="background-color: #00097c;color: #fff; margin-bottom: 10px">
    <div class="col-lg-12">
        <div class="panel-heading">Group Edit</div>
    </div>
    <!-- /.col-lg-12 -->
</div>


@if(Session::has('message')) 
    <div class="alert alert-info"> {{Session::get('message')}} </div> 
@endif
<!-- /.row -->
<div class="row">
  {!! Form::open(array('url' => 'groupUpdate','method'=>'POST')) !!}
    <div class="col-lg-8">
          <div class="form-group">
            <input type="hidden" name="id" value="{{ $group->group_id }}">
            <label for="exampleInputEmail1">Group Name</label>
            <input type="text" class="form-control" id="group_name" name="group_name" maxlength="100" required="required" value="{{ $group->group_name }}">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Description</label>
            <textarea  class="form-control" id="group_des" name="group_des" maxlength="500">{{ $group->description }}</textarea>
          </div>
    </div>
    <div class="col-lg-4"></div>
    <div class="col-lg-8">
      <h3><u>Assign Permission</u></h3>
      @foreach($role as $roles)
        <input class="form-check-input" type="checkbox" name="permission[]" value="{{ $roles->permission_id }}"
              <?php 
                $roleInfo = HomeController::getGroupPermission($group->group_id,$roles->permission_id);
                if($roleInfo > 0){ echo " checked=\"checked\""; } 
              ?>>{{ " ".$roles->permission_name }}<br>
      @endforeach
      <br>
      <button type="submit" class="btn btn-primary">Update</button>
  {{ Form::close() }}
    </div>
    <div class="col-lg-4"></div>

</div>

@endsection