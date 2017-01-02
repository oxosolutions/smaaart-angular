<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\DatasetsList as DL;
use Yajra\Datatables\Datatables;
use Auth;
use Session;
use DB;
use Excel;
use MySQLWrapper;
use File;

class DataSetsController extends Controller
{


    public function index(){
        ini_set('memory_limit', '-1');
        $plugins = [
                    'css' => ['datatables'],
                    'js'  => ['datatables','custom'=>['gen-datatables']]
                   ];
        return view('datasets.index',$plugins);
    }


    public function indexData(){
        ini_set('memory_limit', '-1');
        $model = DL::orderBy('id','desc')->get();
        return Datatables::of($model)
            ->addColumn('actions',function($model){
                return view('datasets._actions',['model' => $model])->render();
            })->editColumn('user_id',function($model){
                return ucfirst($model->userId->name);
            })->editColumn('dataset_records',function($model){
                try{
                    return DB::table($model->dataset_table)->count();
                }catch(\Exception $e){
                    return "0";
                }
            })->make(true);
    }


    public function create(){
        $plugin = [
                   
                    'js' => ['custom'=>['dataset-create']],
                  ];
        return view('datasets.create',$plugin);
    }


    public function store(Request $request){
      
      //$this->modelValidate($request);
        if($request->source == 'file'){
            $path = 'datasets';
            try {
                 if(!in_array($request->file('file')->getClientOriginalExtension(),['csv'])){
                    return ['status'=>'error','records'=>'File type not allowed!'];
                }
            } catch (Exception $e) {
                return ['status'=>'error','records'=>'Please Select a File to Upload'];
            }
            $file = $request->file('file');
            if($file->isValid()){

                $filename = date('Y-m-d-H-i-s')."-".$request->file('file')->getClientOriginalName();
                $uploadFile = $request->file('file')->move($path, $filename);
                 $filePath = $path.'/'.$filename;               
            }
        }
        
        if($request->source == 'file_server'){
            $filePath = $request->filepath;
            $filep = explode('/',$filePath);
            $filename = $filep[count($filep)-1];
        }

        if($request->source == 'url'){
            $filePath = $request->fileurl;
            $filep = explode('/',$filePath);
            $filename = $filep[count($filep)-1];
        }

        DB::beginTransaction();
        try{
             if($request->select_operation == 'new'){

                $result = $this->storeInDatabase($filePath, $request->dataset_name, $request->source, $filename);

                }elseif($request->select_operation == 'replace'){
                    
               $result = $this->replaceDataset($request, $request->file('dataset_file')->getClientOriginalName(), $filePath);
                }elseif($request->select_operation == 'append'){

                $result = $this->appendDataset($request->dataset_name, $request->source, $filename, $filePath, $request);
            }
           
            DB::commit();
            Session::flash('success','Successfully upload!');
            return redirect()->route('datasets.list');
        } catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
        
        Session::flash('success','Successfully created!');
        return redirect()->route('datasets.list');
    }

    protected function appendDataset($datasetName, $source, $filename, $filePath, $request){
       
        if($source == 'url'){
            $randName = 'downloaded_dataset_'.time().'.csv';
            $path = 'datasets/';
            copy($filename, $path.$randName);
            $filePath = 'datasets/'.$randName;
        }

        if(!File::exists($filePath)){
            return ['status'=>'false','id'=>'','message'=>'File not found on given path!'];
        }

        $tableName = 'table_temp_'.rand(5,1000);
        $model = new MySQLWrapper;
        $result = $model->wrapper->createTableFromCSV($filePath,$tableName,',','"', '\\', 0, array(), 'generate','\r\n');
        $tempTableData = DB::table($tableName)->get();

        $model_DL = DL::find($request->with_dataset);
        $oldTable = DB::table($model_DL->dataset_table)->get();
        
        $oldColumns = [];
        $new = (array)$tempTableData[0];
        $old = (array)$oldTable[0];
        
        if($new != $old){
            DB::select('DROP TABLE '.$tableName);
            return ['status'=>'false','message'=>'File columns are note same!'];
        }
        unset($new['id']);

        $appendColumns = implode(',', array_keys($new));
        DB::select('INSERT INTO `'.$model_DL->dataset_table.'` ('.$appendColumns.') SELECT '.$appendColumns.' FROM '.$tableName.' WHERE id != 1;');
        DB::select('DROP TABLE '.$tableName);
        
        return ['status'=>'true','message'=>'Dataset updated successfully!!', 'id'=>$model_DL->id];
    }

   

    protected function replaceDataset($request, $origName, $filename){
        ini_set('memory_limit', '2048M');
        $FileData = [];
        $data = Excel::load($filename, function($reader){ })->get();
        foreach($data as $key => $value){
            $FileData[] = $value->all();
        }
        $model = DL::find($request->dataset_list);
        $model->dataset_name = $origName;
        $model->dataset_records = json_encode($FileData);
        $model->user_id = Auth::user()->id;
        $model->uploaded_by = Auth::user()->name;
        $model->dataset_columns = null;
        $model->validated = 0;
        $model->save();
        if($model){
            return ['status'=>'true','id'=>$model->id,'message'=>'Dataset replaced successfully!'];
        }else{
            return ['status'=>'false','message'=>'unable to replace dataset!'];
        }
    }

 protected function storeInDatabase($filename, $origName, $source, $orName){
        
        $filePath = $filename;
        if($source == 'url'){
            $randName = 'downloaded_dataset_'.time().'.csv';
            $path = 'datasets/';
            copy($filename, $path.$randName);
            $filePath = 'datasets/'.$randName;
        }
        if(!File::exists($filePath)){
            return ['status'=>'false','id'=>'','message'=>'File not found on given path!'];
        }
        DB::beginTransaction();
        $model = new MySQLWrapper();
        $tableName = 'data_table_'.time();
        
        $result = $model->wrapper->createTableFromCSV($filePath,$tableName,',','"', '\\', 0, array(), 'generate','\r\n');
        
        if($result){
            $model = new DL;
            $model->dataset_table = $tableName;
            $model->dataset_name = $origName;
            $model->dataset_file = $filePath;
            $model->dataset_file_name = $orName;
            $model->user_id = Auth::user()->id;
            $model->uploaded_by = Auth::user()->name;
            $model->dataset_records = '{}';
            $model->save();
            DB::commit();
            return ['status'=>'true','id'=>$model->id,'message'=>'Dataset upload successfully!'];
        }else{
            DB::rollback();
            return ['status'=>'false','id'=>'','message'=>'unable to upload datsaet!'];
        }
    }

 


    protected function validateRequst($request){
        $errors = [];
        if($request->file('file') == '' || empty($request->file('file')) || $request->file('file') == null){
            $errors['file'] = 'File field should not empty!';
        }
         if($request->format == 'undefined' || empty($request->format) || $request->format  == null){
             $errors['format'] = 'Please select file format';
         }
        if($request->add_replace == 'undefined' || empty($request->add_replace) || $request->add_replace  == null){
            $errors['add_replace'] = 'Please select file format!';
        }
        if($request->add_replace == 'replace' || $request->add_replace == 'append'){
            if($request->with_dataset == '' || $request->with_dataset == 'undefined' || empty($request->with_dataset)){
                $errors['dataset'] = 'Please select dataset to '.$request->add_replace;
           }
        }
        if(count($errors) >= 1){
            $return = ['status' => 'false','error'=>$errors];
            return $return;
        }else{
            $return = ['status' => 'true','error'];
            return $return;
        }
    }
  
    protected function modelValidate($request){
        
        $rules = [
                'file' => 'required|mimes:csv,txt',
                'select_operation' => 'required',
                'dataset_name'      =>     'required'
               ];
        if($request->select_operation == 'append' || $request->select_operation == 'replace'){
            $rules['dataset_list'] = 'required';
        }
        $this->validate($request, $rules);
    }
    public function destroy($id){
        $model = DL::findOrFail($id);
        try{
            $model->delete();
            Session::flash('success','Successfully deleted!');
        }catch(\Exception $e){
            throw $e;
        }
        return redirect()->route('datasets.list');
    }
    
}