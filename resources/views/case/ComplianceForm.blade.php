
@extends('theme.default')
@section('content')
<style type="text/css">
  #divLoading
{
    display : none;
}
#divLoading.show
{
    display : block;
    position : fixed;
    z-index: 100;
    background-image : url('http://loadinggif.com/images/image-selection/3.gif');
    background-color:#666;
    opacity : 0.4;
    background-repeat : no-repeat;
    background-position : center;
    left : 0;
    bottom : 0;
    right : 0;
    top : 0;
}
#loadinggif.show
{
    left : 50%;
    top : 50%;
    position : absolute;
    z-index : 101;
    width : 32px;
    height : 32px;
    margin-left : -16px;
    margin-top : -16px;
}
div.content {
   width : 1000px;
   height : 1000px;
}
</style>
<script language="javascript">
  function validate(){
  var chks = document.getElementsByName('complaint_list[]');
  var hasChecked = false;
  for (var i = 0; i < chks.length; i++)
  {
    if (chks[i].checked)
    {
    hasChecked = true;
    break;
    }
  }

  if (hasChecked == false)
    {
    document.getElementById("error").innerHTML = "Please select one complain";
    return false;
    }

  return true;
  }
</script>
<div class="row" style="background-color: #00097c;color: #fff; margin-bottom: 10px">
    <div class="col-lg-12">
        <div class="panel-heading">অনলাইন অভিযোগ ফরম</div>
    </div>
    <!-- /.col-lg-12 -->
</div>
@if(Session::has('message')) 
    <div class="alert alert-info"> {{Session::get('message')}} </div> 
@endif

@if($errors->has('complianeFor'))
  <div class="alert alert-info"> {{ $errors->first('complianeFor') }} </div>
@endif
@if($errors->has('relation'))
<div class="alert alert-info"> {{ $errors->first('relation') }} </div>
@endif
@if($errors->has('complaint_against'))
<div class="alert alert-info"> {{ $errors->first('complaint_against') }} </div>
@endif
@if($errors->has('complaint_against_name'))
<div class="alert alert-info"> {{ $errors->first('complaint_against_name') }} </div>
@endif
@if($errors->has('complaint_against_name_others'))
<div class="alert alert-info"> {{ $errors->first('complaint_against_name_others') }} </div>
@endif
@if($errors->has('broker_name'))
<div class="alert alert-info"> {{ $errors->first('broker_name') }} </div>
@endif
@if($errors->has('brokers_mobile_no'))
<div class="alert alert-info"> {{ $errors->first('brokers_mobile_no') }} </div>
@endif
@if($errors->has('complainant_name'))
<div class="alert alert-info"> {{ $errors->first('complainant_name') }} </div>
@endif
@if($errors->has('complainant_country'))
<div class="alert alert-info"> {{ $errors->first('complainant_country') }} </div>
@endif
@if($errors->has('complainant_address'))
<div class="alert alert-info"> {{ $errors->first('complainant_address') }} </div>
@endif
@if($errors->has('complainant_email'))
<div class="alert alert-info"> {{ $errors->first('complainant_email') }} </div>
@endif
@if($errors->has('complainant_mobile'))
<div class="alert alert-info"> {{ $errors->first('complainant_mobile') }} </div>
@endif
@if($errors->has('victim_name'))
<div class="alert alert-info"> {{ $errors->first('victim_name') }} </div>
@endif
@if($errors->has('victim_mobile'))
<div class="alert alert-info"> {{ $errors->first('victim_mobile') }} </div>
@endif
@if($errors->has('victim_nationality'))
<div class="alert alert-info"> {{ $errors->first('victim_nationality') }} </div>
@endif
@if($errors->first('victim_country_name'))
<div class="alert alert-info"> {{ $errors->first('victim_country_name') }} </div>
@endif
@if($errors->has('victim_address'))
<div class="alert alert-info"> {{ $errors->first('victim_address') }} </div>
@endif
@if($errors->has('victim_passport'))
<div class="alert alert-info"> {{ $errors->first('victim_passport') }} </div>
@endif
@if($errors->has('victim_local_no'))
<div class="alert alert-info"> {{ $errors->first('victim_local_no') }} </div>
@endif
@if($errors->has('victim_district'))
<div class="alert alert-info"> {{ $errors->first('victim_district') }} </div>
@endif
@if($errors->has('victim_upazilla'))
<div class="alert alert-info"> {{ $errors->first('victim_upazilla') }} </div>
@endif
@if($errors->has('victim_local_address'))
<div class="alert alert-info"> {{ $errors->first('victim_local_address') }} </div>
@endif
@if($errors->has('complaint_list'))
<div class="alert alert-info"> {{ $errors->first('complaint_list') }} </div>
@endif
@if($errors->has('complaint_description'))
<div class="alert alert-info"> {{ $errors->first('complaint_description') }} </div>
@endif
@if($errors->has('support_doc'))
<div class="alert alert-info"> {{ $errors->first('support_doc') }} </div>
@endif
@if($errors->has('complaint_description'))
<div class="alert alert-info"> {{ $errors->first('complaint_description') }} </div>
@endif

<!-- /.row -->
{!! Form::open(array('url' => 'complianceCreate','method'=>'POST','files'=>true, 'id'=>'myFormId' , 'onSubmit' => 'return validate()')) !!}
<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
<div class="row">
  <div class="panel panel-primary">
    <div class="panel-body">
      <div class="col-lg-6">
        <div class="form-group">
          <label for="exampleInputEmail1">আপনি নিজের জন্য বা অন্য কারো জন্য অভিযোগ করছেন?
            <span style="color: red">*</span></label>
          <select class="form-control" id="complianeFor" name="complianeFor" 
          onchange="complaince_set(this.value)">
              <option value="own">ইতিমধ্যে বিদেশ গমন করেছেন </option>
              <option value="own_other">বিদেশ গমন করবেন  </option>
              <option value="other">অন্য কেউ</option>

          </select>
        </div>
        <div class="form-group" id="showOther" style="display: none;">
          <label for="exampleInputEmail1">ব্যক্তির সাথে আপনার সম্পর্ক কি?<span style="color: red">*</span></label>
          <select class="form-control" name="relation" id="relation">
            <option value="">Select relation ...</option>
            <option value="বাবা">বাবা</option>
            <option value="মা">মা</option>
            <option value="ভাই">ভাই</option>
            <option value="বোন">বোন</option>
            <option value="আঙ্কেল">আঙ্কেল</option>
            <option value="অপরিচিত ব্যক্তি">অপরিচিত ব্যক্তি</option>
            <option value="দূর সম্পর্কের আত্মীয়">দূর সম্পর্কের আত্মীয়</option>
            <option value="আমি প্রকাশ করতে চাই না">আমি প্রকাশ করতে চাই না</option>
          </select>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">আপনার অভিযোগটি কার বিরুদ্ধে? <span style="color: red">*</span></label>
          <select class="form-control" name="complaint_against" onchange="change_agent(this.value)" id="complaint_against">
            <option value="agent">এজেন্ট(দালাল)</option>
            <option value="recruiting_agency">রিক্রুটিং এজেন্সী</option>
            <option value="company">অন্যান্য</option>
            <option value="specific_person">নির্দিষ্ট ব্যক্তি</option>
            <option value="appointed_officer">নিয়োগ কর্তা</option>
          </select>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">



          <div id="company_part">
            <label for="exampleInputEmail1">অন্যান্য  নাম<span style="color: red">*</span></label>
          
            <input type="text" class="form-control" id="company_name" name="company_name" maxlength="50">
            <br>
            <label for="exampleInputEmail1">অন্যান্য  মোবাইল নং<span style="color: red">*</span></label>

            <input type="text"  maxlength="20" class="form-control" id="company_mobile_no" name="company_mobile_no">

          </div>



          <div id="person_part">
            <label for="exampleInputEmail1">নিদ্দিষ্ট ব্যাক্তি নাম<span style="color: red">*</span></label>
          
            <input type="text" class="form-control" id="person_name" name="person_name" maxlength="50">
            <br>
            <label for="exampleInputEmail1">নিদ্দিষ্ট ব্যাক্তি মোবাইল নং<span style="color: red">*</span></label>

            <input type="text" maxlength="20" class="form-control" id="person_mobile_no" name="person_mobile_no">

          </div>



          <div id="agent_part">
            
            <label for="exampleInputEmail1">এজেন্টের(দালালের) নাম <span style="color: red">*</span></label>
          
            <input type="text" class="form-control" id="broker_name" name="agent_name" maxlength="50">
            <br>
            <label for="exampleInputEmail1">এজেন্টের(দালালের) মোবাইল নং<span style="color: red">*</span></label>

            <input type="text" maxlength="20" class="form-control" id="broker_mobile_no" name="agent_mobile_no">

          </div>



          <div id="officer_part">
            
            <label for="exampleInputEmail1">নিয়োগ কর্তা  নাম<span style="color: red">*</span></label>
          
            <input type="text" maxlength="50" class="form-control" id="officer_name" name="officer_name">
            <br>
            <label for="exampleInputEmail1">নিয়োগ কর্তা  মোবাইল নং<span style="color: red">*</span></label>

            <input type="text" maxlength="20" class="form-control" id="officer_mobile_no" name="officer_mobile_no">

          </div>



          <div id="agency_part">
            <label for="exampleInputEmail1">রিক্রুটিং এজেন্সির নাম<span style="color: red">*</span></label>
          
            <select class="form-control" id="agency_name" name="agency_name">
              <option value="">Please select agency name</option>
              @foreach($agencyName as $agencyNames)
                <option value="{{ $agencyNames->agency_name }}">{{ $agencyNames->agency_name }}</option>
              @endforeach
            </select>
            <br><br>
            <label for="exampleInputEmail1">রিক্রুটিং এজেন্সির  মোবাইল নং<span style="color: red">*</span></label>
            <input type="text" maxlength="20" class="form-control" id="agency_mobile_no" name="agency_mobile_no" >
          </div>




        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="panel panel-success">
    <div class="panel-heading" style="background-color: #00097c;color: #fff">অর্থ লেনদেনকারীর তথ্য </div>
    <div class="panel-body">
      <div class="col-lg-6">
        <div class="form-group">
          <label for="exampleInputEmail1">ব্যাক্তির নাম <span style="color: red">*</span></label>
          <input type="text" name="money_taker_name" id="money_taker_name" class="form-control" maxlength="50">
        </div>

      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <label for="exampleInputEmail1">ব্যাক্তির ফোন নাম্বার <span style="color: red">*</span></label>
          <input type="text" name="money_taker_phone_no" id="money_taker_phone_no" class="form-control" maxlength="50">
        </div>

      </div>
    </div>
  </div>
</div>

<div class="row" id="others">
  <div class="panel panel-success">
    <div class="panel-heading" style="background-color: #00097c;color: #fff">অভিযোগকারীর তথ্য</div>
    <div class="panel-body">
      <div class="col-lg-6">
        <div class="form-group">
          <label for="exampleInputEmail1">অভিযোগকারীর  নাম <span style="color: red">*</span></label>
          <input type="text" name="complainant_name" id="complainant_name" class="form-control" maxlength="50">
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">দেশ:</label>
          <select class="form-control" name="complainant_country" id="complainant_country">
              <option value="">দেশ নির্বাচন করুন</option>
              @foreach($apps_country as $apps_countries)
                <option value="{{ $apps_countries->country_name }}">{{ $apps_countries->country_name }}</option>
              @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">ঠিকানা</label>
          <textarea class="form-control" name="complainant_address" id="complainant_address" maxlength="700"></textarea>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <label for="exampleInputEmail1">ইমেইল</label>
          <input type="text" class="form-control" id="complainant_email" name="complainant_email" maxlength="50">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">মোবাইল নম্বর <span style="color: red">*</span></label>
          <input type="text" class="form-control" id="complainant_mobile" name="complainant_mobile" maxlength="20">
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="panel panel-info">
    <div class="panel-heading" style="background-color: #00097c;color: #fff">ভুক্ত ভোগীর তথ্য</div>
    <div class="panel-body">
      <div class="col-lg-6">
        <div class="form-group">
          <label for="exampleInputEmail1">ভুক্ত ভোগীর নাম <span style="color: red">*</span></label>
          <input type="text" class="form-control" maxlength="50" name="victim_name" id="victim_name" required  value="{{ old('victim_name') }}">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">মোবাইল নং <span style="color: red">*</span></label>
          <input type="text" class="form-control" maxlength="20" name="victim_mobile" id="victim_mobile" required  value="{{ old('victim_mobile') }}">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">জাতীয়তা</label>
          <input type="text" class="form-control" maxlength="50" name="victim_nationality" id="victim_nationality">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">অবস্থানরত দেশের নাম / গন্তব্য দেশের নাম<span style="color: red">*</span></label>
          <select class="form-control" name="victim_country_name" id="victim_country_name">
            <option value="">দেশ নির্বাচন করুন </option>
            @foreach($apps_country as $apps_countries)
                <option value="{{ $apps_countries->country_name }}">{{ $apps_countries->country_name }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">বর্তমান যোগাযোগের ঠিকানা: </label>
          <textarea style="height: 35px" maxlength=700" class="form-control" name="victim_address" id="victim_address"></textarea>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <label for="exampleInputEmail1">লিঙ্গ <span style="color: red">*</span></label>
          <select class="form-control" style="color:000" name="gender" id="gender" required>
            <option value="">লিঙ্গ</option>
            <option value="Male">পুরুষ</option>
            <option value="Female">মহিলা</option>
            <option value="Other">অন্যান্য</option>
          </select>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">পাসপোর্ট নং <span style="color: red" id="passport_warning">*</span></label>
          <input type="text" class="form-control" id="victim_passport" name="victim_passport"  value="{{ old('victim_passport') }}" maxlength="50">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">লোকাল নম্বর</label>
          <input type="text" class="form-control" id="victim_local_no" name="victim_local_no" maxlength="20">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">জেলা</label>
          <input type="text" class="form-control" id="victim_district" name="victim_district" maxlength="50">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">উপজেলা</label>
          <input type="text" class="form-control" id="victim_upazilla" name="victim_upazilla" maxlength="50">
        </div>
      </div>
      <div class="col-lg-12">
        <div class="form-group">
          <label for="exampleInputEmail1">স্থানীয় ঠিকানা<span style="color: red">*</span> </label>
          <textarea style="color:000" maxlength="700" class="form-control" name="victim_local_address" id="victim_local_address" required></textarea>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="panel panel-info">
    <div class="panel-body">
      <div class="col-lg-12">
        <h3>আপনার অভিযোগের বিবরণ:<span style="color: red">*<span style="font-size: 14px" id="error"></span></span> </h3>

          <div class="col-lg-6">
            <div class="form-group inline">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="complaint_list[]" id="complaint_list[]" value="2">
                <label class="form-check-label" for="inlineCheckbox2">থাকার সমস্যা </label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="complaint_list[]" id="complaint_list[]" value="4">
                <label class="form-check-label" for="inlineCheckbox1">চাকুরী নাই </label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="complaint_list[]" id="complaint_list[]" value="14">
                <label class="form-check-label" for="inlineCheckbox1">এয়ারপোর্টে আটকা পড়া </label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="complaint_list[]" id="complaint_list[]" value="15">
                <label class="form-check-label" for="inlineCheckbox1">অতিরিক্ত কাজ </label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="complaint_list[]" id="complaint_list[]" value="12">
                <label class="form-check-label" for="inlineCheckbox3">অন্যান্য </label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="complaint_list[]" id="complaint_list[]" value="7">
                <label class="form-check-label" for="inlineCheckbox1">খাওয়ার সমস্যা </label>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group inline">

              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="complaint_list[]" id="complaint_list[]" value="5">
                <label class="form-check-label" for="inlineCheckbox1">work permit / আকামা না পাওয়া </label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="complaint_list[]" id="complaint_list[]" value="6">
                <label class="form-check-label" for="inlineCheckbox1">জেলে আটকে  পড়া</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="complaint_list[]" id="complaint_list[]" value="8">
                <label class="form-check-label" for="inlineCheckbox1"> শারীরিক নির্যাতন / মানষিক নির্যাতন</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="complaint_list[]" id="complaint_list[]" value="9">
                <label class="form-check-label" for="inlineCheckbox1"> পরিবারের  সাথে যোগাযোগ করতে দেয় না </label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="complaint_list[]" id="complaint_list[]" value="11">
                <label class="form-check-label" for="inlineCheckbox1">বেতন জনিত সমস্যা </label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="complaint_list[]" id="complaint_list[]" value="13">
                <label class="form-check-label" for="inlineCheckbox1">কাজ না পাওয়া   </label>
              </div>
              
              
            </div>
          </div>
        </div>
      <div class="col-lg-12">
        <div class="form-group">
          <label for="exampleInputEmail1">দয়া করে আপনার অভিযোগ, বা সমস্যা বর্ণনা করুন, সম্পূর্ণ বিশদ বিবরণ দিন (যেমন তারিখ, জড়িত অর্থ, কোম্পানির চাকরির বছর, জড়িত ব্যক্তিদের নাম ইত্যাদি)</label>
          <textarea class="form-control" style="height: 200px" name="complaint_description" maxlength="700"></textarea>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="form-group">
          <label for="exampleInputEmail1">প্রমাণাদি:[ওয়ার্ক পারমিট, ভিসা/এনওসি, নিয়োগপত্র, টাকার রশিদ , ফাইল , ভিডিও (সর্বোচ্চ ১০ mb ) , অডিও (সর্বোচ্চ ১০ mb )  ইত্যাদি]</label>
          <input type="file" name="support_doc[]" id="support_doc[]" class="btn btn-default" accept=".gif,.jpg,.png,.doc,.mp4,.mp3,pdf,.docx,.doc" multiple>
        </div>
      </div>
    </div>
  </div>
<hr>
  <button type="button" class="btn btn-success" onclick="previewButton()">Preview</button>
  <button type="submit" class="btn btn-primary">Save</button>

  <div id="divLoading"></div>
{{ Form::close() }}
<hr>


<script type="text/javascript">

  function previewButton(){
    $("div#divLoading").addClass('show');
    var queryString = $('#myFormId').serialize();

    $.ajax({
           type:"GET",
           url:"{{ url('queryString') }}",
           dataType: "json",
           data:"queryString="+JSON.stringify(queryString),
           success:function(res){  
            setTimeout(function(){ 
              $("#myModalTest").modal();
              $("#preview_data").html(res.data); 
              $("div#divLoading").removeClass('show');
            },
            5000);
            
          }
    });
  };

  function printDiv(divName) {
     
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     window.location.reload();
  }



  var uploadField = document.getElementById("support_doc[]");

  uploadField.onchange = function() {
    console.log(this.files.length);

    var total;
    for (i = 0; i <= this.files.length-1; i++) {
        total = this.files[i].size;
    } 
    if(total > 10000000){
      $(this).val('');
      alert("Please select less than 10 mb file");

    }

  };

</script>
<script type="text/javascript">
    
          
          document.getElementById("agency_part").style.display = "none";
          document.getElementById("agency_name").required = false;
          document.getElementById("agency_mobile_no").required = false;


          document.getElementById("agent_part").style.display = "block";
          document.getElementById("broker_name").required = true;
          document.getElementById("broker_mobile_no").required = true;


          document.getElementById("company_part").style.display = "none";
          document.getElementById("company_mobile_no").required = false;
          document.getElementById("company_name").required = false;

          document.getElementById("person_part").style.display = "none";
          document.getElementById("person_mobile_no").required = false;
          document.getElementById("person_name").required = false;


          document.getElementById("officer_part").style.display = "none";
          document.getElementById("officer_mobile_no").required = false;
          document.getElementById("officer_name").required = false;

 function change_agent(value){
      
      if(value == "recruiting_agency"){
        console.log(value);
          document.getElementById("agency_part").style.display = "block";
          document.getElementById("agency_name").required = true;
          document.getElementById("agency_mobile_no").required = true;
          document.getElementById("agency_name").removeAttribute("disabled");
          document.getElementById("agency_mobile_no").removeAttribute("disabled");


          document.getElementById("agent_part").style.display = "none";
          document.getElementById("broker_name").required = false;
          document.getElementById("broker_mobile_no").required = false;
          document.getElementById("broker_name").setAttribute("disabled","disabled");
          document.getElementById("broker_mobile_no").setAttribute("disabled","disabled");


          document.getElementById("company_part").style.display = "none";
          document.getElementById("company_mobile_no").required = false;
          document.getElementById("company_name").required = false;
          document.getElementById("company_mobile_no").setAttribute("disabled","disabled");
          document.getElementById("company_name").setAttribute("disabled","disabled");


          document.getElementById("person_part").style.display = "none";
          document.getElementById("person_mobile_no").required = false;
          document.getElementById("person_name").required = false;
          document.getElementById("person_mobile_no").setAttribute("disabled","disabled");
          document.getElementById("person_name").setAttribute("disabled","disabled");

          document.getElementById("officer_part").style.display = "none";
          document.getElementById("officer_mobile_no").required = false;
          document.getElementById("officer_name").required = false;
          document.getElementById("officer_mobile_no").setAttribute("disabled","disabled");
          document.getElementById("officer_name").setAttribute("disabled","disabled");



        
      }
      if(value == "agent"){
        console.log(value);
          document.getElementById("agency_part").style.display = "none";
          document.getElementById("agency_name").required = false;
          document.getElementById("agency_mobile_no").required = false;
          document.getElementById("agency_name").setAttribute("disabled","disabled");
          document.getElementById("agency_mobile_no").setAttribute("disabled","disabled");


          document.getElementById("agent_part").style.display = "block";
          document.getElementById("broker_name").required = true;
          document.getElementById("broker_mobile_no").required = true;
          document.getElementById("broker_name").removeAttribute("disabled");
          document.getElementById("broker_mobile_no").removeAttribute("disabled");


          document.getElementById("company_part").style.display = "none";
          document.getElementById("company_mobile_no").required = false;
          document.getElementById("company_name").required = false;
          document.getElementById("company_mobile_no").setAttribute("disabled","disabled");
          document.getElementById("company_name").setAttribute("disabled","disabled");


          document.getElementById("person_part").style.display = "none";
          document.getElementById("person_mobile_no").required = false;
          document.getElementById("person_name").required = false;
          document.getElementById("person_mobile_no").setAttribute("disabled","disabled");
          document.getElementById("person_name").setAttribute("disabled","disabled");

          document.getElementById("officer_part").style.display = "none";
          document.getElementById("officer_mobile_no").required = false;
          document.getElementById("officer_name").required = false;
          document.getElementById("officer_mobile_no").setAttribute("disabled","disabled");
          document.getElementById("officer_name").setAttribute("disabled","disabled");
        
      }
      if(value == "company"){
        console.log(value);
          document.getElementById("agency_part").style.display = "none";
          document.getElementById("agency_name").required = false;
          document.getElementById("agency_mobile_no").required = false;
          document.getElementById("agency_name").setAttribute("disabled","disabled");
          document.getElementById("agency_mobile_no").setAttribute("disabled","disabled");


          document.getElementById("agent_part").style.display = "none";
          document.getElementById("broker_name").required = false;
          document.getElementById("broker_mobile_no").required = false;
          document.getElementById("broker_name").setAttribute("disabled","disabled");
          document.getElementById("broker_mobile_no").setAttribute("disabled","disabled");


          document.getElementById("company_part").style.display = "block";
          document.getElementById("company_mobile_no").required = true;
          document.getElementById("company_name").required = true;
          document.getElementById("company_mobile_no").removeAttribute("disabled");
          document.getElementById("company_name").removeAttribute("disabled");


          document.getElementById("person_part").style.display = "none";
          document.getElementById("person_mobile_no").required = false;
          document.getElementById("person_name").required = false;
          document.getElementById("person_mobile_no").setAttribute("disabled","disabled");
          document.getElementById("person_name").setAttribute("disabled","disabled");

          document.getElementById("officer_part").style.display = "none";
          document.getElementById("officer_mobile_no").required = false;
          document.getElementById("officer_name").required = false;
          document.getElementById("officer_mobile_no").setAttribute("disabled","disabled");
          document.getElementById("officer_name").setAttribute("disabled","disabled");
        
      }

      if(value == "specific_person"){
        console.log(value);
          document.getElementById("agency_part").style.display = "none";
          document.getElementById("agency_name").required = false;
          document.getElementById("agency_mobile_no").required = false;
          document.getElementById("agency_name").setAttribute("disabled","disabled");
          document.getElementById("agency_mobile_no").setAttribute("disabled","disabled");


          document.getElementById("agent_part").style.display = "none";
          document.getElementById("broker_name").required = false;
          document.getElementById("broker_mobile_no").required = false;
          document.getElementById("broker_name").setAttribute("disabled","disabled");
          document.getElementById("broker_mobile_no").setAttribute("disabled","disabled");


          document.getElementById("company_part").style.display = "none";
          document.getElementById("company_mobile_no").required = false;
          document.getElementById("company_name").required = false;
          document.getElementById("company_mobile_no").setAttribute("disabled","disabled");
          document.getElementById("company_name").setAttribute("disabled","disabled");


          document.getElementById("person_part").style.display = "block";
          document.getElementById("person_mobile_no").required = true;
          document.getElementById("person_name").required = true;
          document.getElementById("person_mobile_no").removeAttribute("disabled");
          document.getElementById("person_name").removeAttribute("disabled");

          document.getElementById("officer_part").style.display = "none";
          document.getElementById("officer_mobile_no").required = false;
          document.getElementById("officer_name").required = false;
          document.getElementById("officer_mobile_no").setAttribute("disabled","disabled");
          document.getElementById("officer_name").setAttribute("disabled","disabled");
        
      }


      if(value == "appointed_officer"){
        console.log(value);
          document.getElementById("agency_part").style.display = "none";
          document.getElementById("agency_name").required = false;
          document.getElementById("agency_mobile_no").required = false;
          document.getElementById("agency_name").setAttribute("disabled","disabled");
          document.getElementById("agency_mobile_no").setAttribute("disabled","disabled");


          document.getElementById("agent_part").style.display = "none";
          document.getElementById("broker_name").required = false;
          document.getElementById("broker_mobile_no").required = false;
          document.getElementById("broker_name").setAttribute("disabled","disabled");
          document.getElementById("broker_mobile_no").setAttribute("disabled","disabled");


          document.getElementById("company_part").style.display = "none";
          document.getElementById("company_mobile_no").required = false;
          document.getElementById("company_name").required = false;
          document.getElementById("company_mobile_no").setAttribute("disabled","disabled");
          document.getElementById("company_name").setAttribute("disabled","disabled");


          document.getElementById("person_part").style.display = "none";
          document.getElementById("person_mobile_no").required = false;
          document.getElementById("person_name").required = false;
          document.getElementById("person_mobile_no").setAttribute("disabled","disabled");
          document.getElementById("person_name").setAttribute("disabled","disabled");

          document.getElementById("officer_part").style.display = "block";
          document.getElementById("officer_mobile_no").required = true;
          document.getElementById("officer_name").required = true;
          document.getElementById("officer_mobile_no").removeAttribute("disabled");
          document.getElementById("officer_name").removeAttribute("disabled");
      }
  }
</script>

<script type="text/javascript">

      var elem = document.getElementById("complianeFor");
      document.getElementById("victim_passport").required = true;

      if(elem.value == "own"){
            document.getElementById("broker_name").required = true;
            document.getElementById("broker_mobile_no").required = true;
            document.getElementById("victim_name").required = true;
            document.getElementById("victim_mobile").required = true;
            document.getElementById("victim_country_name").required = true;
            document.getElementById("victim_passport").required = true;

            document.getElementById("complainant_name").required = false;
            document.getElementById("complainant_mobile").required = false;
            document.getElementById("relation").required = false;
            document.getElementById("complaint_against").required = false;
            document.getElementById("others").style.display = "none"; 
            document.getElementById("showOther").style.display = "none"; 
            document.getElementById("victim_passport").required = true;
            document.getElementById("passport_warning").style.visibility = "visible";
        //console.log(elem.value);
      }
      if(elem.value == "own_other"){
            document.getElementById("broker_name").required = true;
            document.getElementById("broker_mobile_no").required = true;
            document.getElementById("victim_name").required = true;
            document.getElementById("victim_mobile").required = true;
            document.getElementById("victim_country_name").required = true;
            document.getElementById("victim_passport").required = false;

            document.getElementById("complainant_name").required = false;
            document.getElementById("complainant_mobile").required = false;
            document.getElementById("relation").required = false;
            document.getElementById("complaint_against").required = false;
            document.getElementById("victim_passport").required = false;
            document.getElementById("others").style.display = "none"; 
            document.getElementById("showOther").style.display = "none"; 
            document.getElementById("passport_warning").style.visibility = "hidden";
      }
      if(elem.value == "other"){
            document.getElementById("complainant_name").required = true;
            document.getElementById("complainant_mobile").required = true;
            document.getElementById("relation").required = true;
            document.getElementById("broker_name").required = true;
            document.getElementById("complaint_against").required = true;
            document.getElementById("broker_mobile_no").required = true;
            document.getElementById("victim_name").required = true;
            document.getElementById("victim_mobile").required = true;
            document.getElementById("victim_passport").required = false;
            document.getElementById("victim_country_name").required = false;
            document.getElementById("victim_passport").required = false;
            document.getElementById("passport_warning").style.visibility = "hidden";
            document.getElementById("others").style.display = "block";  
            document.getElementById("showOther").style.display = "block";  
            //console.log(elem.value);
      }

      function complaince_set(value){
        //alert(value)
          if(value == "own"){
            console.log(value);
                document.getElementById("broker_name").required = true;
                document.getElementById("broker_mobile_no").required = true;
                document.getElementById("victim_name").required = true;
                document.getElementById("victim_mobile").required = true;
                document.getElementById("victim_country_name").required = true;
                document.getElementById("victim_passport").required = true;

                document.getElementById("complainant_name").required = false;
                document.getElementById("complainant_mobile").required = false;
                document.getElementById("relation").required = false;
                document.getElementById("complaint_against").required = false;
                document.getElementById("others").style.display = "none"; 
                document.getElementById("showOther").style.display = "none"; 
                document.getElementById("passport_warning").style.visibility = "visible";
            }
            if(value == "own_other"){
              console.log(value);
                document.getElementById("broker_name").required = true;
                document.getElementById("broker_mobile_no").required = true;
                document.getElementById("victim_name").required = true;
                document.getElementById("victim_mobile").required = true;
                document.getElementById("victim_country_name").required = true;
                document.getElementById("victim_passport").required = false;

                document.getElementById("complainant_name").required = false;
                document.getElementById("complainant_mobile").required = false;
                document.getElementById("relation").required = false;
                document.getElementById("complaint_against").required = false;
                document.getElementById("others").style.display = "none"; 
                document.getElementById("showOther").style.display = "none"; 
                document.getElementById("passport_warning").style.visibility = "hidden";
            }

            if(value == "other"){
              console.log(value);
                //alert(value);
                document.getElementById("complainant_name").required = true;
                document.getElementById("complainant_mobile").required = true;
                document.getElementById("relation").required = true;
                document.getElementById("broker_name").required = true;
                document.getElementById("complaint_against").required = true;
                document.getElementById("broker_mobile_no").required = true;
                document.getElementById("victim_name").required = true;
                document.getElementById("victim_mobile").required = true;
                document.getElementById("victim_country_name").required = false;
                document.getElementById("victim_passport").required = false;
                document.getElementById("passport_warning").style.visibility = "hidden";
                document.getElementById("others").style.display = "block";  
                document.getElementById("showOther").style.display = "block";  
            }
      }

        


        
    </script>




@endsection

@include('modal')