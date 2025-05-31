<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelDictLocktype extends Model
{
    protected $table = 'furniture_dict_locktype';
    protected $fillable = ["id","name"];
    protected $hidden = ['created_at','updated_at',];
}
