<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneratedVisual extends Model
{
    protected $fillable = ['visual_name','dataset_id','columns','query_result'];

    function datasetName(){

    	return $this->belongsTo('App\DatasetsList','dataset_id','id');
    }

    function createdBy(){

    	return $this->belongsTo('App\User','created_by','id');
    }
}
