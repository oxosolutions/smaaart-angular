@extends('layouts.main')

@section('content')
 <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Create Department Form
        <small>Department
        </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('departments')}}">Departments</a></li>
        <li class="active">Create Department</li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Create Department</h3>
            </div>
              {!! Form::model($model, ['method' => 'PATCH','route'=>['department.update', $model->id], 'files'=>true]) !!}
                @include('departments._form')
              <div class="box-footer">
                {!! Form::submit('Save Department', ['class' => 'btn btn-primary']) !!}
              </div>
              {!! Form::close() !!}

          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
