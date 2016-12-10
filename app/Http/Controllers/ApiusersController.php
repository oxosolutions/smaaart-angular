<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use DB;
use App\User;
use App\UserMeta as UM;
use App\Designation as DES;
use Session;

class ApiusersController extends Controller
{
    function __construct(){
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
        $plugins = [

                'css' => ['fileupload','select2'],
                'js'  => ['fileupload','select2','custom'=>['api-user']]
        ];
    	return view('apiusers.create',$plugins);
    }

    public function store(Request $request){
        print_r($request->session()->get('key'));
        exit();
        $this->modelValidate($request);

        DB::beginTransaction();
        
        try{
                User::create([
                    'name' => $request->name,
                    
                    'email' => $request->email,
                    'username' => $request->username,
                    'password' => bcrypt($request->password),
                    'api_token' => $request->token
                ]);

                Session::flash('success','Successfully created!');

                return redirect()->route('api.users');

            }catch(\Exception $e){

            DB::rollback();
            throw $e;
        } 
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

     protected function metaValidate($request){

        $rules = [
                'user_list'=>'required',
                'address'=> 'required',
                'ministry'=>'required',
                'department'=>'required',
                'designation'=>'required',
                'phone'=>'required',
                'profile_pic'=>'required'
              ];

        $this->validate($request, $rules);;
    }

    public function  createUserMeta()
    {
         $plugins = [

                'css' => ['fileupload','select2'],
                'js'  => ['fileupload','select2','custom'=>['api-user']]
        ];

        return view('apiusers.fill_user_meta',$plugins);
    }


    public function storeUserMeta( Request $request){


        $this->metaValidate($request);

        DB::beginTransaction();
         try{
               if(!is_numeric($request->designation))
               {  
                     $chkDes = DES::where(['designation'=>$request->designation])->get()->count();
                     if($chkDes==0){
                        $newDes =  new DES();
                        $newDes->designation = $request->designation;
                        $newDes->save();
                        $request->designation = $newDes->id;
                     }
                }


                foreach ($request->ministry as $key => $value){

                    $ministryMeta = new UM();
                    $ministryMeta->key = "ministry";
                    $ministryMeta->user_id = $request->user_list;
                    $ministryMeta->value  = $value;
                    $ministryMeta->save();
                }
               
                $phoneMeta = new UM();
                $phoneMeta->key = "phone";
                $phoneMeta->user_id = $request->user_list;
                $phoneMeta->value  =  $request->phone;
                $phoneMeta->save();

                $adrsMeta = new UM();
                $adrsMeta->key = "address";
                $adrsMeta->user_id = $request->user_list;
                $adrsMeta->value  =  $request->address;
                $adrsMeta->save();

                foreach($request->department as $key => $value){
                
                    $departmentMeta  = new UM();
                    $departmentMeta->user_id = $request->user_list;
                    $departmentMeta->key = "department";
                    $departmentMeta->value   =  $value;
                    $departmentMeta->save();
                }

                $designationMeta  = new UM();
                $designationMeta->user_id = $request->user_list;
                $designationMeta->key =     "designation";
                $designationMeta->value   =  $request->designation;
                $designationMeta->save();

                $proPic  = new UM();
                $path = 'profile_pic';
                if($request->hasFile('profile_pic')){

                    $filename = date('Y-m-d-H-i-s')."-".$request->file('profile_pic')->getClientOriginalName();

                    $request->file('profile_pic')->move($path, $filename);
                    $proPic->key = "profile_pic";
                    $proPic->user_id = $request->user_list;
                    $proPic->value = $filename;
                    $proPic->save();
                }
                DB::commit();
                Session::flash('success','Successfully created User Meta!');
                return redirect()->route('api.users');

            }catch(\Exception $e){
                   
                DB::rollback();   
            }
       
        }

    
}
