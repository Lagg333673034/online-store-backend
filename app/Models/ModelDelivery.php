<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelDelivery extends Model
{
    protected $table = 'furniture_delivery';
    protected $fillable = ["id","id_product","id_branch","delivery_date","product_count"];
    protected $hidden = ['created_at','updated_at',];
}
