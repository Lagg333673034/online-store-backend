<?php

use App\Http\Controllers\ControllerDict;
use Illuminate\Support\Facades\Route;



Route::post('/dict-getall',[ControllerDict::class, 'getAll']);

