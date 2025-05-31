<?php

use App\Http\Controllers\ControllerDictBranch;
use Illuminate\Support\Facades\Route;



Route::get('/dict-branch-getall',[ControllerDictBranch::class, 'getAll']);
Route::get('/dict-branch-getone/{id}',[ControllerDictBranch::class, 'getOne']);

Route::group(['middleware' => 'auth:sanctum'] ,function(){
    Route::post('/dict-branch-create',[ControllerDictBranch::class, 'create']);
    Route::post('/dict-branch-update/{id}',[ControllerDictBranch::class, 'update']);
    Route::post('/dict-branch-delete/{id}',[ControllerDictBranch::class, 'delete']);
});