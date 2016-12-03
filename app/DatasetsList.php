<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatasetsList extends Model
{
    protected $fillable = ['dataset_name','dataset_records','uploaded_by'];
}
