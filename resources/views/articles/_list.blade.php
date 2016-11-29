<div class="row">
  <div class="col-lg-12" id="enrolls-list">
    <h1>Training Candidates</h1>
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th><a id="id" class="ic-direction">ID</a></th>
          <th class="text-center">Title</th>
          <th class="text-center">Created At</th>
          <th class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($articles as $article)
          <tr>
            <td>{!! $article->id !!}</td>
            <td class="text-center">{!! $article->title !!}</td>
            <td class="text-center">{!! $article->created_at !!}</td>
            <td>
              {!!link_to('articles/'.$article->id, 'Show', array('class' => 'btn btn-raised btn-info'))!!}
              {!!link_to('articles/'.$article->id.'/edit', 'Edit', array('class' => 'btn btn-raised btn-warning'))!!}
              {!! Form::open(array('route' => array('articles.destroy', $article->id), 'method' => 'delete')) !!}
                {!! Form::submit('Delete', array('class' => 'btn btn-raised btn-danger', "onclick" => "return confirm('are you sure?')")) !!}
              {!! Form::close() !!}
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <div>
      {!! $articles->render() !!}
    </div>
  </div>
  <input id="direction" type="hidden" value="" />
</div>