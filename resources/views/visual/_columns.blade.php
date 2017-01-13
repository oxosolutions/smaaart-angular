<div class="form-group {{ $errors->has('columns') ? ' has-error' : '' }}">
	{!!Form::label('filter_cols','Select Columns For Filter') !!}
	{!!Form::select('filter_cols[]',$columns,@$prefilledFilter, ['class'=>'form-control select2','multiple']) !!}
	@if($errors->has('filter_cols'))
	  <span class="help-block">
	        {{ $errors->first('filter_cols') }}
	  </span>
	@endif
</div>

<div id="visualCharts" class="panel panel-primary">
	<div class="panel-heading">Add Visual Columns</div>
	<div class="panel-body">
		<div class="form-group {{ $errors->has('columns') ? ' has-error' : '' }}">
			{!!Form::label('columns','Select Columns') !!}
			{!!Form::select('columns[]',$columns,@$preFilled, ['class'=>'form-control select2','multiple']) !!}
			@if($errors->has('columns'))
			  <span class="help-block">
			        {{ $errors->first('columns') }}
			  </span>
			@endif
		</div>

		<div class="form-group {{ $errors->has('visual_name') ? ' has-error' : '' }}" style="margin-top: 2%;">
		    {!!Form::label('visual_settings','Visual Settings') !!}
		    {!!Form::textarea('visual_settings',null, ['class'=>'form-control','placeholder'=>'Enter Visual Settings']) !!}
		    @if($errors->has('visual_settings'))
		      <span class="help-block">
		            {{ $errors->first('visual_settings') }}
		      </span>
		    @endif
		</div>
		<button class="btn btn-primary">Add More</button>
	</div>
</div>


<style type="text/css">
	.select2-selection__choice{

	      background-color: #3c8dbc !important;
	  }
  .select2-selection__choice__remove{

      color: #FFF !important;
  }
</style>