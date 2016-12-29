<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DatasetsList as DL;
use Carbon\Carbon;
use Auth;
use DB;
class DatasetsController extends Controller
{
    function getDatasetsList(){
    	$list = DL::orderBy('id', 'DESC')->get();
    	$responseArray = [];
    	$index = 0;
    	foreach($list as $key => $value){

    		$responseArray[$index]['dataset_id'] = $value->id;
    		$responseArray[$index]['dataset_name'] = $value->dataset_name;
    		$responseArray[$index]['validated'] = $value->validated;
    		$responseArray[$index]['created_date'] = $value->created_at->format('Y-m-d H:i:s');
    		$index++;
    	}

    	return ['data'=>$responseArray];
    }

    public function getDatasets($id,$skip = 0){
        $datasetDetails = DL::find($id);
        $datasetTable = DB::table($datasetDetails->dataset_table)->skip($skip)->take(1000)->get();
        if(empty($datasetTable)){
            return ['status'=>'success','records'=>[]];
        }

        $responseArray = [];
        $responseArray['dataset_id'] = $id;
        $responseArray['dataset_name'] = $datasetDetails->dataset_name;
        $responseArray['records'] = json_decode($datasetTable);
        $totalRecords = DB::table($datasetDetails->dataset_table)->count();
        return ['status'=>'success','records'=>$responseArray, 'total'=>$totalRecords,'skip'=>$skip];
    }

    public function getDatasetsColumns($id){
        $datasetDetails = DL::find($id);
        $datasetTable = DB::table($datasetDetails->dataset_table)->take(100)->get();
        if(empty($datasetTable)){
            return ['status'=>'success','records'=>[]];
        }

        $responseArray = [];
        $responseArray['dataset_id'] = $id;
        $responseArray['dataset_name'] = $datasetDetails->dataset_name;
        $responseArray['records'] = json_decode($datasetTable);
        $totalRecords = DB::table($datasetDetails->dataset_table)->count();
        return ['status'=>'success','records'=>$responseArray];
    }

    public function getFormatedDataset($id){

        $model = DL::find($id);
        if ($model == '' || empty($model)){
            return ['status'=>'error','records'=>'no records found'];
        }else{
        $records = json_decode($model->dataset_columns);

        $headers = [];
        $index = 0;
        foreach($records as $key =>  $value){
            if(!in_array($key, $headers)){

                $headers[$index]['id'] = $key;
                $headers[$index]['label'] = $key;
                $headers[$index]['type'] = $value;
            }
            $index++;
        }

        return ['status'=>'success','data'=>['column'=>$headers,'records'=>json_decode($model->dataset_records)]];
        }
    }

    protected function validateUpdateColumns($request){

        if($request->has('id') && $request->has('columns')){
            $return = ['status'=>'true','message'=>''];
        }else{
            $return = ['status'=>'false','message'=>'Required fields are missing!'];
        }
        return $return;
    }

    public function SavevalidateColumns(Request $request){

        $result = $this->validateUpdateColumns($request);
        if($result['status'] == 'false'){

            return ['status'=>'error','message'=>$result['message']];
        }
        $model = DL::find($request->id);
    
        if(!empty($model)){

            $model->dataset_columns = $request->columns;
            $model->save();
            return ['status'=>'sucess','message'=>'Columns updated successfully!','updated_id'=>$model->id];
        }else{

            return ['status'=>'error','message'=>'No record found with given id!'];
        }
    }


    public function deleteDataset($id){

        $model = DL::find($id);

        if(!empty($model)){
            $model->delete();
            return ['status'=>'success','message'=>'Successfully deleted!','deleted_id'=>$id];
        }else{

            return ['status'=>'error','message'=>'No dataset find with this id'];
        }
    }

    public function saveEditedDatset(Request $request){

        $validate = $this->validateEditDatasetRequest($request);
        if(!$validate){
            return ['status'=>'error','message'=>'Required fields are missing!'];
        }
        $model = DL::find($request->dataset_id);
        $table = $model->dataset_table;

        foreach(json_decode($request->records) as $key => $data){
            $columns = [];
            $id = '';
            foreach($data as $colKey => $colValue){
                if($colKey != 'id'){
                    $columns[$colKey] = $colValue;
                }else{
                    $id = $colValue;
                }
            }
            DB::table($table)->where('id',$id)->update($columns);
        }
        return ['status'=>'success','message'=>'Dataset updated successfully!','dataset_id'=>$request->dataset_id];
    }

    protected function validateEditDatasetRequest($request){

        if($request->has('dataset_id') && $request->has('records')){

            return true;
        }else{

            return false;
        }
    }

    public function saveNewSubset(Request $request){

        $validate = $this->validateNewSubset($request);
        if(!$validate){
            return ['status'=>'error','message'=>'Required fields are missing!!'];
        }
        $model = DL::find($request->dataset_id);
        $tableName = 'data_table_'.time();
        $columns = json_decode($request->subset_columns);
        DB::select("CREATE TABLE `{$tableName}` as SELECT  ".implode(',', $columns)." FROM ".$model->dataset_table.";");
        DB::select("ALTER TABLE `{$tableName}` ADD  `id` INT(100) PRIMARY KEY AUTO_INCREMENT FIRST;");

        $model = new DL();
        $model->dataset_name = $request->subset_name;
        $model->dataset_records = '{}';
        $model->dataset_table = $tableName;
        $model->user_id = Auth::user()->id;
		$model->uploaded_by = Auth::user()->name;
        $model->save();

        return ['staus'=>'success','message'=>'Subset saved successfully','dataset_id'=>$model->id];
    }
    protected function validateNewSubset($request){

        if($request->has('subset_name') && $request->has('subset_columns') && $request->has('dataset_id')){

            return true;
        }else{

            return false;
        }
    }

    /**
     * [filterIncorrectDataFromDataset for validate dataset data according to its type]
     * @param  [integer] $datasetID [dataset id]
     * @return [json] [will return json response]
     * @link it will use in SDGINDIA dataset.controller.js
     */
    public function filterIncorrectDataFromDataset($datasetID){

        $model = DL::find($datasetID);
        if(empty($model)){
            return ['status'=>'error','message'=>'No dataset found!','code'=>500];
        }
        if($model->validated == 0){
            return ['status'=>'error','message'=>'Dataset not validated!','code'=>501];
        }
        $recordsList = [];
        $datasetColumns = json_decode($model->dataset_columns);
        $datasetRecords = json_decode($model->dataset_records);
        foreach ($datasetRecords as $setKey => $setValue) {
            $singleRow = [];
            foreach ($datasetColumns as $Colkey => $ColValue) {
                if(gettype($setValue[$Colkey]) == $ColValue){
                    $singleRow[$Colkey] = $setValue[$Colkey];
                }else{
                    $singleRow[$Colkey] = "<>".$setValue[$Colkey]."<>";
                }
            }
        }
    }

    public function validateColums($id){

        $model = DL::find($id);
        if(!empty($model)){
            $wrongDataRows = [];
            $datasetTable = DB::table($model->dataset_table)->get()->toArray();
            $columnsTypeArray = (array)json_decode($model->dataset_columns);
            foreach($datasetTable as $key => $row){
                //$columnsArray = [];
                foreach($row as $colKey => $colVal){
                    $error = false;
                    // dd((bool)strtotime('2016-12-32'));
                    // dump($colKey);
                    // dd(gettype($colVal));
                    if(array_key_exists($colKey,$columnsTypeArray)){
                        $type = $columnsTypeArray[$colKey];
                        if($type == 'areacode'){
                            $type = 'string';
                        }
                        if($type != 'date'){
                            if($type == 'integer'){
                                if(!is_numeric($colVal)){
                                    $wrongDataRows[] = $row;
                                    break;
                                }
                            }
                            if($type == 'string'){
                               if(is_numeric($colVal)){
                                    $wrongDataRows[] = $row;
                                    break;
                               }
                            }
                        }else{
                            $dataType = (bool)strtotime($colVal);
                            if($dataType != true){
                                $wrongDataRows[] = $row;
                                break;
                            }
                        }
                    }
                }
            }
            return ['status'=>'success','message'=>'Columns valudated successfully!','wrong_rows'=>$wrongDataRows];
        }else{
            return ['stauts'=>'error','message'=>'No dataset found!'];
        }
    }

}
