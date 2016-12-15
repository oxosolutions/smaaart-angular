<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissonRole extends Model
{
    //
        protected $fillable =['id', 'role_id', 'permisson_id', 'read','write'];


    public function permissons(){
    	return $this->belongsTo('App\Permisson');
    }

    

}
