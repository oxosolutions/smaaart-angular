<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Role extends Model
{
    use SoftDeletes;

    protected $fillable =['id', 'name', 'display_name', 'description'];

    protected $dates = ['deleted_at'];
    protected $softDelete = true;
		public static function role_list()
		{
			$result = 	self::orderBy('id')->pluck('name','id');
			return $result;
		}

		public function users()
		    {
		        return $this->hasMany('App\User', 'role_id', 'id');
		    }

		public function permisson()
		{
			return $this->morphMany('App\PermissonRole');
		}

		

}
