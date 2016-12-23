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
			return ['status'=>'successful', 'user_detail'=>$user];
		}else{
			return ['status'=>'error','message'=>'Email Password not exist!'];
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
					return ['status'=>'successful','message'=>'Successful register!', "token"=>$api_token];
				}catch(\Exception $e){
					if($e instanceOf \Illuminate\Database\QueryException){
						return ['status'=>'error','message'=>'Email already in use!'];
					}else{
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
}