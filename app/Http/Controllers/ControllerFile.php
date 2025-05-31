<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ControllerFile extends Controller
{
    static public function getAllFiles(Request $request){
        try{
            $path = $request->path;
            if(is_null($path) || empty($path)){
                return response()->json(['message' => 'the image path does not exist'], 400);
            }

            $files = Storage::disk('public')->allFiles($path);

            return response()->json(['files' => $files], 200);
        }catch(Exception $err){
            return $err->getMessage();
        }
    }
    static public function createFile(Request $request){
        try{
            $image = $request->file('image');
            $path = $request->path;

            if(is_null($image) || empty($image)){
                return response()->json(['message' => 'the image does not exist'], 400);
            }
            if(is_null($path) || empty($path)){
                return response()->json(['message' => 'the image path does not exist'], 400);
            }

            $size = $image->getSize();//byte
            if($size > 1024*1024*5){
                // fileSize > 5mb
                return response()->json(['message' => 'Too large file size'], 400);
            }

            $fullPath = Storage::disk('public')->putFile($path, $image);

            return response()->json(['path' => $fullPath], 200);
        }catch(Exception $err){
            return $err->getMessage();
        }
    }
    static public function deleteFile(Request $request){
        try{
            $path = $request->path;
            if(is_null($path) || empty($path)){
                return response()->json(['message' => 'the image path does not exist'], 400);
            }

            Storage::disk('public')->delete($path);

            return response()->json(['message' => 'File deleted'], 200);
        }catch(Exception $err){
            return $err->getMessage();
        }
    }
    static public function getAllFolders(Request $request){
        try{
            $path = $request->path;
            if(is_null($path) || empty($path)){
                return response()->json(['message' => 'the image path does not exist'], 400);
            }

            $directories = Storage::disk('public')->allDirectories($path);

            return response()->json(['directories' => $directories], 200);
        }catch(Exception $err){
            return $err->getMessage();
        }
    }
    static public function createFolder(Request $request){
        try{
            $path = $request->path;
            if(is_null($path) || empty($path)){
                return response()->json(['message' => 'the image path does not exist'], 400);
            }

            Storage::disk('public')->makeDirectory($path);

            return response()->json(['message' => 'Folder created'], 200);
        }catch(Exception $err){
            return $err->getMessage();
        }
    }
    static public function deleteFolder(Request $request){
        try{
            $path = $request->path;
            if(is_null($path) || empty($path)){
                return response()->json(['message' => 'the image path does not exist'], 400);
            }

            Storage::disk('public')->deleteDirectory($path);

            return response()->json(['message' => 'Folder deleted'], 200);
        }catch(Exception $err){
            return $err->getMessage();
        }
    }
}
