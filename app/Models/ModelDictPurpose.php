<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelDictPurpose extends Model
{
    protected $table = 'furniture_dict_purpose';
    protected $fillable = ["id","name"];
    protected $hidden = ['created_at','updated_at',];
}
