<?php use App\Http\Controllers\HomeController;?>
@extends('theme.default')

@section('content')
<style type="text/css">
    .dataTable{
        width: 100% !important;
    }
    
    
</style>


<!-- /.row -->

<!-- modal view -->

<!-- notification -->
@foreach($caseadminlist as $caseadminlists)

  <?php 
    $userID = Auth::user()->empUserID;
    $Negetivestatus = HomeController::NegetiveNotification($userID,$caseadminlists->applicantTrackingNo); 

    if(isset($Negetivestatus)){
      Session::put('filing_notification', Auth::user()->empUserID."new_file");
    }
  ?>

@endforeach

<div class="row">

    @foreach($static_permission as $static_permissions)

    @if($static_permissions->permissionid == "1122300")
<div class="col-lg-12">
    <div class="panel panel-success">
                <div class="panel-heading" style="background-color: #00097c; color: #fff"><span style="color: #fff" class="glyphicon glyphicon-stats"></span> Statistics</div>
                
            </div>

             <div class="col-md-12" style="background-color: #eee">
                <div class="col-md-6">

                    <div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 10px 0px 10px 0px"></div>
                  
                  <div class="btn btn-danger" style="background-color:#6b5656;border: 0px; cursor: auto; font-size: 10px" >New Cases <span class="badge">{{ $received }}</span></div> 
                  <div class="btn btn-primary" style="background-color:rgb(49, 176, 213);border: 0px; cursor: auto;font-size: 10px">Filing <span class="badge">{{ $progress }}</span></div>
                  <div class="btn btn-success" style="background-color:rgb(236, 151, 31);border: 0px; cursor: auto;font-size: 10px">Inquiry <span class="badge">{{ $inquery }}</span></div>     
                   <div class="btn btn-info" style="background-color:rgb(68, 157, 68);border: 0px; cursor: auto;font-size: 10px">Complete <span class="badge">{{ $complete }}</span></div>   
                   <div class="btn btn-info" style="background-color:#f00;border: 0px; cursor: auto;font-size: 10px">Incomplete <span class="badge">{{ $incomplete }}</span></div>      
                  <br><br>
      
                </div>
                <div class="col-md-6" style="margin: 10px 0px 10px 0px">

                    <div class="row">
   
                         <div class="col-lg-12">
                            {!! $chart->html() !!}
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    {!! $chart->script() !!}
                </div>  
            </div> 
        </div>
        @endif
        @endforeach


    <div class="col-md-12">

            <div class="panel panel-success">
                <div class="panel-heading" style="background-color: #00097c; color: #fff"><span style="color: #fff" class="glyphicon glyphicon-bell"></span> Case History (Latest 10 Cases)</div>
                <div class="panel-body">
                    <ul class="nav nav-tabs" style="padding: 10px">
                        <li class="active"><a data-toggle="tab" href="#NewCase"><b>New Cases</b></a></li>
                        <li><a data-toggle="tab" href="#Progress"><b>Case On Progress</b></a></li>
                        <li><a data-toggle="tab" href="#MyPendingCase"><b>Inquiry Cases</b></a></li>
                        <li><a data-toggle="tab" href="#MyFinishingCase"><b>Completed Cases</b></a></li>
                    </ul>
                <!--========================Tab details start=================== -->
                    <div class="tab-content">
                        <div id="NewCase" class="tab-pane fade in active">
                          <table class="table table-bordered table-hover" style="background-color: #eee">
                            <thead>
                                <tr>
                                    <th style="display: none">sl</th>
                                    <th width="20%" colspan="2">Tracking No</th>
                                    <th width="60%" colspan="6">Case Details</th>
                                    <th width="20%" colspan="2">Channel</th>
                                </tr>
                            </thead>
                            @if($admincaselist->isEmpty() == false)
                                @foreach($admincaselist as $admincaselists)

                                <tr <?php 
                                    $now = date('Y-m-d', strtotime('-30 days'));
                                    $your_date = date('Y-m-d',strtotime($admincaselists->created_at));
                                    if($now > $your_date){
                                        echo " style ='background-color:#bb0808;color:#fff'";
                                    }?>>

                                    <td style="display: none">{{ $admincaselists->application_id }}</td>
                                    <td width="20%" colspan="2">
                                        
                                            {{ $admincaselists->applicantTrackingNo }}
                                      

                                    <?php //echo TrackCheck($admincaselists->applicantTrackingNo); ?>
                                        
                                    </td>
                                    <td width="60%" colspan="6">
                                        <?php
                                            $text = substr($admincaselists->application_text,0,145);
                                            if($text != "NULL"){
                                             echo $text;
                                            };
                                        ?>
                                    </td>
                                    <td width="20%" colspan="2">
                                        @if($admincaselists->application_type == 'Mobile Audio' || $admincaselists->application_type == 'Mobile Video' || $admincaselists->application_type == 'Mobile Sms')
                                            {{ $admincaselists->application_type }}
                                        @elseif($admincaselists->application_type == 'Mobile Form')
                                            <span class="class-span">
                                                Mobile
                                            </span>
                                        @else
                                            <span class="class-span">
                                               Web
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td> No new case </td>
                                </tr>
                            @endif

                          </table>
                        </div>
                        <div id="Progress" class="tab-pane fade">
                
                            <div class="">
                                <table class="display table table-bordered table-hover" style="background-color: #eee">
                                    <thead>
                                        <tr>
                                            <th style="display: none">sl</th>
                                            <th width="30%" colspan="3">Tracking No</th>
                                            <th width="70%" colspan="7">Case Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($runningCaseuser->isEmpty() == false)
                                        @foreach($runningCaseuser as $runningCaseusers)
                                        <tr>
                                            <td style="display: none">{{ $runningCaseusers->application_id }}</td>
                                            <td width="30%" colspan="3">{{ $runningCaseusers->applicantTrackingNo }}</td>
                                            <td width="70%" colspan="7">
                                                <span class="class-span">
                                                    <?php
                                                        if($runningCaseusers->application_text != "NULL"){
                                                            $text = substr($runningCaseusers->application_text,0,145);
                                                             echo $text;
                                                        };
                                                    ?>
                                                </span>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                            <tr>
                                                <td> No case on progress </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="MyPendingCase" class="tab-pane fade">
                          <table class="display table table-bordered table-hover" style="background-color: #eee">
                            <thead>
                                <tr>
                                    <th width="30%" colspan="3">Tracking No</th>
                                    <th width="70%" colspan="7">Case Details</th>
                                </tr>
                            </thead>
                            @if($caselist->isEmpty() == false)
                                @foreach($caselist as $caselists)
                                <tr>
                                    <td style="display: none">{{ $caselists->application_id }}</td>
                                    <td width="30%" colspan="3">{{ $caselists->applicantTrackingNo }}</td>
                                    <td width="70%" colspan="7">
                                            <span class="class-span">

                                                <?php
                                                    if($caselists->application_text != "NULL"){
                                                        $text = substr($caselists->application_text,0,145);
                                                         echo $text;
                                                    };
                                                ?>
                                            </span>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td> No case for inquiry </td>
                                </tr>
                            @endif
                          </table>
                        </div>
                        <div id="MyFinishingCase" class="tab-pane fade">
                          <table class="display table table-bordered table-hover" style="background-color: #eee">
                            <thead>
                                <tr>
                                    <th style="display: none">sl</th>
                                    <th width="30%" colspan="3">Tracking No</th>
                                    <th width="70%" colspan="7">Case Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($case_complete->isEmpty() == false)
                                @foreach($case_complete as $case_completes)
                                <tr>
                                    <td style="display: none">{{ $case_completes->application_id }}</td>
                                    <td width="30%" colspan="3">{{ $case_completes->applicantTrackingNo }}</td>
                                    <td width="70%" colspan="7">
                                            <span class="class-span">
                                                <?php
                                                    if($case_completes->application_text != "NULL"){
                                                        $text = substr($case_completes->application_text,0,145);
                                                         echo $text;
                                                    };
                                                ?>
                                            </span>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td> No complete case </td>
                                </tr>
                            @endif
                            </tbody>
                          </table>
                        </div>

                        
                    </div>
                <!--=================Tab details end================== -->
                </div>
</div>
        </div>
        <div class="col-md-12" id="todo">
            <div class="panel panel-danger">
                <div class="panel-heading" style="background-color: #00097c; color: #fff"><span style="color: #fff" class="glyphicon glyphicon-bell"></span>
                    <a href="{{ url('todo_view') }}" style="color: #fff"> To Do List (Top 5) </a> </div>
                
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tr>
                            <td style="background-color:rgb(144, 226, 126);color:#333030;text-align: center;
                            "> <b>Priority  Low</b></td>
                            <td style="background-color:rgb(130, 186, 234);color:#333030;text-align: center;
                            "> <b>Priority  Medium</b> </td>
                            <td style="background-color:rgb(230, 162, 90);color:#333030;text-align: center;
                            "> <b>Priority  High</b> </td>
                        </tr>
                    </table>
                    <table id="example" class="display table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Task</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($todolist as $todolists)
                            <tr>
                                <td
                                <?php if($todolists->priority == 'Normal'){?>
                                     style="background-color:rgb(144, 226, 126)" data-toggle="tooltip" title="Normal Task" 
                                <?php }
                                elseif($todolists->priority == 'Urgent'){ ?>
                                     style="background-color:rgb(130, 186, 234)" data-toggle="tooltip" title="Medium Task"
                                <?php }else{ ?>
                                     style="background-color:rgb(230, 162, 90)" data-toggle="tooltip" title="High Task" 
                                <?php } ?>
                                >
                                    <p>
                                        @if($todolists->status == 'Done')
                                        <strike>{{ $todolists->task }}</strike>
                                        @else
                                            <span>{{ $todolists->task }}</span>
                                        @endif
                                    </p>
                                </td>
                                <td>
                                    {{ $todolists->taskDate }}
                                </td>
                                <!-- <td>
                                    <span class="glyphicon glyphicon-pencil"></span>
                                    <span class="glyphicon glyphicon-check"></span>
                                    <span class="glyphicon glyphicon-trash"></span>
                                </td> -->
                                <td style="width: 30px">
                                    @if($todolists->status == "Undone")
                                    <a href="{{ route('todoComplete',$todolists->id.'#todo') }}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-send"></span></a>
                                    @else
                                    <a href="{{ route('todoUnComplete',$todolists->id.'#todo') }}" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-ok-circle"></span></a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-info">
                    <div class="panel-heading" id="announcements" style="background-color: #00097c; color: #fff"><span style="color: #fff" class="glyphicon glyphicon-bell"></span> Announcements (Top 5) </div>
                <!--  -->
                @if($announcement->isEmpty() != true)
                @foreach($announcement as $announcements)
                        <div class="alert alert-success">
                            <?php $userName = HomeController::getName($announcements->created_by); ?>
                            <u><strong><i>Announced by :</i> {{ $userName['fullName'] }}</strong></u>
                            <p>{{ $announcements->title }}</p>
                            <a href="{{ route('announceDetails',$announcements->announceId) }}" class="btn btn-warning btn-xs">More...</a>
                        </div>
                    @endforeach


                @else
                <table class="display table table-bordered table-hover" style="background-color: #eee">
                    <thead>
                        <tr>
                            <th></th>
                            <th width="100%">{{ "No announcement found" }}</th>
                        </tr>
                    </thead>
                </table>
                    
                @endif
                </div>
            </div>
        </div>
    </div>

<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Create Task</h4>
        </div>
        <div class="modal-body">
            {!! Form::open(array('url' => 'todoCreate','method'=>'POST', 'id'=>'differentForm')) !!}
              <div class="form-group">
                <label for="email">Task Title : </label>
                <textarea class="form-control" name="title" id="title" required="required" maxlength="100"></textarea>
              </div>
              <div class="form-group">
                <label for="pwd">Task Date :</label>
                <input type="text" name="taskdate" id="last_renewal" class="form-control">
              </div>
              <div class="form-group">
                <label for="pwd">Task Priority :</label>
                <select class="form-control" name="priority" id="priority">
                    <option value="Normal">Low</option>
                    <option value="Urgent">Mid</option>
                    <option value="Very Urgent">High</option>
                </select>
              </div>         
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" onclick="todoSubmit('modalID')">Save</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        {{ Form::close() }} 
      </div>
    </div>
    </div>
  </div>






<!-- all -->

<script type="text/javascript">
    
Highcharts.chart('container', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: '<b>Total System Statistics</b>'
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
        style: {
          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
        }
      }
    }
  },
  series: [{
    name: '',
    colorByPoint: true,
    data: [{
      name: 'New Cases',
      y: {{ $received }},
      color: '#6b5656'
    },{
      name: 'Filing',
      y: {{ $progress }},
      color: 'rgb(0, 9, 124)',
      sliced: true,
      selected: true
    },  {
      name: 'Inquiry',
      y: {{ $inquery }},
      color: 'rgb(236, 151, 31)'
    },{
      name: 'Completed',
      y: {{ $complete }},
      color: 'rgb(68, 157, 68)'

    },{
      name: 'Incomplete',
      y: {{ $incomplete }},
      color: 'rgb(255, 0, 0)'

    }]
  }]
});


</script>


<style type="text/css">
    .highcharts-credits{
        display: none
    }
</style>
@endsection

