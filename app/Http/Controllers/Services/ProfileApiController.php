<?php

namespace App\Http\Controllers\Services;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Ministrie as MIN;
use App\Department as DP;
use App\Designation as DS;
class ProfileApiController extends Controller
{
    public function getUserProfile(Request $request){

        $model = $request->user();

        $responseArray = [];
        $responseArray['name'] = $model->name;
        $responseArray['email'] = $model->email;
        $responseArray['token'] = $model->api_token;
        if($model->meta != null){

            foreach ($model->meta as $metaKey => $metaValue) {
                switch($metaValue->key){
                    case'ministry':
                        $ministries = json_decode($metaValue->value);
                        $index = 0;
                        foreach($ministries as $minKey => $minVal){
                            $MinisModel = MIN::find($minVal);
                            $responseArray['ministries'][$index]['id'] = $MinisModel->id;
                            $responseArray['ministries'][$index]['ministry_title'] = $MinisModel->ministry_title;
                            $index++;
                        }
                    break;
                    case'department':
                        $departments = json_decode($metaValue->value);
                        $index = 0;
                        foreach($departments as $depKey => $depVal){
                            $DepModel = DP::find($depVal);
                            $responseArray['departments'][$index]['id'] = $DepModel->id;
                            $responseArray['departments'][$index]['department_name'] = $DepModel->dep_name;
                            $index++;
                        }
                    break;
                    case'designation':
                        $DesgModel = DS::find($metaValue->value);
                        $responseArray['designation'] = $DesgModel->designation;
                    break;
                    default:
                    $responseArray[$metaValue->key] = $metaValue->value;
                }
            }
        }
        return ['status'=>'success','details'=>$responseArray];
    }
}
