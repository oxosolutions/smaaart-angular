<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Database\Query;
use Session;
use DB;
use Auth;
use App\Goal;
use App\GoalsMinistryMapping as GMM;
use App\GoalsInterventionsMappings as GIM;
use App\GoalsResourcesMappings as GRM;
use App\GoalsTargetMappings as GTM;
use App\GoalsSchemasMappings as GSM;
class GoalsController extends Controller
{
    public function index(){

    	$plugins = [
        			'css' => ['datatables','icheck'],
        			'js'  => ['datatables','icheck', 'custom' => ['gen-datatables']]
    	           ];

    	return view('goals.index', $plugins);
    }

    public function goalsList(){

    	$model = Goal::WithUsers()->get();

    	return Datatables::of($model)
                ->addColumn('selector', '<input type="checkbox" name="items[]" class="icheckbox_minimal-blue item-selector" value="{{$id}}" >')
    		   ->addColumn('actions', function($model){
                    return view('goals._actions', ['model'=>$model])->render();
               })->make(true);
    }

    public function create(){

        $plugins = [
        			'css' => ['select2'],
        			'js' => ['select2','custom'=>['goals-create']]
    	           ];
    	return view('goals.create',$plugins);
    }

    public function store(Request $request){

        //$this->modelValidate($request);
        if($request->goal_number =="" && $request->goal_title =="" &&  $request->goal_tagline =="" &&  $request->goal_description=="" && $request->goal_url  =="" && $request->goal_icon =="" && $request->goal_icon_url=="" && $request->goal_color_hex =="" &&  $request->goal_color_rgb =="" && $request->goal_color_rgb_a =="" && $request->goal_opacity=="" && $request->goal_nodal_ministry =="" && !$request->goal_other_ministries && !$request->goal_schemes && !$request->goal_interventions  && !$request->goal_targets && !$request->goal_resources )
        {
            return redirect()->route('goals.create');
        }
      
       DB::beginTransaction();

        try{

            $model = new Goal($request->except(['goal_other_ministries','_token','goal_schemes','goal_interventions','goal_targets','goal_resources']));

            $model->created_by = Auth::user()->id;

            $model->save();
            if(!empty($request->goal_other_ministries))
            {    foreach($request->goal_other_ministries as $key => $value){

                    $minis = new GMM();
                    $minis->ministry_id = $value;
                    $model->ministry()->save($minis);
                }
            }
            if(!empty($request->goal_schemes)){

                foreach ($request->goal_schemes as $key => $value) {

                   $schemaObj = new GSM();

                   $schemaObj->schemas_id = $value;

                   $model->schema()->save($schemaObj);
                }
            }

            if(!empty($request->goal_interventions)){
                foreach ($request->goal_interventions as $key => $value) {

                   $intervObj = new GIM();

                   $intervObj->interventions_id = $value;

                   $model->intervention()->save($intervObj);
                }
            }
            if(!empty($request->goal_targets))
            {        
                foreach ($request->goal_targets as $key => $value) {

                   $targetObj = new GTM();

                   $targetObj->targets_id = $value;

                   $model->target()->save($targetObj);
                }
            }

            if(!empty($request->goal_resources)){

                foreach ($request->goal_resources as $key => $value) {

                   $resourceObj = new GRM();

                   $resourceObj->resources_id = $value;

                   $model->resources()->save($resourceObj);
                }
            }

            DB::commit();
            Session::flash('success','Successfully created!');
            return redirect()->route('goals.list');
        }catch(\Exception $e){

            DB::rollback();
            throw $e;
        }
    }


    protected function modelValidate($request){

        $rules = [

                'goal_number' => 'required|regex:/^[0-9]+$/',
                'goal_title'  => 'required',
                'goal_tagline' => 'required',
                'goal_description' => 'required',
                'goal_url'  =>  'required',
                'goal_icon' =>  'required',
                'goal_icon_url' => 'required',
                'goal_color_hex' => 'required',
                'goal_nodal_ministry' => 'required',
                'goal_other_ministries' => 'required',
                //'goal_schemes' => 'required',
                //'goal_interventions' => 'required'
        ];

        $this->validate($request, $rules);
    }

    public function destroy($id){

        $model = Goal::findOrFail($id);

        try{

            $model->ministry()->delete();
            $model->delete();
            Session::flash('success','Successfully deleted!');
            return redirect()->route('goals.list');
        }catch(\Exception $e){

            throw $e;
        }
    }

    public function edit($id){
        try{
            $model = Goal::findOrFail($id);
            $minis = [];
            $schema = [];
            $target = [];
            $resources = [];
            $intervention = [];
            foreach($model->ministry as $key => $value){

                $minis[] = $value->ministry_id;
            }

            foreach($model->schema as $key => $value){

                $schema[] = $value->schemas_id;
            }

            foreach($model->target as $key => $value){

                $target[] = $value->targets_id;
            }

            foreach($model->resources as $key => $value){

                $resources[] = $value->resources_id;
            }

            foreach($model->intervention as $key => $value){

                $intervention[] = $value->interventions_id;
            }
            return view('goals.edit',[
                    'model' => $model,
                    'minis' => $minis,
                    'schema'=> $schema,
                    'target'=> $target,
                    'resources' => $resources,
                    'intervention' => $intervention,
                    'css' => ['select2'],
                    'js' => ['select2','custom'=>['goals-create']]
                ]);
            }catch(\Exception $e)
            {
                Session::flash('error','No data found for this');
                return redirect()->route('goals.list');

            }
    }

    public function update(Request $request, $id){

        $model = Goal::findOrFail($id);

        //  if($request->goal_number =="" && $request->goal_title =="" &&  $request->goal_tagline =="" &&  $request->goal_description=="" && $request->goal_url  =="" && $request->goal_icon =="" && $request->goal_icon_url=="" && $request->goal_color_hex =="" &&  $request->goal_color_rgb =="" && $request->goal_color_rgb_a =="" && $request->goal_opacity=="" && $request->goal_nodal_ministry =="" && !$request->goal_other_ministries && !$request->goal_schemes && !$request->goal_interventions  && !$request->goal_targets && !$request->goal_resources )
        // {
        //     return redirect()->route('goals.create');
        // }
      

        DB::beginTransaction();
        try{
            $model->fill($request->except(['goal_other_ministries','_token','goal_schemes','goal_interventions','goal_targets','goal_resources']));

            $model->save();
            $model->ministry()->delete();
            if(!empty($request->goal_other_ministries))
            {    
                foreach($request->goal_other_ministries as $key => $value){

                    $minis = new GMM();

                    $minis->ministry_id = $value;

                    $model->ministry()->save($minis);
                }
            }
            $model->schema()->delete();
            if(!empty($request->goal_schemes)){
                foreach ($request->goal_schemes as $key => $value) {

                   $schemaObj = new GSM();

                   $schemaObj->schemas_id = $value;

                   $model->schema()->save($schemaObj);
                }
            }

            $model->intervention()->delete();
            if(!empty($request->goal_interventions)){
                foreach ($request->goal_interventions as $key => $value) {

                   $intervObj = new GIM();

                   $intervObj->interventions_id = $value;

                   $model->intervention()->save($intervObj);
                }
            }

            $model->target()->delete();
            if(!empty($request->goal_targets))
            {
                foreach ($request->goal_targets as $key => $value) {

                   $targetObj = new GTM();

                   $targetObj->targets_id = $value;

                   $model->target()->save($targetObj);
                }
            }
            $model->resources()->delete();
            if(!empty($request->goal_resources)){
                foreach ($request->goal_resources as $key => $value) {

                   $resourceObj = new GRM();

                   $resourceObj->resources_id = $value;

                   $model->resources()->save($resourceObj);
                }
            }

            DB::commit();
            Session::flash('success','Successfully update!');
            return redirect()->route('goals.list');
        }catch(\Exception $e){

            DB::rollback();
            throw $e;
        }
    }
    public function delMulGoals(Request $request)
    {

    }

}
