<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelDictCategory extends Model
{
    protected $table = 'furniture_dict_category';
    protected $fillable = ["id","name","fileName","filePath"];
    protected $hidden = ['created_at','updated_at',];
}
