<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelDictShape extends Model
{
    protected $table = 'furniture_dict_shape';
    protected $fillable = ["id","name"];
    protected $hidden = ['created_at','updated_at',];
}
