<?php

namespace App\Http\Controllers;
use Yajra\Datatables\Datatables;
use Session;
use Illuminate\Http\Request;
use App\GoalFact as GF;
use Auth;
use DB;

class FactController extends Controller
{
 
	public function create()
	{
	   return view('fact.create');
	}
	public function store(Request $request)
	{

		$fact = new GF();//($request->except(['_token','fact_id']));
		$fact->fact_id = $request->fact_id;
	    $fact->fact_title = $request->fact_title;
	    $fact->fact_desc =  $request->fact_desc;
	    $fact->created_by = Auth::user()->id;
	    $path = 'fact_image';
	     	if($request->hasFile('fact_image')){

                $filename = date('Y-m-d-H-i-s')."-".$request->file('fact_image')->getClientOriginalName();

                 $request->file('fact_image')->move($path, $filename);

                 $fact->fact_image = $filename;
             }
	    $fact->save();

	    return redirect()->route('fact.list');
	}
	public function index()
	{
		$plugins = [
        			'css' => ['datatables'],
        			'js' => ['datatables','custom'=>['gen-datatables']]
        	       ];


    	return view('fact.index',$plugins);
	}
	public function indexData()
	{
			 $model = GF::orderBy('id','desc')->get();

        return Datatables::of($model)
            ->addColumn('actions',function($model){
                return view('fact._actions',['model' => $model])->render();
            })->make(true);
	}
	public function edit($id)
	{
		 try{
            $model = GF::findOrFail($id);
            return view('fact.edit', ['model'=>$model, 'js'=>['fileupload','custom'=>['invt-create']],'css'=>['fileupload']]);
            }catch(\Exception $e)
            {
                Session::flash('error','No data found for this.');
                return redirect()->route('fact.list');

            }

	}

	 public function update(Request $request, $id){      
     
      try{
         	
        	DB::beginTransaction();
        	$model = GF::findOrFail($id);
            $model->fill($request->except(['_token']));
            $path = 'fact_image';

            if($request->hasFile('fact_image')){

                $filename = date('Y-m-d-H-i-s')."-".$request->file('fact_image')->getClientOriginalName();

                 $request->file('fact_image')->move($path, $filename);
                 $model->fact_image = $filename;
             }
            $model->save();
            DB::commit();
            Session::flash('success','Successfully update!');
        }catch(\Exception $e){

            throw $e;
        }
        return redirect()->route('fact.list');

    }


	public function delete($id)
	{	try{
			$model = GF::findOrFail($id);
			$model->delete();
			Session::flash('success','Successfully deleted!');

		}catch(\Exception $e)
		{
			Session::flash('error','Not deleted Try Again!');
			throw $e;
		}

		return redirect()->route('fact.list');


	}
}
