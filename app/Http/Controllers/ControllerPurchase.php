<?php

namespace App\Http\Controllers;

use App\Models\ModelPurchase;
use App\Models\ModelPurchaseItem;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ControllerVerification;

class ControllerPurchase extends Controller
{
    static public function getAll(Request $request){
        try{
            $id_branch = ControllerVerification::check_number($request->id_branch);

            $str_filter_id_branch = $id_branch!=0 ? " furniture_purchase.id_branch = $id_branch " : " 1 ";

            $all = DB::select("
            SELECT 
            furniture_purchase.id as id, 
            furniture_dict_branch.name as branchName, 
            furniture_purchase.purchase_date as purchase_date, 
            (select sum(furniture_purchaseitem.product_price) 
             from furniture_purchaseitem 
             where furniture_purchaseitem.id_purchase=furniture_purchase.id) as totalSum,

            furniture_purchase.id_branch as id_branch
            
            FROM furniture_purchase
            left join furniture_dict_branch on furniture_dict_branch.id=furniture_purchase.id_branch

            WHERE $str_filter_id_branch
            ");

            return $all;
        }catch(Exception $err){
            return $err->getMessage();
        }
    }
    static public function getItems(Request $request){
        try{
            $id_purchase = ControllerVerification::check_number($request->id_purchase);

            $str_filter_id_purchase = $id_purchase!=0 ? " furniture_purchaseitem.id_purchase = $id_purchase " : " 1 ";

            $all = DB::select("
            SELECT 
            furniture_purchaseitem.id, 
            furniture_purchaseitem.id_purchase, 
            furniture_purchaseitem.id_product, 
            furniture_purchaseitem.product_count, 
            furniture_purchaseitem.product_price,

            furniture_dict_category.name as categoryName,
            furniture_dict_manufacturer.name as manufacturerName

            FROM furniture_purchaseitem 
            left join (furniture_product 
                left join furniture_dict_category on furniture_dict_category.id=furniture_product.id_category
                left join furniture_dict_manufacturer on furniture_dict_manufacturer.id=furniture_product.id_manufacturer
            ) on furniture_product.id=furniture_purchaseitem.id_product

            WHERE $str_filter_id_purchase
            ");

            return $all;
        }catch(Exception $err){
            return $err->getMessage();
        }
    }
    static public function getOne($id){
        try{
            $one = ModelPurchase::find($id);

            return $one;
        }catch(Exception $err){
            return $err->getMessage();
        }
    }
    static public function create(Request $request){
        try{
            $request->validate([
                "id_branch"     => ['required',],
                "purchase_date" => ['required',],
            ]);

            $purchase = ModelPurchase::create([
                "id_branch"     => ControllerVerification::check_number($request->id_branch),
                "purchase_date" => ControllerVerification::check_date($request->purchase_date),
            ]);


            $purchaseItems = ControllerVerification::check_array($request->purchaseItems);
            for($i=0;$i<count($purchaseItems);$i++){
                ModelPurchaseItem::create([
                    "id_purchase"   => $purchase->id,
                    "id_product"    => ControllerVerification::check_number($purchaseItems[$i]['id_product']),
                    "product_count" => ControllerVerification::check_number($purchaseItems[$i]['product_count']),
                    "product_price" => ControllerVerification::check_number($purchaseItems[$i]['product_price']),
                ]);
            }

            return response()->json(['message' => 'Row created'], 200);
        }catch(Exception $err){
            return $err->getMessage();
        }
    }
    public function update(Request $request, $id){
        try{
            $request->validate([
                "id_customer"   => ['required',],
                "id_branch"     => ['required',],
                "purchase_date" => ['required',],
            ]);
            
            if(is_null($id) || empty($id) || !is_numeric($id)){
                return response()->json(['message' => 'id not found'], 400);
            }

            $one = ModelPurchase::find($id);

            if (is_null($one)) {
                return response()->json(['message' => 'row in table with id='.$id.' does not exist'], 400);
            } else {

                $one->id_customer   = $request->id_customer;
                $one->id_branch     = $request->id_branch;
                $one->purchase_date = $request->purchase_date;
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

            $one = ModelPurchase::find($id);

            

            if (is_null($one)) {
                return response()->json(['message' => 'row in table with id='.$id.' does not exist'], 400);
            } else {
                /* ============================================================= */
                ModelPurchaseItem::where('id_purchase','=', $id)->delete();
                /* ============================================================= */
                $one->delete();

                return response()->json(['message' => 'Row deleted'], 200);
            }
        }catch(Exception $err){
            return $err->getMessage();
        }
    }
}
