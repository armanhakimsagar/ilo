
@extends('theme.default')
@section('content')

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
<style type="text/css">
  .row{
    font-size: 12px
  }
</style>
<div class="row">
  
  <div class="col-lg-12">
    <div class="panel panel-success">
        <div class="panel-heading" style="background-color: #00097c;color: #fff; margin-bottom: 10px">Hearing Letter Generate </div>
        <div class="panel-body" id="printableArea">
          <form method="POST" action="{{ url('hearing_letter') }}" accept-charset="UTF-8" id="differentForm">
            @foreach($hearing_trackings as $hearing_tracking)
            {{ csrf_field() }}
            
            <input type="hidden" name="agency_name" value="{{ $hearing_tracking->agency_name  }}">
            <input type="hidden" name="tracking_no" value="{{ $hearing_tracking->tracking_no  }}">
            <input type="hidden" name="sufferer_name" value="{{ $hearing_tracking->sufferer_name  }}">
            <input type="hidden" name="sufferer_father" value="{{ $hearing_tracking->sufferer_father  }}">
            <input type="hidden" name="sufferer_address" value="{{ $hearing_tracking->sufferer_address  }}">
            <input type="hidden" name="agency_mobile_no" value="{{ $hearing_tracking->agency_mobile_no  }}">
            <input type="hidden" name="agency_address" value="{{ $hearing_tracking->agency_address  }}">


            <!-- /.row -->
            <div class="row">
              <div class="col-lg-10" style="text-align: center;">
                <p>গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</p>
                <p><b>জনশক্তি, কর্মসংস্থান ও প্রশিক্ষণ ব্যুরো</b></p>
                <p>৮৯/২, কাকরাইল, ঢাকা-১০০০</p>
              </div>
              <div class="col-lg-2" style="float: right;">
                <span>রেজিস্টার্ড <br>{{ $hearing_tracking->register_no }} শুনানী</span>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-8" style="text-align: left;">
                <p>নং:@if($hearing_tracking->sunani_no != "NULL")
                                    {{ $hearing_tracking->sunani_no  }}
                                  @endif</p> 
              </div>
              <div class="col-lg-4" style="text-align: right;">
                <p>তারিখ: <?php echo date('Y-m-d',strtotime($hearing_tracking->hearing_generate_date)); ?></p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12" style="text-align: left;">

                <p>বিষয়: <u>@if($hearing_tracking->agency_name != "NULL")
                                    {{ $hearing_tracking->agency_name  }}
                                  @endif, এর বিরুদ্ধে আনীত অভিযোগ তদন্ত প্রসঙ্গে।</u></p>
                <p>সূত্র : <u>স্মারক নং  {{ $committee_sarokno  }} তারিখ :<?php echo date('Y-m-d',strtotime($hearing_tracking->sarok_generate_date)); ?></u></p>
                    </div>
                  <br>
           
               <div class="col-lg-12" style="align-content: center; padding: 20px">
                 <div class="col-lg-6" style="text-align: left; height: 100px;float: left">
                  <p><u>বাদীর নাম ও ঠিকানা </u></p>
                  <p>১।বাদীর নাম : @if($hearing_tracking->sufferer_name != "NULL")
                                    {{ $hearing_tracking->sufferer_name  }}<br>
                                  @endif
                      পিতা: {{ $hearing_tracking->sufferer_father  }} <br>
                      ঠিকানা : {{ $hearing_tracking->sufferer_address  }}</p>
                      </div>
                      <div class="col-lg-5" style="text-align: left; height: 100px; float: right">
                        <p><u>বিবাদীর নাম ও ঠিকানা </u></p>
                        <p>১।এজেন্সী নাম : @if($hearing_tracking->agency_name != "NULL")
                                    {{ $hearing_tracking->agency_name  }}
                                  @endif<br>
                            ফোন : @if($hearing_tracking->agency_mobile_no != "NULL")
                                    {{ $hearing_tracking->agency_mobile_no  }}
                                  @endif<br>
                            এজেন্সী ঠিকানা :  @if($hearing_tracking->agency_address != "NULL")
                                    {{ $hearing_tracking->agency_address  }}
                                  @endif
                        </p>
                      </div>
                       </div>
                       <br>
                       <br>
                    <div class="row">
                      <div class="col-lg-12" style="text-align: left;float: right; height: 400px;padding-left: 30px">
                        <br>
                      <br>
                     <br>

                    <p style="padding:10px">উপযুক্ত বিষয় ও সূত্রের প্রেক্ষিতে জানানো যাচ্ছে যে , বাদী  বাদীর নাম , কর্তৃক রিক্রুটিং এজেন্সি  রিক্রুটিং এজেন্সী নাম, এর বিরুদ্ধে আনীত অভিযোগ তদন্তের জন্য দুই সদস্য বিশিষ্ট একটি তদন্ত কমিটি গঠন করা হয়েছে।</p>
                    <br>
                    <p style="padding:10px">০২। আগামী 
                      <?php if(isset($hearing_tracking->hearing_full_date)) { echo date('Y-m-d',strtotime($hearing_tracking->hearing_full_date)); } ?> তারিখ  রোজ

                      @if($hearing_tracking->hearing_day != "NULL")
                                    {{ $hearing_tracking->hearing_day  }}
                                  @endif

                     @if($hearing_tracking->hearing_time != "NULL")
                                    {{ $hearing_tracking->hearing_time  }}
                                  @endif 

                    ঘটিকায় নিন্মস্বাক্ষরকারীর অফিস কক্ষে ( জনশক্তি, কর্মসসস্থান ও প্রশিক্ষণ ব্যুরো, ৮ম তলা, ৮৯/২, কাকরাইল, ঢাকা ) অভিযোগের ১ম শুনানী গ্রহণ করবেন।অভিযোগ শুনানীর সময় বাদী/বিবাদীগণকে উপযুক্ত সাক্ষ্য প্রমানাদি সহকারে তদন্ত কমিটির সম্মুখে হাজির হয়ে নিজ নিজ বক্তব্য পেশ করার জন্য অনুরোধ করা হলো। শুনানির জন্য নির্ধারিত তারিখে নিদ্দিষ্ট সময়ে বাদী/বিবাদীগণ উপস্থিত হতে ব্যর্থ হলে অভিযোগ সম্পর্কে কিছু  বলার নেই বলে গণ্য হবে এবং অভিযোগ সম্পর্কে একতরফা সিদ্ধান্ত গ্রহণ করা হবে।</p>
                    <br>
                    <br>
                    <br>
                    <div class="row">
                      <div class="col-lg-6" style="float: right; display: block; text-align: center; height: 250px; padding: 20px 30px 0px 0px">
                        <p>{{ $commitee_letter_member->officer_name1 }}</p>
                        <p>উপপরিচালক(অর্থ, বাজেট ও আইটি)</p>
                        <p>বিএমআইটি , ঢাকা </p>
                        <p>ও<br>তদন্ত কর্মর্কর্তা </p>
                      </div>
                      <div class="col-lg-6">
                          <br><br>    
                          <p><u><b>অবগতির জন্য অনুলিপিঃ-</b></u></p><br>
                          <p>০১। {{ $commitee_letter_member->officer_name2 }},সহকারী পরিচালক, বিএমআইটি , ঢাকা ও তদন্ত কর্মর্কর্তা 
                          <br>০২।{{ $hearing_tracking->agency_name  }} ,{{ $hearing_tracking->agency_address  }} 
                          <br>০৩। @if($hearing_tracking->sufferer_name != "NULL")
                                    {{ $hearing_tracking->sufferer_name  }}
                                  @endif , {{ $hearing_tracking->sufferer_father  }} ,{{ $hearing_tracking->sufferer_address  }} </p>
                        </div>
                      </div>
                              
                          </div>
                        </div><br>

                      </div>
                  </div>
                
            @endforeach
          </form>
          </div>
        </div>
    </div>
  </div>

</div>



@endsection
