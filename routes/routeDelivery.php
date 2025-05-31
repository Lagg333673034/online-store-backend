<?php

use App\Http\Controllers\ControllerDelivery;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'auth:sanctum'] ,function(){
   

Route::post('/delivery-getall',[ControllerDelivery::class, 'getAll']);
Route::get('/delivery-getone/{id}',[ControllerDelivery::class, 'getOne']);

Route::post('/delivery-create',[ControllerDelivery::class, 'create']);
Route::post('/delivery-update/{id}',[ControllerDelivery::class, 'update']);
Route::post('/delivery-delete/{id}',[ControllerDelivery::class, 'delete']);


});