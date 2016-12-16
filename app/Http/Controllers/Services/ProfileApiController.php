<?php

namespace App\Http\Controllers\Services;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
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
                        
                    break;

                    default:
                    $responseArray[$metaValue->key] = $metaValue->value;
                }
            }
        }
        dump($responseArray);
    }
}
