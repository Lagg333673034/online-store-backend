<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelProduct extends Model
{
    protected $table = 'furniture_product';
    protected $fillable = [
        "id",
        "name",
        "length",
        "width",
        "height",
        "depth",

        "id_category",
        "id_manufacturer",
        "id_coverage",
        "id_locktype",
        "id_purpose",
        "id_shape",

        "id_color_facade",
        "id_color_body",
        "id_color_frame",
        "id_color_workingsurface",

        "id_material_facade",
        "id_material_body",
        "id_material_frame",
        "id_material_workingsurface",

        "filePath",
    ];
    protected $hidden = ['created_at','updated_at',];
}
