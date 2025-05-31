<?php

use App\Http\Controllers\ControllerDictMaterial;
use Illuminate\Support\Facades\Route;



Route::get('/dict-material-getall',[ControllerDictMaterial::class, 'getAll']);
Route::get('/dict-material-getone/{id}',[ControllerDictMaterial::class, 'getOne']);

Route::group(['middleware' => 'auth:sanctum'] ,function(){
    Route::post('/dict-material-create',[ControllerDictMaterial::class, 'create']);
    Route::post('/dict-material-update/{id}',[ControllerDictMaterial::class, 'update']);
    Route::post('/dict-material-delete/{id}',[ControllerDictMaterial::class, 'delete']);
});