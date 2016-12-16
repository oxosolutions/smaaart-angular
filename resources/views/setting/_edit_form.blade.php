<div class="box-body">

@if ($message = Session::get('error'))

        <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-ban"></i> {{$message}}
              </div>
       <!--  <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
         <i class="icon fa fa-check"></i> 
         
        </div> -->
      @endif

<div class="form-group {{ $errors->has('role_id') ? ' has-error' : '' }}">
    <h2>{{$role_permisson[0]->rdname}} Role</h2>
<input type="hidden" name="rid" value="{{$role_permisson[0]->rid}}" >
     <table id="example2" class="table table-bordered table-hover">
    <tbody>

    <tr>
      <th>Module </th>
      <th>Read </th>
      <th>Write </th>
      <th>Delete </th>
</tr>
       
     
 <!-- {{dump($role_permisson)}}
 {{dump(App\Permisson::permisson_data())}} -->

 
@foreach(App\Permisson::permisson_data() as $val)
<tr>
  <td>{{$val->display_name}} </td>
 @foreach($role_permisson as $permisson)
 
    @if($permisson->pid == $val->id)
         
      @if($permisson->read==true)
            <td><input checked name ="permisson_id[{{$val->id}}][]" type="checkbox" value="read" >
            </td>
          @else
          <td><input  name ="permisson_id[{{$val->id}}][]" type="checkbox" value="read" >
            </td>
        @endif
        @if($permisson->write==true)
             <td><input checked name ="permisson_id[{{$val->id}}][]" type="checkbox" value="write" ></td>
          @else
             <td><input  name ="permisson_id[{{$val->id}}][]" type="checkbox" value="write" ></td>
        @endif
        @if($permisson->delete==true)
            <td><input checked name ="permisson_id[{{$val->id}}][]" type="checkbox" value="delete" ></td>
          @else
            <td><input name ="permisson_id[{{$val->id}}][]" type="checkbox" value="delete" ></td>
        @endif
       
    @elseif($permisson->pid == null)
     
         <td><input  name ="permisson_id[{{$val->id}}][]" type="checkbox" value="read" >
           <td><input  name ="permisson_id[{{$val->id}}][]" type="checkbox" value="write" ></td>
          <td><input name ="permisson_id[{{$val->id}}][]" type="checkbox" value="delete" ></td>
    @endif

   

  @endforeach
        <!-- <td><input name ="permisson_id[{{$val->id}}][]" type="checkbox" value="write" ></td> -->
            
        </tr>

  
@endforeach
</tbody>
</table>
  </div>








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
