
@extends('theme.default')
@section('content')

@foreach($case_tracking as $case_trackings) 

<div class="row" style="background-color: #00097c;color: #fff; margin-bottom: 10px">
    <div class="col-lg-12">
        <div class="panel-heading"> অনলাইন অভিযোগ ফরম </div>
    </div>
    <!-- /.col-lg-12 -->
</div>



@if(Session::has('message')) 
    <div class="alert alert-info"> {{Session::get('message')}} </div> 
@endif

@if(Session::has('update')) 
    <div class="alert alert-info"> {{Session::get('update')}} </div> 
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
{!! Form::open(array('url' => 'compliance_update','method'=>'POST','files'=>true, 'id'=>'differentForm')) !!}
{{ csrf_field() }}


<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
<input type="hidden" name="hidden_id" value="{{ $case_trackings->application_id }}" />
<input type="hidden" name="tracking_no" value="{{ $case_trackings->applicantTrackingNo }}" />


<input type="hidden" name="old_complianeFor" value="{{ $case_trackings->application_for }}" />
<input type="hidden" name="old_relation" value="{{ $case_trackings->relation }}" />
<input type="hidden" name="old_agency_name" value="{{ $case_trackings->agency_name }}" />
<input type="hidden" name="old_application_against" value="{{ $case_trackings->application_against }}" />



<input type="hidden" name="old_agency_name" value="{{ $case_trackings->agency_name }}" />
<input type="hidden" name="old_agency_mobile_no" value="{{ $case_trackings->agency_mobile_no }}" />

<input type="hidden" name="old_company_name" value="{{ $case_trackings->company_name }}" />
<input type="hidden" name="old_company_mobile_no" value="{{ $case_trackings->company_mobile_no }}" />

<input type="hidden" name="old_broker_name" value="{{ $case_trackings->broker_name }}" />
<input type="hidden" name="old_broker_mobile_no" value="{{ $case_trackings->broker_mobile_no }}" />

<input type="hidden" name="old_person_name" value="{{ $case_trackings->person_name }}" />
<input type="hidden" name="old_person_mobile_no" value="{{ $case_trackings->person_mobile_no }}" />

<input type="hidden" name="old_recruitment_officer_name" value="{{ $case_trackings->recruitment_officer_name }}" />
<input type="hidden" name="old_recruitment_officer_mobile_no" value="{{ $case_trackings->recruitment_officer_mobile_no }}" />



<input type="hidden" name="old_applicant_name" value="{{ $case_trackings->applicant_name }}" />
<input type="hidden" name="old_applicant_address" value="{{ $case_trackings->applicant_address }}" />
<input type="hidden" name="old_applicant_email" value="{{ $case_trackings->applicant_email }}" />
<input type="hidden" name="old_applicant_mobile_no" value="{{ $case_trackings->applicant_mobile_no }}" />
<input type="hidden" name="old_sufferer_name" value="{{ $case_trackings->sufferer_name }}" />
<input type="hidden" name="old_sufferer_mobile" value="{{ $case_trackings->sufferer_mobile }}" />
<input type="hidden" name="old_sufferer_current_address" value="{{ $case_trackings->sufferer_current_address }}" />
<input type="hidden" name="old_sufferer_passport_no" value="{{ $case_trackings->sufferer_passport_no }}" />
<input type="hidden" name="old_sufferer_local_no" value="{{ $case_trackings->sufferer_local_no }}" />
<input type="hidden" name="old_sufferer_district" value="{{ $case_trackings->sufferer_district }}" />
<input type="hidden" name="old_sufferer_upazilla" value="{{ $case_trackings->sufferer_upazilla }}" />
<input type="hidden" name="old_sufferer_local_address" value="{{ $case_trackings->sufferer_local_address }}" />
<input type="hidden" name="old_applicant_address" value="{{ $case_trackings->applicant_address }}" />
<input type="hidden" name="old_sufferer_nationality" value="{{ $case_trackings->sufferer_nationality }}" />
<input type="hidden" name="old_sufferer_current_country" value="{{ $case_trackings->sufferer_current_country }}" />
<input type="hidden" name="gender" value="{{ $case_trackings->gender }}" />

<div class="row">
  <div class="panel panel-primary">
    <div class="panel-body">
      <div class="col-lg-6">
        <div class="form-group">
          <label for="exampleInputEmail1">আপনি নিজের জন্য বা অন্য কারো জন্য অভিযোগ করছেন?
            <span style="color: red">*</span></label>
            
          <select class="form-control" id="complianeFor" name="complianeFor" onchange="complaince_set(this.value)">
              <option value="own"
              @if($case_trackings->application_for == "own") 
               {{ "selected" }}
              @endif
              >ইতিমধ্যে বিদেশ গমন করেছেন </option>
              <option value="own_other"
              @if($case_trackings->application_for == "own_other") 
               {{ "selected" }}
              @endif
              >বিদেশ গমন করবেন  </option>
              <option value="other"
              @if($case_trackings->application_for == "other") 
               {{ "selected" }}
              @endif>অন্য কেউ</option>
            
          </select>
        </div>
        <div class="form-group" id="showOther" style="display: none;">
          <label for="exampleInputEmail1">ব্যক্তির সাথে আপনার সম্পর্ক কি?<span style="color: red">*</span></label>
          <select class="form-control" name="relation" id="relation">
            <option value="">Select relation</option>
            <option value="বাবা"
            @if($case_trackings->relation == "বাবা") 
               {{ "selected" }}
              @endif
            >বাবা</option>
            <option value="মা"
            @if($case_trackings->relation == "মা") 
               {{ "selected" }}
              @endif
            >মা</option>
            <option value="ভাই"
            @if($case_trackings->relation == "ভাই") 
               {{ "selected" }}
              @endif
            >ভাই</option>
            <option value="বোন"
            @if($case_trackings->relation == "বোন") 
               {{ "selected" }}
              @endif
            >বোন</option>
            <option value="আঙ্কেল"
            @if($case_trackings->relation == "আঙ্কেল") 
               {{ "selected" }}
              @endif
            >আঙ্কেল</option>
            <option value="অপরিচিত ব্যক্তি"
            @if($case_trackings->relation == "অপরিচিত ব্যক্তি") 
               {{ "selected" }}
              @endif
            >অপরিচিত ব্যক্তি</option>
            <option value="দূর সম্পর্কের আত্মীয়"
            @if($case_trackings->relation == "দূর সম্পর্কের আত্মীয়") 
               {{ "selected" }}
              @endif
            >দূর সম্পর্কের আত্মীয়</option>
            <option value="আমি প্রকাশ করতে চাই না"
            @if($case_trackings->relation == "আমি প্রকাশ করতে চাই না") 
               {{ "selected" }}
              @endif
            >আমি প্রকাশ করতে চাই না</option>
          </select>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">আপনার অভিযোগটি কার বিরুদ্ধে? <span style="color: red">*</span></label>
          <select class="form-control" name="complaint_against" onchange="change_agent(this.value)" id="complaint_against">
            <option value="agent"
            @if($case_trackings->application_against == "agent") 
               {{ "selected" }}
            @endif
            >এজেন্ট</option>
            <option value="recruiting_agency"
            @if($case_trackings->application_against == "recruiting_agency") 
               {{ "selected" }}
              @endif
            >রিক্রুটিং এজেন্সী</option>
            <option value="company"
            @if($case_trackings->application_against == "company") 
               {{ "selected" }}
              @endif
            >অন্যান্য </option>
            <option value="specific_person"
            @if($case_trackings->application_against == "specific_person") 
               {{ "selected" }}
              @endif
            >নির্দিষ্ট ব্যক্তি</option>
            <option value="appointed_officer"
            @if($case_trackings->application_against == "appointed_officer") 
               {{ "selected" }}
              @endif
            >নিয়োগ কর্তা</option>
          </select>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
            
            <div id="company_part">
            <label for="exampleInputEmail1">অন্যান্য  নাম<span style="color: red">*</span></label>
          
            <input type="text" class="form-control" id="company_name"  name="company_name" value="@if($case_trackings->company_name != 'NULL'){{ $case_trackings->company_name }}@endif" maxlength="50">
            <br>
            <label for="exampleInputEmail1">অন্যান্য মোবাইল নং<span style="color: red">*</span></label>

            <input type="text" class="form-control" id="company_mobile_no" name="company_mobile_no" maxlength="20" value="@if($case_trackings->company_mobile_no != 'NULL'){{ $case_trackings->company_mobile_no }}@endif">

          </div>



          <div id="person_part">
            <label for="exampleInputEmail1">নিদ্দিষ্ট ব্যাক্তি নাম<span style="color: red">*</span></label>
          
            <input type="text" class="form-control" id="person_name" name="person_name" value="@if($case_trackings->person_name != 'NULL'){{ $case_trackings->person_name }}@endif" maxlength="50">
            <br>
            <label for="exampleInputEmail1">নিদ্দিষ্ট ব্যাক্তি মোবাইল নং<span style="color: red">*</span></label>

            <input type="text" class="form-control" id="person_mobile_no" name="person_mobile_no" value="@if($case_trackings->person_mobile_no != 'NULL'){{ $case_trackings->person_mobile_no }}@endif"  maxlength="20">

          </div>



          <div id="agent_part">
            
            <label for="exampleInputEmail1">এজেন্টের  নাম<span style="color: red">*</span></label>
          
            <input type="text" class="form-control" id="broker_name" name="agent_name" value="@if($case_trackings->broker_name != 'NULL'){{ $case_trackings->broker_name }} @endif" maxlength="50">
            <br>
            <label for="exampleInputEmail1">এজেন্টের  মোবাইল নং<span style="color: red">*</span></label>

            <input type="text" class="form-control" id="broker_mobile_no" name="agent_mobile_no" value="@if($case_trackings->broker_mobile_no != 'NULL'){{ $case_trackings->broker_mobile_no }}@endif"  maxlength="20">

          </div>



          <div id="officer_part">
            
            <label for="exampleInputEmail1">নিয়োগ কর্তা  নাম<span style="color: red">*</span></label>
          
            <input type="text" class="form-control" id="officer_name" name="officer_name" value=" @if($case_trackings->recruitment_officer_name != 'NULL'){{ $case_trackings->recruitment_officer_name }}@endif" maxlength="50">
            <br>
            <label for="exampleInputEmail1">নিয়োগ কর্তা  মোবাইল নং<span style="color: red">*</span></label>

            <input type="text" class="form-control" id="officer_mobile_no" name="officer_mobile_no" value="@if($case_trackings->recruitment_officer_mobile_no != 'NULL'){{ $case_trackings->recruitment_officer_mobile_no }}@endif"  maxlength="20">

          </div>



          <div id="agency_part">
            <label for="exampleInputEmail1">রিক্রুটিং এজেন্সির নাম<span style="color: red">*</span></label>
          
            <select class="form-control" id="agency_name" name="agency_name">
              <option value="">Please select agency name</option>
              @foreach($agencyName as $agencyNames)
                <option value="{{ $agencyNames->agency_name }}"
                  @if($agencyNames->agency_name == $case_trackings->agency_name)
                    {{ "selected" }}
                  @endif
                >{{ $agencyNames->agency_name }}</option>
              @endforeach
            </select>
            <br>
            <label for="exampleInputEmail1">রিক্রুটিং এজেন্সির  মোবাইল নং<span style="color: red">*</span></label>
            <input type="text" class="form-control" id="agency_mobile_no" name="agency_mobile_no" placeholder="রিক্রুটিং এজেন্সির মোবাইল নং" value="@if($case_trackings->agency_mobile_no != 'NULL'){{ $case_trackings->agency_mobile_no }}@endif"   maxlength="20">

          </div>



        </div>
        
      </div>
    </div>
  </div>
</div>

<div class="row" id="other" style="display: none;">
  <div class="panel panel-success">
    <div class="panel-heading" style="background-color: #00f;color: #fff">অভিযোগকারীর তথ্য </div>
    <div class="panel-body">
      <div class="col-lg-6">
        <div class="form-group">
          <label for="exampleInputEmail1">অভিযোগকারীর  নাম <span style="color: red">*</span></label>
          <input type="text" name="complainant_name" id="complainant_name" class="form-control"
           value="<?php if($case_trackings->applicant_name != 'NULL')echo $case_trackings->applicant_name; ?> " maxlength="50">
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">দেশ:</label>
          <select class="form-control" name="complainant_country" id="complainant_country"
          >
              <option value="">দেশ নির্বাচন করুন</option>
              @foreach($countries as $country)
                <option value="{{ $country->name->common }}"
                  @if($case_trackings->applicant_country == $country->name->common) 
                    {{ "selected" }}
                  @endif
                >{{ $country->name->common }}</option>
              @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">ঠিকানা</label>
          <textarea class="form-control" name="complainant_address" id="complainant_address" maxlength="50"
          ><?php if($case_trackings->applicant_address != 'NULL')echo $case_trackings->applicant_address; ?></textarea>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <label for="exampleInputEmail1">ইমেইল</label>
          <input type="text" class="form-control" id="complainant_email" name="complainant_email" placeholder="ইমেইল" value="<?php if($case_trackings->applicant_email != 'NULL')echo $case_trackings->applicant_email;?>" maxlength="50">
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">মোবাইল নম্বর <span style="color: red">*</span></label>
          <input type="text" class="form-control" id="complainant_mobile" name="complainant_mobile" placeholder="মোবাইল নম্বর"  value="<?php if($case_trackings->applicant_mobile_no != 'NULL') echo $case_trackings->applicant_mobile_no;?> "  maxlength="20">
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="panel panel-info">
    <div class="panel-heading" style="background-color: #00f;color: #fff">ভুক্ত ভোগীর তথ্য</div>
    <div class="panel-body">
      <div class="col-lg-6">
        <div class="form-group">
          <label for="exampleInputEmail1">ভুক্ত ভোগীর নাম <span style="color: red">*</span></label>
          <input type="text" class="form-control" name="victim_name" id="victim_name" value="<?php if($case_trackings->sufferer_name != 'NULL')echo $case_trackings->sufferer_name;?>" maxlength="50">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">মোবাইল নং <span style="color: red">*</span></label>
          <input type="text" class="form-control" name="victim_mobile" id="victim_mobile" value="<?php if($case_trackings->sufferer_mobile != 'NULL')echo $case_trackings->sufferer_mobile;?>"  maxlength="20" readonly>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">লিঙ্গ <span style="color: red">*</span></label>
          <select class="form-control" style="color:000" name="gender" required>
            <option value="">লিঙ্গ</option>
            <option value="Male" 
            @if($case_trackings->gender == "Male")
              {{ "selected" }}
            @endif>
            পুরুষ</option>
            <option value="Female"
            @if($case_trackings->gender == "Female")
              {{ "selected" }}
            @endif
            >মহিলা</option>
            <option value="Other"
            @if($case_trackings->gender == "Other")
              {{ "selected" }}
            @endif
            >অন্যান্য </option>
          </select>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">জাতীয়তা</label>
          <input type="text" class="form-control" name="victim_nationality" id="victim_nationality" value="<?php if($case_trackings->sufferer_nationality != 'NULL')echo $case_trackings->sufferer_nationality;?>" maxlength="50">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">দেশের নাম <span style="color: red">*</span></label>
          <select class="form-control" name="victim_country_name" id="victim_country_name">
            <option value="">দেশ নির্বাচন করুন </option>
            @foreach($countries as $country)
              <option value="{{ $country->name->common }}"
                @if($case_trackings->sufferer_current_country == $country->name->common) 
                  {{ "selected" }}
                @endif
              >{{ $country->name->common }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">বর্তমান যোগাযোগের ঠিকানা: </label>
          <textarea class="form-control" name="victim_address" id="victim_address" maxlength="700"><?php 
          if($case_trackings->sufferer_current_address != 'NULL')echo $case_trackings->sufferer_current_address; ?></textarea>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <label for="exampleInputEmail1">পাসপোর্ট নং <span style="color: red" id="passport_warning">*</span></label>
          <input type="text" class="form-control" id="victim_passport" name="victim_passport" placeholder="পাসপোর্ট নং" value="<?php if($case_trackings->sufferer_passport_no != 'NULL')echo $case_trackings->sufferer_passport_no;?>" maxlength="50">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">লোকাল নম্বর</label>
          <input type="text" class="form-control" id="victim_local_no" name="victim_local_no" placeholder="লোকাল নম্বর" 
          value="<?php if($case_trackings->sufferer_local_no != 'NULL')echo $case_trackings->sufferer_local_no;?>"  maxlength="20">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">জেলা</label>
          <input type="text" class="form-control" id="victim_district" name="victim_district" placeholder="জেলা" value="<?php if($case_trackings->sufferer_district != 'NULL') echo $case_trackings->sufferer_district; ?>" maxlength="50">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">উপজেলা</label>
          <input type="text" class="form-control" id="victim_upazilla" name="victim_upazilla" placeholder="উপজেলা" value="<?php if($case_trackings->sufferer_upazilla != 'NULL')echo $case_trackings->sufferer_upazilla;?>" maxlength="50">

        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">স্থানীয় ঠিকানা <span style="color: red">*</span></label>
          <textarea class="form-control" name="victim_local_address" id="victim_local_address" required maxlength="700"><?php
          if($case_trackings->sufferer_local_address != 'NULL')echo $case_trackings->sufferer_local_address; ?></textarea>
        </div>
      </div>
    </div>
  </div>
</div>
<hr>
  <button type="submit" class="btn btn-primary">Update</button>
{{ Form::close() }}
<hr>

@endforeach

<script type="text/javascript">


  function change_agent(value){
      
      if(value == "recruiting_agency"){

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
          document.getElementById("company_part").required = false;
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
          document.getElementById("company_part").required = false;
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
          document.getElementById("company_part").required = true;
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
          document.getElementById("company_part").required = false;
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
          document.getElementById("company_part").required = false;
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

      var elem = document.getElementById("complianeFor").value;
      
      if(elem == "own"){
        
            document.getElementById("victim_passport").required = true;

            document.getElementById("victim_name").required = true;
            document.getElementById("victim_mobile").required = true;

            document.getElementById("victim_country_name").required = true;
            document.getElementById("victim_passport").required = true;


            document.getElementById("complainant_name").required = false;
            document.getElementById("complainant_mobile").required = false;

            document.getElementById("relation").required = false;

            document.getElementById("complaint_against").required = false;
            document.getElementById("other").style.display = "none"; 

            document.getElementById("showOther").style.display = "none"; 


        //console.log(elem.value);
      }
      if(elem == "own_other"){

            document.getElementById("victim_passport").required = true;
            document.getElementById("victim_name").required = true;

            document.getElementById("victim_mobile").required = true;
            document.getElementById("victim_country_name").required = true;
            document.getElementById("victim_passport").required = true;

            document.getElementById("complainant_name").required = false;
            document.getElementById("complainant_mobile").required = false;
            document.getElementById("relation").required = false;
            document.getElementById("other").style.display = "none"; 
            document.getElementById("showOther").style.display = "none"; 

      }
      if(elem == "other"){

                document.getElementById("victim_passport").required = false;
                document.getElementById("complainant_name").required = true;
                document.getElementById("complainant_mobile").required = true;
                document.getElementById("relation").required = true;

                document.getElementById("broker_mobile_no").required = true;
                document.getElementById("victim_name").required = true;
                document.getElementById("victim_mobile").required = true;
                document.getElementById("victim_country_name").required = false;
                document.getElementById("victim_passport").required = false;
                document.getElementById("passport_warning").style.visibility = "hidden";
                document.getElementById("other").style.display = "block";  
                document.getElementById("showOther").style.display = "block"; 
      }

      function complaince_set(value){
          if(value == "own"){

            //alert(value);
                document.getElementById("victim_passport").required = true;
                document.getElementById("victim_name").required = true;
                document.getElementById("victim_mobile").required = true;
                document.getElementById("victim_country_name").required = true;
                document.getElementById("victim_passport").required = true;

                document.getElementById("complainant_name").required = false;
                document.getElementById("complainant_mobile").required = false;
                document.getElementById("relation").required = false;
                document.getElementById("other").style.display = "none"; 
                document.getElementById("showOther").style.display = "none"; 
            }
            if(value == "own_other"){
                document.getElementById("victim_passport").required = false;
                document.getElementById("victim_name").required = true;
                document.getElementById("victim_mobile").required = true;
                document.getElementById("victim_country_name").required = true;
                document.getElementById("victim_passport").required = false;

                document.getElementById("complainant_name").required = false;
                document.getElementById("complainant_mobile").required = false;
                document.getElementById("relation").required = false;
                document.getElementById("complaint_against").required = false;
                document.getElementById("other").style.display = "none"; 
                document.getElementById("showOther").style.display = "none"; 
            }

            if(value == "other"){

                document.getElementById("victim_passport").required = false;
                document.getElementById("complainant_name").required = true;
                document.getElementById("complainant_mobile").required = true;
                document.getElementById("relation").required = true;
                document.getElementById("victim_name").required = true;
                document.getElementById("victim_mobile").required = true;
                document.getElementById("victim_country_name").required = false;
                document.getElementById("victim_passport").required = false;
                document.getElementById("passport_warning").style.visibility = "hidden";
                document.getElementById("other").style.display = "block";  
                document.getElementById("showOther").style.display = "block"; 

            }
      }

        


          var complaint_against = document.getElementById("complaint_against");
          //console.log(complaint_against.value);

          if(complaint_against.value == "recruiting_agency"){
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
                  document.getElementById("company_part").required = false;
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
          if(complaint_against.value == "company"){
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
                document.getElementById("company_part").required = true;
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
          if(complaint_against.value == "specific_person"){
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
                document.getElementById("company_part").required = false;
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
          if(complaint_against.value == "appointed_officer"){
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
                document.getElementById("company_part").required = false;
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
          if(complaint_against.value == "agent"){
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
                document.getElementById("company_part").required = false;
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

        
    </script>
@endsection