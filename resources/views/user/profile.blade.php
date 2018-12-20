<?php use App\Http\Controllers\HomeController;?>
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

    <div class="col-lg-6">

          <div class="form-group">
            <label class="required"><b>User Name :</b> {{ $user->userName }}</label>
          </div>
          <div class="form-group">
            <label class="required"><b>Full Name :</b> {{ $user->fullName }}</label>
          </div>
          <div class="form-group">
            <label class="required"><b>Date of Birth :</b> {{ $user->DOB }}</label>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1"><b>Gender :</b> {{ $user->gender }}</label>
          </div>
          <h4>Contact Details</h4>
          <hr>
          <div class="form-group">
            <label class="required"><b>Street Address : </b> {{ $user->streetAddress }}</label>
          </div>
          <div class="form-group">
            <label class="required"><b>City :</b> {{ $user->city }}</label>
          </div>
          <div class="form-group">
            <label class="required"><b>Postal Code :</b> {{ $user->postalCode }}</label>
          </div>
          <div class="form-group">
            <label class="required"><b>Cellphone :</b> {{ $user->cellphone }}</label>
          </div>
          <div class="form-group">
            <label class="required"><b>Telephone : </b> {{ $user->telePhone }}</label>
          </div>
          <div class="form-group">
            <label class="required"><b>Contact Number :</b> {{ $user->contactNumber }}</label>
          </div>
          <div class="form-group">
            <label class="required"><b>Alternate Phone :</b> {{ $user->alternatePhone }}</label>
          </div>
          <div class="form-group">
            <label class="required"><b>Email Address :</b> {{ $user->email }}</label>
          </div>
          <h4>Employee Details</h4>
          <hr>
          <div class="form-group">
            <label class="required"><b>Employee ID :</b> {{ $user->employeeId }}</label>
          </div>
          <div class="form-group">
            <label class="required"><b>Department :</b> {{ $user->department }}</label>
          </div>
          <div class="form-group">
            <label class="required"><b>Designation : </b> {{ $user->designation }}</label>
          </div>
          <div class="form-group">
            <label class="required"><b>Employee Term :</b> {{ $user->employeeTerm }}</label>
          </div>
          <div class="form-group">
            <label class="required"><b>Employee Status :</b> {{ $user->status }}</label>
          </div>
    </div>
    <div class="col-lg-6">
      <h4>Picture Uplaod</h4>
        <img src="{{ asset('images/'.$user->userImg)}}" id="profile-img-tag" class="img-thumbnail" style="width: 200px; height: 200px">
      <hr>  
      <a href="{{ route('editView') }}" class="btn btn-info btn-lg">Edit Profile</a>
    </div>

</div>



@endsection

