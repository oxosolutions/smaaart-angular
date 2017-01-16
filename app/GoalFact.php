<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class GoalFact extends Model
{
   use SoftDeletes;

    protected $fillable = ['fact_id','fact_title','fact_image','fact_desc','created_by'];
    protected $dates = ['deleted_at'];
    protected $softDelete = true;

    // public function goal()
    // {
    	
    // }

    public static function factList()
    {
    	return	self::orderBy('id')->pluck('fact_title','id');
    }

    public static function countFact()
    {
     return   self::count();
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by','id');
    }


}
