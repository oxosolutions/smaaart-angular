@extends('layouts.main')

@section('content')
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Create Scheme Form
        <small>Scheme
        </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('schema')}}">Schemes</a></li>
        <li class="active">Create Scheme</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Create Scheme</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              {!! Form::model($model, ['method' => 'PATCH','route'=>['schema.update', $model->id], 'files'=>true]) !!}
                @include('schemas._form')
              <div class="box-footer">
                {!! Form::submit('Save Schema', ['class' => 'btn btn-primary']) !!}
              </div>
              {!! Form::close() !!}

          </div>
          <!-- /.box -->

               

        </div>
        <!--/.col (left) -->
        
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
@endsection