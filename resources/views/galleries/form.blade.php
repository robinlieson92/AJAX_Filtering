<div class="form-group">
  {!! Form::label('title', 'Title', array('class' => 'col-lg-3 control-label')) !!}
  <div class="col-lg-9">
    {!! Form::text('title', null, array('class' => 'form-control', 
    'placeholder'=>"Enter Title",'autofocus' => 'true')) !!}
    <div class="text-danger">{!! $errors->first('title') !!}</div>
  </div>
  <div class="clear"></div>
</div>

<div class="form-group">
  {!! Form::label('description', 'Description', array('class' => 'col-lg-3 control-label')) !!}
  <div class="col-lg-9">
    {!! Form::textarea('description', null, array('class' => 'form-control', 
    'placeholder'=>"Enter Description",'rows' => 10)) !!}
    <div class="text-danger">{!! $errors->first('description') !!}</div>
  </div>
  <div class="clear"></div>
</div>

<div class="form-group">
  {!! Form::label('image', 'Image', array('class' => 'col-lg-3 control-label')) !!}
  <div class="col-lg-9">
    {!! Form::text(null, null, array('class' => 'form-control', 'placeholder'=>"Browse ...", 'readonly' => "")) !!}
    {!! Form::file('urlimage', null, array('multiple'=>"", 'id' => "image")) !!}
    <div class="text-danger">{!! $errors->first('urlimage') !!}</div>
  </div>
  <div class="clear"></div>
</div>

<div class="form-group">
  <div class="col-lg-3"></div>
  <div class="col-lg-9">
    @if (Route::currentRouteName() == "galleries.create")  
    {!! Form::submit('Upload', array('class' => 'btn btn-raised btn-primary')) !!}
    @else
    {!! Form::submit('Update', array('class' => 'btn btn-raised btn-primary')) !!}
    @endif
   
    {!! link_to(route('galleries.index'), "Back", ['class' => 'btn btn-raised btn-info']) !!}

  </div>
  <div class="clear"></div>
</div>