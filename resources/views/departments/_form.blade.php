<div class="box-body">
  <div class="form-group {{ $errors->has('code') ? ' has-error' : '' }}">
    {!!Form::label('code','Department Code') !!}
    {!!Form::text('code',null, ['class'=>'form-control','placeholder'=>'Enter Code']) !!}
    @if($errors->has('code'))
      <span class="help-block">
            {{ $errors->first('code') }}
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
