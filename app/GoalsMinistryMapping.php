<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoalsMinistryMapping extends Model
{	
	use SoftDeletes;

    protected $fillable = ['goal_id','goal_type','ministry_id'];
    protected $dates = ['deleted_at'];
    protected $softDelete = true;

    public function ministry(){
    	return $this->belongsTo('App\Ministrie');
    }
}
