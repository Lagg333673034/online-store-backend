<?php

use App\Http\Controllers\ControllerPriceChange;
use Illuminate\Support\Facades\Route;



Route::post('/pricechange-getall',[ControllerPriceChange::class, 'getAll']);
Route::get('/pricechange-getone/{id}',[ControllerPriceChange::class, 'getOne']);

Route::group(['middleware' => 'auth:sanctum'] ,function(){
    Route::post('/pricechange-create',[ControllerPriceChange::class, 'create']);
    Route::post('/pricechange-update/{id}',[ControllerPriceChange::class, 'update']);
    Route::post('/pricechange-delete/{id}',[ControllerPriceChange::class, 'delete']);
});