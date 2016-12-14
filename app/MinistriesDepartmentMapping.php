<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MinistriesDepartmentMapping extends Model
{	
	use SoftDeletes;

    protected $fillable = ['ministry_id','department_id','ministry_type'];
    protected $dates = ['deleted_at'];
    protected $softDelete = true;

    public function department(){

    	return $this->belongsTo('App\Department');
    }
}
