<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DatasetsList as DL;
use Yajra\Datatables\Datatables;
use Auth;
use Session;
use DB;
use Excel;
class DataSetsController extends Controller
{
    public function index(){

    	$plugins = [
        			'css' => ['datatables'],
        			'js'  => ['datatables','custom'=>['gen-datatables']]
    	           ];

    	return view('datasets.index',$plugins);
    }


    public function indexData(){

    	$model = DL::get();

    	return Datatables::of($model)
            ->addColumn('actions',function($model){
                return view('datasets._actions',['model' => $model])->render();
            })->editColumn('user_id',function($model){
                return ucfirst($model->userId->name);
            })->editColumn('dataset_records',function($model){
                return count(json_decode($model->dataset_records));
            })->make(true);
    }

    public function create(){

    	$plugin = [
    				'css' => ['fileupload'],
    				'js' => ['fileupload','custom'=>['dataset-create']],
    	          ];
    	return view('datasets.create',$plugin);
    }

    public function store(Request $request){

    	$this->modelValidate($request);
    	DB::beginTransaction();
    	try{

    		$path = 'datasets';
	    	$file = $request->file('dataset_file');
	    	if($file->isValid()){
	    		$filename = date('Y-m-d-H-i-s')."-".$request->file('dataset_file')->getClientOriginalName();
	    		$uploadFile = $request->file('dataset_file')->move($path, $filename);
	    		if($request->select_operation == 'new'){
	    			$this->storeInDatabase($path.'/'.$filename, $request->file('dataset_file')->getClientOriginalName());
	    		}elseif($request->select_operation == 'replace'){

	    			Session::flash('error','Not Yet Setup this');
	    			return redirect()->route('datasets.list');

	    		}elseif($request->select_operation == 'append'){

	    			Session::flash('error','Not Yet Setup this');
	    			return redirect()->route('datasets.list');
	    		}
	    	}
	    	DB::commit();
	    	Session::flash('success','Successfully upload!');
	    	return redirect()->route('datasets.list');
    	} catch(\Exception $e){

    		DB::rollback();
    		throw $e;
    	}
    	

    	Session::flash('success','Successfully created!');

        return redirect()->route('datasets.list');
    }

    function storeInDatabase($filename, $origName){

    	$FileData = [];
    	$data = Excel::load($filename, function($reader){
    	})->get();

    	foreach($data as $key => $value){
			$FileData[] = $value->all();
    	}
		$model = new DL();
		$model->dataset_name = $origName;
        $model->dataset_records = json_encode($FileData);
		$model->user_id = Auth::user()->id;
		$model->uploaded_by = Auth::user()->name;
		$model->save();

		if($model){

			return true;
		}else{

			return false;
		}
    }


    protected function modelValidate($request){

    	$rules = [
    			'dataset_file' => 'required|mimes:csv,txt,xlsx',
    			'select_operation' => 'required'
    	       ];

    	if($request->select_operation == 'append' || $request->select_operation == 'replace'){

    		$rules['dataset_list'] = 'required';
    	}

    	$this->validate($request, $rules);
    }


    public function destroy($id){

    	$model = DL::findOrFail($id);

    	try{

    		$model->delete();
    		Session::flash('success','Successfully deleted!');
    	}catch(\Exception $e){

    		throw $e;
    	}

    	return redirect()->route('datasets.list');
    }
    
}
