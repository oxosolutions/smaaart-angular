<div class="box-body">
  <div class="form-group {{ $errors->has('resource_id') ? ' has-error' : '' }}">
    {!!Form::label('resource_id','Resource ID') !!}
    {!!Form::text('resource_id',null, ['class'=>'form-control','placeholder'=>'Enter Resource ID']) !!}
    @if($errors->has('resource_id'))
      <span class="help-block">
            {{ $errors->first('resource_id') }}
      </span>
    @endif
  </div>

  <div class="form-group {{ $errors->has('resource_title') ? ' has-error' : '' }}">
    {!!Form::label('resource_title','Resource Title') !!}
    {!!Form::text('resource_title',null, ['class'=>'form-control','placeholder'=>'Enter Resource Title']) !!}
    @if($errors->has('resource_title'))
      <span class="help-block">
            {{ $errors->first('resource_title') }}
      </span>
    @endif
  </div>

  @if(!empty(@$model))
    <div class="input-group input-group-sm">
      {!!Form::label('resource_image','Current Image') !!}<br/>
      <img src="{{asset('resource_file/').'/'.$model->resource_image}}" width="160px" />
    </div><br/>
  @endif
  <div class="{{ $errors->has('resource_image') ? ' has-error' : '' }} input-group input-group-sm">
    {!!Form::label('resource_image','Resource Image') !!}
    {!!Form::file('resource_image',['class'=>'form-control','id'=>'file-3']) !!}
    @if($errors->has('resource_image'))
      <span class="help-block">
            {{ $errors->first('resource_image') }}
      </span>
    @endif
  </div>
  
  <div class="form-group {{ $errors->has('resource_desc') ? ' has-error' : '' }} " style="margin-top: 2%;">
    {!!Form::label('resource_desc','Resource Description') !!}
    {!!Form::textarea('resource_desc',null,['class'=>'form-control','placeholder'=>'Eenter Description','id'=>'resource_desc']) !!}
    @if($errors->has('resource_desc'))
      <span class="help-block">
            {{ $errors->first('resource_desc') }}
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