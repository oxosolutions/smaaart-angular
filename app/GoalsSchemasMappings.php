<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoalsSchemasMappings extends Model
{
    use SoftDeletes;

    protected $fillable = ['goal_id','goal_type','schemas_id'];

    protected $dates = ['deleted_at'];

    protected $softDelete = true;

    public function schemas(){

    	return $this->belongsTo('App\GoalsSchema');
    }
}
