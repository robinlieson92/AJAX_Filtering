@extends("layouts.application")
@section("content")

{!! link_to(route('export.comments', $article->id), "Export", ["class"=>"pull-right btn btn-raised btn-success"]) !!}

  <div class="row">
    <h1>{!! $article->title !!}</h1>
    <p>{!! $article->content !!}</p>
    <i>By {!! $article->writer !!}</i>
  </div>

  <p><h4>{!! $article->comments->count() !!} Comments</h4></p>
@foreach($comments as $comment)
<div style="outline: 1px solid #74AD1B;">
  <p>
    {!! $comment->content !!}
  </p>
  <i>By : {!! $comment->user !!}</i>
</div>
@endforeach

  <div>
  <h3><i><u>Give Comments</u></i></h3>
  {!! Form::open(['route' => 'comments.store', 'class' => 'form-horizontal', 'role' => 'form']) !!}
    <div class="form-group">
      {!! Form::label('article_id', 'Title', array('class' => 'col-lg-3 control-label')) !!}
      <div class="col-lg-9">
    {!! Form::text('article_id', $value = $article->id, array('class' => 'form-control', 'readonly')) !!}
      </div>
      <div class="clear"></div>
    </div>
    <div class="form-group">
      {!! Form::label('content', 'Content', array('class' => 'col-lg-3 control-label')) !!}
      <div class="col-lg-9">
      {!! Form::textarea('content', null, array('class' => 'form-control', 'rows' => 10, 'autofocus' => 'true')) !!}
        {!! $errors->first('content') !!}
      </div>
      <div class="clear"></div>
    </div>
    <div class="form-group">
      {!! Form::label('user', 'User', array('class' => 'col-lg-3 control-label')) !!}
      <div class="col-lg-9">
        {!! Form::text('user', null, array('class' => 'form-control')) !!}
        {!! $errors->first('user') !!}
      </div>
      <div class="clear"></div>
    </div>
    <div class="form-group">
      <div class="col-lg-3"></div>
      <div class="col-lg-9">
        {!! link_to(route('articles.index'), "Back", ['class' => 'btn btn-raised btn-info']) !!}
        {!! Form::submit('Comment', array('class' => 'btn btn-raised btn-primary')) !!}
      </div>
      <div class="clear"></div>
    </div>
  {!! Form::close() !!}
  </div>
  
@stop