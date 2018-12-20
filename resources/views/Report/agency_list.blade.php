@extends('theme.default')
@section('content')
<?php use App\Http\Controllers\HomeController;?>

<div class="row" style="background-color: #eee">
    <div class="col-lg-12">
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th width="30%">Agency Name</th>
              <th width="20%">Total</th>
              <th width="20%">Tracking No</th>
              <th width="10%">Status</th>
              <th width="20%">Channel</th>
            </tr>
          </thead>
          <tbody>
            @foreach($agencylist as $key => $value)
			<tr>
				<td>{{ $value['agency_name'] }}</td>
				<td>{{ $value['total'] }}</td>
				<td><?php 
						$data = Homecontroller::ComplainTypeList($value['agency_name']); 
						foreach ($data as $key => $loops) {
							echo $loops->applicantTrackingNo."<hr>";
						}
					?></td>
				<td><?php 
						$data = Homecontroller::ComplainTypeList($value['agency_name']); 
						$loop = json_encode($data);
						foreach ($data as $key => $loops) {
							echo "<span class='label label-danger'>".$loops->application_status."</span><hr>";
						}
					?></td>
				<td>
					<?php 
						$list = Homecontroller::ComplainTypeList($value['agency_name']); 
						foreach ($list as $key => $value) {
							echo "<span class='label label-success'>".$value->application_type."</span><hr>";
						}
					?> 
				</td>
				
			</tr>
			@endforeach
          </tbody>
        </table>
    </div>
</div>



@endsection