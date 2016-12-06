<?php

namespace App\Http\Controllers\Services;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use Apiauth;
 //use Illuminate\Auth;
//use Illuminate\Foundation\Auth;
use Validator;
use Illuminate\Support\Facades\Auth;
//use Auth;

class ApiauthController extends Controller
{
    
   public  function Authenicates(Request $request)
    {

 	if($request->email=="")
		{
			return ['status'=>'error','message'=>'We need to know your e-mail address!'];
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
    

    public function Register(Request $request)
    {
    	echo "res";
    	//print_r($request);
    }

   

}
