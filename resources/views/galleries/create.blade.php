@extends("layouts.application")
@section("content")
  <h3>Create a Gallery</h3>
  {!! Form::open(['route' => 'galleries.store', 
  'files'=>true,
  'class' => 'form-horizontal', 'role' => 'form']) !!}
    @include('galleries.form')
  {!! Form::close() !!}
@stop