
@extends('theme.default')
@section('content')

<div class="row" style="background-color: #00097c;color: #fff; margin-bottom: 10px">
    <div class="col-lg-12">
        <div class="panel-heading">User Full Information</div>
    </div>
    <!-- /.col-lg-12 -->
</div>


@if(Session::has('message')) 
    <div class="alert alert-info"> {{Session::get('message')}} </div> 
@endif
<!-- /.row -->

  <div class="row">
    <div class="col-lg-12">
          <form id="userForm" action="{{ url('userupdate') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
          <input type="hidden" name="user_id" value="{{ Auth::user()->empUserID }}">
          <div class="form-group">
            <div class="col-lg-3">
              <label for="exampleInputPassword1">Full Name:</label>
            </div>
            <div class="col-lg-6">
              <input type="text" name="fullName" class="form-control" id="exampleInputPassword1" value="{{ $user->fullName }}">
            </div>
          </div>
          <br><br><br>
          <div class="form-group">
            <div class="col-lg-3">
              <label for="exampleInputPassword1">Date of Birth:</label>
            </div>
            <div class="col-lg-6">
              <input readonly type="date" class="form-control" onchange="date_compare()" name="dob" id="dob" value="{{ $user->DOB }}">
            </div>
          </div>
          <br><br>
          <div class="form-group">
            <div class="col-lg-3">
              <label for="exampleInputPassword1">Gender:</label>
            </div>
            <div class="col-lg-6">
              Male : <input type="radio" name="gender" value="Male" id="exampleInputPassword1"
              @if($user->gender == "Male") 
                {{ "checked" }} 
              @endif
              >
              Female : <input type="radio" name="gender" value="Female" id="exampleInputPassword1">
            </div>
          </div>
          <br><br>
          <div class="form-group">
            <div class="col-lg-3">
              <label for="exampleInputPassword1">Street Address:</label>
            </div>
            <div class="col-lg-6">
              <input type="text" class="form-control" name="streetAddress" id="exampleInputPassword1" value="{{ $user->streetAddress }}">
            </div>
          </div>
          <br><br>
          <div class="form-group">
            <div class="col-lg-3">
              <label for="exampleInputPassword1">City:</label>
            </div>
            <div class="col-lg-6">
              <input type="text" class="form-control" name="city" id="exampleInputPassword1"  value="{{ $user->city }}">
            </div>
          </div>

          <br><br>
          <div class="form-group">
            <div class="col-lg-3">
              <label for="exampleInputPassword1">Postal Code:</label>
            </div>
            <div class="col-lg-6">
              <input type="text" value="{{ $user->postalCode }}" name="postalCode" class="form-control" id="exampleInputPassword1" >
            </div>
          </div>
          <br><br>
          <div class="form-group">
            <div class="col-lg-3">
              <label for="exampleInputPassword1">Cellphone:</label>
            </div>
            <div class="col-lg-6">
              <input type="text" class="form-control" name="cellphone" id="exampleInputPassword1" value="{{ $user->cellphone }}">
            </div>
          </div>
          <br><br>
          <div class="form-group">
            <div class="col-lg-3">
              <label for="exampleInputPassword1">Telephone:</label>
            </div>
            <div class="col-lg-6">
              <input type="text" class="form-control" name="telePhone" id="exampleInputPassword1"  value="{{ $user->telePhone }}">
            </div>
          </div>
          <br><br>
          <div class="form-group">
            <div class="col-lg-3">
              <label for="exampleInputPassword1">Contact Number:</label>
            </div>
            <div class="col-lg-6">
              <input type="text" class="form-control" name="contactNumber" id="exampleInputPassword1" value="{{ $user->contactNumber }}">
            </div>
          </div>
          <br><br>
          <div class="form-group">
            <div class="col-lg-3">
              <label for="exampleInputPassword1">Alternate Phone:</label>
            </div>
            <div class="col-lg-6">
              <input type="text" class="form-control" name="alternatePhone" id="exampleInputPassword1"  value="{{ $user->alternatePhone }}">
            </div>
          </div>
          <br><br>
          <div class="form-group">
            <div class="col-lg-3">
              <label for="exampleInputPassword1">Email Address:</label>
            </div>
            <div class="col-lg-6">
              <input type="text" class="form-control" name="email" id="exampleInputPassword1"  value="{{ $user->email }}">
            </div>
          </div>
          <br><br>
          <div class="form-group">
            <div class="col-lg-3">
              <label for="exampleInputPassword1">Image :</label>
            </div>
            <div class="col-lg-6">
              <input type="file" name="image" class="form-control">
            </div>
          </div>
          <br><br>
          <div class="form-group">
            <div class="col-lg-6">
              <input type="submit" value="update" name="submit" class="btn btn-success">
            </div>
          </div>
          <br><br><br>
    </div>
  </div>

@endsection
<script type="text/javascript">
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
  //alert(todayDateText+close);
  
  if(todayDateText < close){
    document.getElementById("dob").value = "";
    alert("your date of birth is greater than the current date");
  }
}
</script>

