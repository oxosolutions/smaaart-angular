<div class="box-body">
  <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
    {!!Form::label('name','Name') !!}
    {!!Form::text('name',null, ['class'=>'form-control','placeholder'=>'Enter Name']) !!}
    @if($errors->has('name'))
      <span class="help-block">
            {{ $errors->first('name') }}
      </span>
    @endif
  </div>

  <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
    {!!Form::label('email','Email address') !!}
    {!!Form::text('email',null, ['class'=>'form-control','placeholder'=>'Enter Email']) !!}
    @if($errors->has('email'))
      <span class="help-block">
            {{ $errors->first('email') }}
      </span>
    @endif
  </div>

  <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
    {!!Form::label('userpassword','Password') !!}
    {!!Form::password('password', ['class'=>'form-control','placeholder'=>'Enter Password','id'=>'userpassword']) !!}
    @if($errors->has('password'))
      <span class="help-block">
            {{ $errors->first('password') }}
      </span>
    @endif
  </div>

  <div class="{{ $errors->has('title') ? ' has-error' : '' }} input-group input-group-sm">
    {!!Form::label('token','Api Token') !!}
    {!!Form::text('token',null, ['class'=>'form-control','placeholder'=>'Enter Token','readonly'=>'readonly']) !!}
    <span class="input-group-btn">
      {{!!Form::button('Generate!',['class'=>'btn btn-info btn-flat generate-token', 'style'=> 'margin-top: 35%;']) !!}}
    </span>
    @if($errors->has('token'))
      <span class="help-block">
            {{ $errors->first('token') }}
      </span>
    @endif
  </div>
</div>
<!-- /.box-body -->
