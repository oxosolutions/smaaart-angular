<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Auth;
use Session;
use DB;
use App\GoalsIntervention as GI;



class GoalsInterventionController extends Controller
{
    //
    public function index(){

    	$plugins = [

    			'css' => ['datatables'],
    			'js' => ['datatables','custom'=>['gen-datatables']]
    	];


    	return view('intervention.index',$plugins);
    }

     public function indexData(){

        $model = GI::withUsers()->get();

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

        $model = GI::findOrFail($id);

        return view('intervention.edit', ['model'=>$model, 'js'=>['fileupload','custom'=>['invt-create']],'css'=>['fileupload']]);
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
}
