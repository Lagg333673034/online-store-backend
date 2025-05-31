<?php

use App\Http\Controllers\ControllerDictManufacturer;
use Illuminate\Support\Facades\Route;



Route::get('/dict-manufacturer-getall',[ControllerDictManufacturer::class, 'getAll']);
Route::get('/dict-manufacturer-getone/{id}',[ControllerDictManufacturer::class, 'getOne']);
Route::post('/dict-manufacturer-create',[ControllerDictManufacturer::class, 'create']);
Route::post('/dict-manufacturer-update/{id}',[ControllerDictManufacturer::class, 'update']);
Route::post('/dict-manufacturer-delete/{id}',[ControllerDictManufacturer::class, 'delete']);
