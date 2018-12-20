@extends('theme.default')
@section('content')
<?php use App\Http\Controllers\HomeController;?>
<!-- /.row -->
<?php
    $grouparray  = HomeController::getGroupName(Auth::user()->empUserID);
    $groupname   = $grouparray->group_name;
    if($groupname =="Head Assistant"){
?>
<input type="button" onclick="printDiv('printableArea')" value="print" />

<script>
  function printDiv(divName) {
         var printContents = document.getElementById(divName).innerHTML;
         var originalContents = document.body.innerHTML;

         document.body.innerHTML = printContents;

         window.print();

         document.body.innerHTML = originalContents;
    }
</script>

<?php } ?>

{{ csrf_field() }}
<div id="printableArea">
<!-- /.row -->
<div class="row">
  <br>
    <div class="col-lg-12" style="text-align: center;">
      <p>গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</p>
      <p><b>জনশক্তি, কর্মসংস্থান ও প্রশিক্ষণ ব্যুরো</b></p>
      <p>৮৯/২, কাকরাইল, ঢাকা-১০০০</p>
    </div>
    <div class="col-lg-12" style="text-align: center;">

    </div>
</div>

@foreach($casedetails as $casedetail)


<div class="row">
    <div class="col-lg-8" style="text-align: left;padding: 30px">
      <p>নং: {{ $casedetail->committee_no }}</p> 
    </div>
    <div class="col-lg-4" style="text-align: right;">
      <p>তারিখ: {{ $casedetail->generate_date }}</p>
      
    </div>


<div class="row">
    <div class="col-lg-12" style="text-align: center;">
      <p><b><u>"অফিস আদেশ"</u></b></p>
      
    </div>
    <div class="row" style="padding: 30px">
      <div class="col-lg-12">
          <p>রিক্রুটিং এজেন্সী {{ $casedetail->agency_name }} এর বিরুদ্ধে {{ $casedetail->suffrer_name }}(মোবাঃ {{ $casedetail->mobile_number }})কর্তৃক  আনীত অভিযোগ তদন্তপূর্বক  মতামতসহ প্রতিবেদন দাখিল  করার জন্য নিন্মোক্ত  কর্মকর্তাদের সমন্বয়ে  তদন্ত কমিটি  গঠন করা হল :</p>
          <br>
          
   

            <p style="margin-left: 30px">(ক)<?php echo $casedetail->officer_name1; ?>, <?php echo $casedetail->inquiry_assign_position1; ?> , (কর্মসংস্থান), বিএমইটি ,ঢাকা।</p>
            

            <p style="margin-left: 30px">(খ )<?php echo $casedetail->officer_name2; ?>, <?php echo $casedetail->inquiry_assign_position2; ?> , বিএমইটি ,ঢাকা।</p>
            <br>
          
       

          <p>২।অফিসটি  আগামী ২০(বিশ) কর্ম দিবসের মধ্যে  সরোজমিনে  তদন্তপূর্বক প্রতিবেদন  দাখিল  করার জন্য নির্দেশক্রমে অনুরোধ করা হল। </p>
          <br>
          <br>
          <br>
          <div style="float: right; display: block;text-align: center;">
            <p><b>{{ $casedetail->secretary }}</b></p>
            <p>উপ-সচিব</p>
            <p>উপ-পরিচালক  (কর্মসংস্থান)</p>
            <p>ফোন:০২-৫৫১৩৮৬২১</p>
          </div>
    <div>
  <br>
  <br>
  <br>
  <p><u>বিতরণ :</u> অবগতি ও প্রয়োজনীয় কার্যার্থে </p>
          <p>১। <?php echo $casedetail->officer_name1; ?>, <?php echo $casedetail->inquiry_assign_position1; ?> (কর্মসংস্থান), বিএমইটি ,ঢাকা।</p>
          <p>২। <?php echo $casedetail->officer_name2; ?>,  <?php echo $casedetail->inquiry_assign_position2; ?>, বিএমইটি ,ঢাকা।</p>
          <p>৩। {{ $casedetail->address }}</p>
          <p>৪।মাস্টার কপি /{{ $casedetail->year }}</p>
    </div>
          
      </div>
    </div><br>
    </div>
</div>
</div>
@endforeach    


@endsection