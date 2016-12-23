<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use DB;
use App\User;
use App\UserMeta as UM;
use App\Designation as DES;
use Session;
use App\Ministrie as MIN;
use App\Department as DEP;
use Hash;
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
        $model = User::get();
    	return Datatables::of($model)
            ->addColumn('actions',function($model){
                return view('apiusers._actions',['model'=>$model])->render();
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
       
        $role_id = (int) $request->role_id[0];
        $this->modelValidate($request);

        DB::beginTransaction();
        try{
                User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    // 'username' => $request->username,
                    'password' => Hash::make($request->password),
                    'role_id' => $role_id,
                    'api_token' => $request->token
                ]);
                DB::commit();
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

        $this->validate($request, $rules);
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

                    $ministryMetaVal[] = $value;

                }

                $minMetaVal = json_encode($ministryMetaVal);
                $ministryMeta = new UM();
                $ministryMeta->key = "ministry";
                $ministryMeta->user_id = $request->user_list;
                $ministryMeta->value = $minMetaVal;
                $ministryMeta->save();


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

                   $depValues[] =  $value;
                }

                $depJsonVal =     json_encode($depValues);
                $departmentMeta  = new UM();
                    $departmentMeta->user_id = $request->user_list;
                    $departmentMeta->key = "department";
                    $departmentMeta->value   =  $depJsonVal;
                    $departmentMeta->save();

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

        public function userDetail($id)
        {

          //  $userName =  User::select('id','name')->where('id',$id)->get();
          //  $ud['name'] = $userName[0]->name;
          //  $ud['user_id'] = $userName[0]->id;
          // $chkDetail = UM::where('user_id',$id)->count();
          // if($chkDetail==0){
          //       Session::flash('error','User Detail not available!');

          //       return redirect()->route('api.users');

          // }

          //  $userDetail = UM::where('user_id',$id)->get();


          //   foreach ($userDetail as $key => $value) {
          //     // echo $value->key ."--->".$value->value."<br>";
          //      if($value->key=="phone")
          //       {
          //          $ud['phone'] = $value->value;
          //       }
          //       if($value->key=="address")
          //       {
          //          $ud['address'] = $value->value;
          //       }
          //       if($value->key=="designation")
          //       {
          //          $ud['designation'] = $value->value;
          //       }
          //       if($value->key=="profile_pic")
          //       {
          //          $ud['profile_pic'] = $value->value;
          //       }
          //       if($value->key=="ministry")
          //       {
          //          $minId = $value->value;
          //       }
          //       if($value->key=="department")
          //       {
          //          $depId = $value->value;
          //       }
          //   }

          //  $DepId =  json_decode(@$depId);
          //  $MinId =   json_decode(@$minId);

          //   $depDetail = DEP::select('id','dep_code','dep_name')->WhereIN('id',$DepId)->get();
          //   $minDetail = MIN::select('id','ministry_id','ministry_title')->whereIn('id',$MinId)->get();

          //  return view('apiusers.user_detail', ['user_detail'=>$ud ,'depDetail'=>$depDetail ,'minDetail' =>$minDetail] );

            // return View::make('apiusers.user_detail')->with(['user_detail'=>$ud,'depDetail'=>$depDetail ,'minDetail' =>$minDetail ]);
        }

        public function edit($id) {

          $model = User::findOrfail($id);
            
         return view('apiusers.edit',['model'=>$model]);

          // $userName =  User::select('id','name','email','password')->where('id',$id)->get();
          // $ud['name'] = $userName[0]->name;
          // $ud['user_id'] = $userName[0]->id;
          // $ud['user_email'] = $userName[0]->email;
          // $ud['user_password'] = $userName[0]->password;
          // // $chkDetail = UM::where('user_id',$id)->count();
          // // if($chkDetail==0){
          // //       Session::flash('error','User Detail not available!');

          // //       return redirect()->route('api.create_users');

          // // }

          //  $userDetail = UM::where('user_id',$id)->get();


          //   foreach ($userDetail as $key => $value) {
          //     // echo $value->key ."--->".$value->value."<br>";
          //      if($value->key=="phone")
          //       {
          //          $ud['phone'] = $value->value;
          //       }
          //       if($value->key=="address")
          //       {
          //          $ud['address'] = $value->value;
          //       }
          //       if($value->key=="designation")
          //       {
          //          $ud['designation'] = $value->value;
          //       }
          //       if($value->key=="profile_pic")
          //       {
          //          $ud['profile_pic'] = $value->value;
          //       }
          //       if($value->key=="ministry")
          //       {
          //          $minId = $value->value;
          //       }
          //       if($value->key=="department")
          //       {
          //          $depId = $value->value;
          //       }
          //   }

          //  $DepId =  json_decode(@$depId);
          //  $MinId =   json_decode(@$minId);

          //   $depDetail = DEP::select('id','dep_code','dep_name')->WhereIN('id',$DepId)->get();
          //   $minDetail = MIN::select('id','ministry_id','ministry_title')->whereIn('id',$MinId)->get();
          //   return view('apiusers.edit', ['user_detail'=>$ud ,'depDetail'=>$depDetail ,'minDetail' =>$minDetail] );

        }
        public function update(Request $request, $id)
        {
            
          
            $role_id = (int) $request->role_id[0];
            $user = User::findOrfail($id);
            // $user->fill($request->except(['_token']));
            $user->name = $request->name;
            $user->email = $request->email;
           
            $user->password = Hash::make($request->password);
            $user->role_id = $role_id;
            $user->api_token = $request->token;
            $user->save();
        }

        public function approved($id)
        {
            
            $approved = User::findOrfail($id);
            $approved->approved = 1;
            $approved->save();
              return redirect()->route('api.users');
        }
        public function unapproved($id)
        {
            $approved = User::findOrfail($id);
            $approved->approved = 0;
            $approved->save();

            return redirect()->route('api.users');

        }
        public function editmeta($id)
        {
          $meta = UM::select('id','key','value')->where('user_id',$id)->get();//->where();
             foreach ($meta as  $value) {
                if($value->key == "ministry")
                { 
                  $minData =json_decode($value->value);
                 // echo  $minCount = count($minData);
                 //  for($i=0; $i<$minCount; $i++)
                 //  {
                 //    $min[] $minData[$i];
                 //  }
                }
                //dump($value);
             }
             dd($minData);

           $plugins = [

                'css' => ['fileupload','select2'],
                'js'  => ['fileupload','select2','custom'=>['api-user']],
                'model'=> $meta,
                'minData' =>$minData
        ];
          return view('apiusers.editmeta',$plugins);
        }
        public function updatemeta(Request $request , $id)
        {

          dd($request);

        }

}
