<?php

namespace App\Http\Controllers\Services;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DatasetsList as DL;
use Excel;
use DB;

class ExportDatasetController extends Controller
{
    public function export($dataset_id){
    	$model = DL::find($dataset_id);
        if ($model == "" || empty($model)){
            return ['status'=>'error','file'=>'no record found'];
        }else{
            $fileName = explode('.',$model->dataset_name);
            $model = json_decode($model->dataset_records);
            $model = $this->objectToArray($model);

            $fileName = $fileName[0];
            Excel::create($fileName, function($excel) use($model) {
                $excel->sheet('Sheetname', function($sheet) use($model) {
                $sheet->fromArray($model);
                });
            })->store('csv');

            return ['status'=>'success','file'=>$fileName];
        }

    }

    public function downloadFile($fileName){

    	$path = storage_path('exports/'.$fileName.'.csv');
        return response()->download($path,$fileName.'.csv',['Content-Type: text/cvs']);

    }

    private function objectToArray($objectArray){
    	$arrays = [];
    	foreach($objectArray as $object){
		    $arrays[] =  (array) $object;
		}

		return $arrays;
    }
}
