<?php

namespace App\Http\Controllers\Services;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Goal;
class GoalApiController extends Controller
{
    public function goalsList(){

    	$model = Goal::WithUsers()->get();
    	if($model == null){
    		$response = ['status'=>'success','message'=>'No result found!'];
    		return $response;
    	}
    	$responseArray = [];
    	$index = 0;
    	foreach($model as $key => $goal){

    		$responseArray[$index]['goal_number'] = $goal->goal_number;
    		$responseArray[$index]['goal_title'] = $goal->goal_title;
    		$responseArray[$index]['goal_tagline'] = $goal->goal_tagline;
    		$responseArray[$index]['goal_description'] = $goal->goal_description;
    		$responseArray[$index]['goal_url'] = $goal->goal_url;
    		$responseArray[$index]['goal_icon'] = $goal->goal_icon;
    		$responseArray[$index]['goal_icon_url'] = $goal->goal_icon_url;
    		$responseArray[$index]['goal_color'] = $goal->goal_color;
    		$responseArray[$index]['goal_opacity'] = $goal->goal_opacity;
    		$responseArray[$index]['goal_nodal_ministry'] = $goal->goal_nodal_ministry;
    		$inIndex = 0;
    		foreach($goal->ministry as $ky => $vl){

    			$responseArray[$index]['ministry'][$inIndex]['ministry_id'] = $vl->ministry->ministry_id;
    			$responseArray[$index]['ministry'][$inIndex]['ministry_title'] = $vl->ministry->ministry_title;
    			$inIndex++;
    		}
    		$responseArray[$index]['ministry_order'] = $goal->ministry_order;
    		$responseArray[$index]['created_by'] = $goal->created_by;
    		$responseArray[$index]['created_at'] = $goal->created_at->format('Y-m-d H:i:s');
    		$index++;
    	}

    	$response = ['status'=>'success','records'=>$responseArray];
    	return $response;
    }

    public function singleGoal($id){

        $model = Goal::WithUsers()->find($id);
        if($model == null){

        	$response = ['status'=>'success','message'=>'No result found!'];
        	return $response;
        }
        $responseArray = [];
        $index = 0;
        

        $responseArray[$index]['goal_number'] = $model->goal_number;
		$responseArray[$index]['goal_title'] = $model->goal_title;
		$responseArray[$index]['goal_tagline'] = $model->goal_tagline;
		$responseArray[$index]['goal_description'] = $model->goal_description;
		$responseArray[$index]['goal_url'] = $model->goal_url;
		$responseArray[$index]['goal_icon'] = $model->goal_icon;
		$responseArray[$index]['goal_icon_url'] = $model->goal_icon_url;
		$responseArray[$index]['goal_color'] = $model->goal_color;
		$responseArray[$index]['goal_opacity'] = $model->goal_opacity;
		$responseArray[$index]['goal_nodal_ministry'] = $model->goal_nodal_ministry;
		$inIndex = 0;
		foreach($model->ministry as $ky => $vl){

			$responseArray[$index]['ministry'][$inIndex]['ministry_id'] = $vl->ministry->ministry_id;
			$responseArray[$index]['ministry'][$inIndex]['ministry_title'] = $vl->ministry->ministry_title;
			$inIndex++;
		}
		$responseArray[$index]['ministry_order'] = $model->ministry_order;
		$responseArray[$index]['created_by'] = $model->created_by;
		$responseArray[$index]['created_at'] = $model->created_at->format('Y-m-d H:i:s');
		$index++;
       
		$response = ['status'=>'success', 'record'=>$responseArray];
        return $response;
    }
}
