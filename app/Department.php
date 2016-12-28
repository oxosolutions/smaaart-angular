<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Activitylog\LogsActivityInterface;
use Spatie\Activitylog\LogsActivity;



class Department extends Model
{
	use SoftDeletes;

    protected $fillable = ['dep_code','dep_name','created_by'];
    protected $dates = ['deleted_at'];
    protected $softDelete = true;

    public function scopeWithUsers($query){
    	$query->select('departments.*')
    		  ->leftjoin('users','users.id', '=', 'departments.created_by')
        	  ->addSelect('users.name as created_by');
    }

    public static function departmentList(){

    	return self::orderBy('id')->pluck('dep_name','id');
    }
    static function deptCount()
    {
        return self::count();
    }
    static function getDepName($id)
    {
        return self::where('id',$id)->first()->dep_name;
    }
    
}
