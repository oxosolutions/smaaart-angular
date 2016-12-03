<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MinistriesController extends Controller
{
    public function index(){

    	$plugins = [

    			'css' => ['datatables'],
    			'js'  => ['datatables','custom']
    	];
    	
    	return view('ministries.index',$plugins);
    }
}
