<?php use App\Http\Controllers\HomeController;?>
@extends('theme.default')
@section('content')


<div class="row" style="background-color: #00097c;color: #fff; margin-bottom: 10px">
    <div class="col-lg-12">
        <div class="panel-heading"> User List</div>
    </div>
    <!-- /.col-lg-12 -->
</div>




@if(Session::has('message')) 
    <div class="alert alert-info"> {{Session::get('message')}} </div> 
@endif
<!-- /.row -->
<div class="row" style="background-color: #eee;">
    <div class="col-lg-12">
        <table id="example" class="display_user table table-striped table-bordered nowrap">
          <thead>
            <tr>
              <th>User Picture</th>
              <th>User Name</th>
              <th>Full Name</th>
              <th>E-mail</th>
              <th>Gender</th>
              <th>Contact Number</th>
              <th>Group Name</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($userlist as $userlists)
              <tr>
                <td>
                  @if(empty($userlists->userImg))
                    <img src="{{ asset('images/profile_default.png')}}" class="img-thumbnail" style="width: 60px; height: 60px">
                  @else
                    <img src="{{ asset('images/'.$userlists->userImg)}}" class="img-thumbnail" style="width: 60px; height: 60px">
                  @endif
                </td>
                <td>{{ $userlists->userName }}</td>
                <td>{{ $userlists->fullName }}</td>
                <td>{{ $userlists->email }}</td>
                <td>{{ $userlists->gender }}</td>
                <td>{{ $userlists->contactNumber }}</td>
                <td>
                  <?php $groupName = HomeController::getGroupName($userlists->empUserId); ?>
                  @if(isset($groupName))
                    {{ $groupName->group_name }}
                  @else
                    {{ "No Group Assign" }}
                  @endif
                </td>
                <td>
                  @if($userlists->status == 1 )
                    Active
                  @else
                    Inactive
                  @endif
                </td>
                <td>
                  <a href="{{ route('userEdit',$userlists->empUserId ) }}"><i class="fa fa-edit"></i></a>
                  <!--<a href="{{ URL::to('userDestroy/'.$userlists->empUserId ) }}"><i class="fa fa-trash"></i></a>-->
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
    </div>
</div>

@endsection
