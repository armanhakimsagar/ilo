
<?php use App\Http\Controllers\HomeController; ?>
<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <img src="{{ asset('images\logo.gif') }}" style="height: 45px; padding: 5px 0px 0px 5px">

</div>

<!-- /.navbar-header -->

<ul class="nav navbar-top-links navbar-right">


    <!-- /.dropdown -->
    <li class="dropdown"> 
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" onclick="notificationUpdate({{ Auth::user()->empUserID }})">
            <div class="notification_section">
                <span id="dashboard_notification"> 
                    <i class="fa fa-bell" aria-hidden="true"></i>
                </span>
                <span class="badge" style="background-color: #ff3c7e; font-size: 9px" id="new"></span>
            </div>

        </a>
        <ul class="dropdown-menu dropdown-user">
            <li style="width:420px; padding: 5px">
               <div class="notification_class" id="notification_toggle">
                <h5 style="text-align: center;"><span id="dashboard_notification" style="background-color: #00097c; color: #fff; height: 20px; line-height: 20px; text-align: center; display: block;">NOTIFICATION</span></h5>
                
                <span id="newcaseDiv">
                    <div style="display: block; text-align: center;" id="newcase"></div>
                </span>
                <span id="sinkDiv">
                    <div style="display: block; text-align: center;" id="sink"></div>
                </span>
                <span id="committeDiv">
                    <div style="display: block; text-align: center;" id="committe">
                    </div> 
                </span>
                <span id="inquiryDiv">
                    <div style="display: block; text-align: center;" id="inquiry">
                    </div> 
                </span>
                <span id="hearingDiv">
                    <div style="display: block;text-align: center;" id="hearing">
                    </div> 
                </span>
            </div>
            </li>
            <li>
                <a href="{{ url('allNotification') }}">See all</a>
            </li>
        </ul>
    </li>


    <li class="dropdown"> 
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="margin-top: 10px; height: 40px">
            Welcome {{ Auth::user()->name }} 
            @if(empty(Auth::user()->userImg))
                <img src="{{ asset('images/profile_default.png')}}" class="img-rounded" width="20" height="20"> <i class="fa fa-caret-down"></i>
            @else
                <img src="{{ asset('images/'.Auth::user()->userImg)}}" class="img-rounded" width="20" height="20"> <i class="fa fa-caret-down"></i>
            @endif
        </a>
        <ul class="dropdown-menu dropdown-user">
            <!--
            <li><a href="{{ route('profile') }}"><i class="fa fa-user fa-fw"></i> User Profile</a>
            </li>
            -->
            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-fw"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
        <!-- /.dropdown-user -->
    </li>
</ul>
<script>
   alertFunc();
   myVar = setInterval(alertFunc, 30000);
   /*
   $(document).ready(function(){
     $("#sink").hide();
     $("#new").hide();
     $("#committe").hide();
     $("#inquiry").hide();
     $("#hearing").hide();
     $("#newcaseDiv").hide();
     $("#newcase").hide();
     $("#sinkDiv").hide();
     $("#committeDiv").hide();
     $("#hearingDiv").hide();
     $("#inquiryDiv").hide();
   });
    */
   function notificationUpdate(id){
         $.ajax({
            url: "{{ url('update_notification') }}"+"/"+id,
            type: "get",
            processData:false,
            dataType:'json',
            success: function(data){
                console.log("updated");
            }
        })
   }

   function alertFunc(){
      $.ajax({
            url: "{{ url('sink_notification') }}",
            type: "get",
            processData:false,
            dataType:'json',
            success: function(data){

                total = data.count + data.committe_count + data.hearing_count+data.newcasecount;
                //$("#new").html(total);
                if(total == 0){
                    $("#sink").hide();
                    $("#new").hide();
                    $("#new").html("");
                }
                if(total != 0){
                    $("#sink").show();
                    $("#new").show();
                    $("#new").html(total);
                }
                if(data.count != 0){
                    $("#sinkDiv").show();

                    $("#sink").html('');
                    $.each(data.count_file_list,function(key,value){
                        $("#sink").append("<span class='label label-danger col-lg-4'>New case for filing</span><a href='AllCompliance'>"+value.tracking_no+"</a><small style='font-size:9px'>"+value.created_at+"</small><br>");
                    });
                    
                }else{
                    $("#sink").hide();
                    $("#sinkDiv").hide();
                }
                
                if(data.newcasecount != 0){
                    $("#newcaseDiv").show();
                    $("#newcase").show();

                    $("#newcase").html('');
                    $.each(data.new_file_lists,function(key,value){
                        $("#newcase").append("<span class='label label-success col-lg-4'>New case</span><a href='FilingCaseList'>"+value.tracking_no+"</a><small style='font-size:9px'>"+value.created_at+"</small><br>");
                    });
                    
                }else{
                    $("#newcase").hide();
                    $("#newcaseDiv").hide();
                }

                if(data.committe_count != 0){
                    $("#committeDiv").show();
                    $("#committe").show();

                    $("#committe").html('');
                    $.each(data.committe_file_list,function(key,value){
                        $("#committe").append("<span class='label label-success col-lg-4'>Committee letter</span><a href='AllCompliance'>"+value.tracking_no+"</a><small style='font-size:9px'>"+value.created_at+"</small><br>");
                    });
                    
                }else{
                    $("#committe").hide();
                    $("#committeDiv").hide();
                }
                if(data.inquery_file_count != 0){
                    $("#inquiryDiv").show();
                    $("#inquiry").show();

                    $("#inquiry").html('');
                    $.each(data.inquery_file_lists,function(key,value){
                        $("#inquiry").append("<span class='label label-info col-lg-4'>New case for inquiry</span><a href='AllCompliance'>"+value.tracking_no+"</a><small style='font-size:9px'>"+value.created_at+"</small><br>");
                    });

                }else{
                    $("#hearingDiv").hide();
                    $("#hearing").hide();
                }
                if(data.hearing_file_count != 0){
                    $("#hearingDiv").show();
                    $("#hearing").show();

                    $("#hearing").html('');
                    $.each(data.hearing_file_lists,function(key,value){
                        $("#hearing").append("<span class='label label-primary col-lg-4'>Generate hearing letter</span><a href='ComplianceList'>"+value.tracking_no+"</a><small style='font-size:9px'>"+value.created_at+"</small><br>");
                    });

                }else{
                    $("#hearingDiv").hide();
                    $("#hearing").hide();
                }
            },
            error: function(){}           
        });
   }
</script>

<!-- /.navbar-top-links -->