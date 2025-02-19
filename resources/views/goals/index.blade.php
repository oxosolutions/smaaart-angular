@extends('layouts.main')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Goals
        <small>list of goals</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="javascript:;">Goals</a></li>
        <li class="active">List Goals</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
      @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
         <i class="icon fa fa-check"></i> 
          {{$message}}
        </div>
      @endif
      @if ($message = Session::get('error'))
        <div class="alert alert-danger bg-red-active alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-ban"></i> {{$message}}
              </div>
      @endif
      <div class="row">
        <div class="col-xs-12">
          <div class="box-header">
              <button class="btn btn-primary" onclick="window.location='{{route('goals.create')}}'">Create New Goal</button>
              <div class="dropdown" style="float: right">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
                <span class="caret"></span></button>
                <ul class="dropdown-menu">
                  <li><a href="javascript:void(0)" onclick="delAll('/goals/deleteall')" class="delGoals">Delete Goals</a></li>
                </ul>
              </div>
          </div>
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <form action="" method="">
                  <table id="goals" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th><input type="checkbox" class="icheckbox_minimal-blue selectall"></th>
                        <th>Goal Number</th>
                        <th>Goal Title</th>
                        <th>Goal Tagline</th>
                        <th>Goal Url</th>
                        <th>Goal Icon</th>
                        <th>Created By</th>
                        <th>Created At</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                      <tbody>
                        
                      </tbody>
                    <tfoot>
                      <tr>
                        <th></th>
                        <th>Goal Number</th>
                        <th>Goal Title</th>
                        <th>Goal Tagline</th>
                        <th>Goal Url</th>
                        <th>Goal Icon</th>
                        <th>Created By</th>
                        <th>Created At</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                  </table>
              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
