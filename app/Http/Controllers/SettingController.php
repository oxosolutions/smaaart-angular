<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RolePermissonMapping as RP;
use App\Role;
use App\Permisson;

class SettingController extends Controller
{
    //

    public function create()
    {
    return	view('setting.create');
    }
}
