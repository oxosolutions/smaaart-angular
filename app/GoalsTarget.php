<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoalsTarget extends Model
{

	use SoftDeletes;
    protected $fillable = ['target_id','target_title','target_image','target_desc','created_by'];
    protected $dates = ['deleted_at'];
    protected $softDelete = true;
    
    public function scopeWithUsers($query){
    	$query->select('goals_targets.*')
    		  ->leftjoin('users','users.id', '=', 'goals_targets.created_by')
        	  ->addSelect('users.name as created_by');
    }

    public static function targetList(){
        return self::orderBy('id')->pluck('target_title','id');
    }

    public function indicators(){
        return $this->hasMany('App\Indicator','targets_id');
    }

    static function targetCount()
    {
        return self::count();
    }
}
