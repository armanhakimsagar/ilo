<?php use App\Http\Controllers\HomeController;?>
@extends('theme.default')
@section('content')


<div class="row" style="background-color: #00097c;color: #fff; margin-bottom: 10px">
    <div class="col-lg-12">
        <div class="panel-heading"> Announcement Details</div>
    </div>
    <!-- /.col-lg-12 -->
</div>





<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
      <div class="panel panel-warning">
        <div class="panel-body">
            @foreach($announceDetails as $announceDetailss)
              <?php $userName = HomeController::getName($announceDetailss->created_by); ?>
              <h4>Announced By : {{ $userName['fullName'] }}</h4>
              <p>Publish Date : {{ $announceDetailss->publishDate }}</p>
              <p>Closing Date : {{ $announceDetailss->closingDate }}</p>
              <p>Priorty : {{ $announceDetailss->priority }}</p>
              <p>Announce Title : {{ $announceDetailss->title }}</p>
              <p>Announce Details : <br>{{ strip_tags($announceDetailss->description) }}</p>
            @endforeach
        </div>
      </div>
    </div>
</div>
<hr>

@endsection