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
        $classArray = [];
        $className = 'triangle-right';
    	foreach($model as $key => $goal){

            $responseArray[$index]['goal_id'] = $goal->id;
    		$responseArray[$index]['goal_number'] = $goal->goal_number;
    		$responseArray[$index]['goal_title'] = $goal->goal_title;
    		$responseArray[$index]['goal_tagline'] = $goal->goal_tagline;
    		$responseArray[$index]['goal_description'] = $goal->goal_description;
    		$responseArray[$index]['goal_url'] = $goal->goal_url;
    		$responseArray[$index]['goal_icon'] = $goal->goal_icon;
    		$responseArray[$index]['goal_icon_url'] = $goal->goal_icon_url;
            $responseArray[$index]['goal_color_hax'] = $goal->goal_color_hex;
            $responseArray[$index]['goal_color_rgb'] = $goal->goal_color_rgb;
    		$responseArray[$index]['goal_color_rgba'] = $goal->goal_color_rgb_a;
    		$responseArray[$index]['goal_opacity'] = $goal->goal_opacity;
    		$responseArray[$index]['goal_nodal_ministry'] = $goal->goal_nodal_ministry;

    		$inIndex = 0;
    		foreach($goal->ministry as $ky => $vl){
    			try{
                    $responseArray[$index]['ministry'][$inIndex]['id'] = $vl->ministry->id;
    				$responseArray[$index]['ministry'][$inIndex]['ministry_id'] = $vl->ministry->ministry_id;
    				$responseArray[$index]['ministry'][$inIndex]['ministry_title'] = $vl->ministry->ministry_title;
    			}catch(\Exception $e){

    				if($e instanceOf \Symfony\Component\HttpKernel\Exception\ErrorException){

    					//echo "Test";
    				}
    			}
    			
    			$inIndex++;
    		}

            $inIndex = 0;
            foreach($goal->schema as $ky => $vl){
                try{
                    $responseArray[$index]['schema'][$inIndex]['schema_id'] = $vl->schemas->schema_id;
                    $responseArray[$index]['schema'][$inIndex]['schema_title'] = $vl->schemas->schema_title;
                    $responseArray[$index]['schema'][$inIndex]['schema_image'] = $vl->schemas->schema_image;
                }catch(\Exception $e){

                    if($e instanceOf \Symfony\Component\HttpKernel\Exception\ErrorException){

                        //echo "Test";
                    }
                }
                
                $inIndex++;
            }

            $inIndex = 0;
            foreach($goal->target as $ky => $vl){
                try{
                    $responseArray[$index]['target'][$inIndex]['target_id'] = $vl->targets->target_id;
                    $responseArray[$index]['target'][$inIndex]['target_title'] = $vl->targets->target_title;
                    $responseArray[$index]['target'][$inIndex]['target_image'] = $vl->targets->target_image;
                }catch(\Exception $e){

                    if($e instanceOf \Symfony\Component\HttpKernel\Exception\ErrorException){

                        //echo "Test";
                    }
                }
                
                $inIndex++;
            }

            $inIndex = 0;
            foreach($goal->resources as $ky => $vl){
                try{
                    $responseArray[$index]['resources'][$inIndex]['resources_id'] = $vl->resources->resources_id;
                    $responseArray[$index]['resources'][$inIndex]['resources_title'] = $vl->resources->resources_title;
                    $responseArray[$index]['resources'][$inIndex]['resources_image'] = $vl->resources->resources_image;
                }catch(\Exception $e){

                    if($e instanceOf \Symfony\Component\HttpKernel\Exception\ErrorException){

                        //echo "Test";
                    }
                }
                
                $inIndex++;
            }

            $inIndex = 0;
            foreach($goal->intervention as $ky => $vl){
                try{
                    $responseArray[$index]['intervention'][$inIndex]['intervention_id'] = $vl->interventions->intervent_id;
                    $responseArray[$index]['intervention'][$inIndex]['intervention_title'] = $vl->interventions->intervent_title;
                    $responseArray[$index]['intervention'][$inIndex]['intervention_image'] = $vl->interventions->intervent_image;
                }catch(\Exception $e){

                    if($e instanceOf \Symfony\Component\HttpKernel\Exception\ErrorException){

                        //echo "Test";
                    }
                }
                
                $inIndex++;
            }
            $responseArray[$index]['repeat_class'] = $className;
    		$responseArray[$index]['created_by'] = $goal->created_by;
    		$responseArray[$index]['created_at'] = $goal->created_at->format('Y-m-d H:i:s');
            $classArray[] = $index;
            if(count($classArray) == 2){

                if($className == 'triangle-right'){

                    $className = 'triangle-left';
                }else{

                    $className = 'triangle-right';
                }

                $classArray = [];
            }
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
        

        $responseArray[$index]['goal_id'] = $model->goal_id;
        $responseArray[$index]['goal_number'] = $model->goal_number;
		$responseArray[$index]['goal_title'] = $model->goal_title;
		$responseArray[$index]['goal_tagline'] = $model->goal_tagline;
		$responseArray[$index]['goal_description'] = $model->goal_description;
		$responseArray[$index]['goal_url'] = $model->goal_url;
		$responseArray[$index]['goal_icon'] = $model->goal_icon;
		$responseArray[$index]['goal_icon_url'] = $model->goal_icon_url;
		$responseArray[$index]['goal_color_hax'] = $goal->goal_color_hex;
        $responseArray[$index]['goal_color_rgb'] = $goal->goal_color_rgb;
        $responseArray[$index]['goal_color_rgba'] = $goal->goal_color_rgb_a;
		$responseArray[$index]['goal_opacity'] = $model->goal_opacity;
		$responseArray[$index]['goal_nodal_ministry'] = $model->goal_nodal_ministry;
		$inIndex = 0;
		foreach($model->ministry as $ky => $vl){

			$responseArray[$index]['ministry'][$inIndex]['ministry_id'] = $vl->ministry->ministry_id;
			$responseArray[$index]['ministry'][$inIndex]['ministry_title'] = $vl->ministry->ministry_title;
			$inIndex++;
		}
        $inIndex = 0;
        foreach($model->schema as $ky => $vl){
            try{
                $responseArray[$index]['schema'][$inIndex]['schema_id'] = $vl->schemas->schema_id;
                $responseArray[$index]['schema'][$inIndex]['schema_title'] = $vl->schemas->schema_title;
                $responseArray[$index]['schema'][$inIndex]['schema_image'] = $vl->schemas->schema_image;
            }catch(\Exception $e){

                if($e instanceOf \Symfony\Component\HttpKernel\Exception\ErrorException){

                    //echo "Test";
                }
            }
            
            $inIndex++;
        }

        $inIndex = 0;
        foreach($model->target as $ky => $vl){
            try{
                $responseArray[$index]['target'][$inIndex]['target_id'] = $vl->targets->target_id;
                $responseArray[$index]['target'][$inIndex]['target_title'] = $vl->targets->target_title;
                $responseArray[$index]['target'][$inIndex]['target_image'] = $vl->targets->target_image;
            }catch(\Exception $e){

                if($e instanceOf \Symfony\Component\HttpKernel\Exception\ErrorException){

                    //echo "Test";
                }
            }
            
            $inIndex++;
        }

        $inIndex = 0;
        foreach($model->resources as $ky => $vl){
            try{
                $responseArray[$index]['resources'][$inIndex]['resources_id'] = $vl->resources->resources_id;
                $responseArray[$index]['resources'][$inIndex]['resources_title'] = $vl->resources->resources_title;
                $responseArray[$index]['resources'][$inIndex]['resources_image'] = $vl->resources->resources_image;
            }catch(\Exception $e){

                if($e instanceOf \Symfony\Component\HttpKernel\Exception\ErrorException){

                    //echo "Test";
                }
            }
            
            $inIndex++;
        }

        $inIndex = 0;
        foreach($model->intervention as $ky => $vl){
            try{
                $responseArray[$index]['intervention'][$inIndex]['intervention_id'] = $vl->interventions->intervent_id;
                $responseArray[$index]['intervention'][$inIndex]['intervention_title'] = $vl->interventions->intervent_title;
                $responseArray[$index]['intervention'][$inIndex]['intervention_image'] = $vl->interventions->intervent_image;
            }catch(\Exception $e){

                if($e instanceOf \Symfony\Component\HttpKernel\Exception\ErrorException){

                    //echo "Test";
                }
            }
            
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
