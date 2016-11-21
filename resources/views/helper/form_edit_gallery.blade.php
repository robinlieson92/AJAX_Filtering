@if (Route::currentRouteName() == "galleries.create")  
    {!! Form::submit('Upload', array('class' => 'btn btn-raised btn-primary')) !!}
@else
    {!! Form::submit('Update', array('class' => 'btn btn-raised btn-primary')) !!}
@endif