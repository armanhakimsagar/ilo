@extends('theme.default')
@section('content')

<style type="text/css">
  th{
    font-size: 12px;
    text-align: center;
  }
  td{
    font-size: 12px
  }
</style>
<div class="row" style="background-color: #00097c;color: #fff; margin-bottom: 10px">
    <div class="col-lg-12">
        <div class="panel-heading">Announcement List</div>
    </div>
    <!-- /.col-lg-12 -->
</div>



@if(Session::has('message')) 
    <div class="alert alert-info"> {{Session::get('message')}} </div> 
@endif
<!-- /.row -->
<div class="row" style="background-color: #eee">
    <div class="col-lg-12">
        <table class="display table table-striped table-bordered nowrap">
          <thead>
            <tr>
              <th width="10%">Publish Date</th>
              <th width="10%">Closing Date</th>
              <th width="10%">Priority</th>
              <th width="10%">Category</th>
              <th width="20%">Title</th>
              <th width="30%">Description</th>
              <th width="10%">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($announcement as $announcelists)
              <tr>
                <td>{{ $announcelists->publishDate }}</td>
                <td>{{ $announcelists->closingDate }}</td>
                <td>{{ $announcelists->priority }}</td>
                <td>{{ $announcelists->announceCategory }}</td>
                <td><span class="class-span">{{ $announcelists->title }}</span></td>
                <td><span class="class-span">{{ strip_tags($announcelists->description) }}</span></td>
                <td>
                  <a href="{{ route('announceDetails',$announcelists->announceId) }}" class="btn btn-warning btn-xs">More...</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
    </div>
</div>

@endsection