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

        $routesList =  Route::getRoutes();
        /*foreach ($routesList as $key => $value) {
            dump($value->getName());
        }
        exit;*/
        $pluckArray = [];
        foreach($routesList as $key =>$value){
            if($value->getName() != null || $value->getName() != ''){
                $pluckArray[$value->getName()] = ucwords(str_replace('.',' ',$value->getName()));
            }
        }
        return $pluckArray;
    }


}
