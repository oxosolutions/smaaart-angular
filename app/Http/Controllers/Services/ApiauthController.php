<?php

namespace App\Http\Controllers\Services;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use DB;
use App\User;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\UserMeta;
use App\Mail\ForgetPassword;
use App\Mail\AdminRegister;
use Illuminate\Support\Facades\Mail;
use App\GlobalSetting as GS;
class ApiauthController extends Controller
{

   public  function Authenicates(Request $request)
    {

     	if(empty ( $request->email )){
    			return ['status'=>'error','message'=>'We need to know your e-mail address!'];
		}
		else if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)){
				return ['status'=>'error','message'=>'Invalid email format!'];
		}
		else if($request->password==""){
			return ['status'=>'error','message'=>'We need to know your Password!'];

		}
		else if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])){
			$user = Auth::user();
            if($user->approved == 0){
                return ['status'=>'error','message'=>'Your account not yet approved!'];
            }
			return ['status'=>'successful', 'user_detail'=>$user];
		}else{
			return ['status'=>'error','message'=>'Invalid email or password!'];
		}

    }


     protected function modelValidate($request){

        $rules = [
				'name'  => 'min:5|regex:/^[A-Z a-z]+$/',
                'email' => 'required|email|unique:users,email',
                'password' => 'min:6|required',
                'token' => 'required'
        ];

        $this->validate($request, $rules);;
    }


    public function Register(Request $request)
    {
    	$api_token = uniqid('',30);
        $validate = $this->validateUserMeta($request);
        if(!$validate){
            return ['status'=>'error','message'=>'Required fields are missing!'];
        }
    	if($request->name && $request->email && $request->password )
		{
			if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {

     			return ['status'=>'error','message'=>'Invalid email format!'];
			 }
				try{
					$user = User::create([
        					'name' => $request->name,
        					'email' => $request->email,
        					'password' => Hash::make($request->password),
        					'api_token' => $api_token
        					]);

                    $MetaData = [];
                    $path = 'profile_pic';
                    if($request->hasFile('profile_pic')){
                        $filename = date('Y-m-d-H-i-s')."-".$request->file('profile_pic')->getClientOriginalName();
                        $request->file('profile_pic')->move($path, $filename);
                        $MetaData[0]['key'] = 'profile_pic';
                        $MetaData[0]['value'] = $filename;
                        $MetaData[0]['user_id'] = $user->id;
                    }
                    $MetaData[1]['key'] = 'phone';
                    $MetaData[1]['value'] = $request->phone;
                    $MetaData[1]['user_id'] = $user->id;
                    $MetaData[2]['key'] = 'address';
                    $MetaData[2]['value'] = $request->address;
                    $MetaData[2]['user_id'] = $user->id;
                    $Departments = explode(',',$request->departments);
                    $Ministries = explode(',',$request->ministries);
                    $MetaData[3]['key'] = 'department';
                    $MetaData[3]['value'] = json_encode($Departments);
                    $MetaData[3]['user_id'] = $user->id;
                    $MetaData[4]['key'] = 'ministry';
                    $MetaData[4]['value'] = json_encode($Ministries);
                    $MetaData[4]['user_id'] = $user->id;
                    $MetaData[5]['key'] = 'designation';
                    $MetaData[5]['value'] = $request->designation;
                    $MetaData[5]['user_id'] = $user->id;
                    UserMeta::insert($MetaData);

                    $model = GS::where('meta_key','adminreg_settings')->first();
                    if(!empty($model) && json_decode($model->meta_value)->activate == 'true' && json_decode($model->meta_value)->admin_email != ''){
                        $userDetails['subject'] = json_decode($model->meta_value)->subject;
                        $userDetails['description'] = json_decode($model->meta_value)->description;
                        $userDetails['api_token'] = $api_token;
                        $userDetails['name'] = $request->name;
                        $userDetails['email'] = $request->email;
                        $userDetails['phone'] = $request->phone;
                        Mail::to(json_decode($model->meta_value)->admin_email)->send(new AdminRegister($userDetails));
                    }
					return ['status'=>'successful','message'=>'Successful register!', "token"=>$api_token];
				}catch(\Exception $e){
					if($e instanceOf \Illuminate\Database\QueryException){
						return ['status'=>'error','message'=>'Email already in use!'];
					}else{
                        throw $e;
						return ['status'=>'error','message'=>'Some thing go wrong!'];
					}
				}
		}
	   else{
			return ['status'=>'error','message'=>'fill all required fields!'];
		}
   }

   protected function validateUserMeta($request){

       if($request->has('departments') && $request->has('ministries')  && $request->has('designation')){

           return true;
       }else{
           return false;
       }
   }

   public function forgetPassword(Request $request){

        if(!$request->has('email_id')){
            return ['status'=>'error','message'=>'Required fields are missing!'];
        }
        $model = User::where('email',$request->email_id)->first();
        if(empty($model)){
            return ['status'=>'error','message'=>'Email id not found!'];
        }
        $userName = $model->name;
        $token = str_random(60);
        $model->reset_token = $token;
        $model->save();
        $userDetails['name'] = $userName;
        $userDetails['token'] = $token;

        $model = GS::where('meta_key','forget_settings')->first();
        if(empty($model)){
            return ['status'=>'success','message'=>'Password Changed, But email not configured yet!'];
        }elseif(json_decode($model->meta_value)->activate != 'true'){
            return ['status'=>'success','message'=>'Password Changed, But email not configured yet!'];
        }else{
            $userDetails['subject'] = json_decode($model->meta_value)->subject;
            $userDetails['description'] = json_decode($model->meta_value)->description;
            Mail::to($request->email_id)->send(new ForgetPassword($userDetails));
        }
        return ['status'=>'success','message'=>'New password sent on your email id!'];
   }

   public function validateForgetPassToken($token){

        $model = User::where('reset_token',$token)->first();

        if(empty($model)){
            return ['status'=>'error','message'=>'Invalid token!'];
        }else{
            return ['status'=>'success','message'=>'Valid token!'];
        }
   }

   public function resetUserPassword(Request $request){

        $validate = $this->validateChangePassword($request);
        if(!$validate){
            return ['status'=>'error','message'=>'Required fields are missing!'];
        }

        $model = User::where('reset_token',$request->reset_token)->first();
        $model->password = Hash::make($request->newpassword);
        $model->reset_token = '';
        $model->save();
        return ['status'=>'success','message'=>'Password chnaged successfully!'];
   }

   protected function validateChangePassword($request){

        if($request->has('newpassword') && $request->has('confpassword') && $request->has('reset_token')){

            if($request->newpassword == $request->confpassword){
                return true;
            }else{
                return false;
            }
        }else{

            return false;
        }
   }

}