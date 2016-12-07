<div class="box-body">
  <div class="form-group {{ $errors->has('target_id') ? ' has-error' : '' }}">
    {!!Form::label('target_id','Target ID') !!}
    {!!Form::text('target_id',null, ['class'=>'form-control','placeholder'=>'Enter Target ID']) !!}
    @if($errors->has('target_id'))
      <span class="help-block">
            {{ $errors->first('target_id') }}
      </span>
    @endif
  </div>

  <div class="form-group {{ $errors->has('schema_title') ? ' has-error' : '' }}">
    {!!Form::label('target_title','Target Title') !!}
    {!!Form::text('target_title',null, ['class'=>'form-control','placeholder'=>'Enter Target Title']) !!}
    @if($errors->has('target_title'))
      <span class="help-block">
            {{ $errors->first('target_title') }}
      </span>
    @endif
  </div>

  @if(!empty(@$model))
    <div class="input-group input-group-sm">
      {!!Form::label('target_image','Current Image') !!}<br/>
      <img src="{{asset('target_file/').'/'.$model->target_image}}" width="160px" />
    </div><br/>
  @endif
  <div class="{{ $errors->has('target_image') ? ' has-error' : '' }} input-group input-group-sm">
    {!!Form::label('target_image','Target Image') !!}
    {!!Form::file('target_image',['class'=>'form-control','id'=>'file-3']) !!}
    @if($errors->has('target_image'))
      <span class="help-block">
            {{ $errors->first('target_image') }}
      </span>
    @endif
  </div>
  
  <div class="form-group {{ $errors->has('target_desc') ? ' has-error' : '' }} " style="margin-top: 2%;">
    {!!Form::label('target_desc','Target Description') !!}
    {!!Form::textarea('target_desc',null,['class'=>'form-control','placeholder'=>'Eenter Description','id'=>'target_desc']) !!}
    @if($errors->has('target_desc'))
      <span class="help-block">
            {{ $errors->first('target_desc') }}
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