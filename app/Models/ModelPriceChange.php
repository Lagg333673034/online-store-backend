<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelPriceChange extends Model
{
    protected $table = 'furniture_pricechange';
    protected $fillable = ["id","id_product","date_price_change","price"];
    protected $hidden = ['created_at','updated_at',];
}
