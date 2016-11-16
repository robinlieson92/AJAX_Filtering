@extends("layouts.application")
@section("content")
  <div class="row">
    <h2 class="pull-left">List Gallery</h2>
  {!! link_to(route("galleries.create"), "Upload Image", ["class"=>"pull-right btn btn-raised btn-primary "]) !!}
  </div>
  @include('galleries.list')
@stop