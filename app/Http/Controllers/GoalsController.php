<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Session;
use DB;
use Auth;
use App\Goal;
class GoalsController extends Controller
{
    public function index(){

    	$plugins = [

    			'css' => ['datatables'],
    			'js'  => ['datatables', 'custom' => ['gen-datatables']]
    	];

    	return view('goals.index', $plugins);
    }

    public function goalsList(){

    	$model = Goal::WithUsers()->get();

    	return Datatables::of($model)
    		   ->addColumn('actions', function($model){
    		   		return view('goals._actions', ['model'=>$model])->render();
    		   })->make(true);
    }

    public function create(){

    	$plugins = [

    			'css' => ['select2'],
    			'js' => ['select2','custom'=>['goals-create']]
    	];

    	return view('goals.create',$plugins);
    }

    public function store(Request $request){

        $this->modelValidate($request);

        
    }


    protected function modelValidate($request){

        $rules = [

                'goal_number' => 'required|regex:/^[0-9]+$/',
                'goal_title'  => 'required',
                'goal_tagline' => 'required',
                'goal_description' => 'required',
                'goal_url'  =>  'required',
                'goal_icon' =>  'required',
                'goal_icon_url' => 'required',
                'goal_color' => 'required',
                'goal_nodal_ministry' => 'required',
                'goal_other_ministries' => 'required',
                'goal_schemes' => 'required',
                'goal_interventions' => 'required'
        ];

        $this->validate($request, $rules);
    }

}
