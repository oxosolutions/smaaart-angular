<div class="box-body">
  <div class="form-group {{ $errors->has('schema_id') ? ' has-error' : '' }}">
    {!!Form::label('schema_id','Schema ID') !!}
    {!!Form::text('schema_id',null, ['class'=>'form-control','placeholder'=>'Enter Schema ID']) !!}
    @if($errors->has('schema_id'))
      <span class="help-block">
            {{ $errors->first('schema_id') }}
      </span>
    @endif
  </div>

  <div class="form-group {{ $errors->has('schema_title') ? ' has-error' : '' }}">
    {!!Form::label('schema_title','Schema Title') !!}
    {!!Form::text('schema_title',null, ['class'=>'form-control','placeholder'=>'Enter Schema Title']) !!}
    @if($errors->has('schema_title'))
      <span class="help-block">
            {{ $errors->first('schema_title') }}
      </span>
    @endif
  </div>

  @if(!empty(@$model))
    <div class="input-group input-group-sm">
      {!!Form::label('schema_image','Current Image') !!}<br/>
      <img src="{{asset('schema_file/').'/'.$model->schema_image}}" width="160px" />
    </div><br/>
  @endif

  <div class="{{ $errors->has('schema_image') ? ' has-error' : '' }} input-group input-group-sm">
    {!!Form::label('schema_image','Schema Image') !!}
    {!!Form::file('schema_image',['class'=>'form-control','id'=>'file-3']) !!}
    @if($errors->has('schema_image'))
      <span class="help-block">
            {{ $errors->first('schema_image') }}
      </span>
    @endif
  </div>

  <div class="form-group {{ $errors->has('schema_desc') ? ' has-error' : '' }} " style="margin-top: 2%;">
    {!!Form::label('schema_desc','Schema Description') !!}
    {!!Form::textarea('schema_desc',null,['class'=>'form-control','placeholder'=>'Eenter Description','id'=>'schema_desc']) !!}
    @if($errors->has('schema_desc'))
      <span class="help-block">
            {{ $errors->first('schema_desc') }}
      </span>
    @endif
  </div>
  <div class="form-group {{ $errors->has('schema_content') ? ' has-error' : '' }} " style="margin-top: 2%;">
    {!!Form::label('schema_content','Schema Content') !!}
    {!!Form::textarea('schema_content',null,['class'=>'form-control','placeholder'=>'Eenter Content','id'=>'schema_content']) !!}
    @if($errors->has('schema_content'))
      <span class="help-block">
            {{ $errors->first('schema_content') }}
      </span>
    @endif
  </div>


</div>
<!-- /.box-body -->
