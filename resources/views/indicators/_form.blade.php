<div class="box-body">
  <div class="form-group {{ $errors->has('indicator_title') ? ' has-error' : '' }}">
    {!!Form::label('indicator_title','Indicator Title') !!}
    {!!Form::text('indicator_title',null, ['class'=>'form-control','placeholder'=>'Enter Indicator title']) !!}
    @if($errors->has('indicator_title'))
      <span class="help-block">
            {{ $errors->first('indicator_title') }}
      </span>
    @endif
  </div>

  <div class="form-group {{ $errors->has('schema_title') ? ' has-error' : '' }}">
    {!!Form::label('targets_id','Target') !!}
    {!!Form::select('targets_id',App\GoalsTarget::targetList(),@$model->targets->id, ['class'=>'form-control','placeholder'=>'Select Target']) !!}
    @if($errors->has('targets_id'))
      <span class="help-block">
            {{ $errors->first('targets_id') }}
      </span>
    @endif
  </div>


</div>
<!-- /.box-body -->
<style type="text/css">
  .file-actions{
      float: right;
  }
  .file-upload-indicator{
     display: none;
  }

  </style>