<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Goal extends Model
{
	use SoftDeletes;

    protected $fillable = ['goal_number','goal_title','goal_tagline','goal_description','goal_url','goal_icon','goal_icon_url','goal_color','goal_opacity','goal_nodal_ministry','goal_schemes','goal_interventions','created_by'];


    protected $dates = ['deleted_at'];

    protected $softDelete = true;

    public function scopeWithUsers($query){

    		$query->select('goals.*')
    		 	  ->leftJoin('users','users.id','=','goals.created_by')
    		 	  ->addSelect('users.name as created_by');
    }
}
