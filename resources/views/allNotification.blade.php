@extends('theme.default')

@section('content')
    <h3>All notifications list</h3>
	<table class="table table-bordered">
	@if($hearing_notification_list->isEmpty() == false)
		@foreach($hearing_notification_list as $hearing_notification_lists)
			<tr>
				<td><span class="label label-primary">Hearing Notification</span></td>
				<td>{{ $hearing_notification_lists->tracking_no }}</td>
				<td>{{ $hearing_notification_lists->created_at }}</td>
			</tr> 
		@endforeach
	@endif
	@if($new_notification_list->isEmpty() == false)
	@foreach($new_notification_list as $new_notification_lists)
		<tr>
			<td><span class="label label-success">New Notification</span></td>
			<td>{{ $new_notification_lists->tracking_no }}</td>
			<td>{{ $new_notification_lists->created_at }}</td>
		</tr> 
	@endforeach
	@endif
	@if($committe_notification_list->isEmpty() == false)
	@foreach($committe_notification_list as $committe_notification_lists)
		<tr>
			<td><span class="label label-danger">Committe Notification</span></td>
			<td>{{ $committe_notification_lists->tracking_no }}</td>
			<td>{{ $committe_notification_lists->created_at }}</td>
		</tr> 
	@endforeach
	@endif
	</table>
@endsection

