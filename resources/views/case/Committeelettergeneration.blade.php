@extends('theme.default')
@section('content')
<?php use App\Http\Controllers\HomeController;?>

<div class="row" style="background-color: #00097c;color: #fff; margin-bottom: 10px">
    <div class="col-lg-12">
        <div class="panel-heading">Committee Letter Generate </div>
    </div>
    <!-- /.col-lg-12 -->
</div>


@if(Session::has('message')) 
    <div class="alert alert-info"> {{Session::get('message')}} </div> 
@endif
{!! Form::open(array('url' => 'committeeletter','method'=>'POST', 'id'=>'differentForm')) !!}
<!-- /.row -->


<div class="row">

@foreach ($casedetails as $casedetail)

<input type="hidden" name="tracking_no" value="{{ $casedetail->applicantTrackingNo }}">
{{ csrf_field() }}
<!-- /.row -->
<div class="row">
    <div class="col-lg-12" style="text-align: center;">
      <p>গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</p>
      <p><b>জনশক্তি, কর্মসংস্থান ও প্রশিক্ষণ ব্যুরো</b></p>
      <p>৮৯/২, কাকরাইল, ঢাকা-১০০০</p>
    </div>
    <div class="col-lg-12" style="text-align: center;">

    </div>
</div>

<div class="row">
    <div class="col-lg-8" style="text-align: left;padding: 30px">
      <p> নং:<input  required type="text" name="committee_no" value="৪৯.০১.০০০০.০২২.৩১.৫২০.১৬-" style=" border: none; border-bottom: 1px solid #ccc; width: 250px;"></p> 
    </div>
    <div class="col-lg-4" style="text-align: right;">
      <p>তারিখ: <input required type="date" name="published_day" value="18-09-2018" style=" border: none; border-bottom: 1px solid #ccc;" min=
     <?php
         echo date('Y-m-d');
     ?>
     ></p>
      
    </div>
</div>

<div class="row">
    <div class="col-lg-12" style="text-align: center;">
      <p><b><u>"অফিস আদেশ"</u></b></p>
      
    </div>
    <div class="row" style="padding: 30px">
      <div class="col-lg-12">
          <p>রিক্রুটিং এজেন্সী  <input required type="text" name="agency_name" 
            value="@if($casedetail->agency_name != 'NULL'){{ $casedetail->agency_name }}@endif" style=" border: none; border-bottom: 1px solid #ccc; width: 230px;"> এর বিরুদ্ধে <input type="text" name="suffrer_name" value="@if($casedetail->sufferer_name != 'NULL'){{ $casedetail->sufferer_name }}@endif" style=" border: none; border-bottom: 1px solid #ccc; width: 230px;">(মোবাঃ  <input readonly type="tel" name="mobile_number" value="@if($casedetail->sufferer_mobile != 'NULL'){{ $casedetail->sufferer_mobile }}@endif" style=" border: none; border-bottom: 1px solid #ccc; width: 100px;">)কর্তৃক  আনীত অভিযোগ তদন্তপূর্বক  মতামতসহ প্রতিবেদন দাখিল  করার জন্য নিন্মোক্ত  কর্মকর্তাদের সমন্বয়ে  তদন্ত কমিটি  গঠন করা হল :</p>
          <br>
          
   

            <p>(ক) <input readonly type="text" name="officer_name1" value="<?php $name2 = HomeController::getName($inquiry_user->inquiry_assign2); 
                if($name2->fullName){ 
                  echo $name2->fullName; 
                }?>" style=" border: none; border-bottom: 1px solid #ccc; width: 230px;">, <input type="text" name="inquiry_assign_position1" style="border: none; border-bottom: 1px solid #ccc; width: 220px" value="উর্ধতন পরিসংখ্যান কর্মকর্তা"> (কর্মসংস্থান), বিএমইটি ,ঢাকা।</p>
            

            <p>(খ ) <input readonly type="text" name="officer_name2" value="<?php $name1 = HomeController::getName($inquiry_user->inquiry_assign1); 
                if($name1->fullName){ 
                  echo $name1->fullName; 
                }?>" style=" border: none; border-bottom: 1px solid #ccc; width: 230px;">,<input type="text" name="inquiry_assign_position2" style="border: none; border-bottom: 1px solid #ccc; width: 220px" value="পরিসংখ্যান কর্মকর্তা">,বিএমইটি ,ঢাকা।</p>
            <br>
          
       

          <p>২।অফিসটি  আগামী ২০(বিশ) কর্ম দিবসের মধ্যে  সরোজমিনে  তদন্তপূর্বক প্রতিবেদন  দাখিল  করার জন্য নির্দেশক্রমে অনুরোধ করা হল। </p>
          <br>
          <br>
          <br>
          <div style="float: right; display: block;">
            <p><b><input type="text" name="secretary" value="(মাসুদ রানা)"></b></p>
            <p>উপ-সচিব</p>
            <p>উপ-পরিচালক  (কর্মসংস্থান)</p>
            <p>ফোন:০২-৫৫১৩৮৬২১</p>
          </div>
    <div>
  <br>
  <br>
  <br>
  <p><u>বিতরণ :</u> অবগতি ও প্রয়োজনীয় কার্যার্থে </p>
          <p>১। <input readonly type="text" name="" value="<?php $name2 = HomeController::getName($inquiry_user->inquiry_assign2); 
                if($name2->fullName){ 
                  echo $name2->fullName; 
                }?>" style=" border: none; border-bottom: 1px solid #ccc; width: 230px;">, উর্ধতন পরিসংখ্যান কর্মকর্তা (কর্মসংস্থান), বিএমইটি ,ঢাকা।</p>
          <p>২। <input readonly type="text" name=""  value="<?php $name1 = HomeController::getName($inquiry_user->inquiry_assign1); 
                if($name1->fullName){ 
                  echo $name1->fullName; 
                }?>" style=" border: none; border-bottom: 1px solid #ccc; width: 230px;"> ,  পরিসংখ্যান কর্মকর্তা, বিএমইটি ,ঢাকা।</p>
          <p>৩।<input required type="text" name="address" placeholder="রিক্রুটিং এজেন্সীর ঠিকানা" style=" border: none; border-bottom: 1px solid #ccc; width: 230px;"></p>
          <p>৪।মাস্টার কপি /<input required type="number" value="2016" name="year" style=" border: none; border-bottom: 1px solid #ccc;"></p>
    </div>
          
      </div>
    </div><br>
    </div>
  
@endforeach     

    <div class="row">
      <div class="col-lg-12">
        <button type="submit" class="btn btn-primary">Generate</button>
      {{ Form::close() }}
      </div>
    </div><br>
</div>
@endsection