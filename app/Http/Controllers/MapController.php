<?php

namespace App\Http\Controllers;
use Yajra\Datatables\Datatables;
use Session;

use Illuminate\Http\Request;
use App\Map;
class MapController extends Controller
{
    public function create()
    {
    	return view('map.create');
    }

    public function save(Request $request)
    {
    	$map  =	new Map( $request->except(['_token']));
    	$map->save();
    	Session::flash('success','Data Create Successfully!');

    	return redirect()->route('map.list');
    }

    public function index()
    {
    	$plugins = [
        			'css' => ['datatables'],
        			'js' => ['datatables','custom'=>['gen-datatables']]
        	       ];
    	return view('map.index',$plugins);
    }

    public function indexData()
    {
    	 $model = Map::orderBy('id','desc')->get();
			return Datatables::of($model)
            ->addColumn('actions',function($model){
                return view('map._actions',['model' => $model])->render();
            })->make(true);
    }
    public function edit($id)
    {	
    	try{
    		$model = Map::findOrFail($id);
    		return view('map.edit',['model'=>$model]);
    	}catch(\Exception $e)
    	{
    		Session::flash('error','No data found for this.');
            return redirect()->route('map.list');
    	}
    }
    public function update(Request $request , $id)
    {	
    	if($id==1)
    	{
    		$request->parent = "0";
    	}
		try{
	    	$model = Map::findOrFail($id);
	    	$model->fill($request->except(['_token']));
	    	$model->parent = $request->parent;
	    	$model->save();
	    	Session::flash('success','Data Update Successfully!');
	    }catch(\Exception $e){
	    	Session::flash('error','Something goes wrong not update data try Again');
	    }
    	return redirect()->route('map.list');	
    }

    public function statusEnable($id){
			
    		Map::where('id',$id)->update(['status'=>'enable']);
	    	Session::flash('success','Enable Status Successfully.');

    		return redirect()->route('map.list');
			
    }

    public function statusDisable($id){
			Map::where('id',$id)->update(['status'=>'disable']);
	    	Session::flash('success','Enable Status Successfully.');
    		return redirect()->route('map.list');
    }


}
