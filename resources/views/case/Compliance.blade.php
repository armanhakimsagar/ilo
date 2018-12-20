<?php use App\Http\Controllers\HomeController;?>
@extends('theme.default')
@section('content')

<div class="row" style="background-color: #00097c;color: #fff; margin-bottom: 10px">
    <div class="col-lg-12">
        <div class="panel-heading">Complaint Details</div>
    </div>
    <!-- /.col-lg-12 -->
</div>



@if(Session::has('message')) 
    <div class="alert alert-info"> {{Session::get('message')}} </div> 
@endif
<!-- /.row -->
{!! Form::open(array('url' => 'CaseStartCreate','method'=>'POST','files'=>true, 'id'=>'differentForm')) !!}
@foreach($casedetails as $casealllists)
<div class="row">
  <div class="col-lg-6">
    <div class="panel panel-success">
      <div class="panel-heading">Migrant Worker Information</div>
      <div class="panel-body">
        <table class="table table-bordered">
          <input type="hidden" name="tracking_no" value="{{ $casealllists->applicantTrackingNo }}">
          <input type="hidden" name="caseID" value="{{ $casealllists->case_id }}">
          <tr>
            <td><b>Case ID:</b> {{ $casealllists->case_id }}</td>
            <td><b>Case filed date:</b> {{ date("d F Y", strtotime($casealllists->created_at)) }}</td>
          </tr>
          <tr>
            <td><b>Name :</b> 
              @if($casealllists->sufferer_name != "NULL")
                {{ $casealllists->sufferer_name }}</td>
              @endif
            <td><b>Gender :</b> 
              @if($casealllists->gender != "NULL")
                {{ $casealllists->gender }}</td>
              @endif
          </tr>
          <tr>
            <td><b>Mobile No:</b> 
              @if($casealllists->sufferer_mobile != "NULL")
                {{ $casealllists->sufferer_mobile }}
              @endif</td>
            <td><b>Local Mobile No:</b> 
              @if($casealllists->sufferer_local_no != "NULL")
                {{ $casealllists->sufferer_local_no }}
              @endif
              </td>
          </tr>
          <tr>
            <td><b>Nationality :</b> 
                @if($casealllists->sufferer_nationality != "NULL")
                  {{ $casealllists->sufferer_nationality }}
                @endif
              </td>
            <td><b>Passport No:</b> 
              @if($casealllists->sufferer_passport_no != "NULL")
                {{ $casealllists->sufferer_passport_no }}
              @endif
              </td>
          </tr>
          <tr>
            <td><b>Country Name :</b> 
              @if($casealllists->sufferer_current_country != "NULL")
                {{ $casealllists->sufferer_current_country }}
              @endif
            </td>
            <td><b>Case filed date:</b> {{ date("d F Y", strtotime($casealllists->created_at)) }}</td>
          </tr>
          <tr>
            <td><b>District :</b> 
              @if($casealllists->sufferer_district != "NULL")
                {{ $casealllists->sufferer_district }}
              @endif
            </td>
            <td><b>Upazilla :</b> 
              @if($casealllists->sufferer_upazilla != "NULL")
                {{ $casealllists->sufferer_upazilla }}
              @endif
            </td>
          </tr>
          <tr>
            <td><b>Current Address :</b> 
              @if($casealllists->sufferer_current_address != "NULL")
                {{ $casealllists->sufferer_current_address }}
              @endif
              </td>
            <td><b>Local Address :</b> 
              @if($casealllists->sufferer_local_address != "NULL")
                {{ $casealllists->sufferer_local_address }}
              @endif
            </td>
          </tr>
        </table>
        <h4><u>Document Submitted</u></h4>
        <div class="list-group">
          @foreach($casedocument as $casedocuments)
            <?php $ext = pathinfo($casedocuments->file_name, PATHINFO_EXTENSION);?>
            @if($ext == 'pdf')
              <a href="{{ route('documents',$casedocuments->file_name) }}" class="list-group-item" target="_blank">
                <i class="fa fa-file-pdf-o" style="font-size:16px;color:red"></i>{{ $casedocuments->supporting_doc_name }}</a>
              @elseif($ext == 'doc' || $ext == 'docx')
              <a href="{{ route('documents',$casedocuments->file_name) }}" class="list-group-item" target="_blank">
                <span class="glyphicon glyphicon-file" style="font-size:16px;color:blue"></span>{{ $casedocuments->supporting_doc_name }}</a>
              @elseif($ext == 'mp4')
                <video width="320" height="240" controls>
                  <source src="http://stage-ilo.dnet.org.bd/resource/media/{{ $casedocuments->file_name }}" type="video/mp4">
                </video>
              @elseif($ext == 'mp3')
                <audio controls>
                  <source src="{{ asset('ComplianceDoc/'.$casedocuments->file_name)}}" type="audio/mp3">
                </audio>
              @else
              <a href="{{ route('documents',$casedocuments->file_name) }}" class="list-group-item" target="_blank">
                <i class="glyphicon glyphicon-picture" style="font-size:16px;color:green"></i>{{ $casedocuments->supporting_doc_name }}</a>
              @endif
          @endforeach
          @foreach($casemaindocument as $casemaindocuments)
            <?php $ext = pathinfo($casemaindocuments->supporting_doc_name, PATHINFO_EXTENSION);?>
            @if($ext == 'pdf')
              <a href="{{ route('documents',$casemaindocuments->supporting_doc_name) }}" class="list-group-item" target="_blank">
                <i class="fa fa-file-pdf-o" style="font-size:16px;color:red"></i>{{ $casemaindocuments->orginal_name }}</a>
              @elseif($ext == 'doc' || $ext == 'docx')
              <a href="{{ route('documents',$casemaindocuments->supporting_doc_name) }}" class="list-group-item" target="_blank">
                <span class="glyphicon glyphicon-file" style="font-size:16px;color:blue"></span>{{ $casemaindocuments->orginal_name }}</a>
              @elseif($ext == 'mp4')
                <video width="320" height="240" controls>
                  <source src="http://stage-ilo.dnet.org.bd/resource/media/{{ $casemaindocuments->supporting_doc_name }}" type="video/mp4">
                </video>
              @elseif($ext == 'mp3')
                <audio controls>
                  <source src="{{ asset('ComplianceDoc/'.$casemaindocuments->supporting_doc_name)}}" type="audio/mp3">
                </audio>
              @else
              <a href="{{ route('documents',$casemaindocuments->supporting_doc_name) }}" class="list-group-item" target="_blank">
                <i class="glyphicon glyphicon-picture" style="font-size:16px;color:green"></i>{{ $casemaindocuments->orginal_name }}</a>
              @endif
          @endforeach
        </div>
        
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="panel panel-success">
      <div class="panel-heading">Case Information</div>
      <div class="panel-body">
        <table class="table table-bordered">
          <tr>
            <td><b>Complain is given by:</b>
              @if($casealllists->application_for != "NULL")

                  @if($casealllists->application_for == "own")
                    A person lives in abroad
                  @endif
                  @if($casealllists->application_for == "own_other")
                    A person who visit to abroad
                  @endif
                  @if($casealllists->application_for == "other")
                    On behalf of a sufferer
                  @endif

              @endif

            </td>
            <td><b>Relation with :</b> 
              @if($casealllists->relation != "NULL")
              {{ $casealllists->relation }}
              @endif</td>
          </tr>
          <tr>
            <td><b>Complaint Against :</b> 
              @if($casealllists->application_against != "NULL")
              {{ $casealllists->application_against }}
              @endif
            </td>
            <td><b>Name :</b> 
              @if($casealllists->accused != "NULL")
              {{ $casealllists->accused }}
              @endif
            </td>
          </tr>
          <tr>
            <td><b>Agent name:</b> 
              @if($casealllists->broker_name != "NULL")
              {{ $casealllists->broker_name }}
              @endif
            </td>
            <td><b>Agent mobile no:</b> 
              @if($casealllists->broker_mobile_no != "NULL")
              {{ $casealllists->broker_mobile_no }}
              @endif</td>
          </tr>
          <tr>
            <td><b>Name :</b> 
              @if($casealllists->applicant_name != "NULL")
              {{ $casealllists->applicant_name }}
              @endif</td>
            <td><b>Country :</b> 
              @if($casealllists->applicant_country != "NULL")
              {{ $casealllists->applicant_country }}
              @endif</td>
          </tr>
          <tr>
            <td><b>Email :</b> 
              @if($casealllists->applicant_email != "NULL")
              {{ $casealllists->applicant_email }}
              @endif
            </td>
            <td><b>Mobile No :</b> 
              @if($casealllists->applicant_mobile_no != "NULL")
              {{ $casealllists->applicant_mobile_no }}
              @endif</td>
          </tr>
          <tr>
            <td colspan="2"><b>Address :</b> 
              @if($casealllists->applicant_address != "NULL")
              {{ $casealllists->applicant_address }}
              @endif</td>
          </tr>
        </table>
        <ul class="list-group">
          <li class="list-group-item list-group-item-danger">Problem Type</li>
          <?php $problemDetails = HomeController::getProblemDetails($casealllists->case_id); ?>
          @foreach($problemDetails as $problemDetailss)
            <li class="list-group-item">{{ $problemDetailss->compliance_description }}</li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-success">
      <div class="panel-heading">Complaint Details</div>
      <div class="panel-body">
        <p>@if($casealllists->application_text != "NULL")
            {{ strip_tags($casealllists->application_text) }}
          @endif
        </p>
      </div>
    </div>
  </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-danger">
            <div class="panel-heading">Add Note</div>
            <div class="panel-body">
                <div class="col-lg-12">
                <div class="col-lg-12">
                    <textarea class="form-control" name="observation" style="height: 300px"></textarea><br>
                </div>
                <div class="col-lg-3">
                    <label>Document Upload</label>
                    <input type="file" name="supportingDoc[]" multiple="multiple" class="btn btn-default">
                </div>
            </div>
        </div>
    </div>
</div>


  <div class="col-lg-12">
    <div class="panel panel-success">
      <div class="panel-heading">Hearing Letter Tracking History</div>
      <div class="panel-body">
        <table class="table table-bordered">
          <tr>
            <th width="10%">Tracking no</th>
            <th width="10%">Created By</th>
            <th width="60%">Note</th>
            <th width="10%">Status</th>
            <th width="10%">Date</th>
          </tr>
            <?php //dd($hearing_tracking); ?>
            @foreach($hearing_tracking as $hearing_trackings)
              <tr>
            
                <td>
                    @if($hearing_trackings->status == "Save")
                      <a href="{{ url('hearing_letter/'.$hearing_trackings->id) }}">
                          {{ $hearing_trackings->tracking_no }}
                      </a>
                    @elseif($hearing_trackings->status == "Done")
                      <a href="{{ url('hearing_letter_view/'.$hearing_trackings->id) }}">
                          {{ $hearing_trackings->tracking_no }}
                      </a>
                    @endif
                  </td>
                  <td>
                    <?php 
                      $name =HomeController::getIdToName($hearing_trackings->created_by);
                      echo $name->name; 
                    ?>  
                  </td>
                  <td>
                    <?php  
                      $note = $hearing_trackings->note;
                      echo substr($note,0,100);
                    ?>
                  </td>
                  <td>
                      @if($hearing_trackings->status == "Save")
                        <span class="label label-primary">
                          {{ $hearing_trackings->status }}
                        </span>
                      @elseif($hearing_trackings->status == "Done")
                        <span class="label label-success">
                          Send
                        </span>
                      @endif

                  </td>
                  <td>{{ $hearing_trackings->created_at }}</td>
                </a>
            
              </tr>
            @endforeach
          
        </table>
      </div>
    </div>
  </div>

  <div class="col-lg-12">
    <div class="panel panel-success">
        <div class="panel-heading">Hearing Letter Generate </div>
        <div class="panel-body">
          <form method="POST" action="{{ url('committeeletter') }}" accept-charset="UTF-8" id="differentForm">
            {{ csrf_field() }}
             <!-- /.row -->
            <div class="row">
              <div class="col-lg-10" style="text-align: center;">
                <p>গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</p>
                <p><b>জনশক্তি, কর্মসংস্থান ও প্রশিক্ষণ ব্যুরো</b></p>
                <p>৮৯/২, কাকরাইল, ঢাকা-১০০০</p>
              </div>
              <div class="col-lg-2">
                <h6>রেজিস্টার্ড <br><input type="number" name="register_no" style="width: 35px" required> শুনানী</h6>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-8" style="text-align: left;">
                <p>নং: <input required type="text" name="sunani_no" value="৪৯.০১.০০০০.০২২.৩১.৫২০.১৬-" style=" border: none; border-bottom: 1px solid #ccc; width: 250px;"></p> 
              </div>
              <div class="col-lg-4" style="text-align: right;">
                <p>তারিখ: <input required type="date" name="hearing_generate_date" value="18-09-2018" min="<?php
                  echo date("Y-m-d");
                ?>" style=" border: none; border-bottom: 1px solid #ccc; width: 130px;"></p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12" style="text-align: left;">

                <p>বিষয়: <u> "<?php if(isset($commitee_letter_member->agency_name)){ echo $commitee_letter_member->agency_name; } ?>", এর বিরুদ্ধে আনীত অভিযোগ তদন্ত প্রসঙ্গে।</u></p>
                <p>সূত্র : <u>স্মারক নং <?php if(isset($commitee_letter_member->committee_no)){ echo $commitee_letter_member->committee_no; } ?></u> তারিখ : <input required type="date" name="sarok_generate_date" style=" border: none; border-bottom: 1px solid #ccc; width: 130px;" value="<?php if(isset($commitee_letter_member->generate_date)){ echo $commitee_letter_member->generate_date; } ?>"></u></p>
                <input type="hidden" name="committee_no" value="<?php if(isset($commitee_letter_member->committee_no)){ echo $commitee_letter_member->committee_no; } ?>">
                    </div>
                  <br>
               <input type="hidden" name="sufferer_name" value="{{ $casealllists->sufferer_name }}">

               <div class="col-lg-12" style="align-content: center; padding: 20px">
                 <div class="col-lg-6" style="text-align: left; height: 100px;float: left; padding:5px 200px 5px 50px;">
                  <p><u>বাদীর নাম ও ঠিকানা </u></p>
                  <p>১।বাদীর নাম : 
                    @if(isset($commitee_letter_member->suffrer_name)) {{ $commitee_letter_member->suffrer_name }} @endif<br>
                      পিতা: <input type="text" required name="sufferer_father" style="border: none; border-bottom: 1px solid #ccc; width: 150px" maxlength="30"> <br><br>
                      ঠিকানা : <input type="text" name="sufferer_address" value="@if($casealllists->sufferer_current_address != 'NULL'){{ $casealllists->sufferer_current_address }} @endif" style="border: none; border-bottom: 1px solid #ccc; width: 150px" autofocus required maxlength="200"></p>
                      </div>
                      <div class="col-lg-6" style="text-align: left; height: 100px; float: left;padding:5px 50px 5px 200px;">
                        <p><u>বিবাদীর নাম ও ঠিকানা </u></p>
                        <p>১।এজেন্সী নাম : 
                          <input required type="text" name="agency_name" value="<?php if(isset($commitee_letter_member->agency_name)){ echo $commitee_letter_member->agency_name; } ?>" style="border: none; border-bottom: 1px solid #ccc" style="border: none; border-bottom: 1px solid #ccc" maxlength="20"> <br>
                          এজেন্সী ঠিকানা : <input required type="text" name="agency_address" style="border: none; border-bottom: 1px solid #ccc" value="<?php if(isset($commitee_letter_member->address )){ echo $commitee_letter_member->address; } ?>">
                          <br>
                            ফোন : <input required type="text" name="agency_mobile_no" value="<?php if(isset($commitee_letter_member->mobile_number )){ echo $commitee_letter_member->mobile_number; } ?>" style="border: none; border-bottom: 1px solid #ccc"><br>
                            
                        </p>
                      </div>
                       </div>
                       <br>
                       <br>
                    <div class="row">
                      <div class="col-lg-12" required style="text-align: left; height: 400px;padding-left: 30px">
                        <br>
                      <br>
                     <br>

                    <p>উপযুক্ত বিষয় ও সূত্রের প্রেক্ষিতে জানানো যাচ্ছে যে , বাদী  বাদীর নাম , কর্তৃক রিক্রুটিং এজেন্সি  রিক্রুটিং এজেন্সী নাম, এর বিরুদ্ধে আনীত অভিযোগ তদন্তের জন্য দুই সদস্য বিশিষ্ট একটি তদন্ত কমিটি গঠন করা হয়েছে।</p>
                    <br>
                    <p>০২। আগামী <input required type="date" name="hearing_full_date"  min="<?php
                  echo date("Y-m-d");
                ?>" style=" border: none; border-bottom: 1px solid #ccc; width: 130px;">তারিখ  রোজ <input required type="text" name="hearing_day"  maxlength="20" style=" border: none; border-bottom: 1px solid #ccc; width: 100px;" placeholder="রবিবার সকাল"> <input required type="time" name="hearing_time" value="time" style=" border: none; border-bottom: 1px solid #ccc; width: 100px;"> ঘটিকায় নিন্মস্বাক্ষরকারীর অফিস কক্ষে ( জনশক্তি, কর্মসসস্থান ও প্রশিক্ষণ ব্যুরো, ৮ম তলা, ৮৯/২, কাকরাইল, ঢাকা ) অভিযোগের ১ম শুনানী গ্রহণ করবেন।অভিযোগ শুনানীর সময় বাদী/বিবাদীগণকে উপযুক্ত সাক্ষ্য প্রমানাদি সহকারে তদন্ত কমিটির সম্মুখে হাজির হয়ে নিজ নিজ বক্তব্য পেশ করার জন্য অনুরোধ করা হলো। শুনানির জন্য নির্ধারিত তারিখে নিদ্দিষ্ট সময়ে বাদী/বিবাদীগণ উপস্থিত হতে ব্যর্থ হলে অভিযোগ সম্পর্কে কিছু  বলার নেই বলে গণ্য হবে এবং অভিযোগ সম্পর্কে একতরফা সিদ্ধান্ত গ্রহণ করা হবে।</p>
                    <br>
                    <br>
                    <br>
                      <div style="float: right; display: block; text-align: center; height: 300px; padding: 10px ">
                        <p>@if(isset($commitee_letter_member->officer_name2))
                            {{ $commitee_letter_member->officer_name2 }}
                           @endif
                        </p>
                        <p>উপপরিচালক (অর্থ, বাজেট ও আইটি )</p>
                        <p>বিএমআইটি , ঢাকা </p>
                        <p>ও<br>তদন্ত কর্মর্কর্তা </p>
                      </div>
                    <br>
                    <br>
                     <div class="row" style=" text-align: left;float: left; padding-left: 30px">
                          <p><u><b>অবগতির জন্য অনুলিপিঃ-</b></u></p><br>
                          <p>০১। @if(isset($commitee_letter_member->officer_name1))
                            {{ $commitee_letter_member->officer_name1 }}
                           @endif ,সহকারী পরিচালক, বিএমআইটি , ঢাকা ও তদন্ত কর্মর্কর্তা 
                          <br>০২। <?php if(isset($commitee_letter_member->agency_name)){ echo $commitee_letter_member->agency_name; } ?> ,<?php if(isset($commitee_letter_member->address)){ echo $commitee_letter_member->address; } ?> <br>
                          ০৩। @if(isset($commitee_letter_member->suffrer_name))
                                        {{ $commitee_letter_member->suffrer_name }} 
                                       @endif,@if(isset($commitee_letter_member->address))
                                {{ $commitee_letter_member->address }} 
                               @endif</p>
                      </div>
                              
                          </div>
                        </div><br>
                        </form>

                      </div>
                  </div>
                <br><br><br>
                @if(isset($commitee_letter_member->officer_name2) || isset($commitee_letter_member->officer_name1))
                    <button type="submit" class="btn btn-default" name="save">Save</button>
                    <button type="submit" class="btn btn-info" name="assign" id="assign">Send</button>
                @else
                    <div class="alert alert-info" style="font-size: 20px">
                      <strong>Info!</strong> You can not start inquiry process because committee letter not generated yet.
                    </div>
                @endif
                

            </div>

          </form>
        </div>
    </div>
{{ Form::close() }}



<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-success">
      <div class="panel-heading">Generate report</div>
      <div class="panel-body">
        @if($report_count == 0)
          <a href="{{ url('generate_report/'.$casealllists->applicantTrackingNo) }}" class="btn btn-success">Click here for generate report</a>
        @else
          <a href="{{ url('reportGenerateView/'.$casealllists->applicantTrackingNo) }}" class="btn btn-success">Click here for view report</a>
        @endif
      </div>
    </div>
  </div>
</div>



@if(isset($commitee_letter_member->officer_name2) || isset($commitee_letter_member->officer_name1))
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-success">
      <div class="panel-heading">Case Decision</div>
      <div class="panel-body">
        <form action="{{ url('CaseComplete') }}" method="post">
          <input type="hidden" name="tracking_no" value="{{ $casealllists->applicantTrackingNo }}">
          {{ csrf_field() }}
          <button type="submit" class="btn btn-success" name="complete" id="complete">Complete</button>
          <button type="submit" class="btn btn-danger" name="incomplete" id="incomplete">Incomplete</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endif  



  </div>
  </div>





@endforeach

@endsection
