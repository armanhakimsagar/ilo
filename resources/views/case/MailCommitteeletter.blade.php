<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="content">

    <div class="row">
        <div class="col-lg-12" style="text-align: center;">
          <p>গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</p>
          <p><b>জনশক্তি, কর্মসংস্থান ও প্রশিক্ষণ ব্যুরো</b></p>
          <p>প্রবাসী কল্যাণ ভবন</p>
          <p>ইস্কাটন গার্ডেন, রমনা, ঢাকা-১০০০</p>
        </div>
        <div class="col-lg-12" style="text-align: center;">

        </div>
    </div>

    <div class="row">
        <div class="col-lg-6" style="text-align: left;">
          <p>নং-{{ $committee->committee_no }}</p>
        </div>
        <div class="col-lg-6" style="text-align: right;">
          <p>তারিখ -{{ $committee->generate_date }}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12" style="text-align: center;">
          <p><b><u>"অফিস আদেশ"</u></b></p>
          
        </div>
        <div class="row">
          <div class="col-lg-12">
            {{ strip_tags($committee->description) }}
          </div>
        </div><br>

    </div>


</div>
</body>
</html>