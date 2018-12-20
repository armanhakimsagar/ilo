<?php use App\Http\Controllers\HomeController;?>

<div class="navbar-default sidebar" role="navigation" style="margin-top: 43px">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu" style="margin-top:20px">
            @if(HomeController::getGroupName(Auth::user()->empUserID)->group_name == "Director")
            <li>
             <form method="post" action="http://stage-ilo.dnet.org.bd/account/sign_in" target="_blank">
                
                <input type="hidden" name="sign_in_username_email" value="{{ Auth::user()->name }}">
                <input type="hidden" name="sign_in_password" value="{{ Auth::user()->remember_pass }}">
                <button type="submit" style="width: 100%; text-align:left; padding-left: 16px; height: 30px; background-color: #00097c; color: #fff; border-radius: 0px" class="btn bnt-default">
                    <i class="glyphicon glyphicon-envelope"></i>
                    Mobile Management
                </button>
             </form>
            </li>
            @endif
            <li>
                <a href="{{ route('home') }}"><span class="glyphicon glyphicon-home"></span> Dashboard </a>
            </li>
            <li>
                <a href="{{ route('TodoView') }}"><i class="glyphicon glyphicon-list-alt"></i> To do List</a>
            </li>
            <li>
                <a href="{{ route('CaseCreate') }}"><i class="glyphicon glyphicon-plus-sign"></i> Complain Create</a>
            </li>
            @if(Auth::user()->name == "Director General")
                <li>
                    <a href="{{ route('FilingCaseList') }}"><i class="glyphicon glyphicon-envelope"></i> New Cases</a>
                </li>
                <li>
                    <a href="{{ route('AllCompliance') }}"><i class="glyphicon glyphicon-save-file"></i> Filed Cases</a>
                </li>
                <li>
                    <a href="{{ route('ComplianceList') }}"><i class="glyphicon glyphicon-open-file"></i> Cases in Inquiry</a>
                </li>
                <li>
                    <a href="{{ route('AllCompleteCase') }}"><i class="glyphicon glyphicon-check"></i> Completed Cases</a>
                </li>
                <li>
                    <a href="{{ route('allCasesInfo') }}"><i class="glyphicon glyphicon-duplicate"></i> All Cases </a>
                </li>
                <li>
                    <a href="{{ route('user') }}"><i class="glyphicon glyphicon-pencil"></i> User Create</a>
                </li>
                <li>
                    <a href="{{ route('userView') }}"><i class="glyphicon glyphicon-user"></i> User View</a>
                </li>
                <li>
                    <a href="{{ route('casestatus') }}"><i class="fa fa-line-chart"></i> Report </a>
                </li>
                <li>
                    <a href="{{ route('announce') }}"><i class="glyphicon glyphicon-edit"></i> Announcement Create</a>
                </li>
                <li>
                    <a href="{{ route('announceView') }}"><i class="glyphicon glyphicon-book"></i> Announcement View</a>
                </li>
                <li>
                    <a href="{{ route('CaseStep') }}"><i class="glyphicon glyphicon-cog"></i> Case Filing Step</a>
                </li>
                <li>
                    <a href="{{ route('PredefineComment') }}"><i class="glyphicon glyphicon-comment"></i> Predefine Comments</a>
                </li>
                <li>
                    <a href="{{ route('group') }}"><i class="glyphicon glyphicon-random"></i> Group Create</a>
                </li>
                <li>
                    <a href="{{ route('groupView') }}"><i class="glyphicon glyphicon-list-alt"></i> Group List</a>
                </li>
            @else
                <?php 
                    $newcase = HomeController::getGroupPermissionName(Auth::user()->empUserID);
                ?>
                @foreach($newcase as $newcases)
                    <li>
                        <a href="{{ route($newcases->slog) }}"><i class="{{ $newcases->menu_images }}"></i>{{ " ".$newcases->permission_name }}</a>
                    </li>

                @endforeach
                
            @endif
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->