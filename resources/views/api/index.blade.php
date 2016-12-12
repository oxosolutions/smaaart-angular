@extends('layouts.main')

<style type="text/css">
  .api_param li{
    list-style: none;
    padding:5px;
  }
  .api_param .params{
    width: 200px;
  }
</style>
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        API Config
        <small>Config panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">API Config</li>
      </ol>
    </section>
    <input type="hidden" value="{{Auth::user()->api_token}}" name="token_user" />
    <section class="content">
      <div class="row" style="margin-top: 10px;">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title"><i class="fa fa-code"></i> User Register</h3>
              </div>
              <div class="box-body">
                <p>
                  <code>
                    API: {{url('/')}}/api/v1/register
                  </code>
                  <!-- &nbsp;<a href="javascript:;" style="font-size: 11px;" class="put-token">Put Token</a> -->
                </p>
                <p>
                  <code>
                    Method: POST
                  </code>
                </p>
                Params:
                <code>
                  <ul class="api_param well ">
                    <li><spam class="col-md-2 col-sm-4 col-xs-6">name </spam> <span class="label label-danger">Required</span></li>
                    <li><spam class="col-md-2 col-sm-4 col-xs-6">email </spam> <span class="label label-danger">Required</span></li>
                    <li><spam class="col-md-2 col-sm-4 col-xs-6">password </spam> <span class="label label-danger">Required</span></li>
                  </ul>
                </code>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
      </div>

      <div class="row" style="margin-top: 10px;">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title"><i class="fa fa-code"></i> Dataset Import API</h3>
              </div>
              <div class="box-body">
                <p>
                  <code>
                    API: {{url('/')}}/api/v1/dataset/import?api_token=YOUR_UNIQUE_USER_TOKEN
                  </code>
                  &nbsp;<a href="javascript:;" style="font-size: 11px;" class="put-token">Put Token</a>
                </p>
                <p>
                  <code>
                    Method: POST
                  </code>
                </p>
                Params:
                <code>
                  <ul class="api_param well ">
                    <li><spam class="col-md-2 col-sm-4 col-xs-6">file </spam> <span class="label label-danger">Required</span></li>
                    <li><spam class="col-md-2 col-sm-4 col-xs-6">format </spam> <span class="label label-danger">Required</span></li>
                    <li><spam class="col-md-2 col-sm-4 col-xs-6">add_replace </spam> <span class="label label-danger">Required</span></li>
                    <li><spam class="col-md-2 col-sm-4 col-xs-6">with_dataset </spam> <span class="label label-success">Optional</span></li>
                  </ul>
                </code>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
      </div>

      <div class="row" style="margin-top: 10px;">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title"><i class="fa fa-code"></i> List Dataset API</h3>
              </div>
              <div class="box-body">
                <p>
                  <code>
                    API: {{url('/')}}/api/v1/dataset/list?api_token=YOUR_UNIQUE_USER_TOKEN
                  </code>
                  &nbsp;<a href="javascript:;" style="font-size: 11px;" class="put-token">Put Token</a>
                </p>
                <p>
                  <code>
                    Method: GET
                  </code>
                </p>
                Params:
                <code>
                  none
                </code>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
      </div>

      <div class="row" style="margin-top: 10px;">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title"><i class="fa fa-code"></i> Single Dataset API</h3>
              </div>
              <div class="box-body">
                <p>
                  <code>
                    API: {{url('/')}}/api/v1/dataset/view/{id}?api_token=YOUR_UNIQUE_USER_TOKEN
                  </code>
                  &nbsp;<a href="javascript:;" style="font-size: 11px;" class="put-token">Put Token</a>
                </p>
                <p>
                  <code>
                    Method: GET
                  </code>
                </p>
                Params:
                <code>
                  <ul class="api_param well ">
                    <li><spam class="col-md-2">id </spam> <span class="label label-danger">Required</span></li>
                  </ul>
                </code>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
      </div>

      <div class="row" style="margin-top: 10px;">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title"><i class="fa fa-code"></i> All Departments API</h3>
              </div>
              <div class="box-body">
                <p>
                  <code>
                    API: {{url('/')}}/api/v1/department/list?api_token=YOUR_UNIQUE_USER_TOKEN
                  </code>
                  &nbsp;<a href="javascript:;" style="font-size: 11px;" class="put-token">Put Token</a>
                </p>
                <p>
                  <code>
                    Method: GET
                  </code>
                </p>
                Params:
                <code>
                  none
                </code>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
      </div>

      <div class="row" style="margin-top: 10px;">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title"><i class="fa fa-code"></i> Single Department API</h3>
              </div>
              <div class="box-body">
                <p>
                  <code>
                    API: {{url('/')}}/api/v1/department/{id}?api_token=YOUR_UNIQUE_USER_TOKEN
                  </code>
                  &nbsp;<a href="javascript:;" style="font-size: 11px;" class="put-token">Put Token</a>
                </p>
                <p>
                  <code>
                    Method: GET
                  </code>
                </p>
                Params:
                <code>
                  <ul class="api_param well ">
                    <li><spam class="col-md-2">id </spam> <span class="label label-danger">Required</span></li>
                  </ul>
                </code>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
      </div>

      <div class="row" style="margin-top: 10px;">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title"><i class="fa fa-code"></i> Ministry List API</h3>
              </div>
              <div class="box-body">
                <p>
                  <code>
                    API: {{url('/')}}/api/v1/ministry/list?api_token=YOUR_UNIQUE_USER_TOKEN
                  </code>
                  &nbsp;<a href="javascript:;" style="font-size: 11px;" class="put-token">Put Token</a>
                </p>
                <p>
                  <code>
                    Method: GET
                  </code>
                </p>
                Params:
                <code>
                  none
                </code>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
      </div>


      <div class="row" style="margin-top: 10px;">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title"><i class="fa fa-code"></i> Single Ministry API</h3>
              </div>
              <div class="box-body">
                <p>
                  <code>
                    API: {{url('/')}}/api/v1/ministry/{id}?api_token=YOUR_UNIQUE_USER_TOKEN
                  </code>
                  &nbsp;<a href="javascript:;" style="font-size: 11px;" class="put-token">Put Token</a>
                </p>
                <p>
                  <code>
                    Method: GET
                  </code>
                </p>
                Params:
                <code>
                  <ul class="api_param well ">
                    <li><spam class="col-md-2">id </spam> <span class="label label-danger">Required</span></li>
                  </ul>
                </code>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
      </div>

      <div class="row" style="margin-top: 10px;">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title"><i class="fa fa-code"></i> Goals List API</h3>
              </div>
              <div class="box-body">
                <p>
                  <code>
                    API: {{url('/')}}/api/v1/goals/list?api_token=YOUR_UNIQUE_USER_TOKEN
                  </code>
                  &nbsp;<a href="javascript:;" style="font-size: 11px;" class="put-token">Put Token</a>
                </p>
                <p>
                  <code>
                    Method: GET
                  </code>
                </p>
                Params:
                <code>
                  none
                </code>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
      </div>

      <div class="row" style="margin-top: 10px;">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title"><i class="fa fa-code"></i> Single Goal API</h3>
              </div>
              <div class="box-body">
                <p>
                  <code>
                    API: {{url('/')}}/api/v1/goals/{id}?api_token=YOUR_UNIQUE_USER_TOKEN
                  </code>
                  &nbsp;<a href="javascript:;" style="font-size: 11px;" class="put-token">Put Token</a>
                </p>
                <p>
                  <code>
                    Method: GET
                  </code>
                </p>
                Params:
                <code>
                  <ul class="api_param well ">
                    <li><spam class="col-md-2">id </spam> <span class="label label-danger">Required</span></li>
                  </ul>
                </code>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
      </div>

      <div class="row" style="margin-top: 10px;">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title"><i class="fa fa-code"></i> All Users List API</h3>
              </div>
              <div class="box-body">
                <p>
                  <code>
                    API: {{url('/')}}/api/v1/users?api_token=YOUR_UNIQUE_USER_TOKEN
                  </code>
                  &nbsp;<a href="javascript:;" style="font-size: 11px;" class="put-token">Put Token</a>
                </p>
                <p>
                  <code>
                    Method: GET
                  </code>
                </p>
                Params:
                <code>
                  none
                </code>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
      </div>

      <div class="row" style="margin-top: 10px;">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title"><i class="fa fa-code"></i> Export Single Dataset API</h3>
              </div>
              <div class="box-body">
                <p>
                  <code>
                    API: {{url('/')}}/api/v1/dataset/export/{id}?api_token=YOUR_UNIQUE_USER_TOKEN
                  </code>
                  &nbsp;<a href="javascript:;" style="font-size: 11px;" class="put-token">Put Token</a>
                </p>
                <p>
                  <code>
                    Method: GET
                  </code>
                </p>
                Params:
                <code>
                  <ul class="api_param well ">
                    <li><spam class="col-md-2">id </spam> <span class="label label-danger">Required</span></li>
                  </ul>
                </code>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
      </div>

      <div class="row" style="margin-top: 10px;">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title"><i class="fa fa-code"></i> Download Exported File API</h3>
              </div>
              <div class="box-body">
                <p>
                  <code>
                    API: {{url('/')}}/api/v1/dataset/download/{fileName}?api_token=YOUR_UNIQUE_USER_TOKEN
                  </code>
                  &nbsp;<a href="javascript:;" style="font-size: 11px;" class="put-token">Put Token</a>
                </p>
                <p>
                  <code>
                    Method: GET
                  </code>
                </p>
                Params:
                <code>
                  <ul class="api_param well ">
                    <li><spam class="col-md-2">filename </spam> <span class="label label-danger">Required</span></li>
                  </ul>
                </code>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
      </div>

      <div class="row" style="margin-top: 10px;">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title"><i class="fa fa-code"></i> Get Goal By <code>goal_number</code> API</h3>
              </div>
              <div class="box-body">
                <p>
                  <code>
                    API: {{url('/')}}/api/v1/goalData/{goal_number}?api_token=YOUR_UNIQUE_USER_TOKEN
                  </code>
                  &nbsp;<a href="javascript:;" style="font-size: 11px;" class="put-token">Put Token</a>
                </p>
                <p>
                  <code>
                    Method: GET
                  </code>
                </p>
                Params:
                <code>
                  <ul class="api_param well ">
                    <li><spam class="col-md-2">goal_number </spam> <span class="label label-danger">Required</span></li>
                  </ul>
                </code>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
      </div>

      <div class="row" style="margin-top: 10px;">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title"><i class="fa fa-code"></i> Get All Schems API</h3>
              </div>
              <div class="box-body">
                <p>
                  <code>
                    API: {{url('/')}}/api/v1/schema?api_token=YOUR_UNIQUE_USER_TOKEN
                  </code>
                  &nbsp;<a href="javascript:;" style="font-size: 11px;" class="put-token">Put Token</a>
                </p>
                <p>
                  <code>
                    Method: GET
                  </code>
                </p>
                Params:
                <code>
                  none
                </code>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
      </div>

      <div class="row" style="margin-top: 10px;">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title"><i class="fa fa-code"></i> Get All Schems API</h3>
              </div>
              <div class="box-body">
                <p>
                  <code>
                    API: {{url('/')}}/api/v1/schema?api_token=YOUR_UNIQUE_USER_TOKEN
                  </code>
                  &nbsp;<a href="javascript:;" style="font-size: 11px;" class="put-token">Put Token</a>
                </p>
                <p>
                  <code>
                    Method: GET
                  </code>
                </p>
                Params:
                <code>
                  none
                </code>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
      </div>
      
      <div class="row" style="margin-top: 10px;">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title"><i class="fa fa-code"></i> Get All Visual list API</h3>
              </div>
              <div class="box-body">
                <p>
                  <code>
                    API: {{url('/')}}/api/v1/visual/list?api_token=YOUR_UNIQUE_USER_TOKEN
                  </code>
                  &nbsp;<a href="javascript:;" style="font-size: 11px;" class="put-token">Put Token</a>
                </p>
                <p>
                  <code>
                    Method: GET
                  </code>
                </p>
                Params:
                <code>
                  none
                </code>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
      </div>

      <div class="row" style="margin-top: 10px;">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title"><i class="fa fa-code"></i> Get Visual Data By ID API</h3>
              </div>
              <div class="box-body">
                <p>
                  <code>
                    API: {{url('/')}}/api/v1/visual/{id}?api_token=YOUR_UNIQUE_USER_TOKEN
                  </code>
                  &nbsp;<a href="javascript:;" style="font-size: 11px;" class="put-token">Put Token</a>
                </p>
                <p>
                  <code>
                    Method: GET
                  </code>
                </p>
                Params:
                <code>
                  <ul class="api_param well ">
                    <li><spam class="col-md-2 col-sm-4 col-xs-6">id </spam> <span class="label label-danger">Required</span></li>
                  </ul>
                </code>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
      </div>

      <div class="row" style="margin-top: 10px;">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title"><i class="fa fa-code"></i> Store Visual</h3>
              </div>
              <div class="box-body">
                <p>
                  <code>
                    API: {{url('/')}}/api/v1/store/visual?api_token=YOUR_UNIQUE_USER_TOKEN
                  </code>
                  &nbsp;<a href="javascript:;" style="font-size: 11px;" class="put-token">Put Token</a>
                </p>
                <p>
                  <code>
                    Method: POST
                  </code>
                </p>
                Params:
                <code>
                  <ul class="api_param well ">
                    <li><spam class="col-md-2 col-sm-4 col-xs-6">dataset </spam> <span class="label label-danger">Required</span></li>
                    <li><spam class="col-md-2 col-sm-4 col-xs-6">visual_name </spam> <span class="label label-danger">Required</span></li>
                  </ul>
                </code>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
      </div>
      <div class="row" style="margin-top: 10px;">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title"><i class="fa fa-code"></i> All Indicators</h3>
              </div>
              <div class="box-body">
                <p>
                  <code>
                    API: {{url('/')}}/api/v1/indicators?api_token=YOUR_UNIQUE_USER_TOKEN
                  </code>
                  &nbsp;<a href="javascript:;" style="font-size: 11px;" class="put-token">Put Token</a>
                </p>
                <p>
                  <code>
                    Method: GET
                  </code>
                </p>
                Params:
                <code>
                  none
                </code>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
      </div>

        <!-- /.row -->
    </section>
  </div>
@endsection