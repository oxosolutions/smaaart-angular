<div class="box-body">
  <div class="form-group {{ $errors->has('dep_code') ? ' has-error' : '' }}">
    {!!Form::label('dep_code','Department Code') !!}
    {!!Form::text('dep_code',null, ['class'=>'form-control','placeholder'=>'Enter Code']) !!}
    @if($errors->has('dep_code'))
      <span class="help-block">
            {{ $errors->first('dep_code') }}
      </span>
    @endif
  </div>

  <div class="form-group {{ $errors->has('dep_name') ? ' has-error' : '' }}">
    {!!Form::label('dep_name','Department Name') !!}
    {!!Form::text('dep_name',null, ['class'=>'form-control','placeholder'=>'Enter Department Name']) !!}
    @if($errors->has('dep_name'))
      <span class="help-block">
            {{ $errors->first('dep_name') }}
      </span>
    @endif
  </div>

</div>
<!-- /.box-body -->
