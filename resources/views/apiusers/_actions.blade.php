@if($model->approved ==1)
	<a href="{{route('apiuser.unapproved',$model->id)}}">un-approved</a> | 
@else
<a href="{{route('apiuser.approved',$model->id)}}">approved</a> | 
@endif
<a href="{{route('apiuser.editmeta',$model->id)}}">Edit User meta</a> | 
<a href="{{route('api.edit_users',$model->id)}}"><span class="fa fa-edit"></span></a> | 
<a href="{{route('api.user_detail',$model->id) }}"><span class="fa fa-eye" style="color: green;"></span></a> |
<a href=""><span class="fa fa-trash" style="color: red"></span></a>
