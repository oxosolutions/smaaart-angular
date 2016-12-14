<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


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

}
