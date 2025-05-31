<?php

namespace App\Http\Controllers;

use App\Models\ModelPriceChange;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ControllerVerification;

class ControllerPriceChange extends Controller
{
    static public function getAll(Request $request){
        try{
            $id_category = ControllerVerification::check_number($request->id_category);

            $all = DB::table('furniture_pricechange')
            ->leftJoin('furniture_product', 'furniture_product.id', '=', 'furniture_pricechange.id_product')
         
            ->select(
                'furniture_pricechange.id as id', 
                'furniture_pricechange.id_product as id_product',
                'furniture_pricechange.date_price_change as date_price_change',
                'furniture_pricechange.price as price',

                'furniture_product.id as productId',
                'furniture_product.filePath as productFilePath',
            )

            ->where(
                'furniture_product.id_category', 
                $id_category!=0 ? '=':'!=', 
                $id_category!=0 ? $id_category:0
            )

            ->get();

            return $all;
        }catch(Exception $err){
            return $err->getMessage();
        }
    }
    static public function getOne($id){
        try{
            $one = ModelPriceChange::find($id);

            return $one;
        }catch(Exception $err){
            return $err->getMessage();
        }
    }
    static public function create(Request $request){
        try{
            ModelPriceChange::create([
                "id_product"        => ControllerVerification::check_number($request->id_product),
                "date_price_change" => ControllerVerification::check_date($request->date_price_change),
                "price"             => ControllerVerification::check_number($request->price),
            ]);

            return response()->json(['message' => 'Row created'], 200);
        }catch(Exception $err){
            return $err->getMessage();
        }
    }
    public function update(Request $request, $id){
        try{
            if(is_null($id) || empty($id) || !is_numeric($id)){
                return response()->json(['message' => 'id not found'], 400);
            }

            $one = ModelPriceChange::find($id);

            if (is_null($one)) {
                return response()->json(['message' => 'row in table with id='.$id.' does not exist'], 400);
            } else {

                $one->id_product        = ControllerVerification::check_number($request->id_product);
                $one->date_price_change = ControllerVerification::check_date($request->date_price_change);
                $one->price             = ControllerVerification::check_number($request->price);
                $one->save();

                return response()->json(['message' => 'Row updated'], 200);
            }
        }catch(Exception $err){
            return $err->getMessage();
        }
    }
    public function delete($id){
        try{
            if(is_null($id) || empty($id) || !is_numeric($id)){
                return response()->json(['message' => 'id not found'], 400);
            }

            $one = ModelPriceChange::find($id);

            if (is_null($one)) {
                return response()->json(['message' => 'row in table with id='.$id.' does not exist'], 400);
            } else {
                $one->delete();

                return response()->json(['message' => 'Row deleted'], 200);
            }
        }catch(Exception $err){
            return $err->getMessage();
        }
    }
}
