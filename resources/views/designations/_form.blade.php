<div class="box-body">

  <div class="form-group {{ $errors->has('designation') ? ' has-error' : '' }}">
    {!!Form::label('designation','Designation Name') !!}
    {!!Form::text('designation',null, ['class'=>'form-control','placeholder'=>'Enter Designation Name']) !!}
    @if($errors->has('designation'))
      <span class="help-block">
            {{ $errors->first('designation') }}
      </span>
    @endif
  </div>

</div>
