<?php

namespace App\Http\Controllers;

use App\Models\ModelDelivery;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ControllerVerification;

class ControllerDelivery extends Controller
{
    static public function getAll(Request $request){
        try{
            $id_branch = ControllerVerification::check_number($request->id_branch);

            $all = DB::table('furniture_delivery')
            ->leftJoin('furniture_dict_branch', 'furniture_dict_branch.id', '=', 'furniture_delivery.id_branch')
            ->leftJoin('furniture_product', 'furniture_product.id', '=', 'furniture_delivery.id_product')
         
            ->select(
                'furniture_delivery.id as id', 
                'furniture_delivery.id_branch as id_branch',
                'furniture_delivery.id_product as id_product',
                'furniture_delivery.delivery_date as delivery_date',
                'furniture_delivery.product_count as product_count',

                'furniture_dict_branch.name as branchName',
                'furniture_product.id as productId',
                'furniture_product.filePath as productFilePath',
            )

            ->where(
                'furniture_delivery.id_branch', 
                $id_branch!=0 ? '=':'!=', 
                $id_branch!=0 ? $id_branch:0
            )

            ->get();

            return $all;
        }catch(Exception $err){
            return $err->getMessage();
        }
    }
    static public function getOne($id){
        try{
            $one = ModelDelivery::find($id);

            return $one;
        }catch(Exception $err){
            return $err->getMessage();
        }
    }


    static public function create(Request $request){
        try{
            ModelDelivery::create([
                "id_product"    => ControllerVerification::check_number($request->id_product),
                "id_branch"     => ControllerVerification::check_number($request->id_branch),
                "delivery_date" => ControllerVerification::check_date($request->delivery_date),
                "product_count" => ControllerVerification::check_number($request->product_count),
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

            $one = ModelDelivery::find($id);

            if (is_null($one)) {
                return response()->json(['message' => 'row in table with id='.$id.' does not exist'], 400);
            } else {

                $one->id_product    = ControllerVerification::check_number($request->id_product);
                $one->id_branch     = ControllerVerification::check_number($request->id_branch);
                $one->delivery_date = ControllerVerification::check_date($request->delivery_date);
                $one->product_count = ControllerVerification::check_number($request->product_count);
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

            $one = ModelDelivery::find($id);

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
