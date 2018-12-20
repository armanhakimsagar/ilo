@extends('theme.default')
@section('content')

<?php use App\Http\Controllers\HomeController;?>

<div class="row" style="background-color: #00097c;color: #fff; margin-bottom: 10px">
    <div class="col-lg-12">
        <div class="panel-heading">Add Or Replace User</div>
    </div>
</div>


<!-- /.row -->
<div class="row" style=" background-color: #eee; padding: 20px 0px 0px 0px">
@if(Session::has('duplicate'))
    <div class="alert alert-danger"> {{Session::get('duplicate')}} </div> 
@endif

@if(Session::has('success'))
    <div class="alert alert-success"> {{Session::get('success')}} </div> 
@endif
<div class="row" style="padding-left: 15px">
 <div class="col-lg-6" >   
    <h4>Assigned User List</h4>
    <table class="table table-bordered">
       
       @foreach($userList as $userLists)
       <tr>
          <td>
              <?php 
                echo HomeController::getIdToNameAppUser($userLists->empUserId)->fullName;
                $stepId = HomeController::getIdToGroup($userLists->empUserId)->stepId;
                echo " (". HomeController::getGroupIdToGroupName($stepId)->stepName.")";
              ?>
          </td>
       </tr>
       @endforeach
      
    </table>
  </div>
   <div class="col-lg-6">  
    <h4>Replace Assigned User</h4>
    <form action="{{ url('addUser') }}" method="post">
      {{ csrf_field() }}
      <input type="hidden" name="tracking_no" value="{{ $trackingNo }}">

      <select class="form-control" name="ReplaceBy" required style="width: 90%">
        <option value="">Replace By</option>
        @foreach($stepusers as $stepuser)
          <option value="{{ $stepuser->empUserId }}">
            <?php 
                echo HomeController::getIdToNameAppUser($stepuser->empUserId)->fullName;
                $stepId = HomeController::getIdToGroup($stepuser->empUserId)->stepId;
                echo " (". HomeController::getGroupIdToGroupName($stepId)->stepName.")";
              ?>
          </option>
        @endforeach
      </select>

      <br>
      <select class="form-control" name="ReplaceTo" required style="width: 90%">
        <option value="">Replace To</option>
        @foreach($stepusers as $stepuser)
          <option value="{{ $stepuser->empUserId }}">
            <?php 
                echo HomeController::getIdToNameAppUser($stepuser->empUserId)->fullName;
                $stepId = HomeController::getIdToGroup($stepuser->empUserId)->stepId;
                echo " (". HomeController::getGroupIdToGroupName($stepId)->stepName.")";
              ?>
          </option>
        @endforeach
      </select>
      <br>
      <input type="submit" name="submit" value="Replace" class="btn btn-success">
    </form>
  </div>
</div>
<div class="row" style="padding-left: 15px">
  <div class="col-lg-6">
    <h4>Removed User List</h4>
    <table class="table table-bordered">
       
       @foreach($removeList as $userLists)
       <tr>
          <td>
              <?php 
                echo HomeController::getIdToNameAppUser($userLists->empUserId)->fullName;
                $stepId = HomeController::getIdToGroup($userLists->empUserId)->stepId;
                echo " (". HomeController::getGroupIdToGroupName($stepId)->stepName.")";
              ?>
          </td>
       </tr>
       @endforeach
      
    </table>
  </div>
  <div class="col-lg-6" style="height: 200px">
  <br><br>  
    <h4>Remove user from this case:</h4>
    <form action="{{ url('inactiveUser') }}" method="post">
      {{ csrf_field() }}
      <input type="hidden" name="tracking_no" value="{{ $trackingNo }}">
      <br>
      <select class="form-control" name="ReplaceTo" required style="width: 90%">
        <option value="">Select user for inactive</option>
        @foreach($stepusers as $stepuser)
          <option value="{{ $stepuser->empUserId }}">
            <?php 
                echo HomeController::getIdToNameAppUser($stepuser->empUserId)->fullName;
                $stepId = HomeController::getIdToGroup($stepuser->empUserId)->stepId;
                echo " (". HomeController::getGroupIdToGroupName($stepId)->stepName.")";
              ?>
          </option>
        @endforeach
      </select>
      <br>
      <input type="submit" name="submit" value="Remove" class="btn btn-danger">
    </form>
  </div>
</div>
</div>

@endsection