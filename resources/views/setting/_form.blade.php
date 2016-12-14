<div class="box-body">

<div class="form-group {{ $errors->has('user_list') ? ' has-error' : '' }}">
    {!!Form::label('role_list','Role List') !!}
    {!!Form::select('role_id', App\Role::role_list(),'select', ['placeholder' => 'Select Role','class'=>'form-control']) !!}
    @if($errors->has('role_list'))
      <span class="help-block">
            {{ $errors->first('role_list') }}
      </span>
    @endif
  </div>
 <ul>
@foreach(App\Permisson::permisson_data() as $val)


<li><label>{{$val->display_name}}</label> Read<input name ="permisson_id[{{$val->id}}][]" type="checkbox" value="read" >
 Write<input name ="permisson_id[{{$val->id}}][]" type="checkbox" value="write" >


</li>

@endforeach
</ul>

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
