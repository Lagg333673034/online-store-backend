<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelDictCoverage extends Model
{
    protected $table = 'furniture_dict_coverage';
    protected $fillable = ["id","name"];
    protected $hidden = ['created_at','updated_at',];
}
