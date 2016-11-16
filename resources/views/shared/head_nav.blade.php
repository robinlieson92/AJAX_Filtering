<div class="navbar navbar-fixed-top navbar-default" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      {!! HTML::image('/logo.png',null,['class' => 'navbar-brand']) !!}
      {!! link_to(route('root'), "Laravel Training", ['class' => 'navbar-brand']) !!}
    </div>
    <div class="navbar-collapse collapse navbar-responsive-collapse">
    <ul class="nav navbar-nav navbar-right">
      <li>{!! link_to(route('root'), " Home", ['class' => 'glyphicon glyphicon-home']) !!}</li>
      <li>{!! link_to(route('galleries.index'), " Gallery", ['class' => 'glyphicon glyphicon-camera']) !!}</li>
      <li>{!! link_to(route('articles.index'), " Article", ['class' => 'glyphicon glyphicon-list-alt']) !!}</li>
    </ul>
    </div>
  </div>
</div>