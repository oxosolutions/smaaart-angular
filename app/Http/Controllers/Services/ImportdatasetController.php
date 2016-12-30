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
use File;
class ImportdatasetController extends Controller
{

    function uploadDataset(Request $request){
	   $validate = $this->validateRequst($request);
        
    	if($validate['status'] == 'false'){
    		$response = ['status'=>'error','errors'=>$validate['errors']];
    		return $response;
    	}

        if($request->source == 'file'){
            $path = 'datasets';
            try {
                 if(!in_array($request->file('file')->getClientOriginalExtension(),['csv'])){
                    return ['status'=>'error','records'=>'File type not allowed!'];
                }
            } catch (Exception $e) {
                return ['status'=>'error','records'=>'Please Select a File to Upload'];
            }
            $file = $request->file('file');
            if($file->isValid()){

                $filename = date('Y-m-d-H-i-s')."-".$request->file('file')->getClientOriginalName();
                $uploadFile = $request->file('file')->move($path, $filename);
                $filePath = $path.'/'.$filename;
            }
        }
        
        if($request->source == 'file_server'){
            $filePath = $request->filepath;
        }

        if($request->source == 'url'){
            $filePath = $request->fileurl;
        }

        if($request->add_replace == 'newtable'){
            $result = $this->storeInDatabase($filePath, $request->dataset_name, $request->source, $filename);
        }elseif($request->add_replace == 'append'){
            //$result = $this->appendDataset($request, $filePath);
        }elseif($request->add_replace == 'replace'){
            //$result = $this->replaceDataset($request, $request->dataset_name, $filePath);
        }

        if($result['status'] == 'true'){
            
			$response = ['status'=>'success','message'=>$result['message'],'id'=>$result['id']];
			return $response;
    		
        }else{
            $response = ['status'=>'error','message'=>$result['message']];
            return $response;
        }

    }
    protected function validateRequst($request){
        $errors = [];
        if($request->has('source') && $request->source != ''){
            switch($request->source){
                case'file':
                    if($request->file('file') == '' || empty($request->file('file')) || $request->file('file') == null){
                        $errors['message'] = 'File field should not empty!';
                    }
                break;
                case'file_server':
                    if(!$request->has('filepath') || $request->filepath == ''){
                        $errors['message'] = 'File path should not empty!';
                    }
                break;
                case'url':
                    if(!$request->has('fileurl') || $request->fileurl == ''){
                        $errors['message'] = 'File url should not empty!';
                    }
                break;
            }
        }else{
            $errors['message'] = 'Required fields are missing!';
        }
        
        /*if($request->format == 'undefined' || empty($request->format) || $request->format  == null){
            $errors['format'] = 'Please select file format';
        }*/

    	if($request->add_replace == 'undefined' || empty($request->add_replace) || $request->add_replace  == null){
    		$errors[] = 'Please select file format!';
    	}
    	if($request->add_replace == 'replace' || $request->add_replace == 'append'){
    		if($request->with_dataset == '' || $request->with_dataset == 'undefined' || empty($request->with_dataset)){
    			$errors['message'] = 'Please select dataset to '.$request->add_replace;
    	   }
    	}
        
    	if(count($errors) >= 1){
    		$return = ['status' => 'false','errors'=>$errors];
    		return $return;
    	}else{
    		$return = ['status' => 'true','errors'=>[]];
    		return $return;
    	}
    }

    public function getColumns($id){
        try{
            $model = DL::where('id',$id)->first();
             $datasetTable  = DB::table($model->dataset_table)->limit(1)->first();
            if(empty($datasetTable)){
                return ['status'=>'error','message'=>'no data found!'];
            }
            $columnsArray = [];
            $index = 0;
            foreach($datasetTable as $key => $value){
                if($index != 0){
                    $columnsArray[$key] = $value;
                }
                $index++;
            }

            return ['status'=>'sucess','data'=>['columns'=>$columnsArray,'dataset_id'=>$model->id,'validated'=>$model->validated, 'dataset_columns'=>  json_decode($model->dataset_columns)]];
        }catch(\Exception $e)
        {
            return ['status'=>'error','message'=>'no data found!'];

        }

    }

    protected function storeInDatabase($filename, $origName, $source, $orName){
        
        $filePath = $filename;
        if($source == 'url'){
            $randName = 'downloaded_dataset_'.time().'.csv';
            $path = 'datasets/';
            copy($filename, $path.$randName);
            $filePath = 'datasets/'.$randName;
        }
        if(!File::exists($filePath)){
            return ['status'=>'false','id'=>'','message'=>'File not found on given path!'];
        }
        DB::beginTransaction();
        $model = new MySQLWrapper();
        $tableName = 'data_table_'.time();
        
        $result = $model->wrapper->createTableFromCSV($filePath,$tableName,',','"', '\\', 0, array(), 'generate','\r\n');
        
        if($result){
            $model = new DL;
            $model->dataset_table = $tableName;
            $model->dataset_name = $origName;
            $model->dataset_file = $filePath;
            $model->dataset_file_name = $orName;
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
