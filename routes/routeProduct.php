<?php

use App\Http\Controllers\ControllerProduct;
use Illuminate\Support\Facades\Route;



Route::post('/product-getall',[ControllerProduct::class, 'getAll']);
Route::post('/product-getall-parameters',[ControllerProduct::class, 'getAllparameters']);
Route::post('/product-getone/',[ControllerProduct::class, 'getOne']);

Route::post('/product-getproductcount',[ControllerProduct::class, 'getProductCount']);

Route::group(['middleware' => 'auth:sanctum'] ,function(){
    Route::post('/product-create',[ControllerProduct::class, 'create']);
    Route::post('/product-update/{id}',[ControllerProduct::class, 'update']);
    Route::post('/product-delete/{id}',[ControllerProduct::class, 'delete']);
});