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

  <div class="{{ $errors->has('with_dataset') ? ' has-error' : '' }} form-group dataset-view-hide">
    {!!Form::label('with_dataset','Select Dataset') !!}
    {!!Form::select('with_dataset',\App\DatasetsList::datasetList(),null, ['class'=>'form-control','placeholder'=>'Select dataset']) !!}
    @if($errors->has('with_dataset'))
      <span class="help-block">
            {{ $errors->first('with_dataset') }}
      </span>
    @endif
  </div>

</div>
<style type="text/css">
.dataset-view-hide{
	@if(!$errors->has('with_dataset'))
		display: none;
	@endif;
}
</style>
