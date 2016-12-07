<div class="box-body">
  <div class="form-group {{ $errors->has('intervention_id') ? ' has-error' : '' }}">
    {!!Form::label('intervention_id','Intervention ID') !!}
    {!!Form::text('intervent_id',null, ['class'=>'form-control','placeholder'=>'Enter Intervention ID']) !!}
    @if($errors->has('intervention_id'))
      <span class="help-block">
            {{ $errors->first('intervention_id') }}
      </span>
    @endif
  </div>

  <div class="form-group {{ $errors->has('intervention_title') ? ' has-error' : '' }}">
    {!!Form::label('intervention_title','Intervention Title') !!}
    {!!Form::text('intervent_title',null, ['class'=>'form-control','placeholder'=>'Enter Intervention Title']) !!}
    @if($errors->has('intervention_title'))
      <span class="help-block">
            {{ $errors->first('intervention_title') }}
      </span>
    @endif
  </div>

  @if(@$model)
    <div class="input-group input-group-sm">
      {!!Form::label('intervent_image','Current Image') !!}<br/>
      <img src="{{asset('intervention_file/').'/'.$model->intervent_image}}" width="160px" />
    </div><br/>
  @endif

    
  <div class="{{ $errors->has('intervention_image') ? ' has-error' : '' }} input-group input-group-sm">
    {!!Form::label('intervention_image','Intervention Image') !!}
    {!!Form::file('intervent_image',['class'=>'form-control','id'=>'file-3']) !!}
    @if($errors->has('intervention_image'))
      <span class="help-block">
            {{ $errors->first('Intervention_image') }}
      </span>
    @endif
  </div>
  
  <div class="form-group {{ $errors->has('intervention_desc') ? ' has-error' : '' }} " style="margin-top: 2%;">
    {!!Form::label('intervention_desc','Intervention Description') !!}
    {!!Form::textarea('intervent_desc',null,['class'=>'form-control','placeholder'=>'Eenter Description','id'=>'intervention_desc']) !!}
    @if($errors->has('intervention_desc'))
      <span class="help-block">
            {{ $errors->first('intervention_desc') }}
      </span>
    @endif
  </div>


</div>
<!-- /.box-body -->
