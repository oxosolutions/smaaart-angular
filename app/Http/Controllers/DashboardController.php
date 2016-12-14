<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function __construct(){

    }

    public function index(){

    	$plugins = [

    	];
    	return view('dashboard.index', $plugins);
    }
}
