<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Route;

class Permisson extends Model
{
    use SoftDeletes;

    protected $fillable =['id', 'name', 'display_name', 'route'];

     protected $dates = ['deleted_at'];
    protected $softDelete = true;

    public static function permisson_data()
    {
    	$data =	self::orderBy('id')->get();

    	return $data;
    }

    public static function getRouteListArray(){

        
            $routes = Route::getRoutes();

                  
            foreach($routes as $route)
            {
               if(substr($route->getPath() ,0,1)=='_'){
                }
               else{
                    $rout =  str_replace('/{id}','',$route->getPath());
                    $routeList[$rout] = $rout;
                }
                //echo($route->getPath()).'<br>';
            }

            return $routeList;

        /*foreach ($routesList as $key => $value) {
            dump($value->getName());
        }
        exit;*/
        // $pluckArray = [];
        //$routesList =  Route::getRoutes();
        // foreach($routesList as $key =>$value){
        //     if($value->getName() != null || $value->getName() != ''){
        //         $pluckArray[$value->getName()] = ucwords(str_replace('.',' ',$value->getName()));
        //     }
        //}
        //return $pluckArray;
    }

    public static function getRouteFor()
    {
        $routeFor['read']   =   "Read";
        $routeFor['write']  =   "Write";
        $routeFor['delete'] =   "Delete";
        return $routeFor;

    }

    public function routeMapping()
    {
        $this->hasMany('App\PermissonRouteMapping','permisson_id','id');
    }

    public function permisson()
    {
        $this->hasMany('App\PermissonRole','permisson_id','id');
    }


}
