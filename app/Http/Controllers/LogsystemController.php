<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LogSystem AS LOG;
use App\User;
use Carbon\Carbon as TM;


class LogsystemController extends Controller
{
    //

    public function viewLog()
    {

//  $a = array(array('a'=>1), array('b'=>4));
//  echo "<br>";
//  $result = array_reduce($a, 'array_merge', array());
// print_r($result);
//  die;
	//$uName = User::where('id',$id)->first()->name; 

    	$log = LOG::orderBy('id','desc')->limit(100)->get();

    	$plugins = ['log'=>$log];
    	return view('log.index',$plugins);
    }

    public function search_log(Request $request)
    {
    	
    	

			if($request->from && $request->to && $request->user_name)
			{
				$from = TM::parse($request->from)->format('Y-m-d');

				$uName = User::where('id',$request->user_name)->first()->name; 
				$log = LOG::orderBy('id','desc')->whereBetween('created_at', [$request->from, $request->to])->Where('user_id',$request->user_name)->limit(100)->get();

			}
    		else if($request->from && $request->to )
    		{
				$from = TM::parse($request->from)->format('Y-m-d'); 
				$to = TM::parse($request->to)->format('Y-m-d');				
    			$log = LOG::orderBy('id','desc')->whereBetween('created_at', [$from, $to])->limit(100)->get();
    		}
    		else if($request->from)
    		{
    			$from = TM::parse($request->from)->format('y-m-d');
				$log =	LOG::orderBy('id','desc')->whereDate('created_at', '=', $from)->limit(100)->get();
    		}else if($request->user_name && $request->from)
    		{
    			$from = TM::parse($request->from)->format('y-m-d');
				$log =	LOG::orderBy('id','desc')->whereDate('created_at', '>=', $from)
												->Where('user_id',$request->user_name)
												->limit(100)
												->get();
    		}
			else if($request->user_name)
    		{
    			$log = LOG::orderBy('id','desc')->Where('user_id',$request->user_name)->limit(100)->get();
    		}
    		else{
    			$log = LOG::orderBy('id','desc')->get();
    		}


			$plugins = ['log'=>$log];
    	return view('log.index',$plugins);
    		
    }
}
