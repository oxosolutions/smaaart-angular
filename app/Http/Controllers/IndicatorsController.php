<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Indicator as IC;
use Auth;
use Session;
use DB;
use App\LogSystem as LOG;
use Carbon\Carbon AS TM;
class IndicatorsController extends Controller
{
    protected $ipAdress;
    public function __construct(Request $request)
    { 
      $this->ipAdress =  $request->ip();
      DB::enableQueryLog();  
    }

    public function index(){

    	$plugins = [

    			'css'  => ['datatables'],
    			'js'   => ['datatables','custom'=>['gen-datatables']],
    	];

    	return view('indicators.index',$plugins);
    }

    public function indexData(){

    	$model = IC::orderBy('id','desc')->get();
    	return Datatables::of($model)
            ->addColumn('actions',function($model){
                return view('indicators._actions',['model' => $model])->render();
            })->editColumn('created_by',function($model){
            	return $model->createdBy->name;
            })->editColumn('targets_id', function($model){
            	return $model->targets->target_title;
            })->make(true);
    }

    public function create(){

    	return view('indicators.create');
    }

    public function store(Request $request){

    	$this->modelValidate($request);

    	DB::beginTransaction();
    	try{

    		$model = new IC($request->except(['_token']));
    		$model->created_by = Auth::user()->id;
    		$model->save();
    		DB::commit();
    		Session::flash('success','Successfully created!');
    		return redirect()->route('indicators.list');
    	}catch(\Exception $e){

    		DB::rollback();
    		throw $e;
    	}
    }

    public function modelValidate($request){

    	$rules = [
    				'indicator_title'  => 'required',
    				'targets_id'       =>  'required'
    	         ];

    	$this->validate($request, $rules);
    }

    public function edit($id){
        try{
    	   $model = IC::findOrFail($id);
    	   return view('indicators.edit',['model'=>$model]);
        }catch(\Exception $e)
        {
            Session::flash('error','No data found for this');
            return redirect()->route('indicators.list');
        }
    }

    public function update(Request $request, $id){

    	$model = IC::findOrFail($id);
    	$this->modelValidate($request);
    	DB::beginTransaction();
    	try{
    		$model->fill($request->except(['_token']));
    		$model->save();
    		DB::commit();
    		Session::flash('success','Successfully updated!');
    		return redirect()->route('indicators.list');
    	}catch(\Exception $e){

    		DB::rollback();

    		throw $e;
    	}
    }

    public function destroy($id){

    	$model = IC::findOrFail($id);
    	try{
    		$model->delete();
    		Session::flash('success','Successfully deleted!');
    		return redirect()->route('indicators.list');
    	}catch(\Exception $e){

    		throw $e;
    	}
    }
    public function __destruct() {
        $uid = Auth::user()->id;          

        foreach (DB::getQueryLog() as $key => $value){ 

          if($value['query'] =="insert into `log_systems` (`user_id`, `type`, `text`, `ip_address`, `updated_at`, `created_at`) values (?, ?, ?, ?, ?, ?)" || $value['query'] =="select * from `log_systems` where `user_id` = ? order by `id` desc limit 1" || $value['query']=="select * from `users` where `users`.`id` = ? limit 1")
          {  //Not put in log
          }else{
                $log    = LOG::orderBy('id','desc')->where('user_id',$uid)->first();
                $logAr  = json_decode($log->text,true);
                $insertTime = $log->created_at;
                $currentTime = TM::now();
                $addSecond = $insertTime->addSeconds(10);
                if(array_key_exists('query', $logAr))
                {
                  if($addSecond > $currentTime  && $logAr['query'] == $value['query'])
                  {
                  // dump('not insert log forthis');
                  }else{
                    $Lg             =   new LOG;
                    $Lg->user_id    =   $uid;
                    $Lg->type       =   "model";            
                    $Lg->text       =   json_encode(['query'=>$value['query'] , 'value'=>$value['bindings'] ,'time'=> $value['time']]);
                    $Lg->ip_address =   $this->ipAdress;
                    $Lg->save(); 
                  }
                }else{
                    $Lg             =   new LOG;
                    $Lg->user_id    =   $uid;
                    $Lg->type       =   "model";            
                    $Lg->text       =   json_encode(['query'=>$value['query'] , 'value'=>$value['bindings'] ,'time'=> $value['time']]);
                    $Lg->ip_address =   $this->ipAdress;
                    $Lg->save(); 
                }
          }

        }    

      }
}
