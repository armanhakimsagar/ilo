@extends('theme.default')
@section('content')

<div class="row" style="background-color: #00097c;color: #fff; margin-bottom: 10px">
    <div class="col-lg-12">
        <div class="panel-heading">Announcement Create</div>
    </div>
    <!-- /.col-lg-12 -->
</div>
@if($errors->has('title'))
  <div class="alert alert-info"> {{ $errors->first('title') }} </div>
@endif
@if($errors->has('description'))
  <div class="alert alert-info"> {{ $errors->first('description') }} </div>
@endif
@if($errors->has('docuName'))
  <div class="alert alert-info"> {{ $errors->first('docuName') }} </div>
@endif


<!-- /.row -->
<div class="row" style="background-color: #eee">
    <div class="col-lg-6">
        {!! Form::open(array('url' => 'announceCreate','method'=>'POST','files'=>true, 'id'=>'differentForm','onSubmit'=>'ck_validate()')) !!}
          <div class="form-group">
            <label class="required">Announcement Publish Date <span class="required" style="color: red">*</span></label>
            <input type="date" class="form-control" id="publishDate" min="<?php  echo date('Y-m-d'); ?>" name="publishDate" required>
          </div>
          <div class="form-group">
            <label class="required">Announcement Closing Date <span class="required" style="color: red">*</span></label>
            <input type="date" class="form-control" onchange="date_compare()" id="closingDate" name="closingDate" min="<?php  echo date('Y-m-d'); ?>" required>
          </div>
          
    </div>
    <div class="col-lg-6">
          <div class="form-group">
            <label class="required">Priority <span class="required" style="color: red">*</span></label>
            <select class="form-control" name="priority" id="priority">
              <option value="Normal">Normal</option>
              <option value="Urgent">Urgent</option>
              <option value="Very Urgent">Very Urgent</option>
            </select>
          </div>
          <div class="form-group" id="person_show" style="display: none;">
            <label class="required">Select Person <span class="required" style="color: red">*</span></label>
            <select class="form-control" name="empUserId"> 
              @foreach($user as $users)
                <option value="{{ $users->empUserId }}">{{ $users->fullName }}</option>
              @endforeach
            </select>
            <input type="hidden" name="my_data" value="">
          </div>
          <div class="form-group">
            <label class="required">Announcement Category <span class="required" style="color: red">*</span></label><br>
            <label class="radio-inline">
              <input type="radio" name="optradio"  value="public" checked="checked" onclick="show_public();"> Public </label>
            <label class="radio-inline">
              <input type="radio" name="optradio" value="person" onclick="show_person();"> Individual </label>
          </div>
    </div>
    <div class="col-lg-12">
      <!--
      <div class="form-group">
        <label class="required">Document Upload </label>
        <input type="file" name="docuName" id="docuName" class="form-control">
      </div>
      -->
      <div class="form-group">
        <label class="required">Announcement Title <span class="required" style="color: red">*</span></label>
        <input type="text" class="form-control" name="title" id="title" required maxlength="200">
      </div>
      <div class="form-group">
        <label class="required">Announcement Details<span class="required" style="color: red">*</span></label>
        <textarea class="form-control" style="height: 300px" name="description" required maxlength="500"></textarea>
      </div>
    </div>
</div>
    

<hr>
  <button type="submit" class="btn btn-primary" name="assign" id="assign">Save</button>
  {{ Form::close() }}
<hr>

@endsection
<script type="text/javascript">
$(document).ready(function() {
    $("#announceUser").click(function(){
        var countries = [];
        $.each($("#announceUser option:selected"), function(){            
            countries.push($(this).val());
        });
        alert("You have selected the country - " + countries.join(", "));
    });
});

function date_compare(){
  var close = document.getElementById("closingDate").value;
  var open = document.getElementById("publishDate").value;
  if(open > close){
    document.getElementById("closingDate").value = "";
    alert("your closing date is greater than the publish date");
  }
}
</script>