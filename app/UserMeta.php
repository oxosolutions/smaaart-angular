<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
    protected $fillable = ['user_id','key','value'];

    public function user(){

        return $this->belongsTo('App\User');
    }

}
