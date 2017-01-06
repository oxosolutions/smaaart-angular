<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LogSystem AS LOG;
use App\User;

class LogsystemController extends Controller
{
    //

    public function viewLog($id)
    {
    	$uName = User::where('id',$id)->first()->name; 

    	$log = LOG::orderBy('id','desc')->Where('user_id',$id)->get();
//     	dump($log);
//     	 foreach ($log as $key => $value) {
// //dump($value->user_id);
//     		$text = json_decode($value->text, true);
//     		if(array_key_exists('query', $text))
//     		{
//     			echo '<br>'. $text['query'];
//     		}else{
//     			echo '<br>'. $text['route'];
//     		}
//     	 }

    	$plugins = ['log'=>$log, "name"=>$uName];
    	return view('log.index',$plugins);
    }

    public function search_log(Request $request)
    {
    	#parameters: array:4 [▼
      // "_token" => "KUvYhZjClsJ7GiiBJCghRbcw1mTEY6C9gI5fZfPw"
      // "user_name" => "user name"
      // "from" => "from"
      // "to" => "to"

      			
    		// if($request->user_name)
    		// {
    		// 	array_push($Where,['name'=>$request->user_name])
    		// }
    	// $reservations = Reservation::whereBetween('reservation_from', [$from_from, $to_from])
     //            ->orWhereBetween('reservation_to', [$from_to, $to_to])
     //            ->get();
    		///$plugins  = Array();
			if($request->from && $request->to && $request->user_name)
			{
				$uName = User::where('id',$request->user_name)->first()->name; 
				$log = LOG::orderBy('id','desc')->whereBetween('created_at', [$request->from, $request->to])->Where('user_id',$request->user_name)->get();
				//array_push($plugins, array("name"=>$uName , 'log'=>$log ));

			}
    		else if($request->from && $request->to )
    		{
    			$log = LOG::orderBy('id','desc')->whereBetween('created_at', [$request->from, $request->to])->get();
    			//array_push($plugins, array('log'=>$log ));
    		}
    		else if($request->from)
    		{
    			//echo "from Date only"; 
				$log =	LOG::orderBy('id','desc')->whereDate('created_at', '>', $request->from)->get();
				//array_push($plugins, array('log'=>$log ));    			
    		}


			$plugins = ['log'=>$log];
    	return view('log.index',$plugins);
    		
    }
}
