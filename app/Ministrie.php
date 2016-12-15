<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
class Ministrie extends Model
{
	use SoftDeletes;

    protected $fillable = ['ministry_id','ministry_title','ministry_description','ministry_icon','ministry_image','ministry_phone','ministry_ministers','ministry_order','created_by'];

    protected $dates = ['deleted_at'];
    protected $softDelete = true;

    public function scopeWithUsers($query){
		$query->select('ministries.*')
		 	  ->leftJoin('users','users.id','=','ministries.created_by')
		 	  ->addSelect('users.name as created_by');
    }

    public function departments(){
    	return $this->morphMany('App\MinistriesDepartmentMapping', 'ministry');
    }

    public static function ministryList(){
        return self::orderBy('id')->pluck('ministry_title','id');
    }
    static function countMinistry()
    {

        return self::count();
    }

}
