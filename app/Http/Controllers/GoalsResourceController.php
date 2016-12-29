<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;
use Auth;
use Session;
use DB;
use App\GoalsResource as GR;
class GoalsResourceController extends Controller
{
    
    public function index(){

    	$plugins = [
    			'css' => ['datatables',],
    			'js' => ['datatables','custom'=>['gen-datatables']]
    	];


    	return view('resources.index',$plugins);
    }


    public function indexData(){

    	$model = GR::withUsers()->get();

    	return Datatables::of($model)
            ->addColumn('actions',function($model){
                return view('resources._actions',['model' => $model])->render();
            })->make(true);
    }

    public function create(){
    	$plugins = [

    			'css' => ['fileupload'],
    			'js' => ['fileupload','custom'=>['resource-create']]
    	];
    	return view('resources.create',$plugins);
    }

    public function store(Request $request){

    	$this->modelValidate($request);

    	DB::beginTransaction();
    	try{

    		$model = new GR($request->except(['_token']));
	    	
	    	$model->created_by = Auth::user()->id;

	    	$path = 'resource_file';

	    	if($request->hasFile('resource_image')){

                $filename = date('Y-m-d-H-i-s')."-".$request->file('resource_image')->getClientOriginalName();

                $request->file('resource_image')->move($path, $filename);

                $model->resource_image = $filename;
            }

            $model->save();
            
	    	DB::commit();
    	} catch(\Exception $e){

    		DB::rollback();
    		throw $e;
    	}
    	

    	Session::flash('success','Successfully created!');

        return redirect()->route('resource.list');
    }

    public function modelValidate($request){

    	$rules = [
    				'resource_id' => 'required|int',
    				'resource_title' => 'required',
    				'resource_desc' => 'required',
                    'resource_image'=>'required|mimes:jpeg,jpg,png',
    	         ];

    	$this->validate($request, $rules);
    }

    public function destroy($id){

        $model = GR::findOrFail($id);

        try{

            $model->delete();
            Session::flash('success','Successfully deleted!');
        }catch(\Exception $e){

            throw $e;
        }

        return redirect()->route('resource.list');
    }

    public function edit($id){
        try{
            $model = GR::findOrFail($id);
            return view('resources.edit', ['model'=>$model, 'css'=>['fileupload'],'js'=>['fileupload','custom'=>['resource-create']]]);
        }catch(\Exception $e)
        {
            Session::flash('error','No data found for this.');
            return redirect()->route('resource.list');
        }
    }

    public function update(Request $request, $id){

        $model = GR::findOrFail($id);

        $this->modelValidate($request);

        DB::beginTransaction();
        try{ 

            $model->fill($request->except(['_token']));

            if($request->hasFile('resource_image')){

                $path = 'resource_file';
                
                $filename = date('Y-m-d-H-i-s')."-".$request->file('resource_image')->getClientOriginalName();

                $request->file('resource_image')->move($path, $filename);

                $model->resource_image = $filename;
            }
            
            $model->save();
            DB::commit();
            Session::flash('success','Successfully update!');
            return redirect()->route('resource.list');
        }catch(\Exception $e){

            throw $e;
        }
    }
}
