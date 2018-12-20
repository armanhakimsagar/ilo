
@extends('theme.default')
@section('content')


<div class="row">
  
  <div class="col-lg-12">
    <div class="panel panel-success">
        <div class="panel-heading" style="background-color: #00097c;color: #fff; margin-bottom: 10px">Hearing Letter Generate </div>
        <div class="panel-body">
          <form method="POST" action="{{ url('hearing_letter') }}" accept-charset="UTF-8" id="differentForm">
            @foreach($hearing_trackings as $hearing_tracking)
            {{ csrf_field() }}
            <input type="hidden" name="track_id" value="{{ $hearing_tracking->id  }}">
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
                <p>প্রবাসী কল্যাণ ভবন</p>
                <p>৮৯/২, কাকরাইল, ঢাকা-১০০০</p>
              </div>
              <div class="col-lg-2">
                <h6>রেজিস্টার্ড <br><input type="text" name="register_no" style="width: 35px" value="{{ $hearing_tracking->register_no }}" required>  শুনানী</h6>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-8" style="text-align: left;">
                <p>নং:৪৯.০১.০০০০.০২২.৩১.৫২০.১৬- <input required type="text" name="sunani_no" style=" border: none; border-bottom: 1px solid #ccc; width: 50px;" value="{{ $hearing_tracking->sunani_no  }}"></p> 
              </div>
              <div class="col-lg-4" style="text-align: right;">
                <p>তারিখ: <input required type="date" value="<?php echo date('Y-m-d',strtotime($hearing_tracking->hearing_generate_date)); ?>" name="hearing_generate_date"  style=" border: none; border-bottom: 1px solid #ccc; width: 130px;"></p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12" style="text-align: left;">

                <p>বিষয়: <u>রিক্রুটিং "এজেন্সী নাম", এর বিরুদ্ধে আনীত অভিযোগ তদন্ত প্রসঙ্গে।</u></p>
                <p>সূত্র : <u>স্মারক নং ৪৯.০১.০০০০।০৭.০০৪.০৬৬.১৮.১৪৫৯ তারিখ : <input required type="date" name="sarok_generate_date" style=" border: none; border-bottom: 1px solid #ccc; width: 130px;" value="<?php echo date('Y-m-d',strtotime($hearing_tracking->sarok_generate_date)); ?>"></u></p>
                    </div>
                  <br>
           
               <div class="col-lg-12" style="align-content: center; padding: 20px">
                 <div class="col-lg-6" style="text-align: left; height: 100px;float: left; padding:5px 200px 5px 50px;">
                  <p><u>বাদীর নাম ও ঠিকানা </u></p>
                  <p>১।বাদীর নাম : {{ $hearing_tracking->sufferer_name  }}<br>
                      পিতা: {{ $hearing_tracking->sufferer_father  }} <br>
                      ঠিকানা : {{ $hearing_tracking->sufferer_address  }}</p>
                      </div>
                      <div class="col-lg-6" style="text-align: left; height: 100px; float: left;padding:5px 50px 5px 200px;">
                        <p><u>বিবাদীর নাম ও ঠিকানা </u></p>
                        <p>১।এজেন্সী নাম : {{ $hearing_tracking->agency_name  }}<br>
                            ফোন : {{ $hearing_tracking->agency_mobile_no  }}<br>
                            এজেন্সী ঠিকানা : {{ $hearing_tracking->agency_address  }}
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

                    <p>উপযুক্ত বিষয় ও সূত্রের প্রেক্ষিতে জানানো যাচ্ছে যে , বাদী  বাদীর নাম , কর্তৃক রিক্রুটিং এজেন্সি  রিক্রুটিং এজেন্সী নাম, এর বিরুদ্ধে আনীত অভিযোগ তদন্তের জন্য দুই সদস্য বিশিষ্ট একটি তদন্ত কমিটি গঠন করা হয়েছে।</p>
                    <br>
                    <p>০২। আগামী 
                      <input required value="<?php echo date('Y-m-d',strtotime($hearing_tracking->hearing_full_date)); ?>" type="date" name="hearing_full_date"  style=" border: none; border-bottom: 1px solid #ccc; width: 230px;">তারিখ  রোজ

                      <input required type="text" name="hearing_day" style=" border: none; border-bottom: 1px solid #ccc; width: 100px;" value="{{ $hearing_tracking->hearing_day  }}">  সকাল 

                      <input required type="time" name="hearing_time" style=" border: none; border-bottom: 1px solid #ccc; width: 100px;" value="{{ $hearing_tracking->hearing_time  }}"> 

                    ঘটিকায় নিন্মস্বাক্ষরকারীর অফিস কক্ষে ( জনশক্তি, কর্মসসস্থান ও প্রশিক্ষণ ব্যুরো, ৮ম তলা, ৮৯/২, কাকরাইল, ঢাকা ) অভিযোগের ১ম শুনানী গ্রহণ করবেন।অভিযোগ শুনানীর সময় বাদী/বিবাদীগণকে উপযুক্ত সাক্ষ্য প্রমানাদি সহকারে তদন্ত কমিটির সম্মুখে হাজির হয়ে নিজ নিজ বক্তব্য পেশ করার জন্য অনুরোধ করা হলো। শুনানির জন্য নির্ধারিত তারিখে নিদ্দিষ্ট সময়ে বাদী/বিবাদীগণ উপস্থিত হতে ব্যর্থ হলে অভিযোগ সম্পর্কে কিছু  বলার নেই বলে গণ্য হবে এবং অভিযোগ সম্পর্কে একতরফা সিদ্ধান্ত গ্রহণ করা হবে।</p>
                    <br>
                    <br>
                    <br>
                      <div style="float: right; display: block; text-align: center; height: 300px; ">
                        <p>{{ $commitee_letter_member->officer_name1 }}</p>
                        <p>উপপরিচালক (অর্থ, বাজেট ও আইটি )</p>
                        <p>বিএমআইটি , ঢাকা </p>
                        <p>ও<br>তদন্ত কর্মর্কর্তা </p>
                      </div>
                    <br>
                    <br><br>
                     <div class="row" style=" text-align: left;float: left; padding-left: 30px">
                          
                          <p><u><b>অবগতির জন্য অনুলিপিঃ-</b></u></p><br>
                          <p>০১। {{ $commitee_letter_member->officer_name2 }},সহকারী পরিচালক, বিএমআইটি , ঢাকা ও তদন্ত কর্মর্কর্তা 
                          <br>০২।রিক্রুটিং এজেন্সী নাম,রিক্রুটিং এজেন্সীর ঠিকানা  
                          <br>০৩। {{ $hearing_tracking->sufferer_name  }} , {{ $hearing_tracking->sufferer_father  }} ,{{ $hearing_tracking->sufferer_address  }} </p>
                      </div>
                              
                          </div>
                        </div><br>

                      </div>
                  </div>
                <br><br><br><br>
                <div class="panel panel-success">
                  <div class="panel-heading">Add Note</div>
                  <div class="panel-body">
                    <textarea class="form-control" name="note">{{ strip_tags($hearing_tracking->note) }}</textarea>
                  </div>
                </div>
                <br><br><br><br>
                <div class="row">
                  <button type="submit" class="btn btn-default" name="final_save" style="margin-left: 20px">Save</button>
                  <button type="submit" class="btn btn-info" name="final_send" id="assign">Send</button>
                </div>
            @endforeach
          </form>
          </div>
        </div>
    </div>
  </div>

</div>



@endsection
