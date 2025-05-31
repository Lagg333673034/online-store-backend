<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelDictBranch extends Model
{
    protected $table = 'furniture_dict_branch';
    protected $fillable = ["id","name"];
    protected $hidden = ['created_at','updated_at',];
}
