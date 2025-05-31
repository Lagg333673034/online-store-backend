<?php

use App\Http\Controllers\ControllerDictPurpose;
use Illuminate\Support\Facades\Route;



Route::get('/dict-purpose-getall',[ControllerDictPurpose::class, 'getAll']);
Route::get('/dict-purpose-getone/{id}',[ControllerDictPurpose::class, 'getOne']);

Route::group(['middleware' => 'auth:sanctum'] ,function(){
    Route::post('/dict-purpose-create',[ControllerDictPurpose::class, 'create']);
    Route::post('/dict-purpose-update/{id}',[ControllerDictPurpose::class, 'update']);
    Route::post('/dict-purpose-delete/{id}',[ControllerDictPurpose::class, 'delete']);
});