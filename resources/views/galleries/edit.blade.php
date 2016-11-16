@extends("layouts.application")
@section("content")
  <h3>Edit a Gallery</h3>
  {!! Form::model($gallery, ['route' => ['galleries.update', $gallery->id], 'files'=>true, 'method' => 'put', 'class' => 'form-horizontal', 'role' => 'form']) !!}
  	{!! HTML::image('/upload_image/'.$gallery->id.'/'.$gallery->showimage) !!}
    @include('galleries.form')
  {!! Form::close() !!}
@stop