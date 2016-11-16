<div class="grid">

@foreach($galleries as $gallery)
	<div class="grid-item">
		<a href="{!! route('galleries.show', $gallery->id) !!}">
		{!! HTML::image('/upload_image/'.$gallery->id.'/'.$gallery->thumbnail) !!}</a>
	</div>
@endforeach
</div>