<?php

  namespace App\Http\Controllers;

  use Illuminate\Http\Request;
  use Yajra\Datatables\Datatables;
  use App\Page;
  use Session;
  use DB;
  use Auth;
  class PagesController extends Controller
  {
    public function index(){

      $plugins = [
                  'css'  => ['datatables'],
                  'js'   => ['datatables','custom'=>['gen-datatables']],
              ];

      return view('pages.index',$plugins);
    }

    public function indexData(){

      $model = Page::get();
      return Datatables::of($model)
            ->addColumn('actions',function($model){
                return view('pages._actions',['model' => $model])->render();
            })->editColumn('created_by',function($model){
              return $model->createdBy->name;
            })->editColumn('page_image', function($model){
              return view('pages._image',['model'=>$model])->render();
            })->make(true);
    }

    public function create(){

      $plugins = [
            'css' => ['wysihtml5','fileupload'],
            'js'  => ['wysihtml5','fileupload','ckeditor','custom'=>['page-create']]
      ];
      return view('pages.create',$plugins);
    }

    public function store(Request $request){

      $this->modelValidate($request);

      DB::beginTransaction();
      try{

        $model = new Page($request->except(['_token']));
        $model->created_by = Auth::user()->id;
        $path = 'pages_data';
        if($request->hasFile('page_image')){

            $filename = date('Y-m-d-H-i-s')."-".$request->file('page_image')->getClientOriginalName();

            $request->file('page_image')->move($path, $filename);

            $model->page_image = $filename;
        }
        $model->save();
        DB::commit();
        Session::flash('success','Successfully created!');
        return redirect()->route('pages.list');
      }catch(\Exception $e){

        DB::rollback();
        throw $e;
      }
    }

    public function modelValidate($request){

      $rules = [

            'page_title'  => 'required',
            'status'       =>  'required',
            'page_slug'   => 'required'
      ];

      $this->validate($request, $rules);
    }

    public function edit($id){

      $model = Page::findOrFail($id);

      $plugins = [
            'css' => ['wysihtml5','fileupload'],
            'js'  => ['wysihtml5','fileupload','ckeditor','custom'=>['page-create']],
            'model' => $model
      ];
      return view('pages.edit',$plugins);
    }

    public function update(Request $request, $id){

      $model = Page::findOrFail($id);

      $this->modelValidate($request);

      DB::beginTransaction();

      try{
        $model->fill($request->except(['_token']));
        $model->created_by = Auth::user()->id;
        $path = 'pages_data';
        if($request->hasFile('page_image')){

            $filename = date('Y-m-d-H-i-s')."-".$request->file('page_image')->getClientOriginalName();

            $request->file('page_image')->move($path, $filename);

            $model->page_image = $filename;
        }
        $model->save();
        DB::commit();
        Session::flash('success','Successfully updated!');
        return redirect()->route('pages.list');
      }catch(\Exception $e){

        DB::rollback();

        throw $e;
      }
    }

    public function destroy($id){

      $model = Page::findOrFail($id);

      try{
        $model->delete();
        Session::flash('success','Successfully deleted!');
        return redirect()->route('pages.list');
      }catch(\Exception $e){

        throw $e;
      }
    }
  }
