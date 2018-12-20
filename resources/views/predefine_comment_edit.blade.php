@extends('theme.default')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"> Predefine Comments</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
@if(Session::has('message')) 
    <div class="alert alert-info"> {{Session::get('message')}} </div> 
@endif
<!-- /.row -->
<div class="row">
    <div class="col-lg-12" style="margin-top: 10px; margin-bottom: 10px">
      <a href="#" class="btn btn-primary btn-xs pull-left" data-toggle="modal" data-target="#myModal" role="button"><span class="glyphicon glyphicon-plus-sign"></span> New Comment</a>
    </div>
    <div class="col-lg-12">
      <div class="panel panel-primary">
        <div class="panel-heading">Comment Edit</div>
        <div class="panel-body">
          {!! Form::open(array('url' => 'CommentsUpdate','method'=>'POST', 'id'=>'differentForm')) !!}
          <input type="hidden" name="id" value="{{ $editcomment->id }}">
            <div class="form-group">
              <label for="email">Comment : </label>
              <textarea class="form-control" name="comment" id="comment" required="required">{{ $editcomment->comment }}</textarea>
            </div>  
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
          {{ Form::close() }}
        </div>
      </div> 
    </div>
    <div class="col-lg-12">
        <table class="display table table-striped table-bordered nowrap">
          <thead>
            <tr>
              <th>Sl. No</th>
              <th>Comments</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1;?>
            @foreach($comment as $comments)
              <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $comments->comment }}</td>
                <td>
                  <a href="{{ URL::to('EditComment/'.$comments->id) }}" class="btn btn-default" role="button"><i class="fa fa-pencil-square-o"></i></a>
                    <a href="{{ URL::to('Commentsdelete/'.$comments->id) }}" class="btn btn-default" role="button"><i class="fa fa-trash"></i></a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
    </div>
</div>
<!-- ==================== Comments Add ================ -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">New Comment</h4>
        </div>
        <div class="modal-body">
            {!! Form::open(array('url' => 'CommentsCreate','method'=>'POST', 'id'=>'differentForm')) !!}
              <div class="form-group">
                <label for="email">Comment : </label>
                <textarea class="form-control" name="title" id="title" required="required" maxlength="100"></textarea>
              </div>         
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" onclick="todoSubmit('modalID')">Save</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        {{ Form::close() }} 
      </div>
    </div>
</div>
<!-- ==================== Comments End ================ -->
@endsection