<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\DatasetsList as DL;

class DatasetsController extends Controller
{
    function getDatasetsList(){

    	$list = DL::all();
    	$responseArray = [];
    	$index = 0;
    	foreach($list as $key => $value){

    		$responseArray[$index]['dataset_name'] = $value->dataset_name;

    		$responseArray[$index]['dataset_records'] = json_decode($value->dataset_records);

    		$index++;
    	}

    	return $responseArray;
    }
}
