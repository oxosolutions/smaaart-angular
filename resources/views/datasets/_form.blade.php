<div class="box-body">
  <div class="{{ $errors->has('dataset_file') ? ' has-error' : '' }} input-group input-group-sm">
    {!!Form::label('dataset_file','Select Dataset File') !!}
    {!!Form::file('dataset_file',['class'=>'form-control','id'=>'file-3']) !!} <!-- <span style="font-size: 12px;color: red;">Only CSV and Excel</span> -->
    @if($errors->has('dataset_file'))
      <span class="help-block">
            {{ $errors->first('dataset_file') }}
      </span>
    @endif
  </div>
  <br/>
  <div class="{{ $errors->has('select_operation') ? ' has-error' : '' }} form-group">
    {!!Form::label('select_operation','Select Oprtation') !!}
    {!!Form::select('select_operation',\App\DatasetsList::datasetOperations(),null, ['class'=>'form-control dataset-operation','placeholder'=>'Select dataset operation']) !!}
    @if($errors->has('select_operation'))
      <span class="help-block">
            {{ $errors->first('select_operation') }}
      </span>
    @endif
  </div>

  <div class="{{ $errors->has('dataset_list') ? ' has-error' : '' }} form-group dataset-view-hide">
    {!!Form::label('dataset_list','Select Dataset') !!}
    {!!Form::select('dataset_list',\App\DatasetsList::datasetList(),null, ['class'=>'form-control','placeholder'=>'Select dataset']) !!}
    @if($errors->has('dataset_list'))
      <span class="help-block">
            {{ $errors->first('dataset_list') }}
      </span>
    @endif
  </div>

</div>
<!-- /.box-body -->
<style type="text/css">
	
	.dataset-view-hide{
		@if(!$errors->has('dataset_list'))
			display: none;
		@endif;
	}
</style>
