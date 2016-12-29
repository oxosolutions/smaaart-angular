<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ministrie as MIN;
use Session;
use DB;
use Auth;
use App\MinistriesDepartmentMapping as MDM;
use Yajra\Datatables\Datatables;
class MinistriesController extends Controller
{
    public function index(){

    	$plugins = [
        			'css' => ['datatables'],
        			'js'  => ['datatables','custom' => ['gen-datatables']]
            	];
    	return view('ministries.index',$plugins);
    }

    public function get_ministries(){

    	$model = MIN::withUsers()->get();

    	return Datatables::of($model)
    		   ->addColumn('actions', function($model){
    		   		return view('ministries._actions', ['model'=>$model])->render();
    		   })->make(true);
    }

    public function create(){

        $plugins = [
                    'css' => ['fileupload','select2'],
                    'js'  => ['fileupload','select2','custom'=>['ministry-create']]
                  ];

        return view('ministries.create', $plugins);
    }

    public function store(Request $request){

        $this->modelValidate($request);

        DB::beginTransaction();
        try{

            $model = new MIN($request->except(['ministry_departments','_token']));

            $model->created_by = Auth::user()->id;

            $path = 'min_images';

            if($request->hasFile('ministry_image')){

                $filename = date('Y-m-d-H-i-s')."-".$request->file('ministry_image')->getClientOriginalName();

                $request->file('ministry_image')->move($path, $filename);

                $model->ministry_image = $filename;
            }
            $model->save();
            foreach($request->ministry_departments as $key => $department){

                $depart = new MDM();

                $depart->department_id = $department;

                $model->departments()->save($depart);
            }

            DB::commit();
            Session::flash('success','Successfully added!');
            return redirect()->route('ministries.list');
        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
    }

    protected function modelValidate($request){

        $rules = [

            'ministry_id' => 'required|numeric',
            'ministry_title' => 'required|min:5|max:100',
            'ministry_description' => 'required',
            'ministry_icon' => 'required',
            'ministry_phone' => 'required|numeric',
            'ministry_ministers' => 'required',
            'ministry_order' => 'required|numeric',
            'ministry_image' =>'required | mimes:jpeg,jpg,png',

        ];

        if($request->hasFile('ministry_image')){

            $rules['image'] = 'image';
        }

        $this->validate($request, $rules);
    }

    protected function editmodelValidate($request){

        $rules = [
            'ministry_id' => 'required|numeric',
            'ministry_title' => 'required|min:5|max:100',
            'ministry_description' => 'required',
            'ministry_icon' => 'required',
            'ministry_phone' => 'required|numeric',
            'ministry_ministers' => 'required',
            'ministry_order' => 'required|numeric',
            'ministry_image' =>'required|mimes:jpeg,jpg,png',
        ];

        if($request->hasFile('ministry_image')){

            $rules['image'] = 'image';
        }

        $this->validate($request, $rules);
    }

    public function destroy($id){

        $model = MIN::findOrFail($id);
        try{
            $path = 'min_images/';
            // unlink($path.$model->ministry_image);
            $model->departments()->delete();
            $model->delete();
            Session::flash('success', 'Successfully deleted!');
            return redirect()->route('ministries.list');
        }catch(\Exception $e){

            throw $e;
        }
    }

    public function edit($id){
        try{
                $model = MIN::findOrFail($id);
                $departments = [];
                foreach($model->departments as $key => $value){
                    $departments[] = $value->department_id;
                }
                $plugins = [
                            'departments' => $departments,
                            'model'=>$model,
                            'css' => ['fileupload','select2'],
                            'js'  => ['fileupload','select2','custom'=>['ministry-create']]
                          ];
                return view('ministries.edit',$plugins);
            }
            catch(\Exception $e)
            {
                Session::flash('error','No data found for this.');
                 return redirect()->route('ministries.list');
            }
    }

    public function update(Request $request, $id){

        $this->editmodelValidate($request);
        $model = MIN::find($id);
        DB::beginTransaction();
        try{

            $model->fill($request->except(['ministry_departments','_token']));

            $model->created_by = Auth::user()->id;

            $path = 'min_images';

            if($request->hasFile('ministry_image')){

                $filename = date('Y-m-d-H-i-s')."-".$request->file('ministry_image')->getClientOriginalName();

                $request->file('ministry_image')->move($path, $filename);

                $model->ministry_image = $filename;
            }
            $model->save();

            MDM::where('ministry_id',$id)->delete();
            foreach($request->ministry_departments as $key => $department){


                $depart = new MDM();

                $depart->department_id = $department;

                $model->departments()->save($depart);
            }


            DB::commit();
            Session::flash('success','Successfully added!');
            return redirect()->route('ministries.list');
        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
    }
}
