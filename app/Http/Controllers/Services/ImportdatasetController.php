<?php

namespace App\Http\Controllers\Services;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Collection;
use Auth;
use Excel;
use App\DatasetsList as DL;
use MySQLWrapper;
use DB;
class ImportdatasetController extends Controller
{

    function uploadDataset(Request $request){
    	$validate = $this->validateRequst($request);
          if($request->file('file') == "" || $request->format == "" || $request->add_replace == "" || $request->with_dataset == ""){
                return ['status'=>'error','message'=>'Please Provide Require Fields'];
            }

            try {
                 if(!in_array($request->file('file')->getClientOriginalExtension(),['csv','xlsx','xls'])){
                    return ['status'=>'error','records'=>'File type not allowed!'];
                }
            } catch (Exception $e) {
                return ['status'=>'error','records'=>'Please Select a File to Upload'];
            }
        	if($validate['status'] == 'false'){
        		$response = ['status'=>'error','error'=>$validate['error']];
        		return $response;
        	}

        	$path = 'datasets';
        	$file = $request->file('file');

          	if($file->isValid()){

          		$filename = date('Y-m-d-H-i-s')."-".$request->file('file')->getClientOriginalName();
          		$uploadFile = $request->file('file')->move($path, $filename);
                $filePath = $path.'/'.$filename;
                
                if($request->add_replace == 'newtable'){
                    $result = $this->storeInDatabase($filePath, $request->file('file')->getClientOriginalName());
                }elseif($request->add_replace == 'append'){
                    $result = $this->appendDataset($request, $filePath);
                }elseif($request->add_replace == 'replace'){
                    $result = $this->replaceDataset($request, $request->file('file')->getClientOriginalName(), $filePath);
                }
          	}

            if($result['status'] == 'true'){
                if($uploadFile){
        			$response = ['status'=>'success','message'=>$result['message'],'id'=>@$result['id']];
        			return $response;
        		}else{
        			$response = ['status'=>'error','message'=>'unable to upload file!'];
        			return $response;
        		}
            }else{
                $response = ['status'=>'error','message'=>$result['message']];
                return $response;
            }

    }
    protected function validateRequst($request){
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
    }

    public function getColumns($id){
        $model = DL::where('id',$id)->first();
        $datasetTable  = DB::table($model->dataset_table)->limit(1)->first();
        if(empty($datasetTable)){
            return ['status'=>'error','message'=>'no data found!'];
        }
        // dd($datasetTable);
        $columnsArray = [];
        $index = 0;
        foreach($datasetTable as $key => $value){
            if($index != 0){
                $columnsArray[$key] = $value;
            }
            $index++;
        }

        return ['status'=>'sucess','data'=>['columns'=>$columnsArray,'dataset_id'=>$model->id,'validated'=>$model->validated]];
    }

    protected function storeInDatabase($filename, $origName){
        /*ini_set('memory_limit', -1);
    	$FileData = [];
    	$data = Excel::load($filename, function($reader){ })->get();

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
  			return ['status'=>'true','id'=>$model->id,'message'=>'Dataset upload successfully!'];
  		}else{
  			return ['status'=>'false','id'=>'','message'=>'unable to upload datsaet!'];
  		}*/
        DB::beginTransaction();
        $model = new MySQLWrapper();
        $tableName = 'data_table_'.time();
        $result = $model->wrapper->createTableFromCSV($filename,$tableName,',','"', '\\', 0, array(), 'generate','\r\n');
        if($result){
            $model = new DL;
            $model->dataset_table = $tableName;
            $model->dataset_name = $origName;
            $model->user_id = Auth::user()->id;
            $model->uploaded_by = Auth::user()->name;
            $model->dataset_records = '{}';
            $model->save();
            DB::commit();
            return ['status'=>'true','id'=>$model->id,'message'=>'Dataset upload successfully!'];
        }else{
            DB::rollback();
            return ['status'=>'false','id'=>'','message'=>'unable to upload datsaet!'];
        }
    }

    protected function replaceDataset($request, $origName, $filename){

        ini_set('memory_limit', '2048M');
    	$FileData = [];
    	$data = Excel::load($filename, function($reader){ })->get();

    	foreach($data as $key => $value){
            $FileData[] = $value->all();
    	}
		$model = DL::find($request->with_dataset);
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

    protected function appendDataset($request, $filename){
        ini_set('memory_limit', '2048M');
        $model = DL::find($request->with_dataset);
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
}
