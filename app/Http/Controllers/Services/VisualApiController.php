<?php

namespace App\Http\Controllers\Services;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\GeneratedVisual as GV;
use App\DatasetsList as DL;
use DB;
class VisualApiController extends Controller
{
    public function visualList(){

    	$model = GV::all();
    	$resultArray = [];
    	foreach($model as $key => $value){
    		$tempArray = [];
    		$tempArray['id'] = $value->id;
    		$tempArray['visual_name'] = $value->visual_name;
    		$tempArray['dataset'] = array('dataset_id'=>$value->dataset_id,'dataset_name'=>$value->datasetName->dataset_name);
    		$datasetData = DL::find($value->dataset_id);
    		$dataTableData = DB::table($datasetData->dataset_table)->select(json_decode($value->columns))->where('id',1)->first();
    		$columnArray = [];
    		foreach(json_decode($value->columns) as $colKey => $colValue){
    			$columnArray[$colValue] = $dataTableData->{$colValue};
    		}
    		$tempArray['columns'] = $columnArray;
    		$tempArray['gen_columns'] = json_decode($value->query_result);
    		$tempArray['created_by'] = $value->createdBy->name;
    		$tempArray['created_at'] = $value->created_at->format('Y-m-d H:i:s');
    		$resultArray[] = $tempArray;
    	}

    	return ['status'=>'success','records'=>$resultArray];
    }

    public function visualById($id){

    	$model = GV::find($id);
    	$value = $model;
		$tempArray = [];
		$tempArray['id'] = $value->id;
		$tempArray['visual_name'] = $value->visual_name;
		$tempArray['dataset_id'] = $value->dataset_id;
		$datasetData = DL::find($value->dataset_id);
		$dataTableData = DB::table($datasetData->dataset_table)->select(json_decode($value->columns))->where('id',1)->first();
		$columnArray = [];
		foreach(json_decode($value->columns) as $colKey => $colValue){
			$columnArray[$colValue] = $dataTableData->{$colValue};
		}
		$tempArray['columns'] = $columnArray;
		$tempArray['gen_columns'] = json_decode($value->query_result);
		$tempArray['created_by'] = $value->createdBy->name;
		$tempArray['created_at'] = $value->created_at->format('Y-m-d H:i:s');

    	return ['status'=>'success','records'=>$tempArray];
    }
}
