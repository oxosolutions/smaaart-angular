<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Goal extends Model
{
	use SoftDeletes;

    protected $fillable = ['goal_number','goal_title','goal_tagline','goal_description','goal_url','goal_icon','goal_icon_url','goal_color_hex','goal_opacity','goal_nodal_ministry','goal_schemes','goal_interventions','created_by','goal_color_rgb','goal_color_rgb_a'];
    protected $dates = ['deleted_at'];
    protected $softDelete = true;

    public function scopeWithUsers($query){
    		$query->select('goals.*')
    		 	  ->leftJoin('users','users.id','=','goals.created_by')
    		 	  ->addSelect('users.name as created_by');
    }

    public function ministry(){
    	return $this->morphMany('App\GoalsMinistryMapping','goal');
    }

    public function schema(){
        return $this->morphMany('App\GoalsSchemasMappings','goal');
    }

    public function target(){
        return $this->morphMany('App\GoalsTargetMappings','goal');
    }

    public function resources(){
        return $this->morphMany('App\GoalsResourcesMappings','goal');
    }

    public function intervention(){
        return $this->morphMany('App\GoalsInterventionsMappings','goal');
    }
}
