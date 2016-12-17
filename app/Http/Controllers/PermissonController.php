<?php

namespace App\Http\Controllers;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
Use App\Permisson;
use App\PermissonRouteMapping as PRM;
use DB;
use Session;

class PermissonController extends Controller
{
    //
	public function index()
    {
    		$plugins = [ 'css'=> ['datatables'],
    					 'js'=>['datatables', 'custom'=>['gen-datatables'] ]	];

    		return view('permisson.index', $plugins);

    }

    public function list_permisson()
    {
			$model = Permisson::get();
			return Datatables::of($model)
			->addColumn('actions',function($model){
					return view('permisson._actions',['model'=>$model])->render();
			    })
			->make(true);
		}


	public function create()
    {
			return view('permisson.create');
    }

    public function store(Request $request)
    {
			//dd($request->route);
    		$this->modelValidation($request);
			DB::beginTransaction();
			try{
	    		$permisson = new Permisson($request->except(['_token','route']));
       //          $explodeRoute = explode('.',$request->route);
	    		// $permisson->route = $explodeRoute[0];
	    		//$permisson->route = $request->route;
	    		$permisson->save();
	    		$permisson_id =  $permisson->id;
	     		
	    		  $routeSize = count($request->route);
    	for($i=0; $i<$routeSize; $i++)
	    	{	
	    		$pr_map = new PRM($request->except(['_token','updated_at']));
	    		$pr_map->permisson_id = $permisson_id;
	    		$pr_map->route = $request->route[$i];
	    		$pr_map->route_for =  $request->routeFor[$i];
	    		$pr_map->save(); 
	    	}

			DB::commit();

	    	Session::flash('success',"Permisson Successful Created!");

	    	}catch(\Exception $e)
	    	{
                throw $e;
	    		if($e instanceOf \Illuminate\Database\QueryException){

	    				Session::flash('error','Permisson name already Created!');

					}else{
					    Session::flash('error','Try again!');

					}

	    		DB::rollback();
	    	}

	         return redirect()->route('permisson.list');
    }

    public function edit($id)
    {
			$role = Permisson::findOrFail($id);
			return view('permisson.edit',['model'=>$role]);

    }

    public function update(Request $request, $id)
    {
			$permisson = Permisson::findOrFail($id);
			$this->modelValidation($request);
			DB::beginTransaction();
			try{
				$permisson->fill($request->except(['_token']));
				//$role->name = $request->name;
				$permisson->save();
				DB::commit();
				Session::flash('success',"Updated Permisson Successful Created!");

			}catch(\Exception $e)
			{
				if($e instanceOf \Illuminate\Database\QueryException){

					Session::flash('error','Permisson name already Created!');

				}else{
				Session::flash('error','Try again!');

				}
			}

     	return redirect()->route('permisson.list');
 	}

	 public function destroy($id)
	 {

		$model  = Permisson::findOrFail($id);
	 	try{
	 			$model->delete();
		 	}catch(\Exception $e)
		 {
		 	throw $e;
		 }
		 	return redirect()->route('permisson.list');

	 }

    protected function modelValidation($request)
    {

    	$rules =['name'=>'required'];

    	$this->validate($request, $rules);

    }



}
