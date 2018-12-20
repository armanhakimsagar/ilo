@extends('theme.default')
@section('content')

<style type="text/css">
  .low{
    background-color:rgb(144, 226, 126)
  }
  .medium{
    background-color:rgb(130, 186, 234)
  }
  .high{
    background-color:rgb(230, 162, 90)
  }
</style>
<div class="row" style="background-color: #00097c;color: #fff; margin-bottom: 10px">
    <div class="col-lg-12">
        <div class="panel-heading">To Do Create</div>
    </div>
    <!-- /.col-lg-12 -->
</div>

@if(Session::has('message')) 
    <div class="alert alert-info"> {{Session::get('message')}} </div> 
@endif


<!-- /.row -->
<div class="row" style="background-color: #eee">
    <div class="col-lg-12">
        {!! Form::open(array('url' => 'todoCreate','method'=>'POST','files'=>true, 'id'=>'differentForm')) !!}

          <div class="form-group">
            <label class="required">Task  <span class="required" style="color: red">*</span></label>
            <input type="text" class="form-control" id="title" name="title" required>
          </div>
          <div class="form-group">
            <label class="required">Task date <span class="required" style="color: red">*</span></label>
            <input type="date" class="form-control" id="taskDate" name="taskDate" required min="<?php echo date('Y-m-d'); ?>">
          </div>
          <div class="form-group">
            <label class="required">Priority <span class="required" style="color: red">*</span></label>
            <select required class="form-control" name="priority" id="priority">
              <option value="Normal">Normal</option>
              <option value="Urgent">Urgent</option>
              <option value="Very Urgent">Very Urgent</option>
            </select>
          </div>

    </div>
</div>

<hr>
  <button type="submit" class="btn btn-primary" name="assign" id="assign">Save</button>
  {{ Form::close() }}
<hr>

<div class="row" style="background-color: #eee">
    <div class="col-lg-12">

      <div class="row" style="background-color: #00097c;color: #fff; margin-bottom: 10px">
          <div class="col-lg-12">
              <div class="panel-heading">All Tasks</div>
          </div>
          <!-- /.col-lg-12 -->
      </div>
      <table class="table">
        <tr>  
          <td><b>Task</b></td>
          <td><b>Task Date</b></td>
          <td><b>Priority</b></td>
        </tr>
        @foreach($todolist as $todolists)
          <tr class="@if($todolists->priority == 'Normal') {{ 'low' }} @elseif($todolists->priority == 'Urgent') {{ 'medium' }} @else {{ 'high' }} @endif">
            <td>{{ $todolists->task }}</td>
            <td>{{ $todolists->taskDate }}</td>
            <td>{{ $todolists->priority }}</td>
          </tr>
        @endforeach

      </table>
      {{ $todolist->links() }}

    </div>
</div>


@endsection