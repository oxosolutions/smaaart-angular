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
        ini_set('memory_limit', '-1');
    	$plugins = [
        			'css' => ['datatables'],
        			'js'  => ['datatables','custom'=>['gen-datatables']]
    	           ];

    	return view('datasets.index',$plugins);
    }


    public function indexData(){
        ini_set('memory_limit', '-1');
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

        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 3600);
    	$this->modelValidate($request);
    	DB::beginTransaction();
    	try{

    		$path = 'datasets';
	    	$file = $request->file('dataset_file');
	    	if($file->isValid()){
	    		$filename = date('Y-m-d-H-i-s')."-".$request->file('dataset_file')->getClientOriginalName();
	    		$uploadFile = $request->file('dataset_file')->move($path, $filename);
                $filePath = $path.'/'.$filename;
	    		if($request->select_operation == 'new'){
	    			$this->storeInDatabase($path.'/'.$filename, $request->file('dataset_file')->getClientOriginalName());
	    		}elseif($request->select_operation == 'replace'){
                    
                    
                $result = $this->replaceDataset($request, $request->file('dataset_file')->getClientOriginalName(), $filePath);

	    			// Session::flash('error','Not Yet Setup this');
	    			// return redirect()->route('datasets.list');

	    		}elseif($request->select_operation == 'append'){

                        $result = $this->appendDataset($request, $filePath);

	    			// Session::flash('error','Not Yet Setup this');
	    			// return redirect()->route('datasets.list');
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

     protected function appendDataset($request, $filename){
        ini_set('memory_limit', '2048M');
        $model = DL::find($request->with_dataset);
        dd($model->dataset_records);
        $sameColumnValidate = true;
        $FileData = [];
        $oldData = [];

        foreach(json_decode($model->dataset_records) as $key => $value){
            $FileData[] = $value;
            $oldData[] = $value;
        }
        $oldColumnsCounts = $FileData[0];
        $data = Excel::load($filename, function($reader){ })->get();
        $newData = [];
        foreach($data as $key => $value){
            $FileData[] = $value->all();
            $newData[] = $value->all();
        }
        $index = 0;
        foreach($newData[0] as $key => $value){

            if(!array_key_exists($key, $oldData[0])){
                $sameColumnValidate = false;
            }
        }
        $newColumnsCount = $FileData[0];
        if($newColumnsCount != $oldColumnsCounts){
            return ['status'=>'false','message'=>'Number of columns are not match with current dataset!'];
        }
        if($sameColumnValidate != true){
            return ['status'=>'false','message'=>'Column names not match with current dataset!'];
        }
        $model->dataset_records = json_encode($FileData);
        $model->dataset_columns = null;
        $model->validated = 0;
        $model->save();
        return ['status'=>'true','message'=>'Dataset updated successfully!!', 'id'=>$model->id];
    }

     protected function replaceDataset($request, $origName, $filename){

        ini_set('memory_limit', '2048M');
        $FileData = [];
        $data = Excel::load($filename, function($reader){ })->get();

       
        foreach($data as $key => $value){
            $FileData[] = $value->all();
        }
        $model = DL::find($request->dataset_list);
        $model->dataset_name = $origName;
        $model->dataset_records = json_encode($FileData);
        $model->user_id = Auth::user()->id;
        $model->uploaded_by = Auth::user()->name;
        $model->dataset_columns = null;
        $model->validated = 0;
        $model->save();

        if($model){
            return ['status'=>'true','id'=>$model->id,'message'=>'Dataset replaced successfully!'];
        }else{
            return ['status'=>'false','message'=>'unable to replace dataset!'];
        }
    }

protected function storeInDatabase($filename, $origName){
        ini_set('memory_limit', '2048M');
        $FileData = [];
        $data = Excel::load($filename, function($reader){ })->get();

        /*foreach($data as $key => $value){
            $FileData[] = $value->all();
        }*/
        dd($data);
        $model = new DL();
        $model->dataset_name = $origName;
        $model->dataset_records = json_encode($FileData);
        $model->user_id = Auth::user()->id;
        $model->uploaded_by = Auth::user()->name;
        $model->save();

        if($model){
            return ['status'=>'true','id'=>$model->id,'message'=>'Dataset upload successfully!'];
        }else{
            return ['status'=>'false','id'=>'','message'=>'unable to upload datsaet!'];
        }
    }

  //   function storeInDatabase($filename, $origName){
  //       ini_set('memory_limit', '-1');
  //   	$FileData = [];
  //   	$data = Excel::load($filename, function($reader){
  //   	})->get();

  //   	foreach($data as $key => $value){
		// 	$FileData[] = $value->all();
  //   	}
		// $model = new DL();
		// $model->dataset_name = $origName;
  //       $model->dataset_records = json_encode($FileData);
		// $model->user_id = Auth::user()->id;
		// $model->uploaded_by = Auth::user()->name;
		// $model->save();

		// if($model){

		// 	return true;
		// }else{

		// 	return false;
		// }
  //   }


    protected function modelValidate($request){


        $errors = [];
        if($request->file('file') == '' || empty($request->file('file')) || $request->file('file') == null){
            $errors['file'] = 'File field should not empty!';
        }
         if($request->format == 'undefined' || empty($request->format) || $request->format  == null){
             $errors['format'] = 'Please select file format';
         }

        if($request->add_replace == 'undefined' || empty($request->add_replace) || $request->add_replace  == null){
            $errors['add_replace'] = 'Please select file format!';
        }
        if($request->add_replace == 'replace' || $request->add_replace == 'append'){
            if($request->with_dataset == '' || $request->with_dataset == 'undefined' || empty($request->with_dataset)){
                $errors['dataset'] = 'Please select dataset to '.$request->add_replace;
           }
        }
        if(count($errors) >= 1){
            $return = ['status' => 'false','error'=>$errors];
            return $return;
        }else{
            $return = ['status' => 'true','error'];
            return $return;
        }

    	// $rules = [
    	// 		'dataset_file' => 'required|mimes:csv,txt,xlsx',
    	// 		'select_operation' => 'required'
    	//        ];

    	// if($request->select_operation == 'append' || $request->select_operation == 'replace'){

    	// 	$rules['dataset_list'] = 'required';
    	// }

    	// $this->validate($request, $rules);
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
