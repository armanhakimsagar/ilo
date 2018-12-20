@extends('theme.default')
@section('content')
	<p>
	@foreach($report as $reports)
		{!!  $reports->editor1 !!}
	@endforeach
	</p>
@endsection