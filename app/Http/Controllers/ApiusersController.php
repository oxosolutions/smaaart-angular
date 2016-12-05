<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\User;
use Session;

class ApiusersController extends Controller
{
    function __construct(){

    	//
    }


    public function index(){

    	$plugins = [

    			'css' => ['datatables'],
    			'js'  => ['datatables','custom'=>['gen-datatables']]
    	];

    	return view('apiusers.index',$plugins);
    }

    public function get_users(){

    	return Datatables::of(User::query())
            ->addColumn('actions',function(){
                return view('apiusers._actions')->render();
            })
            ->make(true);
    }


    public function create(){

    	return view('apiusers.create');
    }

    public function store(Request $request){

        $this->modelValidate($request);
        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'api_token' => $request->token
        ]);

        Session::flash('success','Successfully created!');

        return redirect()->route('api.users');
    }

    protected function modelValidate($request){

        $rules = [

                'name'  => 'min:5|regex:/^[A-Z a-z]+$/',
                'email' => 'required|email|unique:users,email',
                'password' => 'min:6|required',
                'token' => 'required'
        ];

        $this->validate($request, $rules);;
    }
}
