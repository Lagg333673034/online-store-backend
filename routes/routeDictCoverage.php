<?php

use App\Http\Controllers\ControllerDictCoverage;
use Illuminate\Support\Facades\Route;



Route::get('/dict-coverage-getall',[ControllerDictCoverage::class, 'getAll']);
Route::get('/dict-coverage-getone/{id}',[ControllerDictCoverage::class, 'getOne']);
Route::post('/dict-coverage-create',[ControllerDictCoverage::class, 'create']);
Route::post('/dict-coverage-update/{id}',[ControllerDictCoverage::class, 'update']);
Route::post('/dict-coverage-delete/{id}',[ControllerDictCoverage::class, 'delete']);
