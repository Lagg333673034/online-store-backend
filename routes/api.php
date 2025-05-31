<?php

use App\Http\Controllers\ControllerAuth;
use Illuminate\Support\Facades\Route;

//здесь url начинается с '/api'


require __DIR__.'/routeDelivery.php';
require __DIR__.'/routeDict.php';
require __DIR__.'/routeDictBranch.php';
require __DIR__.'/routeDictCategory.php';
require __DIR__.'/routeDictColor.php';
require __DIR__.'/routeDictCoverage.php';
require __DIR__.'/routeDictLocktype.php';
require __DIR__.'/routeDictManufacturer.php';
require __DIR__.'/routeDictMaterial.php';
require __DIR__.'/routeDictPurpose.php';
require __DIR__.'/routeDictShape.php';
require __DIR__.'/routeFile.php';
require __DIR__.'/routePriceChange.php';
require __DIR__.'/routeProduct.php';
require __DIR__.'/routePurchase.php';
require __DIR__.'/routePurchaseItem.php';


Route::group(['middleware' => 'auth:sanctum'] ,function(){
    Route::get('userprofile',[ControllerAuth::class, 'userprofile']);
    Route::get('logout', [ControllerAuth::class, 'logout']);
    Route::get('check-auth', [ControllerAuth::class, 'checkAuth']);
});

Route::post('register', [ControllerAuth::class, 'register']);
Route::post('login', [ControllerAuth::class, 'login']);
