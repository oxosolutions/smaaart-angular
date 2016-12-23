<?php

namespace App\Http\Controllers\Services;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Ministrie as MIN;
use App\Department as DP;
use App\Designation as DS;
use Hash;
use App\UserMeta;
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
                    case'profile_pic':
                        $responseArray[$metaValue->key] = asset('profile_pic/'.$metaValue->value);
                    break;
                    default:
                    $responseArray[$metaValue->key] = $metaValue->value;
                }
            }
        }
        return ['status'=>'success','details'=>$responseArray];
    }


    public function changePassword(Request $request){

        $validate = $this->validateModel($request);
        if(!$validate){

            return ['status'=>'error','message'=>'required fields are missing!'];
        }
        $model = $request->user();
        $result = Hash::check($request->old_pass, $model->password);
        if(!$result){
            return ['status'=>'error','message'=>'old password not correct!'];
        }

        if ($request->old_pass == $request->new_pass){
            return ['status' => 'error' , 'message' => 'your old and new password should not be same'];
        }

        if($request->new_pass != $request->conf_pass){
            return ['status'=>'error','message'=>'password not match!'];
        }

        $model->password = Hash::make($request->new_pass);
        $model->save();
        return ['status'=>'success','message'=>'Password changed successfully!'];

    }

    protected function validateModel($request){

        if($request->has('old_pass') && $request->has('new_pass') && $request->has('conf_pass')){
            return true;
        }else{
            return false;
        }
    }

    public function forgetPassword(Request $request){

    }

    public function saveProfile(Request $request){

        $validate = $this->validateProfile($request);
        if(!$validate){
            return ['status'=>'error','message'=>'Required fields are missing!'];
        }

        $userId = $request->user()->id;
        $model = User::find($userId);
        if($request->name != 'undefined'){
            $model->name = $request->name;
        }
        /*if($request->email != 'undefined'){
            if(!empty(User::where('email',$request->email)->first())){
                return ['status'=>'error','message'=>'Email already in use!'];
            }
            $model->email = $request->email;
        }*/
        $model->save();
        $ministries = explode(',',$request->ministry);
        $departments = explode(',',$request->department);
        if($request->ministry != 'undefined' && $request->department != 'undefined'){
            UserMeta::where(['key'=>'ministry', 'user_id' => $userId])->update(['value'=>json_encode($ministries)]);
            if($request->phone != 'undefined'){
                UserMeta::where(['key'=>'phone', 'user_id' => $userId])->update(['value'=>$request->phone]);
            }
            if($request->designation != 'undefined'){
                UserMeta::where(['key'=>'designation', 'user_id' => $userId])->update(['value'=>$request->designation]);
            }
            UserMeta::where(['key'=>'address', 'user_id' => $userId])->update(['value'=>$request->address]);
            UserMeta::where(['key'=>'department', 'user_id' => $userId])->update(['value'=>json_encode($departments)]);
            return ['status'=>'success','message'=>'Profile updated successfully!'];
        }else{
            return ['status'=>'error','message'=>'Unable to update profile!!'];
        }
    }

    protected function validateProfile($request){
        if($request->has('name') && $request->has('phone') && $request->has('designation') && $request->has('address') && $request->has('department') && $request->has('ministry')){
            return true;
        }else{
            return false;
        }
    }
}
