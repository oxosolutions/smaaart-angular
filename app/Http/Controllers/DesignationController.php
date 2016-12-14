<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Designation as DG;
use Auth;
use Session;
use DB;
class DesignationController extends Controller
{
    public function index(){

    	$plugins = [
        			'css' =>  ['datatables'],
        			'js'  =>  ['datatables','custom'=>['gen-datatables']]
        	       ];
    	return view('designations.index', $plugins);
    }

    public function indexData(){

    	$model = DG::get();

    	return Datatables::of($model)
            ->addColumn('actions',function($model){
                return view('designations._actions',['model' => $model])->render();
            })->make(true);
    }

    public function create(){

    	return view('designations.create');
    }

    public function store(Request $request){

    	$this->modelValidate($request);
    	DB::beginTransaction();
    	try{

    		$model = new DG;
	    	$model->designation = $request->designation;
	    	$model->save();
	    	DB::commit();
    	} catch(\Exception $e){

    		DB::rollback();
    		throw $e;
    	}
    	
    	Session::flash('success','Successfully created!');
        return redirect()->route('designations.list');
    }

    protected function modelValidate($request){

    	$rules = [

    			'designation' => 'required',
    	];

    	$this->validate($request, $rules);
    }

    public function edit($id){

        $model = DG::findOrFail($id);

        return view('designations.edit', ['model'=>$model]);
    }

    public function update(Request $request, $id){

        $model = DG::findOrFail($id);

        $this->modelValidate($request);

        DB::beginTransaction();
        try{

            $model->fill($request->except(['_token']));
            $model->save();
            DB::commit();
            Session::flash('success','Successfully update!');
            return redirect()->route('designations.list');
        }catch(\Exception $e){

            throw $e;
        }
    }

    public function destroy($id){

    	$model = DG::findOrFail($id);

    	try{

    		$model->delete();
    		Session::flash('success','Successfully deleted!');
    	}catch(\Exception $e){

    		throw $e;
    	}

    	return redirect()->route('designations.list');
    }
}
