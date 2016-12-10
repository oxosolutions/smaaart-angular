<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Indicator as IC;
use Auth;
use Session;
use DB;
class IndicatorsController extends Controller
{
    public function index(){

    	$plugins = [

    			'css'  => ['datatables'],
    			'js'   => ['datatables','custom'=>['gen-datatables']],
    	];

    	return view('indicators.index',$plugins);
    }

    public function indexData(){

    	$model = IC::get();
    	return Datatables::of($model)
            ->addColumn('actions',function($model){
                return view('indicators._actions',['model' => $model])->render();
            })->editColumn('created_by',function($model){
            	return $model->createdBy->name;
            })->editColumn('targets_id', function($model){
            	return $model->targets->target_title;
            })->make(true);
    }

    public function create(){

    	return view('indicators.create');
    }

    public function store(Request $request){

    	$this->modelValidate($request);

    	DB::beginTransaction();
    	try{

    		$model = new IC($request->except(['_token']));
    		$model->created_by = Auth::user()->id;
    		$model->save();
    		DB::commit();
    		Session::flash('success','Successfully created!');
    		return redirect()->route('indicators.list');
    	}catch(\Exception $e){

    		DB::rollback();
    		throw $e;
    	}
    }

    public function modelValidate($request){

    	$rules = [

    				'indicator_title'  => 'required',
    				'targets_id'       =>  'required'
    	];

    	$this->validate($request, $rules);
    }

    public function edit($id){

    	$model = IC::findOrFail($id);
    	
    	return view('indicators.edit',['model'=>$model]);
    }

    public function update(Request $request, $id){

    	$model = IC::findOrFail($id);

    	$this->modelValidate($request);

    	DB::beginTransaction();

    	try{
    		$model->fill($request->except(['_token']));
    		$model->save();
    		DB::commit();
    		Session::flash('success','Successfully updated!');
    		return redirect()->route('indicators.list');
    	}catch(\Exception $e){

    		DB::rollback();

    		throw $e;
    	}
    }

    public function destroy($id){

    	$model = IC::findOrFail($id);

    	try{

    		$model->delete();
    		Session::flash('success','Successfully deleted!');
    		return redirect()->route('indicators.list');
    	}catch(\Exception $e){

    		throw $e;
    	}
    }
}
