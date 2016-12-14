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
    		$responseArray[$index]['validated'] = $value->validated;
    		$responseArray[$index]['created_date'] = $value->created_at->format('Y-m-d H:i:s');
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
        if(!empty($model)){
            $records = json_decode($model->dataset_columns);
            return ['status'=>'success','data'=>['records'=>$records]];
        }else{
            return ['status'=>'error','message'=>'NO dataset found with given id!','dataset_id'=>$id];
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
            $model->validated       = 1;

            $model->save();
            return ['status'=>'sucess','message'=>'Columns updated successfully!','updated_id'=>$model->id];
        }else{

            return ['status'=>'success','message'=>'No record found with given id!'];
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
}
