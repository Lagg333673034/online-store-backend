<?php

use App\Http\Controllers\ControllerDictColor;
use Illuminate\Support\Facades\Route;



Route::get('/dict-color-getall',[ControllerDictColor::class, 'getAll']);
Route::get('/dict-color-getone/{id}',[ControllerDictColor::class, 'getOne']);

Route::group(['middleware' => 'auth:sanctum'] ,function(){
    Route::post('/dict-color-create',[ControllerDictColor::class, 'create']);
    Route::post('/dict-color-update/{id}',[ControllerDictColor::class, 'update']);
    Route::post('/dict-color-delete/{id}',[ControllerDictColor::class, 'delete']);
});