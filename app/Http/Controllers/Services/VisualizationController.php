<?php

namespace App\Http\Controllers\Services;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Visualisation as VS;
use Auth;
class VisualizationController extends Controller
{

	public function store(Request $request)
	{
        $validate = $this->validateRequest($request);
        if($validate['status'] == 'false'){

            $response = ['status'=>'error','error'=>$validate['error']];
            return $response;
        }
        try{

            $model = new VS();

            $model->dataset_id = $request->dataset;
            $model->visual_name = $request->visual_name;
            $model->created_by = Auth::User()->id;
            $model->save();
        }catch(\Exception $e){

            if($e instanceOf \Illuminate\Database\QueryException){
                return ['status'=>'error','message'=>'No dataset found!'];
            }else{
                return ['status'=>'error','message'=>'something went wrong!'];
            }
        }
		
		return ['status'=>'success','message'=>'Successfully created!'];
	}

    protected function validateRequest($request){

        if($request->has('dataset') && $request->has('visual_name')){

            return ['status'=>'true','errors'=>''];
        }else{
            return ['status'=>'false','error'=>'Fill required fields!'];
        }
    }
}