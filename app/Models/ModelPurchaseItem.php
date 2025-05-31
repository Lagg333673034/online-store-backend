<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelPurchaseItem extends Model
{
    protected $table = 'furniture_purchaseitem';
    protected $fillable = ["id","id_purchase","id_product","product_count","product_price"];
    protected $hidden = ['created_at','updated_at',];
}
