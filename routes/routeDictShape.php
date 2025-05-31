<?php

use App\Http\Controllers\ControllerDictShape;
use Illuminate\Support\Facades\Route;



Route::get('/dict-shape-getall',[ControllerDictShape::class, 'getAll']);
Route::get('/dict-shape-getone/{id}',[ControllerDictShape::class, 'getOne']);

Route::group(['middleware' => 'auth:sanctum'] ,function(){
    Route::post('/dict-shape-create',[ControllerDictShape::class, 'create']);
    Route::post('/dict-shape-update/{id}',[ControllerDictShape::class, 'update']);
    Route::post('/dict-shape-delete/{id}',[ControllerDictShape::class, 'delete']);
});