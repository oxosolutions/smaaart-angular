@extends('layouts.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{App\Goal::countGoal()}}</h3>

              <p>Goals</p>
            </div>
            <div class="icon">
              <i class="fa fa-gg"></i>
            </div>
            <a href="{{url('/goals')}}" class="small-box-footer">All Goals <i class="fa fa-arrow-circle-right"></i></a>
            <a href="{{url('/goals/create')}}" class="small-box-footer">Add Goal <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{App\GoalsIntervention::countIntervention()}}
              </h3>

              <p>Interventions</p>
              </div>
              <div class="icon">
                <i class="fa fa-sun-o"></i>
              </div>
              <a href="{{url('/intervention')}}" class="small-box-footer">All Interventions<i class="fa fa-arrow-circle-right"></i></a>
              <a href="{{url('/intervention/create')}}" class="small-box-footer">Add Intervention<i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{App\DatasetsList::countDataset()}}</h3>

              <p>Datasets</p>
            </div>
            <div class="icon">
              <i class="fa fa-life-ring"></i>
            </div>
            <a href="{{url('/dataset')}}" class="small-box-footer">All Datasets <i class="fa fa-arrow-circle-right"></i></a>
              <a href="{{url('/dataset/create')}}" class="small-box-footer">Add Dataset <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{App\Visualisation::visualisationCount()}}</h3>

              <p>Visualisations</p>
            </div>
            <div class="icon">
              <i class="fa fa-arrows-h"></i>
            </div>
            <a href="{{url('/visualisation')}}" class="small-box-footer">All Visualisations <i class="fa fa-arrow-circle-right"></i></a>
            <a href="{{url('/visualisation/create')}}" class="small-box-footer">Add Visualisation <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{App\Page::countPage()}}</h3>
              <p>Pages</p>
            </div>
            <div class="icon">
              <i class="fa fa-file-o"></i>
            </div>
            <a href="{{url('/pages')}}" class="small-box-footer">All Pages <i class="fa fa-arrow-circle-right"></i></a>
              <a href="{{url('/pages/create')}}" class="small-box-footer">Add Page<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{App\User::countUser()}}</h3>

              <p>Users</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="{{url('/api_users')}}" class="small-box-footer">All Users <i class="fa fa-arrow-circle-right"></i></a>
              <a href="{{url('/api_users/create')}}" class="small-box-footer">Add User <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{App\GoalsTarget::targetCount()}}</h3>

              <p>Targets</p>
            </div>
            <div class="icon">
              <i class="fa fa-dot-circle-o"></i>
            </div>
            <a href="{{url('/target')}}" class="small-box-footer">All Targets <i class="fa fa-arrow-circle-right"></i></a>
            <a href="{{url('/target/create')}}" class="small-box-footer">Add Target <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{App\Department::deptCount()}}
              </h3>

              <p>Departments</p>
              </div>
              <div class="icon">
                <i class="fa fa-cubes"></i>
              </div>
              <a href="{{url('/departments')}}" class="small-box-footer">All Departments<i class="fa fa-arrow-circle-right"></i></a>
              <a href="{{url('/departments/create')}}" class="small-box-footer">Add Department<i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          

          <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{App\GoalsSchema::schemeCount()}}</h3>

              <p>Schemes</p>
              </div>
              <div class="icon">
                <i class="fa fa-bullseye"></i>
              </div>
              <a href="{{url('/schema')}}" class="small-box-footer">All Schemes<i class="fa fa-arrow-circle-right"></i></a>
              <a href="{{url('/schema/create')}}" class="small-box-footer">Add Scheme<i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>


        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{App\Designation::designationCount()}}</h3>

              <p>Designations</p>
            </div>
            <div class="icon">
              <i class="fa fa-child"></i>
            </div>
            <a href="{{url('/designations')}}" class="small-box-footer">All Designations <i class="fa fa-arrow-circle-right"></i></a>
              <a href="{{url('/designations/create')}}" class="small-box-footer">Add Designation<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{App\Ministrie::countMinistry()}}
              </h3>

              <p>Ministries</p>
              </div>
              <div class="icon">
                <i class="fa fa-building-o"></i>
              </div>
              <a href="{{url('/ministries')}}" class="small-box-footer">All Ministries<i class="fa fa-arrow-circle-right"></i></a>
              <a href="{{url('/ministries/create')}}" class="small-box-footer">Add Ministry<i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{App\Indicator::indicatorCount()}}</h3>

              <p>Indicators</p>
            </div>
            <div class="icon">
              <i class="fa fa-lightbulb-o"></i>
            </div>
            <a href="{{url('/indicators')}}" class="small-box-footer">All Indicators <i class="fa fa-arrow-circle-right"></i></a>
            <a href="{{url('/indicators/create')}}" class="small-box-footer">Add Indicator <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{App\GoalsResource::resourceCount()}}</h3>

              <p>Resources</p>
            </div>
            <div class="icon">
              <i class="fa fa-minus-square"></i>
            </div>
            <a href="{{url('/resource')}}" class="small-box-footer">All Resources <i class="fa fa-arrow-circle-right"></i></a>
            <a href="{{url('/resource/create')}}" class="small-box-footer">Add Resource <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3>{{App\GoalFact::countFact()}}</h3>

                <p>Facts</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <a href="{{url('/facts')}}" class="small-box-footer">All Facts <i class="fa fa-arrow-circle-right"></i></a>
                <a href="{{url('/fact_create')}}" class="small-box-footer">Add Fact <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
      </div>
      <!-- /.row -->
      <!-- Main row -->
     <!--  -->
          <!-- /.box -->

        

    </section>
    <!-- /.content -->
  </div>




 
@endsection
