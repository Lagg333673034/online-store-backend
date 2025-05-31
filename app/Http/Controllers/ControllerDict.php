<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ControllerVerification;

class ControllerDict extends Controller
{
    static public function getAll(Request $request){
        try{
            $id_category = ControllerVerification::check_number($request->id_category);
            $table_name = ControllerVerification::check_string($request->table_name);
            $col_name = ControllerVerification::check_string($request->col_name);

            $all = DB::table('furniture_dict_'.$table_name)
            ->leftJoin('furniture_product', 'furniture_product.id_'.$col_name, '=', 'furniture_dict_'.$table_name.'.id')
            ->select(
                'furniture_dict_'.$table_name.'.id as id', 
                'furniture_dict_'.$table_name.'.name as name',   
            )
            ->where('furniture_product.id_category', '=', $id_category)
            ->distinct()
            ->get();


            return $all;
        }catch(Exception $err){
            return $err->getMessage();
        }
    }

}
