<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\User;

class ApiusersController extends Controller
{
    function __construct(){

    	//
    }


    public function index(){

    	$plugins = [

    			'css' => ['datatables'],
    			'js'  => ['datatables','custom']
    	];

    	return view('apiusers.index',$plugins);
    }

    public function get_users(){

    	return Datatables::of(User::query())->make(true);
    }


    public function create(){

    	
    }
}
