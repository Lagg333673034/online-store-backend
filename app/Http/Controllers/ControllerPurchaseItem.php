<?php

namespace App\Http\Controllers;

use App\Models\ModelPurchaseItem;
use Exception;
use Illuminate\Http\Request;

class ControllerPurchaseItem extends Controller
{
    static public function getAll(){
        try{
            $all = ModelPurchaseItem::all();

            return $all;
        }catch(Exception $err){
            return $err->getMessage();
        }
    }
    static public function getOne($id){
        try{
            $one = ModelPurchaseItem::find($id);

            return $one;
        }catch(Exception $err){
            return $err->getMessage();
        }
    }
    static public function create(Request $request){
        try{
            $request->validate([
                "id_purchase"   => ['required',],
                "id_product"    => ['required',],
                "product_count" => ['required',],
                "product_price" => ['required',],
            ]);

            ModelPurchaseItem::create([
                "id_purchase"   => $request->id_purchase,
                "id_product"    => $request->id_product,
                "product_count" => $request->product_count,
                "product_price" => $request->product_price,
            ]);

            return response()->json(['message' => 'Row created'], 200);
        }catch(Exception $err){
            return $err->getMessage();
        }
    }
    public function update(Request $request, $id){
        try{
            $request->validate([
                "id_purchase"   => ['required',],
                "id_product"    => ['required',],
                "product_count" => ['required',],
                "product_price" => ['required',],
            ]);
            
            if(is_null($id) || empty($id) || !is_numeric($id)){
                return response()->json(['message' => 'id not found'], 400);
            }

            $one = ModelPurchaseItem::find($id);

            if (is_null($one)) {
                return response()->json(['message' => 'row in table with id='.$id.' does not exist'], 400);
            } else {

                $one->id_purchase   = $request->id_purchase;
                $one->id_product    = $request->id_product;
                $one->product_count = $request->product_count;
                $one->product_price = $request->product_price;
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

            $one = ModelPurchaseItem::find($id);

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
