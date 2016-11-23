@extends("layouts.application")
@section("content")
   	@include("articles.search")
   		<div class="list">
    		@include("articles._index")
   		</div>
   	@include("articles.javascript")
@stop