<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VisualController extends Controller
{
    function index(){
    	return view('visual.index');
    }
}
