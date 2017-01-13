<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoalsIntervention extends Model
{
	use SoftDeletes;

    protected $fillable = ['intervent_id','intervent_title','intervent_image','intervent_desc','created_by','content'];
    protected $dates = ['deleted_at'];
    protected $softDelete = true;

    public function scopeWithUsers($query)
    {
    	$query->select('goals_interventions.*')
    		  ->leftjoin('users','users.id', '=', 'goals_interventions.created_by')
        	  ->addSelect('users.name as created_by');
    }

    static function interventionList(){
        return self::orderby('id')->pluck('intervent_title','id');
    }

     static function countIntervention()
     {
        return self::count();
     }
}
