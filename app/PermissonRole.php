<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissonRole extends Model
{
    //

    public function permissons(){
    	return $this->belongsTo('App\Permisson');
    }

}
