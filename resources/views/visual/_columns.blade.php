<div class="form-group {{ $errors->has('columns') ? ' has-error' : '' }}">
	{!!Form::label('columns','Select Columns') !!}
	{!!Form::select('columns[]',$columns,@$preFilled, ['class'=>'form-control select2','multiple']) !!}
	@if($errors->has('columns'))
	  <span class="help-block">
	        {{ $errors->first('columns') }}
	  </span>
	@endif
</div>

<div class="form-group {{ $errors->has('columns') ? ' has-error' : '' }}">
	{!!Form::label('filter_cols','Select Columns For Filter') !!}
	{!!Form::select('filter_cols[]',$columns,@$prefilledFilter, ['class'=>'form-control select2','multiple']) !!}
	@if($errors->has('filter_cols'))
	  <span class="help-block">
	        {{ $errors->first('filter_cols') }}
	  </span>
	@endif
</div>
<style type="text/css">
	.select2-selection__choice{

	      background-color: #3c8dbc !important;
	  }
  .select2-selection__choice__remove{

      color: #FFF !important;
  }
</style>