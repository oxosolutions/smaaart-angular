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

//use Auth;

class ApiauthController extends Controller
{
    
   public  function Authenicates(Request $request)
    {



 	if(empty ( $request->email ))
		{
			return ['status'=>'error','message'=>'We need to know your e-mail address!'];
		}
		else if(!filter_var($request->email, FILTER_VALIDATE_EMAIL))
		{
				return ['status'=>'error','message'=>'Invalid email format!'];	
		}
		else if($request->password=="")
		{
			return ['status'=>'error','message'=>'We need to know your Password!'];
	
		}
		else if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password]))
		{
			$user = Auth::user();
			return ['status'=>'successful', 'user_detail'=>$user];
		}
		else{
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
    	if($request->name && $request->email && $request->password )
		{
			if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
     			
     			return ['status'=>'error','message'=>'Invalid email format!'];
			 }
				try{
						User::create([
						'name' => $request->name,
						'email' => $request->email,
						'password' => Hash::make($request->password),
						'api_token' => $api_token
						]);

						return ['status'=>'successful','message'=>'Successful register!', "token"=>$api_token];
					}catch(\Exception $e)
						{
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
}

   


