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
            <td>{{$user_detail['name']}}
            </td>
        </tr>
        <tr>
            <td>Phone Number</td>
            <td>{{$user_detail['phone']}}
            </td>
        </tr>
        <tr>
            <td>Address</td>
            <td>{{$user_detail['address']}}
            </td>
        </tr>
        <tr>
            <td>Designation</td>
            <td>{{App\Designation::getDesignation($user_detail['designation'])}}</td>
        </tr>
        <tr>
            <td>Profile Picture</td>
            <td>
              <img src="{{asset('profile_pic/').'/'.$user_detail['profile_pic']}}" width="100px" />
            </td>
        </tr>
        <tr>
            <td>Ministries</td>
            <td>@foreach ($minDetail as $min)
                <span class="label label-info"> {{ $min->ministry_title }}</span>
              @endforeach
            </td>
        </tr>
        <tr>
            <td>Department</td>
            <td> @foreach ($depDetail as $dep)
                    <span class="label label-success"> {{ $dep->dep_name }}</span>
                @endforeach
            </td>
        </tr>
    </tbody>
  </table>
</div>
