@include("articles.search")
<div class="row">
    {!! link_to(route("articles.create"), "Create", ["class"=>"pull-right btn btn-raised btn-primary"]) !!}  
  	{!! link_to(route("export.articles"), "Export", ["class"=>"pull-right btn btn-raised btn-success"]) !!}

  	{!! Form::open(['route' => 'import.articles', 'files'=>true, 'class' => 'form-horizontal', 'role' => 'form']) !!}
  	<div class="form-group">
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

    <h2 class="pull-left">List Articles</h2>

  </div>
  <div id="list-articles">
    @include('articles.list')  
  </div>

  @include("articles.javascript")