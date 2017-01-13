<?php

namespace App\Http\Controllers\Services;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\LogSystem AS LOG;
use Carbon\Carbon as TM;

class LogApiController extends Controller
{
 
	public function logActivity(Request $request)
	{
	 	
	 	if($request->from && $request->to && $request->user_id)
			{
				$from = TM::parse($request->from)->format('Y-m-d');

			//	$uName = User::where('id',$request->user_id)->first()->name; 
				$log = LOG::orderBy('id','desc')->whereBetween('created_at', [$request->from, $request->to])->Where('user_id',$request->user_id)->get();

			}
    		else if($request->from && $request->to )
    		{
				$from = TM::parse($request->from)->format('Y-m-d'); 
				$to = TM::parse($request->to)->format('Y-m-d');				
    			$log = LOG::orderBy('id','desc')->whereBetween('created_at', [$from, $to])->get();
    		}
    		else if($request->user_id && $request->from)
    		{
    			$from = TM::parse($request->from)->format('y-m-d');
				$log =	LOG::orderBy('id','desc')->whereDate('created_at', '>=', $from)
												->Where('user_id',$request->user_id)
												->get();
    		}else if($request->user_id && $request->to)
    		{
    			$to = TM::parse($request->to)->format('y-m-d');
				$log =	LOG::orderBy('id','desc')->whereDate('created_at', '>=', $to)
												->Where('user_id',$request->user_id)
												->get();
    		}
    		else if($request->from || $request->to)
    		{
    					if($request->from)
    					{
    						$passValue = $request->from;
    					}else if($request->to){
    						$passValue = $request->to;
    					}
    			$to = TM::parse($passValue)->format('y-m-d');
				$log =	LOG::orderBy('id','desc')->whereDate('created_at', '=', $to)->get();
    		}
    		else if($request->user_id)
	    		{
	    			$log = LOG::orderBy('id','desc')->Where('user_id',$request->user_id)->get();
	    		}
			else{
				echo "all ";
				$log = LOG::orderBy('id','desc')->get();		
    		}

		
		return ['log'=>$log];
	}
	public function logFilter(Request $request)
	{
		
		if($request->user_id)
    		{
    			$log = LOG::orderBy('id','desc')->Where('user_id',$request->user_id)->get();
    		}

		return ['log'=>$log];
	}

}
