<?php use App\Http\Controllers\HomeController;?>
@extends('theme.default')
@section('content')


<div class="row" style="background-color: #00097c;color: #fff; margin-bottom: 10px">
    <div class="col-lg-12">
        <div class="panel-heading"> User Edit</div>
    </div>
    <!-- /.col-lg-12 -->
</div>




@if(Session::has('message')) 
    <div class="alert alert-info"> {{Session::get('message')}} </div> 
@endif
<!-- /.row -->
<div class="row">
    <div class="col-lg-6">
        {!! Form::open(array('url' => 'user_update_by_admin','method'=>'POST','files'=>true, 'id'=>'differentForm')) !!}
          <input type="hidden" name="empUserId" value="{{ $user->empUserId }}">
          <div class="form-group">
            <label class="required">User Name </label>
            <input type="text" class="form-control" id="user_name" name="user_name" value="{{ $user->userName }}" readonly="readonly">
          </div>
          <div class="form-group">
            <label class="required">Full Name <span class="required" style="color: red">*</span></label>
            <input type="text" class="form-control" id="full_name" name="full_name" value="{{ $user->fullName }}">

            <input type="hidden" class="form-control" id="id" name="id" value="{{ $user->id }}">
          </div>
          <div class="form-group">
            <label class="required">Date of Birth </label>
            <input type="date" class="form-control" id="dob" name="dob" value="{{ $user->DOB }}" readonly="readonly">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Gender <span class="required" style="color: red">*</span></label>
            <select class="form-control" id="gender" name="gender">
              <option value="">Select Gender</option>
              <option value="Male" <?php if ($user->gender == 'Male'){ echo " selected=\"selected\""; }?>>Male</option>
              <option value="Female" <?php if ($user->gender == 'Female'){ echo " selected=\"selected\""; }?>>Female</option>
              <option value="Others" <?php if ($user->gender == 'Others'){ echo " selected=\"selected\""; }?>>Others</option>
            </select>
          </div>
          <h4>Contact Details</h4>
          <hr>
          <div class="form-group">
            <label class="required">Street Address</label>
            <textarea class="form-control" id="street" name="street" maxlength="150">{{ $user->streetAddress }}</textarea>
          </div>
          <div class="form-group">
            <label class="required">City</label>
            <input type="text" class="form-control" id="city" name="city" maxlength="20" value="{{ $user->city }}">
          </div>
          <div class="form-group">
            <label class="required">State</label>
            <input type="text" class="form-control" id="state" name="state" maxlength="20" value="{{ $user->state }}">
          </div>
          <div class="form-group">
            <label class="required">Postal Code</label>
            <input type="text" class="form-control" id="postcode" name="postcode" maxlength="20" value="{{ $user->postalCode }}">
          </div>
          <div class="form-group">
            <label class="required">Cellphone</label>
            <input type="text" class="form-control" id="cellphone" name="cellphone" maxlength="20" value="{{ $user->cellphone }}">
          </div>
          <div class="form-group">
            <label class="required">Telephone</label>
            <input type="text" class="form-control" id="telephone" name="telephone" maxlength="20" value="{{ $user->telePhone }}">
          </div>
          <div class="form-group">
            <label class="required">Contact Number</label>
            <input type="text" class="form-control" id="contactnumber" name="contactnumber" value="{{ $user->contactNumber }}">
          </div>
          <div class="form-group">
            <label class="required">Alternate Phone</label>
            <input type="text" class="form-control" id="alternatephone" name="alternatephone" value="{{ $user->alternatePhone }}">
          </div>
          <div class="form-group">
            <label class="required">Email Address </label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" readonly>
          </div>
          <h4>Employee Details</h4>
          <hr>
          <div class="form-group">
            <label class="required">Employee ID<span class="required" style="color: red">*</span></label>
            <input type="text" class="form-control" id="empID" name="empID"  value="{{ $user->employeeId }}" required>
          </div>
          <div class="form-group">
            <label class="required">Department</label>
            <select class="form-control" id="department" name="department">
              <option value="A" <?php if ($user->department == 'A'){ echo " selected=\"selected\""; }?>>Account</option>
              <option value="B" <?php if ($user->department == 'B'){ echo " selected=\"selected\""; }?>>Admin</option>
              <option value="C" <?php if ($user->department == 'C'){ echo " selected=\"selected\""; }?>>Operation</option>
            </select>
          </div>
          <div class="form-group">
            <label class="required">Designation<span class="required" style="color: red">*</span></label>
            <input type="text" class="form-control" id="designation" name="designation" maxlength="200" value="{{ $user->designation }}" required>
          </div>
          <div class="form-group">
            <label class="required">Employee Term</label>
            <select class="form-control" id="empterm" name="empterm">
              <option value="Full Time" <?php if ($user->employeeTerm == 'Full Time'){ echo " selected=\"selected\""; }?>>Full Time</option>
              <option value="Part Time" <?php if ($user->employeeTerm == 'Part Time'){ echo " selected=\"selected\""; }?>>Part Time</option>
              <option value="Contractual" <?php if ($user->employeeTerm == 'Contractual'){ echo " selected=\"selected\""; }?>>Contractual</option>
            </select>
          </div>
          <div class="form-group">
            <label class="required">Employee Status <span class="required" style="color: red">*</span></label>
            <select class="form-control" id="status" name="status" required="required">
              <option value="1" <?php if ($user->status == '1'){ echo " selected=\"selected\""; }?>>Active</option>
              <option value="2" <?php if ($user->status == '2'){ echo " selected=\"selected\""; }?>>Inactive</option>
            </select>
          </div>
          <h4>Current Group Permission</h4>
          <?php $roleInfo = HomeController::getGroupName($user->empUserId);?>
          <?php $GroupPermission = HomeController::getGroupPermissionName($user->empUserId); ?>
          @if($roleInfo != null)
            <div class="panel panel-default">
              <div class="panel-heading">{{ $roleInfo->group_name }}</div>
              <div class="panel-body">
                @foreach($GroupPermission as $GroupPermissions)
                  <ul>
                    <li> {{ $GroupPermissions->permission_name }}</li>
                  </ul>
                @endforeach
              </div>
            </div>
          @else
            {{ "No Group Assign" }}
          @endif              
          <h4>New Group Permission</h4>
          <div class="form-check">
            <select class="form-control" name="group_id" id="group_id" onclick="send()">
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
      <h4>Picture Uplaod</h4>
      <input type="hidden" name="old_img_name" value="{{ $user->userImg }}">
        <img src="{{ asset('images/'.$user->userImg)}}" id="profile-img-tag" class="img-thumbnail" style="width: 200px; height: 200px">
      <hr>
      <input type="file" id="image" name="image" class="form-control">
    </div>
</div>
<hr>
  <button type="submit" class="btn btn-primary">Update</button>
  {{ Form::close() }}
<hr>

@endsection
<script>
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
                var htmlTr= "<p>No Permission Assign ...</p>";
                $(".permisionList").html(htmlTr); 
            }
        }
      })
  }
</script>