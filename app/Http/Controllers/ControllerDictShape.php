<?php

namespace App\Http\Controllers;

use App\Models\ModelDictShape;
use Exception;
use Illuminate\Http\Request;

class ControllerDictShape extends Controller
{
    static public function getAll(){
        try{
            $all = ModelDictShape::all();

            return $all;
        }catch(Exception $err){
            return $err->getMessage();
        }
    }
    static public function getOne($id){
        try{
            $one = ModelDictShape::find($id);

            return $one;
        }catch(Exception $err){
            return $err->getMessage();
        }
    }
    static public function create(Request $request){
        try{
            $request->validate([
                "name" => ['required', 'min:1', 'max:200'],
            ]);

            ModelDictShape::create([
                "name" => $request->name
            ]);

            return response()->json(['message' => 'Row created'], 200);
        }catch(Exception $err){
            return $err->getMessage();
        }
    }
    public function update(Request $request, $id){
        try{
            $request->validate([
                "name" => ['required', 'min:1', 'max:200'],
            ]);
            
            if(is_null($id) || empty($id) || !is_numeric($id)){
                return response()->json(['message' => 'id not found'], 400);
            }

            $one = ModelDictShape::find($id);

            if (is_null($one)) {
                return response()->json(['message' => 'row in table with id='.$id.' does not exist'], 400);
            } else {
                $one->name = $request->name;
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

            $one = ModelDictShape::find($id);

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
