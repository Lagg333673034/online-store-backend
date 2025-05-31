<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelDictManufacturer extends Model
{
    protected $table = 'furniture_dict_manufacturer';
    protected $fillable = ["id","name"];
    protected $hidden = ['created_at','updated_at',];
}
