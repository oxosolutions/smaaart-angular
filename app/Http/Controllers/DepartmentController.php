<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department as DP;
use Yajra\Datatables\Datatables;
use Auth;
use Session;
use DB;
class DepartmentController extends Controller
{
    public function index(){

    	$plugins = [

    			'css' => ['datatables'],
    			'js'  => ['datatables','custom'=>['gen-datatables']]
    	];

    	return view('departments.index',$plugins);
    }


    public function get_departments(){

    	$model = DP::withUsers()->get();

    	return Datatables::of($model)
            ->addColumn('actions',function($model){
                return view('departments._actions',['model' => $model])->render();
            })->make(true);
    }

    public function create(){

    	return view('departments.create');
    }

    public function store(Request $request){

    	$this->modelValidate($request);
    	DB::beginTransaction();
    	try{

    		$model = new DP;
	    	$model->dep_code = $request->dep_code;
	    	$model->dep_name = $request->dep_name;
	    	$model->created_by = Auth::user()->id;
	    	$model->save();
	    	DB::commit();
    	} catch(\Exception $e){

    		DB::rollback();
    		throw $e;
    	}
    	

    	Session::flash('success','Successfully created!');

        return redirect()->route('department.list');
    }


    protected function modelValidate($request){

    	$rules = [

    			'dep_code' => 'required|regex:/^[A-Z a-z 0-9]+$/|min:3',
    			'dep_name' => 'required|min:3'
    	];

    	$this->validate($request, $rules);
    }


    public function destroy($id){

    	$model = DP::findOrFail($id);

    	try{

    		$model->delete();
    		Session::flash('success','Successfully deleted!');
    	}catch(\Exception $e){

    		throw $e;
    	}

    	return redirect()->route('department.list');
    }
    
    public function edit($id){

        $model = DP::findOrFail($id);

        return view('departments.edit', ['model'=>$model]);
    }

    public function update(Request $request, $id){

        $model = DP::findOrFail($id);

        $this->modelValidate($request);

        DB::beginTransaction();
        try{

            $model->fill($request->except(['_token']));
            $model->save();
            DB::commit();
            Session::flash('success','Successfully update!');
            return redirect()->route('department.list');
        }catch(\Exception $e){

            throw $e;
        }
    }
}
