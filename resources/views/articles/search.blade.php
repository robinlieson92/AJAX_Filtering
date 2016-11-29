<div class="row">
  <div class="col-md-12 search">
    <div class="col-md-6">
      <div class="input-group input-group-sm">
        <input type="text" class="form-control" id="keywords" placeholder="Keywords">
        <span class="input-group-btn">
        <button id="search" class="btn btn-info btn-raised btn-flat" type="button">
          Go!
        </button>
        </span>
      </div><!-- /input-group -->
    </div>
  </div>
</div>

<div class="row">
  {!! link_to(route("articles.create"), "Create", ["class"=>"pull-right btn btn-raised btn-primary"]) !!}  
  {!! link_to(route("export.articles"), "Export", ["class"=>"pull-right btn btn-raised btn-success"]) !!}

  {!! Form::open(['route' => 'import.articles', 'files'=>true, 'class' => 'form-horizontal', 'role' => 'form']) !!}
  <div class="form-group is-fileinput">
    {!! Form::label('import', 'Import', array('class' => 'col-sm-8 control-label')) !!}
    <div class="col-sm-4">
      {!! Form::text(null, null, array('class' => 'form-control', 'placeholder'=>"Browse ...", 'readonly' => "")) !!}
      {!! Form::file('import_file', null, array('multiple'=>"", 'id' => "import")) !!}
      <div class="text-danger">{!! $errors->first('import_file') !!}</div>
    </div>
  </div>
  <div class="form-group">
    {!! Form::submit('Import', array('class' => 'btn btn-raised btn-primary pull-right')) !!}
  </div>
    {!! Form::close() !!}
</div>

