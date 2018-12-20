@extends('theme.default')
@section('content')

<div class="row" style="background-color: #00097c;color: #fff; margin-bottom: 10px">
    <div class="col-lg-12">
        <div class="panel-heading">Group</div>
    </div>
    <!-- /.col-lg-12 -->
</div>



@if(Session::has('message')) 
    <div class="alert alert-info"> {{Session::get('message')}} </div> 
@endif

@if($errors->has('group_name'))
  <div class="alert alert-info"> {{ $errors->first('group_name') }} </div>
@endif

@if($errors->has('group_des'))
  <div class="alert alert-info"> {{ $errors->first('group_des') }} </div>
@endif


<!-- /.row -->
<div class="row" style="background-color: #eee">
  {!! Form::open(array('url' => 'groupCreate','method'=>'POST')) !!}
    <div class="col-lg-8">
          <div class="form-group">
            <label for="exampleInputEmail1">Group Name</label>
            <input type="text" class="form-control" id="group_name" name="group_name" placeholder="Enter group name" maxlength="100" required="required">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Description</label>
            <textarea  class="form-control" id="group_des" name="group_des" maxlength="500"></textarea>
          </div>
    </div>
    <div class="col-lg-4"></div>
    <div class="col-lg-8">
      <h3><u>Assign Permission</u></h3>
      @foreach($role as $roles)
        <input class="form-check-input" type="checkbox" id="permission[]" name="permission[]" value="{{ $roles->permission_id }}"> {{ $roles->permission_name }}<br>
      @endforeach
      <input class="form-check-input" type="checkbox" id="selectAll"> Select All
      <br><br>
      <button type="submit" class="btn btn-primary">Save</button>
    </div>
    
    <script type="text/javascript">
      $("#selectAll").click(function(){
          $('input:checkbox').not(this).prop('checked', this.checked);
      });
    </script>

    <div class="col-lg-4"></div>
  {{ Form::close() }}
</div>

@endsection