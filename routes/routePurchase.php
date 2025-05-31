<?php

use App\Http\Controllers\ControllerPurchase;
use Illuminate\Support\Facades\Route;



Route::post('/purchase-getall',[ControllerPurchase::class, 'getAll']);
Route::post('/purchase-getitems',[ControllerPurchase::class, 'getItems']);
Route::get('/purchase-getone/{id}',[ControllerPurchase::class, 'getOne']);

Route::group(['middleware' => 'auth:sanctum'] ,function(){
    Route::post('/purchase-create',[ControllerPurchase::class, 'create']);
    Route::post('/purchase-update/{id}',[ControllerPurchase::class, 'update']);
    Route::post('/purchase-delete/{id}',[ControllerPurchase::class, 'delete']);
});