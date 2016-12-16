<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoalsSchema extends Model
{

	use SoftDeletes;

    protected $fillable = ['schema_id','schema_title','schema_image','schema_desc','created_by','schema_content'];
    protected $dates = ['deleted_at'];
    protected $softDelete = true;

    public function scopeWithUsers($query)
    {
    	$query->select('goals_schemas.*')
    		  ->leftjoin('users','users.id', '=', 'goals_schemas.created_by')
        	  ->addSelect('users.name as created_by');
    }

    public static function schemaList(){
        return self::orderBy('id')->pluck('schema_title','id');
    }

    public static function schemeCount()
    {
        return self::count();
    }
}
