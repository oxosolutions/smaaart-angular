<?php

namespace App\Http\Controllers\Services;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Goal;
use App\GoalsResource as GR;

class GoalApiController extends Controller
{

public function goalData($id)
{

    $goal = Goal::where('goal_number',$id)->get();
    $response =[];
    foreach($goal as $key => $value){
    
    $response['goal']['goal_id'] = $value->id;
    $response['goal']['goal_number'] = $value->goal_number;
    $response['goal']['goal_title'] = $value->goal_title; 
    $response['goal']['goal_tagline'] = $value->goal_tagline;
    $response['goal']['goal_description'] = $value->goal_description; 
    $response['goal']['goal_url'] = $value->goal_url; 
    $response['goal']['goal_icon'] = $value->goal_icon;
    $response['goal']['goal_icon_url'] = $value->goal_icon_url;
    $response['goal']['goal_color_hax'] = $value->goal_color_hex;
    $response['goal']['goal_color_rgb'] = $value->goal_color_rgb;
    $response['goal']['goal_color_rgba'] = $value->goal_color_rgb_a;
    $response['goal']['goal_opacity'] = $value->goal_opacity;
    $response['goal']['goal_nodal_ministry'] = $value->goal_nodal_ministry;

    $resIndex = 0;
    $tarIndex = 0;
    $intIndex =0;
    $schIndex =0;
    $minIndex =0;
    foreach ($value->ministry as  $ministryData) {
   
    $response['ministry'][$minIndex]['id'] = $ministryData->ministry->id;
    $response['ministry'][$minIndex]['ministry_id'] = $ministryData->ministry->ministry_id;
    $response['ministry'][$minIndex]['ministry_title'] =$ministryData->ministry->ministry_title;
    $response['ministry'][$minIndex]['ministry_description']  = $ministryData->ministry->ministry_description;
    $response['ministry'][$minIndex]['ministry_icon']  =$ministryData->ministry->ministry_icon;
    $response['ministry'][$minIndex]['ministry_image'] = $ministryData->ministry->ministry_image;
    $response['ministry'][$minIndex]['ministry_phone'] =$ministryData->ministry->ministry_phone;
    $response['ministry'][$minIndex]['ministry_ministers']= $ministryData->ministry->ministry_ministers;
    $response['ministry'][$minIndex]['ministry_order'] =$ministryData->ministry->ministry_order;
    $response['ministry'][$minIndex]['created_by'] = $ministryData->ministry->created_by;
$minIndex++;

}
foreach ($value->schema as  $schemaData) {

    $response["schema"][$schIndex]['id']                = $schemaData->schemas->id;   
    $response["schema"][$schIndex]["schema_id"]         = $schemaData->schemas->schema_id;
    $response["schema"][$schIndex]["schema_title"]      = $schemaData->schemas->schema_title;
    $response["schema"][$schIndex]["schema_image"]      = $schemaData->schemas->schema_image;
    $response["schema"][$schIndex]["schema_desc"]       = $schemaData->schemas->schema_desc;
    $response["schema"][$schIndex]["created_by"]        = $schemaData->schemas->created_by;
    $schIndex++;
}
   
    foreach ($value->intervention as  $intervenData) {
    # code...
    $response['intervention'][$intIndex]["id"]    = $intervenData->interventions->id;    
    $response['intervention'][$intIndex]["intervent_id"]    = $intervenData->interventions->intervent_id;
    $response['intervention'][$intIndex]["intervent_title"] = $intervenData->interventions->intervent_title;
    $response['intervention'][$intIndex]["intervent_image"] = $intervenData->interventions->intervent_image;
    $response['intervention'][$intIndex]["intervent_desc"]  = $intervenData->interventions->intervent_desc;
    $response['intervention'][$intIndex]["created_by"]      = $intervenData->interventions->created_by;

     $intIndex++;
    }

    foreach ($value->target as $targetData) {

    $response['target'][$tarIndex]["id"]                 =   $targetData->targets->id;
    $response['target'][$tarIndex]["target_id"]          =   $targetData->targets->target_id;
    $response['target'][$tarIndex]["target_title"]       =   $targetData->targets->target_title;
    $response['target'][$tarIndex]["target_image"]       =   $targetData->targets->target_image;
    $response['target'][$tarIndex]["target_desc"]        =   $targetData->targets->target_desc;
    $response['target'][$tarIndex]["created_by"]         =   $targetData->targets->created_by;

    $tarIndex++;
    }
    foreach($value->resources as $res)
    {
    $response['resource'][$resIndex]['id']  = $res->resources->id;
    $response['resource'][$resIndex]['resource_id'] = $res->resources->resource_id;
    $response['resource'][$resIndex]['resource_title'] = $res->resources->resource_title;
    $response['resource'][$resIndex]['resource_image'] = $res->resources->resource_image;
    $response['resource'][$resIndex]['resource_desc'] = $res->resources->resource_desc;
    $response['resource'][$resIndex]['created_by'] = $res->resources->created_by;

    $resIndex++;   
    }

    }
return  ['status'=>'success','records'=>[$response]];
    
}
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
    				$responseArray[$index]['ministry'][$inIndex]['ministry_desc'] = $vl->ministry->ministry_description;
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
                    $responseArray[$index]['schema'][$inIndex]['schema_desc'] = $vl->schemas->schema_desc;
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
        

        $responseArray[$index]['goal_id'] = $model->id;
        $responseArray[$index]['goal_number'] = $model->goal_number;
		$responseArray[$index]['goal_title'] = $model->goal_title;
		$responseArray[$index]['goal_tagline'] = $model->goal_tagline;
		$responseArray[$index]['goal_description'] = $model->goal_description;
		$responseArray[$index]['goal_url'] = $model->goal_url;
		$responseArray[$index]['goal_icon'] = $model->goal_icon;
		$responseArray[$index]['goal_icon_url'] = $model->goal_icon_url;
		$responseArray[$index]['goal_color_hax'] = $model->goal_color_hex;
        $responseArray[$index]['goal_color_rgb'] = $model->goal_color_rgb;
        $responseArray[$index]['goal_color_rgba'] = $model->goal_color_rgb_a;
		$responseArray[$index]['goal_opacity'] = $model->goal_opacity;
		$responseArray[$index]['goal_nodal_ministry'] = $model->goal_nodal_ministry;
		$inIndex = 0;
		foreach($model->ministry as $ky => $vl){

			$responseArray[$index]['ministry'][$inIndex]['ministry_id'] = $vl->ministry->ministry_id;
			$responseArray[$index]['ministry'][$inIndex]['ministry_title'] = $vl->ministry->ministry_title;
            $responseArray[$index]['ministry'][$inIndex]['ministry_desc'] = $vl->ministry->ministry_description;
			$inIndex++;
		}
        $inIndex = 0;
        foreach($model->schema as $ky => $vl){
            try{
                $responseArray[$index]['schema'][$inIndex]['schema_id'] = $vl->schemas->schema_id;
                $responseArray[$index]['schema'][$inIndex]['schema_title'] = $vl->schemas->schema_title;
                $responseArray[$index]['schema'][$inIndex]['schema_image'] = $vl->schemas->schema_image;
                $responseArray[$index]['schema'][$inIndex]['schema_desc'] = $vl->schemas->schema_desc;
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
