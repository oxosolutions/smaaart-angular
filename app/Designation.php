<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Designation extends Model
{
    protected $fillable = ['designation'];
    protected $dates = ['deleted_at'];
    protected $softDelete = true;

    public static function designationList(){
    	return self::orderBy('id')->pluck('designation','id');
    }

    public static function getDesignation($id)
    {
    	return self::where('id',$id)->first()->designation;
    }
}
