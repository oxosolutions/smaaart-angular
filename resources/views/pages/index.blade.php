@extends('layouts.main')

@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Pages
        <small>list of pages</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="javascript:;">Pages</a></li>
        <li class="active">List Pages</li>
      </ol>
    </section>

    <section class="content">
      @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
         <i class="icon fa fa-check"></i>
          {{$message}}
        </div>
      @endif
      <div class="row">
        <div class="col-xs-12">
          <div class="box-header">
              <button class="btn btn-primary" onclick="window.location='{{route('pages.create')}}'">Create New Page</button>
          </div>
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="pages" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Page Title</th>
                  <th>Page Slug</th>
                  <th>Content</th>
                  <th width="100">Page Image</th>
                  <th>Status</th>
                  <th>Created By</th>
                  <th>Created At</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Page Title</th>
                  <th>Page Slug</th>
                  <th>Content</th>
                  <th>Page Image</th>
                  <th>Status</th>
                  <th>Created By</th>
                  <th>Created At</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
