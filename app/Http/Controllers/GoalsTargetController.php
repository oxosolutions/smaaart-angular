<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;
use Auth;
use Session;
use DB;
use App\GoalsTarget as GT;
class GoalsTargetController extends Controller
{

    public function index(){

    	$plugins = [
        			'css' => ['datatables',],
        			'js' => ['datatables','custom'=>['gen-datatables']]
    	           ];

    	return view('target.index',$plugins);
    }


    public function indexData(){

    	$model = GT::orderBy('id','desc')->withUsers()->get();

    	return Datatables::of($model)
            ->addColumn('actions',function($model){
                return view('target._actions',['model' => $model])->render();
            })->make(true);
    }

    public function create(){
    	$plugins = [

    			'css' => ['fileupload'],
    			'js' => ['fileupload','custom'=>['target-create']]
    	];
    	return view('target.create',$plugins);
    }

    public function store(Request $request){

    	$this->modelValidate($request);
    	DB::beginTransaction();
    	try{

    		$model = new GT($request->except(['_token']));

	    	$model->created_by = Auth::user()->id;

	    	$path = 'target_file';

	    	if($request->hasFile('target_image')){

                $filename = date('Y-m-d-H-i-s')."-".$request->file('target_image')->getClientOriginalName();

                $request->file('target_image')->move($path, $filename);

                $model->target_image = $filename;
            }

            $model->save();

	    	DB::commit();
    	} catch(\Exception $e){

    		DB::rollback();
    		throw $e;
    	}


    	Session::flash('success','Successfully created!');

        return redirect()->route('target.list');
    }

    public function modelValidate($request){

    	$rules = [
    				'target_id'     =>  'required|numeric',
    				'target_title'  =>  'required',
    				'target_desc'   =>  'required',
                    'target_image'  =>  'required|mimes:jpeg,jpg,png',
    	       ];

    	$this->validate($request, $rules);
    }

    public function destroy($id){

        $model = GT::findOrFail($id);

        try{

            $model->delete();
            Session::flash('success','Successfully deleted!');
        }catch(\Exception $e){

            throw $e;
        }

        return redirect()->route('target.list');
    }

    public function edit($id){
        try{
            $model = GT::findOrFail($id);
            return view('target.edit', ['model'=>$model, 'css'=>['fileupload'],'js'=>['fileupload','custom'=>['target-create']]]);
        }catch(\Exception $e)
        {
            Session::flash('error','No data found for this');
            return redirect()->route('target.list');
        }
    }

    public function update(Request $request, $id){

        $model = GT::findOrFail($id);

        $this->modelValidate($request);

        DB::beginTransaction();
        try{

            $model->fill($request->except(['_token']));

            if($request->hasFile('target_image')){

                $path = 'target_file';

                $filename = date('Y-m-d-H-i-s')."-".$request->file('target_image')->getClientOriginalName();

                $request->file('target_image')->move($path, $filename);

                $model->target_image = $filename;
            }

            $model->save();
            DB::commit();
            Session::flash('success','Successfully update!');
            return redirect()->route('target.list');
        }catch(\Exception $e){

            throw $e;
        }
    }
}
