<?php

use App\Http\Controllers\ControllerDictCategory;
use Illuminate\Support\Facades\Route;



Route::get('/dict-category-getall',[ControllerDictCategory::class, 'getAll']);
Route::get('/dict-category-getone/{id}',[ControllerDictCategory::class, 'getOne']);

Route::group(['middleware' => 'auth:sanctum'] ,function(){
    Route::post('/dict-category-create',[ControllerDictCategory::class, 'create']);
    Route::post('/dict-category-update/{id}',[ControllerDictCategory::class, 'update']);
    Route::post('/dict-category-updateImage/{id}',[ControllerDictCategory::class, 'updateImage']);
    Route::post('/dict-category-delete/{id}',[ControllerDictCategory::class, 'delete']);
});