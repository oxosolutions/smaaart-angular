<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoalsTargetMappings extends Model
{
    use SoftDeletes;
    protected $fillable = ['goal_id','goal_type','targets_id'];
    protected $dates = ['deleted_at'];
    protected $softDelete = true;

    public function targets(){

    	return $this->belongsTo('App\GoalsTarget');
    }
}
