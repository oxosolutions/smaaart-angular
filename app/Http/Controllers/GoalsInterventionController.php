<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Auth;
use Session;
use DB;
use App\GoalsIntervention as GI;
use App\LogSystem as LOG;
use Carbon\Carbon AS TM;




class GoalsInterventionController extends Controller
{
    //
    protected $ipAdress;
    public function __construct(Request $request)
    { 
      $this->ipAdress =  $request->ip();
      DB::enableQueryLog();  
    }
    public function index(){

    	$plugins = [
        			'css' => ['datatables'],
        			'js' => ['datatables','custom'=>['gen-datatables']]
        	       ];


    	return view('intervention.index',$plugins);
    }

     public function indexData(){

        $model = GI::orderBy('id','desc')->withUsers()->get();

        return Datatables::of($model)
            ->addColumn('actions',function($model){
                return view('intervention._actions',['model' => $model])->render();
            })->make(true);
    }

     public function create(){
    	$plugins = [
        			'css' => ['fileupload'],
        			'js' => ['fileupload','custom'=>['schema-create']]
        	       ];
    	return view('intervention.create',$plugins);
    }

     public function store(Request $request){
       
        $this->modelValidate($request);
    	DB::beginTransaction();
    	try{

    	 	$model = new GI($request->except(['_token']));
	     	$model->created_by = Auth::user()->id;
	     	$path = 'intervention_file';
	     	if($request->hasFile('intervent_image')){

                $filename = date('Y-m-d-H-i-s')."-".$request->file('intervent_image')->getClientOriginalName();

                 $request->file('intervent_image')->move($path, $filename);

                 $model->intervent_image = $filename;
             }

            $model->save();
            
	     	DB::commit();
    	} catch(\Exception $e){

    		DB::rollback();
    		throw $e;
    	}
    	

    	Session::flash('success','Successfully created!');

        return redirect()->route('intervention.list');
     }


    public function destroy($id){

        $model = GI::findOrFail($id);

        try{

            $model->delete();
            Session::flash('success','Successfully deleted!');
        }catch(\Exception $e){

            throw $e;
        }

        return redirect()->route('intervention.list');
    }


    public function edit($id){
        try{
            $model = GI::findOrFail($id);
            return view('intervention.edit', ['model'=>$model, 'js'=>['fileupload','custom'=>['invt-create']],'css'=>['fileupload']]);
            }catch(\Exception $e)
            {
                Session::flash('error','No data found for this.');
                return redirect()->route('intervention.list');

            }
    }


      public function update(Request $request, $id){

        $model = GI::findOrFail($id);

        $this->modelValidate($request);

        DB::beginTransaction();
        try{

            $model->fill($request->except(['_token']));
            $path = 'intervention_file';

            if($request->hasFile('intervent_image')){

                $filename = date('Y-m-d-H-i-s')."-".$request->file('intervent_image')->getClientOriginalName();

                 $request->file('intervent_image')->move($path, $filename);

                 $model->intervent_image = $filename;
             }
            
            $model->save();
            DB::commit();
            Session::flash('success','Successfully update!');
            return redirect()->route('intervention.list');
        }catch(\Exception $e){

            throw $e;
        }
    }


    public function modelValidate($request){

    	$rules = [
    				'intervent_id' => 'required',
    				'intervent_title' => 'required',
    				'intervent_desc' => 'required'
    	         ];

    	$this->validate($request, $rules);
    }

    public function __destruct() {
        parent::__destruct();
        // $uid = Auth::user()->id;          

        // foreach (DB::getQueryLog() as $key => $value){ 

        //   if($value['query'] =="insert into `log_systems` (`user_id`, `type`, `text`, `ip_address`, `updated_at`, `created_at`) values (?, ?, ?, ?, ?, ?)" || $value['query'] =="select * from `log_systems` where `user_id` = ? order by `id` desc limit 1" || $value['query']=="select * from `users` where `users`.`id` = ? limit 1")
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
        //             $Lg->text       =   json_encode(['query'=>$value['query'] , 'value'=>$value['bindings'] ,'time'=> $value['time']]);
        //             $Lg->ip_address =   $this->ipAdress;
        //             $Lg->save(); 
        //           }
        //         }else{
        //             $Lg             =   new LOG;
        //             $Lg->user_id    =   $uid;
        //             $Lg->type       =   "model";            
        //             $Lg->text       =   json_encode(['query'=>$value['query'] , 'value'=>$value['bindings'] ,'time'=> $value['time']]);
        //             $Lg->ip_address =   $this->ipAdress;
        //             $Lg->save(); 
        //         }
        //   }

        // }    

      }

}
