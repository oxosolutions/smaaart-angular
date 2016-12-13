<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\DatasetsList as DL;

use Carbon\Carbon;

class DatasetsController extends Controller
{
    function getDatasetsList(){

    	$list = DL::all();
    	$responseArray = [];
    	$index = 0;
    	foreach($list as $key => $value){

    		$responseArray[$index]['dataset_id'] = $value->id;
    		$responseArray[$index]['dataset_name'] = $value->dataset_name;
    		$responseArray[$index]['created_date'] = $value->created_at->format('Y-m-d H:i:s');

    		//$responseArray[$index]['dataset_records'] = json_decode($value->dataset_records);

    		$index++;
    	}

    	return ['data'=>$responseArray];
    }

    public function getDatasets($id){

    	$datasetDetails = DL::find($id);
        if(empty($datasetDetails)){

            return ['status'=>'success','records'=>[]];
        }
    	$responseArray = [];

    	$responseArray['dataset_id'] = $id;
    	$responseArray['records'] = json_decode($datasetDetails->dataset_records);

    	return ['status'=>'success','records'=>$responseArray];
    }

    public function getFormatedDataset($id){

        $model = DL::find($id);
        $records = json_decode($model->dataset_records);

        $headers = [];
        $index = 0;
        foreach($records[0] as $key =>  $value){
            if(!in_array($key, $headers)){

                $headers[$index]['id'] = $key;
                $headers[$index]['label'] = $key;
                $headers[$index]['type'] = 'string';
            }
            $index++;
        }
        foreach($records as $key => $value){

            foreach($value as $ky => $val){
                
            }
        }

        return ['status'=>'success','data'=>['column'=>$headers,'records'=>$records]];
    }
}
