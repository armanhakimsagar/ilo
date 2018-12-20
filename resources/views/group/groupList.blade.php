<?php use App\Http\Controllers\HomeController;?>
@extends('theme.default')
@section('content')

<div class="row" style="background-color: #00097c;color: #fff; margin-bottom: 10px">
    <div class="col-lg-12">
        <div class="panel-heading">Access Permission Name List</div>
    </div>
    <!-- /.col-lg-12 -->
</div>


@if(Session::has('message')) 
    <div class="alert alert-info"> {{Session::get('message')}} </div> 
@endif
<!-- /.row -->

<div class="row" style="background-color: #eee">
    <div class="col-lg-12">
        <table id="example2" class="group table table-striped table-bordered nowrap">
          <thead>
            <tr>
              <th style="display: none">SL.</th>
              <th>Access Name</th>
              <th>Description</th>
              <th>Permission List</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($grouplist as $grouplists)
              <tr>
                <td style="display: none">
                  <?php 
                  
                      $sl = HomeController::getGroupNameToSL($grouplists->group_name);
                      
                      echo $sl['stepSL']; 
                  ?>
                </td>
                <td>{{ $grouplists->group_name }}</td>
                <td>{{ $grouplists->description }}</td>
                <td>
                <?php $Permission = HomeController::getGroupPermissionList($grouplists->group_id); ?>
                <ul>
                @foreach($Permission as $Permissions)
                  <li>{{ $Permissions->permission_name }}</li>
                @endforeach
                </ul>
                </td>
                <td width="7%">
                  <a href="{{ route('groupEdit',$grouplists->group_id) }}"><i class="fa fa-edit"></i></a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
    </div>
</div>


@endsection