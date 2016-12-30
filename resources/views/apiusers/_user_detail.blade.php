<style type="text/css">
.label{
  font-size: 100%;
  font-weight: 600;
}
</style>
<div class="box-body">

  <table id="example2" class="table table-bordered table-hover">
    <tbody>
     <tr>
            <td>User name</td>
            <td>{{$user_detail->name}}
            </td>
        </tr>
         <tr>
            <td>Email</td>
            <td>{{$user_detail->email}}
            </td>
        </tr>
       @foreach($user_detail->meta as  $value )
        <tr>
             @if($value->key == 'profile_pic')
                    <td>{{ucfirst(str_replace("_" ," ", $value->key))}}</td>
                    <td>
                            <img src="{{asset('profile_pic/').'/'.$value->value}}" width="100px" />
                    </td>
                    @elseif($value->key == 'designation')
                        @if(App\Designation::getDesignation($value->value)!=false)
                            <td>{{$value->key}}</td>
                            <td>{{App\Designation::getDesignation($value->value)}}</td>
                         @endif                  
                    @elseif($value->key == 'ministry')
                        <?php $json = json_decode($value->value);?>
                        @if(App\Ministrie::ministryName($json[0])!=false)
                            <td>{{$value->key}}</td>
                             <td>
                               {{App\Ministrie::ministryName($json[0])}}
                             </td>
                        @endif
                    @elseif($value->key == 'department')
                        <?php $dep = json_decode($value->value);  ?>
                            @if(App\Department::getDepName($dep[0])!=false)
                                
                                    <td>{{$value->key}}</td>
                                    <td>
                                        {{App\Department::getDepName($dep[0])}}
                                    </td>
                                
                            @endif
                    @else
                     <td>{{$value->key}}</td>
                     <td>{{$value->value}}</td>
                   @endif        
                    
        </tr>
        @endforeach
    </tbody>
  </table>
</div>
