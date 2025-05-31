<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelDictMaterial extends Model
{
    protected $table = 'furniture_dict_material';
    protected $fillable = ["id","name"];
    protected $hidden = ['created_at','updated_at',];
}
