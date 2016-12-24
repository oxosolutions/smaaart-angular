<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\RegisterNewUser;
use Illuminate\Support\Facades\Mail;
class DashboardController extends Controller
{
    function __construct(){

    }

    public function index(){

    	$plugins = [

    	];
    	//Mail::to('rahulsharma841990@gmail.com')->send(new RegisterNewUser('Rahul'));
    	return view('dashboard.index', $plugins);
    }
}
