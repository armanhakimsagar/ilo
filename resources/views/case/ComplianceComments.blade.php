<?php use App\Http\Controllers\HomeController;?>
@extends('theme.default')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"> </h1>
    </div>
</div>
@if(Session::has('message')) 
    <div class="alert alert-info"> {{Session::get('message')}} </div> 
@endif
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
      <div class="row">
          <div class="col-lg-12">
              <div class="panel panel-info">
              <div class="panel-heading">
                <i class="fa fa-comment fa-fw"></i> Complaint Summary
              </div>
              <!-- /.panel-heading -->
              <div class="panel-body">
                <div class="col-lg-12">
                @foreach($casedetails as $casedetailss)
                  <table class="table table-bordered">
                    <tr>
                      <td><b>Tracking Number :</b> {{ $casedetailss->applicantTrackingNo }}</td>
                    </tr>
                    <tr>
                      <td><b>Case filed date:</b> {{ date("d F Y", strtotime($casedetailss->created_at)) }}</td>
                    </tr>
                    <tr>
                      <td><b>Name :</b> 
                        @if($casedetailss->sufferer_name != "NULL" && $casedetailss->sufferer_name != "")
                        {{ $casedetailss->sufferer_name }}
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td><b>Mobile No:</b> 
                        @if($casedetailss->sufferer_mobile != "NULL" && $casedetailss->sufferer_mobile != "")
                          {{ $casedetailss->sufferer_mobile }}
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td><b>Passport No:</b> 
                        @if($casedetailss->sufferer_passport_no != "NULL" && $casedetailss->sufferer_passport_no != "")
                        {{ $casedetailss->sufferer_passport_no }}
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td><b>Local Address :</b> 
                        @if($casedetailss->sufferer_local_address != "NULL" && $casedetailss->sufferer_local_address != "")
                        {{ $casedetailss->sufferer_local_address }}
                        @endif
                      </td>
                    </tr>
                  </table>
                @endforeach
                </div>
              </div>
              <!-- /.panel-body -->
            </div>



          </div>
          <!-- /.col-lg-12 -->
      </div>
      <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-success">
            <div class="panel-heading">
              <i class="fa fa-comment fa-fw"></i> Case Filing Comments Summary
            </div>
              <div class="panel-body">
                @foreach($casefilingcomments as $casefilingcommentss)
                  <div class="panel-body">
                    <div class="col-lg-12">
                      <?php $userName = HomeController::getName($casefilingcommentss->empUserId); ?>
                      @if(empty($userName['userImg']))
                        <img src="{{ asset('images/profile_default.png')}}" class="img-circle" width="50" height="50">
                      @else
                        <img src="{{ asset('images/'.$userName['userImg'])}}" class="img-circle" width="50" height="50">
                      @endif
                      <strong>{{ $userName['fullName'] }}</strong>
                      <small>
                          <!-- -->
                      </small>
                      <small style="color: red">
                      <?php $commentsdoc = HomeController::getCommentsDoc($casedetailss->case_id,$casefilingcommentss->empUserId); ?>
                        @foreach($commentsdoc as $commentsdocs)
                          <?php $ext = pathinfo($commentsdocs['doc_orginal_name'], PATHINFO_EXTENSION);?>
                            <a href="{{ route('commentsDoc',$commentsdocs->supporting_doc) }}" target="_blank">
                              @if($ext == 'pdf')
                                <i class="fa fa-file-pdf-o" style="font-size:16px;color:red"> </i> 
                              @elseif($ext == 'doc' || $ext == 'docx')
                                <span class="glyphicon glyphicon-file" style="font-size:16px;color:blue"> </span>
                              @else
                                <i class="glyphicon glyphicon-picture" style="font-size:16px;color:green"> </i>
                              @endif
                            </a>
                        @endforeach
                      </small>
                    </div>
                    <div class="col-lg-12">
                      <p>
                        @if($casefilingcommentss->comments != "NULL")
                        {{ strip_tags($casefilingcommentss->comments) }}
                        @endif
                      </p>
                      <hr>
                    </div>
                  </div>
                  @endforeach
              </div>
            </div>
          </div>
      </div>


    </div>
</div>

@endsection