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
use Auth;
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

    public function delete($id)
    { 
       $model  = User::findOrFail($id);
            try{
                    UM::where('user_id',$id)->delete();
                    $model->delete();
              }catch(\Exception $e)
             {
             throw $e;
             }
        return redirect()->route('api.users');
    }

    protected function modelValidate($request){

            $rules = [

                'name'  => 'min:5|regex:/^[A-Z a-z]+$/',
                'email' => 'required|email|unique:users,email',
                'password' => 'min:6|required',
                'token' => 'required'
                    ];

        $this->validate($request, $rules);
    }

     protected function metaValidate($request){

        $rules = [               
                  'address'=> 'required',
                  'ministry'=>'required',
                  'department'=>'required',
                  'designation'=>'required',
                  'phone'=>'required|min:10|max:12',
                  'profile_pic'=>'required'
              ];

        $this->validate($request, $rules);
    }

    protected function editmetaValidate($request){

        $rules = [               
                  'address'=> 'required',
                  'ministry'=>'required',
                  'department'=>'required',
                  'designation'=>'required',
                  'phone'=>'required|min:10|max:12',
                ];

        $this->validate($request, $rules);
    }

    public function  createUserMeta($user_id)
    {
         $plugins = [
                    'css' => ['fileupload','select2'],
                    'js'  => ['fileupload','select2','custom'=>['api-user']],
                    'user_id' => $user_id,
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
                throw $e;
            }
        }

        public function userDetail($id)
        {
              $userName =  User::select('id','name','email')->where('id',$id)->get();
              $ud['name'] = $userName[0]->name;
              $ud['email'] = $userName[0]->email;
              $ud['user_id'] = $userName[0]->id;
              $chkDetail = UM::where('user_id',$id)->count();
          if($chkDetail==0){
                Session::flash('error','User Detail not available!');
                return redirect()->route('api.users');
              }

           $userDetail = UM::where('user_id',$id)->get();
            foreach ($userDetail as $key => $value) {
               if($value->key=="phone")
                {
                   $ud['phone'] = $value->value;
                }
                if($value->key=="address")
                {
                   $ud['address'] = $value->value;
                }
                if($value->key=="designation")
                {
                   $ud['designation'] = $value->value;
                }
                if($value->key=="profile_pic")
                {
                   $ud['profile_pic'] = $value->value;
                }
                if($value->key=="ministry")
                {
                   $minId = $value->value;
                }
                if($value->key=="department")
                {
                   $depId = $value->value;
                }
            }

          $DepId =  json_decode(@$depId);
          $MinId =   json_decode(@$minId);

          $depDetail = DEP::select('id','dep_code','dep_name')->WhereIN('id',$DepId)->get();
          $minDetail = MIN::select('id','ministry_id','ministry_title')->whereIn('id',$MinId)->get();

            return view('apiusers.user_detail', ['user_detail'=>$ud ,'depDetail'=>$depDetail ,'minDetail' =>$minDetail] );
            return View::make('apiusers.user_detail')->with(['user_detail'=>$ud,'depDetail'=>$depDetail ,'minDetail' =>$minDetail ]);
        }

        public function edit($id) {

          $model = User::findOrfail($id);
          return view('apiusers.edit',['model'=>$model]);
        }
        public function update(Request $request, $id)
        {
            $role_id = (int) $request->role_id[0];
            $user = User::findOrfail($id);
            DB::beginTransaction();
            try{
                  $user->name = $request->name;
                  $user->email = $request->email;
                   if(!empty($request->new_password))
                   {
                       $user->password = Hash::make($request->new_password);
                   }            
                  $user->role_id = $role_id;
                  $user->api_token = $request->token;
                  $user->save();
                  DB::commit();
                  Session::flash('success','User updated Successfully');
                }catch(\Exception $e)
                {
                  DB::rollback();
                  throw $e;
                }

           return redirect()->route('api.users');
        }

        public function approved($id)
        {
            $approved = User::findOrfail($id);
            DB::beginTransaction();
            try{
                $approved->approved = 1;
                $approved->save();
                DB::commit();
              }catch(\Exception $e)
                {
                  DB::rollback();
                  throw $e;
                }
                return redirect()->route('api.users');
                
        }
        public function unapproved($id)
        {
            $approved = User::findOrfail($id);
            DB::beginTransaction();
            try{
                  $approved->approved = 0;
                  $approved->save();
                  DB::commit();
                }catch(\Exception $e)
                {
                  DB::rollback();
                  throw $e;
                }
            return redirect()->route('api.users');
        }
        public function editmeta($id)
        {      
              $chkmeta =  UM::where('user_id',$id)->count(); 
              if($chkmeta ==0)
              {
                  return redirect()->route('api.users');
              }
              $meta = UM::select('id','key','value')->where('user_id',$id)->get();//->where();
             $depChk = $minChk = $desChk = $picChk = $phChk = $adrsChk =0;
             foreach ($meta as  $value) {
                    if($value->key == "address")
                      { 
                        $adrsChk =1;
                        $address = $value->value;
                      }elseif($adrsChk ==0){ $address ="";}
                    if($value->key == "phone")
                      {
                        $phChk = 1;
                        $phone = $value->value;
                      }elseif($phChk ==0){ $phone ="";}
                    if($value->key == "designation")
                      {
                        $desChk =1;
                        $designation = $value->value;
                      }elseif($desChk ==0){ $designation =""; }
                   if($value->key == "profile_pic")
                      { 
                        $picChk =1;
                        $profile_pic = $value->value;
                      }elseif($picChk ==0){ $profile_pic ="";}             
                    if($value->key == "ministry")
                      { 
                        $minData =json_decode($value->value);
                        $minCount = count($minData);
                        
                            for($i=0; $i<$minCount; $i++)
                            {
                                $minChk  =1;
                                $mdata[$minData[$i]]=$minData[$i]; 
                            }
                          
                        }elseif($minChk==0){ $mdata['']=''; }
                      if($value->key == "department")
                      { 
                        $depData =json_decode($value->value);
                        $depCount = count($depData);
                        for($j=0; $j<$depCount; $j++)
                        { 
                            $depChk =1;
                            $dep[$depData[$j]]=$depData[$j]; 
                        }
                      }elseif($depChk==0){ $dep[''] ='';  }
             }
                 $plugins = [
                              'css'     =>  ['fileupload','select2'],
                              'js'      =>  ['fileupload','select2','custom'=>['api-user']],
                              'model'   =>  @$meta,
                              'id'      =>  $id,
                              'minData' =>  @$mdata,
                              'address' =>  @$address,
                              'department' => @$dep,
                              'phone'   =>    @$phone,
                              'designation' =>  @$designation,
                              'profile_pic' =>  @$profile_pic
                            ];
          return view('apiusers.editmeta',$plugins);
        }
        public function updatemeta(Request $request , $id)
        {
          $this->editmetaValidate($request);
          DB::beginTransaction();
          try{
              UM::where('user_id',$id)->delete();
              $request->user_list = $id;
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
                    else{
                        $proPic->key = "profile_pic";
                        $proPic->user_id  = $request->user_list;
                        $proPic->value    = $request->current_pic;
                        $proPic->save();
                    }
                    DB::commit();
                    Session::flash('success','User Meta Updated Successfully.');
                }catch(\Exception $e)
                {
                  DB::rollback();

                }    
                return redirect()->route('api.users');

        }

        public function approveUser($from = 0, $api_token = 0){
            if($from == 'email' && $api_token != 0){
                $model = User::where('api_token',$api_token)->update(['approved'=>1]);
                if($model){
                    return view('approvel.approved');
                }else{
                    return view('approvel.approved');
                }
            }else{
                  
                return view('approvel.not-approved');
            }
        }

}
