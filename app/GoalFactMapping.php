<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoalFactMapping extends Model
{
    
    use SoftDeletes;

    protected $fillable = ['goal_id','goal_type','fact_id'];
    protected $dates = ['deleted_at'];
    protected $softDelete = true;

     public function fact(){
    	return $this->belongsTo('App\GoalFact');
    }

}
