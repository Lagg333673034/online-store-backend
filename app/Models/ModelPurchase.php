<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelPurchase extends Model
{
    protected $table = 'furniture_purchase';
    protected $fillable = ["id","id_customer","id_branch","purchase_date"];
    protected $hidden = ['created_at','updated_at',];
}
