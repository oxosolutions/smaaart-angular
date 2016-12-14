<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RolePermissonMapping as RP;
use App\Role;
use App\Permisson;
use App\PermissonRole;

class SettingController extends Controller
{
    //

    public function create()
    {
    return	view('setting.create');
    }

    public function store(Request $request)
    {
dump($request);
   
    		foreach ($request->permisson_id as $key => $value) {
    			# code...
    			$pr =	new PermissonRole($request->except(['_token','read','write','delete']));
    			$pr->role_id =  $request->role_id;
    			$pr->permisson_id = $key;
    			$pr->save();
    		}
			dd($request);

			// "_token" => "eCh6YhTikCFGaBcUYsO57kLpk1HwDi5CNH1xv1vA"
   //    "role_list" => "10"
   //    9 => array:1 [▼
   //      0 => "read"
   //    ]
   //    11 => array:2 [▼
   //      0 => "read"
   //      1 => "write"

    }
}
