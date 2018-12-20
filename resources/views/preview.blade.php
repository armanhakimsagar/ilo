<div id="printableArea">
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Complain Management System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="{!! asset('theme/vendor/jquery/jquery.min.js') !!}"></script>
  <!-- Bootstrap Core JavaScript -->
  <script src="{!! asset('theme/vendor/bootstrap/js/bootstrap.min.js') !!}"></script>
</head>
<body>
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-success">
      <div class="panel-body">
        <table class="table table-bordered">
          <tr>
            <td width="50%"><b>ভুক্ত ভোগীর নাম: </b>{{ $preview_data['victim_name'] }}</td>
            <td><b>ভুক্ত ভোগীর মোবাইল নং:</b> {{ $preview_data['victim_mobile'] }}</td>
          </tr>
          <tr>
            <td><b>ভুক্ত ভোগীর জাতীয়তা:</b>  {{ $preview_data['victim_nationality'] }}</td>
            <td><b>ভুক্ত ভোগীর লোকাল নম্বর:</b> {{ $preview_data['victim_local_no'] }} </td>
          </tr>
          <tr>
            <td><b>অবস্থানরত দেশের নাম:</b>  {{ $preview_data['victim_country_name'] }}</td>
            <td><b>পাসপোর্ট নং:</b> {{ $preview_data['victim_passport'] }} </td>
          </tr>

          <tr>
            <td><b>স্থানীয় ঠিকানা:</b> {{ $preview_data['victim_address'] }} </td>
            <td><b>লিঙ্গ:</b> {{ $preview_data['gender'] }} </td>
          </tr>
          <tr>
            <td><b>জেলা :</b>  {{ $preview_data['victim_district'] }}</td>
            <td><b>উপজেলা :</b>  {{ $preview_data['victim_upazilla'] }}</td>
          </tr>



          <tr>
            <td><b>বর্তমান যোগাযোগের ঠিকানা:</b> {{ $preview_data['victim_address'] }} </td>
            <td><b>স্থানীয় ঠিকানা:</b>  {{ $preview_data['victim_local_address'] }}</td>
          </tr>
          

          <tr>
            <td><b>অভিযোগকারীর নাম:</b>  {{ $preview_data['complainant_name'] }}</td>
            <td><b>অভিযোগকারীর ইমেইল:</b> {{ $preview_data['complainant_email'] }} </td>
          </tr>
          <tr>
            <td><b>অভিযোগকারীর দেশ:</b> {{ $preview_data['complainant_country'] }} </td>


            <td><b>অভিযোগকারীর মোবাইল নম্বর:</b> {{ $preview_data['complainant_mobile'] }} </td>
          

          </tr>
          <tr>
            <td><b>অভিযোগকারীর ঠিকানা:</b> {{ $preview_data['complainant_address'] }} </td>
            <td><b>আপনার অভিযোগের বিবরণ:</b> {{ $preview_data['complaint_description'] }} </td>
          </tr>
          <tr>
            <td><b>অর্থ লেনদেনকারীর নাম:</b> {{ $preview_data['money_taker_name'] }} </td>
            <td><b>অর্থ লেনদেনকারীর ফোন নাম্বার:</b> {{ $preview_data['money_taker_phone_no'] }} </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>

</body>
</html>
</div>