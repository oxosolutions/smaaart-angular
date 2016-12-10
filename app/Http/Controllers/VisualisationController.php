<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Visualisation as VS;
use Auth;
use Session;
use DB;
class VisualisationController extends Controller
{
    function index(){

    	$plugin = [

    			'css'  =>  ['datatables'],
    			'js'   =>  ['datatables','custom'=>['gen-datatables']]
    	];

    	return view('visualisation.index',$plugin);
    }

    public function indexData(){

    	$model = VS::get();

    	return Datatables::of($model)
            ->addColumn('actions',function($model){
                return view('visualisation._actions',['model' => $model])->render();
            })->editColumn('dataset_id',function($model){
                return $model->dataset->dataset_name;
            })->editColumn('created_by',function($model){
                return $model->createdBy->name;
            })->make(true);
    }

    public function create(){

    	return view('visualisation.create');
    }

    public function store(Request $request){

    	$this->modelValidate($request);

    	DB::beginTransaction();
    	try{

    		$model = new VS($request->except(['_token']));
    		$model->created_by = Auth::user()->id;
    		$model->save();
    		DB::commit();
    		Session::flash('success','Successfully created!');
    		return redirect()->route('visualisation.list');
    	}catch(\Exception $e){

    		DB::rollback();

    		throw $e;
    	}
    }


    protected function modelValidate($request){

    	$rules = [
    			'dataset_id'  => 'required',
    			'visual_name' => 'required',
    			'settings'    => 'required',
    			'options'     => 'required'
    	];

    	$this->validate($request,$rules);
    }


    public function edit($id){

    	$model = VS::findOrFail($id);

    	return view('visualisation.edit',['model'=>$model]);
    }

    public function update(Request $request, $id){

    	$model = VS::findOrFail($id);

    	$this->modelValidate($request);

    	DB::beginTransaction();

    	try{

    		$model->fill($request->except(['_token']));
    		$model->save();
    		DB::commit();
    		Session::flash('success','Successfully update!!');
    		return redirect()->route('visualisation.list');
    	}catch(\Exception $e){

    		DB::rollback();
    		throw $e;
    	}
    }

    public function destroy($id){

    	$model = VS::findOrFail($id);

    	try{

    		$model->delete();
    		Session::flash('success','Successfully deleted!');
    		return redirect()->route('visualisation.list');
    	}catch(\Exception $e){

    		throw $e;
    	}
    }
}
