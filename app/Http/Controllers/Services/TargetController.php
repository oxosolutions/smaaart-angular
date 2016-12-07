<?php

namespace App\Http\Controllers\Services;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\GoalsTarget as GT;
class TargetController extends Controller
{
 
 	public function getTarget()
 	{
 		$model = GT::withUsers()->get();
		return $model;
 	}
}
