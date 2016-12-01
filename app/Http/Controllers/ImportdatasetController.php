<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

use Illuminate\Support\Collection;
use Auth;
use Excel;
use App\DatasetsList as DL;

class ImportdatasetController extends Controller
{
    function __construct(){


    }


    function uploadDataset(Request $request){

    	$validate = $this->validateRequst($request);

    	if(!$validate){

    		$response = ['status'=>'error','message'=>'required fields are missing!'];
    		return $response;
    	}

    	$path = 'datasets';
    	$file = $request->file('file');
    	if($file->isValid()){

    		//$extension = $request->file('file')->getClientOriginalExtension();

    		//$filename = rand(11111,99999).'.'.$extension;

    		$filename = date('Y-m-d-H-i-s')."-".$request->file('file')->getClientOriginalName();

    		$uploadFile = $request->file('file')->move($path, $filename);

    		$this->storeInDatabase($path.'/'.$filename, $request->file('file')->getClientOriginalName());
    	}
  		if($uploadFile){

  			$response = ['status'=>'success','message'=>'file uploaded successfully!'];
  			return $response;
  		}else{

  			$response = ['status'=>'error','message'=>'unable to upload file!'];
  			return $response;
  		}
  		
    }

    protected function validateRequst($request){


    	$validator = Validator::make($request->all(),[

    			'file' => 'required',
    			'format' => 'required',
    			'add_replace' => 'required',
    			'with_dataset' => ($request->add_replace == 'replace' || $request->add_replace == 'append')?'required':'',
    	]);


    	if($validator->fails()){

    		return false;
    	}else{

    		return true;
    	}
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
		$model->uploaded_by = Auth::user()->name;
		$model->save();

		if($model){

			return true;
		}else{

			return false;
		}
    }
}
