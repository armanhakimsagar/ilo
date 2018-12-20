<?php use App\Http\Controllers\HomeController;?>
@extends('theme.default')
@section('content')


<div class="row" style="background-color: #00097c;color: #fff; margin-bottom: 10px">
    <div class="col-lg-12">
        <div class="panel-heading">User Create</div>
    </div>
    <!-- /.col-lg-12 -->
</div>





@if(Session::has('message')) 
    <div class="alert alert-info"> {{Session::get('message')}} </div> 
@endif

@if($errors->has('name')) 
    <div class="alert alert-info"> {{$errors->first('name')}} </div> 
@endif

@if($errors->has('full_name'))
  <div class="alert alert-info"> {{ $errors->first('full_name') }} </div>
@endif
@if($errors->has('dob'))
  <div class="alert alert-info"> {{ $errors->first('dob') }} </div>
@endif
@if($errors->has('gender'))
  <div class="alert alert-info"> {{ $errors->first('gender') }} </div>
@endif
@if($errors->has('street'))
  <div class="alert alert-info"> {{ $errors->first('street') }} </div>
@endif
@if($errors->has('city'))
  <div class="alert alert-info"> {{ $errors->first('city') }} </div>
@endif
@if($errors->has('state'))
  <div class="alert alert-info"> {{ $errors->first('state') }} </div>
@endif
@if($errors->has('postcode'))
  <div class="alert alert-info"> {{ $errors->first('postcode') }} </div>
@endif
@if($errors->has('cellphone'))
  <div class="alert alert-info"> {{ $errors->first('cellphone') }} </div>
@endif
@if($errors->has('telephone'))
  <div class="alert alert-info"> {{ $errors->first('telephone') }} </div>
@endif
@if($errors->has('contactnumber'))
  <div class="alert alert-info"> {{ $errors->first('contactnumber') }} </div>
@endif
@if($errors->has('alternatephone'))
  <div class="alert alert-info"> {{ $errors->first('alternatephone') }} </div>
@endif
@if($errors->has('email'))
  <div class="alert alert-info"> {{ $errors->first('email') }} </div>
@endif
@if($errors->has('empID'))
  <div class="alert alert-info"> {{ $errors->first('empID') }} </div>
@endif
@if($errors->has('department'))
  <div class="alert alert-info"> {{ $errors->first('department') }} </div>
@endif
@if($errors->has('designation'))
  <div class="alert alert-info"> {{ $errors->first('designation') }} </div>
@endif
@if($errors->has('empterm'))
  <div class="alert alert-info"> {{ $errors->first('empterm') }} </div>
@endif
@if($errors->has('password'))
  <div class="alert alert-info"> {{ $errors->first('password') }} </div>
@endif
@if($errors->has('status'))
  <div class="alert alert-info"> {{ $errors->first('status') }} </div>
@endif


<!-- /.row -->
<div class="row" style="background-color: #eee"">
    <div class="col-lg-6">
        {!! Form::open(array('url' => 'userCreate','method'=>'POST','files'=>true, 'id'=>'differentForm')) !!}
          <div class="form-group">
            <label class="required">User Name <span class="required" style="color: red">*</span></label>
            <input type="text" class="form-control" id="name" value="{{ old('name') }}"  pattern="[a-z A-Z]+" name="name" placeholder="Enter user name" maxlength="20" required="required" >
          </div>
          <div class="form-group">
            <label class="required">Full Name <span class="required" style="color: red">*</span></label>
            <input type="text" class="form-control" id="full_name" value="{{ old('full_name') }}" name="full_name" placeholder="Enter Full Name" maxlength="30" required="required">
          </div>
          <div class="form-group">
            <label class="required">Date of Birth <span class="required" style="color: red">*</span></label>
            <input type="date" onchange="date_compare()" value="{{ old('dob') }}" class="form-control" id="dob" name="dob" required>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Gender <span class="required" style="color: red">*</span></label>
            <select class="form-control" id="gender" name="gender" required>
              <option value="">Select Gender</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
              <option value="Others">Others</option>
            </select>
          </div>
          <h4>Contact Details</h4>
          <hr>
          <div class="form-group">
            <label class="required">Street Address</label>
            <textarea class="form-control" id="street" name="street" maxlength="150"></textarea>
          </div>
          <div class="form-group">
            <label class="required">City</label>
            <input type="text" class="form-control" id="city" name="city" maxlength="20" value="{{ old('city') }}">
          </div>
          <div class="form-group">
            <label class="required">State</label>
            <input type="text" class="form-control" id="state" name="state" maxlength="20" value="{{ old('state') }}">
          </div>
          <div class="form-group">
            <label class="required">Postal Code</label>
            <input type="text" class="form-control" id="postcode" name="postcode" maxlength="20" value="{{ old('postcode') }}">
          </div>
          <div class="form-group">
            <label class="required">Cellphone</label>
            <input type="text" class="form-control" id="cellphone" name="cellphone" maxlength="20" value="{{ old('cellphone') }}">
          </div>
          <div class="form-group">
            <label class="required">Telephone</label>
            <input type="text" class="form-control" id="telephone" name="telephone" maxlength="20" value="{{ old('telephone') }}">
          </div>
          <div class="form-group">
            <label class="required">Contact Number <span class="required" style="color: red">*</span></label>
            <input required type="text" class="form-control" id="contactnumber" name="contactnumber" value="{{ old('contactnumber') }}">
          </div>
          <div class="form-group">
            <label class="required">Alternate Phone</label>
            <input type="text" class="form-control" id="alternatephone" name="alternatephone" value="{{ old('alternatephone') }}">
          </div>
          <div class="form-group">
            <label class="required">Email Address <span class="required" style="color: red">*</span></label>
            <input required type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
          </div>
          <h4>Employee Details</h4>
          <hr>
          <div class="form-group">
            <label class="required">Employee ID</label><span class="required" style="color: red">*</span>
            <input type="text" class="form-control" id="empID" name="empID" required value="{{ old('empID') }}">
          </div>
          <div class="form-group">
            <label class="required">Department</label>
            <select class="form-control" id="department" name="department">
              <option value="A">Account</option>
              <option value="B">Admin</option>
              <option value="C">Operation</option>
            </select>
          </div>
          <div class="form-group">
            <label class="required">Designation<span class="required" style="color: red">*</span></label>
            <input type="text" class="form-control" id="designation" name="designation" maxlength="200" required value="{{ old('designation') }}">
          </div>
          <div class="form-group">
            <label class="required">Employee Term</label>
            <select class="form-control" id="empterm" name="empterm">
              <option value="Full Time">Full Time</option>
              <option value="Part Time">Part Time</option>
              <option value="Contractual">Contractual</option>
            </select>
          </div>
          <h4>Permission</h4>
          <hr>
          <div class="form-group">
            <label class="required">Password <span class="required" style="color: red">*</span></label>
            <input type="password" class="form-control" id="password" name="password" required="required">
          </div>
          <div class="form-group">
            <label class="required">Confirm Password <span class="required" style="color: red">*</span></label>
            <input required type="password" class="form-control" id="ConfirmPassword" name="ConfirmPassword">
            <div id="msg"></div>
          </div>
          <div class="form-group">
            <label class="required">Employee Status <span class="required" style="color: red">*</span></label>
            <select class="form-control" id="status" name="status" required>
              <option value="1">Active</option>
              <option value="2">Inactive</option>
            </select>
          </div>
          <h4>Group Permission <span class="required" style="color: red">*</span></h4>
          <div class="form-check">
            <select class="form-control" name="group_id" id="group_id" required="required" onclick="send()">
              <option value="">Select Group</option>
              @foreach($role as $roles)
                <option value="{{ $roles->group_id }}">{{ $roles->group_name }}</option>
              @endforeach
            </select>
          </div>
          <hr>
          <div class="permisionList"></div>
    </div>
    <div class="col-lg-6">
      <h4>Picture Upload</h4>
      <img src="{{ asset('images/profile_default.png')}}" id="profile-img-tag" class="img-thumbnail" style="width: 200px; height: 200px">
      <hr>
      <input type="file" id="image" name="image" class="form-control">
    </div>
</div>
<hr>
  <button type="submit" class="btn btn-primary">Save</button>
  {{ Form::close() }}
<hr>

@endsection

<script>

function zeroPad(num, places) {
  var zero = places - num.toString().length + 1;
  return Array(+(zero > 0 && zero)).join("0") + num;
}

function date_compare(){
   var todayDate = new Date();
  //need to add one to get current month as it is start with 0
  var todayMonth = zeroPad(todayDate.getMonth()+1,2);
  var todayDay = todayDate.getDate();
  var todayYear = todayDate.getFullYear();
  var close = document.getElementById("dob").value;
  var todayDateText = todayYear + "-" + todayMonth + "-" + todayDay;
  console.log(todayDateText+close);
  
  if(todayDateText < close){
    document.getElementById("dob").value = "";
    alert("your date of birth is greater than the current date");
  }

}


function send(){
      var group_id = $('#group_id').val();
      var dataString = '&group_id='+group_id;
      $.ajax({
        type: 'get',
        url: "{{ url('groupPermission') }}",
        data: dataString,

        success:function(response){
          console.log(response);
          if(response.length > 0){
            $(".permisionList").empty();
              for(i = 0; i< response.length; i++){
                //$(".permisionList").html('');
                var htmlTr ="<p><input type='checkbox' name='premision[]' value='"+response[i].permission_id+"' checked>"+response[i].permission_name+"</p>";
                  $(".permisionList").append(htmlTr);
              }
            }else{
                $(".permisionList").empty();
                var htmlTr= "<p></p>";
                $(".permisionList").html(htmlTr); 
            }
        }
      })
  }
</script>