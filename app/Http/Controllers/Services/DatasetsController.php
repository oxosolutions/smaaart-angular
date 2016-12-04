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

    	$responseArray = [];

    	$responseArray['dataset_id'] = $id;
    	$responseArray['records'] = json_decode($datasetDetails->dataset_records);

    	return $responseArray;
    }
}
