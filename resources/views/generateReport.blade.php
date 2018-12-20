@extends('theme.default')
@section('content')
	<script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>

	<div class="row">
	  <div class="col-lg-12">
	    <div class="panel panel-success">
	      <div class="panel-heading">Type your report here</div>
	      <div class="panel-body">
	        <form action="{{ url('reportGenerateInsert') }}" method="post">
	          {{ csrf_field() }}
	          	<input type="hidden" name="tracking_no" value="{{ $data }}">
			    <textarea name="editor1" id="editor1" rows="10" cols="80"></textarea>
			        
				<br>
	          <button type="submit" class="btn btn-success" name="report" id="incomplete">Generate Report</button>
	        </form>
	      </div>
	    </div>
	  </div>
	</div>
 
<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace( 'editor1' );
</script>  
@endsection