<div class="box-body">
  <div class="form-group {{ $errors->has('ministry_id') ? ' has-error' : '' }}">
    {!!Form::label('ministry_id','Ministry ID') !!}
    {!!Form::text('ministry_id',null, ['class'=>'form-control','placeholder'=>'Enter Ministry ID']) !!}
    @if($errors->has('ministry_id'))
      <span class="help-block">
            {{ $errors->first('ministry_id') }}
      </span>
    @endif
  </div>

  <div class="form-group {{ $errors->has('ministry_title') ? ' has-error' : '' }}">
    {!!Form::label('ministry_title','Ministry Title') !!}
    {!!Form::text('ministry_title',null, ['class'=>'form-control','placeholder'=>'Enter Ministry Title']) !!}
    @if($errors->has('ministry_title'))
      <span class="help-block">
            {{ $errors->first('ministry_title') }}
      </span>
    @endif
  </div>

  <div class="form-group {{ $errors->has('ministry_description') ? ' has-error' : '' }}">
    {!!Form::label('ministry_description','Description') !!}
    {!!Form::textarea('ministry_description',null,['class'=>'form-control','placeholder'=>'Eenter Description','id'=>'ministry_description']) !!}
    @if($errors->has('ministry_description'))
      <span class="help-block">
            {{ $errors->first('ministry_description') }}
      </span>
    @endif
  </div>

  <div class="{{ $errors->has('ministry_icon') ? ' has-error' : '' }} form-group">
    {!!Form::label('ministry_icon','Icon Name') !!}
    {!!Form::text('ministry_icon',null, ['class'=>'form-control','placeholder'=>'Enter Icon Name']) !!}
    @if($errors->has('ministry_icon'))
      <span class="help-block">
            {{ $errors->first('ministry_icon') }}
      </span>
    @endif
  </div>

  <div class="{{ $errors->has('ministry_image') ? ' has-error' : '' }} input-group input-group-sm">
    {!!Form::label('ministry_image','Ministry Image') !!}
    {!!Form::file('ministry_image',['class'=>'form-control','id'=>'file-3']) !!}
    @if($errors->has('ministry_image'))
      <span class="help-block">
            {{ $errors->first('ministry_image') }}
      </span>
    @endif
  </div>

  <div class="{{ $errors->has('ministry_phone') ? ' has-error' : '' }} form-group" style="margin-top: 2%;">
    {!!Form::label('ministry_phone','Ministry Phone') !!}
    {!!Form::text('ministry_phone',null, ['class'=>'form-control','placeholder'=>'Enter Phone']) !!}
    @if($errors->has('ministry_phone'))
      <span class="help-block">
            {{ $errors->first('ministry_phone') }}
      </span>
    @endif
  </div>

  <div class="{{ $errors->has('ministry_ministers') ? ' has-error' : '' }} form-group">
    {!!Form::label('ministry_ministers','Ministry Ministers') !!}
    {!!Form::text('ministry_ministers',null, ['class'=>'form-control','placeholder'=>'Enter Minsiters']) !!}
    @if($errors->has('ministry_ministers'))
      <span class="help-block">
            {{ $errors->first('ministry_ministers') }}
      </span>
    @endif
  </div>

  <div class="{{ $errors->has('ministry_departments') ? ' has-error' : '' }} form-group">
    {!!Form::label('ministry_departments','Ministry Departments') !!}
    {!!Form::select('ministry_departments[]',\App\Department::departmentList(),null, ['class'=>'form-control select2', 'multiple']) !!}
    @if($errors->has('ministry_departments'))
      <span class="help-block">
            {{ $errors->first('ministry_departments') }}
      </span>
    @endif
  </div>


  <div class="{{ $errors->has('ministry_order') ? ' has-error' : '' }} form-group">
    {!!Form::label('ministry_order','Ministry Ministers') !!}
    {!!Form::text('ministry_order',null, ['class'=>'form-control','placeholder'=>'Enter Minsiters Order']) !!}
    @if($errors->has('ministry_order'))
      <span class="help-block">
            {{ $errors->first('ministry_order') }}
      </span>
    @endif
  </div>


</div>

<style type="text/css">
  .file-actions{
      float: right;
  }
  .file-upload-indicator{
     display: none;
  }
  .select2-selection__choice{

      background-color: #3c8dbc !important;
  }
  .select2-selection__choice__remove{

      color: #FFF !important;
  }
</style>

<!-- /.box-body -->
