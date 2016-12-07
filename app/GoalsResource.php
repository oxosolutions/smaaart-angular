<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoalsResource extends Model
{

	use SoftDeletes;

    protected $fillable = ['resource_id','resource_title','resource_image','resource_desc','created_by'];

    protected $dates = ['deleted_at'];

    protected $softDelete = true;
    
    public function scopeWithUsers($query){

    	$query->select('goals_resources.*')
    		  ->leftjoin('users','users.id', '=', 'goals_resources.created_by')
        	  ->addSelect('users.name as created_by');
    }

    public static function resourceList(){

        return self::orderBy('id')->pluck('resource_title','id');
    }
}
