<?php

use App\Http\Controllers\ControllerPurchaseItem;
use Illuminate\Support\Facades\Route;



Route::get('/purchaseitem-getall',[ControllerPurchaseItem::class, 'getAll']);
Route::get('/purchaseitem-getone/{id}',[ControllerPurchaseItem::class, 'getOne']);

Route::group(['middleware' => 'auth:sanctum'] ,function(){
    Route::post('/purchaseitem-create',[ControllerPurchaseItem::class, 'create']);
    Route::post('/purchaseitem-update/{id}',[ControllerPurchaseItem::class, 'update']);
    Route::post('/purchaseitem-delete/{id}',[ControllerPurchaseItem::class, 'delete']);
});