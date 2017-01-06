@extends('layouts.main')

@section('content')
<style type="text/css">
  ul li{
    list-style: none
  }
</style>
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

    <div class="row">
    <div class="row">
         {!! Form::open(['route' => 'log.search', 'files'=>true]) !!}

                <div class="col-xs-2">
                  <input type="text" name="user_name" class="form-control" placeholder="User Name">
                </div>
                <div class="col-xs-2">
                  <input type="text" name="from" class="form-control" placeholder="From Date">
                </div>
                <div class="col-xs-2">
                  <input type="text" name="to" class="form-control" placeholder="End  Date">
                </div>
              </div>
              <div class="col-xs-2">
                  {!! Form::submit('Search', ['class' => 'btn btn-primary']) !!}
               </div>
{!! Form::close() !!}
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Responsive Hover Table</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control " placeholder="Search">
                

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>Time</th>
                  <th>User</th>
                  <th>Route/Query</th>
               </tr>
                
                 @foreach($log as $value)
                  <tr>
                 <td>{{$value->created_at}}</td>
                <td>{{$value->user_id}}</td>
                    
                    <?php $text = json_decode($value->text, true); ?>
                    @if(array_key_exists('query', $text))
                
                          <td>{{$text['query']}}</td>
                        @else
                          <td> 
                              @if($text['route']=="/")

                              View  Dashboard
                              @else

                              {{$text['route']}}
                              @endif
                              </td>
                      @endif
                   </tr>
                    @endforeach
                    
                 
                 
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
         
    </section>

  </div>
@endsection
