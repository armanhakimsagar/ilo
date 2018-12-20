@extends('theme.default')
@section('content')
<?php use App\Http\Controllers\HomeController; ?>

<div class="row" style="background-color: #00097c;color: #fff; margin-bottom: 10px">
    <div class="col-lg-12">
        <div class="panel-heading">Case Status View</div>
    </div>
    <!-- /.col-lg-12 -->
</div>

@if(Session::has('message')) 
    <script type="text/javascript">
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            window.location.href = document.referrer;
        };
    </script>
    <div class="alert alert-info"> {{Session::get('message')}} </div> 
@endif

<!-- /.row -->
<div class="row" style=" background-color: #eee; padding: 20px 0px 0px 0px">
    <div class="col-lg-12">
        <table class="display table table-striped table-bordered nowrap" cellspacing="0" width="100%" style="font-size: 12px">
          <thead>
            <tr>
              <th>Tracking No</th>
              <th>Created By</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($caselist as $casealllists)
            <tr>
              <td>{{ $casealllists->tracking_no }}</td>
              <td>
                <?php 
                  $data = HomeController::getIdToName($casealllists->created_by); 
                  echo $data->name;
                ?>
              <td>
                <a href="{{ url('CaseSatusDetails/'.$casealllists->tracking_no) }}">Details</a>
              </td>
            </tr>

            @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection