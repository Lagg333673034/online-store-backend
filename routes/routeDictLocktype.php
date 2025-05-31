<?php

use App\Http\Controllers\ControllerDictLocktype;
use Illuminate\Support\Facades\Route;



Route::get('/dict-locktype-getall',[ControllerDictLocktype::class, 'getAll']);
Route::get('/dict-locktype-getone/{id}',[ControllerDictLocktype::class, 'getOne']);
Route::post('/dict-locktype-create',[ControllerDictLocktype::class, 'create']);
Route::post('/dict-locktype-update/{id}',[ControllerDictLocktype::class, 'update']);
Route::post('/dict-locktype-delete/{id}',[ControllerDictLocktype::class, 'delete']);
