<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoalsInterventionsMappings extends Model
{
    use SoftDeletes;

    protected $fillable = ['goal_id','goal_type','interventions_id'];
    protected $dates = ['deleted_at'];
    protected $softDelete = true;

    public function interventions(){
    	return $this->belongsTo('App\GoalsIntervention');
    }
}
