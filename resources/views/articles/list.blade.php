@foreach($articles as $article)
<article class="row">
  <h3>{!!$article->title!!}</h3>
  <p>
    {!! str_limit($article->content, 250) !!}
    {!! link_to(route('articles.show', $article->id), 'Read More') !!}
  </p>
</article>
@endforeach

{!! $articles->render() !!}