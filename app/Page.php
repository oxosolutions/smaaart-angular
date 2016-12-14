<?php

  namespace App;

  use Illuminate\Database\Eloquent\Model;
  use Illuminate\Database\Eloquent\SoftDeletes;
  class Page extends Model
  {
      protected $fillable = ['page_title','content','page_image','status','created_by','page_slug'];
      protected $dates = ['deleted_at'];
      protected $softDelete = true;

      public function createdBy(){
        return $this->belongsTo('App\User','created_by','id');
      }

      public static function statusList(){
          return [
                  '0' => 'Not Published',
                  '1' => 'Publish'
                ];
      }
  }
