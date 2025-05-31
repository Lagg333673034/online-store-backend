<?php

use App\Http\Controllers\ControllerFile;
use Illuminate\Support\Facades\Route;


Route::post('/file-getAllFiles',[ControllerFile::class, 'getAllFiles']);
Route::post('/file-getAllFolders',[ControllerFile::class, 'getAllFolders']);

Route::group(['middleware' => 'auth:sanctum'] ,function(){
    Route::post('/file-createFile',[ControllerFile::class, 'createFile']);
    Route::post('/file-deleteFile',[ControllerFile::class, 'deleteFile']);
    Route::post('/file-createFolder',[ControllerFile::class, 'createFolder']);
    Route::post('/file-deleteFolder',[ControllerFile::class, 'deleteFolder']);
});
