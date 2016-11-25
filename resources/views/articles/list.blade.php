@foreach($articles as $article)
<article class="row">
  <h3>{!!$article->title!!}</h3>
  <p>
    {!! str_limit($article->content, 250) !!}
  </p>
  <i>By {!! $article->writer !!}</i>
</article>
<div>
  {!! Form::open(array('route' => array('articles.destroy', $article->id), 'method' => 'delete')) !!}
   {!! link_to(route('articles.show', $article->id), "Read", ['class' => 'btn btn-raised btn-info']) !!}
   {!! link_to(route('articles.edit', $article->id), 'Edit', ['class' => 'btn btn-raised btn-warning']) !!}
   {!! Form::submit('Delete', array('class' => 'btn btn-raised btn-danger', "onclick" => "return confirm('are you sure?')")) !!}
  {!! Form::close() !!}
  </div>
@endforeach

{!! $articles->render() !!}

<input id="direction" type="hidden" value="asc" />