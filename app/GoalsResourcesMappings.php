<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoalsResourcesMappings extends Model
{
    use SoftDeletes;

    protected $fillable = ['goal_id','goal_type','resources_id'];
    protected $dates = ['deleted_at'];
    protected $softDelete = true;

    public function resources(){
    	return $this->belongsTo('App\GoalsResource');
    }
}
