<?php use App\Http\Controllers\HomeController;?>
@extends('theme.default')
@section('content')

<div class="row">
    <!-- <div class="col-lg-12">
        <h1 class="page-header"> Complaint Details</h1>
    </div> -->
    <!-- /.col-lg-12 -->
</div>
@if(Session::has('message')) 
    <div class="alert alert-info"> {{Session::get('message')}} </div> 
@endif
<!-- /.row -->
<div class="alert alert-danger">
  <h3>Sorry currently you have no access this case ...</h3>
</div>
</div>

@endsection