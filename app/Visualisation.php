<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Visualisation extends Model
{
    protected $fillable = ['dataset_id','visual_name','created_by'];

    protected $dates = ['deleted_at'];

    protected $softDelete = true;

    function createdBy(){

    	return $this->belongsTo('App\User','created_by','id');
    }
}
