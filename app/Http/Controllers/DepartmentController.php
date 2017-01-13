<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department as DP;
use Yajra\Datatables\Datatables;
use Auth;
use Session;
use DB;
use Illuminate\Support\Facades\Route;
use App\LogSystem as LOG;
use Carbon\Carbon AS TM;
class DepartmentController extends Controller
{
    protected $ipAdress;
    public function __construct(Request $request)
    { 
      $this->ipAdress =  $request->ip();
      DB::enableQueryLog();  
    }
    public function index(){


    	$plugins = [
        			'css' => ['datatables'],
        			'js'  => ['datatables','custom'=>['gen-datatables']]
    	           ];

    	return view('departments.index',$plugins);
    }


    public function get_departments(){

    	$model = DP::orderBy('id','desc')->withUsers()->get();

    	return Datatables::of($model)
            ->addColumn('actions',function($model){
                return view('departments._actions',['model' => $model])->render();
            })->make(true);
    }

    public function create(){

    	return view('departments.create');
    }

    public function store(Request $request){

    	$this->modelValidate($request);
    	DB::beginTransaction();
    	try{

    		$model = new DP;
	    	$model->dep_code = $request->dep_code;
	    	$model->dep_name = $request->dep_name;
	    	$model->created_by = Auth::user()->id;
	    	$model->save();
	    	DB::commit();
    	} catch(\Exception $e){

    		DB::rollback();
    		throw $e;
    	}
    	

    	Session::flash('success','Successfully created!');

        return redirect()->route('department.list');
    }


    protected function modelValidate($request){

    	$rules = [
        			'dep_code' => 'required|regex:/^[A-Z a-z 0-9]+$/|min:3',
        			'dep_name' => 'required|min:3'
    	       ];

    	$this->validate($request, $rules);
    }


    public function destroy($id){

    	$model = DP::findOrFail($id);

    	try{

    		$model->delete();
    		Session::flash('success','Successfully deleted!');
    	}catch(\Exception $e){

    		throw $e;
    	}

    	return redirect()->route('department.list');
    }
    
    public function edit($id){
        try{
                $model = DP::findOrFail($id);
                return view('departments.edit', ['model'=>$model]);
            }catch(\Exception $e)
            {
                Session::flash('error','No data found for this.');
                return redirect()->route('department.list');

            }
    }

    public function update(Request $request, $id){

        $model = DP::findOrFail($id);

        $this->modelValidate($request);

        DB::beginTransaction();
        try{

            $model->fill($request->except(['_token']));
            $model->save();
            DB::commit();
            Session::flash('success','Successfully update!');
            return redirect()->route('department.list');
        }catch(\Exception $e){

            throw $e;
        }
    }
    public function __destruct() {
        parent::__destruct();
        // $user = Auth::user(); 
        // $uid=  $user->id;        

        // foreach (DB::getQueryLog() as $key => $value){ 

        //   if($value['query'] =="insert into `log_systems` (`user_id`, `type`, `text`, `ip_address`, `updated_at`, `created_at`) values (?, ?, ?, ?, ?, ?)" || $value['query'] =="select * from `log_systems` where `user_id` = ? order by `id` desc limit 1" || $value['query']=="select * from `users` where `users`.`id` = ? limit 1" ||  str_contains($value['query'], 'count(*)')==true)
        //   {  //Not put in log
        //   }else{
        //         $log    = LOG::orderBy('id','desc')->where('user_id',$uid)->first();
        //         $logAr  = json_decode($log->text,true);
        //         $insertTime = $log->created_at;
        //         $currentTime = TM::now();
        //         $addSecond = $insertTime->addSeconds(10);
        //         if(array_key_exists('query', $logAr))
        //         {
        //           if($addSecond > $currentTime  && $logAr['query'] == $value['query'])
        //           {
        //           // dump('not insert log forthis');
        //           }else{
        //             $Lg             =   new LOG;
        //             $Lg->user_id    =   $uid;
        //             $Lg->type       =   "model";            
        //             $Lg->text       =   json_encode(['query'=>$value['query'] , 'value'=>$value['bindings'] ,'time'=> $value['time'],'email'=>$user->email]);
        //             $Lg->ip_address =   $this->ipAdress;
        //             $Lg->save(); 
        //           }
        //         }else{
        //             $Lg             =   new LOG;
        //             $Lg->user_id    =   $uid;
        //             $Lg->type       =   "model";            
        //             $Lg->text       =   json_encode(['query'=>$value['query'] , 'value'=>$value['bindings'] ,'time'=> $value['time'],'email'=>$user->email]);
        //             $Lg->ip_address =   $this->ipAdress;
        //             $Lg->save(); 
        //         }
        //   }
        // }    
      }
}
